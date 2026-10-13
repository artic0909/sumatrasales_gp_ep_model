@if (session('submission_success') || session('success'))
@php
    $successData = session('submission_success', []);
    $regRole = $successData['role'] ?? 'EP';
    $regEmail = $successData['email'] ?? '';
    $regName = $successData['name'] ?? '';
@endphp
<!-- ================================================================= -->
<!-- BOOM CELEBRATION MODAL (NON-CLOSABLE MODAL ON SUCCESSFUL SUBMIT)  -->
<!-- ================================================================= -->
<div id="celebration-modal" class="fixed inset-0 z-[999] flex items-center justify-center p-4 sm:p-6 bg-slate-950/85 backdrop-blur-md overflow-y-auto" role="dialog" aria-modal="true" data-backdrop="static">
    <div id="celebration-modal-card" class="relative w-full max-w-lg bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden text-center p-6 sm:p-10 transform scale-100 transition-all">
        
        <!-- Festive Accent Top Gradient Ribbon -->
        <div class="absolute top-0 inset-x-0 h-3 bg-gradient-to-r from-[#2964F2] via-indigo-500 to-amber-500"></div>

        <!-- Glowing Boom Celebration Badge & Icon -->
        <div class="relative mx-auto w-24 h-24 mb-5 flex items-center justify-center">
            <div class="absolute inset-0 rounded-full bg-blue-500/20 animate-ping"></div>
            <div class="absolute -inset-2 rounded-full bg-amber-400/20 animate-pulse"></div>
            <div class="relative w-20 h-20 rounded-full bg-gradient-to-tr from-[#2964F2] to-blue-500 text-white flex items-center justify-center shadow-xl shadow-blue-500/30">
                <svg class="w-10 h-10 animate-bounce" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
            </div>
            <div class="absolute -top-1 -right-1 w-8 h-8 rounded-full bg-amber-400 text-amber-950 flex items-center justify-center text-sm font-black shadow-md">
                ✨
            </div>
        </div>

        <!-- Celebration Pill Badge -->
        <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-black bg-blue-50 text-[#2964F2] border border-blue-200 mb-3 tracking-wide uppercase">
            <span>🎉</span>
            <span>Application Submitted Successfully</span>
        </div>

        <!-- Required Bold Message -->
        <h2 class="text-lg sm:text-xl font-black text-slate-900 tracking-tight leading-snug">
            Your form is successfully submitted, wait for approval, after approve it your {{ $regRole === 'GP' ? 'GP' : 'EP' }} code will be send in you this email:
        </h2>

        <!-- Highlighted Email Box -->
        <div class="mt-4 p-4 rounded-2xl bg-blue-50/80 border border-blue-200 flex items-center justify-center gap-2.5 shadow-2xs">
            <svg class="w-5 h-5 text-[#2964F2] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
            </svg>
            <span class="font-extrabold text-[#2964F2] text-base sm:text-lg break-all">
                {{ !empty($regEmail) ? $regEmail : 'your registered email address' }}
            </span>
        </div>

        <!-- Status Card -->
        <div class="mt-5 pt-4 border-t border-slate-100 grid grid-cols-2 gap-3 text-left">
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/70">
                <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Applied Role</p>
                <p class="text-xs font-black text-slate-800 mt-0.5">
                    {{ $regRole === 'GP' ? 'Ground Partner (GP)' : 'Executive Partner (EP)' }}
                </p>
            </div>
            <div class="p-3 rounded-xl bg-amber-50/80 border border-amber-200/70">
                <p class="text-[10px] uppercase font-bold text-amber-600 tracking-wider">Status</p>
                <p class="text-xs font-black text-amber-900 mt-0.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    Pending Approval
                </p>
            </div>
        </div>

        <p class="mt-4 text-xs font-medium text-slate-500 leading-relaxed">
            Our verification team will review your submitted KYC documents and send your partner authorization credentials via email.
        </p>

        <!-- Continue Button to dismiss modal and explore Home -->
        <div class="mt-6 pt-1">
            <button type="button" id="dismiss-celebration-modal-btn" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-[#2964F2] hover:bg-[#1E52D4] text-white text-sm font-extrabold rounded-2xl shadow-lg shadow-blue-500/25 transition transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer">
                <span>Continue to Sumatra Sales</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
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

    // Dismiss only via the explicit "Continue" button
    document.getElementById('dismiss-celebration-modal-btn')?.addEventListener('click', function () {
        modal.classList.add('opacity-0', 'transition-opacity', 'duration-300');
        setTimeout(() => {
            modal.remove();
            document.body.classList.remove('overflow-hidden');
        }, 300);
    });

    // Boom Confetti celebration cannon
    function fireBoomConfetti() {
        if (typeof confetti === 'function') {
            const count = 220;
            const defaults = { origin: { y: 0.7 } };

            function fire(particleRatio, opts) {
                confetti(Object.assign({}, defaults, opts, {
                    particleCount: Math.floor(count * particleRatio)
                }));
            }

            fire(0.25, { spread: 26, startVelocity: 55 });
            fire(0.2, { spread: 60 });
            fire(0.35, { spread: 100, decay: 0.91, scalar: 0.8 });
            fire(0.1, { spread: 120, startVelocity: 25, decay: 0.92, scalar: 1.2 });
            fire(0.1, { spread: 120, startVelocity: 45 });

            const duration = 4000;
            const animationEnd = Date.now() + duration;

            const interval = setInterval(function () {
                const timeLeft = animationEnd - Date.now();
                if (timeLeft <= 0) {
                    return clearInterval(interval);
                }
                const particleCount = 50 * (timeLeft / duration);
                confetti({
                    particleCount,
                    startVelocity: 30,
                    spread: 360,
                    ticks: 60,
                    origin: { x: Math.random(), y: Math.random() - 0.2 }
                });
            }, 250);
        }
    }

    if (window.confetti) {
        fireBoomConfetti();
    } else {
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js';
        script.onload = fireBoomConfetti;
        document.head.appendChild(script);
    }
});
</script>
@endif
