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
    <title>Verify Your Identity</title>
    <style>
        .verify-container {
            display: grid;
            gap: 18px;
            text-align: center;
        }

        .verify-icon {
            width: 84px;
            height: 84px;
            margin: 0 auto;
            background: linear-gradient(135deg, #4285f4, #34a853, #fbbc05, #ea4335);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 18px 36px rgba(66, 133, 244, 0.24);
        }

        .verify-icon svg {
            width: 42px;
            height: 42px;
            fill: #fff;
        }

        .shield-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 0 auto;
            padding: 8px 14px;
            border-radius: 999px;
            background: #e8f5e9;
            color: #2a6c37;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .shield-badge svg {
            width: 14px;
            height: 14px;
            fill: currentColor;
        }

        .google-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            min-height: 52px;
            padding: 14px 18px;
            border-radius: 14px;
            background: #4285f4;
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 16px 30px rgba(66, 133, 244, 0.25);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .google-btn:hover {
            background: #3367d6;
            transform: translateY(-1px);
            box-shadow: 0 20px 36px rgba(66, 133, 244, 0.3);
        }

        .google-btn svg {
            width: 20px;
            height: 20px;
            fill: #fff;
        }

        .cancel-btn {
            background: none;
            border: none;
            color: #6b7d70;
            font-size: 14px;
            cursor: pointer;
            padding: 0;
        }

        .cancel-btn:hover {
            color: #20362a;
        }
    </style>
</head>
<body>
    @include('layouts.livewallpaper')

    <div class="auth-shell">
        <div class="container auth-card">
            <div class="auth-card__body">
                <div class="verify-container">
                    <div class="verify-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 1 3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
                    </div>

                    <div class="shield-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 1 3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>
                        Two-factor authentication
                    </div>

                    <div class="auth-header" style="margin-bottom: 0;">
                        <p class="auth-header__title">Verify your identity</p>
                        <p class="auth-header__text">
                            Your account has Google-based two-factor authentication enabled.
                            Continue with your linked Google account to finish signing in.
                        </p>
                    </div>

                    @if(session('error'))
                        <div class="auth-error">{{ session('error') }}</div>
                    @endif

                    <a href="{{ route('google.redirect') }}" class="google-btn" id="google-verify-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" style="fill:none">
                            <path fill="#fff" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/>
                        </svg>
                        Verify with Google
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="cancel-btn">Cancel and log out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
