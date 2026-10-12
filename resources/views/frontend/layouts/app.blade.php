<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sumatra Sales Private Limited - Technology for People')</title>
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
        .no-scrollbar::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
        .no-scrollbar {
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-[#F8FAFC] text-slate-800 antialiased selection:bg-blue-600 selection:text-white">

    <!-- TOP NAVIGATION HEADER -->
    @include('frontend.includes.header')

    <!-- MAIN CONTENT CONTAINER -->
    @yield('content')

    <!-- FOOTER -->
    @include('frontend.includes.footer')

    <!-- SCRIPTS -->
    @include('frontend.includes.scripts')
    @stack('scripts')

</body>
</html>