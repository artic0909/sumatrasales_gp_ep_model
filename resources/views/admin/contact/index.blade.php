@extends('admin.layouts.app')

@section('title', 'Contact Inquiries')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/80">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 text-[10px] font-black uppercase tracking-wider border border-indigo-200">
                <span>Inbound Communication</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mt-1">
                Contact Messages & Inbound Leads
            </h1>
            <p class="text-xs text-slate-500 font-medium">
                Review messages received from visitors, potential partners, and general inquiries across our platforms.
            </p>
        </div>
    </div>

    <!-- INBOX CARD -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-8 text-center">
        <div class="w-12 h-12 mx-auto rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
        </div>
        <h3 class="text-sm font-bold text-slate-900">Inbound Leads Inbox Empty</h3>
        <p class="text-xs text-slate-500 mt-1 max-w-md mx-auto">
            Direct messages submitted through the website contact forms will appear in this unified inbox.
        </p>
    </div>

</div>
@endsection
