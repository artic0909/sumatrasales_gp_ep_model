<header class="w-full bg-white border-b border-slate-200 sticky top-0 z-50 shadow-xs">
        <!-- Top Row: Logo & Action Buttons -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2.5 sm:py-3">
            <div class="flex items-center justify-between gap-2.5 sm:gap-4">
                
                <!-- Logo & Brand Name -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3 group shrink-0">
                    <img src="/logo.png" alt="Sumatra Sales" class="h-9 sm:h-11 md:h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-102">
                    <div class="flex flex-col">
                        <span class="text-xs sm:text-sm font-black text-[#1E293B] leading-none tracking-tight">Private Limited</span>
                        <span class="hidden sm:inline-block text-[9px] sm:text-[10px] text-slate-500 font-medium tracking-tight mt-1 leading-tight">Technology for People. Solutions for a Better Tomorrow.</span>
                    </div>
                </a>

                <!-- Right Header Actions: Search, Login, Become a Partner & Mobile Toggle -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <!-- Search Icon Button (Desktop / Tablet) -->
                    <button type="button" aria-label="Search" class="hidden md:inline-flex p-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-full transition duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>

                    @auth
                        <a href="{{ route('dashboard') }}" class="hidden md:inline-flex items-center gap-1.5 px-3.5 py-1.5 text-xs sm:text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-300 rounded-md shadow-xs transition duration-150">
                            Dashboard
                        </a>
                    @else
                        <!-- Login Button (Desktop / Tablet) -->
                        <div class="hidden md:inline-block relative group">
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-1 px-3.5 py-1.5 text-xs sm:text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-300 rounded-md shadow-xs transition duration-150">
                                <span>Login</span>
                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </a>
                        </div>
                    @endauth

                    <!-- Become a Partner Primary CTA Button -->
                    <a href="{{ route('partner.register') }}" class="inline-flex items-center justify-center px-3 sm:px-5 py-1.5 sm:py-2 text-xs sm:text-sm font-bold text-white bg-[#1D64F2] hover:bg-[#1853CA] active:bg-[#1546B0] rounded-lg shadow-sm hover:shadow transition duration-150 whitespace-nowrap">
                        <span>Become a Partner</span>
                    </a>

                    <!-- Mobile Hamburger Button (Visible only on < lg screens) -->
                    <button type="button" id="mobile-menu-toggle" aria-label="Toggle navigation menu" class="lg:hidden p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition duration-150 focus:outline-hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation Links Bar with Broad Mega Dropdowns (Desktop >= lg only) -->
        <div id="sub-header-bar" class="hidden lg:block border-t border-slate-200/80 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex items-center space-x-1 sm:space-x-2 py-1.5 overflow-x-auto sm:overflow-visible text-xs sm:text-sm font-semibold text-slate-700 no-scrollbar">
                    <a href="{{ route('home') }}" class="px-3 py-1.5 rounded-lg text-[#1D64F2] hover:bg-blue-50 font-bold whitespace-nowrap transition">Home</a>
                    <a href="#about" class="px-3 py-1.5 rounded-lg hover:text-blue-600 hover:bg-slate-100 transition whitespace-nowrap">About Us</a>
                    
                    <!-- Dropdown Trigger 1: Our Platforms -->
                    <button type="button" data-dropdown-trigger="dropdown-platforms" class="nav-dropdown-trigger group inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg hover:text-blue-600 hover:bg-slate-100 transition cursor-pointer whitespace-nowrap focus:outline-hidden data-[active=true]:text-[#1D64F2] data-[active=true]:bg-blue-50 font-semibold text-slate-700">
                        <span>Our Platforms</span>
                        <svg class="dropdown-chevron w-3.5 h-3.5 text-slate-400 group-hover:text-blue-600 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <!-- Dropdown Trigger 2: Business Solutions -->
                    <button type="button" data-dropdown-trigger="dropdown-solutions" class="nav-dropdown-trigger group inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg hover:text-blue-600 hover:bg-slate-100 transition cursor-pointer whitespace-nowrap focus:outline-hidden data-[active=true]:text-[#1D64F2] data-[active=true]:bg-blue-50 font-semibold text-slate-700">
                        <span>Business Solutions</span>
                        <svg class="dropdown-chevron w-3.5 h-3.5 text-slate-400 group-hover:text-blue-600 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <!-- Dropdown Trigger 3: Partner Program -->
                    <button type="button" data-dropdown-trigger="dropdown-partner" class="nav-dropdown-trigger group inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg hover:text-blue-600 hover:bg-slate-100 transition cursor-pointer whitespace-nowrap focus:outline-hidden data-[active=true]:text-[#1D64F2] data-[active=true]:bg-blue-50 font-semibold text-slate-700">
                        <span>Partner Program</span>
                        <svg class="dropdown-chevron w-3.5 h-3.5 text-slate-400 group-hover:text-blue-600 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <!-- Dropdown Trigger 4: Investor & Trust -->
                    <button type="button" data-dropdown-trigger="dropdown-investor" class="nav-dropdown-trigger group inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg hover:text-blue-600 hover:bg-slate-100 transition cursor-pointer whitespace-nowrap focus:outline-hidden data-[active=true]:text-[#1D64F2] data-[active=true]:bg-blue-50 font-semibold text-slate-700">
                        <span>Investor & Trust</span>
                        <svg class="dropdown-chevron w-3.5 h-3.5 text-slate-400 group-hover:text-blue-600 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <!-- Dropdown Trigger 5: Resources -->
                    <button type="button" data-dropdown-trigger="dropdown-resources" class="nav-dropdown-trigger group inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg hover:text-blue-600 hover:bg-slate-100 transition cursor-pointer whitespace-nowrap focus:outline-hidden data-[active=true]:text-[#1D64F2] data-[active=true]:bg-blue-50 font-semibold text-slate-700">
                        <span>Resources</span>
                        <svg class="dropdown-chevron w-3.5 h-3.5 text-slate-400 group-hover:text-blue-600 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <a href="#contact" class="px-3 py-1.5 rounded-lg hover:text-blue-600 hover:bg-slate-100 transition whitespace-nowrap">Contact</a>
                </nav>
            </div>


            <!-- BROAD DROPDOWN PANELS CONTAINER (Centered inside max-w-7xl, floating as a high-end card) -->
            <div id="broad-dropdowns-container" class="absolute left-0 right-0 top-full w-full pointer-events-none z-50 pt-2 pb-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <!-- ============================================== -->
                    <!-- 1. BROAD DROPDOWN: OUR PLATFORMS               -->
                    <!-- ============================================== -->
                    <div id="dropdown-platforms" class="broad-dropdown-panel hidden opacity-0 -translate-y-2 pointer-events-none transition-all duration-200 bg-white rounded-2xl border border-slate-200/90 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.22)] p-5 sm:p-6 max-h-[calc(100vh-135px)] overflow-y-auto">
                        <!-- Panel Header Bar -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3.5 border-b border-slate-100 gap-3">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-200/80">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                                    <span>4 Live Ecosystems</span>
                                </span>
                                <div>
                                    <h3 class="text-sm sm:text-base font-extrabold text-slate-900">Our Flagship Digital Platforms</h3>
                                    <p class="text-[11px] sm:text-xs text-slate-500 font-medium">Proprietary technology engines built, operated, and maintained in-house by Sumatra Sales Private Limited.</p>
                                </div>
                            </div>
                            <a href="#platforms" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1 shrink-0 self-start sm:self-auto group/toplink">
                                <span>View Platforms Section</span>
                                <svg class="w-3.5 h-3.5 group-hover/toplink:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                            </a>
                        </div>

                        <!-- 4 Platform Cards Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">

                            <!-- Platform Card 1: DOCTORwala -->
                            <div class="bg-white rounded-xl border border-slate-200 border-t-4 border-t-[#881337] hover:border-rose-300 p-4 flex flex-col justify-between transition-all duration-200 hover:shadow-lg hover:-translate-y-1 group/card">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="h-8 flex items-center gap-1.5">
                                            <img src="/img/ranimatrimonial.png" alt="Rani Matrimonial" class="h-7 w-7 object-contain rounded-full shadow-2xs border border-rose-200">
                                            <span class="text-sm font-black text-[#3F0001] tracking-tight">Rani Matrimonial</span>
                                        </div>
                                        <span class="text-[10px] font-bold text-rose-800 bg-rose-50 px-2 py-0.5 rounded-md border border-rose-200/60">Matrimony</span>
                                    </div>
                                    <p class="text-xs font-bold text-slate-800 mb-1">Find Your Perfect Match</p>
                                    <p class="text-[11px] text-slate-500 leading-snug mb-3">Safe, family-verified matchmaking portal with stringent privacy and authentic profiles.</p>
                                    
                                    <ul class="space-y-1.5 text-[11px] text-slate-700 font-medium border-t border-slate-100 pt-2.5 mb-4">
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-700"></span>
                                            <span>100% Verified Profiles & Biodatas</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-700"></span>
                                            <span>Smart AI Compatibility Matching</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-700"></span>
                                            <span>Family Privacy & Shielded Contacts</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-700"></span>
                                            <span>Direct Safe In-App Communication</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="space-y-1.5 mt-3 pt-2.5 border-t border-slate-100">
                                    <a href="https://ranimatrimonial.com/" target="_blank" rel="noopener noreferrer" class="w-full py-2 px-3 rounded-lg bg-rose-50 hover:bg-[#3F0001] text-rose-950 hover:text-white font-bold text-xs transition-colors flex items-center justify-center gap-1.5 group-hover/card:bg-[#3F0001] group-hover/card:text-white">
                                        <span>Visit ranimatrimonial.com</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                                    </a>
                                    <div class="w-full py-1 px-2 rounded-md bg-rose-50 border border-rose-200/80 text-rose-900 text-[9.5px] font-bold flex items-center justify-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-600 animate-pulse"></span>
                                        <span>Android App Coming Soon</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Platform Card 2: Schoolwala -->
                            <div class="bg-white rounded-xl border border-slate-200 border-t-4 border-t-[#F5DB3C] hover:border-[#F5DB3C] p-4 flex flex-col justify-between transition-all duration-200 hover:shadow-lg hover:-translate-y-1 group/card">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="h-8 flex items-center gap-1.5">
                                            <img src="/img/schoolwala.jpg" alt="Schoolwala" class="h-7 w-7 object-contain rounded-md shadow-2xs border border-[#F5DB3C]/40">
                                            <span class="text-base font-black text-slate-900 tracking-tight">School<span class="text-[#caad0c]">wala</span></span>
                                        </div>
                                        <span class="text-[10px] font-bold text-amber-900 bg-amber-50 px-2 py-0.5 rounded-md border border-amber-200/60">EdTech</span>
                                    </div>
                                    <p class="text-xs font-bold text-slate-800 mb-1">Digital Education (Bengali Medium)</p>
                                    <p class="text-[11px] text-slate-500 leading-snug mb-3">Curriculum-aligned digital learning platform engineered for WBBSE board students.</p>
                                    
                                    <ul class="space-y-1.5 text-[11px] text-slate-700 font-medium border-t border-slate-100 pt-2.5 mb-4">
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#F5DB3C]"></span>
                                            <span>Classes VIII, IX & X Full Syllabus</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#F5DB3C]"></span>
                                            <span>High-Quality Video Classes & Notes</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#F5DB3C]"></span>
                                            <span>Chapter Practice Tests & Instant Score</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#F5DB3C]"></span>
                                            <span>Bengali Medium Focus & Mentorship</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="space-y-1.5 mt-3 pt-2.5 border-t border-slate-100">
                                    <a href="https://schoolwala.info/" target="_blank" rel="noopener noreferrer" class="w-full py-2 px-3 rounded-lg bg-amber-50 hover:bg-[#F5DB3C] text-amber-950 font-bold text-xs transition-colors flex items-center justify-center gap-1.5 group-hover/card:bg-[#F5DB3C] group-hover/card:text-slate-950">
                                        <span>Visit schoolwala.info</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                                    </a>
                                    <a href="https://play.google.com/store/apps/details?id=com.schoolwala.schoolwalaapp" target="_blank" rel="noopener noreferrer" class="w-full py-1 px-2 rounded-md bg-slate-900 hover:bg-slate-800 text-white text-[9.5px] font-bold flex items-center justify-center gap-1.5 transition" title="Schoolwala App on Google Play">
                                        <svg class="w-3 h-3 text-amber-400 shrink-0" viewBox="0 0 24 24" fill="currentColor"><path d="M3.609 1.814L13.793 12 3.61 22.186a2.03 2.03 0 0 1-.36-1.186V3a2.03 2.03 0 0 1 .359-1.186zm11.3 9.072l2.38-2.38-12.02-6.87 9.64 9.25zm0 2.228l-9.64 9.25 12.02-6.87-2.38-2.38zm1.114-1.114l2.96 1.69a1.5 1.5 0 0 0 0-2.614l-2.96 1.69z"/></svg>
                                        <span>Download Android App</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Platform Card 3: Rani Matrimonial -->
                            <div class="bg-white rounded-xl border border-slate-200 border-t-4 border-t-[#4DCBDC] hover:border-[#4DCBDC] p-4 flex flex-col justify-between transition-all duration-200 hover:shadow-lg hover:-translate-y-1 group/card">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="h-8 flex items-center gap-1.5">
                                            <img src="/img/doctorwala.png" alt="DOCTORwala" class="h-7 w-7 object-contain rounded-md shadow-2xs bg-cyan-50 p-0.5 border border-[#4DCBDC]/40">
                                            <span class="text-base font-black text-slate-900 tracking-tight">DOCTOR<span class="text-[#0ea5b7]">wala</span></span>
                                        </div>
                                        <span class="text-[10px] font-bold text-[#14727e] bg-cyan-50 px-2 py-0.5 rounded-md border border-cyan-200/60">Healthcare</span>
                                    </div>
                                    <p class="text-xs font-bold text-slate-800 mb-1">Healthcare for Everyone</p>
                                    <p class="text-[11px] text-slate-500 leading-snug mb-3">Complete OPD, verified doctor bookings, diagnostics, lab tests & local medicine delivery.</p>
                                    
                                    <ul class="space-y-1.5 text-[11px] text-slate-700 font-medium border-t border-slate-100 pt-2.5 mb-4">
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#4DCBDC]"></span>
                                            <span>24/7 Verified Doctor & OPD Booking</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#4DCBDC]"></span>
                                            <span>Pathology & Diagnostic Lab Tests</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#4DCBDC]"></span>
                                            <span>Digital Health Records (EHR)</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#4DCBDC]"></span>
                                            <span>Local Medical Store Directory</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="space-y-1.5 mt-3 pt-2.5 border-t border-slate-100">
                                    <a href="https://www.doctorwala.info/" target="_blank" rel="noopener noreferrer" class="w-full py-2 px-3 rounded-lg bg-cyan-50 hover:bg-[#4DCBDC] text-[#0d606b] hover:text-slate-950 font-bold text-xs transition-colors flex items-center justify-center gap-1.5 group-hover/card:bg-[#4DCBDC] group-hover/card:text-slate-950">
                                        <span>Visit doctorwala.info</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                                    </a>
                                    <div class="grid grid-cols-2 gap-1 pt-0.5">
                                        <a href="https://play.google.com/store/apps/details?id=com.doctorwala.dochealth&pcampaignid=web_share" target="_blank" rel="noopener noreferrer" class="py-1 px-1.5 rounded-md bg-slate-900 hover:bg-slate-800 text-white text-[9.5px] font-bold flex items-center justify-center gap-1 transition" title="Patient App on Google Play">
                                            <svg class="w-2.5 h-2.5 text-cyan-400 shrink-0" viewBox="0 0 24 24" fill="currentColor"><path d="M3.609 1.814L13.793 12 3.61 22.186a2.03 2.03 0 0 1-.36-1.186V3a2.03 2.03 0 0 1 .359-1.186zm11.3 9.072l2.38-2.38-12.02-6.87 9.64 9.25zm0 2.228l-9.64 9.25 12.02-6.87-2.38-2.38zm1.114-1.114l2.96 1.69a1.5 1.5 0 0 0 0-2.614l-2.96 1.69z"/></svg>
                                            <span>Patient App</span>
                                        </a>
                                        <a href="https://play.google.com/store/apps/details?id=info.doctorwala.partner&pcampaignid=web_share" target="_blank" rel="noopener noreferrer" class="py-1 px-1.5 rounded-md bg-cyan-50 hover:bg-cyan-100 text-[#0c5963] border border-cyan-200/80 text-[9.5px] font-bold flex items-center justify-center gap-1 transition" title="Partner App on Google Play">
                                            <svg class="w-2.5 h-2.5 text-cyan-600 shrink-0" viewBox="0 0 24 24" fill="currentColor"><path d="M3.609 1.814L13.793 12 3.61 22.186a2.03 2.03 0 0 1-.36-1.186V3a2.03 2.03 0 0 1 .359-1.186zm11.3 9.072l2.38-2.38-12.02-6.87 9.64 9.25zm0 2.228l-9.64 9.25 12.02-6.87-2.38-2.38zm1.114-1.114l2.96 1.69a1.5 1.5 0 0 0 0-2.614l-2.96 1.69z"/></svg>
                                            <span>Partner App</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Platform Card 4: ProjectAttendance -->
                            <div class="bg-white rounded-xl border border-slate-200 border-t-4 border-t-[#E48121] hover:border-[#E48121] p-4 flex flex-col justify-between transition-all duration-200 hover:shadow-lg hover:-translate-y-1 group/card">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="h-8 flex items-center gap-1">
                                            <img src="/img/projectattendance.png" alt="ProjectAttendance" class="h-7 w-7 object-contain rounded-sm border border-orange-200/60 p-0.5">
                                            <span class="text-sm font-black text-[#E48121] tracking-tight">ProjectAttendance</span>
                                        </div>
                                        <span class="text-[10px] font-bold text-orange-800 bg-orange-50 px-2 py-0.5 rounded-md border border-orange-200/60">Workforce</span>
                                    </div>
                                    <p class="text-xs font-bold text-slate-800 mb-1">Workforce & Admin HRMS</p>
                                    <p class="text-[11px] text-slate-500 leading-snug mb-3">GPS geofenced staff attendance, task logs, live field route tracking & payroll timesheets.</p>
                                    
                                    <ul class="space-y-1.5 text-[11px] text-slate-700 font-medium border-t border-slate-100 pt-2.5 mb-4">
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#E48121]"></span>
                                            <span>GPS Geofenced Mobile Punch-In</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#E48121]"></span>
                                            <span>Real-time Field Staff Route Tracking</span>
                                        </li>
                                        <li class="flex items-center gap-2.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#E48121]"></span>
                                            <span>Automated Shift & Overtime Reports</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#E48121]"></span>
                                            <span>Screen Time & Task Productivity</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="space-y-1.5 mt-3 pt-2.5 border-t border-slate-100">
                                    <a href="https://projectattendance.com/" target="_blank" rel="noopener noreferrer" class="w-full py-2 px-3 rounded-lg bg-orange-50 hover:bg-[#E48121] text-orange-950 hover:text-white font-bold text-xs transition-colors flex items-center justify-center gap-1.5 group-hover/card:bg-[#E48121] group-hover/card:text-white">
                                        <span>Visit projectattendance.com</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                                    </a>
                                    <a href="https://play.google.com/store/apps/details?id=smart.geofence.attendance&pcampaignid=web_share" target="_blank" rel="noopener noreferrer" class="w-full py-1 px-2 rounded-md bg-slate-900 hover:bg-slate-800 text-white text-[9.5px] font-bold flex items-center justify-center gap-1.5 transition" title="ProjectAttendance App on Google Play">
                                        <svg class="w-3 h-3 text-orange-400 shrink-0" viewBox="0 0 24 24" fill="currentColor"><path d="M3.609 1.814L13.793 12 3.61 22.186a2.03 2.03 0 0 1-.36-1.186V3a2.03 2.03 0 0 1 .359-1.186zm11.3 9.072l2.38-2.38-12.02-6.87 9.64 9.25zm0 2.228l-9.64 9.25 12.02-6.87-2.38-2.38zm1.114-1.114l2.96 1.69a1.5 1.5 0 0 0 0-2.614l-2.96 1.69z"/></svg>
                                        <span>Download Android App</span>
                                    </a>
                                </div>
                            </div>

                        </div>

                        <!-- Bottom Strip Banner -->
                        <div class="mt-4 pt-3 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs bg-slate-50 p-2.5 rounded-xl">
                            <div class="flex items-center gap-2 text-slate-600 font-medium">
                                <svg class="w-4 h-4 text-blue-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
                                <span>Looking to deploy these software platforms across your district, or need white-label distribution rights?</span>
                            </div>
                            <div class="flex items-center gap-3 shrink-0">
                                <a href="#partner-program" class="font-bold text-blue-600 hover:text-blue-800 transition">Become a Ground Partner &rarr;</a>
                                <span class="text-slate-300">|</span>
                                <a href="#contact" class="font-bold text-slate-700 hover:text-slate-900 transition">Schedule Live Demo &rarr;</a>
                            </div>
                        </div>

                    </div>

                    <!-- ============================================== -->
                    <!-- 2. BROAD DROPDOWN: BUSINESS SOLUTIONS          -->
                    <!-- ============================================== -->
                    <div id="dropdown-solutions" class="broad-dropdown-panel hidden opacity-0 -translate-y-2 pointer-events-none transition-all duration-200 bg-white rounded-2xl border border-slate-200/90 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.22)] p-5 sm:p-6 max-h-[calc(100vh-135px)] overflow-y-auto">
                        <!-- Panel Header Bar -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3.5 border-b border-slate-100 gap-3">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-purple-50 text-purple-700 border border-purple-200/80">
                                    <span class="w-1.5 h-1.5 rounded-full bg-purple-600 animate-pulse"></span>
                                    <span>Enterprise & SME Tech</span>
                                </span>
                                <div>
                                    <h3 class="text-sm sm:text-base font-extrabold text-slate-900">Business Software & Technology Solutions</h3>
                                    <p class="text-[11px] sm:text-xs text-slate-500 font-medium">Ready-to-deploy vertical software systems and bespoke end-to-end custom engineering.</p>
                                </div>
                            </div>
                            <a href="#solutions" class="text-xs font-bold text-purple-600 hover:text-purple-800 flex items-center gap-1 shrink-0 self-start sm:self-auto group/toplink">
                                <span>Browse Software Catalog</span>
                                <svg class="w-3.5 h-3.5 group-hover/toplink:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                            </a>
                        </div>

                        <!-- 4 Columns Grid: Readymade Software (3), Custom Engineering (3), IT & AMC (3), Consultation Card (3) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-5 mt-4">

                            <!-- Col 1: Readymade Software (Span 3) -->
                            <div class="lg:col-span-3 space-y-2.5">
                                <div class="flex items-center gap-2 pb-1 border-b border-purple-100">
                                    <div class="w-5 h-5 rounded-md bg-purple-100 text-purple-700 flex items-center justify-center">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25a2.25 2.25 0 0 1-2.25-2.25V6Z" /></svg>
                                    </div>
                                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-800">Readymade Software</h4>
                                </div>
                                <div class="space-y-1.5">
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-purple-50/70 border border-transparent hover:border-purple-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-purple-700 flex items-center justify-between">
                                            <span>Hospital IPD / OPD Suite</span>
                                            <span class="text-[9px] text-purple-600 bg-purple-100/70 px-1.5 py-0.2 rounded font-semibold">ERP</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Beds, doctor scheduling, pharmacy billing & diagnostic reports.</p>
                                    </a>
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-purple-50/70 border border-transparent hover:border-purple-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-purple-700 flex items-center justify-between">
                                            <span>School & College ERP</span>
                                            <span class="text-[9px] text-purple-600 bg-purple-100/70 px-1.5 py-0.2 rounded font-semibold">Campus</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Admissions, fee collection, student report cards & parent SMS.</p>
                                    </a>
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-purple-50/70 border border-transparent hover:border-purple-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-purple-700 flex items-center justify-between">
                                            <span>Retail POS & GST Billing</span>
                                            <span class="text-[9px] text-purple-600 bg-purple-100/70 px-1.5 py-0.2 rounded font-semibold">POS</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Supermarket barcode checkout, inventory batches & GST filing.</p>
                                    </a>
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-purple-50/70 border border-transparent hover:border-purple-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-purple-700 flex items-center justify-between">
                                            <span>Pharmacy Inventory ERP</span>
                                            <span class="text-[9px] text-purple-600 bg-purple-100/70 px-1.5 py-0.2 rounded font-semibold">Medical</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Batch expiry alerts, doctor commissions & purchase logs.</p>
                                    </a>
                                </div>
                            </div>

                            <!-- Col 2: Custom Engineering & Apps (Span 3) -->
                            <div class="lg:col-span-3 space-y-2.5">
                                <div class="flex items-center gap-2 pb-1 border-b border-blue-100">
                                    <div class="w-5 h-5 rounded-md bg-blue-100 text-blue-700 flex items-center justify-center">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" /></svg>
                                    </div>
                                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-800">Custom Engineering</h4>
                                </div>
                                <div class="space-y-1.5">
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-blue-50/70 border border-transparent hover:border-blue-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-blue-700 flex items-center justify-between">
                                            <span>Custom Web Applications</span>
                                            <span class="text-[9px] text-blue-600 bg-blue-100/70 px-1.5 py-0.2 rounded font-semibold">Web</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">High-speed SaaS portals, enterprise dashboards & cloud apps.</p>
                                    </a>
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-blue-50/70 border border-transparent hover:border-blue-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-blue-700 flex items-center justify-between">
                                            <span>Android & iOS Mobile Apps</span>
                                            <span class="text-[9px] text-blue-600 bg-blue-100/70 px-1.5 py-0.2 rounded font-semibold">Mobile</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Native and Flutter hybrid mobile apps tailored to your business.</p>
                                    </a>
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-blue-50/70 border border-transparent hover:border-blue-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-blue-700 flex items-center justify-between">
                                            <span>Lead CRM & Sales Engine</span>
                                            <span class="text-[9px] text-blue-600 bg-blue-100/70 px-1.5 py-0.2 rounded font-semibold">CRM</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">WhatsApp automated follow-ups, pipeline stages & caller tracking.</p>
                                    </a>
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-blue-50/70 border border-transparent hover:border-blue-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-blue-700 flex items-center justify-between">
                                            <span>AI Solutions & Automation</span>
                                            <span class="text-[9px] text-blue-600 bg-blue-100/70 px-1.5 py-0.2 rounded font-semibold">AI</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Document OCR, customer chatbots, auto-dispatch & workflow bots.</p>
                                    </a>
                                </div>
                            </div>

                            <!-- Col 3: Managed IT & Support (Span 3) -->
                            <div class="lg:col-span-3 space-y-2.5">
                                <div class="flex items-center gap-2 pb-1 border-b border-emerald-100">
                                    <div class="w-5 h-5 rounded-md bg-emerald-100 text-emerald-700 flex items-center justify-center">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" /></svg>
                                    </div>
                                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-800">Managed IT Services</h4>
                                </div>
                                <div class="space-y-1.5">
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-emerald-50/70 border border-transparent hover:border-emerald-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-emerald-700 flex items-center justify-between">
                                            <span>Annual Maintenance (AMC)</span>
                                            <span class="text-[9px] text-emerald-600 bg-emerald-100/70 px-1.5 py-0.2 rounded font-semibold">SLA</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Uptime monitoring, security patches & software enhancements.</p>
                                    </a>
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-emerald-50/70 border border-transparent hover:border-emerald-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-emerald-700 flex items-center justify-between">
                                            <span>Payment Gateway Integrations</span>
                                            <span class="text-[9px] text-emerald-600 bg-emerald-100/70 px-1.5 py-0.2 rounded font-semibold">Fintech</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Razorpay, Cashfree, UPI auto-reconciliation & payout webhooks.</p>
                                    </a>
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-emerald-50/70 border border-transparent hover:border-emerald-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-emerald-700 flex items-center justify-between">
                                            <span>Cloud Infrastructure & AWS</span>
                                            <span class="text-[9px] text-emerald-600 bg-emerald-100/70 px-1.5 py-0.2 rounded font-semibold">DevOps</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Container setup, zero-downtime backup & SSL security.</p>
                                    </a>
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-emerald-50/70 border border-transparent hover:border-emerald-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-emerald-700 flex items-center justify-between">
                                            <span>24/7 Dedicated Support</span>
                                            <span class="text-[9px] text-emerald-600 bg-emerald-100/70 px-1.5 py-0.2 rounded font-semibold">Helpdesk</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Priority ticket escalation, WhatsApp hotline & account manager.</p>
                                    </a>
                                </div>
                            </div>

                            <!-- Col 4: Featured Consultation Card (Span 3) -->
                            <div class="lg:col-span-3">
                                <div class="h-full bg-gradient-to-br from-[#1E40AF] via-[#1D4ED8] to-[#1E3A8A] text-white rounded-xl p-4 flex flex-col justify-between shadow-sm border border-blue-400/30">
                                    <div>
                                        <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-white/15 text-cyan-200 text-[10px] font-extrabold uppercase tracking-wider mb-2 backdrop-blur-xs">
                                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-300 animate-ping"></span>
                                            <span>Free Tech Review</span>
                                        </div>
                                        <h4 class="text-sm font-extrabold text-white leading-snug">Need a Custom Software Solution?</h4>
                                        <p class="text-[11px] text-blue-100 font-medium mt-1.5 leading-relaxed">
                                            Talk to our lead tech team. Complete functional blueprint, tech roadmap & quote within 48 hours.
                                        </p>
                                        <div class="mt-2.5 space-y-1 text-[11px] text-blue-200 font-semibold">
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-cyan-300">✓</span>
                                                <span>100% Source Code Ownership</span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-cyan-300">✓</span>
                                                <span>Zero Vendor Lock-in</span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-cyan-300">✓</span>
                                                <span>Milestone-Based Billing</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-2.5 border-t border-white/15">
                                        <a href="#contact" class="w-full py-2 px-3 bg-white hover:bg-blue-50 text-[#1D4ED8] font-black text-xs rounded-lg text-center shadow-sm transition-all flex items-center justify-center gap-1.5 group/btn">
                                            <span>Request Free Consultation</span>
                                            <svg class="w-3.5 h-3.5 group-hover/btn:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- ============================================== -->
                    <!-- 3. BROAD DROPDOWN: PARTNER PROGRAM             -->
                    <!-- ============================================== -->
                    <div id="dropdown-partner" class="broad-dropdown-panel hidden opacity-0 -translate-y-2 pointer-events-none transition-all duration-200 bg-white rounded-2xl border border-slate-200/90 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.22)] p-5 sm:p-6 max-h-[calc(100vh-135px)] overflow-y-auto">
                        <!-- Panel Header Bar -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3.5 border-b border-slate-100 gap-3">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-800 border border-amber-200/80">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    <span>₹0 Upfront Investment</span>
                                </span>
                                <div>
                                    <h3 class="text-sm sm:text-base font-extrabold text-slate-900">Sumatra Partner Program (EP & GP)</h3>
                                    <p class="text-[11px] sm:text-xs text-slate-500 font-medium">Join 500+ active Executive Partners (EP) and Ground Partners (GP) earning monthly recurring commissions.</p>
                                </div>
                            </div>
                            <a href="#partner-program" class="text-xs font-bold text-amber-700 hover:text-amber-900 flex items-center gap-1 shrink-0 self-start sm:self-auto group/toplink">
                                <span>See 5-Step Workflow</span>
                                <svg class="w-3.5 h-3.5 group-hover/toplink:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                            </a>
                        </div>

                        <!-- 4 Columns Grid: Partner Roles (3), Why Join Us (3), Support & Training (3), Join CTA (3) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-5 mt-4">

                            <!-- Col 1: Partner Roles (Span 3) -->
                            <div class="lg:col-span-3 space-y-2.5">
                                <div class="flex items-center gap-2 pb-1 border-b border-slate-100">
                                    <div class="w-5 h-5 rounded-md bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs">P</div>
                                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-800">Partner Models</h4>
                                </div>
                                <div class="space-y-2.5">
                                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200/90 hover:border-blue-300 transition">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-xs font-extrabold text-slate-900">Executive Partner (EP)</span>
                                            <span class="text-[9px] font-bold text-blue-700 bg-blue-100/70 px-1.5 py-0.2 rounded">Direct Sales</span>
                                        </div>
                                        <p class="text-[11px] text-slate-600 leading-snug">Market ready software directly to local clinics, schools, and merchants. Earn high commission per sale.</p>
                                        <div class="mt-1.5 text-[11px] font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                            <a href="{{ route('partner.register') }}">Join as Executive Partner &rarr;</a>
                                        </div>
                                    </div>

                                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200/90 hover:border-amber-300 transition">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-xs font-extrabold text-slate-900">Ground Partner (GP)</span>
                                            <span class="text-[9px] font-bold text-amber-800 bg-amber-100/70 px-1.5 py-0.2 rounded">Territory Lead</span>
                                        </div>
                                        <p class="text-[11px] text-slate-600 leading-snug">Lead city expansion. Recruit and mentor a team of EPs while earning royalties on regional deployments.</p>
                                        <div class="mt-1.5 text-[11px] font-bold text-amber-700 hover:text-amber-900 flex items-center gap-1">
                                            <a href="{{ route('partner.register') }}">Apply for Ground Partner &rarr;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Col 2: Why Partner with Us (Span 3) -->
                            <div class="lg:col-span-3 space-y-2.5">
                                <div class="flex items-center gap-2 pb-1 border-b border-slate-100">
                                    <div class="w-5 h-5 rounded-md bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs">★</div>
                                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-800">The Sumatra Advantage</h4>
                                </div>
                                <div class="space-y-1.5">
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">₹0 Upfront Investment</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">No franchise fee, registration charges, or deposit.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Transparent Payout Ledger</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Direct automated bank account settlements weekly & monthly.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Zero Tech Skills Needed</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">All cloud servers, hosting & tech support handled by us.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Monthly Recurring Income</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Earn software subscription renewals year after year.</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Col 3: Partner Training & Enablement (Span 3) -->
                            <div class="lg:col-span-3 space-y-2.5">
                                <div class="flex items-center gap-2 pb-1 border-b border-slate-100">
                                    <div class="w-5 h-5 rounded-md bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">🎓</div>
                                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-800">Training & Support</h4>
                                </div>
                                <div class="space-y-1.5">
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Sumatra Partner Academy</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Video masterclasses, pitch tutorials & sales scripts.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Ready Marketing Catalogs</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">High-quality PDF decks & WhatsApp flyers for clients.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Dedicated Relationship Mgr</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Real-time coaching and deal-closing assistance.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Incentives & Rewards</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Monthly milestone rewards, gadgets & recognition.</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Col 4: Onboard CTA Card (Span 3) -->
                            <div class="lg:col-span-3">
                                <div class="h-full bg-gradient-to-br from-[#0F172A] via-[#1E293B] to-[#0F172A] text-white rounded-xl p-4 flex flex-col justify-between shadow-sm border border-slate-700/80">
                                    <div>
                                        <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-[#FABE28]/20 text-[#FABE28] border border-[#FABE28]/30 text-[10px] font-black uppercase tracking-wider mb-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#FABE28] animate-pulse"></span>
                                            <span>Open Pan-India</span>
                                        </div>
                                        <h4 class="text-sm font-black text-white leading-snug">Launch Your Software Venture</h4>
                                        <p class="text-[11px] text-slate-300 font-medium mt-1.5 leading-relaxed">
                                            Turn your local network into a high-earning digital business. Start in as little as 24 hours.
                                        </p>
                                        <div class="mt-3 p-2 rounded-lg bg-white/5 border border-white/10 text-[11px] space-y-0.5 text-slate-200">
                                            <div class="flex items-center justify-between">
                                                <span class="text-slate-400">Coverage:</span>
                                                <span class="font-bold text-amber-300">100+ Cities</span>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <span class="text-slate-400">Investment:</span>
                                                <span class="font-bold text-emerald-400">₹0 (Zero Fee)</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-2.5 border-t border-slate-700/80 space-y-1.5">
                                        <a href="{{ route('partner.register') }}" class="w-full py-2 px-3 bg-[#FABE28] hover:bg-[#E5AC20] text-slate-950 font-black text-xs rounded-lg text-center shadow-sm transition-all flex items-center justify-center gap-1.5">
                                            <span>Register Free as Partner</span>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                                        </a>
                                        <a href="{{ route('login') }}" class="w-full py-1 text-center text-[11px] text-slate-400 hover:text-white transition block">
                                            Existing Partner? Sign In &rarr;
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- ============================================== -->
                    <!-- 4. BROAD DROPDOWN: INVESTOR & TRUST            -->
                    <!-- ============================================== -->
                    <div id="dropdown-investor" class="broad-dropdown-panel hidden opacity-0 -translate-y-2 pointer-events-none transition-all duration-200 bg-white rounded-2xl border border-slate-200/90 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.22)] p-5 sm:p-6 max-h-[calc(100vh-135px)] overflow-y-auto">
                        <!-- Panel Header Bar -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3.5 border-b border-slate-100 gap-3">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200/80">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 animate-pulse"></span>
                                    <span>Corporate Governance</span>
                                </span>
                                <div>
                                    <h3 class="text-sm sm:text-base font-extrabold text-slate-900">Investor Relations & Corporate Trust</h3>
                                    <p class="text-[11px] sm:text-xs text-slate-500 font-medium">Public statutory compliance, certified corporate entity, and ISO 9001:2015 engineering standards.</p>
                                </div>
                            </div>
                            <a href="#investor-trust" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1 shrink-0 self-start sm:self-auto group/toplink">
                                <span>View Investor Section</span>
                                <svg class="w-3.5 h-3.5 group-hover/toplink:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                            </a>
                        </div>

                        <!-- 4 Columns Grid: Entity & Governance (3), Economics & Growth (3), Legal & Compliance (3), Trust Factsheet (3) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-5 mt-4">

                            <!-- Col 1: Entity & Governance (Span 3) -->
                            <div class="lg:col-span-3 space-y-2.5">
                                <div class="flex items-center gap-2 pb-1 border-b border-slate-100">
                                    <div class="w-5 h-5 rounded-md bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">🏛</div>
                                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-800">Corporate Entity</h4>
                                </div>
                                <div class="space-y-1.5">
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Sumatra Sales Private Limited</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Registered under Companies Act 2013, MCA, Govt. of India.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">ISO 9001:2015 Certified</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">International Quality Management Systems for software delivery.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Board of Directors & Leadership</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Ethical stewardship for digital empowerment across India.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Vision 2030 Initiative</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Empowering 100,000+ businesses across 500+ Indian districts.</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Col 2: Business Economics (Span 3) -->
                            <div class="lg:col-span-3 space-y-2.5">
                                <div class="flex items-center gap-2 pb-1 border-b border-slate-100">
                                    <div class="w-5 h-5 rounded-md bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs">📈</div>
                                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-800">Economics & Model</h4>
                                </div>
                                <div class="space-y-1.5">
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Hybrid Recurring Revenue</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Software subscriptions (SaaS) + enterprise IT contracts.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Proprietary Technology IP</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">100% in-house developed source code equity. Zero 3rd party licensing.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Financial Transparency</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Audited balance sheets, statutory filings & accounts transparency.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Tier-2 / Tier-3 Distribution Moat</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Rapidly scaling across regional commercial and trading hubs.</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Col 3: Legal & Ethics Framework (Span 3) -->
                            <div class="lg:col-span-3 space-y-2.5">
                                <div class="flex items-center gap-2 pb-1 border-b border-slate-100">
                                    <div class="w-5 h-5 rounded-md bg-cyan-100 text-cyan-700 flex items-center justify-center font-bold text-xs">⚖</div>
                                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-800">Legal & Privacy</h4>
                                </div>
                                <div class="space-y-1.5">
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">DPDP Act & Data Privacy</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Strict adherence to Indian Digital Personal Data Protection laws.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Partner Charter & Ethics Code</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Legally binding partner payout guarantees & commercial ethics.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">Grievance Redressal Cell</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Dedicated fast-track committee for resolving stakeholder queries.</span>
                                    </div>
                                    <div class="p-2 rounded-lg border border-slate-100 hover:bg-slate-50 transition">
                                        <span class="text-xs font-bold text-slate-800 block">256-Bit SSL Data Encryption</span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block leading-tight">Bank-grade data transfer protection & isolated cloud databases.</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Col 4: Factsheet Summary Card (Span 3) -->
                            <div class="lg:col-span-3">
                                <div class="h-full bg-gradient-to-br from-[#173FAD] via-[#1E40AF] to-[#0B2165] text-white rounded-xl p-4 flex flex-col justify-between shadow-sm border border-blue-400/30">
                                    <div>
                                        <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-white/15 text-cyan-200 border border-white/20 text-[10px] font-extrabold uppercase tracking-wider mb-2 backdrop-blur-xs">
                                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-300 animate-pulse"></span>
                                            <span>Institutional Trust</span>
                                        </div>
                                        <h4 class="text-sm font-black text-white leading-snug">Public Governance & Operational Trust</h4>
                                        <p class="text-[11px] text-blue-100 font-medium mt-1.5 leading-relaxed">
                                            Total operational accountability, verified statutory corporate filings, and long-term socio-economic value creation.
                                        </p>
                                        <div class="mt-3 space-y-1 text-[11px] text-blue-100">
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-cyan-300">✓</span>
                                                <span>Govt. of India Registered (MCA)</span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-cyan-300">✓</span>
                                                <span>ISO 9001:2015 Quality Certified</span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-cyan-300">✓</span>
                                                <span>100% Risk-Free Architecture</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-2.5 border-t border-white/15">
                                        <a href="#investor-trust" class="w-full py-2 px-3 bg-white hover:bg-blue-50 text-[#173FAD] font-black text-xs rounded-lg text-center shadow-sm transition-all flex items-center justify-center gap-1.5">
                                            <span>Explore Investor Hub</span>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- ============================================== -->
                    <!-- 5. BROAD DROPDOWN: RESOURCES                   -->
                    <!-- ============================================== -->
                    <div id="dropdown-resources" class="broad-dropdown-panel hidden opacity-0 -translate-y-2 pointer-events-none transition-all duration-200 bg-white rounded-2xl border border-slate-200/90 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.22)] p-5 sm:p-6 max-h-[calc(100vh-135px)] overflow-y-auto">
                        <!-- Panel Header Bar -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3.5 border-b border-slate-100 gap-3">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-cyan-50 text-cyan-700 border border-cyan-200/80">
                                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-600 animate-pulse"></span>
                                    <span>Knowledge & Support</span>
                                </span>
                                <div>
                                    <h3 class="text-sm sm:text-base font-extrabold text-slate-900">Resources, Toolkits & Knowledge Base</h3>
                                    <p class="text-[11px] sm:text-xs text-slate-500 font-medium">Explore live interactive demos, user manuals, partner pitch kits, and support documentation.</p>
                                </div>
                            </div>
                            <a href="mailto:partner@sumatrasales.com" class="text-xs font-bold text-cyan-700 hover:text-cyan-900 flex items-center gap-1 shrink-0 self-start sm:self-auto group/toplink">
                                <span>Contact Support Desk</span>
                                <svg class="w-3.5 h-3.5 group-hover/toplink:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                            </a>
                        </div>

                        <!-- 4 Columns Grid: Demos & Learning (3), Docs & Guides (3), Partner Collaterals (3), Support Desk Card (3) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-5 mt-4">

                            <!-- Col 1: Demos & Learning (Span 3) -->
                            <div class="lg:col-span-3 space-y-2.5">
                                <div class="flex items-center gap-2 pb-1 border-b border-slate-100">
                                    <div class="w-5 h-5 rounded-md bg-cyan-100 text-cyan-700 flex items-center justify-center font-bold text-xs">▶</div>
                                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-800">Demos & Media</h4>
                                </div>
                                <div class="space-y-1.5">
                                    <a href="#platforms" class="group block p-2 rounded-lg hover:bg-cyan-50/70 border border-transparent hover:border-cyan-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-cyan-700 flex items-center justify-between">
                                            <span>Interactive Product Demos</span>
                                            <span class="text-[9px] text-cyan-700 bg-cyan-100/70 px-1.5 py-0.2 rounded font-semibold">Live</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Explore Doctorwala, Schoolwala & ProjectAttendance with demo data.</p>
                                    </a>
                                    <a href="#about" class="group block p-2 rounded-lg hover:bg-cyan-50/70 border border-transparent hover:border-cyan-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-cyan-700 flex items-center justify-between">
                                            <span>Video Walkthroughs</span>
                                            <span class="text-[9px] text-cyan-700 bg-cyan-100/70 px-1.5 py-0.2 rounded font-semibold">Video</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">3-minute feature overviews explaining daily user operations.</p>
                                    </a>
                                    <a href="#contact" class="group block p-2 rounded-lg hover:bg-cyan-50/70 border border-transparent hover:border-cyan-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-cyan-700 flex items-center justify-between">
                                            <span>Customer Case Studies</span>
                                            <span class="text-[9px] text-cyan-700 bg-cyan-100/70 px-1.5 py-0.2 rounded font-semibold">Stories</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Real results from clinics, retail shops, and institutions.</p>
                                    </a>
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-cyan-50/70 border border-transparent hover:border-cyan-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-cyan-700 flex items-center justify-between">
                                            <span>Platform Comparison Sheets</span>
                                            <span class="text-[9px] text-cyan-700 bg-cyan-100/70 px-1.5 py-0.2 rounded font-semibold">PDF</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Feature breakdown comparing our software against legacy tools.</p>
                                    </a>
                                </div>
                            </div>

                            <!-- Col 2: Docs & Guides (Span 3) -->
                            <div class="lg:col-span-3 space-y-2.5">
                                <div class="flex items-center gap-2 pb-1 border-b border-slate-100">
                                    <div class="w-5 h-5 rounded-md bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs">📖</div>
                                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-800">Docs & Guides</h4>
                                </div>
                                <div class="space-y-1.5">
                                    <a href="#partner-program" class="group block p-2 rounded-lg hover:bg-blue-50/70 border border-transparent hover:border-blue-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-blue-700 flex items-center justify-between">
                                            <span>Frequently Asked Questions</span>
                                            <span class="text-[9px] text-blue-700 bg-blue-100/70 px-1.5 py-0.2 rounded font-semibold">FAQs</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Answers to questions regarding partner earnings and setup.</p>
                                    </a>
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-blue-50/70 border border-transparent hover:border-blue-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-blue-700 flex items-center justify-between">
                                            <span>Quick-Start User Manuals</span>
                                            <span class="text-[9px] text-blue-700 bg-blue-100/70 px-1.5 py-0.2 rounded font-semibold">Manuals</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Clear instructions for client onboarding, staff login, and setup.</p>
                                    </a>
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-blue-50/70 border border-transparent hover:border-blue-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-blue-700 flex items-center justify-between">
                                            <span>Developer REST API Docs</span>
                                            <span class="text-[9px] text-blue-700 bg-blue-100/70 px-1.5 py-0.2 rounded font-semibold">API</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">API documentation, webhooks, and third-party integration specs.</p>
                                    </a>
                                    <a href="#solutions" class="group block p-2 rounded-lg hover:bg-blue-50/70 border border-transparent hover:border-blue-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-blue-700 flex items-center justify-between">
                                            <span>System Updates & Changelog</span>
                                            <span class="text-[9px] text-blue-700 bg-blue-100/70 px-1.5 py-0.2 rounded font-semibold">v2.4</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Latest release notes, security updates, and performance patches.</p>
                                    </a>
                                </div>
                            </div>

                            <!-- Col 3: Partner Collaterals (Span 3) -->
                            <div class="lg:col-span-3 space-y-2.5">
                                <div class="flex items-center gap-2 pb-1 border-b border-slate-100">
                                    <div class="w-5 h-5 rounded-md bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-xs">📁</div>
                                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-800">Partner Toolkit</h4>
                                </div>
                                <div class="space-y-1.5">
                                    <a href="{{ route('partner.register') }}" class="group block p-2 rounded-lg hover:bg-amber-50/70 border border-transparent hover:border-amber-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-amber-800 flex items-center justify-between">
                                            <span>Sales Pitch Decks</span>
                                            <span class="text-[9px] text-amber-800 bg-amber-100/70 px-1.5 py-0.2 rounded font-semibold">PPT/PDF</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Professional presentation decks ready for client meetings.</p>
                                    </a>
                                    <a href="{{ route('partner.register') }}" class="group block p-2 rounded-lg hover:bg-amber-50/70 border border-transparent hover:border-amber-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-amber-800 flex items-center justify-between">
                                            <span>Printable Brochures & Flyers</span>
                                            <span class="text-[9px] text-amber-800 bg-amber-100/70 px-1.5 py-0.2 rounded font-semibold">Print</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">High-resolution flyers customized with partner contact details.</p>
                                    </a>
                                    <a href="{{ route('partner.register') }}" class="group block p-2 rounded-lg hover:bg-amber-50/70 border border-transparent hover:border-amber-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-amber-800 flex items-center justify-between">
                                            <span>Commission Rate Card</span>
                                            <span class="text-[9px] text-amber-800 bg-amber-100/70 px-1.5 py-0.2 rounded font-semibold">Ledger</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Official commission schedule for Executive & Ground Partners.</p>
                                    </a>
                                    <a href="{{ route('partner.register') }}" class="group block p-2 rounded-lg hover:bg-amber-50/70 border border-transparent hover:border-amber-200/60 transition">
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-amber-800 flex items-center justify-between">
                                            <span>Standard Client Agreements</span>
                                            <span class="text-[9px] text-amber-800 bg-amber-100/70 px-1.5 py-0.2 rounded font-semibold">Legal</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Official contract templates, service level agreements & receipts.</p>
                                    </a>
                                </div>
                            </div>

                            <!-- Col 4: Support Desk Card (Span 3) -->
                            <div class="lg:col-span-3">
                                <div class="h-full bg-slate-50 border border-slate-200 rounded-xl p-4 flex flex-col justify-between shadow-xs">
                                    <div>
                                        <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase tracking-wider mb-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            <span>Dedicated Help Desk</span>
                                        </div>
                                        <h4 class="text-sm font-extrabold text-slate-900 leading-snug">Need Guidance or Support?</h4>
                                        <p class="text-[11px] text-slate-600 font-medium mt-1 leading-relaxed">
                                            Our technical support and partner relationship desk is available Monday to Saturday (9:30 AM to 7:00 PM IST).
                                        </p>
                                        <div class="mt-3 p-2.5 rounded-lg bg-white border border-slate-200/80 text-xs space-y-1">
                                            <div class="flex items-center gap-2 text-slate-700">
                                                <svg class="w-3.5 h-3.5 text-blue-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                                                <span class="font-bold text-[11px] truncate">partner@sumatrasales.com</span>
                                            </div>
                                            <div class="flex items-center gap-2 text-slate-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                                <span class="text-[10px] text-slate-500">Avg. Response Time: &lt; 2 Hours</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-2.5 border-t border-slate-200">
                                        <a href="mailto:partner@sumatrasales.com" class="w-full py-2 px-3 bg-blue-600 hover:bg-blue-700 text-white font-black text-xs rounded-lg text-center shadow-sm transition-all flex items-center justify-center gap-1.5">
                                            <span>Send Support Inquiry</span>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div></div>

            </div>
        </div>

        <!-- ======================================================== -->
        <!-- MOBILE NAVIGATION DRAWER & BACKDROP (Only on < lg screens)-->
        <!-- ======================================================== -->
        <!-- Backdrop Overlay -->
        <div id="mobile-menu-backdrop" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-50 hidden opacity-0 transition-opacity duration-300 lg:hidden" aria-hidden="true"></div>

        <!-- Off-Canvas Drawer -->
        <div id="mobile-menu-drawer" class="fixed inset-y-0 right-0 w-full max-w-[340px] xs:max-w-[380px] bg-white shadow-2xl z-50 translate-x-full transition-transform duration-300 ease-in-out flex flex-col justify-between overflow-hidden lg:hidden" role="dialog" aria-modal="true" aria-label="Mobile Navigation Menu">
            
            <!-- 1. Drawer Header -->
            <div class="px-4 py-3.5 border-b border-slate-200/90 flex items-center justify-between bg-slate-50/80 shrink-0">
                <a href="{{ route('home') }}" class="mobile-nav-link flex items-center gap-2 group">
                    <img src="/logo.png" alt="Sumatra Sales" class="h-8 w-auto object-contain">
                    <div class="flex flex-col">
                        <span class="text-xs font-black text-slate-900 leading-none">SumatraSales™</span>
                        <span class="text-[9px] font-bold text-slate-500 mt-0.5">Private Limited</span>
                    </div>
                </a>
                <button type="button" id="mobile-menu-close" aria-label="Close navigation menu" class="p-1.5 rounded-lg text-slate-500 hover:text-slate-800 hover:bg-slate-200/70 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <!-- 2. Drawer Body (Scrollable with Smooth Accordions) -->
            <div class="flex-1 overflow-y-auto px-4 py-3.5 space-y-3.5">
                
                <!-- Quick Auth & Action Buttons -->
                <div class="grid grid-cols-2 gap-2 pb-2 border-b border-slate-100">
                    @auth
                        <a href="{{ route('dashboard') }}" class="mobile-nav-link py-2 px-3 text-center text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="mobile-nav-link py-2 px-3 text-center text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition">
                            Login
                        </a>
                    @endauth
                    <a href="{{ route('partner.register') }}" class="mobile-nav-link py-2 px-3 text-center text-xs font-bold text-white bg-[#1D64F2] hover:bg-[#1853CA] rounded-lg transition shadow-xs">
                        Join Free
                    </a>
                </div>

                <!-- Navigation Accordion List -->
                <nav class="space-y-1.5 text-xs font-semibold text-slate-700">
                    
                    <!-- Direct Link: Home -->
                    <a href="{{ route('home') }}" class="mobile-nav-link flex items-center justify-between px-3 py-2 rounded-lg text-blue-600 bg-blue-50/80 font-bold transition">
                        <span>Home</span>
                        <span class="text-[10px] text-blue-500 font-normal">Overview</span>
                    </a>

                    <!-- Direct Link: About Us -->
                    <a href="#about" class="mobile-nav-link flex items-center justify-between px-3 py-2 rounded-lg text-slate-700 hover:bg-slate-100 transition">
                        <span>About Sumatra Sales</span>
                        <span class="text-[10px] text-slate-400 font-normal">Mission</span>
                    </a>

                    <!-- Accordion 1: Our Platforms -->
                    <div class="border border-slate-200/80 rounded-xl overflow-hidden bg-slate-50/30">
                        <button type="button" class="mobile-accordion-trigger w-full flex items-center justify-between px-3.5 py-2.5 text-slate-900 font-bold text-xs text-left transition hover:bg-slate-100/70">
                            <span class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-cyan-500"></span>
                                <span>Our Platforms (4)</span>
                            </span>
                            <svg class="mobile-chevron w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                        </button>
                        <div class="mobile-accordion-panel hidden px-3 pb-3 pt-1 space-y-2 border-t border-slate-100 bg-white">
                            <!-- DOCTORwala -->
                            <div class="p-2.5 rounded-lg border border-cyan-100 bg-cyan-50/30 space-y-1.5">
                                <div class="flex items-center justify-between">
                                    <a href="#doctorwala" class="mobile-nav-link font-black text-slate-900 text-xs hover:text-cyan-700 flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-500"></span>
                                        <span>DOCTORwala</span>
                                    </a>
                                    <span class="text-[9px] font-bold text-cyan-800 bg-cyan-100 px-1.5 py-0.2 rounded">Healthcare</span>
                                </div>
                                <p class="text-[10px] text-slate-500">24/7 OPD, Verified Doctor Booking, Diagnostics & Records.</p>
                                <div class="flex flex-wrap gap-1.5 pt-1">
                                    <a href="https://www.doctorwala.info/" target="_blank" rel="noopener noreferrer" class="text-[10px] font-bold text-cyan-700 hover:underline">Website ↗</a>
                                    <span class="text-slate-300">•</span>
                                    <a href="https://play.google.com/store/apps/details?id=com.doctorwala.dochealth&pcampaignid=web_share" target="_blank" rel="noopener noreferrer" class="text-[10px] font-bold text-slate-700 hover:underline">Patient App ↗</a>
                                    <span class="text-slate-300">•</span>
                                    <a href="https://play.google.com/store/apps/details?id=info.doctorwala.partner&pcampaignid=web_share" target="_blank" rel="noopener noreferrer" class="text-[10px] font-bold text-slate-700 hover:underline">Partner App ↗</a>
                                </div>
                            </div>
                            <!-- Schoolwala -->
                            <div class="p-2.5 rounded-lg border border-amber-100 bg-amber-50/30 space-y-1.5">
                                <div class="flex items-center justify-between">
                                    <a href="#schoolwala" class="mobile-nav-link font-black text-slate-900 text-xs hover:text-amber-800 flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span>Schoolwala</span>
                                    </a>
                                    <span class="text-[9px] font-bold text-amber-800 bg-amber-100 px-1.5 py-0.2 rounded">WBBSE EdTech</span>
                                </div>
                                <p class="text-[10px] text-slate-500">Bengali Medium Class 8-10 Syllabus, Video Classes & Mock Tests.</p>
                                <div class="flex flex-wrap gap-1.5 pt-1">
                                    <a href="https://schoolwala.info/" target="_blank" rel="noopener noreferrer" class="text-[10px] font-bold text-amber-700 hover:underline">Website ↗</a>
                                    <span class="text-slate-300">•</span>
                                    <a href="https://play.google.com/store/apps/details?id=com.schoolwala.schoolwalaapp" target="_blank" rel="noopener noreferrer" class="text-[10px] font-bold text-slate-700 hover:underline">Android App ↗</a>
                                </div>
                            </div>
                            <!-- Rani Matrimonial -->
                            <div class="p-2.5 rounded-lg border border-rose-100 bg-rose-50/30 space-y-1.5">
                                <div class="flex items-center justify-between">
                                    <a href="#ranimatrimonial" class="mobile-nav-link font-black text-slate-900 text-xs hover:text-rose-700 flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        <span>Rani Matrimonial</span>
                                    </a>
                                    <span class="text-[9px] font-bold text-rose-800 bg-rose-100 px-1.5 py-0.2 rounded">Matchmaking</span>
                                </div>
                                <p class="text-[10px] text-slate-500">Safe, Verified Biodatas with AI Matchmaking & Family Privacy.</p>
                                <div class="flex flex-wrap gap-1.5 pt-1">
                                    <a href="https://ranimatrimonial.com/" target="_blank" rel="noopener noreferrer" class="text-[10px] font-bold text-rose-700 hover:underline">Website ↗</a>
                                    <span class="text-slate-300">•</span>
                                    <span class="text-[10px] font-semibold text-slate-500">App coming soon</span>
                                </div>
                            </div>
                            <!-- ProjectAttendance -->
                            <div class="p-2.5 rounded-lg border border-orange-100 bg-orange-50/30 space-y-1.5">
                                <div class="flex items-center justify-between">
                                    <a href="#projectattendance" class="mobile-nav-link font-black text-slate-900 text-xs hover:text-orange-700 flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                        <span>ProjectAttendance</span>
                                    </a>
                                    <span class="text-[9px] font-bold text-orange-800 bg-orange-100 px-1.5 py-0.2 rounded">HRMS / GPS</span>
                                </div>
                                <p class="text-[10px] text-slate-500">GPS Geofence Mobile Attendance, Route Tracking & Payroll.</p>
                                <div class="flex flex-wrap gap-1.5 pt-1">
                                    <a href="https://projectattendance.com/" target="_blank" rel="noopener noreferrer" class="text-[10px] font-bold text-orange-700 hover:underline">Website ↗</a>
                                    <span class="text-slate-300">•</span>
                                    <a href="https://play.google.com/store/apps/details?id=smart.geofence.attendance&pcampaignid=web_share" target="_blank" rel="noopener noreferrer" class="text-[10px] font-bold text-slate-700 hover:underline">Android App ↗</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion 2: Business Solutions -->
                    <div class="border border-slate-200/80 rounded-xl overflow-hidden bg-slate-50/30">
                        <button type="button" class="mobile-accordion-trigger w-full flex items-center justify-between px-3.5 py-2.5 text-slate-900 font-bold text-xs text-left transition hover:bg-slate-100/70">
                            <span class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                <span>Business Solutions</span>
                            </span>
                            <svg class="mobile-chevron w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                        </button>
                        <div class="mobile-accordion-panel hidden px-3 pb-3 pt-1 space-y-1.5 border-t border-slate-100 bg-white">
                            <a href="#solutions" class="mobile-nav-link block p-2 rounded hover:bg-slate-50 text-[11px] font-bold text-slate-800">
                                <span>Readymade Software (ERP & CRM)</span>
                                <span class="block text-[10px] text-slate-500 font-normal">Pre-configured turnkey business engines</span>
                            </a>
                            <a href="#solutions" class="mobile-nav-link block p-2 rounded hover:bg-slate-50 text-[11px] font-bold text-slate-800">
                                <span>Custom Software & Mobile App Dev</span>
                                <span class="block text-[10px] text-slate-500 font-normal">Tailored codebases for specific requirements</span>
                            </a>
                            <a href="#solutions" class="mobile-nav-link block p-2 rounded hover:bg-slate-50 text-[11px] font-bold text-slate-800">
                                <span>Retail POS, Billing & GST Invoicing</span>
                                <span class="block text-[10px] text-slate-500 font-normal">Barcode-ready checkout for retail outlets</span>
                            </a>
                            <a href="#solutions" class="mobile-nav-link block p-2 rounded hover:bg-slate-50 text-[11px] font-bold text-slate-800">
                                <span>Healthcare & Hospital Management Suite</span>
                                <span class="block text-[10px] text-slate-500 font-normal">Chamber scheduling, lab tests & pharmacy</span>
                            </a>
                        </div>
                    </div>

                    <!-- Accordion 3: Partner Program -->
                    <div class="border border-slate-200/80 rounded-xl overflow-hidden bg-slate-50/30">
                        <button type="button" class="mobile-accordion-trigger w-full flex items-center justify-between px-3.5 py-2.5 text-slate-900 font-bold text-xs text-left transition hover:bg-slate-100/70">
                            <span class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span>Partner Program (EP & GP)</span>
                            </span>
                            <svg class="mobile-chevron w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                        </button>
                        <div class="mobile-accordion-panel hidden px-3 pb-3 pt-1 space-y-1.5 border-t border-slate-100 bg-white">
                            <div class="p-2 rounded bg-emerald-50/60 border border-emerald-100 text-[11px]">
                                <span class="font-bold text-emerald-900 block">₹0 Investment Required</span>
                                <span class="text-[10px] text-emerald-700">No franchise fee, no security deposit, direct bank commissions.</span>
                            </div>
                            <a href="#partner-program" class="mobile-nav-link block p-2 rounded hover:bg-slate-50 text-[11px] font-bold text-slate-800">
                                <span>Ground Partner (GP) Model</span>
                                <span class="block text-[10px] text-slate-500 font-normal">Local market outreach & referrals</span>
                            </a>
                            <a href="#partner-program" class="mobile-nav-link block p-2 rounded hover:bg-slate-50 text-[11px] font-bold text-slate-800">
                                <span>Executive Partner (EP) Model</span>
                                <span class="block text-[10px] text-slate-500 font-normal">Territory leadership & business expansion</span>
                            </a>
                            <a href="#partner-program" class="mobile-nav-link block p-2 rounded hover:bg-slate-50 text-[11px] font-bold text-slate-800">
                                <span>5-Step Workflow Process</span>
                                <span class="block text-[10px] text-slate-500 font-normal">From referral to direct verified payout</span>
                            </a>
                        </div>
                    </div>

                    <!-- Accordion 4: Investor & Trust -->
                    <div class="border border-slate-200/80 rounded-xl overflow-hidden bg-slate-50/30">
                        <button type="button" class="mobile-accordion-trigger w-full flex items-center justify-between px-3.5 py-2.5 text-slate-900 font-bold text-xs text-left transition hover:bg-slate-100/70">
                            <span class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                <span>Investor & Trust</span>
                            </span>
                            <svg class="mobile-chevron w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                        </button>
                        <div class="mobile-accordion-panel hidden px-3 pb-3 pt-1 space-y-1.5 border-t border-slate-100 bg-white">
                            <a href="#investor-trust" class="mobile-nav-link block p-2 rounded hover:bg-slate-50 text-[11px] font-bold text-slate-800">
                                <span>Corporate Governance Charter</span>
                                <span class="block text-[10px] text-slate-500 font-normal">Ethical conduct & partner policies</span>
                            </a>
                            <a href="#investor-trust" class="mobile-nav-link block p-2 rounded hover:bg-slate-50 text-[11px] font-bold text-slate-800">
                                <span>Business Model & Financial Transparency</span>
                                <span class="block text-[10px] text-slate-500 font-normal">Public disclosure & operational metrics</span>
                            </a>
                        </div>
                    </div>

                    <!-- Accordion 5: Resources & Support -->
                    <div class="border border-slate-200/80 rounded-xl overflow-hidden bg-slate-50/30">
                        <button type="button" class="mobile-accordion-trigger w-full flex items-center justify-between px-3.5 py-2.5 text-slate-900 font-bold text-xs text-left transition hover:bg-slate-100/70">
                            <span class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-slate-500"></span>
                                <span>Resources & Support</span>
                            </span>
                            <svg class="mobile-chevron w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                        </button>
                        <div class="mobile-accordion-panel hidden px-3 pb-3 pt-1 space-y-1.5 border-t border-slate-100 bg-white">
                            <a href="#partner-program" class="mobile-nav-link block p-2 rounded hover:bg-slate-50 text-[11px] font-bold text-slate-800">
                                <span>Partner FAQs & Guides</span>
                            </a>
                            <a href="#contact" class="mobile-nav-link block p-2 rounded hover:bg-slate-50 text-[11px] font-bold text-slate-800">
                                <span>Partner Help Desk Helpline</span>
                            </a>
                        </div>
                    </div>

                    <!-- Direct Link: Contact -->
                    <a href="#contact" class="mobile-nav-link flex items-center justify-between px-3 py-2 rounded-lg text-slate-700 hover:bg-slate-100 transition">
                        <span>Contact & Head Office</span>
                        <span class="text-[10px] text-slate-400 font-normal">Help Desk</span>
                    </a>

                </nav>

            </div>

            <!-- 3. Drawer Footer -->
            <div class="p-3.5 border-t border-slate-200 bg-slate-50 text-[10px] text-slate-500 space-y-2 shrink-0">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-slate-700">Helpline:</span>
                    <a href="mailto:partner@sumatrasales.com" class="text-blue-600 font-bold hover:underline">partner@sumatrasales.com</a>
                </div>
                <div class="text-[9px] text-slate-400">
                    Mon-Sat (9:30 AM – 7:00 PM IST) • Zero Upfront Fees
                </div>
            </div>

        </div>
    </header>
