<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">  
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">  
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        
    <title>Schedule</title>
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
             @include('shared.sidebar-faculty', ['activePage' => 'schedule'])
<div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="{{ url('/faculty/dashboard') }}" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td style="display: flex; align-items: center;">
                        @include('shared.hamburger')
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">My Sessions</p>
                                           
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
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">My Sessions ({{ $schedules->count() }}) </p>
                    </td>
                    
                </tr>
                
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;" >
                        <center>
                        <table class="filter-container" border="0" >
                        <tr>
                           <td width="10%">

                           </td> 
                        <td width="5%" style="text-align: center;">
                        Date:
                        </td>
                        <td width="30%">
                        <form action="{{ url('/faculty/schedule') }}" method="post">
                            @csrf
                            <input type="date" name="sheduledate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">

                        </td>
                        
                    <td width="12%">
                        <input type="submit"  name="filter" value=" Filter" class=" btn-primary-soft btn button-icon btn-filter"  style="padding: 15px; margin :0;width:100%">
                        </form>
                    </td>

                    </tr>
                            </table>

                        </center>
                    </td>
                    
                </tr>
                
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    
                                
                                Session Title
                                
                                </th>
                                
                                
                                <th class="table-headin">
                                    
                                    Sheduled Date & Time
                                    
                                </th>
                                <th class="table-headin">
                                    
                                Max num that can be booked
                                    
                                </th>
                                
                                <th class="table-headin">
                                    
                                    Events
                                    
                                </tr>
                        </thead>
                        <tbody>
                        
                            @if($schedules->count() == 0)
                                <tr>
                                <td colspan="4">
                                <br><br><br><br>
                                <center>
                                <img src="{{ asset('img/notfound.svg') }}" width="25%">
                                
                                <br>
                                <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                <a class="non-style-link" href="{{ url('/faculty/schedule') }}"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
                                </a>
                                </center>
                                <br><br><br><br>
                                </td>
                                </tr>
                            @else
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td> &nbsp;
                                        {{ substr($schedule->title,0,30) }}
                                        </td>
                                        
                                        <td style="text-align:center;">
                                            {{ substr($schedule->scheduledate,0,10) }} {{ substr($schedule->scheduletime,0,5) }}
                                        </td>
                                        <td style="text-align:center;">
                                            {{ $schedule->nop }}
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id={{ $schedule->scheduleid }}" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=drop&id={{ $schedule->scheduleid }}&name={{ urlencode($schedule->title) }}" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Delete Session</font></button></a>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
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
    
    @if($action=='drop')
        <div id="popup1" class="overlay">
                <div class="popup">
                <center>
                    <h2>Are you sure?</h2>
                    <a class="close" href="{{ url('/faculty/schedule') }}">&times;</a>
                    <div class="content">
                        You want to delete this specific session<br>({{ urldecode($nameget ?? request()->query('name', '')) }}).
                        
                    </div>
                    <div style="display: flex;justify-content: center;">
                        <form action="{{ url('/faculty/schedule/delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;Yes&nbsp;</font></button>
                        </form>&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/faculty/schedule') }}" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                    </div>
                </center>
        </div>
        </div>
    @elseif($action=='view')
        <div id="popup1" class="overlay">
                <div class="popup popup--profile-id popup--profile-id-wide">
                    <a class="close" href="{{ url('/faculty/schedule') }}">&times;</a>
                    <div class="profile-id-card">
                        <div class="profile-id-card__top">
                            <div>
                                <span class="profile-id-card__eyebrow">Session Details</span>
                                <h2 class="profile-id-card__title">Session Information Card</h2>
                                <p class="profile-id-card__subtitle">A cleaner session overview with the registered students attached to this consultation slot.</p>
                            </div>
                            <div class="profile-id-card__badge">SE-{{ $id }}</div>
                        </div>

                        <div class="profile-id-card__hero">
                            <div class="profile-id-card__avatar-wrap">
                                <img src="{{ asset('img/calendar.svg') }}" alt="Session calendar" class="profile-id-card__avatar">
                            </div>
                            <div class="profile-id-card__hero-copy">
                                <p class="profile-id-card__role">Scheduled Session</p>
                                <h3 class="profile-id-card__name">{{ $sessionDetails->title }}</h3>
                                <p class="profile-id-card__meta">{{ $sessionDetails->facname }}</p>
                                <div class="profile-id-card__chips">
                                    <span class="status-chip status-chip--success">Registered {{ $sessionStudents->count() }}/{{ $sessionDetails->nop }}</span>
                                    <span class="profile-id-card__micro">{{ $sessionDetails->scheduledate }} at {{ $sessionDetails->scheduletime }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="profile-id-card__grid">
                            <div class="profile-id-card__field">
                                <span class="profile-id-card__label">Session ID</span>
                                <div class="profile-id-card__value">SE-{{ $id }}</div>
                            </div>
                            <div class="profile-id-card__field">
                                <span class="profile-id-card__label">Faculty</span>
                                <div class="profile-id-card__value">{{ $sessionDetails->facname }}</div>
                            </div>
                            <div class="profile-id-card__field">
                                <span class="profile-id-card__label">Scheduled Date</span>
                                <div class="profile-id-card__value">{{ $sessionDetails->scheduledate }}</div>
                            </div>
                            <div class="profile-id-card__field">
                                <span class="profile-id-card__label">Scheduled Time</span>
                                <div class="profile-id-card__value">{{ $sessionDetails->scheduletime }}</div>
                            </div>
                            <div class="profile-id-card__field profile-id-card__field--wide">
                                <span class="profile-id-card__label">Capacity</span>
                                <div class="profile-id-card__value">{{ $sessionStudents->count() }} registered out of {{ $sessionDetails->nop }} total slots.</div>
                            </div>
                        </div>

                        <div class="profile-id-card__section">
                            <div class="profile-id-card__section-head">
                                <div>
                                    <span class="profile-id-card__label">Registered Students</span>
                                    <p class="profile-id-card__section-copy">Students already enrolled in this session appear below.</p>
                                </div>
                            </div>
                            <div class="profile-id-card__table-wrap">
                                <table width="100%" class="sub-table scrolldown" border="0">
                                    <thead>
                                        <tr>
                                            <th class="table-headin">Student ID</th>
                                            <th class="table-headin">Student name</th>
                                            <th class="table-headin">Appointment number</th>
                                            <th class="table-headin">Student Telephone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($sessionStudents->count() == 0)
                                            <tr>
                                                <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                        <img src="{{ asset('img/notfound.svg') }}" width="25%">
                                                        <br>
                                                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldnt find anything related to your keywords !</p>
                                                        <a class="non-style-link" href="{{ url('/faculty/appointment') }}">
                                                            <button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</button>
                                                        </a>
                                                    </center>
                                                    <br><br><br><br>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach($sessionStudents as $student)
                                                <tr style="text-align:center;">
                                                    <td>{{ substr($student->sid,0,15) }}</td>
                                                    <td style="font-weight:600;padding:25px;">{{ substr($student->sname,0,25) }}</td>
                                                    <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">{{ $student->apponum }}</td>
                                                    <td>{{ substr($student->stel,0,25) }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="dialog-actions" style="padding: 0 24px 24px;">
                            <a href="{{ url('/faculty/schedule') }}" class="non-style-link">
                                <button class="btn-primary-soft btn">Close Card</button>
                            </a>
                        </div>
                    </div>
        </div>
        </div>
    @endif
    </div>

    @include('shared.notifications')
</body>
</html>

