@extends('admin.layouts.app')

@section('title', 'Lead Follow-ups & Activity Logs')

@section('content')
<div class="space-y-6">

    <!-- HEADER & ACTION BAR -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/80">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 text-[10px] font-black uppercase tracking-wider border border-indigo-200">
                <svg class="w-3 h-3 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                <span>CRM Calling &amp; WhatsApp Audit Trail</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mt-1">
                Lead Follow-ups &amp; Communications
            </h1>
            <p class="text-xs text-slate-500 font-medium">
                Complete history of calling, WhatsApp messages, and conversation outcomes logged for each Facebook Ad lead.
            </p>
        </div>

        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('admin.leads.index') }}" class="px-3.5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition inline-flex items-center gap-1.5 shadow-sm cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" /></svg>
                <span>Back to All Leads</span>
            </a>
            <a href="{{ route('admin.ads.index') }}" class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition inline-flex items-center gap-1.5 cursor-pointer">
                <span>Meta Ads Overview</span>
            </a>
        </div>
    </div>

    <!-- QUICK COMPACT STAT PILLS -->
    <div class="grid gap-2.5" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));">
        <!-- Total Followups -->
        <div class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl bg-white border border-slate-200/90 shadow-2xs hover:border-slate-300 transition">
            <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center shrink-0">
                <span class="w-2.5 h-2.5 rounded-full bg-slate-500"></span>
            </div>
            <div class="min-w-0">
                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider block truncate">Total Logs</span>
                <span class="text-sm sm:text-base font-black text-slate-900 leading-tight">{{ number_format($totalFollowups ?? 0) }}</span>
            </div>
        </div>

        <!-- Phone Calls -->
        <div class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl bg-blue-50/80 border border-blue-200/90 shadow-2xs">
            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center shrink-0 text-sm">
                📞
            </div>
            <div class="min-w-0">
                <span class="text-[9px] font-bold text-blue-700 uppercase tracking-wider block truncate">Phone Calls</span>
                <span class="text-sm sm:text-base font-black text-blue-950 leading-tight">{{ number_format($callingCount ?? 0) }}</span>
            </div>
        </div>

        <!-- WhatsApp -->
        <div class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl bg-emerald-50/80 border border-emerald-200/90 shadow-2xs">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0 text-sm">
                💬
            </div>
            <div class="min-w-0">
                <span class="text-[9px] font-bold text-emerald-700 uppercase tracking-wider block truncate">WhatsApp Chats</span>
                <span class="text-sm sm:text-base font-black text-emerald-950 leading-tight">{{ number_format($whatsappCount ?? 0) }}</span>
            </div>
        </div>

        <!-- Both (Call & WhatsApp) -->
        <div class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl bg-purple-50/80 border border-purple-200/90 shadow-2xs">
            <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center shrink-0 text-xs">
                📞💬
            </div>
            <div class="min-w-0">
                <span class="text-[9px] font-bold text-purple-700 uppercase tracking-wider block truncate">Call &amp; WhatsApp</span>
                <span class="text-sm sm:text-base font-black text-purple-950 leading-tight">{{ number_format($bothCount ?? 0) }}</span>
            </div>
        </div>

        <!-- Today's Followups -->
        <div class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl bg-amber-50/80 border border-amber-200/90 shadow-2xs">
            <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center shrink-0 text-sm">
                ⚡
            </div>
            <div class="min-w-0">
                <span class="text-[9px] font-bold text-amber-700 uppercase tracking-wider block truncate">Logged Today</span>
                <span class="text-sm sm:text-base font-black text-amber-950 leading-tight">{{ number_format($todayCount ?? 0) }}</span>
            </div>
        </div>
    </div>

    <!-- SEARCH & FILTER TOOLBAR -->
    <form action="{{ route('admin.leads.followups.index') }}" method="GET" class="p-3.5 bg-white rounded-2xl border border-slate-200/90 shadow-xs flex flex-col md:flex-row items-center justify-between gap-3">
        <div class="relative w-full md:w-80">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by lead name, phone, notes..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
        </div>

        <div class="flex items-center gap-2 w-full md:w-auto flex-wrap sm:flex-nowrap">
            <!-- Filter by Date Range (From & To) -->
            <div class="flex items-center gap-1.5 px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl focus-within:ring-2 focus-within:ring-blue-500/20 focus-within:border-blue-500">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">From:</span>
                <input type="date" name="from_date" value="{{ request('from_date') }}" onchange="this.form.submit()" class="bg-transparent text-xs text-slate-700 font-medium focus:outline-none cursor-pointer">
            </div>

            <div class="flex items-center gap-1.5 px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl focus-within:ring-2 focus-within:ring-blue-500/20 focus-within:border-blue-500">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">To:</span>
                <input type="date" name="to_date" value="{{ request('to_date') }}" onchange="this.form.submit()" class="bg-transparent text-xs text-slate-700 font-medium focus:outline-none cursor-pointer">
            </div>

            <!-- Filter by Channel / Type -->
            <select name="type" onchange="this.form.submit()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
                <option value="">All Channels</option>
                <option value="calling" {{ request('type') === 'calling' ? 'selected' : '' }}>Phone Call</option>
                <option value="whatsapp" {{ request('type') === 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                <option value="both" {{ request('type') === 'both' ? 'selected' : '' }}>Call &amp; WhatsApp</option>
            </select>

            <!-- Filter by Status -->
            <select name="status" onchange="this.form.submit()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
                <option value="">All Outcomes</option>
                <option value="interested" {{ request('status') === 'interested' ? 'selected' : '' }}>Interested</option>
                <option value="callback" {{ request('status') === 'callback' ? 'selected' : '' }}>Callback Requested</option>
                <option value="no_answer" {{ request('status') === 'no_answer' ? 'selected' : '' }}>No Answer / Busy</option>
                <option value="not_interested" {{ request('status') === 'not_interested' ? 'selected' : '' }}>Not Interested</option>
                <option value="converted" {{ request('status') === 'converted' ? 'selected' : '' }}>Converted / Closed</option>
            </select>

            <!-- Per Page Dropdown -->
            <div class="flex items-center gap-1.5">
                <span class="text-[11px] font-bold text-slate-400">Show:</span>
                <select name="per_page" onchange="this.form.submit()" class="px-2.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
                    <option value="15" {{ request('per_page') == '15' ? 'selected' : '' }}>15</option>
                    <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
                </select>
            </div>

            @if(request()->anyFilled(['search', 'type', 'status', 'from_date', 'to_date', 'per_page']))
                <a href="{{ route('admin.leads.followups.index') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-bold transition">
                    Reset
                </a>
            @endif
        </div>
    </form>

    <!-- FOLLOW-UPS DATA TABLE -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/75 text-[11px] font-black uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-4">Lead Contact Details</th>
                        <th class="py-3.5 px-4">Channel / Type</th>
                        <th class="py-3.5 px-4">Outcome Status</th>
                        <th class="py-3.5 px-4">Discussion Notes</th>
                        <th class="py-3.5 px-4">Logged At</th>
                        <th class="py-3.5 px-4">Next Scheduled</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse ($followups as $followup)
                        @php
                            $lead = $followup->lead;
                            $cleanPhone = $lead ? preg_replace('/[^0-9]/', '', $lead->phone) : '';
                        @endphp
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <!-- Lead Contact -->
                            <td class="py-3.5 px-4">
                                @if($lead)
                                    <div class="space-y-0.5">
                                        <a href="{{ route('admin.leads.show', $lead->id) }}" class="font-bold text-slate-900 hover:text-blue-600 transition block">
                                            {{ $lead->name ?: 'Unnamed Lead' }}
                                        </a>
                                        <div class="flex items-center gap-2 text-[11px] text-slate-500 flex-wrap">
                                            @if($lead->phone)
                                                <div class="flex items-center gap-1 font-mono">
                                                    <a href="tel:{{ $lead->phone }}" class="hover:text-blue-600 inline-flex items-center gap-0.5">
                                                        <span>📞</span>
                                                        <span>{{ $lead->phone }}</span>
                                                    </a>
                                                    @if(!empty($cleanPhone))
                                                        <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" title="Open WhatsApp chat" class="px-1 py-0.2 rounded bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-200 hover:bg-emerald-100 transition">
                                                            WhatsApp
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                            @if($lead->email)
                                                <span class="text-slate-400">• {{ $lead->email }}</span>
                                            @endif
                                        </div>
                                        @if($lead->campaign_name || $lead->ad_name)
                                            <div class="text-[10px] text-slate-400 truncate max-w-xs" title="{{ $lead->campaign_name ?: $lead->ad_name }}">
                                                Ad: <strong class="text-slate-600">{{ preg_replace('/^Post:\s*"?|"?$/u', '', $lead->campaign_name ?: $lead->ad_name) }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-slate-400 italic font-medium">Deleted Lead (#{{ $followup->lead_id }})</span>
                                @endif
                            </td>

                            <!-- Channel / Type -->
                            <td class="py-3.5 px-4">
                                @if($followup->type === 'calling')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 text-xs font-bold border border-blue-200">
                                        <span>📞</span>
                                        <span>Phone Call</span>
                                    </span>
                                @elseif($followup->type === 'whatsapp')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200">
                                        <span>💬</span>
                                        <span>WhatsApp</span>
                                    </span>
                                @elseif($followup->type === 'both')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-purple-50 text-purple-700 text-xs font-bold border border-purple-200">
                                        <span>📞💬</span>
                                        <span>Call &amp; WhatsApp</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-xs font-bold border border-slate-200">
                                        <span>📋</span>
                                        <span>{{ ucfirst($followup->type) }}</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Outcome Status -->
                            <td class="py-3.5 px-4">
                                @if($followup->status === 'interested' || $followup->status === 'converted')
                                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[11px] font-bold border border-emerald-200">
                                        {{ ucfirst($followup->status) }}
                                    </span>
                                @elseif($followup->status === 'callback')
                                    <span class="px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-700 text-[11px] font-bold border border-amber-200">
                                        Callback
                                    </span>
                                @elseif($followup->status === 'no_answer')
                                    <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[11px] font-bold border border-slate-200">
                                        No Answer
                                    </span>
                                @elseif($followup->status === 'not_interested')
                                    <span class="px-2.5 py-0.5 rounded-full bg-rose-50 text-rose-700 text-[11px] font-bold border border-rose-200">
                                        Not Interested
                                    </span>
                                @elseif($followup->status)
                                    <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 text-[11px] font-bold border border-slate-200">
                                        {{ ucfirst($followup->status) }}
                                    </span>
                                @else
                                    <span class="text-slate-400 text-xs">—</span>
                                @endif
                            </td>

                            <!-- Discussion Notes -->
                            <td class="py-3.5 px-4 max-w-sm">
                                <div class="text-slate-800 font-medium whitespace-pre-line leading-relaxed">
                                    {{ $followup->notes ?: 'No specific discussion notes entered.' }}
                                </div>
                                <span class="text-[10px] text-slate-400 block mt-0.5">
                                    By: <strong>{{ $followup->created_by_name ?: 'Admin' }}</strong>
                                </span>
                            </td>

                            <!-- Logged At -->
                            <td class="py-3.5 px-4 text-slate-600 whitespace-nowrap">
                                <div class="font-bold text-slate-900">
                                    {{ $followup->followup_date ? $followup->followup_date->format('M d, Y') : 'N/A' }}
                                </div>
                                <div class="text-[11px] text-slate-400">
                                    {{ $followup->followup_date ? $followup->followup_date->format('h:i A') : '' }}
                                    @if($followup->followup_date)
                                        ({{ $followup->followup_date->diffForHumans() }})
                                    @endif
                                </div>
                            </td>

                            <!-- Next Scheduled -->
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                @if($followup->next_followup_date)
                                    <div class="inline-flex items-center gap-1 text-indigo-700 font-bold bg-indigo-50 px-2 py-0.5 rounded-md border border-indigo-200 text-[11px]">
                                        <span>📅</span>
                                        <span>{{ $followup->next_followup_date->format('M d, Y h:i A') }}</span>
                                    </div>
                                @else
                                    <span class="text-slate-400 text-xs">—</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    @if($lead)
                                        <a href="{{ route('admin.leads.show', $lead->id) }}" class="p-1.5 rounded-lg bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 transition" title="View Lead Profile">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                        </a>
                                    @endif

                                    <form action="{{ route('admin.leads.followups.destroy', $followup->id) }}" method="POST" onsubmit="return confirm('Delete this follow-up record?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg bg-slate-100 hover:bg-rose-50 text-slate-400 hover:text-rose-600 transition cursor-pointer" title="Delete Follow-up Log">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <div class="max-w-sm mx-auto space-y-3">
                                    <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 flex items-center justify-center text-xl">
                                        📞
                                    </div>
                                    <p class="font-bold text-slate-700">No Follow-up Logs Recorded Yet</p>
                                    <p class="text-xs text-slate-400">
                                        Go to the <a href="{{ route('admin.leads.index') }}" class="text-blue-600 font-bold underline">Leads Table</a> and click on the Follow-ups counting button on any lead row to log your first call or WhatsApp interaction!
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($followups->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $followups->links() }}
            </div>
        @endif
    </div>

</div>
@endsection

