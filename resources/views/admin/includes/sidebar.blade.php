@php
    $currentRoute = request()->route() ? request()->route()->getName() : '';
    $epCount = \App\Models\Partner::where('registration_type', 'EP')->count();
    $gpCount = \App\Models\Partner::where('registration_type', 'GP')->count();
@endphp

<!-- DESKTOP FIXED SIDEBAR -->
<aside class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 z-30 bg-slate-900 border-r border-slate-800 text-slate-300">
    
    <!-- Sidebar Header / Brand -->
    <div class="h-16 flex items-center gap-3 px-5 border-b border-slate-800/80 bg-slate-950/40">
        <img src="{{ asset('logo.png') }}" alt="Sumatra Sales" class="h-8 w-auto object-contain">
        <div>
            <h1 class="text-xs font-black text-white tracking-tight uppercase">Sumatra Sales</h1>
            <span class="text-[9px] font-bold text-blue-400 uppercase tracking-widest block">Admin Management</span>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        
        <!-- DASHBOARD -->
        <a href="{{ route('admin.dashboard') }}" class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition {{ str_starts_with($currentRoute, 'admin.dashboard') || $currentRoute === 'admin.index' ? 'bg-[#2964F2] text-white shadow-md shadow-blue-600/30 font-black' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span>Dashboard Overview</span>
            </div>
        </a>

        <div class="pt-3 pb-1.5 px-3">
            <span class="text-[10px] font-black uppercase tracking-wider text-slate-500">Partner Networks</span>
        </div>

        <!-- EXECUTIVE PARTNERS (EP) -->
        <a href="{{ route('admin.ep.index') }}" class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition {{ str_starts_with($currentRoute, 'admin.ep.') ? 'bg-[#2964F2] text-white shadow-md shadow-blue-600/30 font-black' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 shrink-0 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                </svg>
                <span>Executive Partners (EP)</span>
            </div>
            @if ($epCount > 0)
                <span class="px-2 py-0.5 rounded-full text-[10px] font-black {{ str_starts_with($currentRoute, 'admin.ep.') ? 'bg-white text-[#2964F2]' : 'bg-blue-500/20 text-blue-300' }}">{{ $epCount }}</span>
            @endif
        </a>

        <!-- GROUND PARTNERS (GP) -->
        <a href="{{ route('admin.gp.index') }}" class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition {{ str_starts_with($currentRoute, 'admin.gp.') ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/30 font-black' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span>Ground Partners (GP)</span>
            </div>
            @if ($gpCount > 0)
                <span class="px-2 py-0.5 rounded-full text-[10px] font-black {{ str_starts_with($currentRoute, 'admin.gp.') ? 'bg-white text-emerald-700' : 'bg-emerald-500/20 text-emerald-300' }}">{{ $gpCount }}</span>
            @endif
        </a>

        <div class="pt-3 pb-1.5 px-3">
            <span class="text-[10px] font-black uppercase tracking-wider text-slate-500">Portals & Inquiries</span>
        </div>

        <!-- INVESTORS -->
        <a href="{{ route('admin.investor.index') }}" class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition {{ str_starts_with($currentRoute, 'admin.investor.') ? 'bg-[#2964F2] text-white shadow-md shadow-blue-600/30 font-black' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 shrink-0 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                </svg>
                <span>Investor Relations</span>
            </div>
        </a>

        <!-- CONTACT & LEADS -->
        <a href="{{ route('admin.contact.index') }}" class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition {{ str_starts_with($currentRoute, 'admin.contact.') ? 'bg-[#2964F2] text-white shadow-md shadow-blue-600/30 font-black' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 shrink-0 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <span>Contact Inquiries</span>
            </div>
        </a>

        <div class="pt-3 pb-1.5 px-3">
            <span class="text-[10px] font-black uppercase tracking-wider text-slate-500">System & Content</span>
        </div>

        <!-- DYNAMIC WEBSITE SETTINGS -->
        <a href="{{ route('admin.settings.index') }}" class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition {{ str_starts_with($currentRoute, 'admin.settings.') ? 'bg-[#2964F2] text-white shadow-md shadow-blue-600/30 font-black' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 shrink-0 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                </svg>
                <span>Website Dynamic Content</span>
            </div>
            <span class="px-1.5 py-0.5 rounded text-[9px] font-black uppercase tracking-wider bg-cyan-500/20 text-cyan-300">Live</span>
        </a>

        <!-- ADMIN PROFILE -->
        <a href="{{ route('admin.profile.index') }}" class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition {{ str_starts_with($currentRoute, 'admin.profile.') ? 'bg-[#2964F2] text-white shadow-md shadow-blue-600/30 font-black' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <span>Admin Profile & Security</span>
            </div>
        </a>

    </nav>

    <!-- Sidebar Bottom Action -->
    <div class="p-3 border-t border-slate-800 bg-slate-950/40">
        <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between p-2.5 rounded-xl bg-slate-800/80 hover:bg-slate-800 text-xs font-bold text-slate-300 hover:text-white transition group">
            <span class="flex items-center gap-2">
                <svg class="w-3.5 h-3.5 text-blue-400 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                <span>View Public Site</span>
            </span>
            <span class="text-[10px] text-slate-500">Live ↗</span>
        </a>
    </div>

</aside>

<!-- MOBILE DRAWER OVERLAY -->
<div id="mobile-sidebar" class="fixed inset-0 z-50 hidden md:hidden">
    <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm" onclick="toggleMobileSidebar()"></div>
    <div class="relative flex-1 flex flex-col max-w-xs w-full bg-slate-900 text-slate-300 h-full p-4 space-y-4 shadow-2xl">
        <div class="flex items-center justify-between pb-3 border-b border-slate-800">
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('logo.png') }}" alt="Sumatra Sales" class="h-7 w-auto object-contain">
                <span class="text-xs font-black text-white uppercase">Admin Panel</span>
            </div>
            <button type="button" onclick="toggleMobileSidebar()" class="text-slate-400 hover:text-white p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <nav class="space-y-1.5 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-xl text-xs font-bold text-slate-300 hover:bg-slate-800">Dashboard</a>
            <a href="{{ route('admin.ep.index') }}" class="block px-3 py-2 rounded-xl text-xs font-bold text-slate-300 hover:bg-slate-800">Executive Partners (EP)</a>
            <a href="{{ route('admin.gp.index') }}" class="block px-3 py-2 rounded-xl text-xs font-bold text-slate-300 hover:bg-slate-800">Ground Partners (GP)</a>
            <a href="{{ route('admin.investor.index') }}" class="block px-3 py-2 rounded-xl text-xs font-bold text-slate-300 hover:bg-slate-800">Investor Relations</a>
            <a href="{{ route('admin.contact.index') }}" class="block px-3 py-2 rounded-xl text-xs font-bold text-slate-300 hover:bg-slate-800">Contact Inquiries</a>
            <a href="{{ route('admin.settings.index') }}" class="block px-3 py-2 rounded-xl text-xs font-bold text-cyan-400 hover:bg-slate-800">Website Dynamic Content</a>
            <a href="{{ route('admin.profile.index') }}" class="block px-3 py-2 rounded-xl text-xs font-bold text-slate-300 hover:bg-slate-800">Admin Profile</a>
        </nav>
    </div>
</div>

<script>
    function toggleMobileSidebar() {
        const drawer = document.getElementById('mobile-sidebar');
        drawer.classList.toggle('hidden');
    }
</script>
