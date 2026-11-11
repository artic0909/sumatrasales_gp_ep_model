<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FacebookWebhookController extends Controller
{
    /**
     * Webhook Handshake Verification (GET request from Meta).
     */
    public function verify(Request $request)
    {
        $mode = $request->input('hub_mode') 
            ?? $request->input('hub.mode') 
            ?? $request->query('hub_mode') 
            ?? $request->query('hub.mode') 
            ?? ($_GET['hub_mode'] ?? ($_GET['hub.mode'] ?? null));

        $token = $request->input('hub_verify_token') 
            ?? $request->input('hub.verify_token') 
            ?? $request->query('hub_verify_token') 
            ?? $request->query('hub.verify_token') 
            ?? ($_GET['hub_verify_token'] ?? ($_GET['hub.verify_token'] ?? null));

        $challenge = $request->input('hub_challenge') 
            ?? $request->input('hub.challenge') 
            ?? $request->query('hub_challenge') 
            ?? $request->query('hub.challenge') 
            ?? ($_GET['hub_challenge'] ?? ($_GET['hub.challenge'] ?? null));

        $verifyToken = config('services.facebook.webhook_verify_token') 
            ?: (env('FB_WEBHOOK_VERIFY_TOKEN') ?: 'sumatra_sales_fb_verify_token_2026');

        Log::info('[Meta Webhook] Verification attempt received', [
            'mode' => $mode,
            'token_match' => ($token === $verifyToken),
            'token_received' => $token,
            'expected_token' => $verifyToken,
            'ip' => $request->ip(),
        ]);

        if ($mode === 'subscribe' && !empty($verifyToken) && $token === $verifyToken) {
            return response($challenge, 200)->header('Content-Type', 'text/plain');
        }

        Log::warning('[Meta Webhook] Verification failed: token mismatch or invalid mode', [
            'provided_token' => $token,
            'expected_token' => $verifyToken ? 'CONFIGURED' : 'NOT_CONFIGURED',
            'mode' => $mode,
        ]);

        return response('Forbidden', 403);
    }

    /**
     * Leadgen Webhook Listener (POST request from Meta).
     */
    public function handle(Request $request)
    {
        $data = $request->all();

        Log::info('[Meta Webhook] Incoming event received', ['payload' => $data]);

        if (isset($data['entry']) && is_array($data['entry'])) {
            foreach ($data['entry'] as $entry) {
                if (isset($entry['changes']) && is_array($entry['changes'])) {
                    foreach ($entry['changes'] as $change) {
                        if (($change['field'] ?? '') === 'leadgen') {
                            $value = $change['value'] ?? [];
                            $leadgenId = $value['leadgen_id'] ?? null;
                            $adId = $value['ad_id'] ?? null;
                            $formId = $value['form_id'] ?? null;
                            $pageId = $value['page_id'] ?? ($entry['id'] ?? null);

                            if ($leadgenId) {
                                $this->processLead($leadgenId, $adId, $formId, $pageId);
                            }
                        }
                    }
                }
            }
        }

        // Support for Meta Developers Webhook "Test / Send to server" Sample Payload
        if (isset($data['sample']) && is_array($data['sample'])) {
            $sample = $data['sample'];
            if (($sample['field'] ?? '') === 'leadgen') {
                $value = $sample['value'] ?? [];
                $leadgenId = $value['leadgen_id'] ?? null;
                $adId = $value['ad_id'] ?? null;
                $formId = $value['form_id'] ?? null;
                $pageId = $value['page_id'] ?? null;

                if ($leadgenId) {
                    $this->processLead($leadgenId, $adId, $formId, $pageId, true);
                }
            }
        }

        // Meta requires an immediate 200 OK response to confirm delivery
        return response('EVENT_RECEIVED', 200)->header('Content-Type', 'text/plain');
    }

    /**
     * Fetch lead details and ad information from Facebook Graph API and save into the database.
     */
    private function processLead($leadgenId, $adId = null, $formId = null, $pageId = null, bool $isSample = false): void
    {
        $accessToken = config('services.facebook.page_access_token') ?: env('FB_PAGE_ACCESS_TOKEN');

        // If it's a sample test event from Meta Developers test button (dummy ID like 444444444444)
        if ($isSample || $leadgenId === '444444444444' || empty($accessToken)) {
            Log::info('[Meta Webhook] Storing sample test lead in database', [
                'leadgen_id' => $leadgenId,
                'ad_id' => $adId,
                'is_sample' => $isSample,
            ]);

            Lead::updateOrCreate(
                ['fb_leadgen_id' => $leadgenId],
                [
                    'page_id'       => $pageId ?? '444444444444',
                    'form_id'       => $formId ?? '444444444444',
                    'ad_id'         => $adId ?? '444444444',
                    'ad_name'       => 'Meta Sample Test Ad Creative',
                    'campaign_name' => 'Meta Leadgen Sample Campaign',
                    'name'          => 'Meta Test Lead (Sample Submission)',
                    'email'         => 'test.lead@sumatrasales.com',
                    'phone'         => '+919876543210',
                    'status'        => 'new',
                    'raw_data'      => [
                        'field_data' => [
                            ['name' => 'full_name', 'values' => ['Meta Test Lead (Sample Submission)']],
                            ['name' => 'email', 'values' => ['test.lead@sumatrasales.com']],
                            ['name' => 'phone_number', 'values' => ['+919876543210']],
                            ['name' => 'inquiry_topic', 'values' => ['Tested via Meta Webhooks Sample Tool']],
                        ]
                    ],
                ]
            );

            return;
        }

        try {
            $adName = null;
            $adsetId = null;
            $adsetName = null;
            $campaignId = null;
            $campaignName = null;

            // 1. Fetch Ad & Campaign Details if ad_id is available
            if ($adId) {
                $adResponse = Http::timeout(10)->get("https://graph.facebook.com/v19.0/{$adId}", [
                    'fields' => 'id,name,adset_id,campaign_id',
                    'access_token' => $accessToken,
                ]);

                if ($adResponse->successful()) {
                    $adData = $adResponse->json();
                    $adName = $adData['name'] ?? null;
                    $adsetId = $adData['adset_id'] ?? null;
                    $campaignId = $adData['campaign_id'] ?? null;

                    // Fetch Campaign Name
                    if ($campaignId) {
                        $campaignResponse = Http::timeout(5)->get("https://graph.facebook.com/v19.0/{$campaignId}", [
                            'fields' => 'id,name',
                            'access_token' => $accessToken,
                        ]);
                        if ($campaignResponse->successful()) {
                            $campaignName = $campaignResponse->json('name');
                        }
                    }
                } else {
                    Log::warning("[Meta Webhook] Failed to fetch ad details for ad {$adId}: " . $adResponse->body());
                }
            }

            // 2. Fetch Lead Details from Meta Graph API
            $leadResponse = Http::timeout(10)->get("https://graph.facebook.com/v19.0/{$leadgenId}", [
                'fields' => 'id,created_time,ad_id,form_id,field_data',
                'access_token' => $accessToken,
            ]);

            if ($leadResponse->successful()) {
                $leadData = $leadResponse->json();
                $fieldData = collect($leadData['field_data'] ?? []);

                // Extract standard field values
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

                $lead = Lead::updateOrCreate(
                    ['fb_leadgen_id' => $leadgenId],
                    [
                        'page_id'       => $pageId,
                        'form_id'       => $formId ?? ($leadData['form_id'] ?? null),
                        'ad_id'         => $adId ?? ($leadData['ad_id'] ?? null),
                        'ad_name'       => $adName,
                        'adset_id'      => $adsetId,
                        'adset_name'    => $adsetName,
                        'campaign_id'   => $campaignId,
                        'campaign_name' => $campaignName,
                        'name'          => $fullName,
                        'email'         => $email,
                        'phone'         => $phone,
                        'status'        => 'new',
                        'raw_data'      => $leadData,
                    ]
                );

                Log::info("[Meta Webhook] Successfully processed and stored lead #{$lead->id}", [
                    'lead_id' => $lead->id,
                    'fb_leadgen_id' => $leadgenId,
                    'name' => $fullName,
                    'email' => $email,
                    'ad_name' => $adName,
                ]);
            } else {
                Log::error("[Meta Webhook] Failed to fetch lead data for {$leadgenId}: " . $leadResponse->body());
            }
        } catch (\Throwable $e) {
            Log::error("[Meta Webhook] Exception while processing lead {$leadgenId}: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}

