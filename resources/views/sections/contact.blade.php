<section class="contact w_100 h_100vh bg_white primary_font flex_cl p_s7 p_v10 gap_2vw justify_c">
    <div class="contact_title flex justify_sb">
        <x-section-title text="Get In Touch" />
        <div class="button_holder w_20 flex_cl ">
            <x-button href="/dashboard" variant="secondary" class="opacity_80"><h3 class=" color_white">Contact Options</h3></x-button>
        </div>
    </div>

    <div class="contact_holder w_100 h_fc grid col_2 gap_4vw">
        <div class="contact_form w_100 h_fc flex_cl gap_1vw">
            <form action="#" class="flex_cl gap_1vw">
                <input type="text" class="form_input primary_font w_100 bg_white_light" placeholder="Full Name">
                <input type="text" class="form_input primary_font w_100 bg_white_light" placeholder="Contact Number">
                <input type="text" class="form_input primary_font w_100 bg_white_light" placeholder="Email Address">
                <select name="referal" class="form_input primary_font bg_white_light w_100">
                    <option value="" disabled selected hidden>Inquiry Type</option>
                    <option value="Facebook / Instagram"> General Inquiries</option>
                    <option value="Friends & Family">Company's Details</option>
                    <option value="other"> Help & Support</option>
                </select>
                <textarea name="message" class="form_input bg_white_light w_100 primary_font" rows="4" placeholder="Your Message here"></textarea>
                <x-button type="submit">
                    <h3 class="color_white font_w500">Submit</h3>
                </x-button>
            </form>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7062.568262874229!2d85.338892!3d27.739381!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1946721c8fbb%3A0x922c1a2435490bc3!2sUniversal%20Cafe!5e0!3m2!1sen!2snp!4v1748427920655!5m2!1sen!2snp" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>