@if (session('submission_success') || session('success') || request()->has('preview_celebration'))
@php
    $isPreview = request()->has('preview_celebration');
    $successData = session('submission_success', []);
    $partnerId   = $successData['partner_id'] ?? null;
    $appCode     = $successData['application_code'] ?? '';

    // Retrieve full partner record if available
    $partner = null;
    if (!empty($partnerId)) {
        $partner = \App\Models\Partner::find($partnerId);
    }
    if (!$partner && !empty($appCode)) {
        $partner = \App\Models\Partner::where('application_code', $appCode)->first();
    }

    $regRole    = $partner->registration_type ?? ($successData['role'] ?? ($isPreview ? (request('role', 'EP')) : 'EP'));
    $regEmail   = $partner->email ?? ($successData['email'] ?? ($isPreview ? 'samkaran@gmail.com' : ''));
    $regName    = $partner->name ?? ($successData['name'] ?? ($isPreview ? 'Sam karan' : ''));
    $regPhone   = $partner->phone ?? ($successData['phone'] ?? ($isPreview ? '0269269269055' : ''));
    $appCode    = $partner->application_code ?? ($appCode ?: ($isPreview ? 'SSPL-2026-EP-2GEPYN' : ''));

    $fullAddress = '';
    if ($partner) {
        $fullAddress = trim(implode(', ', array_filter([$partner->address, $partner->city, $partner->district, $partner->state])));
    }
    if (empty($fullAddress) && !empty($successData['address'])) {
        $fullAddress = $successData['address'];
    }
    if (empty($fullAddress) && $isPreview) {
        $fullAddress = 'Howrah, Ranihati, Panchla - 711302, ahemdabad, zfgnfjh, Gujarat';
    }

    $submittedDate = $partner ? $partner->created_at->format('d M Y, h:i A') : now('Asia/Kolkata')->format('d M Y, h:i A');

    // Base64 logo for bulletproof html2canvas capture without CORS / asset loading delays
    $logoPath = public_path('logo.png');
    $logoBase64 = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : asset('logo.png');
@endphp

