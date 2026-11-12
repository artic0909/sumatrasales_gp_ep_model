@extends('admin.layouts.app')

@section('title', 'Meta Ads Performance & Attribution')

@section('content')
<div class="space-y-6">

    <!-- HEADER & ACTION BAR -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/80">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-violet-50 text-violet-700 text-[10px] font-black uppercase tracking-wider border border-violet-200">
                <svg class="w-3 h-3 text-violet-600" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                <span>Meta Ads Manager &bull; {{ $adAccountId ?? 'Account Not Set in .env' }}</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mt-1">
                Meta Ads Performance &amp; Lead Attribution
            </h1>
            <p class="text-xs text-slate-500 font-medium">
                Live delivery status, spend insights, and real-time lead generation tracking from your Meta Ads Account.
            </p>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="flex items-center gap-2 flex-wrap">
            <!-- Force Refresh from Meta API -->
            <form action="{{ route('admin.ads.refresh') }}" method="POST">
                @csrf
                <button type="submit" class="px-3.5 py-2 rounded-xl bg-violet-600 hover:bg-violet-700 text-white text-xs font-bold transition inline-flex items-center gap-1.5 shadow-sm cursor-pointer" title="Fetch latest live spend & status directly from Meta Marketing API">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                    <span>Refresh Meta Data</span>
                </button>
            </form>

            <!-- Link to All Leads -->
            <a href="{{ route('admin.leads.index') }}" class="px-3.5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition inline-flex items-center gap-1.5 shadow-sm cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.199l-.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.999-3.199a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>
                <span>All Leads ({{ $kpis['total_crm_leads'] }})</span>
            </a>

            <!-- Open in Facebook Ads Manager external link -->
            @if(!empty($adAccountId))
                <a href="https://adsmanager.facebook.com/adsmanager/manage/campaigns?act={{ str_replace('act_', '', $adAccountId) }}" target="_blank" class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition inline-flex items-center gap-1.5 cursor-pointer">
                    <span>Meta Ads Manager</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                </a>
            @endif
        </div>
    </div>

    <!-- API WARNING OR ERROR BANNER -->
    @if($apiError)
        <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 text-xs flex items-start gap-3 shadow-xs">
            <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
            <div class="space-y-1">
                <p class="font-bold text-amber-950">Meta Marketing API Notice:</p>
                <p class="text-amber-800">{{ $apiError }}</p>
                <p class="text-[11px] text-amber-700">Displaying historical leads and cached ad data from your CRM database. Ensure your permanent System User token with <code>ads_read</code> permission is configured in <code>.env</code>.</p>
            </div>
        </div>
    @endif

    <!-- QUICK KPI STATS -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
        <!-- Total Tracked Ads -->
        <div class="flex items-center gap-2.5 px-3.5 py-3 rounded-xl bg-white border border-slate-200 shadow-2xs">
            <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" /></svg>
            </div>
            <div>
                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block">Total Ads</span>
                <span class="text-base font-black text-slate-900">{{ $kpis['total_ads'] }}</span>
            </div>
        </div>

        <!-- Active Running Ads -->
        <div class="flex items-center gap-2.5 px-3.5 py-3 rounded-xl bg-emerald-50 border border-emerald-200 shadow-2xs">
            <div class="relative flex h-3 w-3 shrink-0">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-600"></span>
            </div>
            <div>
                <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider block">Active Ads</span>
                <span class="text-base font-black text-emerald-950">{{ $kpis['active_ads'] }}</span>
            </div>
        </div>

        <!-- Total Spend -->
        <div class="flex items-center gap-2.5 px-3.5 py-3 rounded-xl bg-violet-50 border border-violet-200 shadow-2xs">
            <div class="w-9 h-9 rounded-xl bg-violet-100 flex items-center justify-center shrink-0">
                <span class="text-sm font-black text-violet-700">₹</span>
            </div>
            <div>
                <span class="text-[10px] font-bold text-violet-700 uppercase tracking-wider block">Total Spend</span>
                <span class="text-base font-black text-violet-950">₹{{ number_format($kpis['total_spend'], 2) }}</span>
            </div>
        </div>

        <!-- Total Reach & Impressions -->
        <div class="flex items-center gap-2.5 px-3.5 py-3 rounded-xl bg-blue-50 border border-blue-200 shadow-2xs">
            <div class="w-9 h-9 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
            </div>
            <div>
                <span class="text-[10px] font-bold text-blue-700 uppercase tracking-wider block">Total Reach</span>
                <span class="text-base font-black text-blue-950">{{ number_format($kpis['total_reach']) }}</span>
            </div>
        </div>

        <!-- CRM Leads Received -->
        <div class="flex items-center gap-2.5 px-3.5 py-3 rounded-xl bg-indigo-50 border border-indigo-200 shadow-2xs col-span-2 sm:col-span-1">
            <div class="w-9 h-9 rounded-xl bg-indigo-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
            </div>
            <div>
                <span class="text-[10px] font-bold text-indigo-700 uppercase tracking-wider block">CRM Leads</span>
                <span class="text-base font-black text-indigo-950">{{ $kpis['total_crm_leads'] }}</span>
            </div>
        </div>
    </div>

    <!-- SEARCH & FILTER TOOLBAR -->
    <form action="{{ route('admin.ads.index') }}" method="GET" class="p-3.5 bg-white rounded-2xl border border-slate-200/90 shadow-xs flex flex-col md:flex-row items-center justify-between gap-3">
        <!-- Search Keyword -->
        <div class="relative w-full md:w-80">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Ad name, ID, or campaign..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
        </div>

        <div class="flex items-center gap-2 w-full md:w-auto flex-wrap sm:flex-nowrap">
            <!-- Filter by Delivery Status -->
            <select name="status" onchange="this.form.submit()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition">
                <option value="">All Delivery Statuses</option>
                <option value="ACTIVE" {{ request('status') === 'ACTIVE' ? 'selected' : '' }}>Active Running Only</option>
                <option value="PAUSED" {{ request('status') === 'PAUSED' ? 'selected' : '' }}>Paused / Off Only</option>
                <option value="ARCHIVED" {{ request('status') === 'ARCHIVED' ? 'selected' : '' }}>Archived / Historical</option>
            </select>

            <!-- Filter by Lead Coming Status -->
            <select name="lead_status" onchange="this.form.submit()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition">
                <option value="">All Lead Statuses</option>
                <option value="coming" {{ request('lead_status') === 'coming' ? 'selected' : '' }}>Receiving Leads Only</option>
                <option value="none" {{ request('lead_status') === 'none' ? 'selected' : '' }}>No Leads Yet</option>
            </select>

            <!-- Filter by Campaign -->
            @if(count($availableCampaigns) > 0)
                <select name="campaign" onchange="this.form.submit()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition max-w-[200px] truncate">
                    <option value="">All Campaigns</option>
                    @foreach($availableCampaigns as $camp)
                        <option value="{{ $camp }}" {{ request('campaign') === $camp ? 'selected' : '' }}>
                            {{ Str::limit($camp, 28) }}
                        </option>
                    @endforeach
                </select>
            @endif

            @if(request()->anyFilled(['search', 'status', 'lead_status', 'campaign']))
                <a href="{{ route('admin.ads.index') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-bold transition">
                    Reset
                </a>
            @endif
        </div>
    </form>

    <!-- ADS LIST TABLE -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-200 text-[11px] font-black uppercase tracking-wider text-slate-500">
                        <th class="py-3 px-4">Ad Details &amp; Creative</th>
                        <th class="py-3 px-3">Campaign &amp; Ad Set</th>
                        <th class="py-3 px-3">Delivery Status</th>
                        <th class="py-3 px-3 text-right">Spend &amp; Reach</th>
                        <th class="py-3 px-3 text-center">Lead Status</th>
                        <th class="py-3 px-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($ads as $ad)
                        <tr class="hover:bg-slate-50/80 transition group">
                            <!-- Ad Details & Creative -->
                            <td class="py-3.5 px-4 max-w-sm">
                                <div class="space-y-1">
                                    <div class="font-bold text-slate-900 group-hover:text-blue-600 transition flex items-start gap-1.5">
                                        <svg class="w-4 h-4 text-violet-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                                        <span class="line-clamp-2" title="{{ $ad['name'] }}">{{ $ad['name'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-[10px] text-slate-400 font-mono">
                                        <span>ID: {{ $ad['id'] }}</span>
                                        @if(!empty($ad['created_time']))
                                            <span>&bull;</span>
                                            <span>{{ \Carbon\Carbon::parse($ad['created_time'])->format('d M, Y') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Campaign & AdSet -->
                            <td class="py-3.5 px-3 max-w-xs">
                                <div class="space-y-0.5">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-700 max-w-[200px] truncate" title="{{ $ad['campaign_name'] }}">
                                        {{ $ad['campaign_name'] }}
                                    </span>
                                    <p class="text-[10px] text-slate-400 truncate max-w-[200px]" title="{{ $ad['adset_name'] }}">
                                        AdSet: {{ $ad['adset_name'] }}
                                    </p>
                                </div>
                            </td>

                            <!-- Delivery Status -->
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                @if($ad['effective_status'] === 'ACTIVE')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-black bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-600"></span>
                                        </span>
                                        <span>Active</span>
                                    </span>
                                @elseif(in_array($ad['effective_status'], ['PAUSED', 'CAMPAIGN_PAUSED', 'ADSET_PAUSED', 'OFF']))
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                        <span>Paused</span>
                                    </span>
                                @elseif($ad['effective_status'] === 'LOCAL_ARCHIVE')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span>CRM Archive</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500">
                                        <span>{{ ucfirst(strtolower($ad['effective_status'])) }}</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Spend & Reach -->
                            <td class="py-3.5 px-3 text-right whitespace-nowrap">
                                <div class="font-black text-slate-900 text-sm">
                                    ₹{{ number_format($ad['spend'], 2) }}
                                </div>
                                <div class="text-[10px] text-slate-400 font-medium">
                                    <span>{{ number_format($ad['impressions']) }} Impr</span>
                                    <span>&bull;</span>
                                    <span>{{ number_format($ad['reach']) }} Reach</span>
                                </div>
                            </td>

                            <!-- Lead Status (Key Request) -->
                            <td class="py-3.5 px-3 text-center whitespace-nowrap">
                                @if($ad['is_lead_coming'])
                                    <div class="inline-flex flex-col items-center">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-black bg-emerald-50 text-emerald-800 border border-emerald-300 shadow-2xs">
                                            <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                                            <span>Receiving Leads ({{ $ad['crm_leads_count'] }})</span>
                                        </span>
                                        @if(!empty($ad['latest_lead_at']))
                                            <span class="text-[10px] text-slate-400 mt-0.5">
                                                Last: {{ \Carbon\Carbon::parse($ad['latest_lead_at'])->diffForHumans() }}
                                            </span>
                                        @endif
                                    </div>
                                @elseif($ad['effective_status'] === 'ACTIVE')
                                    <div class="inline-flex flex-col items-center">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                            <span>Active (No Leads Yet)</span>
                                        </span>
                                    </div>
                                @else
                                    <div class="inline-flex flex-col items-center">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-medium bg-slate-100 text-slate-500">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                            <span>No Leads</span>
                                        </span>
                                    </div>
                                @endif
                            </td>

                            <!-- Action ("View Leads" button linking to admin.leads.index) -->
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.leads.index', ['ad' => (!empty($ad['name']) && $ad['name'] !== 'Unnamed Ad' ? $ad['name'] : $ad['id'])]) }}" 
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-xs transition cursor-pointer"
                                       title="View all {{ $ad['crm_leads_count'] }} leads from this specific ad in CRM">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                        <span>View Leads</span>
                                        @if($ad['crm_leads_count'] > 0)
                                            <span class="px-1.5 py-0.2 rounded-full text-[10px] bg-white text-blue-700 font-black">
                                                {{ $ad['crm_leads_count'] }}
                                            </span>
                                        @endif
                                    </a>

                                    @if(!empty($adAccountId) && is_numeric($ad['id']))
                                        <a href="https://adsmanager.facebook.com/adsmanager/manage/ads?act={{ str_replace('act_', '', $adAccountId) }}&filter_set={{ $ad['id'] }}" 
                                           target="_blank" 
                                           class="p-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 transition" 
                                           title="Open in Meta Ads Manager">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <div class="max-w-sm mx-auto space-y-2">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto text-slate-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                                    </div>
                                    <h3 class="font-bold text-slate-900 text-sm">No Ads Found</h3>
                                    <p class="text-xs text-slate-500">
                                        No ads matched your current filter or search criteria.
                                    </p>
                                    @if(request()->anyFilled(['search', 'status', 'lead_status', 'campaign']))
                                        <a href="{{ route('admin.ads.index') }}" class="inline-block mt-2 px-3.5 py-1.5 rounded-xl bg-slate-900 text-white text-xs font-bold hover:bg-slate-800 transition">
                                            Clear Filters
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

