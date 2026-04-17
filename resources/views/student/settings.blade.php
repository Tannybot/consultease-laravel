<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <title>Settings</title>
    <style>
        .dashbord-tables,
        .filter-container,
        .sub-table,
        .page-card {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="menu">
        <table class="menu-container" border="0">
            <tr>
                <td style="padding:10px" colspan="2">
                    <table border="0" class="profile-container">
                        <tr>
                            <td width="30%" style="padding-left:20px">
                                <img src="{{ $student->profile_pic ? asset('storage/' . $student->profile_pic) : asset('img/user.png') }}" alt="User icon" style="width: 91.85px; height: 91.85px; object-fit: cover; border-radius:50%">
                            </td>
                            <td style="padding:0;margin:0;">
                                <p class="profile-title">{{ substr($student->sname,0,13) }}..</p>
                                <p class="profile-subtitle">{{ substr($student->semail,0,22) }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="logout-btn btn-primary-soft btn">Log out</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-home">
                    <a href="{{ url('/student/dashboard') }}" class="non-style-link-menu"><div><p class="menu-text">Home</p></div></a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-faculty">
                    <a href="{{ url('/student/faculty') }}" class="non-style-link-menu"><div><p class="menu-text">All Faculty</p></div></a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-session">
                    <a href="{{ url('/student/schedule') }}" class="non-style-link-menu"><div><p class="menu-text">Scheduled Sessions</p></div></a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-appoinment">
                    <a href="{{ url('/student/appointment') }}" class="non-style-link-menu"><div><p class="menu-text">My Bookings</p></div></a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-settings menu-active menu-icon-settings-active">
                    <a href="{{ url('/student/settings') }}" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Settings</p></div></a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-notifications" id="notification-btn">
                    <div><p class="menu-text">Notifications</p></div>
                </td>
            </tr>
        </table>
    </div>

    <div class="dash-body">
        <div class="page-shell">
            <div class="page-toolbar">
                <div class="page-toolbar__group">
                    <a href="{{ url('/student/dashboard') }}" class="non-style-link">
                        <button class="login-btn btn-primary-soft btn btn-icon-back">Back</button>
                    </a>
                    <div>
                        <div class="page-toolbar__group">
                            @include('shared.hamburger')
                            <h1 class="page-toolbar__title">Settings</h1>
                        </div>
                        <p class="page-toolbar__subtitle">Manage your account details, security preferences, and profile information.</p>
                    </div>
                </div>

                <div class="page-meta">
                    <div class="page-meta__copy">
                        <span class="page-meta__label">Today's Date</span>
                        <span class="page-meta__value">{{ $today }}</span>
                    </div>
                    <button class="btn-label">
                        <img src="{{ asset('img/calendar.svg') }}" width="24" alt="Calendar">
                    </button>
                </div>
            </div>

            @if(session('success'))
                <div class="status-banner status-banner--success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="status-banner status-banner--error">{{ session('error') }}</div>
            @endif

            <div class="page-card">
                <div class="page-card__header">
                    <div>
                        <span class="page-card__eyebrow">Account Tools</span>
                        <h2 class="page-card__title">Manage your student profile</h2>
                        <p class="page-card__description">Choose an action below to update your account, review details, or manage sign-in security.</p>
                    </div>
                </div>

                <div class="settings-stack">
                    <a href="?action=edit&id={{ $student->sid }}&error=0" class="non-style-link">
                        <div class="settings-card">
                            <div class="settings-card__icon" style="background-image: url('{{ asset('img/icons/faculty-hover.svg') }}');"></div>
                            <div class="settings-card__content">
                                <h3 class="settings-card__title">Account Settings</h3>
                                <p class="settings-card__text">Edit your account details, upload a profile picture, and change your password.</p>
                            </div>
                        </div>
                    </a>

                    <a href="?action=view&id={{ $student->sid }}" class="non-style-link">
                        <div class="settings-card">
                            <div class="settings-card__icon" style="background-image: url('{{ asset('img/icons/view-iceblue.svg') }}');"></div>
                            <div class="settings-card__content">
                                <h3 class="settings-card__title">View Account Details</h3>
                                <p class="settings-card__text">See the personal information currently stored for your account.</p>
                            </div>
                        </div>
                    </a>

                    <div class="settings-card">
                        <div class="settings-card__icon" style="background-image: url('{{ asset('img/icons/settings-iceblue.svg') }}');"></div>
                        <div class="settings-card__content">
                            <div class="page-action-row" style="gap: 10px;">
                                <h3 class="settings-card__title" style="margin: 0;">Two-Factor Authentication</h3>
                                @if($webuser && $webuser->google_2fa_enabled)
                                    <span class="status-chip status-chip--success">Enabled</span>
                                @else
                                    <span class="status-chip status-chip--warning">Disabled</span>
                                @endif
                            </div>
                            <p class="settings-card__text">Secure your account with Google verification each time you sign in.</p>
                            <div class="settings-card__actions">
                                @if($webuser && $webuser->google_2fa_enabled)
                                    <form action="{{ route('google.2fa.disable') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-primary-soft btn">Disable Google 2FA</button>
                                    </form>
                                @else
                                    <form action="{{ route('google.2fa.enable') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-primary btn">Enable Google 2FA</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    <a href="?action=drop&id={{ $student->sid }}&name={{ $student->sname }}" class="non-style-link">
                        <div class="settings-card">
                            <div class="settings-card__icon" style="background-image: url('{{ asset('img/icons/students-hover.svg') }}'); background-color: #fdecea;"></div>
                            <div class="settings-card__content">
                                <h3 class="settings-card__title" style="color: #b42318;">Delete Account</h3>
                                <p class="settings-card__text">Permanently remove your account and student information from the application.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@if($action=='drop')
    <div id="popup1" class="overlay">
        <div class="popup">
            <center>
                <h2>Delete your account?</h2>
                <a class="close" href="{{ url('/student/settings') }}">&times;</a>
                <div class="content">
                    You are about to delete your account for <b>{{ substr($nameget,0,40) }}</b>.
                </div>
                <div class="dialog-actions">
                    <form action="{{ url('/student/settings/delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button type="submit" class="btn-primary btn">Yes, delete</button>
                    </form>
                    <a href="{{ url('/student/settings') }}" class="non-style-link">
                        <button class="btn-primary-soft btn">No, keep account</button>
                    </a>
                </div>
            </center>
        </div>
    </div>
@elseif($action=='view' && $viewStudent)
    <div id="popup1" class="overlay">
        <div class="popup">
            <center>
                <a class="close" href="{{ url('/student/settings') }}">&times;</a>
                <div class="app-form-card" style="text-align:left;">
                    <div class="page-card__header">
                        <div>
                            <span class="page-card__eyebrow">Profile</span>
                            <h2 class="page-card__title">View account details</h2>
                        </div>
                    </div>
                    <div class="detail-list">
                        <div class="detail-list__item">
                            <span class="detail-list__label">Name</span>
                            <div class="detail-list__value">{{ $viewStudent->sname }}</div>
                        </div>
                        <div class="detail-list__item">
                            <span class="detail-list__label">Email</span>
                            <div class="detail-list__value">{{ $viewStudent->semail }}</div>
                        </div>
                        <div class="detail-list__item">
                            <span class="detail-list__label">Telephone</span>
                            <div class="detail-list__value">{{ $viewStudent->stel }}</div>
                        </div>
                        <div class="detail-list__item">
                            <span class="detail-list__label">Address</span>
                            <div class="detail-list__value">{{ $viewStudent->saddress }}</div>
                        </div>
                        <div class="detail-list__item">
                            <span class="detail-list__label">Date of Birth</span>
                            <div class="detail-list__value">{{ $viewStudent->sdob }}</div>
                        </div>
                    </div>
                    <div class="dialog-actions">
                        <a href="{{ url('/student/settings') }}" class="non-style-link">
                            <button class="btn-primary-soft btn">Close</button>
                        </a>
                    </div>
                </div>
            </center>
        </div>
    </div>
@elseif($action=='edit' && $viewStudent)
    <div id="popup1" class="overlay">
        <div class="popup">
            <center>
                <a class="close" href="{{ url('/student/settings') }}">&times;</a>
                <div class="app-form-card" style="text-align:left;">
                    <div class="page-card__header">
                        <div>
                            <span class="page-card__eyebrow">Edit Profile</span>
                            <h2 class="page-card__title">Update student account</h2>
                            <p class="page-card__description">Student ID: {{ $id }} (auto generated)</p>
                        </div>
                    </div>

                    @if($error == '1')
                        <div class="status-banner status-banner--error" style="margin-bottom: 16px;">Already have an account for this email address.</div>
                    @elseif($error == '2')
                        <div class="status-banner status-banner--error" style="margin-bottom: 16px;">Password confirmation error. Please confirm your password again.</div>
                    @endif

                    <form action="{{ url('/student/settings/edit') }}" method="POST" class="auth-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $id }}" name="id00">
                        <input type="hidden" name="oldemail" value="{{ $viewStudent->semail }}">

                        <div class="app-form-grid">
                            <div class="full auth-field">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" name="email" class="input-text" placeholder="Email address" value="{{ $viewStudent->semail }}" required>
                            </div>
                            <div class="full auth-field">
                                <label for="profile_pic" class="form-label">Profile picture</label>
                                <input id="profile_pic" type="file" name="profile_pic" class="input-text" accept="image/*">
                            </div>
                            <div class="full auth-field">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" type="text" name="name" class="input-text" placeholder="Student name" value="{{ $viewStudent->sname }}" required>
                            </div>
                            <div class="auth-field">
                                <label for="tele" class="form-label">Telephone</label>
                                <input id="tele" type="tel" name="Tele" class="input-text" placeholder="Telephone number" value="{{ $viewStudent->stel }}" required>
                            </div>
                            <div class="auth-field">
                                <label for="address" class="form-label">Address</label>
                                <input id="address" type="text" name="address" class="input-text" placeholder="Address" value="{{ $viewStudent->saddress }}" required>
                            </div>
                            <div class="auth-field">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" name="password" class="input-text" placeholder="Define a password" required>
                            </div>
                            <div class="auth-field">
                                <label for="cpassword" class="form-label">Confirm password</label>
                                <input id="cpassword" type="password" name="cpassword" class="input-text" placeholder="Confirm password" required>
                            </div>
                        </div>

                        <div class="app-form-actions">
                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                            <input type="submit" value="Save" class="login-btn btn-primary btn">
                        </div>
                    </form>
                </div>
            </center>
        </div>
    </div>
@elseif($error == '4')
    <div id="popup1" class="overlay">
        <div class="popup">
            <center>
                <h2>Profile updated</h2>
                <a class="close" href="{{ url('/student/settings') }}">&times;</a>
                <div class="content">If you changed your email, please log out and sign back in using your new email address.</div>
                <div class="dialog-actions">
                    <a href="{{ url('/student/settings') }}" class="non-style-link">
                        <button class="btn-primary btn">OK</button>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-primary-soft btn">Log out</button>
                    </form>
                </div>
            </center>
        </div>
    </div>
@endif

@include('shared.notifications')
</body>
</html>
