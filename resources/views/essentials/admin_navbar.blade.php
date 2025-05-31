<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - WorldWide Recruitment Services</title>
    <link rel="stylesheet" href="{{ asset('../resources/css/Global.css') }}">
    <link rel="stylesheet" href="{{ asset('../resources/css/Specifics.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
</head>
<body>
<div class="mobile_menu w_100 h_10vh bg_white_light flex justify_sb align_c p_s7 primary_font">
        <h3>WorldWide <br> Recruitment Servicess</h3>

         <button class="menu_extended" id="menuToggle" aria-label="Open Menu">
            <h2><i class="ri-menu-3-line"></i></h2>
        </button>
</div>

<div class="admin_main_container flex">
    <!-- Sidebar -->
    <aside class="admin_sidebar w_20 h_100vh bg_white flex_cl justify_sb p_v5 primary_font" id="adminSidebar">
        <!-- Top Section -->
        <div class="sidebar_top w_100 flex_cl gap_2vw">
            <!-- Logo -->
            <div class="flex_cl align_c gap_1vh p_s2">
                <h4 class="color_primary">WorldWide <br> Recruitment Services</h4>
            </div>

            <!-- Navigation -->
            <nav class="sidebar_nav w_100 flex_cl gap_1vh">
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