
@extends('essentials.navbar')
@section('title', 'Contact')
@section('content')
<section class="contact_page w_100 h_fc bg_white p_v10 primary_font flex_cl justify_fe">
    <div class="contact_page_hero w_100 h_fc grid p_s7 col_2 mtop_10vh">
        <x-section-title text="Get in Touch" />
        <p class="font_w500">Have questions about our recruitment services? Looking to start your overseas career journey? 
        Get in touch with WorldWide Recruitment Services today. Our team is ready to assist you with any inquiries.</p>
    </div>

    <div class="contact_info_holder w_100 h_fc grid col_3 justify_sb gap_4vw p_s7 mtop_10vh">
        <div class="contact_info_card w_100 h_fc bg_white_light bradius_s p_v5 p_s2">
            <div class="contact_icon bg_blue w_fc bradius_s p_v2 p_s2">
                <i class="ri-map-pin-2-fill color_white"></i>
            </div>
            <h3 class="color_primary mtop_2vh">Our Location</h3>
            <p class="mtop_2vh">Kathmandu, Nepal<br>Near Koteshwor Chowk</p>
        </div>
        
        <div class="contact_info_card w_100 h_fc bg_white_light bradius_s p_v5 p_s2">
            <div class="contact_icon bg_orange w_fc bradius_s p_v2 p_s2">
                <i class="ri-phone-fill color_white"></i>
            </div>
            <h3 class="color_primary mtop_2vh">Phone Number</h3>
            <p class="mtop_2vh">+977-01-4545454<br>+977-9851234567</p>
        </div>
        
        <div class="contact_info_card w_100 h_fc bg_white_light bradius_s p_v5 p_s2">
            <div class="contact_icon bg_blue w_fc bradius_s p_v2 p_s2">
                <i class="ri-mail-fill color_white"></i>
            </div>
            <h3 class="color_primary mtop_2vh">Email Address</h3>
            <p class="mtop_2vh">info@wrs.com.np<br>careers@wrs.com.np</p>
        </div>
    </div>

    @include('sections.contact')
</section>
@endsection