<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Models\Lead;
use App\Models\Partner;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display the Admin Dashboard with key statistics, traffic graphs, and visitor logs.
     */
    public function index()
    {
        // 1. Partner Metrics
        $totalPartners = Partner::count();
        $totalEp       = Partner::where('registration_type', Partner::REGISTRATION_TYPE_EP)->count();
        $totalGp       = Partner::where('registration_type', Partner::REGISTRATION_TYPE_GP)->count();
        $todayPartners = Partner::whereDate('created_at', Carbon::today())->count();
        $latestPartners = Partner::latest()->take(6)->get();

        $epPercentage = $totalPartners > 0 ? round(($totalEp / $totalPartners) * 100) : 50;
        $gpPercentage = $totalPartners > 0 ? (100 - $epPercentage) : 50;

        // Top states breakdown
        $topStates = Partner::selectRaw('state, count(*) as count')
            ->whereNotNull('state')
            ->groupBy('state')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        // 2. Visitor & Traffic Metrics
        $totalVisits = Visitor::count();
        $totalUniqueIps = Visitor::distinct('ip_address')->count('ip_address');
        $todayVisits = Visitor::today()->count();
        $todayUniqueIps = Visitor::today()->distinct('ip_address')->count('ip_address');

        // Conversion Rate (Partner Registrations vs Unique Visitors)
        $conversionRate = $totalUniqueIps > 0 ? round(($totalPartners / $totalUniqueIps) * 100, 1) : 0;

        // 3. Last 7 Days Traffic Trend for Chart.js
        $chartLabels = [];
        $chartVisits = [];
        $chartUniqueIps = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dateString = $date->toDateString();
            $label = $date->format('M d');

            $dayVisits = Visitor::whereDate('visited_at', $dateString)->count();
            $dayUniqueIps = Visitor::whereDate('visited_at', $dateString)->distinct('ip_address')->count('ip_address');

            $chartLabels[] = $label;
            $chartVisits[] = $dayVisits;
            $chartUniqueIps[] = $dayUniqueIps;
        }

        // 4. Device Distribution
        $deviceBreakdown = Visitor::selectRaw('device, count(*) as total')
            ->groupBy('device')
            ->orderByDesc('total')
            ->pluck('total', 'device')
            ->toArray();

        $desktopCount = $deviceBreakdown['Desktop'] ?? 0;
        $mobileCount  = $deviceBreakdown['Mobile'] ?? 0;
        $tabletCount  = $deviceBreakdown['Tablet'] ?? 0;
        $totalDevices = $desktopCount + $mobileCount + $tabletCount;

        $desktopPct = $totalDevices > 0 ? round(($desktopCount / $totalDevices) * 100) : 0;
        $mobilePct  = $totalDevices > 0 ? round(($mobileCount / $totalDevices) * 100) : 0;
        $tabletPct  = $totalDevices > 0 ? round(($tabletCount / $totalDevices) * 100) : 0;

        // 5. Recent Visitor Logs (Latest 8)
        $recentVisitors = Visitor::latest('visited_at')->take(8)->get();

        // Inbound Inquiries
        $totalInquiries = ContactInquiry::count();
        $unreadInquiries = ContactInquiry::where('status', 'unread')->count();

        // 6. Meta Ads & Lead Generation Metrics
        $totalLeads = Lead::count();
        $todayLeads = Lead::whereDate('created_at', Carbon::today())->count();
        $newLeads = Lead::where('status', 'new')->count();
        $goodLeads = Lead::whereIn('status', ['good', 'good_lead', 'qualified'])->count();
        $badLeads = Lead::where('status', 'bad')->count();
        $syncedLeads = Lead::where('synced_to_fb', true)->count();
        $latestLeads = Lead::latest()->take(5)->get();

        // Meta Ads Marketing API Live / Cached Insights
        $rawActId = env('FB_AD_ACCOUNT_ID', config('services.facebook.ad_account_id', ''));
        $actId = !empty($rawActId) ? (str_starts_with($rawActId, 'act_') ? $rawActId : 'act_' . $rawActId) : '';
        $accessToken = env('FB_CAPI_ACCESS_TOKEN', config('services.facebook.capi_access_token', env('FB_PAGE_ACCESS_TOKEN')));

        $metaTotalSpend = 0.0;
        $metaTotalReach = 0;
        $metaTotalImpressions = 0;
        $metaActiveCampaigns = 0;
        $metaTotalCampaigns = 0;

        if (!empty($actId) && !empty($accessToken)) {
            $cachedResult = Cache::remember("meta_ads_overview_{$actId}", now()->addMinutes(10), function () use ($actId, $accessToken) {
                try {
                    $campaignsRes = Http::timeout(8)->get("https://graph.facebook.com/v19.0/{$actId}/campaigns", [
                        'fields' => 'id,name,status,effective_status,insights.date_preset(maximum){spend,impressions,reach}',
                        'limit' => 50,
                        'access_token' => $accessToken,
                    ]);
                    $campaignsData = $campaignsRes->successful() ? ($campaignsRes->json('data') ?? []) : [];
                    return [
                        'success' => !empty($campaignsData),
                        'campaigns' => $campaignsData,
                    ];
                } catch (\Throwable $e) {
                    return ['success' => false, 'campaigns' => []];
                }
            });

            $campaigns = $cachedResult['campaigns'] ?? [];
            $metaTotalCampaigns = count($campaigns);
            foreach ($campaigns as $camp) {
                $effStatus = strtoupper($camp['effective_status'] ?? $camp['status'] ?? '');
                if ($effStatus === 'ACTIVE') {
                    $metaActiveCampaigns++;
                }
                $insights = $camp['insights']['data'][0] ?? [];
                $metaTotalSpend += (float)($insights['spend'] ?? 0);
                $metaTotalReach += (int)($insights['reach'] ?? 0);
                $metaTotalImpressions += (int)($insights['impressions'] ?? 0);
            }
        }

        // Cost Per Lead (CPL)
        $avgCostPerLead = ($totalLeads > 0 && $metaTotalSpend > 0) ? round($metaTotalSpend / $totalLeads, 2) : 0;

        // 7. Last 7 Days Daily Leads Trend for Chart.js
        $leadChartLabels = [];
        $leadChartCounts = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dateString = $date->toDateString();
            $leadChartLabels[] = $date->format('M d');
            $leadChartCounts[] = Lead::whereDate('created_at', $dateString)->count();
        }

        // 8. Top Performing Lead Campaigns Breakdown for Chart.js
        $campaignLeadStats = Lead::selectRaw('
                CASE 
                    WHEN campaign_name IS NOT NULL AND TRIM(campaign_name) != "" THEN campaign_name
                    WHEN form_name IS NOT NULL AND TRIM(form_name) != "" THEN form_name
                    ELSE "Direct / Form Leads"
                END as source_name,
                count(*) as total
            ')
            ->groupBy('source_name')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $campaignChartLabels = [];
        $campaignChartData = [];
        foreach ($campaignLeadStats as $stat) {
            $cleaned = preg_replace('/^Post:\s*"?|"?$/u', '', $stat->source_name);
            $cleaned = mb_substr($cleaned, 0, 22) . (mb_strlen($cleaned) > 22 ? '...' : '');
            $campaignChartLabels[] = $cleaned ?: 'General Campaign';
            $campaignChartData[] = (int)$stat->total;
        }

        return view('admin.dashboard.index', compact(
            'totalPartners',
            'totalEp',
            'totalGp',
            'todayPartners',
            'latestPartners',
            'epPercentage',
            'gpPercentage',
            'topStates',
            'totalVisits',
            'totalUniqueIps',
            'todayVisits',
            'todayUniqueIps',
            'conversionRate',
            'chartLabels',
            'chartVisits',
            'chartUniqueIps',
            'desktopPct',
            'mobilePct',
            'tabletPct',
            'recentVisitors',
            'totalInquiries',
            'unreadInquiries',
            'totalLeads',
            'todayLeads',
            'newLeads',
            'goodLeads',
            'badLeads',
            'syncedLeads',
            'latestLeads',
            'metaTotalSpend',
            'metaTotalReach',
            'metaTotalImpressions',
            'metaActiveCampaigns',
            'metaTotalCampaigns',
            'avgCostPerLead',
            'leadChartLabels',
            'leadChartCounts',
            'campaignChartLabels',
            'campaignChartData'
        ));
    }
}
