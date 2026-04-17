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
    <title>Appointments</title>
    <style>
        .popup,
        .sub-table,
        .page-card {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu" id="menu">
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
                    <td class="menu-btn menu-icon-appoinment menu-active menu-icon-appoinment-active">
                        <a href="{{ url('/student/appointment') }}" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">My Bookings</p></div></a>
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

        <div class="dash-body" id="dash-body">
            <div class="page-shell">
                <div class="page-toolbar">
                    <div class="page-toolbar__group">
                        <a href="{{ url('/student/dashboard') }}" class="non-style-link">
                            <button class="login-btn btn-primary-soft btn btn-icon-back">Back</button>
                        </a>
                        <div>
                            <div class="page-toolbar__group">
                                @include('shared.hamburger')
                                <h1 class="page-toolbar__title">My Bookings</h1>
                            </div>
                            <p class="page-toolbar__subtitle">Review upcoming appointments, filter by date, and manage bookings from one place.</p>
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

                <div class="page-card">
                    <div class="page-card__header">
                        <div>
                            <span class="page-card__eyebrow">Filter</span>
                            <h2 class="page-card__title">Find appointments by date</h2>
                            <p class="page-card__description">Use the date filter below to quickly narrow your bookings.</p>
                        </div>
                    </div>

                    <form action="{{ url('/student/appointment') }}" method="post" class="toolbar-search">
                        @csrf
                        <input type="date" name="sheduledate" id="date" class="input-text" aria-label="Filter appointments by date">
                        <input type="submit" name="filter" value="Filter" class="btn-primary-soft btn button-icon btn-filter">
                    </form>
                </div>

                <div class="page-card">
                    <div class="page-card__header">
                        <div>
                            <span class="page-card__eyebrow">Appointments</span>
                            <h2 class="page-card__title">My bookings ({{ $appointments->count() }})</h2>
                            <p class="page-card__description">Keep track of your booking references, session schedule, and faculty details.</p>
                        </div>
                    </div>

                    @if($appointments->count() == 0)
                        <div class="empty-state">
                            <img src="{{ asset('img/notfound.svg') }}" alt="No appointments found">
                            <p>We could not find any appointments related to your current filter.</p>
                            <a class="non-style-link" href="{{ url('/student/appointment') }}">
                                <button class="login-btn btn-primary-soft btn">Show all appointments</button>
                            </a>
                        </div>
                    @else
                        <div class="record-card-grid">
                            @foreach($appointments as $appo)
                                <div class="record-card">
                                    <div>
                                        <p class="record-card__meta"><strong>Booking date:</strong> {{ substr($appo->appodate,0,30) }}</p>
                                        <p class="record-card__meta"><strong>Reference:</strong> OC-000-{{ $appo->appoid }}</p>
                                    </div>

                                    <div>
                                        <h3 class="record-card__title">{{ substr($appo->title,0,21) }}</h3>
                                        <p class="record-card__copy">{{ substr($appo->facname,0,30) }}</p>
                                    </div>

                                    <div>
                                        <p class="record-card__meta"><strong>Appointment number:</strong> 0{{ $appo->apponum }}</p>
                                        <p class="record-card__meta"><strong>Scheduled date:</strong> {{ $appo->scheduledate }}</p>
                                        <p class="record-card__meta"><strong>Starts:</strong> {{ substr($appo->scheduletime,0,5) }} (24h)</p>
                                    </div>

                                    <div class="record-card__actions">
                                        <a href="?action=drop&id={{ $appo->appoid }}&title={{ urlencode($appo->title) }}&doc={{ urlencode($appo->facname) }}" class="non-style-link">
                                            <button class="login-btn btn-primary-soft btn">Cancel Booking</button>
                                        </a>
                                        @if($appo->status == 'done')
                                            <a href="?action=review&id={{ $appo->appoid }}" class="non-style-link">
                                                <button class="login-btn btn-primary btn">Review Faculty</button>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($action=='drop')
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2>Cancel this booking?</h2>
                    <a class="close" href="{{ url('/student/appointment') }}">&times;</a>
                    <div class="content">
                        You are about to cancel this appointment.<br><br>
                        Faculty name: <b>{{ urldecode($docParam) }}</b><br>
                        Session title: <b>{{ urldecode($titleParam) }}</b>
                    </div>
                    <div class="dialog-actions">
                        <form action="{{ route('student.appointment.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="appoid" value="{{ $id }}">
                            <button type="submit" class="btn-primary btn">Yes, cancel</button>
                        </form>
                        <a href="{{ url('/student/appointment') }}" class="non-style-link">
                            <button class="btn-primary-soft btn">Keep booking</button>
                        </a>
                    </div>
                </center>
            </div>
        </div>
    @endif

    @include('shared.notifications')
</body>
</html>
