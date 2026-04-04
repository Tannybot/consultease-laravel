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
                                    <img src="{{ asset('img/user.png') }}" alt="" style="width: 91.85px; height: 91.85px; border-radius:50%">
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
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="{{ url('/admin/dashboard') }}" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-faculty ">
                        <a href="{{ url('/admin/faculty') }}" class="non-style-link-menu "><div><p class="menu-text">Faculty</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule menu-active menu-icon-schedule-active">
                        <a href="{{ url('/admin/schedule') }}" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="{{ url('/admin/appointment') }}" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
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
            <div class="admin-header-bar" style="justify-content: space-between;">
                <div class="back-cell" style="display: flex; align-items: center; gap: 15px;">
                    <a href="{{ url('/admin/dashboard') }}" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                </div>
                
                <div style="display: flex; align-items: center; justify-content: flex-end; gap: 10px;">
                    <div class="date-cell">
                        <p style="font-size:13px;color:rgb(119,119,119);margin:0;text-align:right;">Today's Date</p>
                        <p class="heading-sub12" style="margin:0;text-align:right;font-weight: 600;">{{ $today }}</p>
                    </div>
                    <div class="cal-cell">
                        <button class="btn-label" style="display:flex;justify-content:center;align-items:center;">
                            <img src="{{ asset('img/calendar.svg') }}" width="28">
                        </button>
                    </div>
                </div>
            </div>

            {{-- ── Title Panel ── --}}
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 20px 20px; flex-wrap: wrap; gap: 15px;">
                <div class="admin-home-title" style="padding: 0;">
                    @include('shared.hamburger')
                    <p>Schedule Manager</p>
                </div>
            </div>

            {{-- ── Main Data Panel ── --}}
            <div style="padding: 0 20px 20px;">
                <div class="db-panel">
                    <p class="db-heading-appo" style="padding: 5px 10px 15px; margin: 0; font-size: 18px;">All Sessions ({{ $schedules->count() }})</p>
                    <form action="{{ url('/admin/schedule') }}" method="post" style="padding: 0 10px 20px;">
                        @csrf
                        <div style="display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end;">
                            <div style="flex: 1 1 200px;">
                                <label style="display: block; margin-bottom: 5px; font-size: 14px; color: #333;">Date:</label>
                                <input type="date" name="sheduledate" id="date" class="input-text filter-container-items" style="margin: 0; width: 100%;">
                            </div>
                            <div style="flex: 1 1 300px;">
                                <label style="display: block; margin-bottom: 5px; font-size: 14px; color: #333;">Faculty:</label>
                                <select name="docid" id="" class="box filter-container-items" style="width: 100%; height: 38px; margin: 0;">
                                    <option value="" disabled selected hidden>Choose the Faculty Name from the list</option>
                                    @foreach($facultyList as $fac)
                                        <option value="{{ $fac->facid }}">{{ $fac->facname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="flex: 0 0 auto;">
                                <input type="submit" name="filter" value="Filter" class="btn-primary-soft btn button-icon btn-filter" style="padding: 10px 25px; margin: 0; width: 100%;">
                            </div>
                        </div>
                    </form>
                
                    <div class="abc scroll" style="height: auto; max-height: 55vh;">
                        <table width="100%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin">Session Title</th>
                                <th class="table-headin">Faculty</th>
                                <th class="table-headin" style="text-align: center;">Scheduled Date & Time</th>
                                <th class="table-headin" style="text-align: center;">Max Bookings</th>
                                <th class="table-headin" style="text-align: center;">Events</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($schedules->count() == 0)
                                <tr>
                                    <td colspan="5">
                                        <div class="db-empty" style="padding: 40px 12px;">
                                            <img src="{{ asset('img/notfound.svg') }}">
                                            <p style="font-size: 16px; font-weight: 500;">We couldn't find anything related to your keywords!</p>
                                            <a class="non-style-link" href="{{ url('/admin/schedule') }}">
                                                <button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center; margin: 0 auto;">&nbsp; Show all Sessions &nbsp;</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach($schedules as $sched)
                                    <tr>
                                        <td> &nbsp;{{ substr($sched->title,0,30) }}</td>
                                        <td>{{ substr($sched->facname,0,20) }}</td>
                                        <td style="text-align:center;">
                                            {{ substr($sched->scheduledate,0,10) }} {{ substr($sched->scheduletime,0,5) }}
                                        </td>
                                        <td style="text-align:center;">
                                            {{ $sched->nop }}
                                        </td>
                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id={{ $sched->scheduleid }}" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=drop&id={{ $sched->scheduleid }}&name={{ urlencode($sched->title) }}" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Decline</font></button></a>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>
                        </div>
                </div>
            </div>
        </div>
    
    @if($action=='drop')
        <div id="popup1" class="overlay">
                <div class="popup">
                <center>
                    <h2>Are you sure?</h2>
                    <a class="close" href="{{ url('/admin/schedule') }}">&times;</a>
                    <div class="content">
                        You want to decline this session<br>({{ substr(urldecode($nameget),0,40) }}).
                    </div>
                    <div style="display: flex;justify-content: center;">
                        <form action="{{ route('admin.schedule.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;Yes&nbsp;</font></button>
                        </form>
                    &nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/admin/schedule') }}" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                    </div>
                </center>
        </div>
        </div>
    @elseif($action=='view' && $sessionDetails)
        <div id="popup1" class="overlay">
                <div class="popup" style="width: 70%;">
                <center>
                    <h2></h2>
                    <a class="close" href="{{ url('/admin/schedule') }}">&times;</a>
                    <div class="content">
                        
                    </div>
                    <div class="abc scroll" style="display: flex;justify-content: center;">
                    <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                    
                        <tr>
                            <td>
                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="name" class="form-label">Session Title: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                {{ $sessionDetails->title }}<br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="Email" class="form-label">Faculty of this session: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            {{ $sessionDetails->facname }}<br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="nic" class="form-label">Scheduled Date: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            {{ $sessionDetails->scheduledate }}<br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="Tele" class="form-label">Scheduled Time: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            {{ $sessionDetails->scheduletime }}<br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="spec" class="form-label"><b>Students that Already registered for this session:</b> ({{ count($appointments) }}/{{ $sessionDetails->nop }})</label>
                                <br><br>
                            </td>
                        </tr>
                        
                        <tr>
                        <td colspan="4">
                            <center>
                             <div class="abc scroll">
                             <table width="100%" class="sub-table scrolldown" border="0">
                             <thead>
                             <tr>   
                                    <th class="table-headin">Student ID</th>
                                     <th class="table-headin">Student name</th>
                                     <th class="table-headin">Appointment number</th>
                                     <th class="table-headin">Student Telephone</th>
                             </thead>
                             <tbody>
                                @if(count($appointments) == 0)
                                    <tr>
                                         <td colspan="7">
                                         <br><br><br><br>
                                         <center>
                                         <img src="{{ asset('img/notfound.svg') }}" width="25%">
                                         <br>
                                         <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldnt find anything related to your keywords !</p>
                                         <a class="non-style-link" href="{{ url('/admin/appointment') }}"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</button>
                                         </a>
                                         </center>
                                         <br><br><br><br>
                                         </td>
                                    </tr>
                                @else
                                    @foreach($appointments as $appo)
                                        <tr style="text-align:center;">
                                            <td>{{ substr($appo->sid,0,15) }}</td>
                                             <td style="font-weight:600;padding:25px;">{{ substr($appo->sname,0,25) }}</td >
                                             <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                             {{ $appo->apponum }}
                                             </td>
                                             <td>
                                             {{ substr($appo->stel,0,25) }}
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
                </center>
                <br><br>
        </div>
        </div>
    @endif
    </div>
</body>
</html>
