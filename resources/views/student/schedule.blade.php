<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <title>Sessions</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
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
                                <img src="{{ $student->profile_pic ? asset('storage/' . $student->profile_pic) : asset('img/user.png') }}" alt="" style="width: 91.85px; height: 91.85px; object-fit: cover; border-radius:50%">
                            </td>
                            <td style="padding:0px;margin:0px;">
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
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-home " >
                    <a href="{{ url('/student/dashboard') }}" class="non-style-link-menu "><div><p class="menu-text">Home</p></div></a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-faculty">
                    <a href="{{ url('/student/faculty') }}" class="non-style-link-menu"><div><p class="menu-text">All Faculty</p></div></a>
                </td>
            </tr>

            <tr class="menu-row" >
                <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
                    <a href="{{ url('/student/schedule') }}" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Scheduled Sessions</p></div></a>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-appoinment">
                    <a href="{{ url('/student/appointment') }}" class="non-style-link-menu"><div><p class="menu-text">My Bookings</p></div></a>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-settings">
                    <a href="{{ url('/student/settings') }}" class="non-style-link-menu"><div><p class="menu-text">Settings</p></div></a>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-notifications" id="notification-btn">
                    <div><p class="menu-text">Notifications</p></div>
                </td>
            </tr>

        </table>
    </div>

    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr >
                <td width="13%" >
                    <a href="{{ url('/student/dashboard') }}" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                </td>
                <td >
                    <form action="{{ url('/student/schedule') }}" method="post" class="header-search">
                        @csrf
                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Faculty name or title or Date" list="faculty" value="{{ $searchQuery }}">&nbsp;&nbsp;
                        <datalist id="faculty">
                            @foreach($allFaculties as $fac)
                                <option value="{{ $fac->facname }}"></option>
                            @endforeach
                            @foreach($allTitles as $t)
                                <option value="{{ $t->title }}"></option>
                            @endforeach
                        </datalist>

                        <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                    </form>
                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Today's Date
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        {{ $today }}
                    </p>
                </td>
                <td width="10%">
                    <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="{{ asset('img/calendar.svg') }}" width="100%"></button>
                </td>
            </tr>

            <tr>
                <td colspan="4" >
                    <div style="display: flex;margin-top: 40px;">
                    <div class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49);margin-top: 5px;">Schedule a New Session</div>
                    <a href="?action=add-session&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="margin-left:25px;background-image: url('{{ asset('img/icons/add.svg') }}');">Schedule Session</font></button></a>
                    </div>
                </td>
            </tr>
            
            @if(session('error'))
            <tr>
                <td colspan="4" style="padding-top:20px;">
                    <center>
                        <div style="color:rgb(255, 62, 62);font-weight:bold;background-color:#ffe0e0;padding:10px;border-radius:5px;width:80%;">
                            {{ session('error') }}
                        </div>
                    </center>
                </td>
            </tr>
            @endif

            <tr>
                <td colspan="4" style="padding-top:10px;width: 100%;" >
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">{{ $searchType }} Sessions ({{ $schedules->count() }}) </p>
                    @if($searchQuery != '')
                        <p class="heading-main12" style="margin-left: 45px;font-size:22px;color:rgb(49, 49, 49)">"{{ $searchQuery }}" </p>
                    @endif
                </td>
            </tr>

            <tr>
                <td colspan="4">
                    <center>
                    <div class="abc scroll">
                    <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
                        <tbody>
                        @if($schedules->count() == 0)
                            <tr>
                                <td colspan="4">
                                <br><br><br><br>
                                <center>
                                <img src="{{ asset('img/notfound.svg') }}" width="25%">
                                <br>
                                <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldnt find anything related to your keywords!</p>
                                <a class="non-style-link" href="{{ url('/student/schedule') }}"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button></a>
                                </center>
                                <br><br><br><br>
                                </td>
                            </tr>
                        @else
                            @php $count = 0; @endphp
                            @foreach($schedules as $sched)
                                @if($count % 3 == 0)
                                    <tr>
                                @endif
                                <td style="width: 25%;">
                                    <div class="dashboard-items search-items">
                                        <div style="width:100%">
                                            <div class="h1-search">{{ substr($sched->title,0,21) }}</div><br>
                                            <div class="h3-search">{{ substr($sched->facname,0,30) }}</div>
                                            <div class="h4-search">{{ $sched->scheduledate }}<br>Starts: <b>@ {{ substr($sched->scheduletime,0,5) }}</b> (24h)</div>
                                            <div class="h4-search" style="margin-top: 5px;">
                                                @php $currentBookings = isset($scheduleCapacities[$sched->scheduleid]) ? $scheduleCapacities[$sched->scheduleid] : 0; @endphp
                                                Capacity: {{ $currentBookings }} / {{ $sched->nop }}
                                            </div>
                                            <br>
                                            @php
                                                $isBooked = in_array($sched->scheduleid, $myBookings);
                                                $isFull = $currentBookings >= $sched->nop;
                                            @endphp

                                            @if($isBooked)
                                                @php $bookedAppoId = $myAppointments[$sched->scheduleid]; @endphp
                                                <a href="?action=drop&id={{ $bookedAppoId }}&title={{ urlencode($sched->title) }}&doc={{ urlencode($sched->facname) }}" >
                                                    <button class="login-btn btn " style="padding-top:11px;padding-bottom:11px;width:100%;margin-bottom:5px;background-color:#ffe0e0;color:#cc0000;"><font class="tn-in-text">Cancel Booking</font></button>
                                                </a>
                                            @elseif($isFull)
                                                <button class="login-btn btn " style="padding-top:11px;padding-bottom:11px;width:100%;margin-bottom:5px;background-color:#ffe0e0;color:#cc0000;cursor:not-allowed;" disabled><font class="tn-in-text">Session Full</font></button>
                                            @else
                                                <a href="{{ url('/student/appointment?action=add&id='.$sched->scheduleid) }}" 
                                                   onclick="sendEmailJSAndBook(event, '{{ addslashes($sched->facname) }}', '{{ addslashes($student->sname) }}', '{{ addslashes($sched->facemail) }}', '{{ addslashes($sched->title) }}', '{{ $sched->scheduledate }}', '{{ $sched->scheduletime }}', this.href)">
                                                   <button class="login-btn btn-primary-soft btn " style="padding-top:11px;padding-bottom:11px;width:100%;margin-bottom:5px;"><font class="tn-in-text">Book Now</font></button>
                                                </a>
                                            @endif
                                            
                                            <a href="?action=delete-session&id={{ $sched->scheduleid }}&title={{ urlencode($sched->title) }}&doc={{ urlencode($sched->facname) }}" >
                                                <button class="login-btn btn " style="padding-top:11px;padding-bottom:11px;width:100%;background-color:#ffaaaa;color:#990000;"><font class="tn-in-text">Delete Session</font></button>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                @php $count++; @endphp
                                @if($count % 3 == 0)
                                    </tr>
                                @endif
                            @endforeach
                            @if($count % 3 != 0)
                                </tr>
                            @endif
                        @endif
                        </tbody>
                    </table>
                    </div>
                    </center>
                </td>
            </tr>

        </table>
    </div>
