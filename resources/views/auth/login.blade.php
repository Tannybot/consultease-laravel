<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/livewallpaper.css') }}">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    @include('layouts.livewallpaper')

    <div class="auth-shell">
        <div class="container auth-card">
            <div class="auth-card__body">
                <div class="auth-header">
                    <span class="auth-header__eyebrow">ConsultEase Access</span>
                    <p class="header-text">Welcome back</p>
                    <p class="sub-text">Sign in with your account details to continue to your dashboard.</p>
                </div>

                <form action="{{ url('/login') }}" method="POST" class="auth-form">
                    @csrf

                    <div class="auth-field">
                        <label for="useremail" class="form-label">Email</label>
                        <input id="useremail" type="email" name="useremail" class="input-text" placeholder="Email address" required>
                    </div>

                    <div class="auth-field">
                        <label for="userpassword" class="form-label">Password</label>
                        <input id="userpassword" type="password" name="userpassword" class="input-text" placeholder="Password" required>
                    </div>

                    @if(session('error'))
                        <div class="auth-error">{{ session('error') }}</div>
                    @endif

                    <div class="auth-actions">
                        <input type="submit" value="Login" class="login-btn btn-primary btn">
                    </div>
                </form>

                <p class="auth-footer">
                    Do not have an account?
                    <a href="{{ url('/signup') }}" class="hover-link1 non-style-link">Sign up</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
