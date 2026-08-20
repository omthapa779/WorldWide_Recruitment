<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title inertia>{{ config('app.name', 'WorldWide Recruitment Services') }}</title>

    <meta name="description" content="WorldWide Recruitment Services Pvt. Ltd. — a government-licensed Nepali manpower agency (License No. 1617-079/80) connecting Nepalese talent with employers in Japan, Dubai, Qatar and beyond.">
    <meta name="keywords" content="Recruitment Nepal, Manpower Nepal, Jobs in Japan, Overseas Employment, WRS Nepal, Ethical Recruitment, 人材紹介, ネパール">
    <meta name="author" content="WorldWide Recruitment Services Pvt. Ltd.">

    <meta property="og:site_name" content="WorldWide Recruitment Services">
    <meta property="og:title" content="WorldWide Recruitment Services Pvt. Ltd.">
    <meta property="og:description" content="Connecting Nepalese talent with global opportunities. Government-licensed overseas employment for Japan, Dubai, Qatar and more.">
    <meta property="og:image" content="{{ asset('resources/images/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="WorldWide Recruitment Services Pvt. Ltd.">
    <meta name="twitter:description" content="Connecting Nepalese talent with global opportunities.">
    <meta name="twitter:image" content="{{ asset('resources/images/logo.png') }}">

    <link rel="shortcut icon" href="{{ asset('resources/favicon.ico') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700;800&family=Zen+Kaku+Gothic+New:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    @inertiaHead
</head>
<body class="antialiased">
    @inertia
</body>
</html>
