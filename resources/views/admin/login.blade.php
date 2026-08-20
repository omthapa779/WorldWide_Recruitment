<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Sign in · WRS Console</title>
    <link rel="stylesheet" href="{{ asset('resources/css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('resources/favicon.ico') }}" type="image/x-icon">
</head>
<body class="adm">
<div class="adm-login">
    <div class="adm-login-card">
        <div class="adm-login-brand">
            <img src="{{ asset('resources/images/logo.png') }}" alt="">
            <div>
                <h1 class="adm-login-title">WorldWide Recruitment</h1>
                <p class="adm-login-sub">ADMIN CONSOLE</p>
            </div>
        </div>

        @if($errors->any())
            <div class="adm-alert is-danger">
                <span class="adm-alert-title">
                    <i class="ri-error-warning-line"></i> {{ $errors->first() }}
                </span>
            </div>
        @endif

        <form action="{{ route('admin.loginSubmit') }}" method="POST">
            @csrf

            <div class="adm-field">
                <label class="adm-label" for="username">
                    <i class="ri-user-line"></i> Username
                </label>
                <input type="text" name="username" id="username"
                       class="adm-input" required autofocus autocomplete="username"
                       placeholder="Enter your username">
            </div>

            <div class="adm-field">
                <label class="adm-label" for="password">
                    <i class="ri-lock-line"></i> Password
                </label>
                <div class="adm-pw-wrap">
                    <input type="password" name="password" id="password"
                           class="adm-input" required autocomplete="current-password"
                           placeholder="Enter your password">
                    <button type="button" class="adm-pw-toggle" id="pwToggle" aria-label="Show password">
                        <i class="ri-eye-line"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="adm-btn is-primary" style="width:100%; margin-top:4px;">
                <i class="ri-login-circle-line"></i> Sign in
            </button>
        </form>

        <p class="adm-login-foot">Authorised personnel only. Licence No. 1617-079/80</p>
    </div>
</div>

<script>
    (function () {
        var toggle = document.getElementById('pwToggle');
        var input = document.getElementById('password');
        if (!toggle || !input) return;

        toggle.addEventListener('click', function () {
            var hidden = input.type === 'password';
            input.type = hidden ? 'text' : 'password';
            toggle.setAttribute('aria-label', hidden ? 'Hide password' : 'Show password');
            toggle.querySelector('i').className = hidden ? 'ri-eye-off-line' : 'ri-eye-line';
            input.focus();
        });
    })();
</script>
</body>
</html>
