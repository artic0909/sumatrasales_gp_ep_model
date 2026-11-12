<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AdController extends Controller
{
    /**
     * Display Facebook / Meta Ads dashboard with spend, delivery status, lead attribution & filters.
     */
    public function index(Request $request)
    {
        $accountId = config('services.facebook.ad_account_id') ?: env('FB_AD_ACCOUNT_ID');
        $actId = !empty($accountId) ? (str_starts_with((string)$accountId, 'act_') ? $accountId : 'act_' . $accountId) : null;
        $accessToken = config('services.facebook.capi_access_token') 
            ?: config('services.facebook.page_access_token') 
            ?: env('FB_CAPI_ACCESS_TOKEN') 
            ?: env('FB_PAGE_ACCESS_TOKEN');

        $cacheKey = 'meta_ads_list_' . md5(($actId ?? 'none') . ($accessToken ? substr($accessToken, -10) : 'none'));
        $forceRefresh = $request->boolean('refresh');

        if ($forceRefresh) {
            Cache::forget($cacheKey);
        }

        $metaAds = [];
        $apiError = null;

        if (empty($actId)) {
            $apiError = 'Facebook Ad Account ID is missing. Please set FB_AD_ACCOUNT_ID in your .env file.';
        } elseif (empty($accessToken)) {
            $apiError = 'Facebook Access Token is missing. Please set FB_CAPI_ACCESS_TOKEN or FB_PAGE_ACCESS_TOKEN in your .env file.';
        } else {
            $cachedResult = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($actId, $accessToken) {
                try {
                    $response = Http::timeout(12)->get("https://graph.facebook.com/v19.0/{$actId}/ads", [
                        'fields' => 'id,name,status,effective_status,campaign_id,campaign{id,name},adset_id,adset{id,name},created_time,updated_time,insights.date_preset(maximum){spend,impressions,reach,clicks,cpc,cpm,actions}',
                        'limit' => 100,
                        'access_token' => $accessToken,
                    ]);

                    if ($response->successful()) {
                        return [
                            'success' => true,
                            'data' => $response->json('data') ?? [],
                            'error' => null,
                        ];
                    }

                    $err = $response->json('error.message') ?? 'Failed to fetch ads from Meta API';
                    Log::warning('[Meta Ads API Error] ' . $response->body());
                    return [
                        'success' => false,
                        'data' => [],
                        'error' => $err,
                    ];
                } catch (\Throwable $e) {
                    Log::warning('[Meta Ads API Exception] ' . $e->getMessage());
                    return [
                        'success' => false,
                        'data' => [],
                        'error' => $e->getMessage(),
                    ];
                }
            });

            $metaAds = $cachedResult['data'] ?? [];
            $apiError = $cachedResult['error'] ?? null;
        }

        // Fetch local Lead database statistics aggregated by ad_id and ad_name
        $localLeadStats = Lead::selectRaw('
            COALESCE(ad_id, "") as ad_id,
            COALESCE(ad_name, "") as ad_name,
            COALESCE(campaign_name, "") as campaign_name,
            count(*) as total_leads,
            sum(case when status = "good_lead" then 1 else 0 end) as good_leads,
            max(created_at) as latest_lead_at
        ')
        ->groupBy('ad_id', 'ad_name', 'campaign_name')
        ->get();

        $leadsByAdId = [];
        $leadsByAdName = [];
        foreach ($localLeadStats as $stat) {
            if (!empty($stat->ad_id)) {
                $leadsByAdId[(string)$stat->ad_id] = $stat;
            }
            if (!empty($stat->ad_name)) {
                $leadsByAdName[trim($stat->ad_name)] = $stat;
            }
        }

        // Process Meta Ads and enrich with CRM stats
        $processedAds = [];
        foreach ($metaAds as $ad) {
            $adId = (string)($ad['id'] ?? '');
            $adName = (string)($ad['name'] ?? 'Unnamed Ad');
            $status = strtoupper($ad['status'] ?? 'UNKNOWN');
            $effectiveStatus = strtoupper($ad['effective_status'] ?? $status);

            // Insights
            $insights = $ad['insights']['data'][0] ?? [];
            $spend = (float)($insights['spend'] ?? 0);
            $impressions = (int)($insights['impressions'] ?? 0);
            $reach = (int)($insights['reach'] ?? 0);
            $clicks = (int)($insights['clicks'] ?? 0);
            $cpc = (float)($insights['cpc'] ?? 0);

            // Extract Meta Leads action count if available
            $metaLeads = 0;
            if (!empty($insights['actions'])) {
                foreach ($insights['actions'] as $action) {
                    $actionType = $action['action_type'] ?? '';
                    if (in_array($actionType, ['lead', 'onsite_conversion.lead_grouped', 'leadgen_grouped'])) {
                        $metaLeads += (int)($action['value'] ?? 0);
                    }
                }
            }

            // Cross reference with CRM Leads
            $crmStat = $leadsByAdId[$adId] ?? ($leadsByAdName[trim($adName)] ?? null);
            $crmLeadsCount = $crmStat ? (int)$crmStat->total_leads : 0;
            $crmGoodLeadsCount = $crmStat ? (int)$crmStat->good_leads : 0;
            $latestLeadAt = $crmStat ? $crmStat->latest_lead_at : null;

            $processedAds[] = [
                'id' => $adId,
                'name' => $adName,
                'status' => $status,
                'effective_status' => $effectiveStatus,
                'campaign_id' => $ad['campaign']['id'] ?? ($ad['campaign_id'] ?? null),
                'campaign_name' => $ad['campaign']['name'] ?? 'General Campaign',
                'adset_id' => $ad['adset']['id'] ?? null,
                'adset_name' => $ad['adset']['name'] ?? 'Default AdSet',
                'created_time' => $ad['created_time'] ?? null,
                'spend' => $spend,
                'impressions' => $impressions,
                'reach' => $reach,
                'clicks' => $clicks,
                'cpc' => $cpc,
                'meta_leads' => $metaLeads,
                'crm_leads_count' => $crmLeadsCount,
                'crm_good_leads_count' => $crmGoodLeadsCount,
                'latest_lead_at' => $latestLeadAt,
                'is_lead_coming' => ($crmLeadsCount > 0),
                'is_local_only' => false,
            ];
        }

        // Merge any local ads that weren't returned by Meta API
        $existingAdIds = collect($processedAds)->pluck('id')->filter()->all();
        $existingAdNames = collect($processedAds)->pluck('name')->map(fn($n) => trim($n))->filter()->all();

        foreach ($localLeadStats as $stat) {
            $hasIdMatch = !empty($stat->ad_id) && in_array((string)$stat->ad_id, $existingAdIds);
            $hasNameMatch = !empty($stat->ad_name) && in_array(trim($stat->ad_name), $existingAdNames);

            if ($hasIdMatch || $hasNameMatch) {
                continue;
            }

            $processedAds[] = [
                'id' => $stat->ad_id ?: ('local-' . substr(md5($stat->ad_name), 0, 10)),
                'name' => $stat->ad_name ?: 'Unknown Facebook Ad',
                'status' => 'LOCAL_ARCHIVE',
                'effective_status' => 'LOCAL_ARCHIVE',
                'campaign_id' => null,
                'campaign_name' => $stat->campaign_name ?: 'Direct / Offline Lead Ads',
                'adset_id' => null,
                'adset_name' => 'Historical Leads',
                'created_time' => null,
                'spend' => 0,
                'impressions' => 0,
                'reach' => 0,
                'clicks' => 0,
                'cpc' => 0,
                'meta_leads' => (int)$stat->total_leads,
                'crm_leads_count' => (int)$stat->total_leads,
                'crm_good_leads_count' => (int)$stat->good_leads,
                'latest_lead_at' => $stat->latest_lead_at,
                'is_lead_coming' => ($stat->total_leads > 0),
                'is_local_only' => true,
            ];
        }

        $adsCollection = collect($processedAds);

        // Overall Global KPIs before filtering
        $kpis = [
            'total_ads' => $adsCollection->count(),
            'active_ads' => $adsCollection->where('effective_status', 'ACTIVE')->count(),
            'total_spend' => $adsCollection->sum('spend'),
            'total_impressions' => $adsCollection->sum('impressions'),
            'total_reach' => $adsCollection->sum('reach'),
            'total_crm_leads' => $adsCollection->sum('crm_leads_count'),
            'ads_with_leads' => $adsCollection->where('is_lead_coming', true)->count(),
        ];

        // Available campaigns for dropdown filter
        $availableCampaigns = $adsCollection->pluck('campaign_name')->unique()->filter()->values();

        // Apply Search
        if ($request->filled('search')) {
            $search = strtolower(trim($request->search));
            $adsCollection = $adsCollection->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['name']), $search)
                    || str_contains(strtolower((string)$item['id']), $search)
                    || str_contains(strtolower($item['campaign_name']), $search)
                    || str_contains(strtolower($item['adset_name']), $search);
            });
        }

        // Apply Delivery Status Filter
        if ($request->filled('status')) {
            $status = strtoupper($request->status);
            if ($status === 'ACTIVE') {
                $adsCollection = $adsCollection->where('effective_status', 'ACTIVE');
            } elseif ($status === 'PAUSED') {
                $adsCollection = $adsCollection->filter(function ($item) {
                    return in_array($item['effective_status'], ['PAUSED', 'CAMPAIGN_PAUSED', 'ADSET_PAUSED', 'OFF']);
                });
            } elseif ($status === 'ARCHIVED') {
                $adsCollection = $adsCollection->filter(function ($item) {
                    return in_array($item['effective_status'], ['ARCHIVED', 'DELETED', 'LOCAL_ARCHIVE']);
                });
            }
        }

        // Apply Lead Coming Filter
        if ($request->filled('lead_status')) {
            if ($request->lead_status === 'coming') {
                $adsCollection = $adsCollection->where('is_lead_coming', true);
            } elseif ($request->lead_status === 'none') {
                $adsCollection = $adsCollection->where('is_lead_coming', false);
            }
        }

        // Apply Campaign Filter
        if ($request->filled('campaign')) {
            $adsCollection = $adsCollection->where('campaign_name', $request->campaign);
        }

        // Sort: Active ads first, then ads with highest CRM leads
        $ads = $adsCollection->sortByDesc(function ($item) {
            $activeWeight = ($item['effective_status'] === 'ACTIVE') ? 1000000 : 0;
            return $activeWeight + ($item['crm_leads_count'] * 100) + $item['spend'];
        })->values();

        return view('admin.ads.index', [
            'ads' => $ads,
            'kpis' => $kpis,
            'apiError' => $apiError,
            'adAccountId' => $actId,
            'availableCampaigns' => $availableCampaigns,
            'hasToken' => !empty($accessToken),
        ]);
    }

    /**
     * Bust cache and force refresh Meta Ads data.
     */
    public function refresh(Request $request)
    {
        $accountId = config('services.facebook.ad_account_id') ?: env('FB_AD_ACCOUNT_ID');
        $actId = !empty($accountId) ? (str_starts_with((string)$accountId, 'act_') ? $accountId : 'act_' . $accountId) : null;
        $accessToken = config('services.facebook.capi_access_token') 
            ?: config('services.facebook.page_access_token') 
            ?: env('FB_CAPI_ACCESS_TOKEN') 
            ?: env('FB_PAGE_ACCESS_TOKEN');

        $cacheKey = 'meta_ads_list_' . md5(($actId ?? 'none') . ($accessToken ? substr($accessToken, -10) : 'none'));
        Cache::forget($cacheKey);

        return redirect()->route('admin.ads.index')->with('success', 'Meta Ads performance data refreshed successfully.');
    }
}

