<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- ✅ Dynamic Title --}}
    <title>@yield('title', 'Prime Doctors Medical Center')</title>

    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('icons/site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}">
    <meta name="theme-color" content="#ffffff">


    {{-- ✅ Dynamic SEO Meta --}}
    <meta name="title" content="@yield('meta_title', 'Prime Doctors Medical Center')">
    <meta name="description" content="@yield('meta_description', 'Prime Doctors Medical Center is your trusted healthcare provider offering comprehensive medical services, advanced diagnostics, and compassionate care.')">
    <meta name="keywords" content="@yield('meta_keywords', 'prime doctors medical center, healthcare provider, medical services, family health clinic, general medicine, specialist doctors, diagnostic services, quality healthcare')">
    <meta name="author" content="Prime Doctors Medical Center">

    {{-- 🔹 Open Graph (Facebook, LinkedIn, etc.) --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('meta_title', 'Prime Doctors Medical Center')">
    <meta property="og:description" content="@yield('meta_description', 'Prime Doctors Medical Center is your trusted healthcare provider offering comprehensive medical services, advanced diagnostics, and compassionate care.')">
    <meta property="og:image" content="{{ asset('Thumbnail.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    {{-- 🔹 Twitter Card (X.com) --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_title', 'Prime Doctors Medical Center')">
    <meta name="twitter:description" content="@yield('meta_description', 'Prime Doctors Medical Center offers trusted healthcare and diagnostics.')">
    <meta name="twitter:image" content="{{ asset('Thumbnail.png') }}">


    {{-- ✅ Social Media / Open Graph --}}
    <meta property="og:title" content="@yield('meta_title', 'Prime Doctors Medical Center')">
    <meta property="og:description" content="@yield('meta_description', 'Prime Doctors Medical Center offers comprehensive healthcare with expert doctors and compassionate care.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('Thumbnail.png') }}">
    <meta name="twitter:card" content="summary_large_image">

    {{-- ✅ Apple & Android (PWA / Dynamic App-Like Tags) --}}
    <meta name="theme-color" content="#0A6EBD"> <!-- Browser toolbar color -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Prime Doctors Medical Center">
    <link rel="apple-touch-icon" href="{{ asset('icons/apple-icon-180x180.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}"> <!-- For Android (PWA) -->

    {{-- ✅ Fonts & CSS --}}
    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;600;700&family=Roboto:wght@300;400;500;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">

    {{-- ✅ Swiper, Alpine, and AOS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
</body>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</html>
