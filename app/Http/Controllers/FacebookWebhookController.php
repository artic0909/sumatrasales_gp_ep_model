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
        $mode = $request->query('hub_mode', $request->query('hub.mode'));
        $token = $request->query('hub_verify_token', $request->query('hub.verify_token'));
        $challenge = $request->query('hub_challenge', $request->query('hub.challenge'));

        $verifyToken = env('FB_WEBHOOK_VERIFY_TOKEN');

        Log::info('[Meta Webhook] Verification attempt received', [
            'mode' => $mode,
            'token_match' => ($token === $verifyToken),
            'ip' => $request->ip(),
        ]);

        if ($mode === 'subscribe' && !empty($verifyToken) && $token === $verifyToken) {
            return response($challenge, 200)->header('Content-Type', 'text/plain');
        }

        Log::warning('[Meta Webhook] Verification failed: token mismatch or invalid mode', [
            'provided_token' => $token,
            'expected_token' => $verifyToken ? 'CONFIGURED' : 'NOT_CONFIGURED',
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

        // Meta requires an immediate 200 OK response to confirm delivery
        return response('EVENT_RECEIVED', 200)->header('Content-Type', 'text/plain');
    }

    /**
     * Fetch lead details and ad information from Facebook Graph API and save into the database.
     */
    private function processLead($leadgenId, $adId = null, $formId = null, $pageId = null): void
    {
        $accessToken = env('FB_PAGE_ACCESS_TOKEN');

        if (empty($accessToken)) {
            Log::error('[Meta Webhook] Cannot process lead: FB_PAGE_ACCESS_TOKEN is missing in .env');
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

