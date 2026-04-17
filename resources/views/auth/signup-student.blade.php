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
    <title>Student Sign Up - ConsultEase</title>
</head>
<body>
    @include('layouts.livewallpaper')

    <div class="auth-shell">
        <div class="container auth-card auth-card--wide">
            <div class="auth-card__body">
                <div class="auth-header">
                    <span class="auth-header__eyebrow">Student account</span>
                    <p class="header-text">Create your student account</p>
                    <p class="sub-text">Provide your details below to start booking faculty consultations online.</p>
                </div>

                <form action="{{ route('signup.student') }}" method="POST" class="auth-form">
                    @csrf

                    <div class="auth-grid">
                        <div class="auth-field">
                            <label for="fname" class="form-label">First name</label>
                            <input id="fname" type="text" name="fname" class="input-text" placeholder="First name" value="{{ old('fname') }}" required>
                        </div>
                        <div class="auth-field">
                            <label for="lname" class="form-label">Last name</label>
                            <input id="lname" type="text" name="lname" class="input-text" placeholder="Last name" value="{{ old('lname') }}" required>
                        </div>
                        <div class="auth-field auth-field--full">
                            <label for="address" class="form-label">Address</label>
                            <input id="address" type="text" name="address" class="input-text" placeholder="Address" value="{{ old('address') }}" required>
                        </div>
                        <div class="auth-field">
                            <label for="dob" class="form-label">Date of birth</label>
                            <input id="dob" type="date" name="dob" class="input-text" value="{{ old('dob') }}" required>
                        </div>
                        <div class="auth-field">
                            <label for="tele" class="form-label">Mobile number</label>
                            <input id="tele" type="tel" name="tele" class="input-text" pattern="^\d{11}$" placeholder="ex. 07123456789" value="{{ old('tele') }}" required>
                        </div>
                        <div class="auth-field auth-field--full">
                            <label for="newemail" class="form-label">Email</label>
                            <input id="newemail" type="email" name="newemail" class="input-text" placeholder="Email address" value="{{ old('newemail') }}" required>
                        </div>
                        <div class="auth-field">
                            <label for="newpassword" class="form-label">Create password</label>
                            <input id="newpassword" type="password" name="newpassword" class="input-text" placeholder="New password" required>
                        </div>
                        <div class="auth-field">
                            <label for="cpassword" class="form-label">Confirm password</label>
                            <input id="cpassword" type="password" name="cpassword" class="input-text" placeholder="Confirm password" required>
                        </div>
                    </div>

                    @if(session('error'))
                        <div class="auth-error">{{ session('error') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="auth-error">
                            <ul>
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="auth-actions">
                        <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                        <input type="submit" value="Sign Up" class="login-btn btn-primary btn">
                    </div>
                </form>

                <p class="auth-footer">
                    Already have an account?
                    <a href="{{ route('login') }}" class="hover-link1 non-style-link">Login</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
