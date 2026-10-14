<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - Sumatra Sales Admin</title>

    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;600;800&display=swap" rel="stylesheet">

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="h-full font-['Plus_Jakarta_Sans',sans-serif] text-slate-800 antialiased bg-slate-50">

    <div class="min-h-full flex flex-col md:flex-row">
        
        <!-- SIDEBAR -->
        @include('admin.includes.sidebar')

        <!-- MAIN WRAPPER -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden md:pl-64 transition-all duration-300">
            
            <!-- HEADER -->
            @include('admin.includes.header')

            <!-- FLASH NOTIFICATIONS -->
            @if (session('success'))
                <div class="mx-4 sm:mx-6 md:mx-8 mt-4 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-xs animate-fade-in" role="alert">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500 text-white flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="mx-4 sm:mx-6 md:mx-8 mt-4 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between shadow-xs animate-fade-in" role="alert">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-rose-500 text-white flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold">{{ session('error') }}</p>
                        </div>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            @endif

            <!-- MAIN CONTENT AREA -->
            <main class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto">
                @yield('content')
            </main>

            <!-- FOOTER -->
            @include('admin.includes.footer')

        </div>

    </div>

    <!-- GLOBAL PARTNER DETAILS & DOCUMENT VIEWER MODAL -->
    <div id="partner-doc-modal" class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm overflow-y-auto p-4 sm:p-6 flex items-center justify-center animate-fade-in">
        <div class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden text-left p-5 sm:p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <span id="modal-role-badge" class="px-2.5 py-1 text-xs font-black rounded-lg bg-blue-50 text-[#2964F2] border border-blue-200">EP</span>
                    <div>
                        <h3 id="modal-partner-name" class="text-base font-black text-slate-900">Partner Details</h3>
                        <p id="modal-app-code" class="text-xs font-mono font-bold text-slate-500 tracking-wider">SSPL-APP-CODE</p>
                    </div>
                </div>
                <button type="button" onclick="closePartnerModal()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <!-- Modal Body Content -->
            <div id="modal-partner-content" class="space-y-4 max-h-[70vh] overflow-y-auto pr-1">
                <!-- Dynamically loaded via JavaScript -->
            </div>

            <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                <button type="button" onclick="closePartnerModal()" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                    Close
                </button>
                <a id="modal-download-pdf-btn" href="#" target="_blank" class="px-4 py-2 rounded-xl bg-[#2964F2] hover:bg-blue-700 text-white text-xs font-bold transition inline-flex items-center gap-1.5 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.5V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                    <span>Download Official PDF</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function openPartnerModal(partner) {
            const modal = document.getElementById('partner-doc-modal');
            const nameEl = document.getElementById('modal-partner-name');
            const codeEl = document.getElementById('modal-app-code');
            const badgeEl = document.getElementById('modal-role-badge');
            const contentEl = document.getElementById('modal-partner-content');
            const pdfBtn = document.getElementById('modal-download-pdf-btn');

            nameEl.textContent = partner.name || 'N/A';
            codeEl.textContent = partner.application_code || 'N/A';
            badgeEl.textContent = partner.registration_type || 'EP';
            badgeEl.className = partner.registration_type === 'GP' 
                ? 'px-2.5 py-1 text-xs font-black rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200'
                : 'px-2.5 py-1 text-xs font-black rounded-lg bg-blue-50 text-[#2964F2] border border-blue-200';

            pdfBtn.href = `/partner-application/pdf/${partner.application_code}`;

            const docImg = (label, path) => {
                if (!path) return `<div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-center text-xs text-slate-400 font-medium">${label}: Not Uploaded</div>`;
                const storageUrl = `/storage/${path}`;
                return `
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">${label}</span>
                        <a href="${storageUrl}" target="_blank" class="block group relative rounded-xl overflow-hidden border border-slate-200 bg-slate-100 aspect-video flex items-center justify-center">
                            <img src="${storageUrl}" alt="${label}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-xs font-bold transition">View Full Image ↗</div>
                        </a>
                    </div>
                `;
            };

            contentEl.innerHTML = `
                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Contact Phone</span>
                        <p class="font-bold text-slate-900 mt-0.5">${partner.phone || 'N/A'}</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Email Address</span>
                        <p class="font-bold text-slate-900 mt-0.5 break-all">${partner.email || 'N/A'}</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80 col-span-2">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Registered Address</span>
                        <p class="font-semibold text-slate-800 mt-0.5">${[partner.address, partner.city, partner.district, partner.state].filter(Boolean).join(', ') || 'N/A'}</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Aadhaar Number</span>
                        <p class="font-mono font-bold text-slate-900 mt-0.5">${partner.aadhaar_number || 'N/A'}</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">PAN Card Number</span>
                        <p class="font-mono font-bold text-slate-900 mt-0.5">${partner.pancard_number || 'N/A'}</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80 col-span-2">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Bank Account Details</span>
                        <p class="font-bold text-slate-900 mt-0.5">${partner.bank_name || 'Bank'} • A/C: ${partner.bank_account_number || 'N/A'} (IFSC: ${partner.ifsc_code || 'N/A'})</p>
                    </div>
                </div>

                <div class="pt-2 border-t border-slate-100">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider mb-2">Uploaded Verification Documents</h4>
                    <div class="grid grid-cols-2 gap-3">
                        ${docImg('Aadhaar Card Front', partner.aadhaar_front_image)}
                        ${docImg('Aadhaar Card Back', partner.aadhaar_back_image)}
                        ${docImg('PAN Card Front', partner.pancard_front_image)}
                        ${docImg('Self Photograph', partner.self_image)}
                    </div>
                </div>
            `;

            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closePartnerModal() {
            document.getElementById('partner-doc-modal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>

    @stack('scripts')
</body>
</html>