</div>

@if($action == 'add-session')
    <div id="popup1" class="overlay">
        <div class="popup">
            <center>
                <a class="close" href="{{ url('/student/schedule') }}">&times;</a>
                <div style="display: flex;justify-content: center;">
                <div class="abc">
                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                    <tr>
                        <td class="label-td" colspan="2">
                            @if($error == 'availability')
                                <label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">The faculty is not available at the requested time. No available slots on this day.</label>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Book an Appointment</p><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                        <form action="{{ url('/student/schedule/add') }}" method="POST" class="add-new-form">
                            @csrf
                            <label for="title" class="form-label">Concern : </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="text" name="title" class="input-text" placeholder="Name of this Session" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="purpose" class="form-label">Purpose : </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="text" name="purpose" class="input-text" placeholder="Purpose of this Session" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="docid" class="form-label">Select Faculty: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <select name="docid" id="" class="box" required >
                                <option value="" disabled selected hidden>Choose Faculty Name from the list</option><br/>
                                @foreach($allFaculties as $fac)
                                    <option value="{{ $fac->facid }}">{{ $fac->facname }}</option>
                                @endforeach
                            </select><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="nop" class="form-label">Number of Concerned Students : </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="number" name="nop" class="input-text" min="1"  placeholder="The final appointment number for this session depends on this number" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="date" class="form-label">Session Date: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="date" name="date" class="input-text" min="{{ date('Y-m-d') }}" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="time" class="form-label">Schedule Time: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="time" name="time" class="input-text" placeholder="Time" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="submit" value="Schedule this Session" class="login-btn btn-primary btn" name="shedulesubmit">
                        </td>
                    </tr>
                </form>
                </tr>
            </table>
            </div>
            </div>
        </center>
        <br><br>
    </div>
</div>
@elseif($action == 'session-added')
<div id="popup1" class="overlay">
    <div class="popup">
        <center>
        <br><br>
            <h2>Session Scheduled.</h2>
            <a class="close" href="{{ url('/student/schedule') }}">&times;</a>
            <div class="content">
            {{ substr($titleParam,0,40) }} was scheduled.<br><br>

            </div>
            <div style="display: flex;justify-content: center;">
            <a href="{{ url('/student/schedule') }}" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
            <br><br><br><br>
            </div>
        </center>
    </div>
