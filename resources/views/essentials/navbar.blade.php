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
        <nav class="nav_links flex h_100 align_c gap_1vw">
            <h4 class="font_w500"><a href="/" class="nav_link"><i class="ri-home-4-line"></i><span>Home</span></a></h4>
            <h4 class="font_w500"><a href="/about-us" class="nav_link"><i class="ri-user-3-line"></i><span>About</span></a></h4>
            <h4 class="font_w500"><a href="/services" class="nav_link"><i class="ri-briefcase-4-line"></i><span>Services</span></a></h4>
            <h4 class="font_w500"><a href="#" class="nav_link"><i class="ri-suitcase-fill"></i><span>Jobs</span></a></h4>
            <h4 class="font_w500"><a href="#" class="nav_link"><i class="ri-newspaper-line"></i><span>News & Events</span></a></h4>
            <h4 class="font_w500"><a href="/contact" class="nav_link"><i class="ri-contacts-book-line"></i><span>Contact</span></a></h4>
            <button class="menu_toggle" id="menuToggle" aria-label="Open Menu">
                <i class="ri-menu-3-line"></i>
            </button>
        </nav>
    </section>
    
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