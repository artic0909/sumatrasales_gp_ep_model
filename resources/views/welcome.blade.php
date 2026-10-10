<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sumatra Sales Private Limited - Technology for People</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        .font-script {
            font-family: 'Caveat', cursive;
        }
        .hero-bg-gradient {
            background: linear-gradient(90deg, 
                rgba(3, 14, 39, 0.96) 0%, 
                rgba(4, 21, 57, 0.90) 35%, 
                rgba(6, 26, 70, 0.65) 60%, 
                rgba(5, 20, 54, 0.85) 100%
            ), url('/img/hero-bg.jpg');
            background-size: cover;
            background-position: center right;
        }
        @media (max-width: 768px) {
            .hero-bg-gradient {
                background: linear-gradient(180deg, 
                    rgba(3, 14, 39, 0.95) 0%, 
                    rgba(4, 21, 57, 0.92) 50%, 
                    rgba(6, 26, 70, 0.90) 100%
                ), url('/img/hero-bg.jpg');
                background-size: cover;
                background-position: center;
            }
        }
        .marquee-track {
            display: flex;
            width: max-content;
            will-change: transform;
        }
        .solution-card {
            transition: box-shadow 0.25s ease, border-color 0.25s ease, background-color 0.25s ease;
            will-change: transform, opacity;
        }
        .solution-card:hover {
            transform: translateY(-8px) scale(1.06) !important;
            box-shadow: 0 20px 35px -8px rgba(0, 0, 0, 0.16) !important;
            opacity: 1 !important;
            z-index: 35 !important;
        }
        .solution-card.is-highlighted .solution-icon {
            transform: scale(1.12);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-800 antialiased selection:bg-blue-600 selection:text-white">

    <!-- TOP NAVIGATION HEADER -->
    <header class="w-full bg-white border-b border-slate-200 sticky top-0 z-50 shadow-xs">
        <!-- Top Row: Logo & Action Buttons -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <div class="flex items-center justify-between gap-4">
                
                <!-- Logo & Brand Name -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                    <img src="/logo.png" alt="Sumatra Sales" class="h-10 sm:h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-102">
                    <div class="flex flex-col">
                        <span class="text-xs sm:text-sm font-bold text-[#1E293B] leading-none tracking-tight">Private Limited</span>
                        <span class="text-[9px] sm:text-[10px] text-slate-500 font-medium tracking-tight mt-1 leading-tight">Technology for People. Solutions for a Better Tomorrow.</span>
                    </div>
                </a>

                <!-- Right Header Actions: Search, Login, Become a Partner -->
                <div class="flex items-center gap-2.5 sm:gap-3.5">
                    <!-- Search Icon Button -->
                    <button type="button" aria-label="Search" class="p-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-full transition duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>

                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 px-4 py-1.5 text-xs sm:text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-300 rounded-md shadow-xs transition duration-150">
                            Dashboard
                        </a>
                    @else
                        <!-- Login Dropdown Button -->
                        <div class="relative group">
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-1 px-3.5 py-1.5 text-xs sm:text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-300 rounded-md shadow-xs transition duration-150">
                                <span>Login</span>
                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </a>
                        </div>
                    @endauth

                    <!-- Become a Partner Primary CTA Button -->
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 sm:px-5 py-2 text-xs sm:text-sm font-bold text-white bg-[#1D64F2] hover:bg-[#1853CA] active:bg-[#1546B0] rounded-lg shadow-sm hover:shadow transition duration-150 whitespace-nowrap">
                        Become a Partner
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation Links Bar -->
        <div class="border-t border-slate-200/80 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex items-center space-x-6 sm:space-x-7 py-2.5 overflow-x-auto text-xs sm:text-sm font-semibold text-slate-700 no-scrollbar">
                    <a href="{{ route('home') }}" class="text-[#1D64F2] hover:text-[#1853CA] font-bold whitespace-nowrap">Home</a>
                    <a href="#about" class="hover:text-blue-600 transition whitespace-nowrap">About Us</a>
                    
                    <div class="flex items-center gap-1 hover:text-blue-600 transition cursor-pointer whitespace-nowrap">
                        <span>Our Platforms</span>
                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>

                    <div class="flex items-center gap-1 hover:text-blue-600 transition cursor-pointer whitespace-nowrap">
                        <span>Business Solutions</span>
                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>

                    <div class="flex items-center gap-1 hover:text-blue-600 transition cursor-pointer whitespace-nowrap">
                        <span>Partner Program</span>
                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>

                    <div class="flex items-center gap-1 hover:text-blue-600 transition cursor-pointer whitespace-nowrap">
                        <span>Investor & Trust</span>
                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>

                    <div class="flex items-center gap-1 hover:text-blue-600 transition cursor-pointer whitespace-nowrap">
                        <span>Resources</span>
                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>

                    <a href="#contact" class="hover:text-blue-600 transition whitespace-nowrap">Contact</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT CONTAINER -->
    <main class="w-full">

        <!-- HERO SECTION -->
        <section class="relative w-full hero-bg-gradient overflow-hidden pt-12 sm:pt-16 lg:pt-20 pb-24 sm:pb-32 lg:pb-36 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <!-- Left Hero Content -->
                    <div class="lg:col-span-7 xl:col-span-6 space-y-6">
                        <!-- Pill Badge -->
                        <div class="inline-flex items-center gap-2 text-cyan-300 font-semibold text-xs sm:text-sm tracking-wide">
                            <span>Digital India</span>
                            <span class="text-cyan-400">•</span>
                            <span>New Opportunity</span>
                            <span class="text-cyan-400">•</span>
                            <span>For Everyone</span>
                        </div>

                        <!-- Big Bold Headline -->
                        <div class="space-y-1">
                            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[54px] font-extrabold tracking-tight text-white leading-[1.12]">
                                Your Network
                            </h1>
                            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-[54px] font-extrabold tracking-tight text-white leading-[1.12]">
                                Our Technology
                            </h2>
                            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-[54px] font-extrabold tracking-tight text-white leading-[1.12]">
                                Your Opportunity
                            </h2>
                        </div>

                        <!-- Subtext Description -->
                        <p class="text-slate-200 text-sm sm:text-base leading-relaxed max-w-xl font-normal">
                            Join Sumatra Sales and be a part of India's growing digital ecosystem. No upfront investment fee.
                        </p>

                        <!-- CTA Action Buttons -->
                        <div class="flex flex-wrap items-center gap-4 pt-2">
                            <!-- Yellow CTA Button -->
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#FABE28] hover:bg-[#E5AC20] text-slate-950 font-extrabold text-sm sm:text-base rounded-md shadow-md transition duration-150 transform hover:-translate-y-0.5">
                                <span>Become a Partner</span>
                                <svg class="w-4 h-4 text-slate-950 font-bold" fill="none" stroke="currentColor" stroke-width="2.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>

                            <!-- Watch Video Button -->
                            <button type="button" class="inline-flex items-center gap-2.5 px-5 py-3 bg-slate-900/60 hover:bg-slate-900/80 border border-white/60 text-white font-semibold text-sm sm:text-base rounded-md shadow-sm transition duration-150 backdrop-blur-xs">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                                <span>Watch Video</span>
                            </button>
                        </div>
                    </div>

                    <!-- Right Hero Area: Floating Handwriting Script Tagline -->
                    <div class="lg:col-span-5 xl:col-span-6 relative flex flex-col items-end justify-center min-h-[140px] sm:min-h-[220px]">
                        <!-- Handwriting Script overlay matching screenshot -->
                        <div class="absolute -top-6 sm:top-0 right-4 sm:right-10 text-right transform -rotate-3 select-none pointer-events-none">
                            <div class="flex items-center justify-end gap-1 text-white/90">
                                <span class="text-amber-300 text-sm">✦</span>
                                <span class="font-script text-2xl sm:text-3xl lg:text-4xl font-bold tracking-wide text-white drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
                                    Let's Build<br>a Smarter<br>India Together
                                </span>
                                <span class="text-amber-300 text-xs self-start">✦</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- FOUR PLATFORM CARDS SECTION (OVERLAPPING HERO SECTION) -->
        <section class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 sm:-mt-28 lg:-mt-32 mb-10 sm:mb-14">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- CARD 1: DOCTORwala (Theme: #4DCBDC) -->
                <div class="bg-white rounded-2xl border border-slate-200/90 shadow-[0_12px_36px_-6px_rgba(0,0,0,0.14)] hover:shadow-[0_24px_50px_-8px_rgba(77,203,220,0.38)] transition-all duration-300 flex flex-col group hover:-translate-y-2 overflow-hidden relative">
                    <!-- Top Luminous Accent Stripe -->
                    <div class="h-1.5 w-full bg-[#4DCBDC]"></div>

                    <!-- Header Area with Luminous Gradient Tint -->
                    <div class="px-5 pt-4 pb-3 bg-gradient-to-b from-[#4DCBDC]/20 via-[#4DCBDC]/5 to-white text-center flex flex-col items-center">
                        <!-- Brand Logo displayed crisply -->
                        <div class="h-11 flex items-center justify-center">
                            <img src="/img/doctorwala.png" alt="DOCTORwala" class="h-full w-auto max-w-[190px] object-contain group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <p class="text-xs font-bold text-[#14727e] mt-1 tracking-tight">Healthcare for Everyone</p>
                    </div>

                    <!-- Edge-to-Edge Photo with Floating Badge -->
                    <div class="w-full h-44 sm:h-48 overflow-hidden relative bg-slate-100">
                        <img src="/img/doctor-card.jpg" alt="Doctorwala Doctor" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <!-- Dark vignette for high text contrast -->
                        <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-slate-950/80 via-slate-950/30 to-transparent"></div>
                        <!-- Floating Pill Badge -->
                        <div class="absolute bottom-2.5 left-3 right-3 flex items-center justify-between text-white text-[11px] font-bold">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-950/80 backdrop-blur-md border border-[#4DCBDC]/40 text-[#4DCBDC] shadow-md">
                                <span class="w-2 h-2 rounded-full bg-[#4DCBDC] animate-pulse"></span>
                                <span>24/7 Verified Booking</span>
                            </span>
                            <span class="text-cyan-200 text-[10px] font-semibold drop-shadow-sm">Doctors & OPD</span>
                        </div>
                    </div>

                    <!-- Feature Checklist -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <ul class="space-y-2.5 text-xs font-bold text-slate-800">
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#4DCBDC] text-slate-950 flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-slate-950" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Find Doctors</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#4DCBDC] text-slate-950 flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-slate-950" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Appointment Booking</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#4DCBDC] text-slate-950 flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-slate-950" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>OPD, Pathology, Diagnostic</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#4DCBDC] text-slate-950 flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-slate-950" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Digital Health Records</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#4DCBDC] text-slate-950 flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-slate-950" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Medical Shops & More</span>
                            </li>
                        </ul>

                        <!-- Eye-Catchy Button -->
                        <div class="mt-5 pt-1">
                            <a href="#" class="w-full py-2.5 px-4 bg-[#4DCBDC] hover:bg-[#3bbacb] text-slate-950 text-xs sm:text-sm font-extrabold rounded-xl flex items-center justify-center gap-1.5 shadow-md hover:shadow-lg hover:shadow-[#4DCBDC]/35 transition-all duration-200 group/btn">
                                <span>Visit Doctorwala</span>
                                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform stroke-slate-950" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: Schoolwala (Theme: #F5DB3C) -->
                <div class="bg-white rounded-2xl border border-slate-200/90 shadow-[0_12px_36px_-6px_rgba(0,0,0,0.14)] hover:shadow-[0_24px_50px_-8px_rgba(245,219,60,0.4)] transition-all duration-300 flex flex-col group hover:-translate-y-2 overflow-hidden relative">
                    <!-- Top Luminous Accent Stripe -->
                    <div class="h-1.5 w-full bg-[#F5DB3C]"></div>

                    <!-- Header Area with Luminous Gradient Tint -->
                    <div class="px-5 pt-4 pb-3 bg-gradient-to-b from-[#F5DB3C]/25 via-[#F5DB3C]/5 to-white text-center flex flex-col items-center">
                        <!-- Brand Logo displayed crisply -->
                        <div class="h-11 flex items-center justify-center gap-2">
                            <img src="/img/schoolwala.jpg" alt="Schoolwala" class="h-9 w-9 object-contain rounded-lg shadow-2xs group-hover:scale-105 transition-transform duration-300">
                            <span class="text-2xl font-black text-slate-900 tracking-tight">School<span class="text-[#caad0c]">wala</span></span>
                        </div>
                        <p class="text-xs font-bold text-amber-900/80 mt-1 tracking-tight">Digital Education</p>
                    </div>

                    <!-- Edge-to-Edge Photo with Floating Badge -->
                    <div class="w-full h-44 sm:h-48 overflow-hidden relative bg-slate-100">
                        <img src="/img/students-card.jpg" alt="Schoolwala Students" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <!-- Dark vignette for high text contrast -->
                        <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-slate-950/80 via-slate-950/30 to-transparent"></div>
                        <!-- Floating Pill Badge -->
                        <div class="absolute bottom-2.5 left-3 right-3 flex items-center justify-between text-white text-[11px] font-bold">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-950/80 backdrop-blur-md border border-[#F5DB3C]/40 text-[#F5DB3C] shadow-md">
                                <span class="text-[#F5DB3C]">★</span>
                                <span>Bengali Medium Focus</span>
                            </span>
                            <span class="text-amber-200 text-[10px] font-semibold drop-shadow-sm">WBBSE Syllabus</span>
                        </div>
                    </div>

                    <!-- Feature Checklist -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <ul class="space-y-2.5 text-xs font-bold text-slate-800">
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#F5DB3C] text-slate-950 flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-slate-950" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Classes VIII, IX & X</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#F5DB3C] text-slate-950 flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-slate-950" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Video Classes & Study Material</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#F5DB3C] text-slate-950 flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-slate-950" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Practice Tests & Revision</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#F5DB3C] text-slate-950 flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-slate-950" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Bengali Medium Focus</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#F5DB3C] text-slate-950 flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-slate-950" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Career Guidance</span>
                            </li>
                        </ul>

                        <!-- Eye-Catchy Button -->
                        <div class="mt-5 pt-1">
                            <a href="#" class="w-full py-2.5 px-4 bg-[#F5DB3C] hover:bg-[#ebd028] text-slate-950 text-xs sm:text-sm font-extrabold rounded-xl flex items-center justify-center gap-1.5 shadow-md hover:shadow-lg hover:shadow-[#F5DB3C]/40 transition-all duration-200 group/btn">
                                <span>Visit Schoolwala</span>
                                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform stroke-slate-950" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: Rani Matrimonial (Theme: #3F0001) -->
                <div class="bg-white rounded-2xl border border-slate-200/90 shadow-[0_12px_36px_-6px_rgba(0,0,0,0.14)] hover:shadow-[0_24px_50px_-8px_rgba(63,0,1,0.35)] transition-all duration-300 flex flex-col group hover:-translate-y-2 overflow-hidden relative">
                    <!-- Top Luminous Accent Stripe -->
                    <div class="h-1.5 w-full bg-[#3F0001]"></div>

                    <!-- Header Area with Luminous Gradient Tint -->
                    <div class="px-5 pt-4 pb-3 bg-gradient-to-b from-[#3F0001]/10 via-[#3F0001]/5 to-white text-center flex flex-col items-center">
                        <!-- Brand Logo displayed crisply -->
                        <div class="h-11 flex items-center justify-center gap-2">
                            <img src="/img/ranimatrimonial.png" alt="Rani Matrimonial" class="h-9 w-9 object-contain rounded-full shadow-2xs group-hover:scale-105 transition-transform duration-300">
                            <span class="text-xl font-black text-[#3F0001] tracking-tight">Rani Matrimonial</span>
                        </div>
                        <p class="text-xs font-bold text-[#3F0001]/80 mt-1 tracking-tight">Find Your Perfect Match</p>
                    </div>

                    <!-- Edge-to-Edge Photo with Floating Badge -->
                    <div class="w-full h-44 sm:h-48 overflow-hidden relative bg-slate-100">
                        <img src="/img/matrimony-card.jpg" alt="Rani Matrimonial Couple" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                        <!-- Dark vignette for high text contrast -->
                        <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-slate-950/80 via-slate-950/30 to-transparent"></div>
                        <!-- Floating Pill Badge -->
                        <div class="absolute bottom-2.5 left-3 right-3 flex items-center justify-between text-white text-[11px] font-bold">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-950/85 backdrop-blur-md border border-rose-500/30 text-rose-200 shadow-md">
                                <span class="text-rose-400">♥</span>
                                <span>100% Verified Profiles</span>
                            </span>
                            <span class="text-rose-300 text-[10px] font-semibold drop-shadow-sm">Family Privacy</span>
                        </div>
                    </div>

                    <!-- Feature Checklist -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <ul class="space-y-2.5 text-xs font-bold text-slate-800">
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#3F0001] text-white flex items-center justify-center shrink-0 shadow-2xs">
                                    <svg class="w-2.5 h-2.5 stroke-white" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Verified Profiles</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#3F0001] text-white flex items-center justify-center shrink-0 shadow-2xs">
                                    <svg class="w-2.5 h-2.5 stroke-white" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Smart Matching</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#3F0001] text-white flex items-center justify-center shrink-0 shadow-2xs">
                                    <svg class="w-2.5 h-2.5 stroke-white" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Secure & Private</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#3F0001] text-white flex items-center justify-center shrink-0 shadow-2xs">
                                    <svg class="w-2.5 h-2.5 stroke-white" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Easy Communication</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#3F0001] text-white flex items-center justify-center shrink-0 shadow-2xs">
                                    <svg class="w-2.5 h-2.5 stroke-white" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>For a Better Tomorrow</span>
                            </li>
                        </ul>

                        <!-- Eye-Catchy Button -->
                        <div class="mt-5 pt-1">
                            <a href="#" class="w-full py-2.5 px-4 bg-[#3F0001] hover:bg-[#590002] text-white text-xs sm:text-sm font-extrabold rounded-xl flex items-center justify-center gap-1.5 shadow-md hover:shadow-lg hover:shadow-rose-950/40 transition-all duration-200 group/btn">
                                <span>Visit Rani Matrimonial</span>
                                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 4: ProjectAttendance.com (Theme: #E48121) -->
                <div class="bg-white rounded-2xl border border-slate-200/90 shadow-[0_12px_36px_-6px_rgba(0,0,0,0.14)] hover:shadow-[0_24px_50px_-8px_rgba(228,129,33,0.38)] transition-all duration-300 flex flex-col group hover:-translate-y-2 overflow-hidden relative">
                    <!-- Top Luminous Accent Stripe -->
                    <div class="h-1.5 w-full bg-[#E48121]"></div>

                    <!-- Header Area with Luminous Gradient Tint -->
                    <div class="px-5 pt-4 pb-3 bg-gradient-to-b from-[#E48121]/15 via-[#E48121]/5 to-white text-center flex flex-col items-center">
                        <!-- Brand Logo displayed crisply -->
                        <div class="h-11 flex items-center justify-center gap-2">
                            <img src="/img/projectattendance.png" alt="ProjectAttendance" class="h-9 w-9 object-contain group-hover:scale-105 transition-transform duration-300">
                            <span class="text-xl font-black text-[#E48121] tracking-tight">ProjectAttendance<span class="text-slate-600 font-bold text-xs">.com</span></span>
                        </div>
                        <p class="text-xs font-bold text-[#b8610f] mt-1 tracking-tight">Workforce & Admin Management</p>
                    </div>

                    <!-- Edge-to-Edge Photo with Floating Badge -->
                    <div class="w-full h-44 sm:h-48 overflow-hidden relative bg-slate-100">
                        <img src="/img/project-card.jpg" alt="ProjectAttendance Supervisors" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <!-- Dark vignette for high text contrast -->
                        <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-slate-950/80 via-slate-950/30 to-transparent"></div>
                        <!-- Floating Pill Badge -->
                        <div class="absolute bottom-2.5 left-3 right-3 flex items-center justify-between text-white text-[11px] font-bold">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-950/85 backdrop-blur-md border border-[#E48121]/40 text-[#E48121] shadow-md">
                                <span class="text-[#E48121]">📍</span>
                                <span>GPS Geofence Tracking</span>
                            </span>
                            <span class="text-amber-200 text-[10px] font-semibold drop-shadow-sm">Live Attendance</span>
                        </div>
                    </div>

                    <!-- Feature Checklist -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <ul class="space-y-2.5 text-xs font-bold text-slate-800">
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#E48121] text-white flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-white" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Attendance & Work Tracking</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#E48121] text-white flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-white" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Staff & Worker Management</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#E48121] text-white flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-white" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Real-Time Location & Reports</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#E48121] text-white flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-white" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Screen-Time Control</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="w-4 h-4 rounded-full bg-[#E48121] text-white flex items-center justify-center shrink-0 shadow-2xs font-extrabold">
                                    <svg class="w-2.5 h-2.5 stroke-white" fill="none" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </span>
                                <span>Project & Task Management</span>
                            </li>
                        </ul>

                        <!-- Eye-Catchy Button -->
                        <div class="mt-5 pt-1">
                            <a href="#" class="w-full py-2.5 px-4 bg-[#E48121] hover:bg-[#cb6f16] text-white text-xs sm:text-sm font-extrabold rounded-xl flex items-center justify-center gap-1.5 shadow-md hover:shadow-lg hover:shadow-[#E48121]/35 transition-all duration-200 group/btn">
                                <span>Visit ProjectAttendance</span>
                                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- SOFTWARE DEVELOPMENT & DIGITAL SOLUTIONS SECTION (AUTO SCROLL MARQUEE) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 overflow-hidden">
            <!-- Section Header -->
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-xl sm:text-2xl font-extrabold text-[#0B1727] tracking-tight">
                    Software Development & Digital Solutions
                </h2>
                <span class="text-xs font-semibold text-slate-400 hidden sm:inline-flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Turnkey Tech Solutions
                </span>
            </div>

            <!-- Marquee Container (Clean overflow, no blurry overlays) -->
            <div id="solutions-marquee-container" class="relative w-full overflow-hidden py-8 -my-6 select-none">
                <!-- Scrolling Track with duplicated cards for seamless infinite loop -->
                <div id="solutions-marquee-track" class="marquee-track flex gap-5 sm:gap-6 items-center">
                    
                    <!-- ===== SET 1 ===== -->
                    <!-- Solution 1: Readymade Software -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#9333ea">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-purple-50 group-hover:bg-purple-100 border border-purple-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="16" rx="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M3 10h18M7 7h.01M10 7h.01M13 7h.01" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-purple-700 transition-colors tracking-tight leading-tight block">
                                Readymade Software
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-purple-700 bg-purple-50/90 px-2.5 py-0.5 rounded-full border border-purple-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-purple-600"></span>
                            <span>ERP & CRM</span>
                        </span>
                    </div>

                    <!-- Solution 2: Custom Software Development -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#2563eb">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-blue-50 group-hover:bg-blue-100 border border-blue-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75 16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-blue-700 transition-colors tracking-tight leading-tight block">
                                Custom Software
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-blue-700 bg-blue-50/90 px-2.5 py-0.5 rounded-full border border-blue-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                            <span>Tailor-Made Code</span>
                        </span>
                    </div>

                    <!-- Solution 3: Website Development -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#0891b2">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-cyan-50 group-hover:bg-cyan-100 border border-cyan-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-cyan-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-cyan-700 transition-colors tracking-tight leading-tight block">
                                Website Development
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-cyan-700 bg-cyan-50/90 px-2.5 py-0.5 rounded-full border border-cyan-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-600"></span>
                            <span>Web & Portals</span>
                        </span>
                    </div>

                    <!-- Solution 4: Android & iOS App Development -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#4f46e5">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-indigo-50 group-hover:bg-indigo-100 border border-indigo-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="6" y="2" width="12" height="20" rx="3" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="18" r="1" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-indigo-700 transition-colors tracking-tight leading-tight block">
                                Mobile App Dev
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-indigo-700 bg-indigo-50/90 px-2.5 py-0.5 rounded-full border border-indigo-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>
                            <span>Android & iOS</span>
                        </span>
                    </div>

                    <!-- Solution 5: AI Solutions & Automation -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#0d9488">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-teal-50 group-hover:bg-teal-100 border border-teal-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-teal-700 transition-colors tracking-tight leading-tight block">
                                AI & Automation
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-teal-700 bg-teal-50/90 px-2.5 py-0.5 rounded-full border border-teal-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-600"></span>
                            <span>Smart Workflows</span>
                        </span>
                    </div>

                    <!-- Solution 6: Business Software -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#7c3aed">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-violet-50 group-hover:bg-violet-100 border border-violet-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-violet-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 0 1 0 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-violet-700 transition-colors tracking-tight leading-tight block">
                                Business Software
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-violet-700 bg-violet-50/90 px-2.5 py-0.5 rounded-full border border-violet-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-violet-600"></span>
                            <span>Billing & POS</span>
                        </span>
                    </div>

                    <!-- Solution 7: Business Solutions -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#059669">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-emerald-50 group-hover:bg-emerald-100 border border-emerald-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-emerald-700 transition-colors tracking-tight leading-tight block">
                                Business Solutions
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-emerald-700 bg-emerald-50/90 px-2.5 py-0.5 rounded-full border border-emerald-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                            <span>Strategy & Growth</span>
                        </span>
                    </div>

                    <!-- Solution 8: AMC & Support -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#0284c7">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-sky-50 group-hover:bg-sky-100 border border-sky-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-sky-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-sky-700 transition-colors tracking-tight leading-tight block">
                                AMC & Support
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-sky-700 bg-sky-50/90 px-2.5 py-0.5 rounded-full border border-sky-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-sky-600"></span>
                            <span>24/7 Dedicated Care</span>
                        </span>
                    </div>

                    <!-- ===== SET 2 (DUPLICATE FOR SEAMLESS INFINITE LOOP) ===== -->
                    <!-- Solution 1: Readymade Software -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#9333ea">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-purple-50 group-hover:bg-purple-100 border border-purple-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="16" rx="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M3 10h18M7 7h.01M10 7h.01M13 7h.01" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-purple-700 transition-colors tracking-tight leading-tight block">
                                Readymade Software
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-purple-700 bg-purple-50/90 px-2.5 py-0.5 rounded-full border border-purple-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-purple-600"></span>
                            <span>ERP & CRM</span>
                        </span>
                    </div>

                    <!-- Solution 2: Custom Software Development -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#2563eb">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-blue-50 group-hover:bg-blue-100 border border-blue-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75 16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-blue-700 transition-colors tracking-tight leading-tight block">
                                Custom Software
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-blue-700 bg-blue-50/90 px-2.5 py-0.5 rounded-full border border-blue-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                            <span>Tailor-Made Code</span>
                        </span>
                    </div>

                    <!-- Solution 3: Website Development -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#0891b2">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-cyan-50 group-hover:bg-cyan-100 border border-cyan-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-cyan-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-cyan-700 transition-colors tracking-tight leading-tight block">
                                Website Development
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-cyan-700 bg-cyan-50/90 px-2.5 py-0.5 rounded-full border border-cyan-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-600"></span>
                            <span>Web & Portals</span>
                        </span>
                    </div>

                    <!-- Solution 4: Android & iOS App Development -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#4f46e5">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-indigo-50 group-hover:bg-indigo-100 border border-indigo-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="6" y="2" width="12" height="20" rx="3" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="18" r="1" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-indigo-700 transition-colors tracking-tight leading-tight block">
                                Mobile App Dev
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-indigo-700 bg-indigo-50/90 px-2.5 py-0.5 rounded-full border border-indigo-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>
                            <span>Android & iOS</span>
                        </span>
                    </div>

                    <!-- Solution 5: AI Solutions & Automation -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#0d9488">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-teal-50 group-hover:bg-teal-100 border border-teal-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-teal-700 transition-colors tracking-tight leading-tight block">
                                AI & Automation
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-teal-700 bg-teal-50/90 px-2.5 py-0.5 rounded-full border border-teal-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-600"></span>
                            <span>Smart Workflows</span>
                        </span>
                    </div>

                    <!-- Solution 6: Business Software -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#7c3aed">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-violet-50 group-hover:bg-violet-100 border border-violet-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-violet-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 0 1 0 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-violet-700 transition-colors tracking-tight leading-tight block">
                                Business Software
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-violet-700 bg-violet-50/90 px-2.5 py-0.5 rounded-full border border-violet-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-violet-600"></span>
                            <span>Billing & POS</span>
                        </span>
                    </div>

                    <!-- Solution 7: Business Solutions -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#059669">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-emerald-50 group-hover:bg-emerald-100 border border-emerald-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-emerald-700 transition-colors tracking-tight leading-tight block">
                                Business Solutions
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-emerald-700 bg-emerald-50/90 px-2.5 py-0.5 rounded-full border border-emerald-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                            <span>Strategy & Growth</span>
                        </span>
                    </div>

                    <!-- Solution 8: AMC & Support -->
                    <div class="solution-card w-[205px] sm:w-[225px] h-[200px] sm:h-[215px] shrink-0 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 flex flex-col justify-between items-center text-center shadow-xs hover:shadow-xl cursor-pointer group relative overflow-hidden"
                         data-border="#0284c7">
                        <div class="solution-icon w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-sky-50 group-hover:bg-sky-100 border border-sky-200/80 flex items-center justify-center transition-all duration-300 shadow-2xs">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-sky-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div class="my-auto">
                            <span class="text-sm sm:text-[15px] font-black text-slate-900 group-hover:text-sky-700 transition-colors tracking-tight leading-tight block">
                                AMC & Support
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-sky-700 bg-sky-50/90 px-2.5 py-0.5 rounded-full border border-sky-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-sky-600"></span>
                            <span>24/7 Dedicated Care</span>
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- HOW IT WORKS SECTION -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 mb-6">
                <div>
                    <h2 class="text-xl sm:text-2xl font-black text-[#0B1727] tracking-tight">How It Works</h2>
                    <p class="text-xs sm:text-sm font-semibold text-slate-500 mt-0.5">Simple Process • Clear Opportunity • Transparent System</p>
                </div>
                <div class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-xs font-bold text-slate-600">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span>5 Straightforward Steps to Earn</span>
                </div>
            </div>

            <!-- Two-Column Container: 5 Steps & No Upfront Box -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-6 items-stretch">
                
                <!-- Left: 5 Flowchart Steps (Span 8 Cols) -->
                <div class="lg:col-span-8 bg-white border border-slate-200/90 rounded-2xl p-5 sm:p-6 shadow-xs flex flex-col justify-between">
                    
                    <!-- Top Sub-header inside Card -->
                    <div class="flex items-center justify-between pb-3.5 mb-2 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                            <span class="text-xs font-black uppercase tracking-wider text-slate-700">Partner Workflow</span>
                        </div>
                        <span class="text-[11px] font-bold text-blue-700 bg-blue-50 px-2.5 py-0.5 rounded-full border border-blue-200/60">
                            Zero Technical Knowledge Required
                        </span>
                    </div>

                    <!-- DESKTOP / TABLET: 5 Steps in ONE Single Seamless Horizontal Row -->
                    <div class="hidden sm:flex items-center justify-between gap-1.5 sm:gap-2 my-auto py-3">
                        
                        <!-- Step 1 -->
                        <div class="flex-1 flex flex-col items-center text-center group cursor-default">
                            <div class="w-7 h-7 rounded-full bg-[#8B5CF6] text-white text-xs font-black flex items-center justify-center mb-2.5 shadow-xs group-hover:scale-110 transition-transform">
                                1
                            </div>
                            <div class="w-13 h-13 rounded-2xl bg-purple-50 border border-purple-200/70 flex items-center justify-center mb-2.5 text-purple-600 shadow-2xs group-hover:bg-purple-100 group-hover:shadow-md transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.33a4.126 4.126 0 0 0-6.338 0 .375.375 0 0 0 .26.67h5.818a.375.375 0 0 0 .26-.67Z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-800 leading-tight">
                                Register<br><span class="text-slate-500 font-semibold text-[11px]">as GP or EP</span>
                            </span>
                        </div>

                        <!-- Connector 1 -->
                        <div class="shrink-0 text-slate-300 -mt-7">
                            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                        </div>

                        <!-- Step 2 -->
                        <div class="flex-1 flex flex-col items-center text-center group cursor-default">
                            <div class="w-7 h-7 rounded-full bg-[#F59E0B] text-white text-xs font-black flex items-center justify-center mb-2.5 shadow-xs group-hover:scale-110 transition-transform">
                                2
                            </div>
                            <div class="w-13 h-13 rounded-2xl bg-amber-50 border border-amber-200/70 flex items-center justify-center mb-2.5 text-amber-600 shadow-2xs group-hover:bg-amber-100 group-hover:shadow-md transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-800 leading-tight">
                                Find & Introduce<br><span class="text-slate-500 font-semibold text-[11px]">Customers</span>
                            </span>
                        </div>

                        <!-- Connector 2 -->
                        <div class="shrink-0 text-slate-300 -mt-7">
                            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex-1 flex flex-col items-center text-center group cursor-default">
                            <div class="w-7 h-7 rounded-full bg-[#6366F1] text-white text-xs font-black flex items-center justify-center mb-2.5 shadow-xs group-hover:scale-110 transition-transform">
                                3
                            </div>
                            <div class="w-13 h-13 rounded-2xl bg-indigo-50 border border-indigo-200/70 flex items-center justify-center mb-2.5 text-indigo-600 shadow-2xs group-hover:bg-indigo-100 group-hover:shadow-md transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-800 leading-tight">
                                Our Team Handles<br><span class="text-indigo-600 font-bold text-[11px]">Conversion</span>
                            </span>
                        </div>

                        <!-- Connector 3 -->
                        <div class="shrink-0 text-slate-300 -mt-7">
                            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                        </div>

                        <!-- Step 4 -->
                        <div class="flex-1 flex flex-col items-center text-center group cursor-default">
                            <div class="w-7 h-7 rounded-full bg-[#10B981] text-white text-xs font-black flex items-center justify-center mb-2.5 shadow-xs group-hover:scale-110 transition-transform">
                                4
                            </div>
                            <div class="w-13 h-13 rounded-2xl bg-emerald-50 border border-emerald-200/70 flex items-center justify-center mb-2.5 text-emerald-600 shadow-2xs group-hover:bg-emerald-100 group-hover:shadow-md transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0H3m1.5 0h13.5m-15 0v12.75a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 18 4.5H4.5Z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-800 leading-tight">
                                Customer Onboards<br><span class="text-slate-500 font-semibold text-[11px]">& Pays</span>
                            </span>
                        </div>

                        <!-- Connector 4 -->
                        <div class="shrink-0 text-slate-300 -mt-7">
                            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                        </div>

                        <!-- Step 5 -->
                        <div class="flex-1 flex flex-col items-center text-center group cursor-default">
                            <div class="w-7 h-7 rounded-full bg-[#F97316] text-white text-xs font-black flex items-center justify-center mb-2.5 shadow-xs group-hover:scale-110 transition-transform">
                                5
                            </div>
                            <div class="w-13 h-13 rounded-2xl bg-orange-50 border border-orange-200/70 flex items-center justify-center mb-2.5 text-orange-600 shadow-2xs group-hover:bg-orange-100 group-hover:shadow-md transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-800 leading-tight">
                                Get Your<br><span class="text-orange-600 font-bold text-[11px]">Commission</span>
                            </span>
                        </div>

                    </div>

                    <!-- MOBILE ONLY: Connected Vertical Workflow -->
                    <div class="flex sm:hidden flex-col gap-3 my-2">
                        <!-- Mobile Step 1 -->
                        <div class="flex items-center gap-3 p-2.5 rounded-xl bg-purple-50/50 border border-purple-100">
                            <div class="w-6 h-6 rounded-full bg-[#8B5CF6] text-white text-xs font-black flex items-center justify-center shrink-0">1</div>
                            <div class="w-9 h-9 rounded-lg bg-white border border-purple-200 flex items-center justify-center text-purple-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" /></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Register as GP or EP</span>
                        </div>
                        <!-- Mobile Step 2 -->
                        <div class="flex items-center gap-3 p-2.5 rounded-xl bg-amber-50/50 border border-amber-100">
                            <div class="w-6 h-6 rounded-full bg-[#F59E0B] text-white text-xs font-black flex items-center justify-center shrink-0">2</div>
                            <div class="w-9 h-9 rounded-lg bg-white border border-amber-200 flex items-center justify-center text-amber-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Find & Introduce Customers</span>
                        </div>
                        <!-- Mobile Step 3 -->
                        <div class="flex items-center gap-3 p-2.5 rounded-xl bg-indigo-50/50 border border-indigo-100">
                            <div class="w-6 h-6 rounded-full bg-[#6366F1] text-white text-xs font-black flex items-center justify-center shrink-0">3</div>
                            <div class="w-9 h-9 rounded-lg bg-white border border-indigo-200 flex items-center justify-center text-indigo-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25" /></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Our Team Handles Conversion</span>
                        </div>
                        <!-- Mobile Step 4 -->
                        <div class="flex items-center gap-3 p-2.5 rounded-xl bg-emerald-50/50 border border-emerald-100">
                            <div class="w-6 h-6 rounded-full bg-[#10B981] text-white text-xs font-black flex items-center justify-center shrink-0">4</div>
                            <div class="w-9 h-9 rounded-lg bg-white border border-emerald-200 flex items-center justify-center text-emerald-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75" /></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Customer Onboards & Pays</span>
                        </div>
                        <!-- Mobile Step 5 -->
                        <div class="flex items-center gap-3 p-2.5 rounded-xl bg-orange-50/50 border border-orange-100">
                            <div class="w-6 h-6 rounded-full bg-[#F97316] text-white text-xs font-black flex items-center justify-center shrink-0">5</div>
                            <div class="w-9 h-9 rounded-lg bg-white border border-orange-200 flex items-center justify-center text-orange-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0" /></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Get Your Commission</span>
                        </div>
                    </div>

                    <!-- Bottom reassurance info -->
                    <div class="mt-3 pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-2 text-[11px] text-slate-500 font-medium">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            Demos, technical closing & delivery handled entirely by SumatraSales
                        </span>
                        <span class="text-slate-600 font-bold bg-slate-50 px-2 py-0.5 rounded border border-slate-200">
                            100% Transparent Tracking
                        </span>
                    </div>

                </div>

                <!-- Right: "No Upfront Investment" Box (Span 4 Cols) -->
                <div class="lg:col-span-4 bg-gradient-to-br from-emerald-50/70 via-white to-emerald-50/30 border border-emerald-200/90 rounded-2xl p-5 sm:p-6 shadow-xs flex flex-col justify-between">
                    <div>
                        <!-- Header Green Badge -->
                        <div class="flex items-center justify-between">
                            <div class="inline-flex items-center gap-1.5 text-emerald-800 font-extrabold text-xs bg-emerald-100/80 px-2.5 py-1 rounded-full border border-emerald-300/80">
                                <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                <span>Zero Risk Guarantee</span>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-wider text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                                100% Free
                            </span>
                        </div>

                        <!-- Rupee Prohibition Graphic & Heading Card -->
                        <div class="flex items-center gap-3.5 my-4 p-3.5 rounded-xl bg-white border border-emerald-200/80 shadow-2xs">
                            <!-- Red Slash Rupee Icon -->
                            <div class="relative w-12 h-12 shrink-0 flex items-center justify-center">
                                <svg viewBox="0 0 48 48" class="w-full h-full text-red-600 drop-shadow-2xs" fill="none">
                                    <circle cx="24" cy="24" r="21" stroke="#DC2626" stroke-width="3.5" fill="#FEF2F2" />
                                    <!-- Rupee Symbol -->
                                    <text x="24" y="29" font-family="'Plus Jakarta Sans', sans-serif" font-size="20" font-weight="900" fill="#DC2626" text-anchor="middle">₹</text>
                                    <!-- Diagonal Prohibition Slash -->
                                    <line x1="9" y1="9" x2="39" y2="39" stroke="#DC2626" stroke-width="3.5" stroke-linecap="round" />
                                </svg>
                            </div>

                            <div>
                                <span class="font-extrabold text-xs sm:text-sm text-slate-900 leading-snug block">
                                    No Investment Fee<br>to Start as a Partner
                                </span>
                                <span class="text-[11px] font-semibold text-emerald-700 block mt-0.5">
                                    ₹0 Joining • ₹0 Security Deposit
                                </span>
                            </div>
                        </div>

                        <!-- Value Points -->
                        <div class="space-y-1.5 px-0.5">
                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                                <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                <span>Free sales collateral & demo access</span>
                            </div>
                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                                <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                <span>No sales target pressure or penalties</span>
                            </div>
                        </div>
                    </div>

                    <!-- Disclaimer text -->
                    <div class="border-t border-emerald-200/80 pt-3 mt-4">
                        <p class="text-[11px] text-slate-600 font-medium leading-relaxed flex items-start gap-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Your income depends on your work, performance and approved commission structure.</span>
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <!-- INVESTOR & PUBLIC TRUST SECTION -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 sm:py-7">
            <div class="relative overflow-hidden bg-gradient-to-br from-[#2355DB] via-[#1F4ED0] to-[#173FAD] rounded-2xl sm:rounded-3xl p-6 sm:p-8 text-white shadow-xl border border-blue-400/25">
                
                <!-- Subtle Decorative Background Glows -->
                <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-white/10 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-cyan-400/15 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-center">
                    
                    <!-- Left: Title, Trust Statement & CTA (Span 5) -->
                    <div class="lg:col-span-5 flex flex-col justify-between">
                        <div>
                            <!-- Trust Badge -->
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-white text-xs font-extrabold tracking-wide mb-3 backdrop-blur-xs">
                                <svg class="w-3.5 h-3.5 text-cyan-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                </svg>
                                <span>CORPORATE GOVERNANCE</span>
                            </div>

                            <h3 class="text-2xl sm:text-3xl font-black tracking-tight text-white leading-tight">
                                Investor & Public Trust
                            </h3>
                            
                            <p class="text-xs sm:text-sm text-blue-100 font-medium leading-relaxed mt-2.5 pr-2">
                                Complete operational transparency, verified technological intellectual property, and public corporate governance for all stakeholders.
                            </p>
                        </div>

                        <!-- CTA Action Button & Quick Trust Note -->
                        <div class="mt-6 flex flex-wrap items-center gap-3">
                            <a href="#" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-blue-50 text-[#2355DB] font-extrabold text-xs sm:text-sm rounded-xl shadow-md hover:shadow-lg hover:scale-[1.02] transition-all group">
                                <span>Explore Investor Hub</span>
                                <svg class="w-4 h-4 text-[#2355DB] group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                            <span class="text-[11px] font-semibold text-blue-200">
                                Audited & Publicly Disclosed
                            </span>
                        </div>
                    </div>

                    <!-- Right: The 7 Pillars in a Clean Interactive Grid (Span 7) -->
                    <div class="lg:col-span-7">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                            
                            <!-- Pillar 1: Vision & Mission -->
                            <a href="#" class="flex items-center gap-3 p-3 rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 hover:border-white/30 backdrop-blur-xs transition-all group">
                                <div class="w-9 h-9 rounded-lg bg-white/15 flex items-center justify-center text-cyan-300 group-hover:scale-110 group-hover:bg-white group-hover:text-[#2355DB] transition-all shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="9" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 8v8M8 12h8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs font-bold text-white group-hover:text-cyan-200 transition-colors truncate">Our Vision & Mission</div>
                                    <div class="text-[10px] text-blue-200 font-medium truncate">Long-term vision & purpose</div>
                                </div>
                            </a>

                            <!-- Pillar 2: Business Model -->
                            <a href="#" class="flex items-center gap-3 p-3 rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 hover:border-white/30 backdrop-blur-xs transition-all group">
                                <div class="w-9 h-9 rounded-lg bg-white/15 flex items-center justify-center text-cyan-300 group-hover:scale-110 group-hover:bg-white group-hover:text-[#2355DB] transition-all shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-9h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.75c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12l1.5 3H3V3Z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs font-bold text-white group-hover:text-cyan-200 transition-colors truncate">Business Model</div>
                                    <div class="text-[10px] text-blue-200 font-medium truncate">EP & GP partner economics</div>
                                </div>
                            </a>

                            <!-- Pillar 3: Products & Technology -->
                            <a href="#" class="flex items-center gap-3 p-3 rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 hover:border-white/30 backdrop-blur-xs transition-all group">
                                <div class="w-9 h-9 rounded-lg bg-white/15 flex items-center justify-center text-cyan-300 group-hover:scale-110 group-hover:bg-white group-hover:text-[#2355DB] transition-all shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 16.5V21m3.75-18v1.5m0 16.5V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs font-bold text-white group-hover:text-cyan-200 transition-colors truncate">Products & Technology</div>
                                    <div class="text-[10px] text-blue-200 font-medium truncate">Doctorwala, Schoolwala & apps</div>
                                </div>
                            </a>

                            <!-- Pillar 4: Growth Strategy -->
                            <a href="#" class="flex items-center gap-3 p-3 rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 hover:border-white/30 backdrop-blur-xs transition-all group">
                                <div class="w-9 h-9 rounded-lg bg-white/15 flex items-center justify-center text-cyan-300 group-hover:scale-110 group-hover:bg-white group-hover:text-[#2355DB] transition-all shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs font-bold text-white group-hover:text-cyan-200 transition-colors truncate">Growth Strategy</div>
                                    <div class="text-[10px] text-blue-200 font-medium truncate">Scale & market expansion plan</div>
                                </div>
                            </a>

                            <!-- Pillar 5: Governance & Policies -->
                            <a href="#" class="flex items-center gap-3 p-3 rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 hover:border-white/30 backdrop-blur-xs transition-all group">
                                <div class="w-9 h-9 rounded-lg bg-white/15 flex items-center justify-center text-cyan-300 group-hover:scale-110 group-hover:bg-white group-hover:text-[#2355DB] transition-all shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs font-bold text-white group-hover:text-cyan-200 transition-colors truncate">Governance & Policies</div>
                                    <div class="text-[10px] text-blue-200 font-medium truncate">Ethical code & partner charter</div>
                                </div>
                            </a>

                            <!-- Pillar 6: Business Transparency -->
                            <a href="#" class="flex items-center gap-3 p-3 rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 hover:border-white/30 backdrop-blur-xs transition-all group">
                                <div class="w-9 h-9 rounded-lg bg-white/15 flex items-center justify-center text-cyan-300 group-hover:scale-110 group-hover:bg-white group-hover:text-[#2355DB] transition-all shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs font-bold text-white group-hover:text-cyan-200 transition-colors truncate">Business Transparency</div>
                                    <div class="text-[10px] text-blue-200 font-medium truncate">Audit logs & open operations</div>
                                </div>
                            </a>

                            <!-- Pillar 7: Investor Information -->
                            <a href="#" class="sm:col-span-2 flex items-center justify-between p-3 rounded-xl bg-white/15 hover:bg-white/25 border border-white/25 hover:border-white/40 backdrop-blur-xs transition-all group">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-9 h-9 rounded-lg bg-white/20 flex items-center justify-center text-cyan-300 group-hover:scale-110 group-hover:bg-white group-hover:text-[#2355DB] transition-all shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-xs font-bold text-white group-hover:text-cyan-200 transition-colors truncate">Investor Information & Filings</div>
                                        <div class="text-[10px] text-blue-200 font-medium truncate">Shareholder structure, capital model & annual disclosure</div>
                                    </div>
                                </div>
                                <svg class="w-4 h-4 text-white/70 group-hover:text-white group-hover:translate-x-1 transition-all shrink-0 ml-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- STATS & COUNTER METRICS BAR -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 pb-12">
            <div class="bg-white rounded-xl border border-slate-200/90 p-5 shadow-xs">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6 divide-y sm:divide-y-0 sm:divide-x divide-slate-100">
                    
                    <!-- Stat 1 -->
                    <div class="flex items-center gap-3 pt-2 sm:pt-0 sm:px-3">
                        <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black text-slate-900 leading-none">4+</div>
                            <div class="text-[11px] font-semibold text-slate-500 mt-1">Digital Platforms</div>
                        </div>
                    </div>

                    <!-- Stat 2 -->
                    <div class="flex items-center gap-3 pt-2 sm:pt-0 sm:px-3">
                        <div class="w-10 h-10 rounded-lg bg-cyan-50 text-cyan-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black text-slate-900 leading-none">10+</div>
                            <div class="text-[11px] font-semibold text-slate-500 mt-1">Business Solutions</div>
                        </div>
                    </div>

                    <!-- Stat 3 -->
                    <div class="flex items-center gap-3 pt-2 sm:pt-0 sm:px-3">
                        <div class="w-10 h-10 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black text-slate-900 leading-none">1000+</div>
                            <div class="text-[11px] font-semibold text-slate-500 mt-1">Active Customers</div>
                        </div>
                    </div>

                    <!-- Stat 4 -->
                    <div class="flex items-center gap-3 pt-2 sm:pt-0 sm:px-3">
                        <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black text-slate-900 leading-none">500+</div>
                            <div class="text-[11px] font-semibold text-slate-500 mt-1">Partners (GP & EP)</div>
                        </div>
                    </div>

                    <!-- Stat 5 -->
                    <div class="flex items-center gap-3 pt-2 sm:pt-0 sm:px-3">
                        <div class="w-10 h-10 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-9h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.75c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12l1.5 3H3V3Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black text-slate-900 leading-none">100+</div>
                            <div class="text-[11px] font-semibold text-slate-500 mt-1">Cities & Growing</div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="w-full bg-[#2150D5] text-blue-100 text-xs border-t border-blue-400/30 pt-12 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Top Callout: Partner Onboarding & Quick Helpline -->
            <div class="rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 p-5 sm:p-7 mb-12 shadow-xl flex flex-col lg:flex-row items-center justify-between gap-5 text-white">
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 border border-white/25 text-white text-[11px] font-bold mb-2 backdrop-blur-xs">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-300 animate-pulse"></span>
                        <span>PAN-INDIA DIGITAL PARTNER NETWORK</span>
                    </div>
                    <h3 class="text-lg sm:text-xl font-black text-white tracking-tight">
                        Ready to Start Earning with SumatraSales?
                    </h3>
                    <p class="text-xs text-blue-100 mt-1 max-w-2xl font-medium">
                        Join 500+ Executive Partners (EP) and Growth Partners (GP) across 100+ cities. Market ready-to-use software solutions with ₹0 investment fee.
                    </p>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-3 shrink-0">
                    <a href="#partner-register" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white hover:bg-blue-50 text-[#2150D5] font-black text-xs shadow-md hover:shadow-lg transition-all">
                        <span>Register Free as Partner</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                    </a>
                    <a href="mailto:partner@sumatrasales.com" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/15 hover:bg-white/25 border border-white/25 text-white font-bold text-xs backdrop-blur-xs transition-all">
                        <svg class="w-4 h-4 text-cyan-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                        <span>partner@sumatrasales.com</span>
                    </a>
                </div>
            </div>

            <!-- Main 5-Column Navigation Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 pb-10 border-b border-white/15">
                
                <!-- Col 1: Brand & Corporate Identity (Span 4) -->
                <div class="lg:col-span-4 flex flex-col justify-between">
                    <div>
                        <!-- Logo & Brand Header in White Pill for Crisp Visibility -->
                        <div class="flex items-center gap-3 mb-3.5">
                            <div class="bg-white px-3 py-1.5 rounded-xl inline-flex items-center shadow-xs border border-white/40 shrink-0">
                                <img src="/logo.png" alt="Sumatra Sales" class="h-8 w-auto object-contain">
                            </div>
                            <div>
                                <span class="text-base font-black text-white tracking-tight block">SumatraSales™</span>
                                <span class="text-[10px] text-blue-200 font-bold tracking-wider uppercase block">Sumatra Sales Private Limited</span>
                            </div>
                        </div>

                        <!-- Company Description & SEO statement -->
                        <p class="text-xs text-blue-100 leading-relaxed font-normal mb-4">
                            Sumatra Sales Private Limited is India’s premier digital enterprise software ecosystem. We empower Executive Partners (EP) and Growth Partners (GP) to market ready-to-deploy software, custom development, and AI solutions with transparent commissions and zero upfront fees.
                        </p>

                        <!-- Corporate Credential Badges -->
                        <div class="space-y-1.5 text-[11px] text-blue-200 font-medium mb-4">
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-cyan-300"></span>
                                <span>Corporate Entity: <strong class="text-white">Sumatra Sales Pvt. Ltd.</strong></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
                                <span>Govt. of India Registered Enterprise</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-200"></span>
                                <span>ISO 9001:2015 Quality Standards Compliant</span>
                            </div>
                        </div>
                    </div>

                    <!-- Trust Accreditations -->
                    <div class="pt-3 border-t border-white/15 flex items-center gap-3">
                        <span class="inline-flex items-center gap-1.5 text-[11px] text-white font-semibold bg-white/15 px-2.5 py-1 rounded-md border border-white/20 backdrop-blur-xs">
                            <svg class="w-3.5 h-3.5 text-cyan-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" /></svg>
                            <span>100% Risk-Free</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-[11px] text-white font-semibold bg-white/15 px-2.5 py-1 rounded-md border border-white/20 backdrop-blur-xs">
                            <svg class="w-3.5 h-3.5 text-cyan-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                            <span>256-Bit SSL</span>
                        </span>
                    </div>
                </div>

                <!-- Col 2: Digital Products (Span 2) -->
                <div class="lg:col-span-2">
                    <h4 class="text-xs font-black text-white uppercase tracking-wider mb-3.5 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-cyan-300"></span>
                        <span>Readymade Software</span>
                    </h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Doctorwala™ Clinic ERP</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Schoolwala™ Campus Suite</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">RaniMatrimonial™ Portal</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Project Attendance HRMS</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Retail POS & Billing Software</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Pharmacy Management ERP</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Restaurant & Dine POS</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Lead & CRM Engine</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Hospital IPD / OPD Suite</a></li>
                    </ul>
                </div>

                <!-- Col 3: IT Services & Solutions (Span 2) -->
                <div class="lg:col-span-2">
                    <h4 class="text-xs font-black text-white uppercase tracking-wider mb-3.5 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-white"></span>
                        <span>Development & IT</span>
                    </h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Custom Software Dev</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Website & Portal Dev</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Android App Development</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">iOS App Development</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">AI Solutions & Automation</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Cloud Infrastructure & AWS</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Payment Gateway Integrations</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Annual Maintenance (AMC)</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">24/7 Dedicated Support</a></li>
                    </ul>
                </div>

                <!-- Col 4: Partner Network & Earning (Span 2) -->
                <div class="lg:col-span-2">
                    <h4 class="text-xs font-black text-white uppercase tracking-wider mb-3.5 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-amber-300"></span>
                        <span>Partner Network</span>
                    </h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#" class="text-white hover:text-amber-200 transition-colors block font-bold">Growth Partner (GP)</a></li>
                        <li><a href="#" class="text-white hover:text-amber-200 transition-colors block font-bold">Executive Partner (EP)</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Commission Structure</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Zero Upfront Policy</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Partner Academy & Training</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Sales Pitch Decks</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Partner Dashboard Login</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Payout Records & Banking</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Success Stories & Reviews</a></li>
                    </ul>
                </div>

                <!-- Col 5: Governance & Legal (Span 2) -->
                <div class="lg:col-span-2">
                    <h4 class="text-xs font-black text-white uppercase tracking-wider mb-3.5 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-indigo-200"></span>
                        <span>Trust & Governance</span>
                    </h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Investor Relations Hub</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Vision, Mission & Goals</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Business Model Economics</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Corporate Governance</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Business Transparency</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Privacy Policy</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Terms of Service</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Partner Charter & Ethics</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors block">Grievance Redressal Cell</a></li>
                    </ul>
                </div>

            </div>

            <!-- SEO KEYWORD DIRECTORY / POPULAR SEARCHES HUB (SEO-TE VORA) -->
            <div class="py-8 border-b border-white/15 space-y-5">
                
                <!-- SEO Keyword Cluster 1: Software Solutions in India -->
                <div>
                    <h5 class="text-[11px] font-black uppercase tracking-wider text-white mb-2 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <span>Popular Software Searches in India:</span>
                    </h5>
                    <div class="flex flex-wrap gap-x-3 gap-y-1.5 text-[11px] text-blue-100">
                        <a href="#" class="hover:text-white transition-colors">Hospital Management Software</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">School ERP System India</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Doctor Appointment Booking App</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Clinic Billing Software</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Biometric Attendance Machine with Software</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Matrimonial Portal Engine</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">GST Ready Retail POS</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Pharmacy Inventory Software</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Restaurant KOT Billing App</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Custom CRM Software Development</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">AI Business Automation India</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Mobile App Developers Kolkata</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Web Development Company India</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Software AMC Services</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Affordable Ready Software for Small Business</a>
                    </div>
                </div>

                <!-- SEO Keyword Cluster 2: Partner & Referral Opportunities -->
                <div>
                    <h5 class="text-[11px] font-black uppercase tracking-wider text-white mb-2 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Zero Investment Partner Programs:</span>
                    </h5>
                    <div class="flex flex-wrap gap-x-3 gap-y-1.5 text-[11px] text-amber-100">
                        <a href="#" class="hover:text-white transition-colors">Software Sales Partner Program</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Executive Partner (EP) Model</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Growth Partner (GP) Model</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Zero Investment Work From Home</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">High Commission IT Affiliate India</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Software Reseller Program</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Direct Bank Transfer Commission</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">Transparent Partner Payout Tracking</a>
                        <span class="text-blue-300/60">•</span>
                        <a href="#" class="hover:text-white transition-colors">B2B Software Referral Network</a>
                    </div>
                </div>

                <!-- SEO Keyword Cluster 3: Regional Hubs & Operational Coverage -->
                <div>
                    <h5 class="text-[11px] font-black uppercase tracking-wider text-white mb-2 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-cyan-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        <span>Cities & Regional Reach:</span>
                    </h5>
                    <div class="flex flex-wrap gap-x-2.5 gap-y-1.5 text-[11px] text-blue-100">
                        <span class="hover:text-white transition-colors">Kolkata</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Mumbai</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Delhi NCR</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Bengaluru</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Hyderabad</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Chennai</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Pune</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Ahmedabad</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Patna</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Bhubaneswar</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Guwahati</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Siliguri</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Durgapur</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Asansol</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Ranchi</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Lucknow</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Jaipur</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Indore</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="hover:text-white transition-colors">Surat</span>
                        <span class="text-blue-300/60">•</span>
                        <span class="text-white font-bold underline decoration-cyan-300 underline-offset-2">100+ Cities Across India</span>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright, Social & Regulatory Compliance Notice -->
            <div class="pt-6 flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left text-[11px] text-blue-100/90">
                
                <div>
                    <div>
                        © {{ date('Y') }} <strong class="text-white font-bold">Sumatra Sales Private Limited</strong>. All rights reserved.
                    </div>
                    <div class="text-[10px] text-blue-200 mt-1">
                        Corporate Headquarters: West Bengal, India • Support Helpline: partner@sumatrasales.com
                    </div>
                </div>

                <!-- Regulatory Disclaimer -->
                <div class="max-w-xl text-[10px] text-blue-100/90 leading-normal font-normal">
                    <strong class="text-white">Legal & Commission Disclaimer:</strong> SumatraSales is an enterprise technology provider. Executive Partner (EP) and Growth Partner (GP) programs are transparent referral sales frameworks. They do not constitute salaried employment or multi-level marketing (MLM). Earnings are contingent upon verified client acquisitions and agreed commission terms.
                </div>

            </div>

        </div>
    </footer>

    <!-- Solutions Marquee Controller Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('solutions-marquee-container');
            const track = document.getElementById('solutions-marquee-track');
            if (!container || !track) return;

            const cards = Array.from(track.querySelectorAll('.solution-card'));
            let isPaused = false;
            let offset = 0;
            const speed = 1.4; // increased speed for a brisk, engaging flow
            let lastTime = performance.now();

            // Hover pause
            container.addEventListener('mouseenter', () => { isPaused = true; });
            container.addEventListener('mouseleave', () => { isPaused = false; });
            // Touch pause for mobile
            let touchTimer = null;
            container.addEventListener('touchstart', () => { 
                isPaused = true; 
                clearTimeout(touchTimer);
            }, { passive: true });
            container.addEventListener('touchend', () => { 
                touchTimer = setTimeout(() => { isPaused = false; }, 1500); 
            }, { passive: true });

            function getHalfWidth() {
                return track.scrollWidth / 2;
            }
            let halfWidth = getHalfWidth();
            window.addEventListener('resize', () => {
                halfWidth = getHalfWidth();
            });

            function tick(currentTime) {
                const delta = Math.min(currentTime - lastTime, 40);
                lastTime = currentTime;

                if (!isPaused && halfWidth > 0) {
                    offset += speed * (delta / 16.667);
                    if (offset >= halfWidth) {
                        offset -= halfWidth;
                    }
                    track.style.transform = 'translate3d(-' + offset.toFixed(2) + 'px, 0, 0)';
                }

                // Dynamic scale & highlight calculations
                const cRect = container.getBoundingClientRect();
                const cLeft = cRect.left;
                const cWidth = cRect.width;

                for (let i = 0; i < cards.length; i++) {
                    const card = cards[i];

                    // If hovered by user, let CSS hover take full priority
                    if (card.matches(':hover')) {
                        card.style.transform = '';
                        card.style.opacity = '1';
                        card.style.boxShadow = '';
                        card.style.borderColor = '';
                        card.style.zIndex = '35';
                        card.classList.add('is-highlighted');
                        continue;
                    }

                    const cardRect = card.getBoundingClientRect();
                    const cardCenter = cardRect.left + cardRect.width / 2;
                    const progress = (cardCenter - cLeft) / cWidth;
                    const borderColor = card.getAttribute('data-border') || '#6366f1';

                    if (progress > 1.15) {
                        // Far right: outside view
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.85)';
                        card.style.boxShadow = '';
                        card.style.borderColor = '';
                        card.style.zIndex = '';
                        card.classList.remove('is-highlighted');
                    } else if (progress >= 0.82 && progress <= 1.15) {
                        // ENTRY ZONE (Right side):
                        // Scales up, lifts with smooth shadow — normal border preserved (NO colored border highlight)
                        const opacity = Math.min(1, Math.max(0, (1.12 - progress) / 0.16));
                        const peakRight = 1 - Math.min(1, Math.abs(progress - 0.95) / 0.10);
                        const scale = 1.0 + (0.06 * peakRight);
                        const liftY = -5 * peakRight;

                        card.style.opacity = opacity.toFixed(3);
                        card.style.transform = 'translateY(' + liftY.toFixed(1) + 'px) scale(' + scale.toFixed(3) + ')';
                        card.style.borderColor = '';

                        if (peakRight > 0.25) {
                            card.style.boxShadow = '0 10px 24px -4px rgba(0, 0, 0, 0.08)';
                            card.style.zIndex = '20';
                            card.classList.add('is-highlighted');
                        } else {
                            card.style.boxShadow = '';
                            card.style.zIndex = '';
                            card.classList.remove('is-highlighted');
                        }
                    } else if (progress >= 0.18 && progress < 0.82) {
                        // MIDDLE ZONE: Standard clean display with normal border
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0px) scale(1)';
                        card.style.boxShadow = '';
                        card.style.borderColor = '';
                        card.style.zIndex = '';
                        card.classList.remove('is-highlighted');
                    } else if (progress >= -0.12 && progress < 0.18) {
                        // EXIT ZONE (Left side / Hide):
                        // Scales up, lifts with smooth shadow — normal border preserved (NO colored border highlight)
                        const peakLeft = 1 - Math.min(1, Math.abs(progress - 0.08) / 0.09);
                        const scale = 1.0 + (0.06 * peakLeft);
                        const liftY = -5 * peakLeft;
                        const opacity = Math.min(1, Math.max(0, (progress - (-0.08)) / (0.06 - (-0.08))));

                        card.style.opacity = opacity.toFixed(3);
                        card.style.transform = 'translateY(' + liftY.toFixed(1) + 'px) scale(' + scale.toFixed(3) + ')';
                        card.style.borderColor = '';

                        if (peakLeft > 0.25) {
                            card.style.boxShadow = '0 10px 24px -4px rgba(0, 0, 0, 0.08)';
                            card.style.zIndex = '20';
                            card.classList.add('is-highlighted');
                        } else {
                            card.style.boxShadow = '';
                            card.style.zIndex = '';
                            card.classList.remove('is-highlighted');
                        }
                    } else {
                        // Far left: hidden
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.85)';
                        card.style.boxShadow = '';
                        card.style.borderColor = '';
                        card.style.zIndex = '';
                        card.classList.remove('is-highlighted');
                    }
                }

                requestAnimationFrame(tick);
            }

            requestAnimationFrame(tick);
        });
    </script>
</body>
</html>
