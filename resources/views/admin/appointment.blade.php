<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">  
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">  
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        
    <title>Appointments</title>
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
        <div class="menu" id="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="{{ asset('img/user.png') }}" alt="" style="width: 91.85px; height: 91.85px; border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px; position: relative;">
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
                    <td class="menu-btn menu-icon-schedule ">
                        <a href="{{ url('/admin/schedule') }}" class="non-style-link-menu"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment menu-active menu-icon-appoinment-active">
                        <a href="{{ url('/admin/appointment') }}" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Appointment</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-student">
                        <a href="{{ url('/admin/student') }}" class="non-style-link-menu"><div><p class="menu-text">Student</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="{{ url('/admin/settings') }}" class="non-style-link-menu"><div><p class="menu-text">Profile</p></div></a>
                    </td>
                </tr>

            </table>
        </div>
        <div class="dash-body" id="dash-body" style="margin-top: 15px">
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
                    @include('components.hamburger')
                    <p>Appointment Manager</p>
                </div>
            </div>

            {{-- ── Main Data Panel ── --}}
            <div style="padding: 0 20px 20px;">
                <div class="db-panel">
                    <p class="db-heading-appo" style="padding: 5px 10px 15px; margin: 0; font-size: 18px;">All Appointments ({{ $appointments->count() }})</p>
                    <form action="{{ url('/admin/appointment') }}" method="post" style="padding: 0 10px 20px;">
                        @csrf
                        <div style="display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end;">
                            <div style="flex: 1 1 200px;">
                                <label style="display: block; margin-bottom: 5px; font-size: 14px; color: #333;">Date:</label>
                                <input type="date" name="sheduledate" id="date" class="input-text filter-container-items" style="margin: 0; width: 100%;">
                            </div>
                            <div style="flex: 1 1 300px;">
                                <label style="display: block; margin-bottom: 5px; font-size: 14px; color: #333;">Faculty:</label>
                                <select name="docid" id="" class="box filter-container-items" style="width: 100%; height: 38px; margin: 0;">
                                    <option value="" disabled selected hidden>Choose Faculty Name from the list</option>
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
                                <th class="table-headin">Student Name</th>
                                <th class="table-headin" style="text-align: center;">Appointment Number</th>
                                <th class="table-headin">Faculty</th>
                                <th class="table-headin">Session Title</th>
                                <th class="table-headin" style="text-align: center; font-size: 10px;">Session Date & Time</th>
                                <th class="table-headin" style="text-align: center;">Appointment Date</th>
                                <th class="table-headin" style="text-align: center;">Events</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($appointments->count() == 0)
                                <tr>
                                    <td colspan="7">
                                        <div class="db-empty" style="padding: 40px 12px;">
                                            <img src="{{ asset('img/notfound.svg') }}">
                                            <p style="font-size: 16px; font-weight: 500;">We couldn't find anything related to your keywords!</p>
                                            <a class="non-style-link" href="{{ url('/admin/appointment') }}">
                                                <button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center; margin: 0 auto;">&nbsp; Show all Appointments &nbsp;</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach($appointments as $appo)
                                    <tr>
                                        <td style="font-weight:600;"> &nbsp;{{ substr($appo->sname,0,25) }}</td >
                                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                        {{ $appo->apponum }}
                                        </td>
                                        <td>
                                        {{ substr($appo->facname,0,25) }}
                                        </td>
                                        <td>
                                        {{ substr($appo->title,0,15) }}
                                        </td>
                                        <td style="text-align:center;font-size:12px;">
                                            {{ substr($appo->scheduledate,0,10) }} <br>{{ substr($appo->scheduletime,0,5) }}
                                        </td>
                                        <td style="text-align:center;">
                                            {{ $appo->appodate }}
                                        </td>
                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                       <a href="?action=drop&id={{ $appo->appoid }}&name={{ urlencode($appo->sname) }}&session={{ urlencode($appo->title) }}&apponum={{ $appo->apponum }}" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Cancel</font></button></a>
                                       &nbsp;&nbsp;&nbsp;</div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>
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
                    <a class="close" href="{{ url('/admin/appointment') }}">&times;</a>
                    <div class="content">
                        You want to delete this record<br><br>
                        Patient Name: &nbsp;<b>{{ substr(urldecode($nameget),0,40) }}</b><br>
                        Appointment number &nbsp; : <b>{{ substr($apponum,0,40) }}</b><br><br>
                        
                    </div>
                    <div style="display: flex;justify-content: center;">
                        <form action="{{ route('admin.appointment.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;Yes&nbsp;</font></button>
                        </form>
                    &nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/admin/appointment') }}" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                    </div>
                </center>
        </div>
        </div>
    @endif
    </div>
</body>
</html>
