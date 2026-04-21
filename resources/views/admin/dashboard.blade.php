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
        .filter-container,
        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .admin-dashboard-body {
            margin-top: 0 !important;
            padding-top: 22px;
        }

        .admin-dashboard-shell {
            gap: 20px;
        }

        .admin-dashboard-sidebar {
            display: flex;
            flex-direction: column;
            padding: 22px 0 18px;
        }

        .admin-sidebar-top {
            padding: 0 18px 18px;
        }

        .admin-profile-card {
            display: grid;
            gap: 18px;
            padding: 22px 20px;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04);
        }

        .admin-profile-media {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .admin-profile-avatar-wrap {
            width: 74px;
            height: 74px;
            border-radius: 50%;
            padding: 6px;
            background: rgba(255, 255, 255, 0.14);
            box-shadow: 0 10px 26px rgba(7, 23, 10, 0.2);
            flex-shrink: 0;
        }

        .admin-profile-avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            background: rgba(255, 255, 255, 0.12);
        }

        .admin-profile-copy {
            min-width: 0;
            display: grid;
            gap: 4px;
        }

        .admin-profile-copy .profile-title {
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

        .admin-profile-copy .profile-subtitle {
            padding-left: 0;
            margin: 0;
            font-size: 0.92rem;
            color: rgba(255, 255, 255, 0.76);
            line-height: 1.55;
            word-break: break-word;
        }

        .admin-profile-actions .logout-btn {
            width: 100%;
            justify-content: center;
            min-height: 46px;
            margin-top: 0;
            font-weight: 600;
        }

        .admin-sidebar-nav {
            display: grid;
            gap: 10px;
            padding: 14px 18px 0;
        }

        .admin-nav-link {
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

        .admin-nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.11);
            transform: translateX(2px);
        }

        .admin-nav-link--active {
            color: #98f29e;
            background-color: rgba(255, 255, 255, 0.14);
            box-shadow: inset 0 0 0 1px rgba(152, 242, 158, 0.28);
        }

        .admin-nav-link--active:hover {
            color: #b7fcbc;
        }

        .admin-header-bar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
            padding: 6px 0 12px;
            width: 100%;
            box-sizing: border-box;
        }

        .admin-header-bar .search-cell {
            flex: 1 1 220px;
            min-width: 0;
        }

        .admin-header-bar .search-cell form {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
        }

        .admin-header-bar .search-cell .header-searchbar {
            flex: 1 1 160px;
            min-width: 0;
            width: 100%;
        }

        .admin-header-bar .date-cell {
            flex: 0 0 auto;
            text-align: right;
        }

        .admin-header-bar .cal-cell {
            flex: 0 0 auto;
        }

        .admin-home-title {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            padding: 8px 0;
        }

        .admin-home-title p {
            font-size: clamp(18px, 3.5vw, 23px);
            padding-left: 12px;
            font-weight: 600;
            margin: 0;
        }

        .db-heading-appo {
            font-size: clamp(15px, 3vw, 23px);
            font-weight: 700;
            color: var(--primarycolor);
            padding: 10px clamp(12px, 3%, 48px) 0;
            margin: 0;
        }

        .db-sub-appo {
            font-size: clamp(13px, 2vw, 15px);
            font-weight: 500;
            color: #212529e3;
            line-height: 1.5;
            padding: 4px clamp(12px, 3%, 48px) 16px;
            margin: 0;
        }

        .db-stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            width: 100%;
            box-sizing: border-box;
        }

        .db-stat-card {
            min-width: 0;
        }

        .db-stat-card .dashboard-items {
            height: 100%;
        }

        .admin-twin-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            width: 100%;
            box-sizing: border-box;
            margin-top: 4px;
        }

        .admin-twin-wrapper .twin-panel {
            flex: 1 1 300px;
            min-width: 0;
            box-sizing: border-box;
            background: #fff;
            border-radius: 20px;
            border: 1px solid #e8e8e8;
            box-shadow: var(--shadow-card);
            padding: var(--sp-2);
            overflow: hidden;
        }

        .admin-twin-wrapper .twin-panel .abc {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            height: 220px;
        }

        .admin-twin-wrapper .twin-panel .sub-table {
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

        .twin-action {
            padding: 12px 0 4px;
        }

        @media screen and (max-width: 768px) {
            .admin-dashboard-body {
                padding-top: 18px;
            }

            .admin-dashboard-sidebar {
                padding-top: 18px;
            }

            .admin-sidebar-top {
                padding: 0 14px 16px;
            }

            .admin-sidebar-nav {
                padding: 10px 14px 0;
                gap: 8px;
            }

            .db-stat-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .admin-twin-wrapper {
                flex-direction: column;
            }

            .admin-twin-wrapper .twin-panel {
                flex: 1 1 100%;
                width: 100%;
            }

            .admin-twin-wrapper .twin-panel .abc {
                height: auto;
                max-height: 280px;
            }

            .twin-action {
                padding: 10px 0 2px;
            }

            .twin-action .btn {
                width: 100%;
                max-width: 100%;
                text-align: center;
            }

            .admin-header-bar .date-cell,
            .admin-header-bar .cal-cell {
                display: none;
            }

            .db-heading-appo {
                font-size: 16px;
                padding: 8px 12px 0;
            }

            .db-sub-appo {
                font-size: 13px;
                padding: 4px 12px 12px;
            }

            .db-sub-appo br {
                display: none;
            }

            .admin-home-title p {
                font-size: 20px;
            }

            .h1-dashboard {
                font-size: 24px;
            }

            .h3-dashboard {
                font-size: 13px;
            }
        }

        @media screen and (max-width: 480px) {
            .admin-profile-card {
                padding: 18px 16px;
                border-radius: 20px;
            }

            .admin-profile-avatar-wrap {
                width: 64px;
                height: 64px;
            }

            .admin-nav-link {
                min-height: 50px;
                padding-left: 52px;
                border-radius: 16px;
                font-size: 0.94rem;
            }

            .db-stat-grid {
                gap: 8px;
            }

            .db-stat-card .dashboard-items {
                padding: 14px !important;
            }

            .h1-dashboard {
                font-size: 20px;
            }

            .h3-dashboard {
                font-size: 12px;
            }

            .admin-twin-wrapper .twin-panel .abc {
                max-height: 240px;
            }

            .admin-twin-wrapper .twin-panel .sub-table {
                min-width: 300px;
            }

            .db-heading-appo {
                font-size: 15px;
            }

            .admin-home-title p {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu admin-dashboard-sidebar">
            <div class="admin-sidebar-top">
                <div class="admin-profile-card">
                    <div class="admin-profile-media">
                        <div class="admin-profile-avatar-wrap">
                            <img src="{{ asset('img/user.png') }}" alt="Administrator" class="admin-profile-avatar">
                        </div>
                        <div class="admin-profile-copy">
                            <p class="profile-title">Administrator</p>
                            <p class="profile-subtitle">{{ $admin->aemail }}</p>
                        </div>
                    </div>
                    <div class="admin-profile-actions">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-btn btn-primary-soft btn">Log out</button>
                        </form>
                    </div>
                </div>
            </div>

            <nav class="admin-sidebar-nav" aria-label="Admin dashboard navigation">
                <a href="{{ url('/admin/dashboard') }}" class="admin-nav-link admin-nav-link--active menu-icon-dashbord">Dashboard</a>
                <a href="{{ url('/admin/faculty') }}" class="admin-nav-link menu-icon-faculty">Faculty</a>
                <a href="{{ url('/admin/schedule') }}" class="admin-nav-link menu-icon-schedule">Schedule</a>
                <a href="{{ url('/admin/appointment') }}" class="admin-nav-link menu-icon-appoinment">Appointment</a>
                <a href="{{ url('/admin/student') }}" class="admin-nav-link menu-icon-student">Students</a>
                <a href="{{ url('/admin/settings') }}" class="admin-nav-link menu-icon-settings">Profile</a>
                <button type="button" class="admin-nav-link menu-icon-notifications" id="notification-btn" style="border:none;background-color:transparent;text-align:left;font:inherit;cursor:pointer;">Notifications</button>
            </nav>
        </div>

        <div class="dash-body admin-dashboard-body">
            <div class="page-shell admin-dashboard-shell">
                <div class="admin-header-bar">
                    <div class="search-cell">
                        <form action="{{ url('/admin/faculty') }}" method="post" class="header-search">
                            @csrf
                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Faculty name or Email" list="faculty">
                            <datalist id="faculty">
                                @foreach($facultyList as $fac)
                                    <option value="{{ $fac->facname }}"></option>
                                    <option value="{{ $fac->facemail }}"></option>
                                @endforeach
                            </datalist>
                            <input type="submit" value="Search" class="btn btn-primary-soft" style="padding: 10px 20px;">
                        </form>
                    </div>
                    <div class="date-cell">
                        <p style="font-size:13px;color:rgb(119,119,119);margin:0;">Today's Date</p>
                        <p class="heading-sub12" style="margin:0;">{{ $today }}</p>
                    </div>
                    <div class="cal-cell">
                        <button class="btn-label" style="display:flex;justify-content:center;align-items:center;">
                            <img src="{{ asset('img/calendar.svg') }}" width="28" alt="Calendar">
                        </button>
                    </div>
                </div>

                <div class="admin-home-title">
                    @include('shared.hamburger')
                    <p>Home</p>
                </div>

                <div class="db-stat-grid" style="margin-bottom:16px;">
                    <div class="db-stat-card">
                        <div class="dashboard-items" style="padding:20px;">
                            <div class="h1-dashboard">{{ $facultyCount }}</div><br>
                            <div class="h3-dashboard">Faculty</div>
                        </div>
                    </div>
                    <div class="db-stat-card">
                        <div class="dashboard-items" style="padding:20px;">
                            <div class="h1-dashboard">{{ $studentCount }}</div><br>
                            <div class="h3-dashboard">Students</div>
                        </div>
                    </div>
                    <div class="db-stat-card">
                        <div class="dashboard-items" style="padding:20px;">
                            <div class="h1-dashboard">{{ $appointmentCount }}</div><br>
                            <div class="h3-dashboard">New Bookings</div>
                        </div>
                    </div>
                    <div class="db-stat-card">
                        <div class="dashboard-items" style="padding:20px;">
                            <div class="h1-dashboard">{{ $scheduleCount }}</div><br>
                            <div class="h3-dashboard">Today Sessions</div>
                        </div>
                    </div>
                </div>

                <div class="admin-twin-wrapper">
                    <div class="twin-panel">
                        <p class="db-heading-appo">Upcoming Appointments until Next {{ date("l",strtotime("+1 week")) }}</p>
                        <p class="db-sub-appo">
                            Here's quick access to upcoming appointments in the next 7 days.<br>
                            More details are available in the Appointment section.
                        </p>
                        <div class="abc">
                            <table width="100%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th class="table-headin" style="font-size:12px;">Appt #</th>
                                        <th class="table-headin">Student</th>
                                        <th class="table-headin">Faculty</th>
                                        <th class="table-headin">Session</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($upcomingAppointments->count() == 0)
                                        <tr>
                                            <td colspan="4">
                                                <div class="db-empty">
                                                    <img src="{{ asset('img/notfound.svg') }}" alt="Not found">
                                                    <p>No upcoming appointments found.</p>
                                                    <a class="non-style-link" href="{{ url('/admin/appointment') }}">
                                                        <button class="btn btn-primary-soft">Show all Appointments</button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($upcomingAppointments as $appo)
                                            <tr>
                                                <td style="text-align:left;font-size:20px;font-weight:500;color:var(--btnnicetext);padding:var(--sp-1) var(--sp-2);">{{ $appo->apponum }}</td>
                                                <td style="font-weight:600;">{{ substr($appo->sname,0,25) }}</td>
                                                <td style="font-weight:500;">{{ substr($appo->facname,0,25) }}</td>
                                                <td class="date-col">{{ substr($appo->title,0,15) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="twin-action">
                            <a href="{{ url('/admin/appointment') }}" class="non-style-link">
                                <button class="btn btn-primary">Show all Appointments</button>
                            </a>
                        </div>
                    </div>

                    <div class="twin-panel">
                        <p class="db-heading-appo" style="text-align:left;">Upcoming Sessions until Next {{ date("l",strtotime("+1 week")) }}</p>
                        <p class="db-sub-appo">
                            Here's quick access to upcoming sessions scheduled in the next 7 days.<br>
                            Add, remove, and manage more in the Schedule section.
                        </p>
                        <div class="abc">
                            <table width="100%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th class="table-headin">Session Title</th>
                                        <th class="table-headin">Faculty</th>
                                        <th class="table-headin">Date &amp; Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($upcomingSessions->count() == 0)
                                        <tr>
                                            <td colspan="3">
                                                <div class="db-empty">
                                                    <img src="{{ asset('img/notfound.svg') }}" alt="Not found">
                                                    <p>No upcoming sessions found.</p>
                                                    <a class="non-style-link" href="{{ url('/admin/schedule') }}">
                                                        <button class="btn btn-primary-soft">Show all Sessions</button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($upcomingSessions as $session)
                                            <tr>
                                                <td>{{ substr($session->title,0,30) }}</td>
                                                <td>{{ substr($session->facname,0,20) }}</td>
                                                <td class="date-col">{{ substr($session->scheduledate,0,10) }} {{ substr($session->scheduletime,0,5) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="twin-action">
                            <a href="{{ url('/admin/schedule') }}" class="non-style-link">
                                <button class="btn btn-primary">Show all Sessions</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('shared.notifications')
</body>
</html>
