<?php

namespace App\Services;

use App\Models\Lead;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FacebookCapiService
{
    /**
     * Resolve Page Access Token dynamically from either a Page Token or a System User Token.
     */
    public static function resolvePageAccessToken(?string $token = null, string $pageId = '1310217108840460'): ?string
    {
        $rawToken = $token ?: (config('services.facebook.page_access_token') ?: env('FB_PAGE_ACCESS_TOKEN'));
        if (empty($rawToken)) {
            return null;
        }

        try {
            $response = Http::timeout(6)->get("https://graph.facebook.com/v19.0/{$pageId}", [
                'fields' => 'access_token',
                'access_token' => $rawToken,
            ]);

            if ($response->successful() && $response->json('access_token')) {
                return $response->json('access_token');
            }
        } catch (\Throwable $e) {
            Log::warning('[Facebook Token Resolver] Failed to resolve page token: ' . $e->getMessage());
        }

        return $rawToken;
    }

    /**
     * Send Offline / Qualified Lead event to Meta Conversions API (CAPI).
     *
     * @param Lead $lead
     * @param string $eventName Standard Meta Event Name (e.g., 'QualifiedLead', 'Lead')
     * @param array $extraCustomData Additional parameters
     * @return array ['success' => bool, 'response' => array|null, 'error' => string|null]
     */
    public static function sendStatusEvent(Lead $lead, string $eventName = 'QualifiedLead', array $extraCustomData = []): array
    {
        $pixelId = config('services.facebook.pixel_id') ?: env('FB_PIXEL_ID');
        $token = config('services.facebook.capi_access_token') ?: env('FB_CAPI_ACCESS_TOKEN');

        if (empty($pixelId) || empty($token)) {
            $msg = 'Meta CAPI credentials missing: FB_PIXEL_ID or FB_CAPI_ACCESS_TOKEN is not configured in .env';
            Log::warning('[Meta CAPI] ' . $msg);
            return ['success' => false, 'response' => null, 'error' => $msg];
        }

        // 1. Prepare and Hash User Data according to Meta specifications (SHA-256)
        $userData = [];

        // Email normalization: trim, lowercase, sha256
        if (!empty($lead->email)) {
            $normalizedEmail = strtolower(trim($lead->email));
            $userData['em'] = [hash('sha256', $normalizedEmail)];
        }

        // Phone normalization: remove all non-digits, sha256
        if (!empty($lead->phone)) {
            $cleanPhone = preg_replace('/[^0-9]/', '', $lead->phone);
            if (!empty($cleanPhone)) {
                $userData['ph'] = [hash('sha256', $cleanPhone)];
            }
        }

        // First and Last name hashing
        if (!empty($lead->name)) {
            $nameParts = explode(' ', trim($lead->name), 2);
            $firstName = strtolower(trim($nameParts[0]));
            if (!empty($firstName)) {
                $userData['fn'] = [hash('sha256', $firstName)];
            }
            if (isset($nameParts[1])) {
                $lastName = strtolower(trim($nameParts[1]));
                if (!empty($lastName)) {
                    $userData['ln'] = [hash('sha256', $lastName)];
                }
            }
        }

        // External Lead ID
        $userData['external_id'] = [hash('sha256', (string) $lead->id)];

        // Meta Lead ID parameter for Lead Ad Optimization
        if (!empty($lead->fb_leadgen_id)) {
            $userData['lead_id'] = (int) $lead->fb_leadgen_id;
        }

        // 2. Build Event Payload
        $customData = array_merge([
            'lead_status'   => $lead->status,
            'ad_id'         => $lead->ad_id,
            'ad_name'       => $lead->ad_name,
            'adset_id'      => $lead->adset_id,
            'campaign_id'   => $lead->campaign_id,
            'campaign_name' => $lead->campaign_name,
        ], $extraCustomData);

        $payload = [
            'data' => [
                [
                    'event_name'     => $eventName,
                    'event_time'     => time(),
                    'event_id'       => 'lead_' . $lead->id . '_' . time(),
                    'action_source'  => 'system_generated',
                    'user_data'      => $userData,
                    'custom_data'    => array_filter($customData, fn($val) => !is_null($val)),
                ]
            ]
        ];

        try {
            $apiUrl = "https://graph.facebook.com/v19.0/{$pixelId}/events";
            $response = Http::timeout(10)->post($apiUrl . "?access_token={$token}", $payload);

            $body = $response->json();

            if ($response->successful()) {
                Log::info("[Meta CAPI] Event '{$eventName}' successfully delivered for Lead #{$lead->id}", [
                    'lead_id' => $lead->id,
                    'fb_leadgen_id' => $lead->fb_leadgen_id,
                    'response' => $body,
                ]);

                return [
                    'success'  => true,
                    'response' => $body,
                    'error'    => null,
                ];
            }

            $errorMessage = $body['error']['message'] ?? ('HTTP ' . $response->status() . ' - ' . $response->body());
            Log::error("[Meta CAPI] Error sending event for Lead #{$lead->id}: {$errorMessage}", [
                'payload' => $payload,
                'response' => $body,
            ]);

            return [
                'success'  => false,
                'response' => $body,
                'error'    => $errorMessage,
            ];
        } catch (\Throwable $e) {
            Log::error("[Meta CAPI] Exception for Lead #{$lead->id}: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success'  => false,
                'response' => null,
                'error'    => $e->getMessage(),
            ];
        }
    }
}

