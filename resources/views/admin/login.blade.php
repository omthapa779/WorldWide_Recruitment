@extends('essentials.navbar')
@section('title', 'Admin Login')
@section('content')
<section class="admin_login w_100 h_90vh bg_white primary_font flex justify_c align_c pos_relative">
    <!-- Background pattern -->
    <div class="login_bg_pattern"></div>

    <div class="login_container w_90 h_70vh grid col_2 bradius_s">
        <!-- Left side - Image -->
        <div class="login_image_side w_100 h_100 flex_cl justify_c align_c">
            <img src="{{ asset('./resources/images/hero_japan.jpg') }}" alt="Admin Login" class="w_100 h_100 obj_cover">
        </div>

        <!-- Right side - Login Form -->
        <div class="login_form_side w_100 h_100 bg_white_light p_v5 p_s7 flex_cl justify_c">
            <div class="form_header text_ac">
                <h2><i class="ri-admin-line admin_icon"></i></h2>
                <h2 class="color_primary">Admin Login</h2>
                <p class="color_light mtop_2vh">Enter your credentials to access the admin panel</p>
            </div>
            
            @if($errors->any())
                <div class="error_message bg_orange color_white p_v2 p_s2 bradius_s mtop_2vh">
                    <h3 class="font_w400"><i class="ri-error-warning-line"></i>  {{ $errors->first() }}</h3>
                   
                </div>
            @endif

            <form action="{{ route('admin.loginSubmit') }}" method="POST" class="w_100 h_fc flex_cl gap_2vw mtop_2vh">
                @csrf
                <div class="input_group w_100 flex_cl gap_1vw pos_relative mtop_2vh">
                    <label for="username" class="flex align_c gap_1vw">
                        <h4 class="font_w400"><i class="ri-user-line"></i>
                        Username</h4>
                    </label>
                    <input type="text" name="username" id="username" 
                           class="form_input w_100" required 
                           placeholder="Enter your username">
                </div>

                <div class="input_group w_100 flex_cl gap_1vw pos_relative">
                    <label for="password" class="flex align_c gap_1vw">
                        <h4 class="font_w400"><i class="ri-lock-line"></i>
                        Password</h4>
                    </label>
                    <div class="password_input_group w_100 pos_relative">
                        <input type="password" name="password" id="password" 
                               class="form_input w_100" required 
                               placeholder="Enter your password">
                        <button type="button" class="toggle_password">
                            <h3><i class="ri-eye-line"></i></h3>
                        </button>
                    </div>
                </div>

                <x-button type="submit" class="w_100">
                    <span class="flex justify_c align_c gap_1vw">
                       
                        <h3 class="color_white"> <i class="ri-login-circle-line color_white font_w400"></i> Login</h4>
                    </span>
                </x-button>
            </form>
        </div>
    </div>
</section>
<style >
    .navbar_sticky{
        display: none;
    }
</style>
<script>
document.querySelectorAll('.toggle_password').forEach(button => {
    button.addEventListener('click', () => {
        const passwordInput = button.closest('.password_input_group').querySelector('input[type="password"], input[type="text"]');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            button.querySelector('i').classList.remove('ri-eye-line');
            button.querySelector('i').classList.add('ri-eye-off-line');
        } else {
            passwordInput.type = 'password';
            button.querySelector('i').classList.remove('ri-eye-off-line');
            button.querySelector('i').classList.add('ri-eye-line');
        }
    });
});
</script>

@endsection