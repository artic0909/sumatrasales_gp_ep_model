@extends('frontend.layouts.app')

@section('title', 'Privacy Policy - Sumatra Sales Private Limited')

@section('content')
<main class="w-full bg-slate-50 min-h-screen py-10 sm:py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- 1. HERO HEADER -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 text-white p-8 sm:p-12 shadow-2xl border border-slate-800">
            <div class="absolute -right-10 -top-10 w-80 h-80 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute left-1/3 -bottom-10 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-cyan-300 text-xs font-black uppercase tracking-wider border border-blue-400/30">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Legal &amp; Statutory Compliance</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                    Privacy Policy
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 font-normal max-w-2xl leading-relaxed">
                    This Privacy Policy outlines how <strong>Sumatra Sales Private Limited</strong> collects, utilizes, safeguards, and processes personal data obtained through our website, online platforms, partner registration portals, and Meta/Facebook advertising campaigns.
                </p>
                <div class="pt-2 flex items-center gap-4 text-[11px] text-slate-400 font-medium">
                    <span>Effective Date: <strong>November 1, 2026</strong></span>
                    <span>&bull;</span>
                    <span>Last Updated: <strong>{{ date('F j, Y') }}</strong></span>
                </div>
            </div>
        </div>

        <!-- 2. MAIN POLICY CONTENT -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 sm:p-10 space-y-8 text-xs sm:text-sm text-slate-700 leading-relaxed">

            <!-- Section 1 -->
            <section class="space-y-3">
                <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-lg bg-blue-50 text-blue-600 font-black text-xs flex items-center justify-center">1</span>
                    <h2 class="text-base sm:text-lg font-black text-slate-900">Who We Are</h2>
                </div>
                <p>
                    <strong>Sumatra Sales Private Limited</strong> ("Company", "we", "our", or "us") is an Indian corporate enterprise technology provider registered under the Companies Act, 2013, with its registered corporate office located in West Bengal, India. We empower businesses, Executive Partners (EP), and Ground Partners (GP) with enterprise digital solutions, cloud systems, and transparent software distribution programs.
                </p>
                <p>
                    If you have any questions regarding this Privacy Policy, you may contact our Privacy Compliance Desk at <a href="mailto:{{ site_setting('email', 'info.sumatrasales@gmail.com') }}" class="text-blue-600 font-bold hover:underline">{{ site_setting('email', 'info.sumatrasales@gmail.com') }}</a>.
                </p>
            </section>

            <!-- Section 2 -->
            <section class="space-y-3">
                <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-lg bg-blue-50 text-blue-600 font-black text-xs flex items-center justify-center">2</span>
                    <h2 class="text-base sm:text-lg font-black text-slate-900">Information We Collect</h2>
                </div>
                <p>
                    We collect personal information that you voluntarily furnish to us when expressing an interest in our products, applying for our partner programs, or interacting with our promotional ads on Meta platforms (Facebook and Instagram). This information may include:
                </p>
                <ul class="list-disc pl-5 space-y-1.5 text-slate-600">
                    <li><strong>Contact Details:</strong> Full Name, Email Address, Mobile/Telephone Number, WhatsApp Number.</li>
                    <li><strong>Business &amp; Professional Profile:</strong> Business Name, City, State, PIN Code, Years of Experience, Preferred Work Territory.</li>
                    <li><strong>Lead Ad Responses:</strong> Information submitted through Facebook Instant Forms (Lead Ads), including custom question answers relating to your interest in our partner models.</li>
                    <li><strong>Technical &amp; Log Data:</strong> Internet Protocol (IP) address, browser type, device information, timestamp of inquiry, and referral URL for fraud prevention and system security.</li>
                </ul>
            </section>

            <!-- Section 3 -->
            <section class="space-y-3">
                <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-lg bg-blue-50 text-blue-600 font-black text-xs flex items-center justify-center">3</span>
                    <h2 class="text-base sm:text-lg font-black text-slate-900">How We Use Your Information</h2>
                </div>
                <p>We process your personal information for lawful and legitimate business purposes, including:</p>
                <ul class="list-disc pl-5 space-y-1.5 text-slate-600">
                    <li>Evaluating and processing your inquiries and partner onboarding applications.</li>
                    <li>Contacting you via telephone call, SMS, email, or WhatsApp to discuss collaboration opportunities.</li>
                    <li>Providing software demos, product walkthroughs, and operational documentation.</li>
                    <li>Fulfilling legal, statutory, and regulatory compliance obligations in India.</li>
                    <li>Preventing bot spam, fraudulent submissions, and verifying genuine user inquiries.</li>
                </ul>
            </section>

            <!-- Section 4 -->
            <section class="space-y-3">
                <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-lg bg-blue-50 text-blue-600 font-black text-xs flex items-center justify-center">4</span>
                    <h2 class="text-base sm:text-lg font-black text-slate-900">Meta / Facebook Advertising &amp; Conversions API (CAPI)</h2>
                </div>
                <p>
                    We use advertising services provided by Meta Platforms, Inc. (including Facebook and Instagram Lead Ads, Meta Pixel, and Meta Conversions API) to connect with prospective business partners and clients.
                </p>
                <div class="p-4 rounded-2xl bg-blue-50/70 border border-blue-200/80 space-y-2 text-xs">
                    <p class="font-bold text-blue-900">Data Hashing &amp; Privacy Protection:</p>
                    <p class="text-blue-800">
                        When you submit an Instant Form on Facebook or Instagram, your lead is securely delivered to our internal CRM via encrypted Meta Webhooks. When our review team qualifies a lead, we send offline conversion events (e.g. <code>QualifiedLead</code>) back to Meta Conversions API (CAPI). 
                        Prior to transmission, all personal identifiers (such as email addresses and phone numbers) are irreversibly hashed using one-way <strong>SHA-256 cryptographic hashing</strong> in compliance with Meta’s Business Tool Terms and global privacy standards. Meta never receives plaintext credentials during this feedback loop.
                    </p>
                </div>
            </section>

            <!-- Section 5 -->
            <section class="space-y-3">
                <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-lg bg-blue-50 text-blue-600 font-black text-xs flex items-center justify-center">5</span>
                    <h2 class="text-base sm:text-lg font-black text-slate-900">Data Sharing &amp; Non-Disclosure</h2>
                </div>
                <p>
                    <strong class="text-slate-900">We do not sell, rent, trade, or monetize your personal data to any third-party marketers or unauthorized entities.</strong>
                </p>
                <p>
                    Your information is accessible solely to authorized staff, regional partner coordinators, and trusted technology infrastructure providers (such as secure cloud servers and transactional email gateways) who are bound by strict non-disclosure and confidentiality agreements.
                </p>
            </section>

            <!-- Section 6 -->
            <section class="space-y-3">
                <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-lg bg-blue-50 text-blue-600 font-black text-xs flex items-center justify-center">6</span>
                    <h2 class="text-base sm:text-lg font-black text-slate-900">Data Security &amp; Retention</h2>
                </div>
                <p>
                    We employ industry-standard administrative, physical, and technical security safeguards, including 256-bit SSL encryption for data in transit, automated firewall filtering, and restricted database access controls.
                </p>
                <p>
                    We retain your personal information only as long as necessary to fulfill the purposes set out in this Privacy Policy, manage our active partner relationship with you, or comply with statutory record-keeping mandates under Indian law.
                </p>
            </section>

            <!-- Section 7 -->
            <section class="space-y-3">
                <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-lg bg-blue-50 text-blue-600 font-black text-xs flex items-center justify-center">7</span>
                    <h2 class="text-base sm:text-lg font-black text-slate-900">Your Privacy Rights &amp; Opt-Out</h2>
                </div>
                <p>
                    Under applicable data protection frameworks (including the Digital Personal Data Protection Act, 2023), you have the right to:
                </p>
                <ul class="list-disc pl-5 space-y-1 text-slate-600">
                    <li>Request confirmation and access to personal data held about you.</li>
                    <li>Request correction or updating of inaccurate or outdated information.</li>
                    <li>Request erasure or deletion of your personal records from our promotional contact lists.</li>
                    <li>Withdraw your consent to receive promotional marketing communications at any time.</li>
                </ul>
                <p>
                    To exercise any of these rights, please email us directly at <a href="mailto:{{ site_setting('email', 'info.sumatrasales@gmail.com') }}" class="text-blue-600 font-bold hover:underline">{{ site_setting('email', 'info.sumatrasales@gmail.com') }}</a> with the subject line <em>"Privacy Rights Request"</em>.
                </p>
            </section>

            <!-- Section 8 -->
            <section class="space-y-3">
                <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-lg bg-blue-50 text-blue-600 font-black text-xs flex items-center justify-center">8</span>
                    <h2 class="text-base sm:text-lg font-black text-slate-900">Grievance Redressal &amp; Contact Us</h2>
                </div>
                <p>
                    For grievances, questions, or clarification regarding this Privacy Policy and our data handling practices, please contact our designated Grievance Officer:
                </p>
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 text-xs space-y-1.5">
                    <p class="font-bold text-slate-900">Sumatra Sales Private Limited</p>
                    <p class="text-slate-600">Attn: Privacy &amp; Legal Compliance Officer</p>
                    <p class="text-slate-600">Headquarters: {{ site_setting('office_address', 'West Bengal, India') }}</p>
                    <p class="text-slate-600">Official Email: <a href="mailto:{{ site_setting('email', 'info.sumatrasales@gmail.com') }}" class="text-blue-600 font-bold hover:underline">{{ site_setting('email', 'info.sumatrasales@gmail.com') }}</a></p>
                    <p class="text-slate-600">Helpline: <a href="tel:{{ site_setting('phone', '+919876543210') }}" class="text-blue-600 font-bold hover:underline">{{ site_setting('phone', '+91 98765 43210') }}</a></p>
                </div>
            </section>

        </div>

    </div>
</main>
@endsection

