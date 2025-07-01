<section class="services_home w_100 h_fc bg_white primary_font p_s7 flex_cl justify_c gap_2vw">
    <x-section-title text="Our Services" />

    <div class="services_holder pos_relative w_100 h_fc grid col_3 justify_sb gap_4vw">
        <a href="{{ route('services') }}" class="service_link w_100 h_fc">
            <div class="service_card pos_relative w_100 h_35vh">
                <img src="{{ asset('./resources/images/services/overseas_recruitment.jpg') }}" 
                     alt="Overseas Recruitment" 
                     class="w_100 h_100 obj_cover service_image pos_absolute">
                <div class="overlay pos_absolute w_100 h_100 bg_orange opacity_80"></div>
                <div class="service_content w_100 h_100 flex_cl justify_fe p_v5">
                    <div class="service_text flex_cl align_c">
                        <h2 class="service_icon"><i class="ri-global-line color_white font_w400"></i></h2>
                        <h2 class="color_white text_ac">Overseas <br>Recruitment</h2>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('services') }}" class="service_link w_100 h_fc">
            <div class="service_card pos_relative w_100 h_35vh">
                <img src="{{ asset('./resources/images/services/documentation.jpg') }}" 
                     alt="Documentation" 
                     class="w_100 h_100 obj_cover service_image pos_absolute">
                <div class="overlay pos_absolute w_100 h_100 bg_dark"></div>
                <div class="service_content w_100 h_100 flex_cl justify_fe p_v5">
                    <div class="service_text flex_cl align_c">
                        <h2 class="service_icon"><i class="ri-file-text-line color_white font_w400"></i></h2>
                        <h2 class="color_white text_ac">Documentation</h2>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('services') }}" class="service_link w_100 h_fc">
            <div class="service_card pos_relative w_100 h_35vh">
                <img src="{{ asset('./resources/images/services/deployment.jpg') }}" 
                     alt="Deployment" 
                     class="w_100 h_100 obj_cover service_image pos_absolute">
                <div class="overlay pos_absolute w_100 h_100 bg_blue"></div>
                <div class="service_content w_100 h_100 flex_cl justify_fe p_v5">
                    <div class="service_text flex_cl align_c">
                        <h2 class="service_icon"><i class="ri-plane-line color_white font_w400"></i></h2>
                        <h2 class="color_white text_ac">Deployment</h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
</section>