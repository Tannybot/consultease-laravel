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
        .dashbord-tables { animation: transitionIn-Y-over 0.5s; }
        .filter-container { animation: transitionIn-Y-bottom 0.5s; }
        .sub-table, .anime { animation: transitionIn-Y-bottom 0.5s; }

        /* ─── Student dashboard scoped styles ─── */

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

        .stu-header-bar .stu-cal-cell { flex: 0 0 auto; }

        /* Hero section */
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

        /* Search form inside hero */
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

        /* Lower section: status + bookings side-by-side */
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
            border-radius: var(--radius);
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

        /* Empty state */
        .db-empty {
            text-align: center;
            padding: 24px 12px;
        }

        .db-empty img { width: 70px; max-width: 25%; }

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
            .stu-lower { flex-direction: column; }

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
            .stu-header-bar .stu-cal-cell { display: none; }

            .stu-hero p br { display: none; }

            .stu-status-heading {
                font-size: 18px;
                padding: 0 0 6px 4px;
            }

            .stu-panel-heading {
                font-size: 18px;
            }
        }

        @media screen and (max-width: 480px) {
            .stu-bookings-col .abc { max-height: 240px; }
            .stu-bookings-col .sub-table { min-width: 300px; }

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
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="{{ $student->profile_pic ? asset('storage/' . $student->profile_pic) : asset('img/user.png') }}" alt="Profile" style="width:91.85px;height:91.85px;object-fit:cover;border-radius:50%">
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
                    <td class="menu-btn menu-icon-home menu-active menu-icon-home-active">
                        <a href="{{ url('/student/dashboard') }}" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Home</p></div></a>
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
                    <td class="menu-btn menu-icon-settings">
                        <a href="{{ url('/student/settings') }}" class="non-style-link-menu"><div><p class="menu-text">Settings</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-notifications" id="notification-btn">
                        <div><p class="menu-text">Notifications</p></div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="dash-body" style="margin-top:15px">

            {{-- ── Header bar ── --}}
            <div class="stu-header-bar">
                <div class="stu-title-cell">
                    @include('components.hamburger')
                    <p>Home</p>
                </div>
                <div class="stu-date-cell">
                    <p style="font-size:13px;color:rgb(119,119,119);margin:0;">Today's Date</p>
                    <p class="heading-sub12" style="margin:0;">{{ $today }}</p>
                </div>
                <div class="stu-cal-cell">
                    <button class="btn-label" style="display:flex;justify-content:center;align-items:center;">
                        <img src="{{ asset('img/calendar.svg') }}" width="28">
                    </button>
                </div>
            </div>

            {{-- ── Hero welcome section ── --}}
            <table class="filter-container faculty-header student-header stu-hero" border="0" style="border:none;">
                <tr>
                    <td>
                        <h3>Welcome!</h3>
                        <h1>{{ $student->sname }}</h1>
                        <p>
                            Have a problem in our School Appointment System?<br>
                            No problem — let's jump to All Faculty section or Sessions!<br>
                            Track your past and future appointment history.<br>
                            You can also find out the expected arrival time of your faculty member or academic consultant.
                        </p>
                        <h3>Channel a Faculty Here</h3>
                        <form action="{{ url('/student/schedule') }}" method="post" class="stu-search-form">
                            @csrf
                            <input type="search" name="search" class="input-text stu-search-input" placeholder="Search a Faculty name to find available sessions" list="faculty">
                            <datalist id="faculty">
                                {{-- Options populated natively --}}
                            </datalist>
                            <input type="Submit" value="Search" class="btn btn-primary stu-search-btn">
                        </form>
                    </td>
                </tr>
            </table>

            {{-- ── Lower section: status + bookings ── --}}
            <div class="stu-lower">

                {{-- Status grid --}}
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

                {{-- Upcoming bookings --}}
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
                                                    <button class="btn btn-primary-soft">&nbsp;Channel a Faculty&nbsp;</button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach($upcomingBookings as $booking)
                                        <tr>
                                            <td style="font-size:20px;font-weight:700;padding:var(--sp-1) var(--sp-2);">&nbsp;{{ $booking->apponum }}</td>
                                            <td>&nbsp;{{ substr($booking->title,0,30) }}</td>
                                            <td>{{ substr($booking->facname,0,20) }}</td>
                                            <td class="date-col">
                                                {{ substr($booking->scheduledate,0,10) }} {{ substr($booking->scheduletime,0,5) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>{{-- end stu-lower --}}

        </div>{{-- end dash-body --}}

    </div>{{-- end container --}}

    @include('components.notifications')
</body>
</html>
