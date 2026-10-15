@if (session('submission_success') || request()->has('preview_celebration'))
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
    $regName    = $partner->name ?? ($successData['name'] ?? ($isPreview ? 'Samir De' : ''));
    $regPhone   = $partner->phone ?? ($successData['phone'] ?? ($isPreview ? '06290048805' : ''));
    $appCode    = $partner->application_code ?? ($appCode ?: ($isPreview ? 'SSPL-2026-GP-7BGDN6' : ''));

    $fullAddress = '';
    if ($partner) {
        $fullAddress = trim(implode(', ', array_filter([$partner->address, $partner->city, $partner->district, $partner->state])));
    }
    if (empty($fullAddress) && !empty($successData['address'])) {
        $fullAddress = $successData['address'];
    }
    if (empty($fullAddress) && $isPreview) {
        $fullAddress = 'OT Road, Bazarpara, Uluberia, Howrah, West Bengal - 711316';
    }

    $submittedDate = $partner ? $partner->created_at->format('d M Y, h:i A') : now('Asia/Kolkata')->format('d M Y, h:i A');

    // Base64 logo for clean display
    $logoPath = public_path('logo.png');
    $logoBase64 = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : asset('logo.png');
@endphp

<!-- ================================================================= -->
<!-- OFFICIAL APPLICATION CELEBRATION MODAL (COMPACT TICKET PASS) -->
<!-- ================================================================= -->
<div id="celebration-modal" class="fixed inset-0 z-[9999] flex items-center justify-center p-3 sm:p-4 bg-slate-950/85 backdrop-blur-xl animate-fade-in" role="dialog" aria-modal="true" data-backdrop="static">
    
    <!-- Ambient Festive Background Glows -->
    <div class="fixed top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="fixed bottom-1/4 left-1/2 -translate-x-1/2 translate-y-1/2 w-64 h-64 bg-amber-400/15 rounded-full blur-3xl pointer-events-none"></div>

    <div id="celebration-modal-card" class="relative w-full max-w-sm sm:max-w-md my-auto bg-white/95 backdrop-blur-2xl rounded-2xl sm:rounded-3xl shadow-2xl shadow-blue-950/40 border border-white/70 ring-1 ring-slate-900/5 overflow-hidden text-center p-3 sm:p-4 flex flex-col justify-between transform scale-100 transition-all">
        
        <!-- Multi-Color Festive Top Accent Bar -->
        <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-[#2964F2] via-indigo-500 to-amber-400"></div>

        <!-- Inner Content Area -->
        <div class="space-y-2 sm:space-y-2.5">
            
            <!-- Compact Celebration Icon -->
            <div class="relative mx-auto w-10 h-10 sm:w-11 sm:h-11 flex items-center justify-center shrink-0 mt-0.5">
                <div class="absolute inset-0 rounded-full bg-blue-500/20 animate-ping duration-1000"></div>
                <div class="relative w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-gradient-to-tr from-[#2964F2] via-blue-600 to-indigo-500 text-white flex items-center justify-center shadow-md shadow-[#2964F2]/30 border border-white/40">
                    <svg class="w-4 h-4 text-white animate-bounce" fill="none" stroke="currentColor" stroke-width="2.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <div class="absolute -top-1 -right-1 w-3.5 h-3.5 rounded-full bg-amber-400 text-amber-950 flex items-center justify-center text-[8px] font-black shadow border border-white animate-pulse">
                    ✨
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- THE COMPACT TICKET / PASS CARD -->
            <!-- ============================================================== -->
            <div>
                <div id="application-ticket-card" class="relative bg-white text-slate-900 rounded-xl sm:rounded-2xl border border-slate-200/90 shadow-md overflow-hidden p-3 sm:p-3.5 text-left transition-all">
                    
                    <!-- FADED LOWER OPACITY SUMATRA SALES LOGO WATERMARK IN BACKGROUND -->
                    <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; pointer-events: none; user-select: none; z-index: 0; overflow: hidden;">
                        <img src="{{ $logoBase64 }}" alt="Sumatra Sales Watermark" crossorigin="anonymous" style="width: 180px; max-width: 55%; opacity: 0.04; pointer-events: none;">
                    </div>

                    <!-- Ambient Top Edge Decorative Stripe -->
                    <div class="absolute top-0 inset-x-0 h-1 {{ $regRole === 'GP' ? 'bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-600' : 'bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-500' }}"></div>

                    <!-- Relative Content Layer (Above Watermark) -->
                    <div class="relative z-10 space-y-2">
                        
                        <!-- Ticket Header: Company Logo & Compact EP / GP Badge -->
                        <div class="flex items-center justify-between gap-2 border-b border-slate-100 pb-2">
                            <div class="flex items-center gap-2">
                                <img src="{{ $logoBase64 }}" alt="Sumatra Sales" crossorigin="anonymous" class="h-6 sm:h-7 w-auto object-contain shrink-0">
                                <div>
                                    <h2 class="text-xs font-black text-slate-900 tracking-tight uppercase leading-tight">
                                        Sumatra Sales Pvt Ltd
                                    </h2>
                                    <p class="text-[8px] font-bold text-slate-400 uppercase tracking-wider">
                                        Official Application Pass
                                    </p>
                                </div>
                            </div>

                            <!-- COMPACT EP OR GP BADGE -->
                            <div class="shrink-0 text-right">
                                @if ($regRole === 'GP')
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 bg-gradient-to-br from-emerald-600 via-teal-600 to-emerald-700 text-white rounded-lg shadow-xs border border-emerald-400/40">
                                        <span class="text-[7.5px] font-bold uppercase tracking-wider text-emerald-200">ROLE</span>
                                        <span class="text-sm sm:text-base font-black tracking-tight leading-none">GP</span>
                                        <span class="text-[7.5px] font-extrabold uppercase text-emerald-100 hidden sm:inline">Ground Partner</span>
                                    </div>
                                @else
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 bg-gradient-to-br from-[#2964F2] via-blue-600 to-indigo-600 text-white rounded-lg shadow-xs border border-blue-400/40">
                                        <span class="text-[7.5px] font-bold uppercase tracking-wider text-blue-200">ROLE</span>
                                        <span class="text-sm sm:text-base font-black tracking-tight leading-none">EP</span>
                                        <span class="text-[7.5px] font-extrabold uppercase text-blue-100 hidden sm:inline">Executive Partner</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- APPLICATION NUMBER SECTION -->
                        <div class="p-2 rounded-xl bg-blue-50/70 border border-dashed border-[#2964F2]/30 text-center">
                            <div class="flex items-center justify-between gap-1 mb-0.5 px-0.5">
                                <span class="text-[8px] sm:text-[8.5px] font-black uppercase text-[#2964F2] tracking-wider flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                                    Official Reference Code
                                </span>
                                <button type="button" id="copy-app-code-btn" data-code="{{ $appCode }}" class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-white hover:bg-blue-100 text-[#2964F2] text-[9px] font-black border border-blue-200 transition cursor-pointer shadow-2xs">
                                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" /></svg>
                                    <span id="copy-code-text">Copy</span>
                                </button>
                            </div>
                            <div class="font-mono text-base sm:text-lg md:text-xl font-black text-slate-900 tracking-wider select-all break-all leading-tight">
                                {{ $appCode }}
                            </div>
                        </div>

                        <!-- CLEAN TICKET COUPON DIVIDER -->
                        <div class="border-t border-dashed border-slate-200 my-1"></div>

                        <!-- APPLICANT DETAILS (COMPACT 2x2 GRID) -->
                        <div class="grid grid-cols-2 gap-1.5 text-left">
                            
                            <!-- Full Name -->
                            <div class="p-1.5 sm:p-2 rounded-lg bg-white border border-slate-200/90 shadow-2xs">
                                <span class="text-[7.5px] sm:text-[8px] font-bold uppercase tracking-wider text-slate-400 block">Applicant Name</span>
                                <p class="text-[11px] sm:text-xs font-black text-slate-900 truncate leading-snug">
                                    {{ !empty($regName) ? $regName : 'N/A' }}
                                </p>
                            </div>

                            <!-- Mobile Number -->
                            <div class="p-1.5 sm:p-2 rounded-lg bg-white border border-slate-200/90 shadow-2xs">
                                <span class="text-[7.5px] sm:text-[8px] font-bold uppercase tracking-wider text-slate-400 block">Mobile Number</span>
                                <p class="text-[11px] sm:text-xs font-black text-slate-900 truncate leading-snug">
                                    {{ !empty($regPhone) ? $regPhone : 'N/A' }}
                                </p>
                            </div>

                            <!-- Email Address -->
                            <div class="p-1.5 sm:p-2 rounded-lg bg-white border border-slate-200/90 shadow-2xs">
                                <span class="text-[7.5px] sm:text-[8px] font-bold uppercase tracking-wider text-slate-400 block">Email Address</span>
                                <p class="text-[10px] sm:text-[11px] font-black text-slate-900 truncate leading-snug" title="{{ $regEmail }}">
                                    {{ !empty($regEmail) ? $regEmail : 'N/A' }}
                                </p>
                            </div>

                            <!-- Address -->
                            <div class="p-1.5 sm:p-2 rounded-lg bg-white border border-slate-200/90 shadow-2xs">
                                <span class="text-[7.5px] sm:text-[8px] font-bold uppercase tracking-wider text-slate-400 block">Registered Address</span>
                                <p class="text-[9.5px] sm:text-[10px] font-semibold text-slate-800 line-clamp-1 leading-snug" title="{{ $fullAddress }}">
                                    {{ !empty($fullAddress) ? $fullAddress : 'Address recorded' }}
                                </p>
                            </div>

                        </div>

                        <!-- Ticket Status & Metadata Footer -->
                        <div class="pt-1 border-t border-slate-100 flex items-center justify-between text-[8px] sm:text-[8.5px] text-slate-500">
                            <div class="flex items-center gap-1 font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>KYC: Pending Verification</span>
                            </div>
                            <div class="font-medium text-slate-400">
                                {{ $submittedDate }}
                            </div>
                        </div>

                        <!-- BARCODE & TICKET SECURITY STRIP -->
                        <div class="pt-1 border-t border-slate-200/70 flex items-center justify-between gap-2">
                            <div class="flex-1">
                                <!-- Clean Vector Barcode Graphic -->
                                <svg class="h-4 sm:h-4.5 w-full max-w-[150px]" style="color: #0f172a;" fill="#0f172a" viewBox="0 0 220 30">
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
                                <span class="font-mono text-[7.5px] font-bold text-slate-400 tracking-wider block mt-0.5">
                                    * {{ $appCode }} *
                                </span>
                            </div>
                            <div class="text-right shrink-0">
                                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded bg-slate-100 text-slate-700 text-[7.5px] font-black uppercase tracking-wider border border-slate-200">
                                    ✓ Official Slip
                                </span>
                                <span class="block text-[7px] text-slate-400 mt-0.5 font-medium">Sumatra Sales Pvt Ltd</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- Sticky Bottom Dismiss / Continue Button -->
        <div class="pt-2 mt-2 border-t border-slate-100 shrink-0">
            <button type="button" id="dismiss-celebration-modal-btn" class="w-full inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-900 text-xs font-black transition cursor-pointer">
                <span>Continue to Homepage</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
            </button>
        </div>

    </div>
</div>

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
    // Multi-cannon Festive Confetti Celebration
    // ==============================================================
    function fireMultiBoomConfetti() {
        if (typeof confetti !== 'function') return;

        confetti({
            particleCount: 70,
            spread: 60,
            origin: { y: 0.6 },
            colors: ['#2964F2', '#F59E0B', '#10B981', '#6366F1', '#EC4899']
        });

        setTimeout(() => {
            confetti({
                particleCount: 40,
                angle: 60,
                spread: 50,
                origin: { x: 0, y: 0.7 },
                colors: ['#2964F2', '#38BDF8', '#F59E0B']
            });
        }, 200);

        setTimeout(() => {
            confetti({
                particleCount: 40,
                angle: 120,
                spread: 50,
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
