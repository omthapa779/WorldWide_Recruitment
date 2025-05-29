@extends('essentials.navbar')
@section('title', 'About Us')
@section('content')
<section class="about_us_hero w_100 h_100vh primary_font bg_white flex_cl p_v10">
    <div class="about_hero w_100 h_fc p_s7 flex_cl gap_4vw mtop_10vh">
        <div class="about_page_title w_100 h_fc grid col_2 gap_4vw">
            <h2><span class="secondary_font color_primary">Introduction</span> to WorldWide <br> Recruitment Services</h2>

            <p class="font_w500">WRS Nepal is a trusted recruitment agency connecting Nepalese workers with reliable job opportunities abroad. We specialize in overseas employment for sectors like construction, hospitality, and 
            security—ensuring safe, legal, and rewarding placements for our clients.</p>
        </div>
        <div class="about_services w_100 h_fc grid col_3 gap_2vw">
            <div class="about_service_card w_100 h_20vh bg_white bradius_s grid gap_2vw">
                <div class="circle_orange w_100 h_100 circle bg_orange opacity_80 flex justify_c align_c">
                    <h2><i class="ri-earth-line color_white font_w500"></i></h2>
                </div>

                <div class="service_about_content w_100 h_100 flex_cl justify_c">
                    <h3>Overseas <br> Recruitment</h3>
                </div>
            </div>
            <div class="about_service_card w_100 h_20vh bg_white bradius_s grid gap_2vw">
                <div class="circle_orange w_100 h_100 circle bg_orange opacity_80 flex justify_c align_c">
                    <h2><i class="ri-file-paper-2-line color_white font_w500"></i></h2>
                </div>

                <div class="service_about_content w_100 h_100 flex_cl justify_c">
                    <h3>Documentation <br> Support</h3>
                </div>
            </div>
             <div class="about_service_card w_100 h_20vh bg_white bradius_s grid gap_2vw">
                <div class="circle_orange w_100 h_100 circle bg_orange opacity_80 flex justify_c align_c">
                    <h2><i class="ri-flight-takeoff-line color_white font_w500"></i></h2>
                </div>

                <div class="service_about_content w_100 h_100 flex_cl justify_c">
                    <h3>Deployment <br> & Guidance</h3>
                </div>
            </div>
        </div>
        <div class="about_hero_image w_100 h_35vh">
            <img src="{{ asset('./resources/images/services/overseas_recruitment.jpg') }}" alt="" class="w_100 h_100 obj_cover">
        </div>
    </div>
</section>

@include('sections.WhyChooseUs')

@endsection