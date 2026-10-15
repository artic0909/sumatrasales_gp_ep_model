<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Models\Partner;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            'unreadInquiries'
        ));
    }
}
