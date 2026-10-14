<header class="h-16 bg-white border-b border-slate-200/80 px-4 sm:px-6 md:px-8 flex items-center justify-between sticky top-0 z-20 shadow-2xs">
    
    <!-- Left Section: Mobile Toggle & Breadcrumb / Search -->
    <div class="flex items-center gap-3">
        <!-- Mobile Toggle Button -->
        <button type="button" onclick="toggleMobileSidebar()" class="md:hidden p-2 rounded-xl text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
        </button>

        <div class="hidden sm:flex items-center gap-2 text-xs font-bold text-slate-500">
            <span>Admin</span>
            <span>/</span>
            <span class="text-slate-900 capitalize">@yield('title', 'Dashboard')</span>
        </div>
    </div>

    <!-- Right Section: System Status, Date & Admin Pill -->
    <div class="flex items-center gap-3 sm:gap-4">
        
        <!-- Live System Status Badge -->
        <div class="hidden lg:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-black tracking-wide">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>SYSTEM ONLINE</span>
        </div>

        <!-- Date Timestamp -->
        <div class="hidden sm:block text-right text-xs">
            <span class="font-bold text-slate-900 block leading-tight">{{ now('Asia/Kolkata')->format('d M, Y') }}</span>
            <span class="text-[10px] text-slate-400 font-medium">Asia/Kolkata</span>
        </div>

        <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>

        <!-- Admin Profile Avatar Pill -->
        <div class="flex items-center gap-2.5 pl-1">
            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#2964F2] to-blue-600 text-white flex items-center justify-center text-xs font-black shadow-xs ring-2 ring-blue-100">
                A
            </div>
            <div class="hidden md:block text-left text-xs">
                <span class="font-black text-slate-900 block leading-tight">Admin User</span>
                <span class="text-[10px] text-slate-400 font-medium">Super Admin</span>
            </div>
        </div>

    </div>

</header>
