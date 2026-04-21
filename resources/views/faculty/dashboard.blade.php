<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <title>Dashboard</title>
    <style>
        .dashbord-tables,
        .faculty-heade {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container,
        .sub-table,
        #anim {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .fac-dashboard-body {
            margin-top: 0 !important;
            padding-top: 22px;
        }

        .fac-dashboard-shell {
            gap: 20px;
        }

        .fac-dashboard-sidebar {
            display: flex;
            flex-direction: column;
            padding: 22px 0 18px;
        }

        .fac-sidebar-top {
            padding: 0 18px 18px;
        }

        .fac-profile-card {
            display: grid;
            gap: 18px;
            padding: 22px 20px;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04);
        }

        .fac-profile-media {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .fac-profile-avatar-wrap {
            width: 74px;
            height: 74px;
            border-radius: 50%;
            padding: 6px;
            background: rgba(255, 255, 255, 0.14);
            box-shadow: 0 10px 26px rgba(7, 23, 10, 0.2);
            flex-shrink: 0;
        }

        .fac-profile-avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            background: rgba(255, 255, 255, 0.12);
        }

        .fac-profile-copy {
            min-width: 0;
            display: grid;
            gap: 4px;
        }

        .fac-profile-copy .profile-title {
            padding-left: 0;
            margin: 0;
            font-size: 1.2rem;
            font-weight: 700;
            line-height: 1.2;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .fac-profile-copy .profile-subtitle {
            padding-left: 0;
            margin: 0;
            font-size: 0.92rem;
            color: rgba(255, 255, 255, 0.76);
            line-height: 1.55;
            word-break: break-word;
        }

        .fac-profile-actions .logout-btn {
            width: 100%;
            justify-content: center;
            min-height: 46px;
            margin-top: 0;
            font-weight: 600;
        }

        .fac-sidebar-nav {
            display: grid;
            gap: 10px;
            padding: 14px 18px 0;
        }

        .fac-nav-link {
            display: flex;
            align-items: center;
            min-height: 54px;
            padding: 0 18px 0 56px;
            border-radius: 18px;
            color: rgba(255, 255, 255, 0.88);
            text-decoration: none;
            font-size: 0.98rem;
            font-weight: 600;
            letter-spacing: -0.01em;
            background-repeat: no-repeat;
            background-position: 18px 50%;
            background-size: 20px;
            transition: transform 0.2s ease, background-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
        }

        .fac-nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.11);
            transform: translateX(2px);
        }

        .fac-nav-link--active {
            color: #98f29e;
            background-color: rgba(255, 255, 255, 0.14);
            box-shadow: inset 0 0 0 1px rgba(152, 242, 158, 0.28);
        }

        .fac-nav-link--active:hover {
            color: #b7fcbc;
        }

        .fac-header-bar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
            padding: 6px 0 12px;
            width: 100%;
            box-sizing: border-box;
        }

        .fac-header-bar .fac-title-cell {
            flex: 1 1 auto;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .fac-header-bar .fac-title-cell p {
            font-size: clamp(18px, 3.5vw, 23px);
            font-weight: 600;
            margin: 0;
            padding-left: 12px;
        }

        .fac-header-bar .fac-date-cell {
            flex: 0 0 auto;
            text-align: right;
        }

        .fac-header-bar .fac-cal-cell {
            flex: 0 0 auto;
        }

        .fac-dashboard-panels {
            display: grid;
            gap: 20px;
        }

        .fac-hero {
            width: 100%;
            box-sizing: border-box;
            padding: 20px clamp(14px, 3%, 30px) !important;
            border-radius: 8px;
            margin-bottom: 0;
        }

        .fac-hero h1 {
            font-size: clamp(20px, 5vw, 32px);
            margin: 4px 0 8px;
        }

        .fac-hero h3 {
            font-size: clamp(14px, 3vw, 18px);
            margin: 0 0 4px;
        }

        .fac-hero p {
            font-size: clamp(13px, 2.5vw, 15px);
            line-height: 1.6;
            max-width: 620px;
            margin-bottom: 0;
        }

        .fac-hero-btn {
            width: auto !important;
            min-width: 190px;
            padding: 10px 22px;
            margin-top: 18px;
        }

        .fac-sessions-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #e8e8e8;
            box-shadow: var(--shadow-card);
            padding: 20px;
            overflow: hidden;
        }

        .fac-sessions-card .page-card__header {
            margin-bottom: 12px;
        }

        .fac-sessions-card .page-card__description {
            max-width: 560px;
        }

        .fac-sessions-abc {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            height: 270px;
            box-sizing: border-box;
        }

        .fac-sessions-abc .sub-table {
            width: 100%;
            min-width: 380px;
        }

        .db-empty {
            text-align: center;
            padding: 24px 12px;
        }

        .db-empty img {
            width: 70px;
            max-width: 25%;
        }

        .db-empty p {
            margin: 10px auto;
            font-size: 15px;
            color: #313131;
            max-width: 260px;
        }

        .db-empty .btn {
            margin: 0 auto;
            display: inline-flex;
            align-items: center;
            width: auto !important;
        }

        @media screen and (max-width: 768px) {
            .fac-dashboard-body {
                padding-top: 18px;
            }

            .fac-dashboard-sidebar {
                padding-top: 18px;
            }

            .fac-sidebar-top {
                padding: 0 14px 16px;
            }

            .fac-sidebar-nav {
                padding: 10px 14px 0;
                gap: 8px;
            }

            .fac-header-bar .fac-date-cell,
            .fac-header-bar .fac-cal-cell {
                display: none;
            }

            .fac-hero-btn {
                width: 100% !important;
                min-width: unset;
                text-align: center;
            }

            .fac-sessions-abc {
                height: auto;
                max-height: 280px;
            }

            .fac-hero p br {
                display: none;
            }
        }

        @media screen and (max-width: 480px) {
            .fac-profile-card {
                padding: 18px 16px;
                border-radius: 20px;
            }

            .fac-profile-avatar-wrap {
                width: 64px;
                height: 64px;
            }

            .fac-nav-link {
                min-height: 50px;
                padding-left: 52px;
                border-radius: 16px;
                font-size: 0.94rem;
            }

            .fac-sessions-abc {
                max-height: 240px;
            }

            .fac-sessions-abc .sub-table {
                min-width: 300px;
            }

            .fac-hero {
                padding: 14px 12px !important;
            }

            .fac-hero h1 {
                font-size: 20px;
            }

            .fac-hero p {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu fac-dashboard-sidebar">
            <div class="fac-sidebar-top">
                <div class="fac-profile-card">
                    <div class="fac-profile-media">
                        <div class="fac-profile-avatar-wrap">
                            <img
                                src="{{ $faculty->profile_pic ? asset('storage/' . $faculty->profile_pic) : asset('img/user.png') }}"
                                alt="{{ $faculty->facname }}"
                                class="fac-profile-avatar"
                            >
                        </div>
                        <div class="fac-profile-copy">
                            <p class="profile-title">{{ $faculty->facname }}</p>
                            <p class="profile-subtitle">{{ $faculty->facemail }}</p>
                        </div>
                    </div>
                    <div class="fac-profile-actions">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-btn btn-primary-soft btn">Log out</button>
                        </form>
                    </div>
                </div>
            </div>

            <nav class="fac-sidebar-nav" aria-label="Faculty dashboard navigation">
                <a href="{{ url('/faculty/dashboard') }}" class="fac-nav-link fac-nav-link--active menu-icon-dashbord">Dashboard</a>
                <a href="{{ url('/faculty/appointment') }}" class="fac-nav-link menu-icon-appoinment">My Appointments</a>
                <a href="{{ url('/faculty/schedule') }}" class="fac-nav-link menu-icon-session">My Sessions</a>
                <a href="{{ url('/faculty/student') }}" class="fac-nav-link menu-icon-student">My Students</a>
                <a href="{{ url('/faculty/settings') }}" class="fac-nav-link menu-icon-settings">Settings</a>
                <button type="button" class="fac-nav-link menu-icon-notifications" id="notification-btn" style="border:none;background-color:transparent;text-align:left;font:inherit;cursor:pointer;">Notifications</button>
            </nav>
        </div>

        <div class="dash-body fac-dashboard-body" id="dash-body">
            <div class="page-shell fac-dashboard-shell">
                <div class="fac-header-bar">
                    <div class="fac-title-cell">
                        @include('shared.hamburger')
                        <p>Home</p>
                    </div>
                    <div class="fac-date-cell">
                        <p style="font-size:13px;color:rgb(119,119,119);margin:0;">Today's Date</p>
                        <p class="heading-sub12" style="margin:0;">{{ $today }}</p>
                    </div>
                    <div class="fac-cal-cell">
                        <button class="btn-label" style="display:flex;justify-content:center;align-items:center;">
                            <img src="{{ asset('img/calendar.svg') }}" width="28" alt="Calendar">
                        </button>
                    </div>
                </div>

                <div class="fac-dashboard-panels">
                    <table class="filter-container faculty-header fac-hero faculty-heade" border="0" style="border:none;">
                        <tr>
                            <td>
                                <h3>Welcome!</h3>
                                <h1>{{ $faculty->facname }}</h1>
                                <p>
                                    Thanks for joining with us. We are always trying to get you a complete service.<br>
                                    You can view your daily schedule and reach student appointments from home!
                                </p>
                                <a href="{{ url('/faculty/appointment') }}" class="non-style-link">
                                    <button class="btn btn-primary fac-hero-btn">View My Appointments</button>
                                </a>
                            </td>
                        </tr>
                    </table>

                    <div class="fac-sessions-card">
                        <div class="page-card__header">
                            <div>
                                <span class="page-card__eyebrow">Schedule Preview</span>
                                <h2 id="anim" class="page-card__title">Your upcoming sessions until next week</h2>
                                <p class="page-card__description">A quick view of your upcoming sessions so the dashboard feels balanced and useful at a glance.</p>
                            </div>
                        </div>

                        <div class="fac-sessions-abc">
                            <table width="100%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th class="table-headin">Session Title</th>
                                        <th class="table-headin">Scheduled Date</th>
                                        <th class="table-headin">Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($upcomingSessions->count() == 0)
                                        <tr>
                                            <td colspan="3">
                                                <div class="db-empty">
                                                    <img src="{{ asset('img/notfound.svg') }}" alt="Not found">
                                                    <p>No upcoming sessions found.</p>
                                                    <a class="non-style-link" href="{{ url('/faculty/schedule') }}">
                                                        <button class="btn btn-primary-soft">Show all Sessions</button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($upcomingSessions as $session)
                                            <tr>
                                                <td>{{ substr($session->title,0,30) }}</td>
                                                <td class="date-col">{{ substr($session->scheduledate,0,10) }}</td>
                                                <td class="date-col">{{ substr($session->scheduletime,0,5) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('shared.notifications')
</body>
</html>
