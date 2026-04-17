<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/livewallpaper.css') }}">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <title>Sign Up - ConsultEase</title>
</head>
<body>
    @include('layouts.livewallpaper')

    <div class="auth-shell">
        <div class="container auth-card">
            <div class="auth-card__body">
                <div class="auth-header">
                    <span class="auth-header__eyebrow">Create an account</span>
                    <p class="header-text">Choose your role</p>
                    <p class="sub-text">Select the account type that matches how you use ConsultEase.</p>
                </div>

                <form action="{{ url('/signup/role') }}" method="POST" class="auth-form">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">I am signing up as:</label>
                    </div>

                    <div class="form-group role-options role-options-modern">
                        <label class="role-card">
                            <input type="radio" name="role" value="student" required>
                            <span class="role-card__content">
                                <span class="role-card__title">Student</span>
                                <span class="role-card__text">Book consultations, review schedules, and track your appointments.</span>
                            </span>
                        </label>
                        <label class="role-card">
                            <input type="radio" name="role" value="faculty" required>
                            <span class="role-card__content">
                                <span class="role-card__title">Faculty</span>
                                <span class="role-card__text">Manage sessions, handle student consultations, and update availability.</span>
                            </span>
                        </label>
                    </div>

                    <div class="auth-actions">
                        <input type="submit" value="Continue" class="login-btn btn-primary btn">
                    </div>
                </form>

                <p class="auth-footer">
                    Already have an account?
                    <a href="{{ url('/login') }}" class="hover-link1 non-style-link">Login</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
