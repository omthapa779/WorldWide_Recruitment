<section class="contact w_100 h_fc bg_white primary_font flex_cl p_s7 p_v10 gap_2vw justify_c">
    <div class="contact_title flex justify_sb">
        <x-section-title text="Get In Touch" />
        <div class="button_holder w_20 flex_cl ">
            <x-button href="/contact" variant="secondary" class="opacity_80"><h3 class=" color_white">Contact Options</h3></x-button>
        </div>
    </div>

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    <div class="contact_holder w_100 h_fc grid col_2 gap_4vw">
        <div class="contact_form w_100 h_fc flex_cl gap_1vw">
            <form action="{{ route('contact.send') }}" method="POST" class="flex_cl gap_1vw">
                @csrf
                <input type="text" class="form_input primary_font w_100 bg_white_light" placeholder="Full Name" name="name">
                <input type="text" class="form_input primary_font w_100 bg_white_light" placeholder="Contact Number" name="contact">
                <input type="email" class="form_input primary_font w_100 bg_white_light" placeholder="Email Address" name="email">
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
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56502.91421938035!2d85.25245413124996!3d27.734814200000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19001bb93d65%3A0x9f733cc944a06193!2sWorldwide%20Recruitment%20Services%20Pvt.%20Ltd.!5e0!3m2!1sen!2snp!4v1750745616561!5m2!1sen!2snp" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>