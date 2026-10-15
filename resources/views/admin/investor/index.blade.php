@extends('admin.layouts.app')

@section('title', 'Investor Relations')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/80">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-800 text-[10px] font-black uppercase tracking-wider border border-amber-200">
                <span>Capital & Stakeholders</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mt-1">
                Investor Relations & Strategic Partnerships
            </h1>
            <p class="text-xs text-slate-500 font-medium">
                Monitor capital investments, prospective institutional and angel inquiries across the Sumatra Sales ecosystem.
            </p>
        </div>
    </div>

    <!-- ECOSYSTEM STATS OVERVIEW -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-xs">
            <span class="text-xs font-bold uppercase text-slate-400">Software Ecosystem</span>
            <span class="text-2xl font-black text-slate-900 block mt-2">4 Platforms</span>
            <span class="text-[11px] text-slate-500">Doctorwala • Schoolwala • Rani • Custom Software</span>
        </div>
        <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-xs">
            <span class="text-xs font-bold uppercase text-slate-400">Total Partner Base</span>
            <span class="text-2xl font-black text-[#2964F2] block mt-2">{{ \App\Models\Partner::count() }} Partners</span>
            <span class="text-[11px] text-slate-500">Field-verified Network</span>
        </div>
        <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-xs">
            <span class="text-xs font-bold uppercase text-slate-400">Target Capital Stage</span>
            <span class="text-2xl font-black text-emerald-600 block mt-2">Series A Expansion</span>
            <span class="text-[11px] text-slate-500">Pan-India Geographic Rollout</span>
        </div>
    </div>

    <!-- INVESTOR INQUIRIES CARD -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-6 text-center">
        <div class="w-12 h-12 mx-auto rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
        </div>
        <h3 class="text-sm font-bold text-slate-900">Investor Inquiry Ledger</h3>
        <p class="text-xs text-slate-500 mt-1 max-w-md mx-auto">
            Strategic investor interest messages received via the public site investor deck request forms will appear here.
        </p>
    </div>

</div>
@endsection
