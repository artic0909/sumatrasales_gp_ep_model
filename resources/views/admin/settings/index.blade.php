@extends('admin.layouts.app')

@section('title', 'Website Dynamic Settings')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/80">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-blue-50 text-[#2964F2] text-[10px] font-black uppercase tracking-wider border border-blue-200">
                <span>Site-Wide Dynamic Content</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mt-1">
                Website Content & Support System Settings
            </h1>
            <p class="text-xs text-slate-500 font-medium">
                Update phone numbers, support emails, investor desks, and addresses. Changes are reflected live across header, footer, and portals.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <span class="text-xs font-bold text-slate-400">Live Status:</span>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-black border border-emerald-200">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                Instant Sync Enabled
            </span>
        </div>
    </div>

    <!-- SETTINGS FORM -->
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- 0. HOMEPAGE HERO SECTION & CTA SETTINGS -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
            <div class="p-4 sm:p-5 border-b border-slate-100 bg-gradient-to-r from-blue-900 via-slate-900 to-blue-950 text-white flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-500/20 text-cyan-300 flex items-center justify-center shrink-0 border border-blue-400/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-black text-white">Homepage Hero Section & Background</h2>
                        <p class="text-[11px] text-slate-300">Manage headline text, background image, CTA buttons, links, and floating tagline</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full bg-cyan-500/20 text-cyan-300 text-[10px] font-black uppercase tracking-wider border border-cyan-400/30 shrink-0">
                    Frontpage Hero
                </span>
            </div>

            <div class="p-4 sm:p-6 space-y-5">
                
                <!-- Hero Background Image Management -->
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-black text-slate-800 uppercase tracking-wider">Hero Background Image</label>
                        <span class="text-[10px] text-slate-400">Supported: JPG, PNG, WEBP, AVIF (Max: 5MB)</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                        <!-- Preview Column -->
                        <div class="md:col-span-4">
                            @php
                                $currentHeroImg = $settings['hero_bg_image'] ?? null;
                            @endphp
                            @if($currentHeroImg)
                                <div class="relative rounded-xl overflow-hidden border border-slate-200 aspect-video bg-slate-900 group">
                                    <img src="{{ str_starts_with($currentHeroImg, 'http') ? $currentHeroImg : asset($currentHeroImg) }}" alt="Current Hero Background" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-slate-950/60 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-xs font-bold transition">
                                        Current Background
                                    </div>
                                </div>
                                <div class="mt-2 flex items-center gap-2">
                                    <input type="checkbox" name="remove_hero_bg_image" id="remove_hero_bg_image" value="1" class="rounded border-slate-300 text-rose-600 focus:ring-rose-500">
                                    <label for="remove_hero_bg_image" class="text-xs font-bold text-rose-600 cursor-pointer">Remove image & use default gradient</label>
                                </div>
                            @else
                                <div class="rounded-xl border border-dashed border-slate-300 aspect-video bg-slate-100 flex flex-col items-center justify-center text-slate-400 text-xs p-3 text-center">
                                    <svg class="w-6 h-6 text-slate-400 mb-1" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                                    <span>Default Gradient Active (No Image Set)</span>
                                </div>
                            @endif
                        </div>

                        <!-- Upload & URL Inputs Column -->
                        <div class="md:col-span-8 space-y-3">
                            <div>
                                <label for="hero_bg_image_file" class="block text-xs font-bold text-slate-700 mb-1">Upload New Background Image File</label>
                                <input type="file" name="hero_bg_image_file" id="hero_bg_image_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#2964F2] file:text-white hover:file:bg-blue-600 file:cursor-pointer cursor-pointer bg-white border border-slate-200 rounded-xl p-1.5">
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="h-px bg-slate-200 flex-1"></span>
                                <span class="text-[10px] font-bold uppercase text-slate-400">OR Enter External Image URL</span>
                                <span class="h-px bg-slate-200 flex-1"></span>
                            </div>

                            <div>
                                <input type="text" name="hero_bg_image_url" id="hero_bg_image_url" value="{{ old('hero_bg_image_url', (isset($settings['hero_bg_image']) && str_starts_with($settings['hero_bg_image'], 'http')) ? $settings['hero_bg_image'] : '') }}" placeholder="https://example.com/hero-bg.jpg" class="w-full px-3.5 py-2.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hero Badge Pill -->
                <div>
                    <label for="hero_badge_text" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Top Badge Pill Text</label>
                    <input type="text" name="hero_badge_text" id="hero_badge_text" value="{{ old('hero_badge_text', $settings['hero_badge_text'] ?? 'Digital India • New Opportunity • For Everyone') }}" placeholder="Digital India • New Opportunity • For Everyone" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
                </div>

                <!-- 3-Line Headline -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="hero_title_1" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Headline (Line 1)</label>
                        <input type="text" name="hero_title_1" id="hero_title_1" value="{{ old('hero_title_1', $settings['hero_title_1'] ?? 'Your Network') }}" placeholder="Your Network" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
                    </div>
                    <div>
                        <label for="hero_title_2" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Headline (Line 2)</label>
                        <input type="text" name="hero_title_2" id="hero_title_2" value="{{ old('hero_title_2', $settings['hero_title_2'] ?? 'Our Technology') }}" placeholder="Our Technology" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
                    </div>
                    <div>
                        <label for="hero_title_3" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Headline (Line 3)</label>
                        <input type="text" name="hero_title_3" id="hero_title_3" value="{{ old('hero_title_3', $settings['hero_title_3'] ?? 'Your Opportunity') }}" placeholder="Your Opportunity" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
                    </div>
                </div>

                <!-- Hero Subtitle -->
                <div>
                    <label for="hero_subtitle" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Hero Subtitle / Description</label>
                    <textarea name="hero_subtitle" id="hero_subtitle" rows="2" placeholder="Join Sumatra Sales and be a part of India's growing digital ecosystem. No upfront investment fee." class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? "Join Sumatra Sales and be a part of India's growing digital ecosystem. No upfront investment fee.") }}</textarea>
                </div>

                <!-- Primary & Secondary Buttons & Links -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                    <!-- Primary Button -->
                    <div class="p-4 rounded-2xl bg-amber-50/50 border border-amber-200/70 space-y-3">
                        <span class="text-xs font-black uppercase text-amber-800 tracking-wider block">Primary CTA Button (Yellow)</span>
                        <div>
                            <label for="hero_btn_primary_text" class="block text-[11px] font-bold text-slate-700 mb-1">Button Text</label>
                            <input type="text" name="hero_btn_primary_text" id="hero_btn_primary_text" value="{{ old('hero_btn_primary_text', $settings['hero_btn_primary_text'] ?? 'Become a Partner') }}" placeholder="Become a Partner" class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                        </div>
                        <div>
                            <label for="hero_btn_primary_link" class="block text-[11px] font-bold text-slate-700 mb-1">Button Link URL / Route</label>
                            <input type="text" name="hero_btn_primary_link" id="hero_btn_primary_link" value="{{ old('hero_btn_primary_link', $settings['hero_btn_primary_link'] ?? '/partner-register') }}" placeholder="/partner-register" class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                            <span class="text-[10px] text-slate-400 mt-1 block">Default: /partner-register</span>
                        </div>
                    </div>

                    <!-- Secondary Button -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                        <span class="text-xs font-black uppercase text-slate-800 tracking-wider block">Secondary Button (Video / Action)</span>
                        <div>
                            <label for="hero_btn_secondary_text" class="block text-[11px] font-bold text-slate-700 mb-1">Button Text</label>
                            <input type="text" name="hero_btn_secondary_text" id="hero_btn_secondary_text" value="{{ old('hero_btn_secondary_text', $settings['hero_btn_secondary_text'] ?? 'Watch Video') }}" placeholder="Watch Video" class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
                        </div>
                        <div>
                            <label for="hero_btn_secondary_link" class="block text-[11px] font-bold text-slate-700 mb-1">YouTube Video Link / URL</label>
                            <input type="text" name="hero_btn_secondary_link" id="hero_btn_secondary_link" value="{{ old('hero_btn_secondary_link', $settings['hero_btn_secondary_link'] ?? 'https://www.youtube.com/watch?v=kJQP7kiw5Fk') }}" placeholder="https://www.youtube.com/watch?v=... or https://youtu.be/..." class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
                            <span class="text-[10px] text-slate-400 mt-1 block">Opens an embedded YouTube modal on click (Non-autoplay)</span>
                        </div>
                    </div>
                </div>

                <!-- Right-side Handwritten Script Tagline -->
                <div>
                    <label for="hero_script_tagline" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Right-Side Handwritten Tagline</label>
                    <textarea name="hero_script_tagline" id="hero_script_tagline" rows="2" placeholder="Let's Build a Smarter India Together" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">{{ old('hero_script_tagline', $settings['hero_script_tagline'] ?? "Let's Build a Smarter India Together") }}</textarea>
                    <span class="text-[10px] text-slate-400 mt-1 block">Renders in elegant script font on the hero section</span>
                </div>

            </div>
        </div>

        <!-- 1. GENERAL CONTACT DETAILS -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
            <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-blue-50 text-[#2964F2] flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                </div>
                <div>
                    <h2 class="text-sm font-black text-slate-900">Primary Contact & Helpline</h2>
                    <p class="text-[11px] text-slate-500">General inquiries displayed in the public header, contact page, and footer</p>
                </div>
            </div>

            <div class="p-4 sm:p-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Primary Phone Number</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $settings['phone'] ?? '+91 98765 43210') }}" placeholder="+91 98765 43210" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
                    <span class="text-[10px] text-slate-400 mt-1 block">Displayed across public site topbar & hero</span>
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Primary Contact Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $settings['email'] ?? 'partner@sumatrasales.com') }}" placeholder="partner@sumatrasales.com" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
                    <span class="text-[10px] text-slate-400 mt-1 block">General correspondence inbox</span>
                </div>

                <div>
                    <label for="whatsapp_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">WhatsApp Support Line</label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '+91 98765 43210') }}" placeholder="+91 98765 43210" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
                    <span class="text-[10px] text-slate-400 mt-1 block">Quick WhatsApp chat connector</span>
                </div>
            </div>
        </div>

        <!-- 2. CUSTOMER SUPPORT SYSTEM -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
            <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" /></svg>
                </div>
                <div>
                    <h2 class="text-sm font-black text-slate-900">Partner & Customer Support System</h2>
                    <p class="text-[11px] text-slate-500">Dedicated helpdesk contacts for EP, GP, and platform users</p>
                </div>
            </div>

            <div class="p-4 sm:p-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="support_email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Support Helpdesk Email</label>
                    <input type="email" name="support_email" id="support_email" value="{{ old('support_email', $settings['support_email'] ?? 'support@sumatrasales.com') }}" placeholder="support@sumatrasales.com" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                    <span class="text-[10px] text-slate-400 mt-1 block">Official statutory & ticketing inbox</span>
                </div>

                <div>
                    <label for="support_phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Support Helpline Phone</label>
                    <input type="text" name="support_phone" id="support_phone" value="{{ old('support_phone', $settings['support_phone'] ?? '+91 98765 43210') }}" placeholder="+91 1800 123 4567" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                    <span class="text-[10px] text-slate-400 mt-1 block">Toll-free or direct support line</span>
                </div>

                <div>
                    <label for="working_hours" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Support Working Hours</label>
                    <input type="text" name="working_hours" id="working_hours" value="{{ old('working_hours', $settings['working_hours'] ?? 'Monday - Saturday: 9:30 AM - 6:30 PM IST') }}" placeholder="Mon - Sat: 9:30 AM - 6:30 PM IST" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                    <span class="text-[10px] text-slate-400 mt-1 block">Operating hours and days</span>
                </div>
            </div>
        </div>

        <!-- 3. INVESTOR RELATIONS & SUPPORT SYSTEM -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
            <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                </div>
                <div>
                    <h2 class="text-sm font-black text-slate-900">Investor Support & Strategic Liaison System</h2>
                    <p class="text-[11px] text-slate-500">Dedicated communication channels for angel investors, venture partners & stakeholders</p>
                </div>
            </div>

            <div class="p-4 sm:p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="investor_email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Investor Relations Email</label>
                    <input type="email" name="investor_email" id="investor_email" value="{{ old('investor_email', $settings['investor_email'] ?? 'investor@sumatrasales.com') }}" placeholder="investor@sumatrasales.com" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                    <span class="text-[10px] text-slate-400 mt-1 block">Dedicated institutional & angel investor mailbox</span>
                </div>

                <div>
                    <label for="investor_phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Investor Desk Hotline</label>
                    <input type="text" name="investor_phone" id="investor_phone" value="{{ old('investor_phone', $settings['investor_phone'] ?? '+91 98765 88888') }}" placeholder="+91 98765 88888" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                    <span class="text-[10px] text-slate-400 mt-1 block">Direct founder / executive liaison line</span>
                </div>

                <div class="md:col-span-2">
                    <label for="investor_support_system" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Investor Support System Specification & SLA</label>
                    <textarea name="investor_support_system" id="investor_support_system" rows="2" placeholder="e.g. 24/7 Dedicated Strategic Liaison Desk, Monthly Audited Statements, & Quarterly Investor Briefings." class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">{{ old('investor_support_system', $settings['investor_support_system'] ?? '24/7 Dedicated Strategic Liaison Desk & Monthly Operational Audits') }}</textarea>
                    <span class="text-[10px] text-slate-400 mt-1 block">Description of the investor governance and support protocol</span>
                </div>
            </div>
        </div>

        <!-- 4. CORPORATE HEADQUARTERS ADDRESS -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
            <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>
                </div>
                <div>
                    <h2 class="text-sm font-black text-slate-900">Corporate Registered Headquarters</h2>
                    <p class="text-[11px] text-slate-500">Legal business address rendered in footer, terms, and formal documentation</p>
                </div>
            </div>

            <div class="p-4 sm:p-6">
                <div>
                    <label for="office_address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Official Address</label>
                    <textarea name="office_address" id="office_address" rows="2" placeholder="Sumatra Sales Private Limited, West Bengal, India" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition">{{ old('office_address', $settings['office_address'] ?? 'Sumatra Sales Private Limited, West Bengal, India') }}</textarea>
                </div>
            </div>
        </div>

        <!-- SAVE BUTTON BAR -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit" class="px-6 py-3 rounded-xl bg-[#2964F2] hover:bg-blue-600 text-white font-black text-xs uppercase tracking-wider shadow-lg shadow-blue-600/30 transition transform hover:-translate-y-0.5 cursor-pointer flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                <span>Save & Publish Changes Live</span>
            </button>
        </div>

    </form>

</div>
@endsection
