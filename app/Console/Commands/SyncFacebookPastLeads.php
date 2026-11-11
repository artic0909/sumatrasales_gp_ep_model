<?php

namespace App\Console\Commands;

use App\Models\Lead;
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
    protected $signature = 'fb:sync-past-leads {--page_id=1310217108840460}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all historical past leads from Facebook Instant Forms via Graph API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $accessToken = config('services.facebook.page_access_token') ?: env('FB_PAGE_ACCESS_TOKEN');

        if (empty($accessToken)) {
            $this->error('FB_PAGE_ACCESS_TOKEN is missing in .env or config.');
            return 1;
        }

        $pageId = $this->option('page_id') ?: '1310217108840460';
        $this->info("Fetching Instant Forms for Page ID: {$pageId}...");

        // 1. Fetch all Leadgen Forms belonging to the Page
        $formsResponse = Http::timeout(15)->get("https://graph.facebook.com/v19.0/{$pageId}/leadgen_forms", [
            'access_token' => $accessToken,
            'limit' => 50,
        ]);

        if (!$formsResponse->successful()) {
            $this->error('Failed to fetch forms: ' . $formsResponse->body());
            return 1;
        }

        $forms = $formsResponse->json('data') ?? [];
        $this->info("Found " . count($forms) . " Instant Form(s). Fetching leads...");

        $totalSynced = 0;

        foreach ($forms as $form) {
            $formId = $form['id'];
            $formName = $form['name'] ?? 'Instant Form';
            $this->line("Checking Form: {$formName} (ID: {$formId})...");

            $nextUrl = "https://graph.facebook.com/v19.0/{$formId}/leads?fields=id,created_time,ad_id,form_id,field_data&access_token={$accessToken}&limit=100";

            while ($nextUrl) {
                $leadsResponse = Http::timeout(20)->get($nextUrl);

                if (!$leadsResponse->successful()) {
                    $this->warn("Failed to fetch leads for form {$formId}: " . $leadsResponse->body());
                    break;
                }

                $leadsData = $leadsResponse->json();
                $leads = $leadsData['data'] ?? [];

                foreach ($leads as $leadItem) {
                    $leadgenId = $leadItem['id'];
                    $adId = $leadItem['ad_id'] ?? null;
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

                    // Optional Ad title fetch
                    $adName = null;
                    if ($adId) {
                        $adRes = Http::timeout(5)->get("https://graph.facebook.com/v19.0/{$adId}?fields=name&access_token={$accessToken}");
                        if ($adRes->successful()) {
                            $adName = $adRes->json('name');
                        }
                    }

                    Lead::updateOrCreate(
                        ['fb_leadgen_id' => $leadgenId],
                        [
                            'page_id'       => $pageId,
                            'form_id'       => $formId,
                            'ad_id'         => $adId,
                            'ad_name'       => $adName,
                            'name'          => $fullName,
                            'email'         => $email,
                            'phone'         => $phone,
                            'status'        => 'new',
                            'raw_data'      => $leadItem,
                            'created_at'    => $createdAt,
                        ]
                    );

                    $totalSynced++;
                }

                $nextUrl = $leadsData['paging']['next'] ?? null;
            }
        }

        $this->info("Completed! Total {$totalSynced} past lead(s) synchronized into your CRM database.");
        return 0;
    }
}

