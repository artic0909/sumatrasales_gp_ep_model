@extends('frontend.layouts.app')

@section('title', 'Investor Relations & Corporate Governance Trust - Sumatra Sales')

@section('content')
<main class="w-full bg-slate-50 min-h-screen py-10 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- HERO SECTION -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-950 via-slate-900 to-indigo-950 text-white p-8 sm:p-12 shadow-2xl border border-slate-800">
            <div class="absolute -right-10 -top-10 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 max-w-3xl space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-cyan-300 text-xs font-black uppercase tracking-wider border border-white/20 backdrop-blur-xs">
                    <svg class="w-3.5 h-3.5 text-cyan-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" /></svg>
                    <span>Institutional Stakeholder Trust</span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tight">
                    Investor Relations & Corporate Governance
                </h1>
                <p class="text-sm sm:text-base text-blue-100 leading-relaxed font-normal">
                    Sumatra Sales Private Limited adheres to stringent corporate disclosure norms, transparent partner revenue models, and robust institutional governance.
                </p>
                <div class="pt-2 flex flex-wrap items-center gap-3">
                    <a href="mailto:{{ site_setting('investor_email', 'investor@sumatrasales.com') }}" class="px-5 py-2.5 rounded-xl bg-white hover:bg-blue-50 text-[#173FAD] font-black text-xs transition shadow-md inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                        <span>Contact Investor Desk</span>
                    </a>
                    <a href="{{ route('contact') }}" class="px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/15 text-white font-bold text-xs transition border border-white/20">
                        General Support & Helpdesk
                    </a>
                </div>
            </div>
        </div>

        <!-- DYNAMIC INVESTOR SUPPORT SYSTEM STATEMENT CARD -->
        <div class="p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-black">
                        SS
                    </div>
                    <div>
                        <h2 class="text-base font-extrabold text-slate-900">Official Investor Support System</h2>
                        <span class="text-xs text-slate-400">Institutional Governance & Regulatory Framework</span>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase tracking-wider border border-emerald-200">
                    Active Charter
                </span>
            </div>

            <!-- Dynamic content from admin settings -->
            <div class="p-5 sm:p-6 rounded-2xl bg-slate-50 border border-slate-200/80 text-xs sm:text-sm text-slate-700 font-medium leading-relaxed">
                {{ site_setting('investor_support_system', 'Sumatra Sales Private Limited operates an institutional stakeholder governance portal. Authorized investors and auditors receive audited quarterly financial packets, equity capitalization tables, and regulatory compliance disclosures.') }}
            </div>

            <!-- Contact Desk Badges -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 pt-2">
                <div class="p-4 rounded-xl bg-blue-50/60 border border-blue-200/80 space-y-1">
                    <span class="text-[10px] font-bold text-blue-600 uppercase tracking-wider">Dedicated Email</span>
                    <p class="font-bold text-slate-900 text-xs">
                        <a href="mailto:{{ site_setting('investor_email', 'investor@sumatrasales.com') }}" class="hover:underline text-[#2964F2]">
                            {{ site_setting('investor_email', 'investor@sumatrasales.com') }}
                        </a>
                    </p>
                </div>
                <div class="p-4 rounded-xl bg-purple-50/60 border border-purple-200/80 space-y-1">
                    <span class="text-[10px] font-bold text-purple-600 uppercase tracking-wider">Direct Hotline</span>
                    <p class="font-bold text-slate-900 text-xs">
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', site_setting('investor_phone', '+91 98765 88888')) }}" class="hover:underline text-purple-700">
                            {{ site_setting('investor_phone', '+91 98765 88888') }}
                        </a>
                    </p>
                </div>
                <div class="p-4 rounded-xl bg-emerald-50/60 border border-emerald-200/80 space-y-1 sm:col-span-2 lg:col-span-1">
                    <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">Office Jurisdiction</span>
                    <p class="font-semibold text-slate-800 text-xs truncate">
                        {{ site_setting('office_address', 'Sumatra Sales Private Limited, West Bengal, India') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- 7 PILLARS OF PUBLIC & INVESTOR TRUST -->
        <div class="space-y-4">
            <div>
                <h3 class="text-xl font-black text-slate-900">Governance & Transparency Pillars</h3>
                <p class="text-xs text-slate-500 mt-0.5">Foundational guidelines ensuring statutory compliance and partner security</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                
                <!-- Pillar 1 -->
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs space-y-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#2964F2] flex items-center justify-center font-black text-xs">1</div>
                    <h4 class="text-sm font-extrabold text-slate-900">Ethical Partner Charter</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Strict zero-upfront fee policy ensuring complete merit-based onboarding for Executive and Ground Partners across all territories.
                    </p>
                </div>

                <!-- Pillar 2 -->
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs space-y-2">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-xs">2</div>
                    <h4 class="text-sm font-extrabold text-slate-900">Verified Intellectual Property</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Doctorwala, Schoolwala, Rani Matrimonial, and our Custom Software Platforms are registered, proprietary digital assets developed in-house by Sumatra Sales.
                    </p>
                </div>

                <!-- Pillar 3 -->
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs space-y-2">
                    <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center font-black text-xs">3</div>
                    <h4 class="text-sm font-extrabold text-slate-900">Statutory Tax & KYC</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        All partner payouts adhere to statutory Indian TDS guidelines with Aadhaar and PAN verification before commission disbursement.
                    </p>
                </div>

                <!-- Pillar 4 -->
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs space-y-2">
                    <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-black text-xs">4</div>
                    <h4 class="text-sm font-extrabold text-slate-900">Audited Financial Operations</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Structured bookkeeping, periodic external audits, and real-time financial tracking for all operational disbursements.
                    </p>
                </div>

                <!-- Pillar 5 -->
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs space-y-2">
                    <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center font-black text-xs">5</div>
                    <h4 class="text-sm font-extrabold text-slate-900">Data Security & Privacy</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Compliant with the Digital Personal Data Protection (DPDP) Act with enterprise-grade data encryption and server shielding.
                    </p>
                </div>

                <!-- Pillar 6 -->
                <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs space-y-2">
                    <div class="w-8 h-8 rounded-lg bg-cyan-50 text-cyan-600 flex items-center justify-center font-black text-xs">6</div>
                    <h4 class="text-sm font-extrabold text-slate-900">Stakeholder Communication</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Dedicated institutional liaison officer providing prompt responses to investor queries and statutory compliance filings.
                    </p>
                </div>

            </div>
        </div>

    </div>
</main>
@endsection
