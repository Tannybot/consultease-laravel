<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">  
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">  
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        
    <title>Profile Settings</title>
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
                @include('shared.sidebar-admin', ['activePage' => 'settings'])
<div class="dash-body">
            <div class="page-shell">
                <div class="page-toolbar">
                    <div class="page-toolbar__group">
                        <a href="{{ url('/admin/dashboard') }}" class="non-style-link">
                            <button class="login-btn btn-primary-soft btn btn-icon-back">Back</button>
                        </a>
                        <div>
                            <div class="page-toolbar__group">
                                @include('shared.hamburger')
                                <h1 class="page-toolbar__title">Settings</h1>
                            </div>
                            <p class="page-toolbar__subtitle">Review the administrator account details and keep the profile area clean and easy to scan.</p>
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

                <div class="page-card admin-profile-panel">
                    <div class="admin-profile-panel__hero">
                        <div class="admin-profile-panel__avatar-wrap">
                            <img src="{{ asset('img/user.png') }}" alt="Administrator" class="admin-profile-panel__avatar">
                        </div>
                        <div class="admin-profile-panel__hero-copy">
                            <span class="page-card__eyebrow">Administrator Profile</span>
                            <h2 class="admin-profile-panel__name">Administrator</h2>
                            <p class="admin-profile-panel__email">{{ $admin->aemail }}</p>
                            <div class="admin-profile-panel__badges">
                                <span class="status-chip status-chip--success">System Access</span>
                                <span class="admin-profile-panel__badge">Primary Account</span>
                            </div>
                        </div>
                    </div>

                    <div class="admin-profile-panel__grid">
                        <div class="admin-profile-panel__item">
                            <span class="admin-profile-panel__label">Email Address</span>
                            <div class="admin-profile-panel__value">{{ $admin->aemail }}</div>
                        </div>
                        <div class="admin-profile-panel__item">
                            <span class="admin-profile-panel__label">Role</span>
                            <div class="admin-profile-panel__value">Administrator</div>
                        </div>
                        <div class="admin-profile-panel__item admin-profile-panel__item--wide">
                            <span class="admin-profile-panel__label">Access Scope</span>
                            <div class="admin-profile-panel__value">Full dashboard management for faculty, students, appointments, schedules, and system settings.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('shared.notifications')
</body>
</html>

