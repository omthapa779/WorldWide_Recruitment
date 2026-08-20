<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        // Rendered server-side on purpose: this is an Inertia SPA without SSR,
        // so anything the React <Head> adds is invisible to crawlers that do
        // not execute JavaScript. The `inertia` attribute lets Inertia's head
        // manager take these over during client-side navigation instead of
        // duplicating them.
        $seo = $page['props']['seo'] ?? [];
        $schema = $page['props']['organisationSchema'] ?? null;
        $title = $seo['title'] ?? config('app.name', 'WorldWide Recruitment Services');
        $description = $seo['description'] ?? '';
        $canonical = $seo['canonical'] ?? url()->current();
        $image = $seo['image'] ?? asset('resources/images/logo.png');
        $ogType = $seo['type'] ?? 'website';
        $siteName = $seo['siteName'] ?? 'WorldWide Recruitment Services Pvt. Ltd.';
        $ogLocale = $seo['locale'] ?? 'en_US';
    @endphp

    {{-- Only the title is handed to Inertia; the rest are updated in place
         by SiteLayout so there is exactly one of each in the document. --}}
    <title inertia>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <link rel="canonical" href="{{ $canonical }}">

    <meta name="author" content="{{ $siteName }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">

    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $image }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:locale" content="{{ $ogLocale }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $image }}">

    @if($schema)
        <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endif

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
