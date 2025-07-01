@extends('essentials.navbar')
@section('title', 'Home')
@section('content')

<!-- hero section -->
<section class="hero_section w_100 h_100vh bg_white primary_font" id="hero" >
    <div class="hero_content w_100 h_100 grid col_2 gap_2vw">
        <div class="right_hero w_100 h_100 flex_cl justify_sb p_s7 p_v7">
            
            <div class="w_100 h_fc flex gap_1vw align_c">
                <img src="{{ asset('./resources/images/logo.png') }}" alt="" class="h_10vh obj_contain">
                <h2 class="color_primary">WorldWide Recruitment <br> Services Pvt. Ltd.</h2>
            </div>

            <div class="menus w_100 flex gap_2vw ">
                <div class="line h_100 bg_light"></div>
                <div class="menu_links flex_cl gap_1vw">
                    <a href="/"><h3 class="font_w500 w_100 color_light">Home</h3></a>
                    <a href="/about-us"><h3 class="font_w500 w_100 color_light">About</h3></a>
                    <a href="/services"><h3 class="font_w500 w_100 color_light">Services</h3></a>
                    <a href="/jobs"><h3 class="font_w500 w_100 color_light">Jobs</h3></a>
                    <a href="/news"><h3 class="font_w500 w_100 color_light">News & Events</h3></a>
                    <a href="/contact"><h3 class="font_w500 w_100 color_light">Contact</h3></a>
                </div>
            </div>

            <h5>Scroll for More <i class="ri-arrow-down-s-line"></i></h5>
        </div>
        @if($hero && $hero->image_path)
            <img src="{{ asset('storage/' . $hero->image_path) }}" 
                alt="Hero Image | WorldWide Recruitment Services" 
                class="hero_image w_100 h_100 obj_cover">
        @else
            <img src="{{ asset('./resources/images/hero_japan.jpg') }}" 
                alt="Japan | WorldWide Recruitment Services" 
                class="hero_image w_100 h_100 obj_cover">
        @endif    
    </div>
    <div class="license_number_holder w_100 h_100 flex p_v7 justify_fe">
        <div class="license_number w_fc flex align_c bg_blue">
            <h3 class="color_white font_w400">License No: 1617-079/80</h3>
        </div>
    </div>
    <div class="hero_holder w_100 h_100 flex justify_c align_c">
        <div class="hero_box bg_orange flex_cl justify_c align_c gap_1vw">
            @if($hero = \App\Models\Hero::getActive())
                <h1>{{ $hero->title }}</h1>
                <div class="button_holder w_100 flex_cl">
                    <x-button href="/contact">
                        <h3 class="font_w500 color_white">{{ $hero->button_cta }}</h3>
                    </x-button>
                     <x-button href="{{ asset('./resources/WorldWide_Company_Profile.pdf') }}"><h3 class="font_w500 color_white">Company's Profile</h3></x-button>
                </div>
            @else
                <!-- Fallback content -->
                <h1>Your Journey to Overseas Jobs Starts Here - With WRS Nepal</h1>
                <div class="button_holder w_100 flex_cl">
                    <x-button href="/contact">
                        <h3 class="font_w500 color_white">Get Started</h3>
                    </x-button>
                    <x-button href="{{ asset('./resources/WorldWide_Company_Profile.pdf') }}"><h3 class="font_w500 color_white">Company's Profile</h3></x-button>
                </div>
            @endif
        </div>
    </div>
</section>


<!-- news and events section -->
@include('sections.news_events')



<!-- who are we section -->
<section class="who_are_we w_100 h_fc bg_white grid col_2 p_s7 p_v7 align_fe gap_10vw primary_font">
    <div class="about_section w_100 h_100 flex_cl justify_c gap_1vw">
        <x-section-title text="Who are We ?" />

        <p class="font_w500">WRS Nepal is a trusted recruitment agency connecting Nepalese workers with reliable job opportunities abroad. We specialize in overseas employment for sectors like construction, hospitality, and 
            security—ensuring safe, legal, and rewarding placements for our clients.
        
        <br>
        <h4>Specialize in connecting skilled workers from Nepal with opportunities in top destinations like Dubai, Japan, Qatar, and many more! </h4>
        </p>

         <div class="button_holder w_40 flex_cl ">
            <x-button href="/about-us" variant="secondary" class="opacity_80"><h3 class=" color_white">Learn More</h3></x-button>
        </div>
    </div>

     <img src="{{ asset('./resources/images/About_page.jpg') }}" alt="About | WorldWide Recruitment Services" class="who_are_we_image w_100 h_100 obj_contain bradius_s">

</section>



<!-- services -->
@include('sections.services')

<!-- jobs sections -->
@include('sections.featured_jobs')

<!-- advertisement Section -->
@include('sections.ad')


<!-- why choose us section -->
@include('sections.WhyChooseUs')


<!-- contacts -->
@include('sections.contact')
<script>
    document.body.classList.add('is_home');
</script>
@endsection