<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <title>Settings</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-X  0.5s;
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
                                <img src="{{ $student->profile_pic ? asset('storage/' . $student->profile_pic) : asset('img/user.png') }}" alt="User Icon" style="width: 91.85px; height: 91.85px; object-fit: cover; border-radius:50%">
                            </td>
                            <td style="padding:0px;margin:0px;">
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
                <td class="menu-btn menu-icon-session">
                    <a href="{{ url('/student/schedule') }}" class="non-style-link-menu"><div><p class="menu-text">Scheduled Sessions</p></div></a>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-appoinment">
                    <a href="{{ url('/student/appointment') }}" class="non-style-link-menu"><div><p class="menu-text">My Bookings</p></div></a>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-settings  menu-active menu-icon-settings-active">
                    <a href="{{ url('/student/settings') }}" class="non-style-link-menu  non-style-link-menu-active"><div><p class="menu-text">Settings</p></div></a>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-notifications" id="notification-btn">
                    <div><p class="menu-text">Notifications</p></div>
                </td>
            </tr>

        </table>
    </div>
    <div class="dash-body" style="margin-top: 15px">
                <div class="admin-header-bar" style="justify-content: space-between;">
            <div class="back-cell" style="display: flex; align-items: center; gap: 15px;">
                <a href="{{ url('/student/dashboard') }}" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
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

        <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 20px 20px; flex-wrap: wrap; gap: 15px;">
            <div class="admin-home-title" style="padding: 0;">
                @include('shared.hamburger')
                <p>Settings</p>
            </div>
        </div>

        <div style="padding: 0 20px 20px;">
            <div class="db-panel" style="padding: 20px; display: flex; flex-direction: column; gap: 15px;">
                
                <a href="?action=edit&id={{ $student->sid }}&error=0" class="non-style-link">
                    <div class="dashboard-items setting-tabs" style="padding:15px; width: 100%; display: flex; align-items: center; gap: 15px;">
                        <div class="btn-icon-back dashboard-icons-setting" style="background-image: url('{{ asset('img/icons/faculty-hover.svg') }}'); width: 35px; height: 35px; background-size: cover; background-position: center; border-radius: 8px;"></div>
                        <div>
                            <div class="h1-dashboard" style="font-size: 16px; margin: 0; padding: 0;">Account Settings</div>
                            <div class="h3-dashboard" style="font-size: 12px; margin-top: 5px; font-weight: 500;">Edit your Account Details & Change Password</div>
                        </div>
                    </div>
                </a>

                <a href="?action=view&id={{ $student->sid }}" class="non-style-link">
                    <div class="dashboard-items setting-tabs" style="padding:15px; width: 100%; display: flex; align-items: center; gap: 15px;">
                        <div class="btn-icon-back dashboard-icons-setting " style="background-image: url('{{ asset('img/icons/view-iceblue.svg') }}'); width: 35px; height: 35px; background-size: cover; background-position: center; border-radius: 8px;"></div>
                        <div>
                            <div class="h1-dashboard" style="font-size: 16px; margin: 0; padding: 0;">View Account Details</div>
                            <div class="h3-dashboard" style="font-size: 12px; margin-top: 5px; font-weight: 500;">View Personal information About Your Account</div>
                        </div>
                    </div>
                </a>

                <!-- Two-Factor Authentication Card -->
                <div class="dashboard-items setting-tabs" style="padding:15px; width: 100%; display: flex; align-items: flex-start; gap: 15px;">
                    <div class="btn-icon-back dashboard-icons-setting" style="background-image: url('{{ asset('img/icons/view-iceblue.svg') }}'); width: 35px; height: 35px; background-size: cover; background-position: center; border-radius: 8px; flex-shrink: 0; margin-top: 3px;"></div>
                    <div style="flex: 1;">
                        <div class="h1-dashboard" style="font-size: 16px; margin: 0; padding: 0; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                            Two-Factor Authentication
                            @if($webuser && $webuser->google_2fa_enabled)
                                <span style="background:#e8f5e9;color:#2e7d32;padding:2px 8px;border-radius:10px;font-size:10px;font-weight:600;">ENABLED</span>
                            @else
                                <span style="background:#fff3e0;color:#ef6c00;padding:2px 8px;border-radius:10px;font-size:10px;font-weight:600;">DISABLED</span>
                            @endif
                        </div>
                        <div class="h3-dashboard" style="font-size: 12px; margin-top: 5px; font-weight: 500;">Secure your account with Google verification on login</div>
                        <div style="margin-top: 10px;">
                            @if($webuser && $webuser->google_2fa_enabled)
                                <form action="{{ route('google.2fa.disable') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-primary-soft btn" style="padding:6px 16px;font-size:12px;cursor:pointer;">Disable Google 2FA</button>
                                </form>
                            @else
                                <form action="{{ route('google.2fa.enable') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-primary btn" style="padding:6px 16px;font-size:12px;cursor:pointer;background:#4285F4;border:none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" style="width:12px;height:12px;vertical-align:middle;margin-right:4px;fill:none;">
                                            <path fill="#fff" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/>
                                        </svg>
                                        Enable Google 2FA
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                @if(session('success'))
                <div style="background:#e8f5e9;color:#2e7d32;padding:10px 16px;border-radius:8px;font-size:13px;font-weight:500;">
                    ✓ {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div style="background:#fce4ec;color:#c62828;padding:10px 16px;border-radius:8px;font-size:13px;font-weight:500;">
                    ✗ {{ session('error') }}
                </div>
                @endif

                <a href="?action=drop&id={{ $student->sid }}&name={{ $student->sname }}" class="non-style-link">
                    <div class="dashboard-items setting-tabs" style="padding:15px; width: 100%; display: flex; align-items: center; gap: 15px;">
                        <div class="btn-icon-back dashboard-icons-setting" style="background-image: url('{{ asset('img/icons/students-hover.svg') }}'); width: 35px; height: 35px; background-size: cover; background-position: center; border-radius: 8px;"></div>
                        <div>
                            <div class="h1-dashboard" style="color: #ff5050; font-size: 16px; margin: 0; padding: 0;">Delete Account</div>
                            <div class="h3-dashboard" style="font-size: 12px; margin-top: 5px; font-weight: 500;">Will Permanently Remove your Account</div>
                        </div>
                    </div>
                </a>

            </div>
        </div>

    </div>
</div>

@if($action=='drop')
    <div id="popup1" class="overlay">
        <div class="popup">
            <center>
                <h2>Are you sure?</h2>
                <a class="close" href="{{ url('/student/settings') }}">&times;</a>
                <div class="content">
                    You want to delete Your Account<br>({{ substr($nameget,0,40) }}).
                </div>
                <div style="display: flex;justify-content: center;">
                    <form action="{{ url('/student/settings/delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button type="submit" class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">&nbsp;Yes&nbsp;</button>
                    </form>
                    &nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/student/settings') }}" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">&nbsp;&nbsp;No&nbsp;&nbsp;</button></a>
                </div>
            </center>
        </div>
    </div>
@elseif($action=='view' && $viewStudent)
    <div id="popup1" class="overlay">
        <div class="popup">
            <center>
                <h2></h2>
                <a class="close" href="{{ url('/student/settings') }}">&times;</a>
                <div class="content">
                    eDoc Web App<br>
                </div>
                <div style="display: flex;justify-content: center;">
                    <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">

                        <tr>
                            <td>
                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                            </td>
                        </tr>

                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="name" class="form-label">Name: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                {{ $viewStudent->sname }}<br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="Email" class="form-label">Email: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                {{ $viewStudent->semail }}<br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                Removed<br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="Tele" class="form-label">Telephone: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                {{ $viewStudent->stel }}<br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="spec" class="form-label">Address: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                {{ $viewStudent->saddress }}<br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="spec" class="form-label">Date of Birth: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                {{ $viewStudent->sdob }}<br><br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="{{ url('/student/settings') }}"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </center>
            <br><br>
        </div>
    </div>
@elseif($action=='edit' && $viewStudent)
    <div id="popup1" class="overlay">
        <div class="popup">
            <center>
                <a class="close" href="{{ url('/student/settings') }}">&times;</a>
                <div style="display: flex;justify-content: center;">
                    <div class="abc">
                        <table width="100%" class="sub-table scrolldown add-doc-form-container" border="0" style="padding: 20px;">
                            <tr>
                                <td class="label-td" colspan="2">
                                    @if($error == '1')
                                        <label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>
                                    @elseif($error == '2')
                                        <label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Confirmation Error! Reconfirm Password</label>
                                    @elseif($error == '3')
                                        <label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>
                                    @elseif($error == '4')
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Edit Student Account Details.</p>
                                    Student ID : {{ $id }} (Auto Generated)<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <form action="{{ url('/student/settings/edit') }}" method="POST" class="add-new-form" enctype="multipart/form-data">
                                        @csrf
                                        <label for="Email" class="form-label">Email: </label>
                                        <input type="hidden" value="{{ $id }}" name="id00">
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="hidden" name="oldemail" value="{{ $viewStudent->semail }}" >
                                    <input type="email" name="email" class="input-text" placeholder="Email Address" value="{{ $viewStudent->semail }}" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="profile_pic" class="form-label">Profile Picture: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="file" name="profile_pic" class="input-text" accept="image/*"><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="name" class="input-text" placeholder="Student Name" value="{{ $viewStudent->sname }}" required><br>
                                </td>

                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" value="{{ $viewStudent->stel }}" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Address</label>

                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="address" class="input-text" placeholder="Address" value="{{ $viewStudent->saddress }}" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="password" class="form-label">Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="password" class="input-text" placeholder="Defind a Password" required><br>
                                </td>
                            </tr><tr>
                                <td class="label-td" colspan="2">
                                    <label for="cpassword" class="form-label">Conform Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required><br>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="submit" value="Save" class="login-btn btn-primary btn">
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
            <br><br>
        </div>
    </div>
@elseif($error == '4')
    <div id="popup1" class="overlay">
        <div class="popup">
            <center>
                <br><br><br><br>
                <h2>Edit Successfully!</h2>
                <a class="close" href="{{ url('/student/settings') }}">&times;</a>
                <div class="content">
                    If You change your email also Please logout and login again with your new email
                </div>
                <div style="display: flex;justify-content: center;">
                    <a href="{{ url('/student/settings') }}" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">&nbsp;&nbsp;OK&nbsp;&nbsp;</button></a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">&nbsp;&nbsp;Log out&nbsp;&nbsp;</button>
                    </form>
                </div>
                <br><br>
            </center>
        </div>
    </div>
@endif

    @include('shared.notifications')
</body>
</html>
