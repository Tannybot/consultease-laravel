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
    <title>Verify Your Identity</title>
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <style>
        .verify-container {
            max-width: 480px;
            margin: 0 auto;
            padding: 40px 30px;
            animation: transitionIn-Y-over 0.5s;
        }
        .verify-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            background: linear-gradient(135deg, #4285F4, #34A853, #FBBC05, #EA4335);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 32px rgba(66, 133, 244, 0.3);
        }
        .verify-icon svg {
            width: 40px;
            height: 40px;
            fill: white;
        }
        .verify-title {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 12px;
        }
        .verify-subtitle {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 32px;
        }
        .google-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 14px 36px;
            background: #4285F4;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 16px rgba(66, 133, 244, 0.3);
            width: 100%;
            box-sizing: border-box;
        }
        .google-btn:hover {
            background: #3367d6;
            box-shadow: 0 6px 24px rgba(66, 133, 244, 0.4);
            transform: translateY(-1px);
        }
        .google-btn svg {
            width: 20px;
            height: 20px;
            fill: white;
        }
        .cancel-link {
            display: inline-block;
            margin-top: 20px;
            color: #888;
            font-size: 14px;
            text-decoration: none;
            transition: color 0.2s;
        }
        .cancel-link:hover {
            color: #333;
        }
        .shield-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #e8f5e9;
            color: #2e7d32;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .shield-badge svg {
            width: 14px;
            height: 14px;
            fill: #2e7d32;
        }
        .error-msg {
            color: rgb(255, 62, 62);
            text-align: center;
            font-size: 14px;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    @include('layouts.livewallpaper')

    <center>
    <div class="container">
        <div class="verify-container">
            <div class="verify-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
            </div>

            <div class="shield-badge">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>
                Two-Factor Authentication
            </div>

            <p class="verify-title">Verify Your Identity</p>
            <p class="verify-subtitle">
                Your account has two-factor authentication enabled.
                Please verify your identity using your linked Google account to continue.
            </p>

            @if(session('error'))
                <p class="error-msg">{{ session('error') }}</p>
            @endif

            <a href="{{ route('google.redirect') }}" class="google-btn" id="google-verify-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" style="fill:none">
                    <path fill="#fff" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/>
                </svg>
                Verify with Google
            </a>

            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="cancel-link" style="background:none;border:none;cursor:pointer;">
                    ← Cancel and logout
                </button>
            </form>
        </div>
    </div>
    </center>
</body>
</html>
