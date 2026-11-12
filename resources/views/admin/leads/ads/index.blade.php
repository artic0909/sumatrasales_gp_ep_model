@extends('admin.layouts.app')

@section('title', 'Facebook Ad Leads & Conversions API')

@section('content')
<div class="space-y-6">

    <!-- HEADER & STATS BAR -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/80">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 text-[10px] font-black uppercase tracking-wider border border-blue-200">
                <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                <span>Meta Lead Ads &amp; Conversions API (CAPI)</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mt-1">
                Facebook Leads &amp; Feedback Loop
            </h1>
            <p class="text-xs text-slate-500 font-medium">
                Real-time Meta Instant Form leads with automated ad attribution &amp; offline CAPI conversion sync.
            </p>
        </div>

        <!-- ACTION BUTTONS & STATS -->
        <div class="flex items-center gap-2 flex-wrap">
            <!-- Sync Past Historical Leads from Facebook Button -->
            <form action="{{ route('admin.leads.syncPastLeads') }}" method="POST" onsubmit="return confirm('Fetch all past leads from your Facebook Instant Forms? This will import any leads submitted before webhook integration.');">
                @csrf
                <button type="submit" class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition inline-flex items-center gap-1.5 shadow-sm cursor-pointer" title="Fetch past historical leads from Facebook Instant Forms">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                    <span>Sync Past FB Leads</span>
                </button>
            </form>

            <a href="{{ route('admin.leads.create') }}" class="px-3.5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition inline-flex items-center gap-1.5 shadow-sm cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                <span>Add Manual Lead</span>
            </a>

            <!-- Follow-up Logs Shortcut -->
            <a href="{{ route('admin.leads.followups.index') }}" class="px-3.5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition inline-flex items-center gap-1.5 shadow-sm cursor-pointer" title="View all follow-up logs across all leads">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                <span>Follow-up Logs</span>
            </a>

            <!-- Webhook Endpoint Info Modal Button -->
            <button type="button" onclick="document.getElementById('webhook-info-modal').classList.remove('hidden')" class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition inline-flex items-center gap-1.5 cursor-pointer">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                <span>Webhook URL</span>
            </button>
        </div>
    </div>

    <!-- QUICK COMPACT STAT PILLS -->
    <div class="grid gap-2.5" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));">
        <div class="flex items-center gap-2.5 px-3 py-2 rounded-xl bg-white border border-slate-200/90 shadow-2xs hover:border-slate-300 transition">
            <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center shrink-0">
                <span class="w-2 h-2 rounded-full bg-slate-500"></span>
            </div>
            <div class="min-w-0">
                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider block truncate">Total Leads</span>
                <span class="text-sm sm:text-base font-black text-slate-900 leading-tight">{{ $totalLeads }}</span>
            </div>
        </div>

        <div class="flex items-center gap-2.5 px-3 py-2 rounded-xl bg-blue-50/80 border border-blue-200/90 shadow-2xs">
            <div class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
                </span>
            </div>
            <div class="min-w-0">
                <span class="text-[9px] font-bold text-blue-700 uppercase tracking-wider block truncate">New Unreviewed</span>
                <span class="text-sm sm:text-base font-black text-blue-950 leading-tight">{{ $newCount }}</span>
            </div>
        </div>

        <div class="flex items-center gap-2.5 px-3 py-2 rounded-xl bg-emerald-50/80 border border-emerald-200/90 shadow-2xs">
            <div class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </div>
            <div class="min-w-0">
                <span class="text-[9px] font-bold text-emerald-700 uppercase tracking-wider block truncate">Good Leads</span>
                <span class="text-sm sm:text-base font-black text-emerald-950 leading-tight">{{ $goodCount }}</span>
            </div>
        </div>

        <div class="flex items-center gap-2.5 px-3 py-2 rounded-xl bg-rose-50/80 border border-rose-200/90 shadow-2xs">
            <div class="w-7 h-7 rounded-lg bg-rose-100 flex items-center justify-center shrink-0">
                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
            </div>
            <div class="min-w-0">
                <span class="text-[9px] font-bold text-rose-700 uppercase tracking-wider block truncate">Bad Leads</span>
                <span class="text-sm sm:text-base font-black text-rose-950 leading-tight">{{ $badCount }}</span>
            </div>
        </div>

        <div class="flex items-center gap-2.5 px-3 py-2 rounded-xl bg-indigo-50/80 border border-indigo-200/90 shadow-2xs">
            <div class="w-7 h-7 rounded-lg bg-indigo-100 flex items-center justify-center shrink-0">
                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
            </div>
            <div class="min-w-0">
                <span class="text-[9px] font-bold text-indigo-700 uppercase tracking-wider block truncate">CAPI Synced</span>
                <span class="text-sm sm:text-base font-black text-indigo-950 leading-tight">{{ $syncedCount }}</span>
            </div>
        </div>
    </div>

    <!-- SEARCH & FILTER TOOLBAR -->
    <form action="{{ route('admin.leads.index') }}" method="GET" class="p-3.5 bg-white rounded-2xl border border-slate-200/90 shadow-xs flex flex-col md:flex-row items-center justify-between gap-3">
        <div class="relative w-full md:w-80">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, phone, ad name..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
        </div>

        <div class="flex items-center gap-2 w-full md:w-auto flex-wrap sm:flex-nowrap">
            <!-- Filter by Date Range (From & To) -->
            <div class="flex items-center gap-1.5 px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl focus-within:ring-2 focus-within:ring-blue-500/20 focus-within:border-blue-500">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">From:</span>
                <input type="date" name="from_date" value="{{ request('from_date') }}" onchange="this.form.submit()" title="Filter leads from this date" class="bg-transparent text-xs text-slate-700 font-medium focus:outline-none cursor-pointer">
            </div>

            <div class="flex items-center gap-1.5 px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl focus-within:ring-2 focus-within:ring-blue-500/20 focus-within:border-blue-500">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">To:</span>
                <input type="date" name="to_date" value="{{ request('to_date') }}" onchange="this.form.submit()" title="Filter leads up to this date" class="bg-transparent text-xs text-slate-700 font-medium focus:outline-none cursor-pointer">
            </div>

            <!-- Filter by Status -->
            <select name="status" onchange="this.form.submit()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
                <option value="">All Review Statuses</option>
                <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New Unreviewed</option>
                <option value="good_lead" {{ request('status') === 'good_lead' ? 'selected' : '' }}>Good / Qualified Lead</option>
                <option value="bad_lead" {{ request('status') === 'bad_lead' ? 'selected' : '' }}>Bad / Invalid Lead</option>
                <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Contacted</option>
            </select>

            <!-- Filter by Specific Ad -->
            @if(isset($availableAds) && $availableAds->count() > 0)
                <select name="ad" onchange="this.form.submit()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition max-w-[180px] truncate">
                    <option value="">All Facebook Ads</option>
                    @foreach($availableAds as $adItem)
                        <option value="{{ $adItem->ad_name }}" {{ (request('ad') == $adItem->ad_name || request('ad') == $adItem->ad_id) ? 'selected' : '' }}>
                            {{ Str::limit($adItem->ad_name, 22) }}
                        </option>
                    @endforeach
                </select>
            @endif

            <!-- Filter by CAPI Sync -->
            <select name="synced" onchange="this.form.submit()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
                <option value="">All Meta CAPI States</option>
                <option value="synced" {{ request('synced') === 'synced' ? 'selected' : '' }}>Synced to CAPI Only</option>
                <option value="unsynced" {{ request('synced') === 'unsynced' ? 'selected' : '' }}>Unsynced Only</option>
            </select>

            <!-- Per Page Dropdown -->
            <div class="flex items-center gap-1.5">
                <span class="text-[11px] font-bold text-slate-400">Show:</span>
                <select name="per_page" onchange="this.form.submit()" class="px-2.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
                    <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == '20' ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
                    <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>All</option>
                </select>
            </div>

            @if(request()->anyFilled(['search', 'status', 'synced', 'ad', 'from_date', 'to_date', 'campaign', 'campaign_id', 'per_page']))
                <a href="{{ route('admin.leads.index') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-bold transition">
                    Reset
                </a>
            @endif
        </div>
    </form>

    <!-- ACTIVE DATE FILTER BANNER -->
    @if(request('from_date') || request('to_date'))
        <div class="px-4 py-2.5 rounded-2xl bg-indigo-50 border border-indigo-200 text-indigo-900 text-xs flex items-center justify-between gap-3 shadow-2xs">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-indigo-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                <span>
                    Filtering by Date: 
                    <strong>{{ request('from_date') ? \Carbon\Carbon::parse(request('from_date'))->format('M d, Y') : 'Start' }}</strong> 
                    to 
                    <strong>{{ request('to_date') ? \Carbon\Carbon::parse(request('to_date'))->format('M d, Y') : 'Today' }}</strong>
                    <span class="font-black text-indigo-700 ml-1">({{ $leads->total() }} lead(s) found)</span>
                </span>
            </div>
            <a href="{{ route('admin.leads.index', request()->except(['from_date', 'to_date'])) }}" class="text-[11px] font-bold text-indigo-600 hover:text-indigo-800 underline">
                Clear Date Filter
            </a>
        </div>
    @endif

    <!-- ACTIVE AD / CAMPAIGN FILTER BANNER -->
    @if(request('campaign') || request('ad') || request('campaign_id'))
        <div class="px-4 py-3 rounded-2xl bg-blue-50 border border-blue-200 text-blue-900 text-xs flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-2xs">
            <div class="flex items-center gap-2.5">
                <span class="w-2.5 h-2.5 rounded-full bg-blue-600 animate-pulse shrink-0"></span>
                <div>
                    <span class="font-bold">Filtering by:</span>
                    <span class="font-semibold text-slate-800">{{ request('campaign') ?: (request('ad') ?: request('campaign_id')) }}</span>
                    <span class="font-black text-blue-700 ml-1">({{ $leads->total() }} leads in CRM)</span>
                    @if($leads->total() === 0)
                        <p class="text-[11px] text-blue-800 mt-0.5">
                            👉 Meta reports leads for this campaign, but they haven't been downloaded into your local CRM database yet. Click <strong>"Sync Past FB Leads"</strong> to download all past leads!
                        </p>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                @if($leads->total() === 0)
                    <form action="{{ route('admin.leads.syncPastLeads') }}" method="POST" onsubmit="return confirm('Download all past leads from Facebook Instant Forms?');">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition inline-flex items-center gap-1 shadow-xs cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                            <span>Sync Past FB Leads</span>
                        </button>
                    </form>
                @endif
                <a href="{{ route('admin.leads.index') }}" class="px-2.5 py-1.5 rounded-xl bg-white hover:bg-slate-100 text-slate-700 text-xs font-bold border border-slate-200 transition">
                    Clear Filter
                </a>
                <a href="{{ route('admin.ads.index') }}" class="px-2.5 py-1.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition">
                    &larr; Back to Meta Ads
                </a>
            </div>
        </div>
    @endif

    <!-- BULK ACTIONS BAR (HIDDEN BY DEFAULT) -->
    <div id="bulk-action-bar" class="hidden p-3 bg-blue-50 rounded-2xl border border-blue-200 shadow-2xs items-center justify-between gap-3 animate-fade-in">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-blue-600"></span>
            <span id="selected-count" class="text-xs font-bold text-blue-900">0 leads selected</span>
        </div>
        <form id="bulk-delete-form" action="{{ route('admin.leads.bulkDestroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all selected leads? This cannot be undone.');">
            @csrf
            <div id="bulk-delete-inputs"></div>
            <button type="submit" class="px-3 py-1.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition inline-flex items-center gap-1.5 shadow-2xs cursor-pointer">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                <span>Delete Selected</span>
            </button>
        </form>
    </div>

    <!-- LEADS TABLE CARD -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/75 text-[11px] font-black uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-4 w-10">
                            <input type="checkbox" id="select-all" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                        </th>
                        <th class="py-3.5 px-4">Lead Contact</th>
                        <th class="py-3.5 px-4">Ad Attribution</th>
                        <th class="py-3.5 px-4 text-center">Follow-ups</th>
                        <th class="py-3.5 px-4 text-center">Review Status</th>
                        <th class="py-3.5 px-4 text-center">Meta CAPI Feedback</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse ($leads as $lead)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <!-- Checkbox -->
                            <td class="py-3.5 px-4">
                                <input type="checkbox" name="lead_ids[]" value="{{ $lead->id }}" class="lead-checkbox rounded border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                            </td>

                            <!-- Lead Contact Info -->
                            <td class="py-3.5 px-4">
                                <div class="space-y-0.5">
                                    <a href="{{ route('admin.leads.show', $lead->id) }}" class="font-bold text-slate-900 hover:text-blue-600 transition block">
                                        {{ $lead->name ?? 'Unnamed Lead' }}
                                    </a>
                                    <div class="flex items-center gap-2 text-[11px] text-slate-500 flex-wrap">
                                        @if($lead->phone)
                                            <a href="tel:{{ $lead->phone }}" class="hover:text-blue-600 inline-flex items-center gap-1 font-mono">
                                                <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                                                <span>{{ $lead->phone }}</span>
                                            </a>
                                        @endif
                                        @if($lead->email)
                                            <a href="mailto:{{ $lead->email }}" class="hover:text-blue-600 inline-flex items-center gap-1 font-mono">
                                                <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                                                <span>{{ $lead->email }}</span>
                                            </a>
                                        @endif
                                    </div>
                                    <span class="text-[10px] text-slate-400 block pt-0.5">
                                        Received: {{ $lead->created_at ? $lead->created_at->diffForHumans() : 'N/A' }}
                                    </span>
                                </div>
                            </td>

                            <!-- Ad Attribution -->
                            <td class="py-3.5 px-4">
                                <div class="space-y-1">
                                    @if($lead->ad_name || $lead->ad_id)
                                        <div class="flex items-center gap-1.5 flex-wrap">
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 font-bold text-[11px] border border-blue-200">
                                                <svg class="w-3 h-3 text-blue-600 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                                <span>{{ $lead->ad_name ?: 'Facebook Ad' }}</span>
                                            </span>
                                            @if($lead->ad_id)
                                                <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-slate-100 text-slate-700 border border-slate-200 font-bold">
                                                    ID: {{ $lead->ad_id }}
                                                </span>
                                            @endif
                                        </div>
                                        @if($lead->campaign_name)
                                            <div class="text-[11px] text-slate-600 font-medium">
                                                <span class="text-slate-400">Campaign:</span> <strong class="text-slate-800">{{ $lead->campaign_name }}</strong>
                                            </div>
                                        @endif
                                    @else
                                        <div class="flex items-center gap-1.5 flex-wrap">
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-purple-50 text-purple-700 font-bold text-[11px] border border-purple-200">
                                                <svg class="w-3 h-3 text-purple-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                                                <span>{{ $lead->form_name ?: 'Instant Form' }}</span>
                                            </span>
                                            <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                                Organic / Direct
                                            </span>
                                        </div>
                                    @endif

                                    <div class="flex items-center gap-2 text-[10px] text-slate-400 font-mono">
                                        @if($lead->form_id)
                                            <span>Form: {{ $lead->form_id }}</span>
                                        @endif
                                        @if($lead->fb_leadgen_id)
                                            <span>• Leadgen: {{ $lead->fb_leadgen_id }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Follow-ups Column (Counting Button) -->
                            <td class="py-3.5 px-4 text-center">
                                @php
                                    $followupCount = $lead->followups_count ?? ($lead->relationLoaded('followups') ? $lead->followups->count() : 0);
                                @endphp
                                <button type="button" 
                                        onclick="openFollowupModal({{ $lead->id }}, '{{ addslashes($lead->name ?? 'Lead #' . $lead->id) }}', '{{ $lead->phone ?? '' }}', '{{ $lead->email ?? '' }}', '{{ $lead->status ?? 'new' }}')"
                                        id="lead-followup-btn-{{ $lead->id }}"
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-xl text-xs font-bold transition shadow-2xs border cursor-pointer
                                        {{ $followupCount > 0 ? 'bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border-indigo-200' : 'bg-slate-50 hover:bg-slate-100 text-slate-600 border-slate-200' }}"
                                        title="Click to view follow-up history or log a new call/WhatsApp">
                                    <span class="text-xs">📞</span>
                                    <span id="lead-followup-count-{{ $lead->id }}" class="font-black">{{ $followupCount }}</span>
                                    <span class="text-[10px] text-slate-400 font-semibold">{{ $followupCount === 1 ? 'log' : 'logs' }}</span>
                                    <span class="w-4 h-4 rounded-full bg-white flex items-center justify-center text-[10px] font-black text-slate-500 shadow-2xs">+</span>
                                </button>
                            </td>

                            <!-- Review Status -->
                            <td class="py-3.5 px-4 text-center">
                                <form action="{{ route('admin.leads.updateStatus', $lead->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="text-xs font-bold rounded-lg px-2.5 py-1 border transition cursor-pointer
                                        {{ $lead->status === 'good_lead' ? 'bg-emerald-50 text-emerald-700 border-emerald-300' : '' }}
                                        {{ $lead->status === 'new' ? 'bg-blue-50 text-blue-700 border-blue-300' : '' }}
                                        {{ $lead->status === 'bad_lead' ? 'bg-rose-50 text-rose-700 border-rose-300' : '' }}
                                        {{ $lead->status === 'contacted' ? 'bg-amber-50 text-amber-700 border-amber-300' : '' }}">
                                        <option value="new" {{ $lead->status === 'new' ? 'selected' : '' }}>New</option>
                                        <option value="good_lead" {{ $lead->status === 'good_lead' ? 'selected' : '' }}>Good Lead</option>
                                        <option value="bad_lead" {{ $lead->status === 'bad_lead' ? 'selected' : '' }}>Bad Lead</option>
                                        <option value="contacted" {{ $lead->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                    </select>
                                </form>
                            </td>

                            <!-- Meta CAPI Status -->
                            <td class="py-3.5 px-4 text-center">
                                @if($lead->synced_to_fb)
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-black" title="Synced at {{ $lead->synced_at }}">
                                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                        <span>Synced (QualifiedLead)</span>
                                    </div>
                                    <form action="{{ route('admin.leads.syncCapi', $lead->id) }}" method="POST" class="inline-block ml-1">
                                        @csrf
                                        <button type="submit" title="Resend CAPI Event" class="text-[10px] font-bold text-slate-400 hover:text-blue-600 transition underline cursor-pointer">
                                            Resync
                                        </button>
                                    </form>
                                @else
                                    <div class="flex items-center justify-center gap-1">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold border border-slate-200">
                                            Not Synced
                                        </span>
                                        <form action="{{ route('admin.leads.syncCapi', $lead->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="px-2 py-0.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-200 text-[10px] font-black transition cursor-pointer">
                                                Push to Facebook
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.leads.show', $lead->id) }}" class="p-1.5 rounded-lg bg-slate-50 hover:bg-blue-50 text-slate-500 hover:text-blue-600 transition" title="View Lead Details">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                    </a>
                                    <!-- <a href="{{ route('admin.leads.edit', $lead->id) }}" class="p-1.5 rounded-lg bg-slate-50 hover:bg-amber-50 text-slate-500 hover:text-amber-600 transition" title="Edit Lead">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                    </a> -->
                                    <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Permanently delete this lead?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg bg-slate-50 hover:bg-rose-50 text-slate-500 hover:text-rose-600 transition cursor-pointer" title="Delete Lead">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 px-4 text-center">
                                <div class="max-w-sm mx-auto space-y-3">
                                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 mx-auto flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </div>
                                    <div class="space-y-1">
                                        <h3 class="text-sm font-bold text-slate-800">No Facebook Leads Found</h3>
                                        <p class="text-xs text-slate-500">
                                            @if(request()->anyFilled(['search', 'status', 'synced']))
                                                No leads match your active filters. Try resetting the search or filter options.
                                            @else
                                                Leads submitted through your Facebook Instant Forms will automatically appear here via Meta Webhooks.
                                            @endif
                                        </p>
                                    </div>
                                    @if(request()->anyFilled(['search', 'status', 'synced']))
                                        <a href="{{ route('admin.leads.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                                            Clear Filters
                                        </a>
                                    @else
                                        <a href="{{ route('admin.leads.create') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition">
                                            Create First Lead Manually
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($leads->hasPages())
            <div class="p-4 border-t border-slate-200">
                {{ $leads->links() }}
            </div>
        @endif
    </div>

</div>

<!-- WEBHOOK INFO MODAL -->
<div id="webhook-info-modal" class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm p-4 flex items-center justify-center animate-fade-in" role="dialog">
    <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden text-left p-6 space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-200">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-black text-slate-900">Meta Webhook Configuration Details</h3>
                    <p class="text-xs text-slate-500">Configure these in your Meta App Dashboard under Webhooks</p>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('webhook-info-modal').classList.add('hidden')" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <div class="space-y-3 text-xs text-slate-700">
            <div>
                <label class="font-bold text-slate-600 block mb-1">Callback URL (Webhook Endpoint):</label>
                <div class="flex items-center gap-2">
                    <input type="text" readonly value="{{ url('/facebook/webhook') }}" id="webhook-url-input" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl font-mono text-xs select-all">
                    <button type="button" onclick="navigator.clipboard.writeText(document.getElementById('webhook-url-input').value); alert('Copied to clipboard!');" class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold transition">
                        Copy
                    </button>
                </div>
            </div>

            <div>
                <label class="font-bold text-slate-600 block mb-1">Verify Token (from .env `FB_WEBHOOK_VERIFY_TOKEN`):</label>
                <input type="text" readonly value="{{ env('FB_WEBHOOK_VERIFY_TOKEN', 'YOUR_VERIFY_TOKEN_IN_ENV') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl font-mono text-xs select-all">
            </div>

            <div class="p-3 bg-blue-50/70 rounded-xl border border-blue-200/80 text-[11px] space-y-1">
                <p class="font-bold text-blue-900">Meta Webhook Setup Steps:</p>
                <ol class="list-decimal pl-4 space-y-0.5 text-blue-800">
                    <li>Go to Meta App &gt; Webhooks &gt; Select <strong>Page</strong> object.</li>
                    <li>Click <strong>Subscribe to this object</strong> and paste Callback URL &amp; Verify Token.</li>
                    <li>Subscribe to the <strong>leadgen</strong> field.</li>
                    <li>Link your Facebook Page in Page Subscriptions.</li>
                </ol>
            </div>
        </div>

        <div class="pt-3 border-t border-slate-100 flex items-center justify-end">
            <button type="button" onclick="document.getElementById('webhook-info-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                Close
            </button>
        </div>
    </div>
</div>

<script>
    // Bulk Selection Logic
    const selectAllCheckbox = document.getElementById('select-all');
    const leadCheckboxes = document.querySelectorAll('.lead-checkbox');
    const bulkActionBar = document.getElementById('bulk-action-bar');
    const selectedCountEl = document.getElementById('selected-count');
    const bulkDeleteInputs = document.getElementById('bulk-delete-inputs');

    function updateBulkState() {
        const checked = Array.from(leadCheckboxes).filter(cb => cb.checked);
        const count = checked.length;

        if (count > 0) {
            bulkActionBar.classList.remove('hidden');
            bulkActionBar.classList.add('flex');
            selectedCountEl.textContent = `${count} lead${count > 1 ? 's' : ''} selected`;

            bulkDeleteInputs.innerHTML = '';
            checked.forEach(cb => {
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'ids[]';
                hidden.value = cb.value;
                bulkDeleteInputs.appendChild(hidden);
            });
        } else {
            bulkActionBar.classList.add('hidden');
            bulkActionBar.classList.remove('flex');
            bulkDeleteInputs.innerHTML = '';
        }
    }

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function () {
            leadCheckboxes.forEach(cb => cb.checked = this.checked);
            updateBulkState();
        });
    }

    leadCheckboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            if (!cb.checked && selectAllCheckbox) selectAllCheckbox.checked = false;
            updateBulkState();
        });
    });

    // ==========================================
    // LEAD FOLLOW-UP MODAL & REALTIME LOGIC
    // ==========================================
    let currentFollowupLeadId = null;

    function openFollowupModal(leadId, name, phone, email, status) {
        currentFollowupLeadId = leadId;

        // Populate Lead Info in Modal Header
        document.getElementById('modal-lead-name').textContent = name || 'Lead #' + leadId;
        document.getElementById('modal-lead-email').textContent = email ? '• ' + email : '';
        
        const phoneContainer = document.getElementById('modal-lead-phone-container');
        if (phone) {
            const cleanPhone = phone.replace(/[^0-9]/g, '');
            phoneContainer.innerHTML = `
                <a href="tel:${phone}" class="hover:text-blue-600 font-mono inline-flex items-center gap-1 font-bold">
                    <span>📞</span> <span>${phone}</span>
                </a>
                ${cleanPhone ? `
                    <a href="https://wa.me/${cleanPhone}" target="_blank" class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 font-bold border border-emerald-200 hover:bg-emerald-100 transition inline-flex items-center gap-1 text-[11px]">
                        <span>💬</span> WhatsApp
                    </a>
                ` : ''}
            `;
        } else {
            phoneContainer.innerHTML = '<span class="text-slate-400">No phone recorded</span>';
        }

        // Set Default Date & Time to Now
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('followup-date-input').value = `${year}-${month}-${day}T${hours}:${minutes}`;

        // Reset Notes & Next Date
        document.getElementById('followup-notes-input').value = '';
        document.getElementById('followup-next-date-input').value = '';
        document.getElementById('followup-modal-alert').classList.add('hidden');

        // Select 'calling' as default type in dropdown
        const typeSelect = document.getElementById('followup-type-select');
        if (typeSelect) typeSelect.value = 'calling';

        const statusSelect = document.getElementById('followup-status-input');
        if (statusSelect) statusSelect.value = 'interested';

        // Show Modal
        document.getElementById('lead-followup-modal').classList.remove('hidden');

        // Fetch History
        fetchFollowupHistory(leadId);
    }

    function closeFollowupModal() {
        document.getElementById('lead-followup-modal').classList.add('hidden');
        currentFollowupLeadId = null;
    }

    // Close on Escape Key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeFollowupModal();
        }
    });

    async function fetchFollowupHistory(leadId) {
        const historyContainer = document.getElementById('followup-history-container');
        historyContainer.innerHTML = `
            <div class="py-8 text-center text-slate-400">
                <svg class="animate-spin h-5 w-5 mx-auto mb-2 text-indigo-500" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                <span>Loading follow-up timeline...</span>
            </div>
        `;

        try {
            const res = await fetch(`/admin/leads/${leadId}/followups-list`, {
                headers: { 'Accept': 'application/json' }
            });
            const data = await res.json();

            if (data.success && data.followups && data.followups.length > 0) {
                renderFollowupList(data.followups);
            } else {
                historyContainer.innerHTML = `
                    <div class="py-8 text-center text-slate-400 bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                        <span class="text-2xl block mb-1">⏱️</span>
                        <p class="font-bold text-slate-700 text-xs">No follow-up history yet</p>
                        <p class="text-[11px] text-slate-400">Use the quick form above to log your first call or WhatsApp interaction!</p>
                    </div>
                `;
            }
        } catch (err) {
            historyContainer.innerHTML = `
                <div class="p-3 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-xl">
                    Failed to load follow-up history: ${err.message}
                </div>
            `;
        }
    }

    function renderFollowupList(followups) {
        const historyContainer = document.getElementById('followup-history-container');
        let html = '<div class="relative pl-7 border-l-2 border-indigo-200 ml-3.5 space-y-4 my-2 max-h-[360px] overflow-y-auto pr-2">';

        followups.forEach(f => {
           
            let channelBadge = '';
            let ringColor = 'border-blue-500 bg-blue-50 text-blue-700';

            if (f.type === 'calling') {
       
                channelBadge = '<span class="px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 font-bold border border-blue-200 text-[10px]">Phone Call</span>';
                ringColor = 'border-blue-500 bg-blue-50 text-blue-700';
            } else if (f.type === 'whatsapp') {
               
                channelBadge = '<span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 font-bold border border-emerald-200 text-[10px]">WhatsApp</span>';
                ringColor = 'border-emerald-500 bg-emerald-50 text-emerald-700';
            } else if (f.type === 'both') {
               
                channelBadge = '<span class="px-2 py-0.5 rounded-md bg-purple-50 text-purple-700 font-bold border border-purple-200 text-[10px]">Call & WhatsApp</span>';
                ringColor = 'border-purple-500 bg-purple-50 text-purple-700';
            } else {
                
                channelBadge = `<span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 font-bold border border-slate-200 text-[10px]">${f.type_label}</span>`;
                ringColor = 'border-slate-400 bg-slate-50 text-slate-700';
            }

            let statusBadge = '';
            if (f.status === 'interested' || f.status === 'converted') {
                statusBadge = `<span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-bold text-[10px] border border-emerald-200">${escapeHtml(f.status)}</span>`;
            } else if (f.status === 'callback') {
                statusBadge = '<span class="px-2 py-0.5 rounded-full bg-amber-50 text-amber-700 font-bold text-[10px] border border-amber-200">Callback</span>';
            } else if (f.status === 'not_interested') {
                statusBadge = '<span class="px-2 py-0.5 rounded-full bg-rose-50 text-rose-700 font-bold text-[10px] border border-rose-200">Not Interested</span>';
            } else if (f.status) {
                statusBadge = `<span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-bold text-[10px] border border-slate-200">${escapeHtml(f.status)}</span>`;
            }

            html += `
                <div id="followup-item-${f.id}" class="relative group">
                    <!-- Timeline Node Icon -->
                    <div class="absolute -left-[41px] top-1 w-6 h-6 rounded-full bg-white border-2 ${ringColor} flex items-center justify-center text-[10px] shadow-xs">
                        <span>${channelIcon}</span>
                    </div>

                    <!-- Timeline Card Body -->
                    <div class="p-3 rounded-xl bg-white border border-slate-200 shadow-2xs hover:border-indigo-300 transition space-y-1.5">
                        <div class="flex items-center justify-between gap-2 flex-wrap">
                            <div class="flex items-center gap-1.5">
                                ${channelBadge}
                                ${statusBadge}
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[11px] font-bold text-slate-700">${f.followup_date}</span>
                                <span class="text-[10px] text-slate-400 font-medium">(${f.followup_time_ago})</span>
                                <button type="button" onclick="deleteFollowup(${f.id})" class="text-slate-300 hover:text-rose-600 transition p-0.5" title="Delete record">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                        </div>

                        ${f.notes ? `<div class="text-slate-800 font-medium whitespace-pre-line text-xs pl-0.5 leading-relaxed">${escapeHtml(f.notes)}</div>` : '<div class="text-slate-400 italic text-[11px]">No discussion remarks entered.</div>'}

                        <div class="flex items-center justify-between text-[10px] text-slate-400 pt-1 border-t border-slate-100">
                            <span>Logged by: <strong class="text-slate-600">${escapeHtml(f.created_by_name || 'Admin')}</strong></span>
                            ${f.next_followup_date ? `<span class="font-bold text-indigo-600 bg-indigo-50 px-1.5 py-0.2 rounded border border-indigo-200">📅 Next: ${f.next_followup_date}</span>` : ''}
                        </div>
                    </div>
                </div>
            `;
        });

        html += '</div>';
        historyContainer.innerHTML = html;
    }

    async function submitFollowupLog(e) {
        e.preventDefault();
        if (!currentFollowupLeadId) return;

        const btn = document.getElementById('followup-submit-btn');
        const alertBox = document.getElementById('followup-modal-alert');
        btn.disabled = true;
        btn.innerHTML = '<span>Saving...</span>';

        const type = document.getElementById('followup-type-select')?.value || 'calling';
        const notes = document.getElementById('followup-notes-input').value;
        const status = document.getElementById('followup-status-input').value;
        const followup_date = document.getElementById('followup-date-input').value;
        const next_followup_date = document.getElementById('followup-next-date-input').value;

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const res = await fetch(`/admin/leads/${currentFollowupLeadId}/followups`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    type,
                    notes,
                    status,
                    followup_date,
                    next_followup_date
                })
            });

            const data = await res.json();

            if (data.success) {
                // Flash Success Message
                alertBox.textContent = `✓ ${data.message} (${data.followup.type_label})`;
                alertBox.classList.remove('hidden');

                // Clear input
                document.getElementById('followup-notes-input').value = '';
                document.getElementById('followup-next-date-input').value = '';

                // Update Row Button Counter!
                const countBadge = document.getElementById(`lead-followup-count-${currentFollowupLeadId}`);
                if (countBadge) {
                    countBadge.textContent = data.count;
                }
                const btnEl = document.getElementById(`lead-followup-btn-${currentFollowupLeadId}`);
                if (btnEl && data.count > 0) {
                    btnEl.classList.remove('bg-slate-50', 'text-slate-600', 'border-slate-200');
                    btnEl.classList.add('bg-indigo-50', 'hover:bg-indigo-100', 'text-indigo-700', 'border-indigo-200');
                }

                // Refresh history
                fetchFollowupHistory(currentFollowupLeadId);
            } else {
                alert('Error: ' + (data.message || 'Could not save follow-up.'));
            }
        } catch (err) {
            alert('Failed to save follow-up: ' + err.message);
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<span>Save Follow-up</span>';
        }
    }

    async function deleteFollowup(id) {
        if (!confirm('Are you sure you want to delete this follow-up log?')) return;

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const res = await fetch(`/admin/leads/followups/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            const data = await res.json();

            if (data.success) {
                // Remove item from DOM
                const item = document.getElementById(`followup-item-${id}`);
                if (item) item.remove();

                // Update Row Button Counter
                if (currentFollowupLeadId && data.count !== undefined) {
                    const countBadge = document.getElementById(`lead-followup-count-${currentFollowupLeadId}`);
                    if (countBadge) countBadge.textContent = data.count;
                }
            } else {
                alert('Failed to delete follow-up.');
            }
        } catch (err) {
            alert('Error deleting follow-up: ' + err.message);
        }
    }

    function escapeHtml(text) {
        if (!text) return '';
        const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
        return String(text).replace(/[&<>"']/g, function(m) { return map[m]; });
    }
</script>

<!-- ==========================================
     INTERACTIVE LEAD FOLLOW-UP MODAL
=========================================== -->
<div id="lead-followup-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden animate-fade-in" aria-modal="true" role="dialog">
    <div class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden flex flex-col max-h-[90vh]">
        
        <!-- MODAL HEADER -->
        <div class="p-4 sm:p-5 border-b border-slate-100 bg-gradient-to-r from-slate-50 via-white to-indigo-50/40 flex items-start justify-between gap-3 shrink-0">
            <div>
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-indigo-600 text-white flex items-center justify-center shadow-xs text-sm">
                        📞
                    </div>
                    <div>
                        <h3 class="text-base font-black text-slate-900 tracking-tight" id="modal-lead-name">
                            Lead Follow-up Log
                        </h3>
                    </div>
                </div>
                <div class="flex items-center gap-2 text-xs text-slate-600 mt-1 flex-wrap" id="modal-lead-phone-container">
                    <!-- Dynamic Phone & WhatsApp Link -->
                </div>
                <span class="text-[11px] text-slate-400" id="modal-lead-email"></span>
            </div>

            <button type="button" onclick="closeFollowupModal()" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer" title="Close modal">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <!-- MODAL BODY (SCROLLABLE) -->
        <div class="p-4 sm:p-6 overflow-y-auto space-y-5">
            
            <!-- Success / Flash Notification -->
            <div id="followup-modal-alert" class="hidden p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold animate-fade-in"></div>

            <!-- COMPACT SMALL FORM: LOG NEW FOLLOW-UP -->
            <form onsubmit="submitFollowupLog(event)" class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/90 space-y-2.5 shadow-2xs">
                <div class="flex items-center justify-between pb-1.5 border-b border-slate-200">
                    <span class="text-[11px] font-black uppercase tracking-wider text-slate-700 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span>
                        <span>Log New Interaction</span>
                    </span>
                    <span class="text-[10px] text-slate-400 font-medium">Real-time counter sync</span>
                </div>

                <!-- Row 1: Category Dropdown, Outcome Status, Date & Time, Next Follow-up -->
                <div class="grid gap-2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));">
                    <!-- Category Dropdown -->
                    <div>
                        <label class="block text-[10px] font-bold text-slate-600 mb-1 uppercase tracking-wider">Channel / Category <span class="text-rose-500">*</span>:</label>
                        <select id="followup-type-select" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-xl text-xs text-slate-800 font-bold focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition cursor-pointer">
                            <option value="calling">Phone Call</option>
                            <option value="whatsapp">WhatsApp</option>
                            <option value="both">Call &amp; WhatsApp</option>
                        </select>
                    </div>

                    <!-- Outcome Status Dropdown -->
                    <div>
                        <label class="block text-[10px] font-bold text-slate-600 mb-1 uppercase tracking-wider">Outcome Status:</label>
                        <select id="followup-status-input" class="w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-xl text-xs text-slate-800 font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition cursor-pointer">
                            <option value="interested">Interested</option>
                            <option value="callback">Callback Requested</option>
                            <option value="no_answer">No Answer / Busy</option>
                            <option value="not_interested">Not Interested</option>
                            <option value="converted">Converted / Sale Closed</option>
                        </select>
                    </div>

                    <!-- Date & Time of Follow-up -->
                    <div>
                        <label class="block text-[10px] font-bold text-slate-600 mb-1 uppercase tracking-wider">Date &amp; Time:</label>
                        <input type="datetime-local" id="followup-date-input" class="w-full px-2 py-1.5 bg-white border border-slate-200 rounded-xl text-xs text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition">
                    </div>

                    <!-- Next Follow-up Schedule (Optional) -->
                    <div>
                        <label class="block text-[10px] font-bold text-slate-600 mb-1 uppercase tracking-wider">Next Follow-up (Opt):</label>
                        <input type="datetime-local" id="followup-next-date-input" class="w-full px-2 py-1.5 bg-white border border-slate-200 rounded-xl text-xs text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition">
                    </div>
                </div>

                <!-- Row 2: Discussion Summary & Submit Button Inline -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 pt-1">
                    <div class="flex-1">
                        <input type="text" id="followup-notes-input" placeholder="Discussion summary / customer remarks..." class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition">
                    </div>
                    <button type="submit" id="followup-submit-btn" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition inline-flex items-center justify-center gap-1.5 shadow-sm cursor-pointer shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        <span>Save Follow-up</span>
                    </button>
                </div>
            </form>

            <!-- SECTION: PREVIOUS FOLLOW-UP AUDIT TIMELINE -->
            <div class="space-y-3 pt-1">
                <div class="flex items-center justify-between pb-1.5 border-b border-slate-100">
                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-700 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        <span>Follow-up Timeline &amp; Activity Trail</span>
                    </h4>
                    <a href="{{ route('admin.leads.followups.index') }}" target="_blank" class="text-[11px] font-bold text-indigo-600 hover:text-indigo-800 transition">
                        View All Logs &rarr;
                    </a>
                </div>

                <div id="followup-history-container">
                    <!-- Dynamic timeline rendered via JS -->
                </div>
            </div>

        </div>

        <!-- MODAL FOOTER -->
        <div class="p-3.5 border-t border-slate-100 bg-slate-50/50 flex items-center justify-end shrink-0">
            <button type="button" onclick="closeFollowupModal()" class="px-4 py-1.5 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold transition">
                Close
            </button>
        </div>
    </div>
</div>

@endsection

