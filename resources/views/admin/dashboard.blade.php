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
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        /* ---- Admin dashboard scoped overrides ---- */

        /* Header row: flex container */
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

        /* Home title row */
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

        /* Section headings */
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

        /* Stat widget grid */
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

        /* Twin table panels wrapper */
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

        /* Admin twin panel scoped overrides */
        .admin-twin-wrapper .twin-panel {
            background: #fff;
            border-radius: var(--radius);
            border: 1px solid #e8e8e8;
            box-shadow: var(--shadow-card);
            padding: var(--sp-2);
            overflow: hidden;
        }

        .twin-action {
            padding: 12px 0 4px;
        }

        @media screen and (max-width: 768px) {
            /* Stat grid: 2 columns on tablet/mobile */
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
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="{{ asset('img/user.png') }}" alt="User Icon" style="width: 91.85px; height: 91.85px; border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">{{ $admin->aemail }}</p>
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
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active" >
                        <a href="{{ url('/admin/dashboard') }}" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Dashboard</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-faculty ">
                        <a href="{{ url('/admin/faculty') }}" class="non-style-link-menu "><div><p class="menu-text">Faculty</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule">
                        <a href="{{ url('/admin/schedule') }}" class="non-style-link-menu"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="{{ url('/admin/appointment') }}" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-student">
                        <a href="{{ url('/admin/student') }}" class="non-style-link-menu"><div><p class="menu-text">Students</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="{{ url('/admin/settings') }}" class="non-style-link-menu"><div><p class="menu-text">Profile</p></div></a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="dash-body" style="margin-top: 15px">

            {{-- ── Top header bar ── --}}
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
                        <input type="Submit" value="Search" class="btn btn-primary-soft" style="padding: 10px 20px;">
                    </form>
                </div>
                <div class="date-cell">
                    <p style="font-size:13px;color:rgb(119,119,119);margin:0;">Today's Date</p>
                    <p class="heading-sub12" style="margin:0;">{{ $today }}</p>
                </div>
                <div class="cal-cell">
                    <button class="btn-label" style="display:flex;justify-content:center;align-items:center;">
                        <img src="{{ asset('img/calendar.svg') }}" width="28">
                    </button>
                </div>
            </div>

            {{-- ── Home title + hamburger ── --}}
            <div class="admin-home-title">
                @include('shared.hamburger')
                <p>Home</p>
            </div>

            {{-- ── Stat widget grid ── --}}
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

            {{-- ── Twin panels: Appointments + Sessions ── --}}
            <div class="admin-twin-wrapper">

                {{-- Appointments panel --}}
                <div class="twin-panel">
                    <p class="db-heading-appo">
                        Upcoming Appointments until Next {{ date("l",strtotime("+1 week")) }}
                    </p>
                    <p class="db-sub-appo">
                        Here's Quick access to Upcoming Appointments until 7 days<br>
                        More details available in @Appointment section.
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
                                                    <button class="btn btn-primary-soft">&nbsp;Show all Appointments&nbsp;</button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach($upcomingAppointments as $appo)
                                        <tr>
                                            <td style="text-align:left;font-size:20px;font-weight:500;color:var(--btnnicetext);padding:var(--sp-1) var(--sp-2);">{{ $appo->apponum }}</td>
                                            <td style="font-weight:600;">&nbsp;{{ substr($appo->sname,0,25) }}</td>
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

                {{-- Sessions panel --}}
                <div class="twin-panel">
                    <p class="db-heading-appo" style="text-align:left;">
                        Upcoming Sessions until Next {{ date("l",strtotime("+1 week")) }}
                    </p>
                    <p class="db-sub-appo">
                        Here's Quick access to Upcoming Sessions scheduled until 7 days<br>
                        Add, Remove and many features available in @Schedule section.
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
                                                    <button class="btn btn-primary-soft">&nbsp;Show all Sessions&nbsp;</button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach($upcomingSessions as $session)
                                        <tr>
                                            <td>&nbsp;{{ substr($session->title,0,30) }}</td>
                                            <td>{{ substr($session->facname,0,20) }}</td>
                                            <td class="date-col">
                                                {{ substr($session->scheduledate,0,10) }} {{ substr($session->scheduletime,0,5) }}
                                            </td>
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

            </div>{{-- end admin-twin-wrapper --}}

        </div>{{-- end dash-body --}}
    </div>{{-- end container --}}

</body>
</html>
