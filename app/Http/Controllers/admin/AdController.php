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

        $viewType = $request->input('view', 'campaigns'); // 'campaigns' or 'ads'
        $cacheKey = 'meta_ads_v2_' . md5(($actId ?? 'none') . ($accessToken ? substr($accessToken, -10) : 'none'));
        $forceRefresh = $request->boolean('refresh');

        if ($forceRefresh) {
            Cache::forget($cacheKey);
        }

        $metaCampaigns = [];
        $metaAds = [];
        $apiError = null;

        if (empty($actId)) {
            $apiError = 'Facebook Ad Account ID is missing. Please set FB_AD_ACCOUNT_ID in your .env file.';
        } elseif (empty($accessToken)) {
            $apiError = 'Facebook Access Token is missing. Please set FB_CAPI_ACCESS_TOKEN or FB_PAGE_ACCESS_TOKEN in your .env file.';
        } else {
            $cachedResult = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($actId, $accessToken) {
                $campaignsData = [];
                $adsData = [];
                $errorMsg = null;

                try {
                    // 1. Fetch Campaigns with maximum date preset insights
                    $campaignsRes = Http::timeout(14)->get("https://graph.facebook.com/v19.0/{$actId}/campaigns", [
                        'fields' => 'id,name,status,effective_status,objective,daily_budget,lifetime_budget,created_time,updated_time,insights.date_preset(maximum){spend,impressions,reach,clicks,cpc,cpm,actions}',
                        'limit' => 100,
                        'access_token' => $accessToken,
                    ]);

                    if ($campaignsRes->successful()) {
                        $campaignsData = $campaignsRes->json('data') ?? [];
                    } else {
                        $errorMsg = $campaignsRes->json('error.message') ?? 'Failed to fetch campaigns from Meta Marketing API';
                        Log::warning('[Meta Campaigns API Error] ' . $campaignsRes->body());
                    }

                    // 2. Fetch Individual Ads with maximum date preset insights
                    $adsRes = Http::timeout(14)->get("https://graph.facebook.com/v19.0/{$actId}/ads", [
                        'fields' => 'id,name,status,effective_status,campaign_id,campaign{id,name},adset_id,adset{id,name},created_time,updated_time,insights.date_preset(maximum){spend,impressions,reach,clicks,cpc,cpm,actions}',
                        'limit' => 100,
                        'access_token' => $accessToken,
                    ]);

                    if ($adsRes->successful()) {
                        $adsData = $adsRes->json('data') ?? [];
                    } elseif (!$errorMsg) {
                        $errorMsg = $adsRes->json('error.message') ?? 'Failed to fetch ads from Meta Marketing API';
                        Log::warning('[Meta Ads API Error] ' . $adsRes->body());
                    }

                    return [
                        'success' => !empty($campaignsData) || !empty($adsData),
                        'campaigns' => $campaignsData,
                        'ads' => $adsData,
                        'error' => (!empty($campaignsData) || !empty($adsData)) ? null : $errorMsg,
                    ];
                } catch (\Throwable $e) {
                    Log::warning('[Meta API Exception] ' . $e->getMessage());
                    return [
                        'success' => false,
                        'campaigns' => [],
                        'ads' => [],
                        'error' => $e->getMessage(),
                    ];
                }
            });

            $metaCampaigns = $cachedResult['campaigns'] ?? [];
            $metaAds = $cachedResult['ads'] ?? [];
            $apiError = $cachedResult['error'] ?? null;
        }

        // Fetch local Lead database statistics aggregated by campaign_name, ad_name, ad_id
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
        $leadsByCampaignName = [];

        foreach ($localLeadStats as $stat) {
            if (!empty($stat->ad_id)) {
                $leadsByAdId[(string)$stat->ad_id] = $stat;
            }
            if (!empty($stat->ad_name)) {
                $leadsByAdName[trim($stat->ad_name)] = $stat;
            }
            if (!empty($stat->campaign_name)) {
                $campKey = trim($stat->campaign_name);
                if (!isset($leadsByCampaignName[$campKey])) {
                    $leadsByCampaignName[$campKey] = (object)[
                        'total_leads' => 0,
                        'good_leads' => 0,
                        'latest_lead_at' => null,
                    ];
                }
                $leadsByCampaignName[$campKey]->total_leads += (int)$stat->total_leads;
                $leadsByCampaignName[$campKey]->good_leads += (int)$stat->good_leads;
                if (!$leadsByCampaignName[$campKey]->latest_lead_at || $stat->latest_lead_at > $leadsByCampaignName[$campKey]->latest_lead_at) {
                    $leadsByCampaignName[$campKey]->latest_lead_at = $stat->latest_lead_at;
                }
            }
        }

        // Helper function to extract Meta results / leads count from actions
        $extractMetaActions = function($insights) {
            $metaLeads = 0;
            $resultsSummary = '';
            if (!empty($insights['actions'])) {
                foreach ($insights['actions'] as $action) {
                    $actionType = $action['action_type'] ?? '';
                    $val = (int)($action['value'] ?? 0);
                    if (in_array($actionType, ['lead', 'onsite_conversion.lead_grouped', 'leadgen_grouped'])) {
                        $metaLeads += $val;
                    }
                    if (empty($resultsSummary)) {
                        if ($actionType === 'lead') {
                            $resultsSummary = number_format($val) . ' Meta leads';
                        } elseif ($actionType === 'video_view') {
                            $resultsSummary = number_format($val) . ' ThruPlays';
                        } elseif ($actionType === 'onsite_conversion.messaging_conversation_started_7d') {
                            $resultsSummary = number_format($val) . ' Chats';
                        } elseif (str_contains($actionType, 'click')) {
                            $resultsSummary = number_format($val) . ' Clicks';
                        }
                    }
                }
            }
            return [$metaLeads, $resultsSummary];
        };

        // Determine which list to process: Campaigns or Ads
        // If view is 'campaigns' or if metaAds is empty but metaCampaigns has data, show Campaigns
        $itemsToProcess = [];
        $isShowingCampaigns = ($viewType === 'campaigns') || (!empty($metaCampaigns) && empty($metaAds));

        if ($isShowingCampaigns && !empty($metaCampaigns)) {
            foreach ($metaCampaigns as $camp) {
                $id = (string)($camp['id'] ?? '');
                $name = (string)($camp['name'] ?? 'Unnamed Campaign');
                $status = strtoupper($camp['status'] ?? 'UNKNOWN');
                $effectiveStatus = strtoupper($camp['effective_status'] ?? $status);

                $insights = $camp['insights']['data'][0] ?? [];
                $spend = (float)($insights['spend'] ?? 0);
                $impressions = (int)($insights['impressions'] ?? 0);
                $reach = (int)($insights['reach'] ?? 0);
                $clicks = (int)($insights['clicks'] ?? 0);
                $cpc = (float)($insights['cpc'] ?? 0);

                [$metaLeads, $resultsSummary] = $extractMetaActions($insights);

                // CRM leads lookup (by campaign name or ad name)
                $crmStat = $leadsByCampaignName[trim($name)] ?? ($leadsByAdName[trim($name)] ?? null);
                $crmLeadsCount = $crmStat ? (int)$crmStat->total_leads : 0;
                $crmGoodLeadsCount = $crmStat ? (int)$crmStat->good_leads : 0;
                $latestLeadAt = $crmStat ? $crmStat->latest_lead_at : null;

                $itemsToProcess[] = [
                    'id' => $id,
                    'name' => $name,
                    'type' => 'CAMPAIGN',
                    'status' => $status,
                    'effective_status' => $effectiveStatus,
                    'campaign_id' => $id,
                    'campaign_name' => $name,
                    'adset_name' => $camp['objective'] ?? 'Ad Campaign',
                    'created_time' => $camp['created_time'] ?? null,
                    'spend' => $spend,
                    'impressions' => $impressions,
                    'reach' => $reach,
                    'clicks' => $clicks,
                    'cpc' => $cpc,
                    'meta_leads' => $metaLeads,
                    'results_summary' => $resultsSummary,
                    'crm_leads_count' => $crmLeadsCount,
                    'crm_good_leads_count' => $crmGoodLeadsCount,
                    'latest_lead_at' => $latestLeadAt,
                    'is_lead_coming' => ($crmLeadsCount > 0 || $metaLeads > 0),
                    'is_local_only' => false,
                ];
            }
        } elseif (!empty($metaAds)) {
            foreach ($metaAds as $ad) {
                $id = (string)($ad['id'] ?? '');
                $name = (string)($ad['name'] ?? 'Unnamed Ad');
                $status = strtoupper($ad['status'] ?? 'UNKNOWN');
                $effectiveStatus = strtoupper($ad['effective_status'] ?? $status);

                $insights = $ad['insights']['data'][0] ?? [];
                $spend = (float)($insights['spend'] ?? 0);
                $impressions = (int)($insights['impressions'] ?? 0);
                $reach = (int)($insights['reach'] ?? 0);
                $clicks = (int)($insights['clicks'] ?? 0);
                $cpc = (float)($insights['cpc'] ?? 0);

                [$metaLeads, $resultsSummary] = $extractMetaActions($insights);

                $crmStat = $leadsByAdId[$id] ?? ($leadsByAdName[trim($name)] ?? ($leadsByCampaignName[trim($ad['campaign']['name'] ?? '')] ?? null));
                $crmLeadsCount = $crmStat ? (int)$crmStat->total_leads : 0;
                $crmGoodLeadsCount = $crmStat ? (int)$crmStat->good_leads : 0;
                $latestLeadAt = $crmStat ? $crmStat->latest_lead_at : null;

                $itemsToProcess[] = [
                    'id' => $id,
                    'name' => $name,
                    'type' => 'AD',
                    'status' => $status,
                    'effective_status' => $effectiveStatus,
                    'campaign_id' => $ad['campaign']['id'] ?? null,
                    'campaign_name' => $ad['campaign']['name'] ?? 'General Campaign',
                    'adset_name' => $ad['adset']['name'] ?? 'Default AdSet',
                    'created_time' => $ad['created_time'] ?? null,
                    'spend' => $spend,
                    'impressions' => $impressions,
                    'reach' => $reach,
                    'clicks' => $clicks,
                    'cpc' => $cpc,
                    'meta_leads' => $metaLeads,
                    'results_summary' => $resultsSummary,
                    'crm_leads_count' => $crmLeadsCount,
                    'crm_good_leads_count' => $crmGoodLeadsCount,
                    'latest_lead_at' => $latestLeadAt,
                    'is_lead_coming' => ($crmLeadsCount > 0 || $metaLeads > 0),
                    'is_local_only' => false,
                ];
            }
        }

        // Merge any local CRM leads groups that haven't been matched
        $existingNames = collect($itemsToProcess)->pluck('name')->map(fn($n) => trim($n))->filter()->all();
        $existingIds = collect($itemsToProcess)->pluck('id')->filter()->all();

        foreach ($localLeadStats as $stat) {
            $hasIdMatch = !empty($stat->ad_id) && in_array((string)$stat->ad_id, $existingIds);
            $hasNameMatch = !empty($stat->ad_name) && in_array(trim($stat->ad_name), $existingNames);
            $hasCampMatch = !empty($stat->campaign_name) && in_array(trim($stat->campaign_name), $existingNames);

            if ($hasIdMatch || $hasNameMatch || $hasCampMatch) {
                continue;
            }

            $displayName = $stat->ad_name ?: ($stat->campaign_name ?: 'Direct / Offline Lead Ads');
            $itemsToProcess[] = [
                'id' => $stat->ad_id ?: ('crm-' . substr(md5($displayName), 0, 8)),
                'name' => $displayName,
                'type' => 'CRM_RECORD',
                'status' => 'LOCAL_ARCHIVE',
                'effective_status' => 'LOCAL_ARCHIVE',
                'campaign_id' => null,
                'campaign_name' => $stat->campaign_name ?: 'Direct / Offline Lead Ads',
                'adset_name' => 'Historical Leads',
                'created_time' => null,
                'spend' => 0,
                'impressions' => 0,
                'reach' => 0,
                'clicks' => 0,
                'cpc' => 0,
                'meta_leads' => (int)$stat->total_leads,
                'results_summary' => $stat->total_leads . ' Leads',
                'crm_leads_count' => (int)$stat->total_leads,
                'crm_good_leads_count' => (int)$stat->good_leads,
                'latest_lead_at' => $stat->latest_lead_at,
                'is_lead_coming' => ($stat->total_leads > 0),
                'is_local_only' => true,
            ];
        }

        $itemsCollection = collect($itemsToProcess);

        // Overall Global KPIs
        $kpis = [
            'total_ads' => $itemsCollection->count(),
            'active_ads' => $itemsCollection->where('effective_status', 'ACTIVE')->count(),
            'total_spend' => $itemsCollection->sum('spend'),
            'total_impressions' => $itemsCollection->sum('impressions'),
            'total_reach' => $itemsCollection->sum('reach'),
            'total_crm_leads' => Lead::count(),
            'ads_with_leads' => $itemsCollection->where('is_lead_coming', true)->count(),
        ];

        // Available campaigns for dropdown filter
        $availableCampaigns = $itemsCollection->pluck('campaign_name')->unique()->filter()->values();

        // Apply Search
        if ($request->filled('search')) {
            $search = strtolower(trim($request->search));
            $itemsCollection = $itemsCollection->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['name']), $search)
                    || str_contains(strtolower((string)$item['id']), $search)
                    || str_contains(strtolower($item['campaign_name']), $search);
            });
        }

        // Apply Delivery Status Filter
        if ($request->filled('status')) {
            $status = strtoupper($request->status);
            if ($status === 'ACTIVE') {
                $itemsCollection = $itemsCollection->where('effective_status', 'ACTIVE');
            } elseif ($status === 'PAUSED') {
                $itemsCollection = $itemsCollection->filter(function ($item) {
                    return in_array($item['effective_status'], ['PAUSED', 'CAMPAIGN_PAUSED', 'ADSET_PAUSED', 'OFF']);
                });
            } elseif ($status === 'ARCHIVED') {
                $itemsCollection = $itemsCollection->filter(function ($item) {
                    return in_array($item['effective_status'], ['ARCHIVED', 'DELETED', 'LOCAL_ARCHIVE']);
                });
            }
        }

        // Apply Lead Coming Filter
        if ($request->filled('lead_status')) {
            if ($request->lead_status === 'coming') {
                $itemsCollection = $itemsCollection->where('is_lead_coming', true);
            } elseif ($request->lead_status === 'none') {
                $itemsCollection = $itemsCollection->where('is_lead_coming', false);
            }
        }

        // Apply Campaign Filter
        if ($request->filled('campaign')) {
            $itemsCollection = $itemsCollection->where('campaign_name', $request->campaign);
        }

        // Sort: Active items first, then items with highest spend/leads
        $items = $itemsCollection->sortByDesc(function ($item) {
            $activeWeight = ($item['effective_status'] === 'ACTIVE') ? 10000000 : 0;
            return $activeWeight + ($item['crm_leads_count'] * 1000) + $item['spend'];
        })->values();

        return view('admin.ads.index', [
            'ads' => $items,
            'kpis' => $kpis,
            'apiError' => $apiError,
            'adAccountId' => $actId,
            'availableCampaigns' => $availableCampaigns,
            'hasToken' => !empty($accessToken),
            'viewType' => $isShowingCampaigns ? 'campaigns' : 'ads',
            'campaignsCount' => count($metaCampaigns),
            'adsCount' => count($metaAds),
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

        $cacheKey = 'meta_ads_v2_' . md5(($actId ?? 'none') . ($accessToken ? substr($accessToken, -10) : 'none'));
        Cache::forget($cacheKey);

        return redirect()->route('admin.ads.index')->with('success', 'Meta Ads performance data refreshed successfully.');
    }
}
