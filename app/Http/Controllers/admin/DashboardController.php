<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the Admin Dashboard with key statistics and recent registrations.
     */
    public function index()
    {
        $totalPartners = Partner::count();
        $totalEp       = Partner::where('registration_type', Partner::REGISTRATION_TYPE_EP)->count();
        $totalGp       = Partner::where('registration_type', Partner::REGISTRATION_TYPE_GP)->count();
        $latestPartners = Partner::latest()->take(8)->get();

        // Calculate ratios for visual progress
        $epPercentage = $totalPartners > 0 ? round(($totalEp / $totalPartners) * 100) : 50;
        $gpPercentage = $totalPartners > 0 ? (100 - $epPercentage) : 50;

        // Top states breakdown
        $topStates = Partner::selectRaw('state, count(*) as count')
            ->whereNotNull('state')
            ->groupBy('state')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalPartners',
            'totalEp',
            'totalGp',
            'latestPartners',
            'epPercentage',
            'gpPercentage',
            'topStates'
        ));
    }
}
