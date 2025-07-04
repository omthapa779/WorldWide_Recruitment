<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - WorldWide Recruitment Services</title>
    <link rel="stylesheet" href="{{ asset('../resources/css/Global.css') }}">
    <link rel="stylesheet" href="{{ asset('../resources/css/Specifics.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('./resources/favicon.ico') }}" type="image/x-icon">
</head>
<body class="admin_body">
    <!-- Admin Navbar -->
    <section id="adminNavbar" class="navbar_sticky w_100 h_10vh bg_primary p_s7 primary_font flex justify_sb align_c">
        <div class="navbar_logo flex align_c gap_1vw h_100">
            <img src="{{ asset('./resources/images/logo.png') }}" alt="Logo" class="navbar_logo_img h_7vh obj_contain">
            <h3 class="opacity_100 font_w700 color_primary">WorldWide Recruitment <br> Services Pvt. Ltd.</h3>
        </div>
        <button class="menu_toggle" id="adminMenuToggle" aria-label="Toggle Menu">
            <h2><i class="ri-menu-3-line color_white"></i></h2>
        </button>
    </section>

    <!-- Mobile Menu -->
    <div id="adminMobileMenu" class="mobile_menu_fullscreen">
        <div class="mobile_menu_content flex_cl justify_c align_c gap_4vh primary_font">
            <a href="{{ route('admin.dashboard') }}" class="mobile_link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <h2 class="color_white font_w500"><i class="ri-dashboard-line color_white"></i> Dashboard</h2>
            </a>
            <a href="{{ route('admin.hero.index') }}" class="mobile_link {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
                <h2 class="color_white font_w500"><i class="ri-image-edit-line color_white"></i> Hero Management</h2>
            </a>
            <a href="{{ route('admin.ads.index') }}" class="mobile_link {{ request()->routeIs('admin.ads.*') ? 'active' : '' }}">
                <h2 class="color_white font_w500"><i class="ri-advertisement-line color_white"></i> Ads Management</h2>
            </a>
            <a href="{{ route('admin.news.index') }}" class="mobile_link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <h2 class="color_white font_w500"><i class="ri-newspaper-line color_white"></i> News & Events</h2>
            </a>
            <a href="{{ route('admin.jobs.index') }}" class="mobile_link {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
                <h2 class="color_white font_w500"><i class="ri-briefcase-4-line color_white"></i> Jobs Management</h2>
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" class="m_0">
                @csrf
                <button type="submit" class="mobile_link">
                    <h2 class="color_white font_w500"><i class="ri-logout-box-line color_white"></i> Logout</h2>
                </button>
            </form>
        </div>
    </div>

<div class="admin_main_container flex">
    <!-- Sidebar -->
    <aside class="admin_sidebar w_20 h_100vh bg_white flex_cl justify_sb p_v5 primary_font" id="adminSidebar">
        <!-- Top Section -->
        <div class="sidebar_top w_100 flex_cl gap_2vw">
            <!-- Logo -->
            <div class="flex align_c gap_1vw p_s2">
                <img src="{{ asset('./resources/images/logo.png') }}" alt="Logo" class=" h_7vh obj_contain">
                <h4 class="color_primary">WorldWide Recruitment <br> Services Pvt. Ltd.</h4>
            </div>

            <!-- Navigation -->
            <nav class="sidebar_nav w_100 flex_cl gap_1vh">
                <a href="{{ route('admin.dashboard') }}" class="sidebar_link w_100 p_s2 p_v2 flex align_c gap_1vw {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="ri-dashboard-line"></i>
                    <h5>Dashboard</h5>
                </a>
                <a href="{{ route('admin.hero.index') }}" class="sidebar_link w_100 p_s2 p_v2 flex align_c gap_1vw {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
                    <i class="ri-image-edit-line"></i>
                    <h5>Hero Management</h5>
                </a>

                <a href="{{ route('admin.ads.index') }}" class="sidebar_link w_100 p_s2 p_v2 flex align_c gap_1vw {{ request()->routeIs('admin.ads.*') ? 'active' : '' }}">
                    <i class="ri-advertisement-line"></i>
                    <h5>Ads Management</h5>
                </a>

                <a href="{{ route('admin.news.index') }}" class="sidebar_link w_100 p_s2 p_v2 flex align_c gap_1vw {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                    <i class="ri-newspaper-line"></i>
                    <h5>News & Events</h5>
                </a>

                <a href="{{ route('admin.jobs.index') }}" class="sidebar_link w_100 p_s2 p_v2 flex align_c gap_1vw {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
                    <i class="ri-briefcase-4-line"></i>
                    <h5>Jobs Management</h5>
                </a>
            </nav>
        </div>

        <!-- Bottom Section -->
        <div class="sidebar_bottom w_100 p_s2">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar_link w_100 p_s2 p_v2 flex align_c gap_1vw color_orange">
                    <i class="ri-logout-box-line"></i>
                    <h5>Logout</h5>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin_main w_100 h_fc bg_white primary_font p_v7">
        <!-- Page Content -->
        <div class="admin_content w_100 h_fc overflow_y p_s4">
            @yield('content')
        </div>
    </main>
</div>
    <script src="https://unpkg.com/gsap@3.12.2/dist/gsap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']],
            ]
        });
    });
    </script>
    <script src="https://unpkg.com/gsap@3.12.2/dist/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/lenis@1.3.3/dist/lenis.min.js"></script>
    <script src="{{ asset('./resources/js/script.js') }}"></script>
    <script>
        // Mobile Menu Toggle
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('adminSidebar').classList.toggle('show_sidebar');
            this.classList.toggle('active');
        });
    </script>
</body>
</html>