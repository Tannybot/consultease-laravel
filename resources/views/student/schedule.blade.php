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
    <title>Sessions</title>
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
    <div class="menu">
        <table class="menu-container" border="0">
            <tr>
                <td style="padding:10px" colspan="2">
                    <table border="0" class="profile-container">
                        <tr>
                            <td width="30%" style="padding-left:20px">
                                <img src="{{ $student->profile_pic ? asset('storage/' . $student->profile_pic) : asset('img/user.png') }}" alt="Profile" style="width: 91.85px; height: 91.85px; object-fit: cover; border-radius:50%">
                            </td>
                            <td style="padding:0;margin:0;">
                                <p class="profile-title">{{ substr($student->sname,0,13) }}..</p>
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
                <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
                    <a href="{{ url('/student/schedule') }}" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Scheduled Sessions</p></div></a>
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
                            <h1 class="page-toolbar__title">Scheduled Sessions</h1>
                        </div>
                        <p class="page-toolbar__subtitle">Search sessions, check capacity, and reserve the schedule that fits your needs.</p>
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

            <div class="page-card">
                <div class="page-action-row">
                    <div>
                        <span class="page-card__eyebrow">Search</span>
                        <h2 class="page-card__title">Find available sessions</h2>
                        <p class="page-card__description">Search by faculty name, session title, or date to narrow available schedules.</p>
                    </div>
                    <a href="?action=add-session&id=none&error=0" class="non-style-link">
                        <button class="login-btn btn-primary btn button-icon" style="background-image: url('{{ asset('img/icons/add.svg') }}'); padding-left: 36px;">Schedule Session</button>
                    </a>
                </div>

                <form action="{{ url('/student/schedule') }}" method="post" class="toolbar-search" style="margin-top: 18px;">
                    @csrf
                    <input type="search" name="search" class="input-text header-searchbar" placeholder="Search faculty name, title, or date" list="faculty" value="{{ $searchQuery }}">
                    <datalist id="faculty">
                        @foreach($allFaculties as $fac)
                            <option value="{{ $fac->facname }}"></option>
                        @endforeach
                        @foreach($allTitles as $t)
                            <option value="{{ $t->title }}"></option>
                        @endforeach
                    </datalist>
                    <input type="submit" value="Search" class="login-btn btn-primary btn">
                </form>
            </div>

            @if(session('error'))
                <div class="status-banner status-banner--error">{{ session('error') }}</div>
            @endif

            <div class="page-card">
                <div class="page-card__header">
                    <div>
                        <span class="page-card__eyebrow">{{ $searchType }}</span>
                        <h2 class="page-card__title">{{ $searchType }} Sessions ({{ $schedules->count() }})</h2>
                        <p class="page-card__description">
                            @if($searchQuery != '')
                                Showing results for "{{ $searchQuery }}".
                            @else
                                Browse all currently available sessions.
                            @endif
                        </p>
                    </div>
                </div>

                @if($schedules->count() == 0)
                    <div class="empty-state">
                        <img src="{{ asset('img/notfound.svg') }}" alt="No sessions found">
                        <p>We could not find any sessions related to your search.</p>
                        <a class="non-style-link" href="{{ url('/student/schedule') }}">
                            <button class="login-btn btn-primary-soft btn">Show all sessions</button>
                        </a>
                    </div>
                @else
                    <div class="record-card-grid">
                        @foreach($schedules as $sched)
                            @php
                                $currentBookings = isset($scheduleCapacities[$sched->scheduleid]) ? $scheduleCapacities[$sched->scheduleid] : 0;
                                $isBooked = in_array($sched->scheduleid, $myBookings);
                                $isFull = $currentBookings >= $sched->nop;
                            @endphp

                            <div class="record-card">
                                <div>
                                    <h3 class="record-card__title">{{ substr($sched->title,0,21) }}</h3>
                                    <p class="record-card__copy">{{ substr($sched->facname,0,30) }}</p>
                                </div>

                                <div>
                                    <p class="record-card__meta"><strong>Date:</strong> {{ $sched->scheduledate }}</p>
                                    <p class="record-card__meta"><strong>Starts:</strong> {{ substr($sched->scheduletime,0,5) }} (24h)</p>
                                    <p class="record-card__meta"><strong>Capacity:</strong> {{ $currentBookings }} / {{ $sched->nop }}</p>
                                </div>

                                <div class="record-card__actions">
                                    @if($isBooked)
                                        @php $bookedAppoId = $myAppointments[$sched->scheduleid]; @endphp
                                        <a href="?action=drop&id={{ $bookedAppoId }}&title={{ urlencode($sched->title) }}&doc={{ urlencode($sched->facname) }}" class="non-style-link">
                                            <button class="login-btn btn-primary-soft btn">Cancel Booking</button>
                                        </a>
                                    @elseif($isFull)
                                        <button class="login-btn btn" style="background-color:#ffe0e0;color:#cc0000;cursor:not-allowed;" disabled>Session Full</button>
                                    @else
                                        <a
                                            href="{{ url('/student/appointment?action=add&id='.$sched->scheduleid) }}"
                                            class="non-style-link"
                                            onclick="sendEmailJSAndBook(event, '{{ addslashes($sched->facname) }}', '{{ addslashes($student->sname) }}', '{{ addslashes($sched->facemail) }}', '{{ addslashes($sched->title) }}', '{{ $sched->scheduledate }}', '{{ $sched->scheduletime }}', this.href)"
                                        >
                                            <button class="login-btn btn-primary btn">Book Now</button>
                                        </a>
                                    @endif

                                    <a href="?action=delete-session&id={{ $sched->scheduleid }}&title={{ urlencode($sched->title) }}&doc={{ urlencode($sched->facname) }}" class="non-style-link">
                                        <button class="login-btn btn" style="background-color:#ffdddd;color:#9b1c1c;">Delete Session</button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($action == 'add-session')
    <div id="popup1" class="overlay">
        <div class="popup">
            <center>
                <a class="close" href="{{ url('/student/schedule') }}">&times;</a>
                <div class="app-form-card" style="text-align:left;">
                    <div class="page-card__header">
                        <div>
                            <span class="page-card__eyebrow">New Session</span>
                            <h2 class="page-card__title">Schedule a session</h2>
                            <p class="page-card__description">Create a consultation session and assign it to a faculty member.</p>
                        </div>
                    </div>

                    @if($error == 'availability')
                        <div class="status-banner status-banner--error" style="margin-bottom: 16px;">The faculty is not available at the requested time. No available slots on this day.</div>
                    @endif

                    <form action="{{ url('/student/schedule/add') }}" method="POST" class="auth-form">
                        @csrf
                        <div class="app-form-grid">
                            <div class="full auth-field">
                                <label for="title" class="form-label">Concern</label>
                                <input id="title" type="text" name="title" class="input-text" placeholder="Name of this session" required>
                            </div>
                            <div class="full auth-field">
                                <label for="purpose" class="form-label">Purpose</label>
                                <input id="purpose" type="text" name="purpose" class="input-text" placeholder="Purpose of this session" required>
                            </div>
                            <div class="full auth-field">
                                <label for="docid" class="form-label">Select faculty</label>
                                <select name="docid" id="docid" class="box" required>
                                    <option value="" disabled selected hidden>Choose faculty name from the list</option>
                                    @foreach($allFaculties as $fac)
                                        <option value="{{ $fac->facid }}">{{ $fac->facname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="auth-field">
                                <label for="nop" class="form-label">Number of concerned students</label>
                                <input id="nop" type="number" name="nop" class="input-text" min="1" placeholder="Session capacity" required>
                            </div>
                            <div class="auth-field">
                                <label for="date" class="form-label">Session date</label>
                                <input id="date" type="date" name="date" class="input-text" min="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="auth-field">
                                <label for="time" class="form-label">Schedule time</label>
                                <input id="time" type="time" name="time" class="input-text" required>
                            </div>
                        </div>

                        <div class="app-form-actions">
                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                            <input type="submit" value="Schedule Session" class="login-btn btn-primary btn" name="shedulesubmit">
                        </div>
                    </form>
                </div>
            </center>
        </div>
    </div>
@elseif($action == 'session-added')
    <div id="popup1" class="overlay">
        <div class="popup">
            <center>
                <h2>Session scheduled</h2>
                <a class="close" href="{{ url('/student/schedule') }}">&times;</a>
                <div class="content">{{ substr($titleParam,0,40) }} was scheduled successfully.</div>
                <div class="dialog-actions">
                    <a href="{{ url('/student/schedule') }}" class="non-style-link">
                        <button class="btn-primary btn">OK</button>
                    </a>
                </div>
            </center>
        </div>
    </div>
@endif

@if($action=='drop')
    <div id="popup1" class="overlay">
        <div class="popup">
            <center>
                <h2>Cancel this appointment?</h2>
                <a class="close" href="{{ url('/student/schedule') }}">&times;</a>
                <div class="content">
                    You are about to cancel this appointment.<br><br>
                    Faculty name: <b>{{ urldecode($docParam ?? request()->query('doc', '')) }}</b><br>
                    Session title: <b>{{ urldecode($titleParam) }}</b>
                </div>
                <div class="dialog-actions">
                    <form action="{{ route('student.appointment.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="appoid" value="{{ $id }}">
                        <button type="submit" class="btn-primary btn">Yes, cancel</button>
                    </form>
                    <a href="{{ url('/student/schedule') }}" class="non-style-link">
                        <button class="btn-primary-soft btn">Keep booking</button>
                    </a>
                </div>
            </center>
        </div>
    </div>
@elseif($action=='delete-session')
    <div id="popup1" class="overlay">
        <div class="popup">
            <center>
                <h2>Delete this session?</h2>
                <a class="close" href="{{ url('/student/schedule') }}">&times;</a>
                <div class="content">
                    You are about to completely delete this session for everyone.<br><br>
                    Faculty name: <b>{{ urldecode($docParam ?? request()->query('doc', '')) }}</b><br>
                    Session title: <b>{{ urldecode($titleParam) }}</b>
                </div>
                <div class="dialog-actions">
                    <form action="{{ route('student.schedule.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="scheduleid" value="{{ $id }}">
                        <button type="submit" class="btn btn-primary" style="background-color:#9b1c1c;border-color:#9b1c1c;">Yes, delete session</button>
                    </form>
                    <a href="{{ url('/student/schedule') }}" class="non-style-link">
                        <button class="btn-primary-soft btn">Cancel</button>
                    </a>
                </div>
            </center>
        </div>
    </div>
@endif

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
<script type="text/javascript">
    (function () {
        emailjs.init("{{ env('EMAILJS_USER_ID') }}");
    })();

    function sendEmailJSAndBook(event, facultyName, studentName, facultyEmail, sessionTitle, sessionDate, sessionTime, bookingUrl) {
        event.preventDefault();

        const button = event.currentTarget.querySelector('button');
        const originalText = button ? button.innerHTML : '';

        if (button) {
            button.innerHTML = 'Sending...';
            button.disabled = true;
        }

        const templateParams = {
            faculty_name: facultyName,
            student_name: studentName,
            to_email: facultyEmail,
            session_title: sessionTitle,
            date: sessionDate,
            time: sessionTime
        };

        const serviceId = "{{ env('EMAILJS_SERVICE_ID') }}";
        const templateId = "{{ env('EMAILJS_TEMPLATE_ID') }}";

        emailjs.send(serviceId, templateId, templateParams)
            .then(function () {
                return fetch("{{ route('notifications.log') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        user_id: '{{ $useremail }}',
                        user_type: 'student',
                        title: 'Booking Email Sent',
                        message: 'Successfully sent booking request email to ' + facultyName + ' for ' + sessionDate + ' at ' + sessionTime
                    })
                }).catch(function () {
                    return null;
                });
            })
            .then(function () {
                window.location.href = bookingUrl;
            })
            .catch(function () {
                if (button) {
                    button.innerHTML = originalText || 'Book Now';
                    button.disabled = false;
                }

                alert('The notification failed to send, but we will still proceed with the booking.');

                fetch("{{ route('notifications.log') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        user_id: '{{ $useremail }}',
                        user_type: 'student',
                        title: 'Booking Email Failed',
                        message: 'Failed to send automated email to ' + facultyName + '. The system still booked your appointment.'
                    })
                }).finally(function () {
                    window.location.href = bookingUrl;
                });
            });
    }
</script>

@include('shared.notifications')
</body>
</html>
