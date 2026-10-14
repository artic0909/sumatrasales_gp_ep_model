@extends('admin.layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
<div class="space-y-6">

    <!-- HERO WELCOME BANNER -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 text-white p-6 sm:p-7 shadow-xl border border-slate-800">
        <div class="absolute right-0 top-0 translate-x-8 -translate-y-8 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-blue-500/20 text-blue-300 text-[10px] font-black uppercase tracking-wider border border-blue-400/30">
                    <span>Administrative Command Center</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-white tracking-tight">
                    Welcome back, Administrator 👋
                </h1>
                <p class="text-xs sm:text-sm text-slate-300">
                    Real-time dashboard for Sumatra Sales Executive Partner (EP) and Ground Partner (GP) onboarding.
                </p>
            </div>
            <div class="flex items-center gap-2.5 shrink-0">
                <a href="{{ route('partner.register') }}" target="_blank" class="px-4 py-2 rounded-xl bg-[#2964F2] hover:bg-blue-600 text-white text-xs font-bold transition shadow-md inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    <span>New Application</span>
                </a>
                <a href="{{ route('admin.ep.index') }}" class="px-3.5 py-2 rounded-xl bg-white/10 hover:bg-white/15 text-white text-xs font-bold transition border border-white/10">
                    Manage Network
                </a>
            </div>
        </div>
    </div>

    <!-- 4 KEY STAT METRICS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Total Partners -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase text-slate-400 tracking-wider">Total Applications</span>
                <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#2964F2] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                </div>
            </div>
            <div class="mt-3">
                <span class="text-2xl sm:text-3xl font-black text-slate-900 leading-tight">{{ number_format($totalPartners) }}</span>
                <span class="block text-[11px] text-slate-500 font-medium mt-0.5">Across All Programs</span>
            </div>
        </div>

        <!-- Executive Partners (EP) -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase text-blue-600 tracking-wider">Executive Partners (EP)</span>
                <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#2964F2] flex items-center justify-center font-black text-xs">
                    EP
                </div>
            </div>
            <div class="mt-3">
                <span class="text-2xl sm:text-3xl font-black text-slate-900 leading-tight">{{ number_format($totalEp) }}</span>
                <span class="block text-[11px] text-slate-500 font-medium mt-0.5">{{ $epPercentage }}% of Total Network</span>
            </div>
        </div>

        <!-- Ground Partners (GP) -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase text-emerald-600 tracking-wider">Ground Partners (GP)</span>
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-xs">
                    GP
                </div>
            </div>
            <div class="mt-3">
                <span class="text-2xl sm:text-3xl font-black text-slate-900 leading-tight">{{ number_format($totalGp) }}</span>
                <span class="block text-[11px] text-slate-500 font-medium mt-0.5">{{ $gpPercentage }}% of Total Network</span>
            </div>
        </div>

        <!-- KYC Status -->
        <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase text-slate-400 tracking-wider">Verification Status</span>
                <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-2.171 7.24a9 9 0 1 1 8.486-8.486 9 9 0 0 1-8.486 8.486Z" /></svg>
                </div>
            </div>
            <div class="mt-3">
                <span class="text-2xl sm:text-3xl font-black text-slate-900 leading-tight">{{ number_format($totalPartners) }}</span>
                <span class="block text-[11px] text-emerald-600 font-bold mt-0.5 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Pending Verification
                </span>
            </div>
        </div>

    </div>

    <!-- PARTNER DISTRIBUTION PROGRESS BAR -->
    <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-xs space-y-2.5">
        <div class="flex items-center justify-between text-xs font-bold">
            <span class="text-slate-700">Network Distribution Ratio</span>
            <div class="flex items-center gap-4 text-[11px]">
                <span class="text-[#2964F2] font-black">● EP: {{ $epPercentage }}% ({{ $totalEp }})</span>
                <span class="text-emerald-600 font-black">● GP: {{ $gpPercentage }}% ({{ $totalGp }})</span>
            </div>
        </div>
        <div class="w-full h-3 rounded-full bg-slate-100 overflow-hidden flex">
            <div class="bg-[#2964F2] h-full transition-all duration-500" style="width: {{ $epPercentage }}%"></div>
            <div class="bg-emerald-500 h-full transition-all duration-500" style="width: {{ $gpPercentage }}%"></div>
        </div>
    </div>

    <!-- RECENT APPLICATIONS SECTION -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
        
        <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between gap-4">
            <div>
                <h2 class="text-sm sm:text-base font-black text-slate-900">Recent Applications</h2>
                <p class="text-xs text-slate-400 font-medium">Latest partner candidates submitted through the registration portal</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.ep.index') }}" class="text-xs font-bold text-[#2964F2] hover:underline">View All EP →</a>
                <span class="text-slate-300">•</span>
                <a href="{{ route('admin.gp.index') }}" class="text-xs font-bold text-emerald-600 hover:underline">View All GP →</a>
            </div>
        </div>

        @if ($latestPartners->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50/80 text-slate-400 font-bold uppercase tracking-wider text-[10px] border-b border-slate-100">
                        <tr>
                            <th class="py-3 px-4">Ref Code</th>
                            <th class="py-3 px-4">Role</th>
                            <th class="py-3 px-4">Applicant Name</th>
                            <th class="py-3 px-4">Contact Info</th>
                            <th class="py-3 px-4">Location</th>
                            <th class="py-3 px-4">Applied Date</th>
                            <th class="py-3 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach ($latestPartners as $partner)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 px-4 font-mono font-bold text-slate-900">
                                    {{ $partner->application_code ?: 'SSPL-'.$partner->id }}
                                </td>
                                <td class="py-3 px-4">
                                    @if ($partner->registration_type === 'GP')
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-black bg-emerald-50 text-emerald-700 border border-emerald-200">GP</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-black bg-blue-50 text-[#2964F2] border border-blue-200">EP</span>
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
                                <td class="py-3 px-4 text-right space-x-1.5 whitespace-nowrap">
                                    <button type="button" onclick="openPartnerModal({{ json_encode($partner) }})" class="px-2.5 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 text-[#2964F2] text-[11px] font-bold transition">
                                        View Details
                                    </button>
                                    @if (!empty($partner->application_code))
                                        <a href="{{ route('partner.application.pdf', ['code' => $partner->application_code]) }}" target="_blank" class="px-2 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 text-[11px] font-bold transition inline-block">
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
