<?php

namespace App\Console\Commands;

use App\Models\Lead;
use App\Services\FacebookCapiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SyncFacebookPastLeads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fb:sync-past-leads {--page_id= : Specific Facebook Page ID} {--form_id= : Specific Form ID} {--ad_account_id= : Meta Ad Account ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and backfill historical leads from Meta Lead Ads across all pages & ad account campaigns.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $rawToken = config('services.facebook.page_access_token') 
            ?: config('services.facebook.capi_access_token') 
            ?: env('FB_PAGE_ACCESS_TOKEN') 
            ?: env('FB_CAPI_ACCESS_TOKEN');

        if (empty($rawToken)) {
            $this->error('Facebook Access Token is missing in .env (FB_CAPI_ACCESS_TOKEN or FB_PAGE_ACCESS_TOKEN).');
            return 1;
        }

        $adAccountIdInput = $this->option('ad_account_id') ?: (config('services.facebook.ad_account_id') ?: env('FB_AD_ACCOUNT_ID'));
        $actId = !empty($adAccountIdInput) ? (str_starts_with((string)$adAccountIdInput, 'act_') ? $adAccountIdInput : 'act_' . $adAccountIdInput) : null;
        $directFormId = $this->option('form_id');

        $this->info("Starting Meta Lead Ads Synchronization...");
        $totalSynced = 0;
        $processedFormIds = [];

        // -------------------------------------------------------------
        // STRATEGY 1: Fetch Lead Forms directly from Meta Ad Account Ads
        // -------------------------------------------------------------
        if ($actId) {
            $this->info("Scanning Ad Account: {$actId} for Lead Forms & Attribution...");
            try {
                $adsResponse = Http::timeout(15)->get("https://graph.facebook.com/v19.0/{$actId}/ads", [
                    'fields' => 'id,name,campaign{id,name},adset{id,name},creative{id,name,leadgen_form_id}',
                    'limit' => 100,
                    'access_token' => $rawToken,
                ]);

                if ($adsResponse->successful()) {
                    $ads = $adsResponse->json('data') ?? [];
                    $this->info("Found " . count($ads) . " ad(s) in Ad Account.");

                    foreach ($ads as $ad) {
                        $adId = $ad['id'] ?? null;
                        $adName = $ad['name'] ?? null;
                        $campaignId = $ad['campaign']['id'] ?? null;
                        $campaignName = $ad['campaign']['name'] ?? null;
                        $adsetId = $ad['adset']['id'] ?? null;
                        $adsetName = $ad['adset']['name'] ?? null;
                        $formId = $ad['creative']['leadgen_form_id'] ?? null;

                        if ($formId && !in_array($formId, $processedFormIds)) {
                            $processedFormIds[] = $formId;
                            $this->line("Fetching leads for Ad: \"{$adName}\" (Form ID: {$formId})...");
                            
                            $synced = $this->syncLeadsFromForm($formId, $rawToken, [
                                'ad_id' => $adId,
                                'ad_name' => $adName,
                                'campaign_id' => $campaignId,
                                'campaign_name' => $campaignName,
                                'adset_id' => $adsetId,
                                'adset_name' => $adsetName,
                            ]);
                            $totalSynced += $synced;
                        }
                    }
                } else {
                    $this->warn("Ad account scan notice: " . ($adsResponse->json('error.message') ?? 'Could not list ads directly.'));
                }
            } catch (\Throwable $e) {
                $this->warn("Ad account scan exception: " . $e->getMessage());
            }
        }

        // -------------------------------------------------------------
        // STRATEGY 2: Discover and scan all Facebook Pages accessible by token
        // -------------------------------------------------------------
        $pages = [];
        if ($this->option('page_id')) {
            $pages = [['id' => $this->option('page_id'), 'name' => 'Specified Page']];
        } else {
            $this->info("Discovering all Facebook Pages connected to your Business Portfolio...");
            try {
                $accountsRes = Http::timeout(12)->get("https://graph.facebook.com/v19.0/me/accounts", [
                    'access_token' => $rawToken,
                    'limit' => 100,
                ]);

                if ($accountsRes->successful() && !empty($accountsRes->json('data'))) {
                    $pages = $accountsRes->json('data');
                    $this->info("Discovered " . count($pages) . " Facebook Page(s): " . implode(', ', array_column($pages, 'name')));
                }
            } catch (\Throwable $e) {
                $this->warn("Page discovery notice: " . $e->getMessage());
            }

            // Fallback to Sumatra Sales page if none discovered
            if (empty($pages)) {
                $pages = [
                    ['id' => '1310217108840460', 'name' => 'Sumatra Sales Private Limited']
                ];
            }
        }

        // -------------------------------------------------------------
        // STRATEGY 3: Fetch Leadgen Forms for each Page
        // -------------------------------------------------------------
        if (!empty($directFormId)) {
            if (!in_array($directFormId, $processedFormIds)) {
                $synced = $this->syncLeadsFromForm($directFormId, $rawToken);
                $totalSynced += $synced;
            }
        } else {
            foreach ($pages as $page) {
                $pId = $page['id'];
                $pName = $page['name'] ?? 'Facebook Page';
                $pToken = $page['access_token'] ?? FacebookCapiService::resolvePageAccessToken($rawToken, $pId);

                $this->line("Fetching forms for Page: {$pName} (ID: {$pId})...");

                try {
                    $formsResponse = Http::timeout(15)->get("https://graph.facebook.com/v19.0/{$pId}/leadgen_forms", [
                        'access_token' => $pToken,
                        'limit' => 50,
                    ]);

                    if ($formsResponse->successful()) {
                        $forms = $formsResponse->json('data') ?? [];
                        $this->line("Found " . count($forms) . " form(s) on {$pName}.");

                        foreach ($forms as $form) {
                            $formId = $form['id'];
                            $formName = $form['name'] ?? 'Instant Form';

                            if (!in_array($formId, $processedFormIds)) {
                                $processedFormIds[] = $formId;
                                $this->line("Checking Form: \"{$formName}\" (ID: {$formId})...");
                                $synced = $this->syncLeadsFromForm($formId, $pToken, [
                                    'page_id' => $pId,
                                    'form_name' => $formName,
                                ]);
                                $totalSynced += $synced;
                            }
                        }
                    } else {
                        $this->warn("Could not fetch forms for {$pName}: " . ($formsResponse->json('error.message') ?? ''));
                    }
                } catch (\Throwable $e) {
                    $this->warn("Exception on page {$pName}: " . $e->getMessage());
                }
            }
        }

        $this->info("\n=======================================================");
        $this->info("Completed! Total {$totalSynced} lead(s) synchronized into your CRM database.");
        $this->info("=======================================================\n");

        return 0;
    }

    /**
     * Download and paginate all leads from a single Leadgen Form.
     */
    private function syncLeadsFromForm(string $formId, string $token, array $defaultAttribution = []): int
    {
        $count = 0;
        $nextUrl = "https://graph.facebook.com/v19.0/{$formId}/leads?fields=id,created_time,ad_id,ad_name,adset_id,adset_name,campaign_id,campaign_name,form_id,is_organic,field_data&access_token={$token}&limit=100";
        $pageLimit = 25; // Up to 2,500 leads per form
        $p = 0;

        while ($nextUrl && $p < $pageLimit) {
            $p++;
            try {
                $response = Http::timeout(25)->get($nextUrl);
                if (!$response->successful()) {
                    $this->warn("Failed fetching batch for form {$formId}: " . ($response->json('error.message') ?? ''));
                    break;
                }

                $data = $response->json();
                $leads = $data['data'] ?? [];

                if (empty($leads)) {
                    break;
                }

                foreach ($leads as $leadItem) {
                    $leadgenId = $leadItem['id'];
                    $adId = $leadItem['ad_id'] ?? ($defaultAttribution['ad_id'] ?? null);
                    $adName = $leadItem['ad_name'] ?? ($defaultAttribution['ad_name'] ?? null);
                    $adsetId = $leadItem['adset_id'] ?? ($defaultAttribution['adset_id'] ?? null);
                    $adsetName = $leadItem['adset_name'] ?? ($defaultAttribution['adset_name'] ?? null);
                    $campaignId = $leadItem['campaign_id'] ?? ($defaultAttribution['campaign_id'] ?? null);
                    $campaignName = $leadItem['campaign_name'] ?? ($defaultAttribution['campaign_name'] ?? null);
                    $formName = $defaultAttribution['form_name'] ?? null;
                    $createdAt = isset($leadItem['created_time']) ? \Carbon\Carbon::parse($leadItem['created_time']) : now();

                    $fieldData = collect($leadItem['field_data'] ?? []);
                    $email = null;
                    $phone = null;
                    $fullName = null;

                    foreach ($fieldData as $field) {
                        $name = strtolower($field['name'] ?? '');
                        $val = $field['values'][0] ?? null;

                        if (in_array($name, ['email', 'user_email', 'work_email'])) {
                            $email = $val;
                        } elseif (in_array($name, ['phone_number', 'phone', 'contact_number', 'mobile_number'])) {
                            $phone = $val;
                        } elseif (in_array($name, ['full_name', 'name', 'first_name', 'last_name'])) {
                            if ($name === 'full_name' || empty($fullName)) {
                                $fullName = $val;
                            }
                        }
                    }

                    // Fallback campaign attribution
                    $finalCampaignName = $campaignName ?: ($adName ?: $formName);

                    Lead::updateOrCreate(
                        ['fb_leadgen_id' => $leadgenId],
                        [
                            'page_id'       => $defaultAttribution['page_id'] ?? '1310217108840460',
                            'form_id'       => $formId,
                            'form_name'     => $formName,
                            'ad_id'         => $adId,
                            'ad_name'       => $adName,
                            'adset_id'      => $adsetId,
                            'adset_name'    => $adsetName,
                            'campaign_id'   => $campaignId,
                            'campaign_name' => $finalCampaignName,
                            'name'          => $fullName,
                            'email'         => $email,
                            'phone'         => $phone,
                            'status'        => 'new',
                            'raw_data'      => $leadItem,
                            'created_at'    => $createdAt,
                        ]
                    );

                    $count++;
                }

                $nextUrl = $data['paging']['next'] ?? null;
            } catch (\Throwable $e) {
                $this->warn("Exception while syncing form leads: " . $e->getMessage());
                break;
            }
        }

        return $count;
    }
}
