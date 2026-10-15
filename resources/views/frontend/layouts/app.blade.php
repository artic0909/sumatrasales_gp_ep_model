<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Primary Static SEO Meta Tags -->
    <title>@yield('title', 'Sumatra Sales Private Limited - Technology for People | Doctorwala, Schoolwala, Rani Matrimonial, ProjectAttendance & Software Development')</title>
    <meta name="description" content="@yield('meta_description', 'Sumatra Sales Private Limited is India\'s premier digital technology and software enterprise powering Doctorwala (Healthcare OPD Booking), Schoolwala (WBBSE EdTech), Rani Matrimonial (Safe Matchmaking), ProjectAttendance (GPS Workforce HRMS), and end-to-end Custom Software Development, Mobile App Development (Android & iOS) and Website Development services. Explore our platforms or join the Partner program.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Sumatra Sales, Sumatra Sales Private Limited, Doctorwala, doctorwala.info, doctor appointment booking app, OPD booking, pathology lab tests, Schoolwala, schoolwala.info, WBBSE Bengali medium education app, Rani Matrimonial, ranimatrimonial.com, trusted matrimony portal, verified matchmaking, ProjectAttendance, projectattendance.com, GPS geofence attendance, biometric staff tracking, software development, custom software development company, mobile app development, Android app development, iOS app development, website development, web application development, ERP CRM development, IT company India, Ground Partner GP, Executive Partner EP, software franchise India')">
    <meta name="author" content="Sumatra Sales Private Limited">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph (Facebook, WhatsApp, LinkedIn) -->
    <meta property="og:locale" content="en_IN">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', 'Sumatra Sales Private Limited - Technology for People')">
    <meta property="og:description" content="@yield('og_description', 'Discover proprietary software engines built and maintained by Sumatra Sales: Doctorwala, Schoolwala, Rani Matrimonial, ProjectAttendance, plus Custom Software, Mobile App & Website Development services. Join as an Executive Partner (EP) or Ground Partner (GP).')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Sumatra Sales Private Limited">
    <meta property="og:image" content="{{ asset('img/hero-bg.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Sumatra Sales Digital Ecosystems">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Sumatra Sales Private Limited - Technology for People')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Official portal for Sumatra Sales Private Limited: Doctorwala, Schoolwala, Rani Matrimonial, ProjectAttendance, and Custom Software, Mobile App & Website Development.')">
    <meta name="twitter:image" content="{{ asset('img/hero-bg.jpg') }}">

    <!-- Favicon & Icons -->
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Rich Structured Data (JSON-LD) for Search Engines -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Organization",
                "@id": "{{ url('/') }}#organization",
                "name": "Sumatra Sales Private Limited",
                "legalName": "Sumatra Sales Private Limited",
                "url": "{{ url('/') }}",
                "logo": "{{ asset('logo.png') }}",
                "description": "Technology for People. Proprietary software developer and operator of DOCTORwala, Schoolwala, Rani Matrimonial, and ProjectAttendance.",
                "address": {
                    "@type": "PostalAddress",
                    "addressCountry": "IN",
                    "addressRegion": "West Bengal"
                },
                "contactPoint": {
                    "@type": "ContactPoint",
                    "email": "partner@sumatrasales.com",
                    "contactType": "customer service"
                },
                "sameAs": [
                    "https://www.doctorwala.info/",
                    "https://schoolwala.info/",
                    "https://ranimatrimonial.com/",
                    "https://projectattendance.com/"
                ]
            },
            {
                "@type": "WebSite",
                "@id": "{{ url('/') }}#website",
                "url": "{{ url('/') }}",
                "name": "Sumatra Sales Private Limited",
                "publisher": {
                    "@id": "{{ url('/') }}#organization"
                }
            },
            {
                "@type": "SoftwareApplication",
                "@id": "https://www.doctorwala.info/#app",
                "name": "DOCTORwala",
                "url": "https://www.doctorwala.info/",
                "applicationCategory": "HealthApplication",
                "operatingSystem": "Android, Web",
                "description": "Healthcare for Everyone. 24/7 Verified doctor bookings, OPD clinics, diagnostic lab tests, electronic health records, and local pharmacy directory.",
                "offers": {
                    "@type": "Offer",
                    "price": "0",
                    "priceCurrency": "INR"
                },
                "installUrl": "https://play.google.com/store/apps/details?id=com.doctorwala.dochealth&pcampaignid=web_share",
                "publisher": {
                    "@id": "{{ url('/') }}#organization"
                }
            },
            {
                "@type": "SoftwareApplication",
                "@id": "https://schoolwala.info/#app",
                "name": "Schoolwala",
                "url": "https://schoolwala.info/",
                "applicationCategory": "EducationalApplication",
                "operatingSystem": "Android, Web",
                "description": "Digital Education for Bengali Medium students following the WBBSE board syllabus (Classes VIII, IX, and X) with video lessons, study notes, and chapter tests.",
                "offers": {
                    "@type": "Offer",
                    "price": "0",
                    "priceCurrency": "INR"
                },
                "installUrl": "https://play.google.com/store/apps/details?id=com.schoolwala.schoolwalaapp",
                "publisher": {
                    "@id": "{{ url('/') }}#organization"
                }
            },
            {
                "@type": "SoftwareApplication",
                "@id": "https://ranimatrimonial.com/#app",
                "name": "Rani Matrimonial",
                "url": "https://ranimatrimonial.com/",
                "applicationCategory": "LifestyleApplication",
                "operatingSystem": "Web (Android App Coming Soon)",
                "description": "Find Your Perfect Match with 100% verified biodatas, strict family privacy, smart AI matchmaking, and secure in-app communications.",
                "offers": {
                    "@type": "Offer",
                    "price": "0",
                    "priceCurrency": "INR"
                },
                "publisher": {
                    "@id": "{{ url('/') }}#organization"
                }
            },
            {
                "@type": "SoftwareApplication",
                "@id": "https://projectattendance.com/#app",
                "name": "ProjectAttendance",
                "url": "https://projectattendance.com/",
                "applicationCategory": "BusinessApplication",
                "operatingSystem": "Android, Web",
                "description": "Workforce & Admin HRMS management platform with GPS geofenced mobile attendance, field route logs, and automated payroll timesheets.",
                "offers": {
                    "@type": "Offer",
                    "price": "0",
                    "priceCurrency": "INR"
                },
                "installUrl": "https://play.google.com/store/apps/details?id=smart.geofence.attendance&pcampaignid=web_share",
                "publisher": {
                    "@id": "{{ url('/') }}#organization"
                }
            },
            {
                "@type": "Service",
                "@id": "{{ url('/') }}#software-development",
                "name": "Custom Software, Mobile App & Website Development",
                "url": "{{ url('/') }}#solutions",
                "serviceType": "Software Development, Mobile App Engineering, Website Development",
                "provider": {
                    "@id": "{{ url('/') }}#organization"
                },
                "description": "End-to-end custom software engineering, Android and iOS mobile application development, responsive corporate websites, web portals, and scalable cloud ERP/CRM solutions."
            }
        ]
    }
    </script>

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
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.25s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.25s ease, background-color 0.25s ease;
            will-change: transform;
        }
        .solution-card:hover {
            transform: translateY(-4px) !important;
            box-shadow: 0 14px 28px -6px rgba(15, 23, 42, 0.09), 0 4px 10px -2px rgba(15, 23, 42, 0.04) !important;
            opacity: 1 !important;
            z-index: 20 !important;
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
<body class="bg-[#F8FAFC] text-slate-800 antialiased selection:bg-blue-600 selection:text-white overflow-x-hidden min-h-screen">

    <!-- TOP NAVIGATION HEADER -->
    @include('frontend.includes.header')

    <!-- MAIN CONTENT CONTAINER -->
    @yield('content')

    <!-- FOOTER -->
    @include('frontend.includes.footer')

    <!-- SCRIPTS -->
    @include('frontend.includes.scripts')
    @stack('scripts')

    <!-- BOOM CELEBRATION MODAL (ON SUCCESSFUL SUBMISSION) -->
    @include('frontend.includes.celebration_modal')

</body>
</html>