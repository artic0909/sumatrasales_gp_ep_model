@extends('admin.layouts.app')

@section('title', 'Admin Profile & Settings')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/80">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 text-[10px] font-black uppercase tracking-wider border border-slate-200">
                <span>System Administration</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mt-1">
                Admin Profile & Environment Settings
            </h1>
            <p class="text-xs text-slate-500 font-medium">
                System configuration, server health diagnostics, and administrative session management.
            </p>
        </div>
    </div>

    <!-- PROFILE & SYSTEM GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- ADMIN ACCOUNT CARD -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-6 space-y-4">
            <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">
                Administrator Account
            </h3>
            <div class="flex items-center gap-3.5">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#2964F2] to-blue-600 text-white flex items-center justify-center font-black text-lg shadow-md ring-4 ring-blue-50">
                    A
                </div>
                <div>
                    <h4 class="text-sm font-black text-slate-900">Super Administrator</h4>
                    <span class="text-xs text-slate-500 font-medium">admin@sumatrasales.com</span>
                    <span class="block text-[10px] text-emerald-600 font-bold mt-0.5">● Full Control Access</span>
                </div>
            </div>

            <div class="pt-3 border-t border-slate-100 text-xs space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-slate-400">Security Clearance</span>
                    <span class="font-bold text-slate-900">Level 5 (Root / Director)</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-slate-400">Timezone</span>
                    <span class="font-bold text-slate-900">Asia/Kolkata (+05:30)</span>
                </div>
            </div>
        </div>

        <!-- SYSTEM DIAGNOSTICS CARD -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-6 space-y-4">
            <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">
                Server Environment & Diagnostics
            </h3>
            <div class="text-xs space-y-2.5">
                <div class="flex items-center justify-between p-2 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500">Framework</span>
                    <span class="font-mono font-bold text-slate-900">Laravel {{ app()->version() }}</span>
                </div>
                <div class="flex items-center justify-between p-2 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500">PHP Runtime</span>
                    <span class="font-mono font-bold text-slate-900">PHP {{ PHP_VERSION }}</span>
                </div>
                <div class="flex items-center justify-between p-2 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500">Database Driver</span>
                    <span class="font-mono font-bold text-slate-900">{{ config('database.default') }}</span>
                </div>
                <div class="flex items-center justify-between p-2 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-500">App Environment</span>
                    <span class="font-mono font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">{{ app()->environment() }}</span>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