<!-- ================================================================= -->
<!-- OFFICIAL APPLICATION CELEBRATION MODAL & DOWNLOADABLE PASS TICKET -->
<!-- ================================================================= -->
<div id="celebration-modal" class="fixed inset-0 z-[9999] flex items-center justify-center p-3 sm:p-5 md:p-6 bg-slate-950/85 backdrop-blur-xl overflow-y-auto animate-fade-in" role="dialog" aria-modal="true" data-backdrop="static">
    
    <!-- Ambient Festive Background Glows -->
    <div class="fixed top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="fixed bottom-1/4 left-1/2 -translate-x-1/2 translate-y-1/2 w-80 h-80 bg-amber-400/20 rounded-full blur-3xl pointer-events-none"></div>

    <div id="celebration-modal-card" class="relative w-full max-w-lg md:max-w-xl my-auto bg-white/95 backdrop-blur-2xl rounded-3xl sm:rounded-[2rem] shadow-2xl shadow-blue-950/40 border border-white/70 ring-1 ring-slate-900/5 overflow-hidden text-center p-4 sm:p-6 md:p-7 max-h-[94vh] flex flex-col justify-between transform scale-100 transition-all">
        
        <!-- Multi-Color Festive Top Accent Bar -->
        <div class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-[#2964F2] via-indigo-500 to-amber-400"></div>

        <!-- Scrollable Inner Content Area -->
        <div class="overflow-y-auto pr-0.5 space-y-3 sm:space-y-3.5">
            
            <!-- Glowing Boom Celebration Badge & Animated Rings -->
            <div class="relative mx-auto w-16 h-16 sm:w-20 sm:h-20 flex items-center justify-center shrink-0 mt-1">
                <div class="absolute inset-0 rounded-full bg-blue-500/20 animate-ping duration-1000"></div>
                <div class="absolute -inset-1.5 rounded-full bg-amber-400/25 animate-pulse"></div>
                <div class="relative w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-tr from-[#2964F2] via-blue-600 to-indigo-500 text-white flex items-center justify-center shadow-xl shadow-[#2964F2]/35 border border-white/40 transform -rotate-2 hover:rotate-0 transition">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white animate-bounce" fill="none" stroke="currentColor" stroke-width="2.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <div class="absolute -top-1 -right-1 w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-amber-400 text-amber-950 flex items-center justify-center text-xs font-black shadow-lg shadow-amber-400/40 border-2 border-white animate-pulse">
                    ✨
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- THE TICKET / COUPON APPLICATION PASS CARD (PNG DOWNLOAD TARGET) -->
            <!-- ============================================================== -->
            <div class="pt-0.5">
                <div id="application-ticket-card" class="relative bg-white text-slate-900 rounded-2xl sm:rounded-3xl border border-slate-200 shadow-xl overflow-hidden p-4 sm:p-5 text-left transition-all">
                    
                    <!-- FADED LOWER OPACITY SUMATRA SALES LOGO WATERMARK IN BACKGROUND -->
                    <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; pointer-events: none; user-select: none; z-index: 0; overflow: hidden;">
                        <img src="{{ $logoBase64 }}" alt="Sumatra Sales Watermark" style="width: 250px; max-width: 65%; opacity: 0.04; filter: grayscale(100%); pointer-events: none;">
                    </div>

                    <!-- Ambient Top Edge Decorative Stripe -->
                    <div class="absolute top-0 inset-x-0 h-1.5 {{ $regRole === 'GP' ? 'bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-600' : 'bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-500' }}"></div>

                    <!-- Relative Content Layer (Above Watermark) -->
                    <div class="relative z-10 space-y-3">
                        
                        <!-- Ticket Header: Company Logo & Prominent EP / GP Badge -->
                        <div class="flex items-center justify-between gap-3 border-b border-slate-100 pb-2.5">
                            <div class="flex items-center gap-2.5">
                                <img src="{{ $logoBase64 }}" alt="Sumatra Sales" class="h-8 sm:h-10 w-auto object-contain shrink-0">
                                <div>
                                    <h2 class="text-xs sm:text-sm font-black text-slate-900 tracking-tight uppercase leading-tight">
                                        Sumatra Sales Pvt Ltd
                                    </h2>
                                    <p class="text-[9px] sm:text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                                        Official Application Pass
                                    </p>
                                </div>
                            </div>

                            <!-- BIG, PROMINENT EP OR GP BADGE -->
                            <div class="shrink-0 text-right">
                                @if ($regRole === 'GP')
                                    <div class="inline-flex flex-col items-center justify-center px-3.5 py-1.5 sm:px-4 sm:py-2 bg-gradient-to-br from-emerald-600 via-teal-600 to-emerald-700 text-white rounded-xl sm:rounded-2xl shadow-md shadow-emerald-600/25 border-2 border-emerald-400/40">
                                        <span class="text-[8px] sm:text-[9px] font-black uppercase tracking-widest text-emerald-200 leading-none">ROLE</span>
                                        <span class="text-2xl sm:text-3xl font-black tracking-tight leading-none my-0.5">GP</span>
                                        <span class="text-[8px] sm:text-[9px] font-extrabold uppercase tracking-wider text-emerald-100 leading-none">Ground Partner</span>
                                    </div>
                                @else
                                    <div class="inline-flex flex-col items-center justify-center px-3.5 py-1.5 sm:px-4 sm:py-2 bg-gradient-to-br from-[#2964F2] via-blue-600 to-indigo-600 text-white rounded-xl sm:rounded-2xl shadow-md shadow-blue-600/25 border-2 border-blue-400/40">
                                        <span class="text-[8px] sm:text-[9px] font-black uppercase tracking-widest text-blue-200 leading-none">ROLE</span>
                                        <span class="text-2xl sm:text-3xl font-black tracking-tight leading-none my-0.5">EP</span>
                                        <span class="text-[8px] sm:text-[9px] font-extrabold uppercase tracking-wider text-blue-100 leading-none">Executive Partner</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- APPLICATION NUMBER SECTION (VERY BIG & PROMINENT) -->
                        <div class="p-3 sm:p-3.5 rounded-2xl bg-blue-50/70 border-2 border-dashed border-[#2964F2]/30 text-center">
                            <div class="flex items-center justify-between gap-2 mb-1 px-1">
                                <span class="text-[9px] sm:text-[10px] font-black uppercase text-[#2964F2] tracking-wider flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                                    Official Application Reference Code
                                </span>
                                <button type="button" id="copy-app-code-btn" data-code="{{ $appCode }}" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-lg bg-white hover:bg-blue-100 text-[#2964F2] text-[10px] font-black border border-blue-200 transition cursor-pointer shadow-2xs">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" /></svg>
                                    <span id="copy-code-text">Copy</span>
                                </button>
                            </div>
                            <div class="font-mono text-xl sm:text-2xl md:text-3xl font-black text-slate-900 tracking-wider select-all break-all py-0.5">
                                {{ $appCode }}
                            </div>
                            <span class="text-[9px] font-bold text-slate-500">Official tracking identifier for KYC & partner onboarding</span>
                        </div>

                        <!-- CLEAN TICKET COUPON DIVIDER -->
                        <div class="relative py-1">
                            <div class="w-full border-t border-dashed border-slate-300"></div>
                        </div>

                        <!-- APPLICANT DETAILS (NAME, MOBILE, EMAIL, ADDRESS) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-left">
                            
                            <!-- Full Name -->
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200/90 shadow-2xs">
                                <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1">
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                                    Applicant Name
                                </span>
                                <p class="text-xs sm:text-sm font-black text-slate-900 mt-0.5 truncate">
                                    {{ !empty($regName) ? $regName : 'N/A' }}
                                </p>
                            </div>

                            <!-- Mobile Number -->
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200/90 shadow-2xs">
                                <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1">
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                                    Mobile Number
                                </span>
                                <p class="text-xs sm:text-sm font-black text-slate-900 mt-0.5 truncate">
                                    {{ !empty($regPhone) ? $regPhone : 'N/A' }}
                                </p>
                            </div>

                            <!-- Email Address -->
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200/90 shadow-2xs sm:col-span-2">
                                <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1">
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                                    Email Address
                                </span>
                                <p class="text-xs sm:text-sm font-black text-slate-900 mt-0.5 break-all">
                                    {{ !empty($regEmail) ? $regEmail : 'N/A' }}
                                </p>
                            </div>

                            <!-- Address -->
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200/90 shadow-2xs sm:col-span-2">
                                <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1">
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>
                                    Registered Address
                                </span>
                                <p class="text-xs font-semibold text-slate-800 mt-0.5 leading-snug break-words">
                                    {{ !empty($fullAddress) ? $fullAddress : 'Address recorded in application profile' }}
                                </p>
                            </div>

                        </div>

                        <!-- Ticket Status & Metadata Footer -->
                        <div class="pt-1.5 border-t border-slate-100 flex flex-wrap items-center justify-between gap-2 text-[10px] text-slate-500">
                            <div class="flex items-center gap-1.5 font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-lg border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>KYC Status: Pending Verification</span>
                            </div>
                            <div class="font-medium text-slate-400">
                                Issued: {{ $submittedDate }}
                            </div>
                        </div>

                        <!-- BARCODE & TICKET SECURITY STRIP -->
                        <div class="pt-1.5 border-t border-slate-200/70 flex items-center justify-between gap-2">
                            <div class="flex-1">
                                <!-- Clean Vector Barcode Graphic -->
                                <svg class="h-6 w-full max-w-[190px] text-slate-800" viewBox="0 0 220 30" fill="currentColor">
                                    <rect x="0" y="0" width="3" height="30" />
                                    <rect x="5" y="0" width="1" height="30" />
                                    <rect x="8" y="0" width="4" height="30" />
                                    <rect x="15" y="0" width="2" height="30" />
                                    <rect x="20" y="0" width="1" height="30" />
                                    <rect x="24" y="0" width="3" height="30" />
                                    <rect x="30" y="0" width="5" height="30" />
                                    <rect x="38" y="0" width="2" height="30" />
                                    <rect x="43" y="0" width="1" height="30" />
                                    <rect x="47" y="0" width="4" height="30" />
                                    <rect x="54" y="0" width="2" height="30" />
                                    <rect x="59" y="0" width="3" height="30" />
                                    <rect x="65" y="0" width="1" height="30" />
                                    <rect x="69" y="0" width="4" height="30" />
                                    <rect x="76" y="0" width="2" height="30" />
                                    <rect x="81" y="0" width="5" height="30" />
                                    <rect x="89" y="0" width="1" height="30" />
                                    <rect x="93" y="0" width="3" height="30" />
                                    <rect x="99" y="0" width="2" height="30" />
                                    <rect x="104" y="0" width="4" height="30" />
                                    <rect x="111" y="0" width="1" height="30" />
                                    <rect x="115" y="0" width="3" height="30" />
                                    <rect x="121" y="0" width="5" height="30" />
                                    <rect x="129" y="0" width="2" height="30" />
                                    <rect x="134" y="0" width="1" height="30" />
                                    <rect x="138" y="0" width="4" height="30" />
                                    <rect x="145" y="0" width="3" height="30" />
                                    <rect x="151" y="0" width="1" height="30" />
                                    <rect x="155" y="0" width="4" height="30" />
                                    <rect x="162" y="0" width="2" height="30" />
                                    <rect x="167" y="0" width="5" height="30" />
                                    <rect x="175" y="0" width="1" height="30" />
                                    <rect x="179" y="0" width="4" height="30" />
                                    <rect x="186" y="0" width="2" height="30" />
                                    <rect x="191" y="0" width="3" height="30" />
                                    <rect x="197" y="0" width="1" height="30" />
                                    <rect x="201" y="0" width="4" height="30" />
                                    <rect x="208" y="0" width="2" height="30" />
                                    <rect x="213" y="0" width="3" height="30" />
                                </svg>
                                <span class="font-mono text-[9px] font-bold text-slate-400 tracking-widest block mt-0.5">
                                    * {{ $appCode }} *
                                </span>
                            </div>
                            <div class="text-right shrink-0">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 text-[9px] font-black uppercase tracking-wider border border-slate-200">
                                    ✓ Official Slip
                                </span>
                                <span class="block text-[8px] text-slate-400 mt-0.5 font-medium">Sumatra Sales Pvt Ltd</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- ACTION BUTTON: DOWNLOAD APPLICATION PASS (PNG) -->
            <!-- ============================================================== -->
            <div class="pt-1.5 space-y-1.5">
                <button type="button" id="download-pass-png-btn" class="w-full inline-flex items-center justify-center gap-2.5 px-5 py-3.5 bg-gradient-to-r from-[#2964F2] via-blue-600 to-indigo-600 hover:from-[#1E52D4] hover:to-indigo-700 active:scale-[0.99] text-white text-xs sm:text-sm font-black rounded-xl sm:rounded-2xl shadow-xl shadow-blue-600/30 hover:shadow-2xl hover:shadow-blue-600/40 transition transform hover:-translate-y-0.5 cursor-pointer">
                    <svg id="download-btn-icon" class="w-4 h-4 sm:w-5 sm:h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <span id="download-pass-btn-text">Download Application Pass (PNG)</span>
                </button>

                <p class="text-[11px] text-slate-500 leading-relaxed px-2 text-center">
                    Click above to save this official coupon pass directly to your device for status tracking and reference.
                </p>
            </div>

        </div>

        <!-- Sticky Bottom Dismiss / Continue Button -->
        <div class="pt-3 mt-2 border-t border-slate-100 shrink-0">
            <button type="button" id="dismiss-celebration-modal-btn" class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl sm:rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-900 text-xs sm:text-sm font-black transition cursor-pointer">
                <span>Continue to Homepage</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
            </button>
        </div>

    </div>
</div>

<!-- html2canvas Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('celebration-modal');
    if (!modal) return;

    // Lock body scroll
    document.body.classList.add('overflow-hidden');

    // Strictly non-closable by backdrop click or escape key
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            e.stopPropagation();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            e.preventDefault();
            e.stopPropagation();
        }
    }, true);

    // Copy Application Code Helper
    const copyBtn = document.getElementById('copy-app-code-btn');
    if (copyBtn) {
        copyBtn.addEventListener('click', function () {
            const code = this.getAttribute('data-code');
            if (navigator.clipboard && code) {
                navigator.clipboard.writeText(code).then(() => {
                    const textSpan = document.getElementById('copy-code-text');
                    if (textSpan) {
                        textSpan.textContent = 'Copied! ✓';
                        setTimeout(() => { textSpan.textContent = 'Copy'; }, 2000);
                    }
                });
            }
        });
    }

    // Dismiss only via the explicit "Continue" button
    document.getElementById('dismiss-celebration-modal-btn')?.addEventListener('click', function () {
        modal.classList.add('opacity-0', 'transition-opacity', 'duration-300');
        setTimeout(() => {
            modal.remove();
            document.body.classList.remove('overflow-hidden');
        }, 300);
    });

    // ==============================================================
    // PNG DOWNLOAD HANDLER (High-Resolution Ticket Slip Capture)
    // ==============================================================
    const downloadBtn = document.getElementById('download-pass-png-btn');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', async function () {
            const ticketCard = document.getElementById('application-ticket-card');
            if (!ticketCard) return;

            const btnText = document.getElementById('download-pass-btn-text');
            const originalText = btnText ? btnText.textContent : 'Download Application Pass (PNG)';
            
            try {
                // Set loading indicator
                if (btnText) btnText.textContent = 'Generating High-Res PNG...';
                downloadBtn.disabled = true;
                downloadBtn.classList.add('opacity-80', 'cursor-wait');

                // Ensure html2canvas is ready
                if (typeof html2canvas !== 'function') {
                    await new Promise((resolve, reject) => {
                        const script = document.createElement('script');
                        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js';
                        script.onload = resolve;
                        script.onerror = reject;
                        document.head.appendChild(script);
                    });
                }

                // Render high-res crisp canvas
                const canvas = await html2canvas(ticketCard, {
                    scale: 3, // Retina 3x crystal clarity
                    useCORS: true,
                    allowTaint: true,
                    backgroundColor: '#ffffff',
                    logging: false,
                    onclone: (clonedDoc) => {
                        const clonedCard = clonedDoc.getElementById('application-ticket-card');
                        if (clonedCard) {
                            clonedCard.style.boxShadow = 'none';
                            clonedCard.style.borderRadius = '20px';
                        }
                    }
                });

                // Create download link
                const imageUri = canvas.toDataURL('image/png');
                const safeCode = '{{ !empty($appCode) ? preg_replace("/[^A-Za-z0-9_-]/", "_", $appCode) : "Sumatra_Application" }}';
                const filename = `${safeCode}_Pass.png`;

                const link = document.createElement('a');
                link.download = filename;
                link.href = imageUri;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Success feedback
                if (btnText) btnText.textContent = 'Pass Downloaded! ✓';
                setTimeout(() => {
                    if (btnText) btnText.textContent = originalText;
                    downloadBtn.disabled = false;
                    downloadBtn.classList.remove('opacity-80', 'cursor-wait');
                }, 2200);

            } catch (err) {
                console.error('PNG generation error:', err);
                if (btnText) btnText.textContent = 'Download Failed. Try Again';
                setTimeout(() => {
                    if (btnText) btnText.textContent = originalText;
                    downloadBtn.disabled = false;
                    downloadBtn.classList.remove('opacity-80', 'cursor-wait');
                }, 2500);
            }
        });
    }

    // ==============================================================
    // Multi-cannon Festive Confetti Celebration
    // ==============================================================
    function fireMultiBoomConfetti() {
        if (typeof confetti !== 'function') return;

        confetti({
            particleCount: 100,
            spread: 70,
            origin: { y: 0.6 },
            colors: ['#2964F2', '#F59E0B', '#10B981', '#6366F1', '#EC4899']
        });

        setTimeout(() => {
            confetti({
                particleCount: 70,
                angle: 60,
                spread: 55,
                origin: { x: 0, y: 0.7 },
                colors: ['#2964F2', '#38BDF8', '#F59E0B']
            });
        }, 200);

        setTimeout(() => {
            confetti({
                particleCount: 70,
                angle: 120,
                spread: 55,
                origin: { x: 1, y: 0.7 },
                colors: ['#10B981', '#F59E0B', '#6366F1']
            });
        }, 400);
    }

    if (window.confetti) {
        fireMultiBoomConfetti();
    } else {
        const confScript = document.createElement('script');
        confScript.src = 'https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js';
        confScript.onload = fireMultiBoomConfetti;
        document.head.appendChild(confScript);
    }
});
</script>
@endif
