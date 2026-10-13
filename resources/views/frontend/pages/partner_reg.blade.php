@extends('frontend.layouts.app')

@section('title', 'Partner Registration (EP & GP) - Sumatra Sales Private Limited')
@section('meta_description', 'Apply to become an Executive Partner (EP) or Ground Partner (GP) with Sumatra Sales Private Limited. Multi-step onboarding form with instant verification.')

@section('content')
<main class="w-full bg-[#F8FAFC] pb-24 pt-6 sm:pt-10">

    <!-- Top Breadcrumb & Live Status Bar -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-500 hover:text-blue-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                <span>Back to Home</span>
            </a>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                Official Partner Onboarding Portal
            </span>
        </div>
    </div>

    <!-- Hero Intro Header -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#0F172A] via-[#1E293B] to-[#0A2540] text-white p-6 sm:p-9 shadow-xl border border-slate-700/60">
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-white/10 backdrop-blur-md text-cyan-300 text-xs font-bold tracking-wide uppercase mb-3 border border-white/10">
                    <span>Sumatra Sales Partner Program</span>
                    <span>•</span>
                    <span>Multi-Step Verification</span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight">
                    Partner Registration Application
                </h1>
                <p class="mt-2 text-slate-300 text-xs sm:text-sm md:text-base max-w-2xl leading-relaxed">
                    Join Sumatra Sales as an <strong class="text-white">Executive Partner (EP)</strong> or <strong class="text-white">Ground Partner (GP)</strong>. Follow the 4 easy steps below to complete your partner profile and upload verification documents.
                </p>

                <!-- Value Highlights -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6 pt-5 border-t border-white/10">
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-200">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        <span>Zero Investment Fee</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-200">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        <span>Digital KYC Verification</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-200">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        <span>Direct Bank Payouts</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-200">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        <span>256-Bit SSL Encrypted</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stepper Progress Navigation -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-8" id="stepper-container">
        
        <!-- Mobile Compact Progress Indicator (< md screens) -->
        <div class="block md:hidden bg-white rounded-2xl border border-slate-200/90 shadow-sm p-4">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-extrabold text-blue-600 uppercase tracking-wide" id="mobile-step-tag">Step 1 of 4</span>
                <span class="text-xs font-bold text-slate-700" id="mobile-step-percent">25% Completed</span>
            </div>
            <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden mb-3">
                <div id="mobile-progress-bar" class="bg-blue-600 h-2.5 rounded-full transition-all duration-300 w-1/4"></div>
            </div>
            <div class="text-sm font-extrabold text-slate-900" id="mobile-step-title">
                Role & Personal Profile
            </div>
        </div>

        <!-- Desktop Full Stepper (>= md screens) -->
        <div class="hidden md:block bg-white rounded-2xl border border-slate-200/90 shadow-sm p-5">
            <div class="grid grid-cols-4 gap-2 relative">
                
                <!-- Step 1 Indicator -->
                <div class="stepper-item group flex flex-col items-center text-center cursor-pointer transition-all" data-step="1">
                    <div class="step-circle w-10 h-10 rounded-full flex items-center justify-center font-black text-sm transition-all duration-300 bg-blue-600 text-white shadow-md ring-4 ring-blue-100">
                        <span class="step-num">1</span>
                        <svg class="step-check hidden w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    </div>
                    <span class="step-title mt-2 text-xs font-extrabold text-blue-700 transition">Role & Profile</span>
                    <span class="text-[10px] text-slate-400 font-medium">EP/GP & Address</span>
                </div>

                <!-- Step 2 Indicator -->
                <div class="stepper-item group flex flex-col items-center text-center cursor-pointer transition-all opacity-60" data-step="2">
                    <div class="step-circle w-10 h-10 rounded-full flex items-center justify-center font-black text-sm transition-all duration-300 bg-slate-100 text-slate-500 border border-slate-300">
                        <span class="step-num">2</span>
                        <svg class="step-check hidden w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    </div>
                    <span class="step-title mt-2 text-xs font-bold text-slate-600 transition">Identity Credentials</span>
                    <span class="text-[10px] text-slate-400 font-medium">Aadhaar & PAN</span>
                </div>

                <!-- Step 3 Indicator -->
                <div class="stepper-item group flex flex-col items-center text-center cursor-pointer transition-all opacity-60" data-step="3">
                    <div class="step-circle w-10 h-10 rounded-full flex items-center justify-center font-black text-sm transition-all duration-300 bg-slate-100 text-slate-500 border border-slate-300">
                        <span class="step-num">3</span>
                        <svg class="step-check hidden w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    </div>
                    <span class="step-title mt-2 text-xs font-bold text-slate-600 transition">Bank Details</span>
                    <span class="text-[10px] text-slate-400 font-medium">Payout Settlement</span>
                </div>

                <!-- Step 4 Indicator -->
                <div class="stepper-item group flex flex-col items-center text-center cursor-pointer transition-all opacity-60" data-step="4">
                    <div class="step-circle w-10 h-10 rounded-full flex items-center justify-center font-black text-sm transition-all duration-300 bg-slate-100 text-slate-500 border border-slate-300">
                        <span class="step-num">4</span>
                        <svg class="step-check hidden w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    </div>
                    <span class="step-title mt-2 text-xs font-bold text-slate-600 transition">Photo & Review</span>
                    <span class="text-[10px] text-slate-400 font-medium">Selfie & Submit</span>
                </div>

            </div>
        </div>

    </div>

    <!-- Main Multi-Form Container -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Flash Success Notification -->
        @if (session('success'))
            <div class="mb-8 rounded-3xl bg-emerald-50 border border-emerald-200 p-6 sm:p-8 shadow-sm transition-all">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-md">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-xl font-extrabold text-emerald-900 leading-snug">Registration Submitted Successfully!</h2>
                        <p class="mt-1.5 text-sm text-emerald-700 leading-relaxed">
                            {{ session('success') }}
                        </p>
                        <div class="mt-5 flex flex-wrap items-center gap-3">
                            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition shadow-xs">
                                <span>Return to Homepage</span>
                            </a>
                            <span class="text-xs text-emerald-700 font-semibold">Helpdesk: partner@sumatrasales.com</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Global Validation Errors Alert -->
        @if (isset($errors) && $errors->any())
            <div class="mb-8 rounded-2xl bg-rose-50 border border-rose-200 p-5 sm:p-6 shadow-sm" id="error-summary-box">
                <div class="flex items-start gap-3.5">
                    <div class="w-9 h-9 rounded-xl bg-rose-600 text-white flex items-center justify-center shrink-0 mt-0.5 shadow-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-rose-900">Please review the following required fields:</h3>
                        <ul class="mt-2 list-disc list-inside text-xs sm:text-sm text-rose-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Card Container -->
        <form method="POST" action="{{ route('partner.register.store') }}" enctype="multipart/form-data" id="partner-registration-form">
            @csrf

            <!-- ============================================================= -->
            <!-- STEP 1: ROLE SELECTION, ROLE INFO & PERSONAL / ADDRESS PROFILE -->
            <!-- ============================================================= -->
            <div class="form-step-panel bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-9 transition-all" id="step-panel-1">
                
                <!-- Section Header -->
                <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-6">
                    <div>
                        <span class="inline-block px-2.5 py-0.5 rounded-md text-[11px] font-black uppercase bg-blue-100 text-blue-800 tracking-wider mb-1">Step 1 of 4</span>
                        <h2 class="text-lg sm:text-xl font-extrabold text-slate-900">Choose Partner Role & Personal Details</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Select your role as EP or GP and complete your address & contact details.</p>
                    </div>
                    <span class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 font-extrabold text-sm hidden sm:flex items-center justify-center">1/4</span>
                </div>

                <!-- 1. Role Selection Radio Cards -->
                <div class="mb-6">
                    <label class="block text-xs sm:text-sm font-bold text-slate-800 mb-2">
                        Select Registration Role <span class="text-rose-500">*</span                    </label>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- EP (Executive Partner) Card -->
                        <div class="partner-role-card relative rounded-2xl border-2 p-5 transition-all {{ old('registration_type', 'EP') === 'EP' ? 'border-blue-600 bg-blue-50/40 shadow-sm' : 'border-slate-200 hover:border-slate-300 bg-white' }}" data-role="EP">
                            <label class="cursor-pointer block" for="role_ep">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="registration_type" id="role_ep" value="EP" {{ old('registration_type', 'EP') === 'EP' ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300">
                                        <div>
                                            <span class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                                                Executive Partner (EP)
                                                <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-blue-100 text-blue-800">Tier 1</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="w-9 h-9 rounded-xl bg-blue-100/70 text-blue-700 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                         
                        </div>

                        <!-- GP (Ground Partner) Card -->
                        <div class="partner-role-card relative rounded-2xl border-2 p-5 transition-all {{ old('registration_type') === 'GP' ? 'border-amber-500 bg-amber-50/40 shadow-sm' : 'border-slate-200 hover:border-slate-300 bg-white' }}" data-role="GP">
                            <label class="cursor-pointer block" for="role_gp">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="registration_type" id="role_gp" value="GP" {{ old('registration_type') === 'GP' ? 'checked' : '' }} class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-slate-300">
                                        <div>
                                            <span class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                                                Ground Partner (GP)
                                                <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-amber-100 text-amber-800">Field Tier</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="w-9 h-9 rounded-xl bg-amber-100/70 text-amber-700 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                           
                        </div>
                    </div>
                </div>

                <!-- 3. Personal & Contact Details -->
                <div class="mb-6">
                    <h3 class="text-sm font-extrabold text-slate-800 uppercase tracking-wide mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                        <span>Personal Information</span>
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Full Name -->
                        <div class="sm:col-span-2">
                            <label for="name" class="block text-xs sm:text-sm font-bold text-slate-800 mb-1.5">
                                Full Name <span class="text-rose-500">*</span>
                                <span class="text-[11px] font-normal text-slate-500">(as per official Aadhaar / PAN card)</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="e.g. Ramesh Kumar Sharma"
                                class="step-required-input w-full px-4 py-2.5 rounded-xl border {{ isset($errors) && $errors->has('name') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-300 focus:border-blue-600 focus:ring-blue-100' }} text-slate-800 text-sm focus:outline-hidden focus:ring-3 transition bg-white">
                            @error('name')
                                <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-xs sm:text-sm font-bold text-slate-800 mb-1.5">
                                Mobile / WhatsApp Phone Number <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative flex">
                                <span class="inline-flex items-center px-3.5 rounded-l-xl border border-r-0 border-slate-300 bg-slate-100 text-slate-600 text-xs font-bold">
                                    +91
                                </span>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required placeholder="9876543210" maxlength="15"
                                    class="step-required-input w-full rounded-r-xl border {{ isset($errors) && $errors->has('phone') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-300 focus:border-blue-600 focus:ring-blue-100' }} px-3.5 py-2.5 text-slate-800 text-sm focus:outline-hidden focus:ring-3 transition bg-white">
                            </div>
                            @error('phone')
                                <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs sm:text-sm font-bold text-slate-800 mb-1.5">
                                Email Address <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="partner@example.com"
                                class="step-required-input w-full px-4 py-2.5 rounded-xl border {{ isset($errors) && $errors->has('email') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-300 focus:border-blue-600 focus:ring-blue-100' }} text-slate-800 text-sm focus:outline-hidden focus:ring-3 transition bg-white">
                            @error('email')
                                <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 4. Location & Address Details (New fields requested) -->
                <div>
                    <h3 class="text-sm font-extrabold text-slate-800 uppercase tracking-wide mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                        <span>Location & Official Address</span>
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-5">
                        <!-- State Dropdown -->
                        <div>
                            <label for="state" class="block text-xs sm:text-sm font-bold text-slate-800 mb-1.5">
                                State <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="state" id="state" required
                                    class="step-required-input w-full px-3.5 py-2.5 rounded-xl border {{ isset($errors) && $errors->has('state') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-300 focus:border-blue-600 focus:ring-blue-100' }} text-slate-800 text-sm focus:outline-hidden focus:ring-3 transition bg-white cursor-pointer">
                                    <option value="" disabled {{ old('state') ? '' : 'selected' }}>Select State...</option>
                                    <option value="West Bengal" {{ old('state', 'West Bengal') === 'West Bengal' ? 'selected' : '' }}>West Bengal</option>
                                    <option value="Andhra Pradesh" {{ old('state') === 'Andhra Pradesh' ? 'selected' : '' }}>Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh" {{ old('state') === 'Arunachal Pradesh' ? 'selected' : '' }}>Arunachal Pradesh</option>
                                    <option value="Assam" {{ old('state') === 'Assam' ? 'selected' : '' }}>Assam</option>
                                    <option value="Bihar" {{ old('state') === 'Bihar' ? 'selected' : '' }}>Bihar</option>
                                    <option value="Chhattisgarh" {{ old('state') === 'Chhattisgarh' ? 'selected' : '' }}>Chhattisgarh</option>
                                    <option value="Goa" {{ old('state') === 'Goa' ? 'selected' : '' }}>Goa</option>
                                    <option value="Gujarat" {{ old('state') === 'Gujarat' ? 'selected' : '' }}>Gujarat</option>
                                    <option value="Haryana" {{ old('state') === 'Haryana' ? 'selected' : '' }}>Haryana</option>
                                    <option value="Himachal Pradesh" {{ old('state') === 'Himachal Pradesh' ? 'selected' : '' }}>Himachal Pradesh</option>
                                    <option value="Jharkhand" {{ old('state') === 'Jharkhand' ? 'selected' : '' }}>Jharkhand</option>
                                    <option value="Karnataka" {{ old('state') === 'Karnataka' ? 'selected' : '' }}>Karnataka</option>
                                    <option value="Kerala" {{ old('state') === 'Kerala' ? 'selected' : '' }}>Kerala</option>
                                    <option value="Madhya Pradesh" {{ old('state') === 'Madhya Pradesh' ? 'selected' : '' }}>Madhya Pradesh</option>
                                    <option value="Maharashtra" {{ old('state') === 'Maharashtra' ? 'selected' : '' }}>Maharashtra</option>
                                    <option value="Manipur" {{ old('state') === 'Manipur' ? 'selected' : '' }}>Manipur</option>
                                    <option value="Meghalaya" {{ old('state') === 'Meghalaya' ? 'selected' : '' }}>Meghalaya</option>
                                    <option value="Mizoram" {{ old('state') === 'Mizoram' ? 'selected' : '' }}>Mizoram</option>
                                    <option value="Nagaland" {{ old('state') === 'Nagaland' ? 'selected' : '' }}>Nagaland</option>
                                    <option value="Odisha" {{ old('state') === 'Odisha' ? 'selected' : '' }}>Odisha</option>
                                    <option value="Punjab" {{ old('state') === 'Punjab' ? 'selected' : '' }}>Punjab</option>
                                    <option value="Rajasthan" {{ old('state') === 'Rajasthan' ? 'selected' : '' }}>Rajasthan</option>
                                    <option value="Sikkim" {{ old('state') === 'Sikkim' ? 'selected' : '' }}>Sikkim</option>
                                    <option value="Tamil Nadu" {{ old('state') === 'Tamil Nadu' ? 'selected' : '' }}>Tamil Nadu</option>
                                    <option value="Telangana" {{ old('state') === 'Telangana' ? 'selected' : '' }}>Telangana</option>
                                    <option value="Tripura" {{ old('state') === 'Tripura' ? 'selected' : '' }}>Tripura</option>
                                    <option value="Uttar Pradesh" {{ old('state') === 'Uttar Pradesh' ? 'selected' : '' }}>Uttar Pradesh</option>
                                    <option value="Uttarakhand" {{ old('state') === 'Uttarakhand' ? 'selected' : '' }}>Uttarakhand</option>
                                    <option value="Delhi" {{ old('state') === 'Delhi' ? 'selected' : '' }}>Delhi (NCT)</option>
                                    <option value="Chandigarh" {{ old('state') === 'Chandigarh' ? 'selected' : '' }}>Chandigarh</option>
                                    <option value="Jammu and Kashmir" {{ old('state') === 'Jammu and Kashmir' ? 'selected' : '' }}>Jammu and Kashmir</option>
                                    <option value="Ladakh" {{ old('state') === 'Ladakh' ? 'selected' : '' }}>Ladakh</option>
                                    <option value="Puducherry" {{ old('state') === 'Puducherry' ? 'selected' : '' }}>Puducherry</option>
                                </select>
                            </div>
                            @error('state')
                                <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- District -->
                        <div>
                            <label for="district" class="block text-xs sm:text-sm font-bold text-slate-800 mb-1.5">
                                District <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="district" id="district" value="{{ old('district') }}" required placeholder="e.g. Kolkata / Murshidabad"
                                class="step-required-input w-full px-4 py-2.5 rounded-xl border {{ isset($errors) && $errors->has('district') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-300 focus:border-blue-600 focus:ring-blue-100' }} text-slate-800 text-sm focus:outline-hidden focus:ring-3 transition bg-white">
                            @error('district')
                                <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- City -->
                        <div>
                            <label for="city" class="block text-xs sm:text-sm font-bold text-slate-800 mb-1.5">
                                City / Town <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="city" id="city" value="{{ old('city') }}" required placeholder="e.g. Berhampore"
                                class="step-required-input w-full px-4 py-2.5 rounded-xl border {{ isset($errors) && $errors->has('city') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-300 focus:border-blue-600 focus:ring-blue-100' }} text-slate-800 text-sm focus:outline-hidden focus:ring-3 transition bg-white">
                            @error('city')
                                <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Full Address -->
                    <div>
                        <label for="address" class="block text-xs sm:text-sm font-bold text-slate-800 mb-1.5">
                            Full Address <span class="text-rose-500">*</span>
                            <span class="text-[11px] font-normal text-slate-500">(House / Street / Landmark / PIN Code)</span>
                        </label>
                        <textarea name="address" id="address" rows="2" required placeholder="Enter your complete residential or office address with PIN Code"
                            class="step-required-input w-full px-4 py-2.5 rounded-xl border {{ isset($errors) && $errors->has('address') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-300 focus:border-blue-600 focus:ring-blue-100' }} text-slate-800 text-sm focus:outline-hidden focus:ring-3 transition bg-white">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Step 1 Navigation Buttons -->
                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end">
                    <button type="button" class="btn-next-step inline-flex items-center gap-2 px-7 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-extrabold text-sm rounded-xl shadow-md transition transform hover:-translate-y-0.5 cursor-pointer" data-target="2">
                        <span>Continue to Document Verification</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                    </button>
                </div>

            </div>

            <!-- ============================================================= -->
            <!-- STEP 2: OFFICIAL IDENTITY CREDENTIALS & VERIFICATION (New Title)-->
            <!-- ============================================================= -->
            <div class="form-step-panel bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-9 transition-all hidden" id="step-panel-2">
                
                <!-- Section Header with Distinct New Title -->
                <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-6">
                    <div>
                        <span class="inline-block px-2.5 py-0.5 rounded-md text-[11px] font-black uppercase bg-blue-100 text-blue-800 tracking-wider mb-1">Step 2 of 4</span>
                        <h2 class="text-lg sm:text-xl font-extrabold text-slate-900">Official Identity Credentials & Verification</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Provide your government-issued identity cards to ensure verified onboarding.</p>
                    </div>
                    <span class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 font-extrabold text-sm hidden sm:flex items-center justify-center">2/4</span>
                </div>

                <!-- Aadhaar Identity Block -->
                <div class="mb-8 pb-7 border-b border-slate-100">
                    <div class="mb-4">
                        <label for="aadhaar_number" class="block text-xs sm:text-sm font-bold text-slate-800 mb-1.5">
                            Aadhaar Card Number <span class="text-rose-500">*</span>
                            <span class="text-[11px] font-normal text-slate-500">(12 Digits)</span>
                        </label>
                        <div class="relative max-w-md">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.33a4.126 4.126 0 0 0-6.338 0 .375.375 0 0 0 .26.67h5.818a.375.375 0 0 0 .26-.67Z" />
                                </svg>
                            </div>
                            <input type="text" name="aadhaar_number" id="aadhaar_number" value="{{ old('aadhaar_number') }}" required placeholder="XXXX XXXX XXXX" maxlength="14"
                                class="step-required-input w-full pl-10 pr-4 py-2.5 rounded-xl border {{ isset($errors) && $errors->has('aadhaar_number') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-300 focus:border-blue-600 focus:ring-blue-100' }} text-slate-800 text-sm font-mono tracking-wider focus:outline-hidden focus:ring-3 transition bg-white">
                        </div>
                        @error('aadhaar_number')
                            <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Aadhaar Front & Back Upload Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Aadhaar Front -->
                        <div class="file-upload-zone" data-input="aadhaar_front_image">
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                Aadhaar Front Side Image <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative border-2 border-dashed border-slate-300 hover:border-blue-500 rounded-2xl p-4 text-center cursor-pointer transition bg-slate-50/60 hover:bg-blue-50/20 group">
                                <input type="file" name="aadhaar_front_image" id="aadhaar_front_image" accept="image/jpeg,image/png,image/jpg,image/webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 file-input-preview">
                                <div class="upload-placeholder">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 mx-auto flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" /></svg>
                                    </div>
                                    <p class="text-xs font-bold text-slate-700">Upload Front Side</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">JPG, PNG, WebP (Max 5MB)</p>
                                </div>
                                <div class="upload-preview hidden">
                                    <img src="" alt="Aadhaar Front Preview" class="w-full h-32 object-contain rounded-lg mx-auto bg-white p-1 border border-slate-200">
                                    <div class="mt-2 flex items-center justify-between text-[11px] text-slate-600 px-1">
                                        <span class="file-name font-semibold truncate max-w-[150px]"></span>
                                        <button type="button" class="remove-file-btn text-rose-600 hover:text-rose-800 font-bold z-20">Remove</button>
                                    </div>
                                </div>
                            </div>
                            @error('aadhaar_front_image')
                                <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Aadhaar Back -->
                        <div class="file-upload-zone" data-input="aadhaar_back_image">
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                Aadhaar Back Side Image <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative border-2 border-dashed border-slate-300 hover:border-blue-500 rounded-2xl p-4 text-center cursor-pointer transition bg-slate-50/60 hover:bg-blue-50/20 group">
                                <input type="file" name="aadhaar_back_image" id="aadhaar_back_image" accept="image/jpeg,image/png,image/jpg,image/webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 file-input-preview">
                                <div class="upload-placeholder">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 mx-auto flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" /></svg>
                                    </div>
                                    <p class="text-xs font-bold text-slate-700">Upload Back Side</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">JPG, PNG, WebP (Max 5MB)</p>
                                </div>
                                <div class="upload-preview hidden">
                                    <img src="" alt="Aadhaar Back Preview" class="w-full h-32 object-contain rounded-lg mx-auto bg-white p-1 border border-slate-200">
                                    <div class="mt-2 flex items-center justify-between text-[11px] text-slate-600 px-1">
                                        <span class="file-name font-semibold truncate max-w-[150px]"></span>
                                        <button type="button" class="remove-file-btn text-rose-600 hover:text-rose-800 font-bold z-20">Remove</button>
                                    </div>
                                </div>
                            </div>
                            @error('aadhaar_back_image')
                                <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- PAN Card Identity Block -->
                <div>
                    <div class="mb-4">
                        <label for="pancard_number" class="block text-xs sm:text-sm font-bold text-slate-800 mb-1.5">
                            PAN Card Number <span class="text-rose-500">*</span>
                            <span class="text-[11px] font-normal text-slate-500">(10-character alphanumeric, e.g. ABCDE1234F)</span>
                        </label>
                        <div class="relative max-w-md">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                </svg>
                            </div>
                            <input type="text" name="pancard_number" id="pancard_number" value="{{ old('pancard_number') }}" required placeholder="ABCDE1234F" maxlength="10"
                                class="step-required-input w-full pl-10 pr-4 py-2.5 rounded-xl border {{ isset($errors) && $errors->has('pancard_number') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-300 focus:border-blue-600 focus:ring-blue-100' }} text-slate-800 text-sm font-mono tracking-wider uppercase focus:outline-hidden focus:ring-3 transition bg-white">
                        </div>
                        @error('pancard_number')
                            <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PAN Front & Back Upload Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- PAN Front -->
                        <div class="file-upload-zone" data-input="pancard_front_image">
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                PAN Card Front Image <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative border-2 border-dashed border-slate-300 hover:border-blue-500 rounded-2xl p-4 text-center cursor-pointer transition bg-slate-50/60 hover:bg-blue-50/20 group">
                                <input type="file" name="pancard_front_image" id="pancard_front_image" accept="image/jpeg,image/png,image/jpg,image/webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 file-input-preview">
                                <div class="upload-placeholder">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 mx-auto flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" /></svg>
                                    </div>
                                    <p class="text-xs font-bold text-slate-700">Upload PAN Front</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">JPG, PNG, WebP (Max 5MB)</p>
                                </div>
                                <div class="upload-preview hidden">
                                    <img src="" alt="PAN Front Preview" class="w-full h-32 object-contain rounded-lg mx-auto bg-white p-1 border border-slate-200">
                                    <div class="mt-2 flex items-center justify-between text-[11px] text-slate-600 px-1">
                                        <span class="file-name font-semibold truncate max-w-[150px]"></span>
                                        <button type="button" class="remove-file-btn text-rose-600 hover:text-rose-800 font-bold z-20">Remove</button>
                                    </div>
                                </div>
                            </div>
                            @error('pancard_front_image')
                                <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- PAN Back (Optional) -->
                        <div class="file-upload-zone" data-input="pancard_back_image">
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                PAN Card Back Image
                                <span class="text-[11px] font-normal text-slate-500">(Optional for e-PAN)</span>
                            </label>
                            <div class="relative border-2 border-dashed border-slate-300 hover:border-blue-500 rounded-2xl p-4 text-center cursor-pointer transition bg-slate-50/60 hover:bg-blue-50/20 group">
                                <input type="file" name="pancard_back_image" id="pancard_back_image" accept="image/jpeg,image/png,image/jpg,image/webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 file-input-preview">
                                <div class="upload-placeholder">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-500 mx-auto flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" /></svg>
                                    </div>
                                    <p class="text-xs font-bold text-slate-700">Upload PAN Back</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">Optional</p>
                                </div>
                                <div class="upload-preview hidden">
                                    <img src="" alt="PAN Back Preview" class="w-full h-32 object-contain rounded-lg mx-auto bg-white p-1 border border-slate-200">
                                    <div class="mt-2 flex items-center justify-between text-[11px] text-slate-600 px-1">
                                        <span class="file-name font-semibold truncate max-w-[150px]"></span>
                                        <button type="button" class="remove-file-btn text-rose-600 hover:text-rose-800 font-bold z-20">Remove</button>
                                    </div>
                                </div>
                            </div>
                            @error('pancard_back_image')
                                <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Step 2 Navigation Buttons -->
                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between">
                    <button type="button" class="btn-prev-step inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs sm:text-sm font-bold transition" data-target="1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>
                        <span>Previous Step</span>
                    </button>
                    <button type="button" class="btn-next-step inline-flex items-center gap-2 px-7 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-extrabold text-sm rounded-xl shadow-md transition transform hover:-translate-y-0.5 cursor-pointer" data-target="3">
                        <span>Continue to Bank Details</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                    </button>
                </div>

            </div>

            <!-- ============================================================= -->
            <!-- STEP 3: BANK SETTLEMENT & PAYOUT DETAILS                      -->
            <!-- ============================================================= -->
            <div class="form-step-panel bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-9 transition-all hidden" id="step-panel-3">
                
                <!-- Section Header -->
                <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-6">
                    <div>
                        <span class="inline-block px-2.5 py-0.5 rounded-md text-[11px] font-black uppercase bg-blue-100 text-blue-800 tracking-wider mb-1">Step 3 of 4</span>
                        <h2 class="text-lg sm:text-xl font-extrabold text-slate-900">Bank Settlement & Payout Details</h2>
                        <p class="text-xs text-slate-500 mt-0.5">All commissions and referral earnings will be transferred directly to this verified account.</p>
                    </div>
                    <span class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 font-extrabold text-sm hidden sm:flex items-center justify-center">3/4</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <!-- Bank Name -->
                    <div>
                        <label for="bank_name" class="block text-xs sm:text-sm font-bold text-slate-800 mb-1.5">
                            Bank Name <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5m-15 10.5V10.5m-1.5 0h18" />
                                </svg>
                            </div>
                            <input type="text" name="bank_name" id="bank_name" value="{{ old('bank_name') }}" required placeholder="e.g. State Bank of India"
                                class="step-required-input w-full pl-10 pr-4 py-2.5 rounded-xl border {{ isset($errors) && $errors->has('bank_name') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-300 focus:border-blue-600 focus:ring-blue-100' }} text-slate-800 text-sm focus:outline-hidden focus:ring-3 transition bg-white">
                        </div>
                        @error('bank_name')
                            <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bank Account Number -->
                    <div>
                        <label for="bank_account_number" class="block text-xs sm:text-sm font-bold text-slate-800 mb-1.5">
                            Bank Account Number <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                </svg>
                            </div>
                            <input type="text" name="bank_account_number" id="bank_account_number" value="{{ old('bank_account_number') }}" required placeholder="e.g. 100234567890"
                                class="step-required-input w-full pl-10 pr-4 py-2.5 rounded-xl border {{ isset($errors) && $errors->has('bank_account_number') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-300 focus:border-blue-600 focus:ring-blue-100' }} text-slate-800 text-sm font-mono focus:outline-hidden focus:ring-3 transition bg-white">
                        </div>
                        @error('bank_account_number')
                            <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- IFSC Code -->
                    <div>
                        <label for="ifsc_code" class="block text-xs sm:text-sm font-bold text-slate-800 mb-1.5">
                            IFSC Code <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                                </svg>
                            </div>
                            <input type="text" name="ifsc_code" id="ifsc_code" value="{{ old('ifsc_code') }}" required placeholder="e.g. SBIN0001234" maxlength="11"
                                class="step-required-input w-full pl-10 pr-4 py-2.5 rounded-xl border {{ isset($errors) && $errors->has('ifsc_code') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-300 focus:border-blue-600 focus:ring-blue-100' }} text-slate-800 text-sm font-mono uppercase focus:outline-hidden focus:ring-3 transition bg-white">
                        </div>
                        @error('ifsc_code')
                            <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-5 p-4 bg-blue-50/70 rounded-2xl border border-blue-100 flex items-start sm:items-center gap-3 text-xs text-blue-900">
                    <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5 sm:mt-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                    <span><strong>Security Note:</strong> Account name must match the name on your Aadhaar and PAN card. Direct bank settlements (IMPS / NEFT) are automated weekly/monthly.</span>
                </div>

                <!-- Step 3 Navigation Buttons -->
                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between">
                    <button type="button" class="btn-prev-step inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs sm:text-sm font-bold transition" data-target="2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>
                        <span>Previous Step</span>
                    </button>
                    <button type="button" class="btn-next-step inline-flex items-center gap-2 px-7 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-extrabold text-sm rounded-xl shadow-md transition transform hover:-translate-y-0.5 cursor-pointer" data-target="4">
                        <span>Continue to Photo & Review</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                    </button>
                </div>

            </div>

            <!-- ============================================================= -->
            <!-- STEP 4: SELF PHOTOGRAPH, SUMMARY REVIEW & FINAL DECLARATION   -->
            <!-- ============================================================= -->
            <div class="form-step-panel bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 sm:p-9 transition-all hidden" id="step-panel-4">
                
                <!-- Section Header -->
                <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-6">
                    <div>
                        <span class="inline-block px-2.5 py-0.5 rounded-md text-[11px] font-black uppercase bg-blue-100 text-blue-800 tracking-wider mb-1">Step 4 of 4</span>
                        <h2 class="text-lg sm:text-xl font-extrabold text-slate-900">Self Photograph & Final Review</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Upload your applicant portrait photo and review your application details.</p>
                    </div>
                    <span class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 font-extrabold text-sm hidden sm:flex items-center justify-center">4/4</span>
                </div>

                <!-- Portrait Photo Upload -->
                <div class="max-w-md mx-auto mb-8 file-upload-zone" data-input="self_image">
                    <label class="block text-xs sm:text-sm font-bold text-slate-800 text-center mb-2">
                        Upload Passport Size Photo / Self Image
                    </label>
                    <div class="relative border-2 border-dashed border-slate-300 hover:border-blue-500 rounded-3xl p-6 text-center cursor-pointer transition bg-slate-50/60 hover:bg-blue-50/20 group">
                        <input type="file" name="self_image" id="self_image" accept="image/jpeg,image/png,image/jpg,image/webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 file-input-preview">
                        
                        <div class="upload-placeholder py-3">
                            <div class="w-16 h-16 rounded-full bg-blue-100 text-blue-600 mx-auto flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-xs">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-slate-800">Click or Drag to Upload Self Image</p>
                            <p class="text-xs text-slate-500 mt-1">Clear portrait photo facing forward</p>
                            <span class="inline-block mt-3 px-3 py-1 bg-white border border-slate-200 rounded-md text-[11px] font-semibold text-slate-600 shadow-2xs">Browse Image</span>
                        </div>

                        <div class="upload-preview hidden">
                            <img src="" alt="Self Photo Preview" class="w-36 h-36 object-cover rounded-full mx-auto bg-white p-1 border-2 border-blue-500 shadow-md">
                            <div class="mt-3 flex items-center justify-center gap-3 text-xs text-slate-600">
                                <span class="file-name font-semibold truncate max-w-[180px]"></span>
                                <button type="button" class="remove-file-btn text-rose-600 hover:text-rose-800 font-bold z-20">Change Photo</button>
                            </div>
                        </div>
                    </div>
                    @error('self_image')
                        <p class="mt-1 text-xs font-semibold text-rose-600 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Instant Profile Summary Review Card -->
                <div class="mb-8 p-5 sm:p-6 rounded-2xl bg-slate-50 border border-slate-200/90">
                    <h3 class="text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-3">Application Summary Review</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
                        <div>
                            <span class="text-slate-400 block text-[11px]">Selected Role</span>
                            <span id="review-role" class="font-bold text-slate-900">Executive Partner (EP)</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[11px]">Applicant Name</span>
                            <span id="review-name" class="font-bold text-slate-900">-</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[11px]">Mobile Phone</span>
                            <span id="review-phone" class="font-bold text-slate-900">-</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[11px]">Email Address</span>
                            <span id="review-email" class="font-bold text-slate-900 truncate block">-</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[11px]">Location</span>
                            <span id="review-location" class="font-bold text-slate-900">-</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[11px]">Aadhaar Number</span>
                            <span id="review-aadhaar" class="font-bold text-slate-900 font-mono">-</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[11px]">PAN Card</span>
                            <span id="review-pan" class="font-bold text-slate-900 font-mono">-</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[11px]">Settlement Bank</span>
                            <span id="review-bank" class="font-bold text-slate-900">-</span>
                        </div>
                    </div>
                </div>

                <!-- Legal Terms & Declaration -->
                <div class="mb-8 p-4 bg-slate-50 rounded-2xl border border-slate-200">
                    <div class="flex items-start gap-3">
                        <input type="checkbox" id="terms" name="terms" required class="h-4 w-4 mt-1 text-blue-600 focus:ring-blue-500 border-slate-300 rounded cursor-pointer">
                        <label for="terms" class="text-xs text-slate-700 leading-relaxed cursor-pointer">
                            I solemnly declare that all information entered and documents submitted (Aadhaar, PAN, Bank Details, and Photograph) are genuine, verified, and belong directly to me. I agree to Sumatra Sales Private Limited Partner Terms of Service and Code of Professional Conduct.
                        </label>
                    </div>
                </div>

                <!-- Step 4 Navigation Buttons -->
                <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <button type="button" class="btn-prev-step w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs sm:text-sm font-bold transition" data-target="3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>
                        <span>Previous Step</span>
                    </button>

                    <button type="submit" id="submit-btn" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-9 py-3.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-black text-sm sm:text-base rounded-xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 cursor-pointer">
                        <span id="submit-text">Submit Official Partner Application</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </button>
                </div>

            </div>

        </form>

        <!-- Help & Support Callout -->
        <div class="mt-8 text-center text-xs text-slate-500">
            Need assistance with your partner application? 
            <a href="mailto:partner@sumatrasales.com" class="text-blue-600 font-semibold hover:underline">partner@sumatrasales.com</a> or visit our 
            <a href="{{ route('home') }}#contact" class="text-blue-600 font-semibold hover:underline">Support Helpdesk</a>.
        </div>

    </div>

    <!-- ============================================================= -->
    <!-- ROLE RESPONSIBILITIES & SCOPE MODAL POPUP DIALOG              -->
    <!-- ============================================================= -->
    <div id="role-info-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-xs transition-opacity duration-200 opacity-0 pointer-events-none" aria-modal="true" role="dialog">
        <div id="role-info-modal-container" class="relative w-full max-w-xl bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden transform scale-95 transition-transform duration-200 max-h-[90vh] flex flex-col">
            <!-- Modal Header Bar -->
            <div id="modal-header-bar" class="px-6 py-5 bg-gradient-to-r from-slate-900 via-slate-800 to-blue-950 text-white flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3.5">
                    <div id="modal-role-icon-box" class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-xs shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
                    </div>
                    <div>
                        <h3 id="modal-role-title" class="text-base sm:text-lg font-black text-white leading-tight">Executive Partner (EP) Responsibilities & Scope</h3>
                        <span id="modal-role-badge" class="inline-block mt-0.5 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-blue-500/30 text-cyan-200 border border-cyan-400/30">Regional Leadership</span>
                    </div>
                </div>
                <button type="button" id="close-role-modal-btn" class="p-2 text-slate-300 hover:text-white rounded-full hover:bg-white/10 transition cursor-pointer" aria-label="Close Modal">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <!-- Modal Content Body -->
            <div class="p-6 overflow-y-auto space-y-4 text-xs sm:text-sm text-slate-700">
                <p id="modal-role-intro" class="text-xs text-slate-600 leading-relaxed font-medium">
                    As an <strong>Executive Partner</strong>, you manage territory-level digital expansion across all Sumatra Sales ecosystems:
                </p>

                <!-- Points Container (Grid of 4 items) -->
                <div id="modal-role-points" class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-4 rounded-2xl bg-slate-50 border border-slate-200/80 text-xs text-slate-700">
                    <!-- Populated dynamically via JS -->
                </div>

                <div class="p-3.5 bg-blue-50/70 rounded-xl border border-blue-100 flex items-center gap-2.5 text-xs text-blue-800">
                    <svg class="w-4 h-4 text-blue-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                    <span>No upfront fee. Start distributing immediately after document verification.</span>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between gap-3 shrink-0">
                <span class="text-xs text-slate-500 hidden sm:inline">You can change your role anytime.</span>
                <div class="flex items-center gap-2.5 w-full sm:w-auto justify-end">
                    <button type="button" id="modal-dismiss-btn" class="px-4 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 text-xs font-bold transition cursor-pointer">
                        Close
                    </button>
                    <button type="button" id="modal-confirm-btn" class="inline-flex items-center gap-1.5 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-xs font-extrabold rounded-xl shadow-md transition cursor-pointer">
                        <span id="modal-confirm-btn-text">I Understand & Continue</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let currentStep = 1;
    const totalSteps = 4;

    const stepTitles = {
        1: 'Role & Personal Profile',
        2: 'Official Identity Credentials & Verification',
        3: 'Bank Settlement & Payout Details',
        4: 'Applicant Photograph & Review'
    };

    // Role Details Data for Modal Popup
    const roleDetails = {
        EP: {
            title: 'Executive Partner (EP) Responsibilities & Scope',
            badge: 'Regional Leadership',
            badgeClass: 'bg-blue-500/30 text-cyan-200 border-cyan-400/30',
            iconBg: 'bg-blue-600',
            confirmBtnBg: 'bg-blue-600 hover:bg-blue-700',
            confirmText: 'Continue as Executive Partner (EP)',
            intro: 'As an <strong>Executive Partner</strong>, you manage territory-level digital expansion across all Sumatra Sales ecosystems:',
            points: [
                { title: 'DOCTORwala', desc: 'Onboard clinics, hospitals, diagnostic centers, and specialist doctors.' },
                { title: 'Schoolwala', desc: 'Institutional tie-ups with secondary schools, tutors & coaching centers.' },
                { title: 'ProjectAttendance', desc: 'SME corporate deployments for geofenced staff tracking.' },
                { title: 'Economics', desc: 'Multi-tier lifetime commission overrides & dedicated territorial revenue.' }
            ]
        },
        GP: {
            title: 'Ground Partner (GP) Responsibilities & Scope',
            badge: 'Direct Outreach',
            badgeClass: 'bg-amber-500/30 text-amber-200 border-amber-400/30',
            iconBg: 'bg-amber-600',
            confirmBtnBg: 'bg-amber-600 hover:bg-amber-700',
            confirmText: 'Continue as Ground Partner (GP)',
            intro: 'As a <strong>Ground Partner</strong>, you conduct direct consumer and local retail onboardings in your village, town, or city:',
            points: [
                { title: 'DOCTORwala', desc: 'Help local residents book doctor visits & lab tests.' },
                { title: 'Schoolwala', desc: 'Register class VIII-X Bengali medium students on Schoolwala.' },
                { title: 'Rani Matrimonial', desc: 'Onboard verified profiles looking for matchmaking services.' },
                { title: 'Economics', desc: 'Direct per-onboarding payout rewards plus recurring transaction splits.' }
            ]
        }
    };

    // Modal elements
    const roleModal = document.getElementById('role-info-modal');
    const roleModalContainer = document.getElementById('role-info-modal-container');
    const modalTitle = document.getElementById('modal-role-title');
    const modalBadge = document.getElementById('modal-role-badge');
    const modalIntro = document.getElementById('modal-role-intro');
    const modalPoints = document.getElementById('modal-role-points');
    const modalIconBox = document.getElementById('modal-role-icon-box');
    const modalConfirmBtn = document.getElementById('modal-confirm-btn');
    const modalConfirmBtnText = document.getElementById('modal-confirm-btn-text');
    const selectedRoleName = document.getElementById('selected-role-name');

    let currentModalRole = 'EP';

    function openRoleModal(role) {
        currentModalRole = role || 'EP';
        const data = roleDetails[currentModalRole];
        if (!data) return;

        modalTitle.textContent = data.title;
        modalBadge.textContent = data.badge;
        modalBadge.className = `inline-block mt-0.5 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold border ${data.badgeClass}`;
        modalIntro.innerHTML = data.intro;
        modalIconBox.className = `w-10 h-10 rounded-xl ${data.iconBg} text-white flex items-center justify-center shadow-xs shrink-0`;
        modalConfirmBtn.className = `inline-flex items-center gap-1.5 px-6 py-2.5 ${data.confirmBtnBg} active:opacity-90 text-white text-xs font-extrabold rounded-xl shadow-md transition cursor-pointer`;
        modalConfirmBtnText.textContent = data.confirmText;

        // Populate points
        modalPoints.innerHTML = data.points.map(p => `
            <div class="flex items-start gap-2">
                <span class="text-blue-600 font-bold shrink-0">✔</span>
                <span><strong>${p.title}</strong>: ${p.desc}</span>
            </div>
        `).join('');

        // Reveal modal
        roleModal.classList.remove('opacity-0', 'pointer-events-none');
        roleModal.classList.add('opacity-100', 'pointer-events-auto');
        roleModalContainer.classList.remove('scale-95');
        roleModalContainer.classList.add('scale-100');
        document.body.classList.add('overflow-hidden');
    }

    function closeRoleModal() {
        roleModal.classList.remove('opacity-100', 'pointer-events-auto');
        roleModal.classList.add('opacity-0', 'pointer-events-none');
        roleModalContainer.classList.remove('scale-100');
        roleModalContainer.classList.add('scale-95');
        document.body.classList.remove('overflow-hidden');
    }

    // Modal event listeners
    document.getElementById('close-role-modal-btn')?.addEventListener('click', closeRoleModal);
    document.getElementById('modal-dismiss-btn')?.addEventListener('click', closeRoleModal);
    modalConfirmBtn?.addEventListener('click', function () {
        closeRoleModal();
        const nameField = document.getElementById('name');
        if (nameField) {
            nameField.scrollIntoView({ behavior: 'smooth', block: 'center' });
            nameField.focus();
        }
    });

    roleModal?.addEventListener('click', function (e) {
        if (e.target === roleModal) closeRoleModal();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !roleModal.classList.contains('pointer-events-none')) {
            closeRoleModal();
        }
    });

    // Reopen modal from status bar
    document.getElementById('reopen-role-modal-btn')?.addEventListener('click', function () {
        const checkedRadio = document.querySelector('input[name="registration_type"]:checked');
        openRoleModal(checkedRadio ? checkedRadio.value : 'EP');
    });

    // Button click triggers on each card
    document.querySelectorAll('.btn-open-role-popup').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const role = this.getAttribute('data-popup-role');
            const radio = document.querySelector(`input[name="registration_type"][value="${role}"]`);
            if (radio) {
                radio.checked = true;
                syncRoleState(false);
            }
            openRoleModal(role);
        });
    });

    // 1. Role Selection & Visual Sync
    const roleRadios = document.querySelectorAll('input[name="registration_type"]');

    function syncRoleState(triggerPopup = false) {
        let selectedRole = 'EP';
        roleRadios.forEach(radio => {
            const card = radio.closest('.partner-role-card');
            if (radio.checked) {
                selectedRole = radio.value;
                if (radio.value === 'EP') {
                    card.classList.remove('border-slate-200', 'bg-white', 'border-amber-500', 'bg-amber-50/40');
                    card.classList.add('border-blue-600', 'bg-blue-50/40', 'shadow-sm');
                } else {
                    card.classList.remove('border-slate-200', 'bg-white', 'border-blue-600', 'bg-blue-50/40');
                    card.classList.add('border-amber-500', 'bg-amber-50/40', 'shadow-sm');
                }
            } else {
                card.classList.remove('border-blue-600', 'bg-blue-50/40', 'border-amber-500', 'bg-amber-50/40', 'shadow-sm');
                card.classList.add('border-slate-200', 'bg-white');
            }
        });

        if (selectedRoleName) {
            selectedRoleName.textContent = selectedRole === 'EP' ? 'Executive Partner (EP)' : 'Ground Partner (GP)';
            selectedRoleName.className = selectedRole === 'EP' ? 'font-black text-blue-900' : 'font-black text-amber-900';
        }

        if (triggerPopup) {
            openRoleModal(selectedRole);
        }
    }

    // Role radio change -> open popup
    roleRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            syncRoleState(true);
        });
    });

    // Clicking anywhere on card also triggers
    document.querySelectorAll('.partner-role-card').forEach(card => {
        card.addEventListener('click', function (e) {
            if (e.target.closest('.btn-open-role-popup')) return;
            const role = this.getAttribute('data-role');
            const radio = this.querySelector('input[name="registration_type"]');
            if (radio && !radio.checked) {
                radio.checked = true;
                syncRoleState(true);
            }
        });
    });

    syncRoleState(false);

    // 2. Multi-Step Navigation & Stepper UI Update
    function showStep(stepNumber) {
        if (stepNumber < 1 || stepNumber > totalSteps) return;

        // Hide all step panels
        document.querySelectorAll('.form-step-panel').forEach(panel => {
            panel.classList.add('hidden');
        });

        // Show target panel
        const targetPanel = document.getElementById('step-panel-' + stepNumber);
        if (targetPanel) {
            targetPanel.classList.remove('hidden');
        }

        currentStep = stepNumber;

        // Update Desktop Stepper
        document.querySelectorAll('.stepper-item').forEach(item => {
            const step = parseInt(item.getAttribute('data-step'), 10);
            const circle = item.querySelector('.step-circle');
            const stepNum = item.querySelector('.step-num');
            const stepCheck = item.querySelector('.step-check');
            const stepTitle = item.querySelector('.step-title');

            if (step < currentStep) {
                // Completed
                item.classList.remove('opacity-60');
                circle.classList.remove('bg-blue-600', 'bg-slate-100', 'text-slate-500', 'border', 'border-slate-300', 'ring-4', 'ring-blue-100');
                circle.classList.add('bg-emerald-600', 'text-white', 'shadow-md');
                stepNum.classList.add('hidden');
                stepCheck.classList.remove('hidden');
                stepTitle.classList.remove('text-blue-700', 'text-slate-600');
                stepTitle.classList.add('text-emerald-700');
            } else if (step === currentStep) {
                // Active
                item.classList.remove('opacity-60');
                circle.classList.remove('bg-emerald-600', 'bg-slate-100', 'text-slate-500', 'border', 'border-slate-300');
                circle.classList.add('bg-blue-600', 'text-white', 'shadow-md', 'ring-4', 'ring-blue-100');
                stepNum.classList.remove('hidden');
                stepCheck.classList.add('hidden');
                stepTitle.classList.remove('text-emerald-700', 'text-slate-600');
                stepTitle.classList.add('text-blue-700');
            } else {
                // Inactive / Upcoming
                item.classList.add('opacity-60');
                circle.classList.remove('bg-blue-600', 'bg-emerald-600', 'text-white', 'ring-4', 'ring-blue-100', 'shadow-md');
                circle.classList.add('bg-slate-100', 'text-slate-500', 'border', 'border-slate-300');
                stepNum.classList.remove('hidden');
                stepCheck.classList.add('hidden');
                stepTitle.classList.remove('text-blue-700', 'text-emerald-700');
                stepTitle.classList.add('text-slate-600');
            }
        });

        // Update Mobile Stepper
        const mobileTag = document.getElementById('mobile-step-tag');
        const mobilePercent = document.getElementById('mobile-step-percent');
        const mobileBar = document.getElementById('mobile-progress-bar');
        const mobileTitle = document.getElementById('mobile-step-title');

        const pct = Math.round((currentStep / totalSteps) * 100);
        if (mobileTag) mobileTag.textContent = `Step ${currentStep} of ${totalSteps}`;
        if (mobilePercent) mobilePercent.textContent = `${pct}% Completed`;
        if (mobileBar) mobileBar.style.width = `${pct}%`;
        if (mobileTitle) mobileTitle.textContent = stepTitles[currentStep] || '';

        // If Step 4 is reached, populate review summary
        if (currentStep === 4) {
            updateReviewSummary();
        }

        // Smooth scroll to top of form
        const stepperContainer = document.getElementById('stepper-container');
        if (stepperContainer) {
            stepperContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    // 3. Step Validation on "Next" Click
    function validateStep(stepNumber) {
        const panel = document.getElementById('step-panel-' + stepNumber);
        if (!panel) return true;

        const inputs = panel.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;
        let firstInvalid = null;

        inputs.forEach(input => {
            // Radio buttons check
            if (input.type === 'radio') {
                const name = input.name;
                const checked = panel.querySelector(`input[name="${name}"]:checked`);
                if (!checked) {
                    isValid = false;
                    if (!firstInvalid) firstInvalid = input;
                }
            } else if (!input.value.trim()) {
                isValid = false;
                input.classList.add('border-rose-500', 'ring-2', 'ring-rose-200');
                if (!firstInvalid) firstInvalid = input;
            } else {
                input.classList.remove('border-rose-500', 'ring-2', 'ring-rose-200');
            }
        });

        if (!isValid && firstInvalid) {
            firstInvalid.focus();
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        return isValid;
    }

    // Next Step Buttons
    document.querySelectorAll('.btn-next-step').forEach(btn => {
        btn.addEventListener('click', function () {
            const targetStep = parseInt(this.getAttribute('data-target'), 10);
            if (validateStep(currentStep)) {
                showStep(targetStep);
            }
        });
    });

    // Previous Step Buttons
    document.querySelectorAll('.btn-prev-step').forEach(btn => {
        btn.addEventListener('click', function () {
            const targetStep = parseInt(this.getAttribute('data-target'), 10);
            showStep(targetStep);
        });
    });

    // Desktop Stepper Item Clickable to jump between completed steps
    document.querySelectorAll('.stepper-item').forEach(item => {
        item.addEventListener('click', function () {
            const clickedStep = parseInt(this.getAttribute('data-step'), 10);
            if (clickedStep <= currentStep || validateStep(currentStep)) {
                showStep(clickedStep);
            }
        });
    });

    // 4. Update Summary Review in Step 4
    function updateReviewSummary() {
        const checkedRole = document.querySelector('input[name="registration_type"]:checked');
        const roleText = checkedRole && checkedRole.value === 'EP' ? 'Executive Partner (EP)' : 'Ground Partner (GP)';

        const nameVal = document.getElementById('name')?.value || '-';
        const phoneVal = document.getElementById('phone')?.value || '-';
        const emailVal = document.getElementById('email')?.value || '-';
        const cityVal = document.getElementById('city')?.value || '';
        const distVal = document.getElementById('district')?.value || '';
        const stateVal = document.getElementById('state')?.value || '';
        const aadhaarVal = document.getElementById('aadhaar_number')?.value || '-';
        const panVal = document.getElementById('pancard_number')?.value || '-';
        const bankVal = document.getElementById('bank_name')?.value || '-';

        const locationStr = [cityVal, distVal, stateVal].filter(Boolean).join(', ') || '-';

        document.getElementById('review-role').textContent = roleText;
        document.getElementById('review-name').textContent = nameVal;
        document.getElementById('review-phone').textContent = phoneVal ? '+91 ' + phoneVal : '-';
        document.getElementById('review-email').textContent = emailVal;
        document.getElementById('review-location').textContent = locationStr;
        document.getElementById('review-aadhaar').textContent = aadhaarVal;
        document.getElementById('review-pan').textContent = panVal;
        document.getElementById('review-bank').textContent = bankVal;
    }

    // 5. Real-time Image Previews for File Inputs
    const fileInputs = document.querySelectorAll('.file-input-preview');
    fileInputs.forEach(input => {
        input.addEventListener('change', function () {
            const file = this.files[0];
            const zone = this.closest('.file-upload-zone');
            const placeholder = zone.querySelector('.upload-placeholder');
            const preview = zone.querySelector('.upload-preview');
            const previewImg = preview.querySelector('img');
            const fileNameSpan = preview.querySelector('.file-name');

            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('File is too large! Maximum allowed file size is 5MB.');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (event) {
                    previewImg.src = event.target.result;
                    fileNameSpan.textContent = file.name;
                    placeholder.classList.add('hidden');
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    });

    // Remove file button handler
    document.querySelectorAll('.remove-file-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const zone = this.closest('.file-upload-zone');
            const input = zone.querySelector('input[type="file"]');
            const placeholder = zone.querySelector('.upload-placeholder');
            const preview = zone.querySelector('.upload-preview');
            const previewImg = preview.querySelector('img');
            const fileNameSpan = preview.querySelector('.file-name');

            input.value = '';
            previewImg.src = '';
            fileNameSpan.textContent = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        });
    });

    // 6. Aadhaar Number Auto-Spacing (4-4-4)
    const aadhaarInput = document.getElementById('aadhaar_number');
    if (aadhaarInput) {
        aadhaarInput.addEventListener('input', function () {
            let val = this.value.replace(/\D/g, '').substring(0, 12);
            let formatted = val.match(/.{1,4}/g)?.join(' ') || val;
            this.value = formatted;
        });
    }

    // 7. PAN Card & IFSC Auto-Uppercase
    const panInput = document.getElementById('pancard_number');
    if (panInput) {
        panInput.addEventListener('input', function () {
            this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '').substring(0, 10);
        });
    }

    const ifscInput = document.getElementById('ifsc_code');
    if (ifscInput) {
        ifscInput.addEventListener('input', function () {
            this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '').substring(0, 11);
        });
    }

    // 8. Server-side Error Auto Jump: If validation fails, jump to the step with error
    @if (isset($errors) && $errors->any())
        @php
            $errorKeys = $errors->keys();
            $stepToOpen = 1;
            if (count(array_intersect($errorKeys, ['self_image'])) > 0) {
                $stepToOpen = 4;
            } elseif (count(array_intersect($errorKeys, ['bank_account_number', 'bank_name', 'ifsc_code'])) > 0) {
                $stepToOpen = 3;
            } elseif (count(array_intersect($errorKeys, ['aadhaar_number', 'aadhaar_front_image', 'aadhaar_back_image', 'pancard_number', 'pancard_front_image', 'pancard_back_image'])) > 0) {
                $stepToOpen = 2;
            }
        @endphp
        showStep({{ $stepToOpen }});
    @endif

    // 9. Form Submission Loading State
    const form = document.getElementById('partner-registration-form');
    const submitBtn = document.getElementById('submit-btn');
    const submitText = document.getElementById('submit-text');

    if (form && submitBtn) {
        form.addEventListener('submit', function () {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            submitText.textContent = 'Submitting Official Application...';
        });
    }
});
</script>
@endpush
