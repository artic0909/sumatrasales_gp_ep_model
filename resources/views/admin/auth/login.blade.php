<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-900">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Login - Sumatra Sales</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex items-center justify-center p-4 bg-gradient-to-tr from-slate-950 via-slate-900 to-blue-950 font-['Plus_Jakarta_Sans',sans-serif]">
    
    <div class="w-full max-w-md bg-white/95 backdrop-blur-xl rounded-3xl p-6 sm:p-8 shadow-2xl border border-white/20 text-slate-800">
        
        <div class="text-center space-y-2 mb-6">
            <img src="{{ asset('logo.png') }}" alt="Sumatra Sales" class="h-10 w-auto mx-auto object-contain">
            <h1 class="text-lg font-black text-slate-900 uppercase tracking-tight">Admin Portal</h1>
            <p class="text-xs text-slate-500 font-medium">Please sign in to access the partner management console.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs">
                @foreach ($errors->all() as $error)
                    <p class="font-medium">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Email Address</label>
                <input type="email" name="email" id="email" required autofocus value="{{ old('email') }}" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Password</label>
                <input type="password" name="password" id="password" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-[#2964F2] focus:ring-[#2964F2]">
                    <span>Remember me</span>
                </label>
                <a href="{{ route('home') }}" class="text-[#2964F2] font-bold hover:underline">Back to site</a>
            </div>

            <button type="submit" class="w-full py-3 px-4 rounded-xl bg-[#2964F2] hover:bg-blue-600 active:bg-blue-700 text-white font-black text-xs uppercase tracking-wider shadow-lg shadow-blue-600/30 transition cursor-pointer">
                Sign In to Dashboard
            </button>
        </form>

        <div class="mt-6 pt-4 border-t border-slate-100 text-center text-[11px] text-slate-400">
            &copy; {{ date('Y') }} Sumatra Sales Private Limited
        </div>

    </div>

</body>
</html>
