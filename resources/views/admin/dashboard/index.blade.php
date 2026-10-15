@extends('admin.layouts.app')

@section('title', 'Executive Analytics & Traffic Command')

@section('content')
<div class="space-y-6">

    <!-- HERO WELCOME & REALTIME BANNER -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 text-white p-6 sm:p-8 shadow-xl border border-slate-800">
        <div class="absolute -right-10 -top-10 w-80 h-80 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute left-1/3 -bottom-10 w-60 h-60 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-300 text-[11px] font-black uppercase tracking-wider border border-blue-400/30">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span>Live Tracking & Dynamic Content System Active</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                    Sumatra Sales Control Center
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 max-w-2xl leading-relaxed">
                    Live telemetry across public visitor traffic, unique IP addresses, partner network onboarding (EP & GP), and centralized dynamic content management.
                </p>
            </div>

            <!-- Action shortcuts -->
                <a href="{{ route('admin.contact.index') }}" class="px-3.5 py-2.5 rounded-xl bg-indigo-500/20 hover:bg-indigo-500/30 text-indigo-300 text-xs font-bold transition border border-indigo-400/30 inline-flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                    <span>Contact Inbox</span>
                    @if($unreadInquiries > 0)
                        <span class="px-1.5 py-0.5 rounded-full bg-indigo-500 text-white text-[10px] font-black">{{ $unreadInquiries }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.settings.index') }}" class="px-4 py-2.5 rounded-xl bg-cyan-500/20 hover:bg-cyan-500/30 text-cyan-300 text-xs font-bold transition border border-cyan-400/30 inline-flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" /></svg>
                    <span>Dynamic Content</span>
                </a>
                <a href="{{ route('partner.register') }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-[#2964F2] hover:bg-blue-600 text-white text-xs font-bold transition shadow-md shadow-blue-600/30 inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    <span>New Application</span>
                </a>
                <a href="{{ route('home') }}" target="_blank" class="px-3.5 py-2.5 rounded-xl bg-white/10 hover:bg-white/15 text-white text-xs font-bold transition border border-white/10 inline-flex items-center gap-1.5">
                    <span>Public Site</span>
                    <svg class="w-3.5 h-3.5 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- 4 PRIMARY KPI METRIC CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        
        <!-- CARD 1: Total Visitors -->
        <div class="group relative p-5 sm:p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-lg hover:border-blue-300 transition duration-300">
            <div class="flex items-center justify-between">
                <span class="text-xs font-extrabold uppercase text-slate-400 tracking-wider">Total Traffic (Visits)</span>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#2964F2] flex items-center justify-center group-hover:scale-110 transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($totalVisits) }}</span>
                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">+{{ $todayVisits }} today</span>
                </div>
                <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-500 font-medium">
                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" /></svg>
                    <span>Live Pageview Activity</span>
                </div>
            </div>
        </div>

        <!-- CARD 2: Unique IP Visitors -->
        <div class="group relative p-5 sm:p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-lg hover:border-purple-300 transition duration-300">
            <div class="flex items-center justify-between">
                <span class="text-xs font-extrabold uppercase text-slate-400 tracking-wider">Unique IP Visitors</span>
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center group-hover:scale-110 transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" /></svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($totalUniqueIps) }}</span>
                    <span class="text-xs font-bold text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full">{{ $todayUniqueIps }} new today</span>
                </div>
                <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-500 font-medium">
                    <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                    <span>Distinct Audience Footprint</span>
                </div>
            </div>
        </div>

        <!-- CARD 3: Partner Applications -->
        <div class="group relative p-5 sm:p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-lg hover:border-emerald-300 transition duration-300">
            <div class="flex items-center justify-between">
                <span class="text-xs font-extrabold uppercase text-slate-400 tracking-wider">Partner Onboarding</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($totalPartners) }}</span>
                    <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">{{ $totalEp }} EP / {{ $totalGp }} GP</span>
                </div>
                <div class="mt-2 flex items-center justify-between text-xs text-slate-500 font-medium">
                    <span>{{ $todayPartners }} applied today</span>
                    <span class="font-bold text-slate-700">{{ $epPercentage }}% EP Ratio</span>
                </div>
            </div>
        </div>

        <!-- CARD 4: Conversion Rate -->
        <div class="group relative p-5 sm:p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-lg hover:border-amber-300 transition duration-300">
            <div class="flex items-center justify-between">
                <span class="text-xs font-extrabold uppercase text-slate-400 tracking-wider">Visitor Conversion</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" /></svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-black text-slate-900 tracking-tight">{{ $conversionRate }}%</span>
                    <span class="text-xs font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full">IP to Lead</span>
                </div>
                <div class="mt-2">
                    <div class="w-full h-1.5 rounded-full bg-slate-100 overflow-hidden">
                        <div class="h-full bg-amber-500 rounded-full" style="width: {{ min(100, $conversionRate * 10) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- MAIN ANALYTICS SECTION: 7-DAY TRAFFIC CHART & DEVICE BREAKDOWN -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        
        <!-- VISITOR & UNIQUE IP TREND CHART (2 COLS) -->
        <div class="lg:col-span-2 p-5 sm:p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-100">
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-base font-black text-slate-900">Traffic Velocity & Unique Visitors</h2>
                        <span class="px-2 py-0.5 rounded-md bg-blue-50 text-[#2964F2] text-[10px] font-black uppercase tracking-wider">7-Day Realtime</span>
                    </div>
                    <p class="text-xs text-slate-400 mt-0.5">Comparing total page impressions against verified unique client IP addresses</p>
                </div>

                <div class="flex items-center gap-4 text-xs font-bold">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-md bg-[#2964F2]"></span>
                        <span class="text-slate-700">Total Visits</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-md bg-purple-500"></span>
                        <span class="text-slate-700">Unique IPs</span>
                    </div>
                </div>
            </div>

            <!-- Canvas Container -->
            <div class="relative w-full h-[280px]">
                <canvas id="visitorTrafficChart"></canvas>
            </div>
        </div>

        <!-- DEVICE & AUDIENCE COMPOSITION (1 COL) -->
        <div class="p-5 sm:p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs flex flex-col justify-between space-y-5">
            <div>
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h2 class="text-base font-black text-slate-900">Device Platform</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Hardware breakdown of visitors</p>
                    </div>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                </div>

                <!-- Progress Bars for Devices -->
                <div class="mt-5 space-y-4">
                    
                    <!-- Desktop -->
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between text-xs font-bold">
                            <span class="flex items-center gap-2 text-slate-700">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0H3" /></svg>
                                <span>Desktop Computers</span>
                            </span>
                            <span class="text-slate-900 font-black">{{ $desktopPct }}%</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full bg-[#2964F2] rounded-full transition-all duration-700" style="width: {{ $desktopPct }}%"></div>
                        </div>
                    </div>

                    <!-- Mobile -->
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between text-xs font-bold">
                            <span class="flex items-center gap-2 text-slate-700">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" /></svg>
                                <span>Mobile Phones</span>
                            </span>
                            <span class="text-slate-900 font-black">{{ $mobilePct }}%</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full bg-emerald-500 rounded-full transition-all duration-700" style="width: {{ $mobilePct }}%"></div>
                        </div>
                    </div>

                    <!-- Tablet -->
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between text-xs font-bold">
                            <span class="flex items-center gap-2 text-slate-700">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5h3m-6.75 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-15a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 4.5v15a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                                <span>Tablets / iPads</span>
                            </span>
                            <span class="text-slate-900 font-black">{{ $tabletPct }}%</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full bg-purple-500 rounded-full transition-all duration-700" style="width: {{ $tabletPct }}%"></div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Top Network States Quick Summary -->
            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                <span class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Top Partner States</span>
                <div class="flex flex-wrap gap-1.5">
                    @forelse($topStates as $st)
                        <span class="px-2 py-0.5 rounded-lg bg-white border border-slate-200 text-[11px] font-bold text-slate-700 shadow-2xs">
                            {{ $st->state ?: 'Other' }} <span class="text-[#2964F2]">({{ $st->count }})</span>
                        </span>
                    @empty
                        <span class="text-xs text-slate-400">No partner state records yet</span>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <!-- RECENT REALTIME VISITOR LOGS (UNIQUE IP AUDIT STREAM) -->
    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-base font-black text-slate-900">Live Visitor & IP Stream</h2>
                    <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase tracking-wider">Realtime Hits</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5">Audit log of client IP addresses, browsing technology, and requested routes</p>
            </div>
            <div class="text-xs font-bold text-slate-500 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Active Telemetry Collector</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50/80 text-slate-400 font-bold uppercase tracking-wider text-[10px] border-b border-slate-100">
                    <tr>
                        <th class="py-3 px-5">Visitor IP Address</th>
                        <th class="py-3 px-4">Device</th>
                        <th class="py-3 px-4">Browser</th>
                        <th class="py-3 px-4">Page / Endpoint</th>
                        <th class="py-3 px-4">Method</th>
                        <th class="py-3 px-5 text-right">Time Recorded</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($recentVisitors as $visit)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-3 px-5">
                                <div class="flex items-center gap-2">
                                    <span class="font-mono font-bold text-slate-900 bg-slate-100 px-2 py-0.5 rounded-md text-[11px] border border-slate-200">
                                        {{ $visit->ip_address }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                @if($visit->device === 'Mobile')
                                    <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" /></svg>
                                        Mobile
                                    </span>
                                @elseif($visit->device === 'Tablet')
                                    <span class="inline-flex items-center gap-1 text-[11px] font-bold text-purple-700">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5h3m-6.75 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-15a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 4.5v15a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                                        Tablet
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[11px] font-bold text-blue-700">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0H3" /></svg>
                                        Desktop
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4 font-medium text-slate-700">
                                {{ $visit->browser ?: 'Browser' }}
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-mono text-[11px] text-slate-600 max-w-xs truncate block" title="{{ $visit->url }}">
                                    {{ Str::limit($visit->url ?: '/', 40) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase {{ $visit->method === 'POST' ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-700' }}">
                                    {{ $visit->method ?: 'GET' }}
                                </span>
                            </td>
                            <td class="py-3 px-5 text-right font-medium text-slate-500 whitespace-nowrap">
                                {{ $visit->visited_at ? $visit->visited_at->diffForHumans() : 'Just now' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400 font-medium">
                                No visitor traffic recorded yet. Traffic will automatically stream in when users access the site.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- PARTNER DISTRIBUTION PROGRESS BAR -->
    <div class="p-5 sm:p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs space-y-3">
        <div class="flex items-center justify-between text-xs font-bold">
            <span class="text-slate-800 font-black">Executive Partner (EP) vs Ground Partner (GP) Share</span>
            <div class="flex items-center gap-4 text-[11px]">
                <span class="text-[#2964F2] font-black">● Executive Partner: {{ $epPercentage }}% ({{ $totalEp }})</span>
                <span class="text-emerald-600 font-black">● Ground Partner: {{ $gpPercentage }}% ({{ $totalGp }})</span>
            </div>
        </div>
        <div class="w-full h-3.5 rounded-full bg-slate-100 overflow-hidden flex">
            <div class="bg-[#2964F2] h-full transition-all duration-700" style="width: {{ $epPercentage }}%"></div>
            <div class="bg-emerald-500 h-full transition-all duration-700" style="width: {{ $gpPercentage }}%"></div>
        </div>
    </div>

    <!-- RECENT APPLICATIONS SECTION -->
    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs overflow-hidden">
        
        <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="text-base font-black text-slate-900">Latest Partner Applications</h2>
                <p class="text-xs text-slate-400 font-medium">Candidates recently submitted via registration forms</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.ep.index') }}" class="text-xs font-bold text-[#2964F2] hover:underline">All Executive (EP) →</a>
                <span class="text-slate-300">•</span>
                <a href="{{ route('admin.gp.index') }}" class="text-xs font-bold text-emerald-600 hover:underline">All Ground (GP) →</a>
            </div>
        </div>

        @if ($latestPartners->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50/80 text-slate-400 font-bold uppercase tracking-wider text-[10px] border-b border-slate-100">
                        <tr>
                            <th class="py-3 px-5">Ref Code</th>
                            <th class="py-3 px-4">Program</th>
                            <th class="py-3 px-4">Applicant Name</th>
                            <th class="py-3 px-4">Contact Info</th>
                            <th class="py-3 px-4">Location</th>
                            <th class="py-3 px-4">Applied Date</th>
                            <th class="py-3 px-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach ($latestPartners as $partner)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 px-5 font-mono font-bold text-slate-900">
                                    {{ $partner->application_code ?: 'SSPL-'.$partner->id }}
                                </td>
                                <td class="py-3 px-4">
                                    @if ($partner->registration_type === 'GP')
                                        <span class="px-2.5 py-0.5 rounded-md text-[10px] font-black bg-emerald-50 text-emerald-700 border border-emerald-200">GP</span>
                                    @else
                                        <span class="px-2.5 py-0.5 rounded-md text-[10px] font-black bg-blue-50 text-[#2964F2] border border-blue-200">EP</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <div class="font-bold text-slate-900">{{ $partner->name }}</div>
                                </td>
                                <td class="py-3 px-4">
                                    <div>{{ $partner->phone }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $partner->email }}</div>
                                </td>
                                <td class="py-3 px-4 text-slate-600">
                                    {{ $partner->city ?: 'N/A' }}{{ $partner->state ? ', ' . $partner->state : '' }}
                                </td>
                                <td class="py-3 px-4 text-slate-500 whitespace-nowrap">
                                    {{ $partner->created_at->format('d M Y, h:i A') }}
                                </td>
                                <td class="py-3 px-5 text-right space-x-1.5 whitespace-nowrap">
                                    <button type="button" onclick="openPartnerModal({{ json_encode($partner) }})" class="px-3 py-1.5 rounded-xl bg-blue-50 hover:bg-blue-100 text-[#2964F2] text-[11px] font-bold transition">
                                        View Details
                                    </button>
                                    @if (!empty($partner->application_code))
                                        <a href="{{ route('partner.application.pdf', ['code' => $partner->application_code]) }}" target="_blank" class="px-2.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-[11px] font-bold transition inline-block">
                                            PDF ↗
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- EMPTY STATE -->
            <div class="py-12 px-4 text-center">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-900">No partner applications yet</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                    When applicants fill out the Executive Partner or Ground Partner registration forms, their submissions will appear here in real time.
                </p>
                <div class="mt-4">
                    <a href="{{ route('partner.register') }}" target="_blank" class="px-4 py-2 rounded-xl bg-[#2964F2] hover:bg-blue-600 text-white text-xs font-bold transition shadow-sm inline-flex items-center gap-1.5">
                        Test Partner Registration Form ↗
                    </a>
                </div>
            </div>
        @endif

    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('visitorTrafficChart');
        if (!ctx) return;

        const labels = @json($chartLabels);
        const visitsData = @json($chartVisits);
        const uniqueIpsData = @json($chartUniqueIps);

        // Chart.js gradient setup
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Total Visits',
                        data: visitsData,
                        borderColor: '#2964F2',
                        backgroundColor: (context) => {
                            const chart = context.chart;
                            const {ctx, chartArea} = chart;
                            if (!chartArea) return null;
                            const gradient = ctx.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
                            gradient.addColorStop(0, 'rgba(41, 100, 242, 0.28)');
                            gradient.addColorStop(1, 'rgba(41, 100, 242, 0.00)');
                            return gradient;
                        },
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2.5,
                        pointBackgroundColor: '#2964F2',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    },
                    {
                        label: 'Unique IPs',
                        data: uniqueIpsData,
                        borderColor: '#a855f7',
                        backgroundColor: (context) => {
                            const chart = context.chart;
                            const {ctx, chartArea} = chart;
                            if (!chartArea) return null;
                            const gradient = ctx.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
                            gradient.addColorStop(0, 'rgba(168, 85, 247, 0.20)');
                            gradient.addColorStop(1, 'rgba(168, 85, 247, 0.00)');
                            return gradient;
                        },
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2.5,
                        pointBackgroundColor: '#a855f7',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#ffffff',
                        bodyColor: '#94a3b8',
                        padding: 10,
                        cornerRadius: 10,
                        bodyFont: {
                            family: "'Plus Jakarta Sans', sans-serif",
                            weight: 'bold'
                        },
                        callbacks: {
                            label: function(context) {
                                return `  ${context.dataset.label}: ${context.parsed.y} ${context.dataset.label === 'Unique IPs' ? 'unique clients' : 'pageviews'}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: {
                                size: 11,
                                family: "'Plus Jakarta Sans', sans-serif",
                                weight: 600
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9',
                            drawBorder: false
                        },
                        ticks: {
                            precision: 0,
                            color: '#94a3b8',
                            font: {
                                size: 11,
                                family: "'Plus Jakarta Sans', sans-serif"
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
