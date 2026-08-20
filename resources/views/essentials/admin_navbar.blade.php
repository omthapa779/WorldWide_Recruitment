<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') · WRS Console</title>
    <link rel="stylesheet" href="{{ asset('resources/css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('resources/favicon.ico') }}" type="image/x-icon">
</head>
<body class="adm">

@php
    $nav = [
        ['route' => 'admin.dashboard',   'match' => 'admin.dashboard', 'icon' => 'ri-dashboard-line',       'label' => 'Dashboard'],
        ['route' => 'admin.jobs.index',  'match' => 'admin.jobs.*',    'icon' => 'ri-briefcase-4-line',     'label' => 'Jobs'],
        ['route' => 'admin.news.index',  'match' => 'admin.news.*',    'icon' => 'ri-newspaper-line',       'label' => 'News & Events'],
        ['route' => 'admin.hero.index',  'match' => 'admin.hero.*',    'icon' => 'ri-image-edit-line',      'label' => 'Hero Section'],
        ['route' => 'admin.ads.index',   'match' => 'admin.ads.*',     'icon' => 'ri-advertisement-line',   'label' => 'Advertisement'],
    ];
@endphp

<div class="adm-shell">
    <aside class="adm-sidebar" id="admSidebar">
        <div class="adm-brand">
            <img src="{{ asset('resources/images/logo.png') }}" alt="">
            <span class="adm-brand-text">
                <span class="adm-brand-name">WorldWide Recruitment</span>
                <span class="adm-brand-sub">Console</span>
            </span>
        </div>

        <nav class="adm-nav">
            <div class="adm-nav-label">Content</div>
            @foreach($nav as $item)
                <a href="{{ route($item['route']) }}"
                   class="adm-nav-link {{ request()->routeIs($item['match']) ? 'is-active' : '' }}">
                    <i class="{{ $item['icon'] }}"></i>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach

            <div class="adm-nav-label">Public site</div>
            <a href="{{ route('home') }}" target="_blank" rel="noopener" class="adm-nav-link">
                <i class="ri-external-link-line"></i>
                <span>View website</span>
            </a>
        </nav>

        <div class="adm-sidebar-foot">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="adm-logout">
                    <i class="ri-logout-box-line"></i>
                    <span>Sign out</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="adm-backdrop" id="admBackdrop"></div>

    <div class="adm-body">
        <header class="adm-topbar">
            <div class="adm-topbar-left">
                <button type="button" class="adm-burger" id="admBurger" aria-label="Toggle navigation" aria-expanded="false">
                    <i class="ri-menu-line"></i>
                </button>
                <nav class="adm-crumb" aria-label="Breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Console</a>
                    <span class="adm-crumb-sep" aria-hidden="true">/</span>
                    <span class="adm-crumb-current">@yield('crumb', View::getSection('title', 'Dashboard'))</span>
                </nav>
            </div>
            <div class="adm-topbar-right">
                <span class="adm-env">{{ strtoupper(app()->environment()) }}</span>
                <a href="{{ route('home') }}" target="_blank" rel="noopener" class="adm-btn is-sm">
                    <i class="ri-external-link-line"></i> Site
                </a>
            </div>
        </header>

        <main class="adm-content">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function () {
        // Both the English editor and the optional Japanese one.
        $('#summernote, #summernote_ja').summernote({
            height: 260,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']],
            ]
        });
    });

    // Off-canvas navigation on narrow screens.
    (function () {
        var sidebar = document.getElementById('admSidebar');
        var burger = document.getElementById('admBurger');
        var backdrop = document.getElementById('admBackdrop');
        if (!sidebar || !burger || !backdrop) return;

        function setOpen(open) {
            sidebar.classList.toggle('is-open', open);
            backdrop.classList.toggle('is-open', open);
            burger.setAttribute('aria-expanded', open ? 'true' : 'false');
        }

        burger.addEventListener('click', function () {
            setOpen(!sidebar.classList.contains('is-open'));
        });
        backdrop.addEventListener('click', function () { setOpen(false); });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') setOpen(false);
        });
    })();
</script>
@stack('scripts')
</body>
</html>
