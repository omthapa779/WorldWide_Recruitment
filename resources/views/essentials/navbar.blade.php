<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield ('title', ' ') - WorldWide Recruitment Services </title>
    <link rel="stylesheet" href="{{ asset('../resources/css/Global.css') }}">
    <link rel="stylesheet" href="{{ asset('../resources/css/Specifics.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
</head>
<body>
    <section id="navbar" class="navbar_sticky w_100 h_10vh bg_white_light p_s7 primary_font flex justify_sb align_c glass_nav">
        <div class="navbar_logo flex align_c gap_1vw">
            <img src="{{ asset('./resources/images/logo.png') }}" alt="Logo" class="navbar_logo_img" style="height:2.5rem;">
            <h3 class="opacity_100 font_w700 color_primary">WorldWide<br>Recruitment</h3>
        </div>
        <nav class="nav_links flex h_100 align_c gap_2vw">
            <h4 class="font_w500"><a href="{{ route('home') }}" class="nav_link"><i class="ri-home-4-line"></i><span>Home</span></a></h4>
            <h4 class="font_w500"><a href="{{ route('about') }}" class="nav_link"><i class="ri-user-3-line"></i><span>About</span></a></h4>
            <h4 class="font_w500"><a href="{{ route('services') }}" class="nav_link"><i class="ri-briefcase-4-line"></i><span>Services</span></a></h4>
            <h4 class="font_w500"><a href="{{ route('jobs.index') }}" class="nav_link"><i class="ri-suitcase-fill"></i><span>Jobs</span></a></h4>
            <h4 class="font_w500"><a href="{{ route('news.index') }}" class="nav_link"><i class="ri-newspaper-line"></i><span>News & Events</span></a></h4>
            <h4 class="font_w500"><a href="{{ route('contact') }}" class="nav_link"><i class="ri-contacts-book-line"></i><span>Contact</span></a></h4>
            <button class="menu_toggle" id="menuToggle" aria-label="Toggle Menu">
                <i class="ri-menu-3-line"></i>
            </button>
        </nav>
    </section>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile_menu_fullscreen">
        <div class="mobile_menu_content flex_cl justify_c align_c gap_2vw primary_font">
            <a href="{{ route('home') }}" class="mobile_link"><h2 class="color_white font_w500"><i class="ri-home-4-line color_white"></i> Home</h2></a>
            <a href="{{ route('about') }}" class="mobile_link"><h2 class="color_white font_w500"><i class="ri-user-3-line color_white"></i> About</h2></a>
            <a href="{{ route('services') }}" class="mobile_link"><h2 class="color_white font_w500"><i class="ri-briefcase-4-line color_white"></i> Services</h2></a>
            <a href="{{ route('jobs.index') }}" class="mobile_link"><h2 class="color_white font_w500"><i class="ri-suitcase-fill color_white"></i> Jobs</h2></a>
            <a href="{{ route('news.index') }}" class="mobile_link"><h2 class="color_white font_w500"><i class="ri-newspaper-line color_white"></i> News & Events</h2></a>
            <a href="{{ route('contact') }}" class="mobile_link"><h2 class="color_white font_w500"><i class="ri-contacts-book-line color_white"></i> Contact</h2></a>
        </div>
    </div>
    
    <div class="main_container w_100 h_fc">
        @yield('content')
    </div>

    @include('essentials.footer')
        
    <script src="https://unpkg.com/gsap@3.12.2/dist/gsap.min.js"></script>
    <script src="https://unpkg.com/gsap@3.12.2/dist/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/lenis@1.3.3/dist/lenis.min.js"></script>
    <script src="{{ asset('./resources/js/script.js') }}"></script>
</body>
</html>