@extends('frontend.layouts.app')

@section('title', 'About Us - Sumatra Sales Private Limited')

@section('content')
<main class="w-full bg-slate-50 min-h-screen py-10 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 sm:space-y-16">

        <!-- 1. HERO SECTION -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 text-white p-8 sm:p-14 shadow-2xl border border-slate-800">
            <div class="absolute -right-10 -top-10 w-96 h-96 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute left-1/3 -bottom-10 w-72 h-72 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-cyan-300 text-xs font-black uppercase tracking-wider border border-blue-400/30">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Corporate Profile & Company Vision</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-tight">
                    Empowering India's Digital Future Through Local Partnerships
                </h1>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-normal">
                    Sumatra Sales Private Limited is a registered Indian enterprise technology provider. We bridge ready-to-deploy digital solutions with ambitious local entrepreneurs across 100+ cities with ₹0 upfront investment.
                </p>
                <div class="pt-2 flex flex-wrap items-center gap-3">
                    <a href="{{ route('partner.register') }}" class="px-6 py-3 rounded-xl bg-[#2964F2] hover:bg-blue-600 text-white font-black text-xs transition shadow-lg shadow-blue-600/30 inline-flex items-center gap-2">
                        <span>Become a Partner</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                    </a>
                    <a href="{{ route('contact') }}" class="px-5 py-3 rounded-xl bg-white/10 hover:bg-white/15 text-white font-bold text-xs transition border border-white/20">
                        Contact Helpdesk
                    </a>
                    <a href="{{ route('investor.trust') }}" class="px-5 py-3 rounded-xl bg-white/10 hover:bg-white/15 text-cyan-300 font-bold text-xs transition border border-white/20">
                        Investor & Governance Hub →
                    </a>
                </div>
            </div>
        </div>

        <!-- 2. AT A GLANCE STATS METRICS BAR -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs text-center space-y-1">
                <span class="text-3xl sm:text-4xl font-black text-[#2964F2] tracking-tight">100+</span>
                <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Cities Reached</span>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs text-center space-y-1">
                <span class="text-3xl sm:text-4xl font-black text-emerald-600 tracking-tight">₹0</span>
                <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Zero Upfront Fee</span>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs text-center space-y-1">
                <span class="text-3xl sm:text-4xl font-black text-purple-600 tracking-tight">4+</span>
                <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Proprietary Platforms</span>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs text-center space-y-1">
                <span class="text-3xl sm:text-4xl font-black text-amber-600 tracking-tight">100%</span>
                <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Statutory Compliant</span>
            </div>
        </div>

        <!-- 3. OUR STORY & MISSION -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <div class="lg:col-span-6 space-y-5">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-[#2964F2] text-xs font-black uppercase tracking-wider border border-blue-200">
                    <span>Our Purpose & Philosophy</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                    Why Sumatra Sales was Founded
                </h2>
                <div class="space-y-4 text-xs sm:text-sm text-slate-600 leading-relaxed font-normal">
                    <p>
                        Across India, thousands of small businesses, clinics, schools, and merchants want modern software, but lack technical expertise or affordable regional access. At the same time, thousands of educated professionals and youth seek respectable, high-earning digital careers without gambling large franchise deposits.
                    </p>
                    <p>
                        <strong class="text-slate-900 font-bold">Sumatra Sales Private Limited</strong> was established to solve both sides of this equation. We develop world-class digital platforms in-house, and empower local <strong>Executive Partners (EP)</strong> and <strong>Ground Partners (GP)</strong> to deliver them with localized trust, hands-on client relationship management, and transparent revenue share.
                    </p>
                    <p>
                        We have eliminated upfront fees, security deposits, and multi-level marketing mechanics. Every rupee earned by our partners is directly tied to genuine client satisfaction and verified SaaS adoption.
                    </p>
                </div>
            </div>

            <div class="lg:col-span-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Mission Card -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#2964F2] flex items-center justify-center font-black">
                        🎯
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900">Our Mission</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        To democratize digital transformation in tier-2, tier-3, and rural India by turning local youth and professionals into respected digital business partners.
                    </p>
                </div>

                <!-- Vision Card -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black">
                        🔭
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900">Our Vision</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        To establish India’s largest and most trusted decentralized tech distribution network, driving technology adoption across healthcare, education, and commerce.
                    </p>
                </div>

                <!-- Transparency Card -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-black">
                        🛡️
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900">100% Transparency</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Statutory GST compliance, regular banking TDS deductors, and clear contractual charters ensuring absolute security for all stakeholders.
                    </p>
                </div>

                <!-- Zero Exploitation Card -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-black">
                        🤝
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900">Zero Upfront Risk</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        No hidden application costs, no kit fees, and no compulsory inventory purchases. Partners advance solely based on diligence and sales capability.
                    </p>
                </div>
            </div>

        </div>

        <!-- 4. CORE TECHNOLOGY PRODUCTS SUITE -->
        <div class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black uppercase tracking-wider border border-cyan-200">
                        <span>Proprietary Software Platforms</span>
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight mt-1">
                        Products Developed & Managed by Sumatra Sales
                    </h2>
                </div>
                <a href="{{ route('home') }}#platforms" class="text-xs font-bold text-[#2964F2] hover:underline">
                    Explore Platform Specs →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                
                <!-- Product 1: Doctorwala -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md transition space-y-3 flex flex-col justify-between">
                    <div class="space-y-2">
                        <div class="h-10 flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-[#4DCBDC]"></span>
                            <span class="text-base font-black text-slate-900">DOCTORwala™</span>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Complete clinic, doctor appointment scheduling, pathology test, and OPD electronic health management system for hospitals and clinics.
                        </p>
                    </div>
                    <a href="https://www.doctorwala.info/" target="_blank" class="text-[11px] font-bold text-cyan-700 hover:underline inline-flex items-center gap-1">
                        <span>doctorwala.info</span>
                        <span>↗</span>
                    </a>
                </div>

                <!-- Product 2: Schoolwala -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md transition space-y-3 flex flex-col justify-between">
                    <div class="space-y-2">
                        <div class="h-10 flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-[#F5DB3C]"></span>
                            <span class="text-base font-black text-slate-900">Schoolwala™</span>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            State board curriculum digital education platform with bilingual video lectures, chapter notes, and exam prep for students.
                        </p>
                    </div>
                    <a href="https://schoolwala.info/" target="_blank" class="text-[11px] font-bold text-amber-700 hover:underline inline-flex items-center gap-1">
                        <span>schoolwala.info</span>
                        <span>↗</span>
                    </a>
                </div>

                <!-- Product 3: Rani Matrimonial -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md transition space-y-3 flex flex-col justify-between">
                    <div class="space-y-2">
                        <div class="h-10 flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-[#3F0001]"></span>
                            <span class="text-base font-black text-slate-900">Rani Matrimonial™</span>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Privacy-first matrimonial and community matchmaking matchmaking platform with 100% verified biodatas and shielded contact privacy.
                        </p>
                    </div>
                    <a href="https://ranimatrimonial.com/" target="_blank" class="text-[11px] font-bold text-rose-900 hover:underline inline-flex items-center gap-1">
                        <span>ranimatrimonial.com</span>
                        <span>↗</span>
                    </a>
                </div>

                <!-- Product 4: ProjectAttendance -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md transition space-y-3 flex flex-col justify-between">
                    <div class="space-y-2">
                        <div class="h-10 flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-[#E48121]"></span>
                            <span class="text-base font-black text-slate-900">ProjectAttendance™</span>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Mobile geofence biometric attendance, live route tracking, overtime calculation, and staff payroll management HRMS system.
                        </p>
                    </div>
                    <a href="https://projectattendance.com/" target="_blank" class="text-[11px] font-bold text-orange-700 hover:underline inline-flex items-center gap-1">
                        <span>projectattendance.com</span>
                        <span>↗</span>
                    </a>
                </div>

            </div>
        </div>

        <!-- 5. CORPORATE HEADQUARTERS & GOVERNANCE CONTACT -->
        <div class="p-8 sm:p-10 rounded-3xl bg-white border border-slate-200/90 shadow-sm space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                <div>
                    <h3 class="text-lg sm:text-xl font-black text-slate-900">Corporate Registered Information</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Sumatra Sales Private Limited • Incorporated Under the Companies Act</p>
                </div>
                <a href="{{ route('investor.trust') }}" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-bold transition inline-flex items-center gap-1.5">
                    <span>View Investor Governance Charter</span>
                    <span>→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs">
                <div class="space-y-1.5 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Registered Corporate Address</span>
                    <p class="font-bold text-slate-800 text-xs leading-relaxed">
                        {{ site_setting('office_address', 'Sumatra Sales Private Limited, West Bengal, India') }}
                    </p>
                </div>
                <div class="space-y-1.5 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">General Corporate Inquiries</span>
                    <p class="font-bold text-slate-800 text-xs">
                        <a href="mailto:{{ site_setting('email', 'partner@sumatrasales.com') }}" class="text-[#2964F2] hover:underline">
                            {{ site_setting('email', 'partner@sumatrasales.com') }}
                        </a>
                    </p>
                    <p class="font-semibold text-slate-600">
                        Phone: <a href="tel:{{ preg_replace('/[^0-9+]/', '', site_setting('phone', '+91 98765 43210')) }}" class="hover:underline">{{ site_setting('phone', '+91 98765 43210') }}</a>
                    </p>
                </div>
                <div class="space-y-1.5 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Operating Working Hours</span>
                    <p class="font-bold text-slate-800 text-xs">
                        {{ site_setting('working_hours', 'Monday – Saturday: 9:30 AM – 7:00 PM IST') }}
                    </p>
                    <p class="text-[11px] text-emerald-600 font-semibold">
                        Toll-Free/Support: {{ site_setting('support_phone', '+91 98765 43210') }}
                    </p>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
