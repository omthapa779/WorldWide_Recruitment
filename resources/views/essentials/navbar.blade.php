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
    <section id="navbar" class="navbar_sticky w_100 h_10vh bg_white_light p_s7 primary_font flex justify_sb align_c opacity_80">
        <h3 class="opacity_100">WorldWide <br>Recruitment Services</h3>

        <div class="nav_links flex h_100 align_c gap_1vw">
            <a href="#" class="nav_link"><h3 class="font_w500 opacity_100">Home</h3></a>
            <a href="#" class="nav_link"><h3 class="font_w500 opacity_100">About</h3></a>
            <a href="#" class="nav_link"><h3 class="font_w500 opacity_100">Services</h3></a>
            <a href="#" class="nav_link"><h3 class="font_w500 opacity_100">Jobs</h3></a>
            <a href="#" class="nav_link"><h3 class="font_w500 opacity_100">News & Events</h3></a>
            <a href="#" class="nav_link"><h3 class="font_w500 opacity_100">Contact</h3></a>
            <a href="#"><h2><i class="ri-menu-line font_w500"></i></h2></a>
        </div>
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