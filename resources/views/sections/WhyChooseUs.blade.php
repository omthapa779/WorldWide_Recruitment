
<section class="why_choose_us w_100 h_fc primary_font p_s7 p_v7 bg_white flex_cl justify_c gap_4vw">
    <x-section-title text="Why Choose Us ?" />

    <div class="why_choose_holder w_100 h_fc grid col_3 gap_2vw align_c">
        <!-- Stats Cards -->
        <div class="stats_cards w_100 h_100 flex_cl gap_2vw justify_sb">
            <div class="stat_card h_100 flex align_c gap_2vw bg_orange bradius_s p_s4 shadow_sm">
                <h2><i class="ri-award-fill color_white font_w400"></i></h2>
                <div>
                    <h2 class="color_white font_w700" data-count="3">0</h2>
                    <h4 class="color_white font_w400">Years of Experience</h4>
                </div>
            </div>
            <div class="stat_card h_100 flex align_c gap_2vw bg_blue bradius_s p_s4 shadow_sm">
                <h2><i class="ri-earth-fill color_white font_w400"></i></h2>
                <div>
                    <div class="w_100 h_fc flex align_c">
                        <h2 class="color_white font_w700" data-count="20">0</h2>
                        <h2 class="color_white font_w700">+</h2>
                    </div>
                    <h4 class="color_white font_w400">Countries Served</h4>
                </div>
            </div>
            <div class="stat_card h_100 flex align_c gap_2vw bg_dark bradius_s p_s4 shadow_sm">
                <h2><i class="ri-user-smile-fill color_white font_w400"></i></h2>
                <div>
                    <div class="w_100 h_fc flex align_c">
                        <h2 class="color_white font_w700" data-count="500">0</h2>
                        <h2 class="color_white font_w700">+</h2>
                    </div>
                    <h4 class="color_white font_w400">Happy Clients</h4>
                </div>
            </div>
        </div>

        <!-- Image -->
        <div class="why_choose_image_holder w_100 h_100 flex_cl justify_c align_c">
            <img src="{{ asset('./resources/images/why_us.jpg') }}" alt="Why Choose Us" class="w_100 h_100 bradius_s shadow_md obj_cover">
        </div>

        <!-- Features List -->
        <div class="why_choose_us_content w_100 h_100 flex_cl justify_sb gap_1vw">
            <div class="feature_item flex align_c gap_1vw">
                <h3><i class="ri-shield-check-fill color_blue"></i></h3>
                <h4 class="font_w500">Government-Licensed</h4>
            </div>
            <div class="feature_item flex align_c gap_1vw">
                <h3><i class="ri-eye-2-fill color_orange"></i></h3>
                <h4 class="font_w500">Transparent Process</h4>
            </div>
            <div class="feature_item flex align_c gap_1vw">
                <h3><i class="ri-hand-heart-fill color_green"></i></h3>
                <h4 class="font_w500">Ethical Recruitment</h4>
            </div>
            <div class="feature_item flex align_c gap_1vw">
                <h3><i class="ri-customer-service-2-fill color_blue"></i></h3>
                <h4 class="font_w500">Support at Every Step</h4>
            </div>
            <div class="feature_item flex align_c gap_1vw">
                <h3><i class="ri-chat-1-fill color_orange"></i></h3>
                <h4 class="font_w500">Testimonials from Candidates</h4>
            </div>
        </div>
    </div>
</section>

<style>
@media (max-width: 1000px) {
    .why_choose_holder { grid-template-columns: 1fr; gap: 3vw; }
    .why_choose_image_holder img { max-width: 100%; }
}
</style>