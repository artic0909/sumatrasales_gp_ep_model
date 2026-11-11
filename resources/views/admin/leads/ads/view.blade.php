@extends('admin.layouts.app')

@section('title', 'Lead Details - ' . ($lead->name ?? 'Lead #' . $lead->id))

@section('content')
<div class="space-y-6">

    <!-- BREADCRUMB & HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/80">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 font-semibold mb-1">
                <a href="{{ route('admin.leads.index') }}" class="hover:text-blue-600 transition flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                    <span>Back to Facebook Leads</span>
                </a>
                <span>/</span>
                <span class="text-slate-800 font-bold">Lead #{{ $lead->id }}</span>
            </div>
            <div class="flex items-center gap-3">
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                    {{ $lead->name ?? 'Unnamed Lead' }}
                </h1>
                <!-- Review Status Badge -->
                <span class="px-2.5 py-0.5 rounded-full text-xs font-black uppercase tracking-wider
                    {{ $lead->status === 'good_lead' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : '' }}
                    {{ $lead->status === 'new' ? 'bg-blue-100 text-blue-800 border border-blue-200' : '' }}
                    {{ $lead->status === 'bad_lead' ? 'bg-rose-100 text-rose-800 border border-rose-200' : '' }}
                    {{ $lead->status === 'contacted' ? 'bg-amber-100 text-amber-800 border border-amber-200' : '' }}">
                    {{ ucfirst(str_replace('_', ' ', $lead->status)) }}
                </span>
            </div>
            <p class="text-xs text-slate-500 font-medium mt-0.5">
                Submitted via Facebook Ad: <strong class="text-slate-700">{{ $lead->ad_name ?? ($lead->ad_id ? 'Ad ID: '.$lead->ad_id : 'Manual / Direct') }}</strong>
                &bull; {{ $lead->created_at ? $lead->created_at->format('M d, Y h:i A') : 'N/A' }}
            </p>
        </div>

        <!-- QUICK ACTION BAR -->
        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('admin.leads.edit', $lead->id) }}" class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition inline-flex items-center gap-1.5 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                <span>Edit Lead</span>
            </a>

            <!-- Sync to Meta CAPI Form -->
            <form action="{{ route('admin.leads.syncCapi', $lead->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-3.5 py-2 rounded-xl {{ $lead->synced_to_fb ? 'bg-emerald-600 hover:bg-emerald-700' : 'bg-blue-600 hover:bg-blue-700' }} text-white text-xs font-bold transition inline-flex items-center gap-1.5 shadow-sm cursor-pointer">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    <span>{{ $lead->synced_to_fb ? 'Resync to Meta CAPI' : 'Push to Meta CAPI' }}</span>
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN TWO-COLUMN DETAILS LAYOUT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT 2 COLUMNS: CUSTOMER CONTACT & FORM DATA -->
        <div class="lg:col-span-2 space-y-6">

            <!-- CONTACT INFORMATION CARD -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                        </div>
                        <h3 class="text-sm font-black text-slate-900">Lead Contact Details</h3>
                    </div>
                    <span class="text-[11px] font-mono text-slate-400">ID: #{{ $lead->id }}</span>
                </div>

                <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-slate-400 font-bold block mb-1 uppercase tracking-wider text-[10px]">Full Name</span>
                        <p class="text-slate-900 font-bold text-sm">{{ $lead->name ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <span class="text-slate-400 font-bold block mb-1 uppercase tracking-wider text-[10px]">Phone Number</span>
                        @if($lead->phone)
                            <a href="tel:{{ $lead->phone }}" class="text-blue-600 hover:underline font-mono font-bold text-sm inline-flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                                <span>{{ $lead->phone }}</span>
                            </a>
                        @else
                            <p class="text-slate-500 font-medium">Not provided</p>
                        @endif
                    </div>

                    <div>
                        <span class="text-slate-400 font-bold block mb-1 uppercase tracking-wider text-[10px]">Email Address</span>
                        @if($lead->email)
                            <a href="mailto:{{ $lead->email }}" class="text-blue-600 hover:underline font-mono font-bold inline-flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                                <span>{{ $lead->email }}</span>
                            </a>
                        @else
                            <p class="text-slate-500 font-medium">Not provided</p>
                        @endif
                    </div>

                    <div>
                        <span class="text-slate-400 font-bold block mb-1 uppercase tracking-wider text-[10px]">Submitted Date &amp; Time</span>
                        <p class="text-slate-700 font-medium">{{ $lead->created_at ? $lead->created_at->format('l, F j, Y - g:i:s A') : 'N/A' }}</p>
                    </div>
                </div>

                @if($lead->notes)
                    <div class="px-5 pb-5">
                        <span class="text-slate-400 font-bold block mb-1 uppercase tracking-wider text-[10px]">Admin Notes</span>
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-xs text-slate-700 whitespace-pre-line">
                            {{ $lead->notes }}
                        </div>
                    </div>
                @endif
            </div>

            <!-- FACEBOOK INSTANT FORM QUESTIONS & SUBMITTED DATA -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" /></svg>
                        </div>
                        <h3 class="text-sm font-black text-slate-900">Facebook Instant Form Response Data</h3>
                    </div>
                    <span class="text-[11px] font-mono text-slate-400">Form ID: {{ $lead->form_id ?? 'N/A' }}</span>
                </div>

                <div class="p-5">
                    @php
                        $fieldData = $lead->raw_data['field_data'] ?? null;
                    @endphp

                    @if(!empty($fieldData) && is_array($fieldData))
                        <div class="space-y-3">
                            @foreach ($fieldData as $field)
                                @php
                                    $fieldName = $field['name'] ?? 'Question';
                                    $values = $field['values'] ?? [];
                                    $cleanLabel = ucwords(str_replace(['_', '-'], ' ', $fieldName));
                                @endphp
                                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                    <span class="text-xs font-bold text-slate-600 sm:w-1/3">{{ $cleanLabel }}:</span>
                                    <span class="text-xs font-black text-slate-900 sm:w-2/3 break-words">
                                        {{ !empty($values) ? implode(', ', $values) : '—' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-center text-xs text-slate-500">
                            No additional custom field data found in the webhook payload.
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: AD ATTRIBUTION & META CAPI STATUS -->
        <div class="space-y-6">

            <!-- REVIEW & STATUS MANAGEMENT CARD -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-5 space-y-4">
                <h3 class="text-sm font-black text-slate-900 border-b border-slate-100 pb-3">
                    Lead Status Action
                </h3>

                <form action="{{ route('admin.leads.updateStatus', $lead->id) }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">
                            Update Lead Review Status
                        </label>
                        <select name="status" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
                            <option value="new" {{ $lead->status === 'new' ? 'selected' : '' }}>New Unreviewed</option>
                            <option value="good_lead" {{ $lead->status === 'good_lead' ? 'selected' : '' }}>Good Lead (Triggers Meta CAPI)</option>
                            <option value="bad_lead" {{ $lead->status === 'bad_lead' ? 'selected' : '' }}>Bad / Invalid Lead</option>
                            <option value="contacted" {{ $lead->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                        </select>
                        <p class="text-[10px] text-slate-500 mt-1">
                            Selecting <strong>Good Lead</strong> will automatically dispatch a <code>QualifiedLead</code> event to Meta Conversions API.
                        </p>
                    </div>

                    <button type="submit" class="w-full px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition shadow-sm cursor-pointer">
                        Update Status
                    </button>
                </form>
            </div>

            <!-- META CONVERSIONS API (CAPI) STATUS CARD -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-5 space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </div>
                        <h3 class="text-sm font-black text-slate-900">Meta CAPI Feedback</h3>
                    </div>
                    @if($lead->synced_to_fb)
                        <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-black uppercase">
                            Delivered
                        </span>
                    @else
                        <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[10px] font-black uppercase">
                            Not Sent
                        </span>
                    @endif
                </div>

                <div class="space-y-2 text-xs">
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500 font-medium">Standard Event:</span>
                        <span class="font-mono font-bold text-slate-800">QualifiedLead</span>
                    </div>
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500 font-medium">Action Source:</span>
                        <span class="font-mono font-bold text-slate-800">system_generated</span>
                    </div>
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500 font-medium">Hashed Identifiers:</span>
                        <span class="font-mono text-[11px] text-slate-700">email (em), phone (ph)</span>
                    </div>
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-500 font-medium">Last Synced At:</span>
                        <span class="font-medium text-slate-700">{{ $lead->synced_at ? $lead->synced_at->format('M d, Y h:i A') : 'Never' }}</span>
                    </div>
                </div>

                <form action="{{ route('admin.leads.syncCapi', $lead->id) }}" method="POST" class="pt-2">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 rounded-xl {{ $lead->synced_to_fb ? 'bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-blue-600 hover:bg-blue-700 text-white' }} text-xs font-bold transition shadow-xs cursor-pointer inline-flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                        <span>{{ $lead->synced_to_fb ? 'Force Resend Event' : 'Send QualifiedLead Event Now' }}</span>
                    </button>
                </form>
            </div>

            <!-- AD ATTRIBUTION METADATA CARD -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-5 space-y-4">
                <h3 class="text-sm font-black text-slate-900 border-b border-slate-100 pb-3">
                    Meta Ad Attribution Metadata
                </h3>

                <div class="space-y-2.5 text-xs">
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Ad Name</span>
                        <p class="font-bold text-slate-800">{{ $lead->ad_name ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Ad ID</span>
                        <p class="font-mono text-slate-700">{{ $lead->ad_id ?? 'N/A' }}</p>
                    </div>

                    @if($lead->campaign_name || $lead->campaign_id)
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Campaign</span>
                            <p class="font-bold text-slate-800">{{ $lead->campaign_name ?? 'N/A' }}</p>
                            <p class="font-mono text-[11px] text-slate-500">ID: {{ $lead->campaign_id ?? 'N/A' }}</p>
                        </div>
                    @endif

                    @if($lead->adset_name || $lead->adset_id)
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">AdSet</span>
                            <p class="font-bold text-slate-800">{{ $lead->adset_name ?? 'N/A' }}</p>
                            <p class="font-mono text-[11px] text-slate-500">ID: {{ $lead->adset_id ?? 'N/A' }}</p>
                        </div>
                    @endif

                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Meta Leadgen ID</span>
                        <p class="font-mono text-slate-700">{{ $lead->fb_leadgen_id ?? 'N/A' }}</p>
                    </div>

                    @if($lead->form_id)
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Instant Form ID</span>
                            <p class="font-mono text-slate-700">{{ $lead->form_id }}</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

</div>
@endsection

