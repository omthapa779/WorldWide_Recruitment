@extends('essentials.navbar')
@section('title', 'Services')
@section('content')
<section class="service_page w_100 h_fc bg_white p_v10 primary_font flex_cl justify_fe">
    <div class="service_page_hero w_100 h_fc grid p_s7 col_2 mtop_10vh">
        <x-section-title text="Our Company's Services" />
        <p class="font_w500">At WorldWide Recruitment Services, we specialize in providing reliable, ethical, and professional manpower solutions that connect Nepalese talent with international employers.
            From skilled labor to executive placements, our services cover a wide range of sectors including construction, hospitality, security, and more. Whether you're a company looking for dedicated 
            workers or an individual seeking overseas opportunities, our end-to-end recruitment services are designed to ensure smooth deployment, legal compliance, and long-term success.</p>
    </div>

    <div class="service_description_holder w_100 h_fc grid col_3 justify_sb gap_4vw p_s7 mtop_10vh">
        <div class="service_page_card w_100 h_100 bg_white_light bradius_s pos_relative">
            <img src="{{ asset('./resources/images/services/overseas_recruitment.jpg') }}" alt="overseas recruitment" class="w_100 h_35vh obj_cover bradius_s">
            <div class="service_card_content">
                <h3 class="color_primary">Overseas Recruitment</h3>
                <h5 class="mtop_2vh font_w500">Professional recruitment services connecting skilled workers with international opportunities across various sectors. We handle job matching, candidate screening, and placement coordination to ensure successful employment outcomes.</h5>
            </div>
        </div>
        
        <div class="service_page_card w_100 h_100 bg_white_light bradius_s pos_relative">
            <img src="{{ asset('./resources/images/services/documentation.jpg') }}" alt="Documentation Support" class="w_100 h_35vh obj_cover bradius_s">
            <div class="service_card_content">
                <h3 class="color_primary">Documentation Support</h3>
                <h5 class="mtop_2vh font_w500">Comprehensive documentation assistance including visa processing, work permits, and legal paperwork. We ensure all requirements are met for smooth international deployment.</h5>
            </div>
        </div>
        
        <div class="service_page_card w_100 h_100 bg_white_light bradius_s pos_relative">
            <img src="{{ asset('./resources/images/services/deployment.jpg') }}" alt="deployment services" class="w_100 h_35vh obj_cover bradius_s">
            <div class="service_card_content">
                <h3 class="color_primary">Deployment Services</h3>
                <h5 class="mtop_2vh font_w500">End-to-end deployment support including pre-departure orientation, travel arrangements, and arrival coordination. We ensure a seamless transition for workers to their new workplace.</h5>
            </div>
        </div>
    </div>

    <div class="service_stats w_100 h_fc grid col_3 p_s7 mtop_2vh gap_2vw">
        <div class="stat_card bg_blue bradius_s p_v5 p_s2 text_ac">
            <h2 class="color_white">500+</h2>
            <p class="color_white_light">Successful Placements</p>
        </div>
        <div class="stat_card bg_orange bradius_s p_v5 p_s2 text_ac">
            <h2 class="color_white">10+</h2>
            <p class="color_white_light">Countries Served</p>
        </div>
        <div class="stat_card bg_blue bradius_s p_v5 p_s2 text_ac">
            <h2 class="color_white">95%</h2>
            <p class="color_white_light">Client Satisfaction</p>
        </div>
    </div>
</section>
@endsection