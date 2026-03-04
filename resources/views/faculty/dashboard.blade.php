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
        .dashbord-tables, .faculty-heade { animation: transitionIn-Y-over 0.5s; }
        .filter-container { animation: transitionIn-Y-bottom 0.5s; }
        .sub-table, #anim { animation: transitionIn-Y-bottom 0.5s; }
        .faculty-heade { animation: transitionIn-Y-over 0.5s; }

        /* ─── Faculty dashboard scoped styles ─── */

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

        .fac-header-bar .fac-cal-cell { flex: 0 0 auto; }

        /* Hero welcome section */
        .fac-hero {
            width: 100%;
            box-sizing: border-box;
            padding: 20px clamp(14px, 3%, 30px) !important;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .fac-hero h1 {
            font-size: clamp(20px, 5vw, 32px);
            margin: 4px 0 8px;
        }

        .fac-hero h3 {
            font-size: clamp(14px, 3vw, 18px);
        }

        .fac-hero p {
            font-size: clamp(13px, 2.5vw, 15px);
            line-height: 1.6;
        }

        /* Hero CTA button: touch-friendly, auto-width */
        .fac-hero-btn {
            width: auto !important;
            min-width: 180px;
            padding: var(--sp-1) var(--sp-3);
            margin-top: var(--sp-1);
        }

        /* Sessions section heading */
        .fac-sessions-heading {
            font-size: clamp(16px, 3vw, 20px);
            font-weight: 600;
            padding: var(--sp-2) 0 var(--sp-1) clamp(12px, 3%, 40px);
            margin: 0;
        }

        /* Sessions panel card wrapper */
        .fac-sessions-card {
            background: #fff;
            border-radius: var(--radius);
            border: 1px solid #e8e8e8;
            box-shadow: var(--shadow-card);
            padding: var(--sp-2);
            overflow: hidden;
        }

        /* Sessions abc scroll container */
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
            .fac-header-bar .fac-date-cell,
            .fac-header-bar .fac-cal-cell { display: none; }

            .fac-hero-btn {
                width: 100% !important;
                min-width: unset;
            }

            .fac-sessions-abc {
                height: auto;
                max-height: 280px;
            }
        }

        @media screen and (max-width: 480px) {
            .fac-sessions-abc {
                max-height: 240px;
            }

            .fac-sessions-abc .sub-table {
                min-width: 320px;
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
                                    <img src="{{ $faculty->profile_pic ? asset('storage/' . $faculty->profile_pic) : asset('img/user.png') }}" alt="" style="width:91.85px;height:91.85px;object-fit:cover;border-radius:50%">
                                </td>
                                <td style="padding:0;margin:0;">
                                    <p class="profile-title">{{ substr($faculty->facname,0,13) }}..</p>
                                    <p class="profile-subtitle">{{ substr($faculty->facemail,0,22) }}</p>
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
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active">
                        <a href="{{ url('/faculty/dashboard') }}" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Dashboard</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="{{ url('/faculty/appointment') }}" class="non-style-link-menu"><div><p class="menu-text">My Appointments</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-session">
                        <a href="{{ url('/faculty/schedule') }}" class="non-style-link-menu"><div><p class="menu-text">My Sessions</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-student">
                        <a href="{{ url('/faculty/student') }}" class="non-style-link-menu"><div><p class="menu-text">My Students</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-settings">
                        <a href="{{ url('/faculty/settings') }}" class="non-style-link-menu"><div><p class="menu-text">Settings</p></div></a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="dash-body" id="dash-body" style="margin-top:15px">

            {{-- ── Header bar ── --}}
            <div class="fac-header-bar">
                <div class="fac-title-cell">
                    @include('components.hamburger')
                    <p>Home</p>
                </div>
                <div class="fac-date-cell">
                    <p style="font-size:13px;color:rgb(119,119,119);margin:0;">Today's Date</p>
                    <p class="heading-sub12" style="margin:0;">{{ $today }}</p>
                </div>
                <div class="fac-cal-cell">
                    <button class="btn-label" style="display:flex;justify-content:center;align-items:center;">
                        <img src="{{ asset('img/calendar.svg') }}" width="28">
                    </button>
                </div>
            </div>

            {{-- ── Hero welcome section ── --}}
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

            {{-- ── Upcoming sessions ── --}}
            <p id="anim" class="fac-sessions-heading">Your upcoming Sessions until Next week</p>

            <div class="fac-sessions-card">
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
                                                <button class="btn btn-primary-soft">&nbsp;Show all Sessions&nbsp;</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach($upcomingSessions as $session)
                                    <tr>
                                        <td>&nbsp;{{ substr($session->title,0,30) }}</td>
                                        <td class="date-col">{{ substr($session->scheduledate,0,10) }}</td>
                                        <td class="date-col">{{ substr($session->scheduletime,0,5) }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>{{-- end dash-body --}}
    </div>{{-- end container --}}

    @include('components.notifications')
</body>
</html>
