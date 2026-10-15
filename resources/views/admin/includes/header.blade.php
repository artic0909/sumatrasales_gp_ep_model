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
                {{ strtoupper(substr(auth('admin')->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="hidden md:block text-left text-xs">
                <span class="font-black text-slate-900 block leading-tight">{{ auth('admin')->user()->name ?? 'Admin User' }}</span>
                <span class="text-[10px] text-slate-400 font-medium">{{ auth('admin')->user()->email ?? 'admin@sspl.com' }}</span>
            </div>
        </div>

        <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>

        <!-- Logout Action Button -->
        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" title="Sign Out of Admin Console" class="p-2 rounded-xl text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition flex items-center gap-1.5 text-xs font-bold cursor-pointer">
                <svg class="w-4 h-4 shrink-0 text-slate-400 hover:text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/></svg>
                <span class="hidden lg:inline text-[11px] text-slate-600">Logout</span>
            </button>
        </form>
    </div>

</header>
