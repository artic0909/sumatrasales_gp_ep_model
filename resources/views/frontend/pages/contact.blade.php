@extends('frontend.layouts.app')

@section('title', 'Contact Us & Corporate Support Desk - Sumatra Sales')

@section('content')
<main class="w-full bg-slate-50 min-h-screen py-10 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- HERO SECTION -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 text-white p-8 sm:p-12 shadow-2xl border border-slate-800">
            <div class="absolute -right-10 -top-10 w-96 h-96 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 max-w-2xl space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-300 text-xs font-black uppercase tracking-wider border border-blue-400/30">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Corporate & Partner Helpdesk</span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tight">
                    Get in Touch with Sumatra Sales
                </h1>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                    Have questions about the Executive Partner (EP) or Ground Partner (GP) programs, enterprise solutions, or investor relations? Our corporate team is here to assist you.
                </p>
            </div>
        </div>

        <!-- 3 CONTACT HIGHLIGHT TILES (DYNAMIC FROM SETTINGS) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- TILE 1: GENERAL PARTNER DESK -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md transition space-y-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#2964F2] flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                </div>
                <div>
                    <h2 class="text-base font-extrabold text-slate-900">Partner & Onboarding Desk</h2>
                    <p class="text-xs text-slate-500 mt-1">General helpline for EP & GP inquiries and verification status</p>
                </div>
                <div class="space-y-2 pt-2 border-t border-slate-100 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 font-semibold">Phone:</span>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', site_setting('phone', '+91 98765 43210')) }}" class="font-bold text-[#2964F2] hover:underline">
                            {{ site_setting('phone', '+91 98765 43210') }}
                        </a>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 font-semibold">Email:</span>
                        <a href="mailto:{{ site_setting('email', 'partner@sumatrasales.com') }}" class="font-bold text-[#2964F2] hover:underline">
                            {{ site_setting('email', 'partner@sumatrasales.com') }}
                        </a>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 font-semibold">WhatsApp:</span>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', site_setting('whatsapp_number', '+91 98765 43210')) }}" target="_blank" class="font-bold text-emerald-600 hover:underline">
                            {{ site_setting('whatsapp_number', '+91 98765 43210') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- TILE 2: TECHNICAL & CUSTOMER SUPPORT -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md transition space-y-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" /></svg>
                </div>
                <div>
                    <h2 class="text-base font-extrabold text-slate-900">Technical Support & Helpdesk</h2>
                    <p class="text-xs text-slate-500 mt-1">Product assistance for Doctorwala, Schoolwala & enterprise apps</p>
                </div>
                <div class="space-y-2 pt-2 border-t border-slate-100 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 font-semibold">Support Email:</span>
                        <a href="mailto:{{ site_setting('support_email', 'support@sumatrasales.com') }}" class="font-bold text-emerald-700 hover:underline">
                            {{ site_setting('support_email', 'support@sumatrasales.com') }}
                        </a>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 font-semibold">Toll-free / Line:</span>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', site_setting('support_phone', '+91 98765 43210')) }}" class="font-bold text-emerald-700 hover:underline">
                            {{ site_setting('support_phone', '+91 98765 43210') }}
                        </a>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 font-semibold">Working Hours:</span>
                        <span class="font-bold text-slate-700 text-[11px] text-right">
                            {{ site_setting('working_hours', 'Mon - Sat: 9:30 AM - 7:00 PM IST') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- TILE 3: INVESTOR RELATIONS & CORPORATE DESK -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md transition space-y-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                </div>
                <div>
                    <h2 class="text-base font-extrabold text-slate-900">Investor Relations Hub</h2>
                    <p class="text-xs text-slate-500 mt-1">Capital structure, audited disclosures, and institutional inquiries</p>
                </div>
                <div class="space-y-2 pt-2 border-t border-slate-100 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 font-semibold">Investor Email:</span>
                        <a href="mailto:{{ site_setting('investor_email', 'investor@sumatrasales.com') }}" class="font-bold text-amber-700 hover:underline">
                            {{ site_setting('investor_email', 'investor@sumatrasales.com') }}
                        </a>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 font-semibold">Desk Hotline:</span>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', site_setting('investor_phone', '+91 98765 88888')) }}" class="font-bold text-amber-700 hover:underline">
                            {{ site_setting('investor_phone', '+91 98765 88888') }}
                        </a>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 font-semibold">Trust Portal:</span>
                        <a href="{{ route('investor.trust') }}" class="font-bold text-indigo-600 hover:underline">
                            View Investor Trust Page ↗
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- MAIN CONTENT GRID: ADDRESS & CONTACT FORM -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- LEFT: CORPORATE HEADQUARTERS & INVESTOR SYSTEM INFO -->
            <div class="lg:col-span-5 space-y-6">
                
                <!-- Registered Office Card -->
                <div class="p-6 sm:p-7 rounded-3xl bg-white border border-slate-200/90 shadow-xs space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold text-slate-900">Registered Office</h3>
                            <span class="text-xs text-slate-400">Sumatra Sales Private Limited</span>
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-700 font-medium leading-relaxed bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        {{ site_setting('office_address', 'Sumatra Sales Private Limited, West Bengal, India') }}
                    </p>
                    <div class="space-y-1.5 text-xs text-slate-500 font-medium pt-1">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Corporate Identity (CIN): Verified Active Indian Entity</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                            <span>Official Helpdesk Desk: Mon-Sat, 9:30 AM to 7:00 PM IST</span>
                        </div>
                    </div>
                </div>

                <!-- Investor Support System Info Box -->
                <div class="p-6 sm:p-7 rounded-3xl bg-gradient-to-br from-blue-900 to-indigo-950 text-white shadow-xl space-y-3">
                    <div class="flex items-center gap-2 text-cyan-300 text-xs font-black uppercase tracking-wider">
                        <svg class="w-4 h-4 text-cyan-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" /></svg>
                        <span>Investor Support System</span>
                    </div>
                    <p class="text-xs sm:text-sm text-blue-100 leading-relaxed font-normal">
                        {{ site_setting('investor_support_system', 'Sumatra Sales Private Limited operates an institutional stakeholder governance portal. Authorized investors and auditors receive audited quarterly financial packets, equity capitalization tables, and regulatory compliance disclosures.') }}
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('investor.trust') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-cyan-300 hover:text-white underline underline-offset-4">
                            <span>Read Governance Charter & Policies →</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- RIGHT: DIRECT INQUIRY MESSAGE FORM -->
            <div class="lg:col-span-7 p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm space-y-6">
                <div>
                    <h2 class="text-lg sm:text-xl font-black text-slate-900">Send an Inquiry Message</h2>
                    <p class="text-xs text-slate-500 mt-1">Leave your details and message below. Our administrative team will review and respond promptly.</p>
                </div>

                @if (session('success'))
                    <div class="p-4 sm:p-5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-start gap-3.5 shadow-xs">
                        <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        </div>
                        <div class="space-y-1">
                            <span class="font-extrabold block text-sm text-emerald-950">Inquiry Message Received!</span>
                            <p class="leading-relaxed text-emerald-800">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 sm:p-5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 text-xs flex items-start gap-3.5 shadow-xs">
                        <div class="w-8 h-8 rounded-xl bg-rose-600 text-white flex items-center justify-center shrink-0 shadow-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                        </div>
                        <div class="space-y-1">
                            <span class="font-extrabold block text-sm text-rose-950">Submission Encountered an Issue</span>
                            <p class="leading-relaxed text-rose-800">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @if (isset($errors) && $errors->any())
                    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1.5 shadow-xs">
                        <span class="font-bold block text-rose-900">Please review the required fields:</span>
                        <ul class="list-disc list-inside space-y-0.5 text-rose-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4 text-xs">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="font-bold text-slate-700 uppercase tracking-wider text-[11px]">Your Full Name *</label>
                            <input type="text" name="name" required value="{{ old('name') }}" placeholder="e.g. Rahul Sharma" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
                        </div>
                        <div class="space-y-1.5">
                            <label class="font-bold text-slate-700 uppercase tracking-wider text-[11px]">Phone / Mobile Number *</label>
                            <input type="tel" name="phone" required value="{{ old('phone') }}" placeholder="+91 98765 00000" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="font-bold text-slate-700 uppercase tracking-wider text-[11px]">Email Address *</label>
                            <input type="email" name="email" required value="{{ old('email') }}" placeholder="name@example.com" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
                        </div>
                        <div class="space-y-1.5">
                            <label class="font-bold text-slate-700 uppercase tracking-wider text-[11px]">Inquiry Type</label>
                            <select name="inquiry_type" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
                                <option value="Executive Partner (EP) Program" {{ old('inquiry_type') === 'Executive Partner (EP) Program' ? 'selected' : '' }}>Executive Partner (EP) Program</option>
                                <option value="Ground Partner (GP) Program" {{ old('inquiry_type') === 'Ground Partner (GP) Program' ? 'selected' : '' }}>Ground Partner (GP) Program</option>
                                <option value="Software & Development Services" {{ old('inquiry_type') === 'Software & Development Services' ? 'selected' : '' }}>Software & Development Services</option>
                                <option value="Software / Product Support" {{ old('inquiry_type') === 'Software / Product Support' ? 'selected' : '' }}>Software / Product Support</option>
                                <option value="Investor Relations" {{ old('inquiry_type') === 'Investor Relations' ? 'selected' : '' }}>Investor Relations</option>
                                <option value="General Inquiries" {{ old('inquiry_type') === 'General Inquiries' ? 'selected' : '' }}>General Inquiries</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="font-bold text-slate-700 uppercase tracking-wider text-[11px]">Message / Inquiry Details *</label>
                        <textarea name="message" rows="4" required placeholder="Describe your question or requirement..." class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">{{ old('message') }}</textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-[#2964F2] hover:bg-blue-600 active:bg-blue-700 text-white font-black text-xs transition shadow-md shadow-blue-600/30 inline-flex items-center justify-center gap-2 cursor-pointer">
                            <span>Submit Inquiry Message</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</main>

{{-- ================================================================= --}}
{{-- DEDICATED INQUIRY SUBMISSION SUCCESS MODAL --}}
{{-- ================================================================= --}}
@if (session('inquiry_submitted'))
    @php
        $inquiryData = session('inquiry_data', []);
    @endphp
    <div id="inquiry-success-modal" class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md animate-fade-in" role="dialog" aria-modal="true">
        <div class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden text-center p-6 sm:p-7 transform transition-all space-y-4">
            
            <!-- Top Gradient Accent -->
            <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-emerald-500 via-teal-500 to-blue-500"></div>

            <!-- Pulsing Checkmark Icon -->
            <div class="relative mx-auto w-14 h-14 flex items-center justify-center shrink-0 mt-2">
                <div class="absolute inset-0 rounded-full bg-emerald-500/20 animate-ping duration-1000"></div>
                <div class="relative w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center shadow-lg shadow-emerald-600/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
            </div>

            <!-- Headline -->
            <div class="space-y-1">
                <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase tracking-wider border border-emerald-200">
                    <span>Inquiry Received Successfully</span>
                </div>
                <h3 class="text-lg sm:text-xl font-black text-slate-900 tracking-tight">
                    Thank You, {{ $inquiryData['name'] ?? 'Friend' }}!
                </h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Your inquiry has been safely received. A confirmation email has been sent to your inbox, and our desk will respond shortly.
                </p>
            </div>

            <!-- Submitted Details Summary Card -->
            <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-100 text-left text-xs space-y-2">
                <div class="flex items-center justify-between pb-2 border-b border-slate-200/60">
                    <span class="text-slate-400 font-bold text-[10px] uppercase tracking-wider">Inquiry Topic</span>
                    <span class="font-extrabold text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded-lg border border-indigo-100 text-[11px]">
                        {{ $inquiryData['inquiry_type'] ?? 'General Inquiry' }}
                    </span>
                </div>
                @if(!empty($inquiryData['email']))
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="text-slate-400 font-semibold">Confirmation Sent To:</span>
                        <span class="font-bold text-slate-800">{{ $inquiryData['email'] }}</span>
                    </div>
                @endif
                @if(!empty($inquiryData['phone']))
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="text-slate-400 font-semibold">Contact Phone:</span>
                        <span class="font-bold text-slate-800">{{ $inquiryData['phone'] }}</span>
                    </div>
                @endif
            </div>

            <!-- Dismiss Button -->
            <div class="pt-2">
                <button type="button" onclick="closeInquirySuccessModal()" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-black transition cursor-pointer shadow-md">
                    <span>Okay, Got It</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                </button>
            </div>

        </div>
    </div>

    <script>
        function closeInquirySuccessModal() {
            const modal = document.getElementById('inquiry-success-modal');
            if (modal) {
                modal.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                setTimeout(() => { modal.remove(); }, 300);
            }
        }
    </script>
@endif

{{-- ================================================================= --}}
{{-- DEDICATED INQUIRY SUBMISSION FAILED MODAL --}}
{{-- ================================================================= --}}
@if (session('inquiry_failed'))
    <div id="inquiry-failed-modal" class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md animate-fade-in" role="dialog" aria-modal="true">
        <div class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden text-center p-6 sm:p-7 transform transition-all space-y-4">
            
            <!-- Top Gradient Accent -->
            <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-rose-500 via-amber-500 to-rose-600"></div>

            <!-- Warning Icon -->
            <div class="mx-auto w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center shadow-md">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
            </div>

            <!-- Headline -->
            <div class="space-y-1">
                <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-rose-50 text-rose-700 text-[10px] font-black uppercase tracking-wider border border-rose-200">
                    <span>Submission Incomplete</span>
                </div>
                <h3 class="text-lg font-black text-slate-900 tracking-tight">
                    Inquiry Could Not Be Processed
                </h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    {{ session('error', 'We encountered a server error while saving your inquiry. Please try again or reach our administrative desk directly.') }}
                </p>
            </div>

            <!-- Direct Support Helpdesk Links -->
            <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 text-xs space-y-2 text-left">
                <div class="flex items-center justify-between text-[11px]">
                    <span class="text-slate-400 font-semibold">Direct Email:</span>
                    <a href="mailto:{{ site_setting('support_email', 'info.sumatrasales@gmail.com') }}" class="font-bold text-blue-600 hover:underline">
                        {{ site_setting('support_email', 'info.sumatrasales@gmail.com') }}
                    </a>
                </div>
                <div class="flex items-center justify-between text-[11px]">
                    <span class="text-slate-400 font-semibold">Helpdesk Phone:</span>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', site_setting('support_phone', '+91 98765 00000')) }}" class="font-bold text-blue-600 hover:underline">
                        {{ site_setting('support_phone', '+91 98765 00000') }}
                    </a>
                </div>
            </div>

            <!-- Dismiss Button -->
            <div class="pt-2">
                <button type="button" onclick="document.getElementById('inquiry-failed-modal').remove()" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-black transition cursor-pointer shadow-md">
                    <span>Try Again</span>
                </button>
            </div>

        </div>
    </div>
@endif

@endsection

