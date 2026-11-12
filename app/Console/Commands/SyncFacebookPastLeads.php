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
    protected $description = 'Fetch and backfill historical leads from Meta Lead Ads across all pages, ad campaigns & lead forms.';

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

        $this->info("=======================================================");
        $this->info("Starting Comprehensive Meta Lead Ads Synchronization...");
        $this->info("=======================================================");
        $totalSynced = 0;
        $processedLeadIds = [];
        $processedFormIds = [];

        // -------------------------------------------------------------
        // STRATEGY 1: Fetch all Lead Forms directly from the Ad Account
        // -------------------------------------------------------------
        if ($actId) {
            $this->info("Scanning Ad Account: {$actId} for Lead Forms (/leadgen_forms)...");
            try {
                $formsRes = Http::timeout(20)->get("https://graph.facebook.com/v19.0/{$actId}/leadgen_forms", [
                    'fields' => 'id,name,status,leads_count,page_id,page{id,name}',
                    'limit' => 100,
                    'access_token' => $rawToken,
                ]);

                if ($formsRes->successful()) {
                    $accountForms = $formsRes->json('data') ?? [];
                    $this->info("Found " . count($accountForms) . " form(s) registered in Ad Account {$actId}.");

                    foreach ($accountForms as $form) {
                        $fId = $form['id'];
                        $fName = $form['name'] ?? 'Lead Form';
                        $pageName = $form['page']['name'] ?? ($form['page_id'] ?? 'Meta Page');
                        $leadsCount = $form['leads_count'] ?? '?';

                        $processedFormIds[] = $fId;
                        $this->line("Fetching leads for Form: \"{$fName}\" (Page: {$pageName}, Leads: {$leadsCount})...");

                        $synced = $this->syncLeadsEndpoint("https://graph.facebook.com/v19.0/{$fId}/leads", $rawToken, [
                            'form_id' => $fId,
                            'form_name' => $fName,
                            'page_id' => $form['page']['id'] ?? ($form['page_id'] ?? null),
                            'campaign_name' => $fName,
                        ], $processedLeadIds);

                        $totalSynced += $synced;
                        $this->info("  -> Imported {$synced} lead(s) from \"{$fName}\".");
                    }
                } else {
                    $this->line("Ad Account leadgen_forms notice: " . ($formsRes->json('error.message') ?? 'Not supported'));
                }
            } catch (\Throwable $e) {
                $this->warn("Ad account forms scan exception: " . $e->getMessage());
            }
        }

        // -------------------------------------------------------------
        // STRATEGY 2: Fetch Leads directly for each Ad (/ad_id/leads) & Creative Forms
        // -------------------------------------------------------------
        if ($actId) {
            $this->info("Scanning all Ads in {$actId} for Direct Ad Leads & Attached Forms...");
            try {
                $adsResponse = Http::timeout(20)->get("https://graph.facebook.com/v19.0/{$actId}/ads", [
                    'fields' => 'id,name,campaign{id,name},adset{id,name},creative{id,name,object_story_spec,asset_feed_spec}',
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

                        // Try extracting lead_gen_form_id from creative object_story_spec
                        $creative = $ad['creative'] ?? [];
                        $creativeFormId = $creative['object_story_spec']['link_data']['call_to_action']['value']['lead_gen_form_id'] ?? null;

                        if ($creativeFormId && !in_array($creativeFormId, $processedFormIds)) {
                            $processedFormIds[] = $creativeFormId;
                            $this->line("Found Form {$creativeFormId} in creative for Ad \"{$adName}\"...");
                            $synced = $this->syncLeadsEndpoint("https://graph.facebook.com/v19.0/{$creativeFormId}/leads", $rawToken, [
                                'form_id' => $creativeFormId,
                                'ad_id' => $adId,
                                'ad_name' => $adName,
                                'campaign_id' => $campaignId,
                                'campaign_name' => $campaignName,
                                'adset_id' => $adsetId,
                                'adset_name' => $adsetName,
                            ], $processedLeadIds);
                            $totalSynced += $synced;
                        }

                        // Also query direct /{ad_id}/leads
                        if ($adId) {
                            $this->line("Checking direct leads for Ad: \"{$adName}\" (ID: {$adId})...");
                            $synced = $this->syncLeadsEndpoint("https://graph.facebook.com/v19.0/{$adId}/leads", $rawToken, [
                                'ad_id' => $adId,
                                'ad_name' => $adName,
                                'campaign_id' => $campaignId,
                                'campaign_name' => $campaignName,
                                'adset_id' => $adsetId,
                                'adset_name' => $adsetName,
                            ], $processedLeadIds);

                            if ($synced > 0) {
                                $this->info("  -> Found & synced {$synced} lead(s) directly from Ad \"{$adName}\"!");
                                $totalSynced += $synced;
                            }
                        }
                    }
                }
            } catch (\Throwable $e) {
                $this->warn("Ad level scan exception: " . $e->getMessage());
            }

            // Also check direct /{campaign_id}/leads for any Lead Gen campaigns
            $this->info("Scanning Campaigns in {$actId} for Direct Campaign Leads...");
            try {
                $campsRes = Http::timeout(20)->get("https://graph.facebook.com/v19.0/{$actId}/campaigns", [
                    'fields' => 'id,name,objective',
                    'limit' => 100,
                    'access_token' => $rawToken,
                ]);

                if ($campsRes->successful()) {
                    $campaigns = $campsRes->json('data') ?? [];
                    foreach ($campaigns as $camp) {
                        $cId = $camp['id'] ?? null;
                        $cName = $camp['name'] ?? null;

                        if ($cId) {
                            $synced = $this->syncLeadsEndpoint("https://graph.facebook.com/v19.0/{$cId}/leads", $rawToken, [
                                'campaign_id' => $cId,
                                'campaign_name' => $cName,
                            ], $processedLeadIds);

                            if ($synced > 0) {
                                $this->info("  -> Found & synced {$synced} lead(s) directly from Campaign \"{$cName}\"!");
                                $totalSynced += $synced;
                            }
                        }
                    }
                }
            } catch (\Throwable $e) {
                $this->warn("Campaign level scan exception: " . $e->getMessage());
            }
        }

        // -------------------------------------------------------------
        // STRATEGY 3: Discover all Business Pages and fetch their Forms
        // -------------------------------------------------------------
        $pages = [];
        if ($this->option('page_id')) {
            $pages = [['id' => $this->option('page_id'), 'name' => 'Specified Page']];
        } else {
            $this->info("Discovering all Facebook Pages in Business Portfolio...");
            
            // Try /me/accounts
            try {
                $accRes = Http::timeout(10)->get("https://graph.facebook.com/v19.0/me/accounts", [
                    'fields' => 'id,name,access_token',
                    'limit' => 100,
                    'access_token' => $rawToken,
                ]);
                if ($accRes->successful() && !empty($accRes->json('data'))) {
                    foreach ($accRes->json('data') as $p) {
                        $pages[$p['id']] = $p;
                    }
                }
            } catch (\Throwable $e) {}

            // Try /me/businesses to get all owned and client pages
            try {
                $bizRes = Http::timeout(10)->get("https://graph.facebook.com/v19.0/me/businesses", [
                    'fields' => 'id,name',
                    'access_token' => $rawToken,
                ]);
                if ($bizRes->successful() && !empty($bizRes->json('data'))) {
                    foreach ($bizRes->json('data') as $biz) {
                        $bizId = $biz['id'];
                        // Owned pages
                        $ownedRes = Http::timeout(10)->get("https://graph.facebook.com/v19.0/{$bizId}/owned_pages", [
                            'fields' => 'id,name,access_token',
                            'limit' => 50,
                            'access_token' => $rawToken,
                        ]);
                        if ($ownedRes->successful() && !empty($ownedRes->json('data'))) {
                            foreach ($ownedRes->json('data') as $p) {
                                $pages[$p['id']] = $p;
                            }
                        }
                        // Client pages
                        $clientRes = Http::timeout(10)->get("https://graph.facebook.com/v19.0/{$bizId}/client_pages", [
                            'fields' => 'id,name,access_token',
                            'limit' => 50,
                            'access_token' => $rawToken,
                        ]);
                        if ($clientRes->successful() && !empty($clientRes->json('data'))) {
                            foreach ($clientRes->json('data') as $p) {
                                $pages[$p['id']] = $p;
                            }
                        }
                    }
                }
            } catch (\Throwable $e) {}

            // Known default Page fallback
            if (!isset($pages['1310217108840460'])) {
                $pages['1310217108840460'] = ['id' => '1310217108840460', 'name' => 'Sumatra Sales Private Limited'];
            }

            $this->info("Discovered " . count($pages) . " Facebook Page(s): " . implode(', ', array_column($pages, 'name')));
        }

        // Fetch forms for each discovered page
        foreach ($pages as $pId => $page) {
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
                    foreach ($forms as $form) {
                        $fId = $form['id'];
                        $fName = $form['name'] ?? 'Instant Form';

                        if (!in_array($fId, $processedFormIds)) {
                            $processedFormIds[] = $fId;
                            $this->line("Checking Form: \"{$fName}\" (ID: {$fId}) on {$pName}...");
                            $synced = $this->syncLeadsEndpoint("https://graph.facebook.com/v19.0/{$fId}/leads", $pToken, [
                                'page_id' => $pId,
                                'form_id' => $fId,
                                'form_name' => $fName,
                                'campaign_name' => $fName,
                            ], $processedLeadIds);
                            $totalSynced += $synced;
                        }
                    }
                }
            } catch (\Throwable $e) {}
        }

        $totalInDatabase = Lead::count();
        $this->info("\n=======================================================");
        $this->info("Completed! Total {$totalSynced} new/updated lead(s) synced.");
        $this->info("Current Total Leads in your CRM Database: {$totalInDatabase}");
        $this->info("=======================================================\n");

        return 0;
    }

    /**
     * Download and paginate leads from any Meta Graph API leads endpoint.
     */
    private function syncLeadsEndpoint(string $endpointUrl, string $token, array $defaultAttribution, array &$processedLeadIds): int
    {
        $count = 0;
        $separator = str_contains($endpointUrl, '?') ? '&' : '?';
        $nextUrl = "{$endpointUrl}{$separator}fields=id,created_time,ad_id,ad_name,adset_id,adset_name,campaign_id,campaign_name,form_id,is_organic,field_data&access_token={$token}&limit=100";
        $pageLimit = 25; // Up to 2,500 leads
        $p = 0;

        while ($nextUrl && $p < $pageLimit) {
            $p++;
            try {
                $response = Http::timeout(25)->get($nextUrl);
                if (!$response->successful()) {
                    break;
                }

                $data = $response->json();
                $leads = $data['data'] ?? [];

                if (empty($leads)) {
                    break;
                }

                foreach ($leads as $leadItem) {
                    $leadgenId = (string)($leadItem['id'] ?? '');
                    if (empty($leadgenId)) {
                        continue;
                    }

                    $adId = $leadItem['ad_id'] ?? ($defaultAttribution['ad_id'] ?? null);
                    $adName = $leadItem['ad_name'] ?? ($defaultAttribution['ad_name'] ?? null);
                    $adsetId = $leadItem['adset_id'] ?? ($defaultAttribution['adset_id'] ?? null);
                    $adsetName = $leadItem['adset_name'] ?? ($defaultAttribution['adset_name'] ?? null);
                    $campaignId = $leadItem['campaign_id'] ?? ($defaultAttribution['campaign_id'] ?? null);
                    $campaignName = $leadItem['campaign_name'] ?? ($defaultAttribution['campaign_name'] ?? null);
                    $formId = $leadItem['form_id'] ?? ($defaultAttribution['form_id'] ?? null);
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

                    $finalCampaignName = $campaignName ?: ($adName ?: ($formName ?: 'Meta Lead Campaign'));

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

                    $processedLeadIds[$leadgenId] = true;
                    $count++;
                }

                $nextUrl = $data['paging']['next'] ?? null;
            } catch (\Throwable $e) {
                break;
            }
        }

        return $count;
    }
}