</div>
@endif

</div>

    @if($action=='drop')
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2>Are you sure?</h2>
                    <a class="close" href="{{ url('/student/schedule') }}">&times;</a>
                    <div class="content">
                        You are about to cancel this appointment.<br><br>
                        Faculty Name: &nbsp;<b>{{ urldecode($docParam ?? request()->query('doc', '')) }}</b><br>
                        Session Title &nbsp; : <b>{{ urldecode($titleParam) }}</b><br><br>
                    </div>
                    <div style="display: flex;justify-content: center;">
                        <form action="{{ route('student.appointment.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="appoid" value="{{ $id }}">
                            <button type="submit" class="btn-primary btn" style="display:flex;justify-content:center;align-items:center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;Yes, Cancel&nbsp;</font></button>
                        </form>&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/student/schedule') }}" class="non-style-link"><button class="btn-primary-soft btn" style="display:flex;justify-content:center;align-items:center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No, Keep It&nbsp;&nbsp;</font></button></a>
                    </div>
                </center>
            </div>
        </div>
        
    @elseif($action=='delete-session')
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2>Are you sure?</h2>
                    <a class="close" href="{{ url('/student/schedule') }}">&times;</a>
                    <div class="content">
                        You are about to completely delete this session for everyone.<br><br>
                        Faculty Name: &nbsp;<b>{{ urldecode($docParam ?? request()->query('doc', '')) }}</b><br>
                        Session Title &nbsp; : <b>{{ urldecode($titleParam) }}</b><br><br>
                    </div>
                    <div style="display: flex;justify-content: center;">
                        <form action="{{ route('student.schedule.delete') }}" method="POST">
                            @csrf
                            <!-- ID here is scheduleid, not appoid -->
                            <input type="hidden" name="scheduleid" value="{{ $id }}">
                            <button type="submit" class="btn-primary btn" style="display:flex;justify-content:center;align-items:center;margin:10px;padding:10px;background-color:#990000;border:none;"><font class="tn-in-text" style="color:white;">&nbsp;Yes, Delete Session&nbsp;</font></button>
                        </form>&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/student/schedule') }}" class="non-style-link"><button class="btn-primary-soft btn" style="display:flex;justify-content:center;align-items:center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;Cancel&nbsp;&nbsp;</font></button></a>
                    </div>
                </center>
            </div>
        </div>
   @endif

<!-- EmailJS Scripts for Frontend Notification Dispatch -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
<script type="text/javascript">
    (function(){
        // Initialize EmailJS with the Public Key from Laravel's .env
        emailjs.init("{{ env('EMAILJS_USER_ID') }}");
    })();

    function sendEmailJSAndBook(event, facultyName, studentName, facultyEmail, sessionTitle, sessionDate, sessionTime, bookingUrl) {
        event.preventDefault(); // Stop the link from redirecting immediately
        
        let button = event.currentTarget.querySelector('button');
        let originalText = button.innerHTML;
        button.innerHTML = "<font class='tn-in-text'>Sending...</font>";
        button.disabled = true;

        var templateParams = {
            faculty_name: facultyName,
            student_name: studentName,
            to_email: facultyEmail,
            session_title: sessionTitle,
            date: sessionDate,
            time: sessionTime
        };

        let serviceId = "{{ env('EMAILJS_SERVICE_ID') }}";
        let templateId = "{{ env('EMAILJS_TEMPLATE_ID') }}";

        // Call the EmailJS SDK
        emailjs.send(serviceId, templateId, templateParams)
            .then(function(response) {
                console.log('SUCCESS!', response.status, response.text);
                
                // Log the notification to the backend database before redirecting
                fetch("{{ route('notifications.log') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        user_id: '{{ $useremail }}', // Using email as the identifier to match the session
                        user_type: 'student',
                        title: 'Booking Email Sent',
                        message: 'Successfully sent booking request email to ' + facultyName + ' for ' + sessionDate + ' at ' + sessionTime
                    })
                }).then(() => {
                    // Redirect to the actual booking URL now that the email is on its way
                    window.location.href = bookingUrl;
                }).catch(() => {
                    // Even if logging fails, redirect to complete booking
                    window.location.href = bookingUrl;
                });

            }, function(error) {
                console.log('FAILED...', error);
                alert("The notification failed to send, but we will still proceed with the booking.");
                
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
                }).finally(() => {
                    window.location.href = bookingUrl;
                });
            });
    }
</script>

    @include('components.notifications')
</body>
</html>
