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
        .sub-table,
        .anime {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .stu-dashboard-body {
            margin-top: 0 !important;
            padding-top: 22px;
        }

        .stu-dashboard-shell {
            gap: 20px;
        }

        .stu-dashboard-sidebar {
            display: flex;
            flex-direction: column;
            padding: 22px 0 18px;
        }

        .stu-sidebar-top {
            padding: 0 18px 18px;
        }

        .stu-profile-card {
            display: grid;
            gap: 18px;
            padding: 22px 20px;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04);
        }

        .stu-profile-media {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .stu-profile-avatar-wrap {
            width: 74px;
            height: 74px;
            border-radius: 50%;
            padding: 6px;
            background: rgba(255, 255, 255, 0.14);
            box-shadow: 0 10px 26px rgba(7, 23, 10, 0.2);
            flex-shrink: 0;
        }

        .stu-profile-avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            background: rgba(255, 255, 255, 0.12);
        }

        .stu-profile-copy {
            min-width: 0;
            display: grid;
            gap: 4px;
        }

        .stu-profile-copy .profile-title {
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

        .stu-profile-copy .profile-subtitle {
            padding-left: 0;
            margin: 0;
            font-size: 0.92rem;
            color: rgba(255, 255, 255, 0.76);
            line-height: 1.55;
            word-break: break-word;
        }

        .stu-profile-actions .logout-btn {
            width: 100%;
            justify-content: center;
            min-height: 46px;
            margin-top: 0;
            font-weight: 600;
        }

        .stu-sidebar-nav {
            display: grid;
            gap: 10px;
            padding: 14px 18px 0;
        }

        .stu-nav-link {
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

        .stu-nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.11);
            transform: translateX(2px);
        }

        .stu-nav-link--active {
            color: #98f29e;
            background-color: rgba(255, 255, 255, 0.14);
            box-shadow: inset 0 0 0 1px rgba(152, 242, 158, 0.28);
        }

        .stu-nav-link--active:hover {
            color: #b7fcbc;
        }

        .stu-header-bar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
            padding: 6px 0 12px;
            width: 100%;
            box-sizing: border-box;
        }

        .stu-header-bar .stu-title-cell {
            flex: 1 1 auto;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stu-header-bar .stu-title-cell p {
            font-size: clamp(18px, 3.5vw, 23px);
            font-weight: 600;
            margin: 0;
            padding-left: 12px;
        }

        .stu-header-bar .stu-date-cell {
            flex: 0 0 auto;
            text-align: right;
        }

        .stu-header-bar .stu-cal-cell {
            flex: 0 0 auto;
        }

        .stu-hero {
            width: 100%;
            box-sizing: border-box;
            padding: var(--sp-3) var(--sp-2) !important;
            border-radius: var(--radius);
            margin-bottom: var(--sp-2);
        }

        .stu-hero h1 {
            font-size: clamp(20px, 5vw, 32px);
            margin: 4px 0 8px;
        }

        .stu-hero h3 {
            font-size: clamp(14px, 3vw, 18px);
        }

        .stu-hero p {
            font-size: clamp(13px, 2.5vw, 15px);
            line-height: 1.6;
        }

        .stu-search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
            margin-top: 8px;
        }

        .stu-search-form .stu-search-input {
            flex: 1 1 180px;
            min-width: 0;
        }

        .stu-search-form .stu-search-btn {
            flex: 0 0 auto;
            white-space: nowrap;
            padding: 10px 20px;
        }

        .stu-lower {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .stu-lower .stu-status-col {
            flex: 1 1 280px;
            min-width: 0;
        }

        .stu-lower .stu-bookings-col {
            flex: 1 1 280px;
            min-width: 0;
            background: #fff;
            border-radius: 20px;
            border: 1px solid #e8e8e8;
            box-shadow: var(--shadow-card);
            padding: var(--sp-2);
            overflow: hidden;
        }

        .stu-status-col .stu-status-heading {
            font-size: clamp(16px, 3vw, 20px);
            font-weight: 600;
            padding: 0 0 8px 8px;
            margin: 0;
        }

        .stu-bookings-col .stu-panel-heading {
            font-size: clamp(16px, 3vw, 20px);
            font-weight: 600;
            padding: 0 0 8px 8px;
            margin: 0;
            animation: transitionIn-Y-bottom 0.5s;
        }

        .stu-bookings-col .abc {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            height: 270px;
        }

        .stu-bookings-col .sub-table {
            width: 100%;
            min-width: 400px;
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
            .stu-dashboard-body {
                padding-top: 18px;
            }

            .stu-dashboard-sidebar {
                padding-top: 18px;
            }

            .stu-sidebar-top {
                padding: 0 14px 16px;
            }

            .stu-sidebar-nav {
                padding: 10px 14px 0;
                gap: 8px;
            }

            .stu-lower {
                flex-direction: column;
            }

            .stu-lower .stu-status-col,
            .stu-lower .stu-bookings-col {
                flex: 1 1 100%;
                width: 100%;
            }

            .stu-bookings-col .abc {
                height: auto;
                max-height: 280px;
            }

            .stu-header-bar .stu-date-cell,
            .stu-header-bar .stu-cal-cell {
                display: none;
            }

            .stu-hero p br {
                display: none;
            }

            .stu-status-heading {
                font-size: 18px;
                padding: 0 0 6px 4px;
            }

            .stu-panel-heading {
                font-size: 18px;
            }
        }

        @media screen and (max-width: 480px) {
            .stu-profile-card {
                padding: 18px 16px;
                border-radius: 20px;
            }

            .stu-profile-avatar-wrap {
                width: 64px;
                height: 64px;
            }

            .stu-nav-link {
                min-height: 50px;
                padding-left: 52px;
                border-radius: 16px;
                font-size: 0.94rem;
            }

            .stu-bookings-col .abc {
                max-height: 240px;
            }

            .stu-bookings-col .sub-table {
                min-width: 300px;
            }

            .stu-hero {
                padding: var(--sp-2) var(--sp-1) !important;
            }

            .stu-hero h1 {
                font-size: 20px;
            }

            .stu-hero p {
                font-size: 13px;
            }

            .stu-search-form .stu-search-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu stu-dashboard-sidebar">
            <div class="stu-sidebar-top">
                <div class="stu-profile-card">
                    <div class="stu-profile-media">
                        <div class="stu-profile-avatar-wrap">
                            <img
                                src="{{ $student->profile_pic ? asset('storage/' . $student->profile_pic) : asset('img/user.png') }}"
                                alt="{{ $student->sname }}"
                                class="stu-profile-avatar"
                            >
                        </div>
                        <div class="stu-profile-copy">
                            <p class="profile-title">{{ $student->sname }}</p>
                            <p class="profile-subtitle">{{ $student->semail }}</p>
                        </div>
                    </div>
                    <div class="stu-profile-actions">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-btn btn-primary-soft btn">Log out</button>
                        </form>
                    </div>
                </div>
            </div>

            <nav class="stu-sidebar-nav" aria-label="Student dashboard navigation">
                <a href="{{ url('/student/dashboard') }}" class="stu-nav-link stu-nav-link--active menu-icon-home">Home</a>
                <a href="{{ url('/student/faculty') }}" class="stu-nav-link menu-icon-faculty">All Faculty</a>
                <a href="{{ url('/student/schedule') }}" class="stu-nav-link menu-icon-session">Scheduled Sessions</a>
                <a href="{{ url('/student/appointment') }}" class="stu-nav-link menu-icon-appoinment">My Bookings</a>
                <a href="{{ url('/student/settings') }}" class="stu-nav-link menu-icon-settings">Settings</a>
                <button type="button" class="stu-nav-link menu-icon-notifications" id="notification-btn" style="border:none;background-color:transparent;text-align:left;">Notifications</button>
            </nav>
        </div>

        <div class="dash-body stu-dashboard-body">
            <div class="page-shell stu-dashboard-shell">
                <div class="stu-header-bar">
                    <div class="stu-title-cell">
                        @include('shared.hamburger')
                        <p>Home</p>
                    </div>
                    <div class="stu-date-cell">
                        <p style="font-size:13px;color:rgb(119,119,119);margin:0;">Today's Date</p>
                        <p class="heading-sub12" style="margin:0;">{{ $today }}</p>
                    </div>
                    <div class="stu-cal-cell">
                        <button class="btn-label" style="display:flex;justify-content:center;align-items:center;">
                            <img src="{{ asset('img/calendar.svg') }}" width="28" alt="Calendar">
                        </button>
                    </div>
                </div>

                <table class="filter-container faculty-header student-header stu-hero" border="0" style="border:none;">
                    <tr>
                        <td>
                            <h3>Welcome!</h3>
                            <h1>{{ $student->sname }}</h1>
                            <p>
                                Have a problem in SNSU School Appointment System?<br>
                                No problem, let's jump to the All Faculty section or Sessions.<br>
                                Track your past and future appointment history.<br>
                                You can also find out the expected arrival time of your faculty member or academic consultant.
                            </p>
                            <h3>Channel a Faculty Here</h3>
                            <form action="{{ url('/student/schedule') }}" method="post" class="stu-search-form">
                                @csrf
                                <input type="search" name="search" class="input-text stu-search-input" placeholder="Search a Faculty name to find available sessions" list="faculty">
                                <datalist id="faculty"></datalist>
                                <input type="submit" value="Search" class="btn btn-primary stu-search-btn">
                            </form>
                        </td>
                    </tr>
                </table>

                <div class="stu-lower">
                    <div class="stu-status-col">
                        <p class="stu-status-heading">Status</p>
                        <div class="db-stat-grid">
                            <div class="db-stat-card">
                                <div class="dashboard-items" style="padding:16px;">
                                    <div class="h1-dashboard">{{ $facultyCount }}</div><br>
                                    <div class="h3-dashboard">All Faculty</div>
                                </div>
                            </div>
                            <div class="db-stat-card">
                                <div class="dashboard-items" style="padding:16px;">
                                    <div class="h1-dashboard">{{ $studentCount }}</div><br>
                                    <div class="h3-dashboard">All Students</div>
                                </div>
                            </div>
                            <div class="db-stat-card">
                                <div class="dashboard-items" style="padding:16px;">
                                    <div class="h1-dashboard">{{ $appointmentCount }}</div><br>
                                    <div class="h3-dashboard">New Booking</div>
                                </div>
                            </div>
                            <div class="db-stat-card">
                                <div class="dashboard-items" style="padding:16px;">
                                    <div class="h1-dashboard">{{ $scheduleCount }}</div><br>
                                    <div class="h3-dashboard">Today Sessions</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="stu-bookings-col">
                        <p class="stu-panel-heading">Your Upcoming Bookings</p>
                        <div class="abc">
                            <table width="100%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th class="table-headin">Appt. #</th>
                                        <th class="table-headin">Session</th>
                                        <th class="table-headin">Faculty</th>
                                        <th class="table-headin">Date &amp; Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($upcomingBookings->count() == 0)
                                        <tr>
                                            <td colspan="4">
                                                <div class="db-empty">
                                                    <img src="{{ asset('img/notfound.svg') }}" alt="Not found">
                                                    <p>Nothing to show here!</p>
                                                    <a class="non-style-link" href="{{ url('/student/schedule') }}">
                                                        <button class="btn btn-primary-soft">Channel a Faculty</button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($upcomingBookings as $booking)
                                            <tr>
                                                <td style="font-size:20px;font-weight:700;padding:var(--sp-1) var(--sp-2);">{{ $booking->apponum }}</td>
                                                <td>{{ substr($booking->title,0,30) }}</td>
                                                <td>{{ substr($booking->facname,0,20) }}</td>
                                                <td class="date-col">{{ substr($booking->scheduledate,0,10) }} {{ substr($booking->scheduletime,0,5) }}</td>
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
