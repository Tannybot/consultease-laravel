<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">  
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">  
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        
    <title>Faculty</title>
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
                    <td class="menu-btn menu-icon-faculty menu-active menu-icon-faculty-active">
                        <a href="{{ url('/admin/faculty') }}" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Faculty</p></div></a>
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

                <div class="search-cell" style="flex: 1 1 100%; margin-top: 5px;">
                    <form action="{{ url('/admin/faculty') }}" method="post" class="header-search" style="margin: 0;">
                        @csrf
                        <div style="display: flex; flex-wrap: nowrap; gap: 8px; width: 100%; padding: 0 10px;">
                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Faculty name or Email" list="faculty" style="flex: 1;">
                            <datalist id="faculty">
                                @foreach($facultyList as $fac)
                                    <option value="{{ $fac->facname }}"></option>
                                    <option value="{{ $fac->facemail }}"></option>
                                @endforeach
                            </datalist>
                            <input type="Submit" value="Search" class="btn btn-primary-soft" style="padding: 10px 20px; flex: 0 0 auto;">
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── Title & Add New Panel ── --}}
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 20px 20px; flex-wrap: wrap; gap: 15px;">
                <div class="admin-home-title" style="padding: 0;">
                    @include('components.hamburger')
                    <p>Faculty Management</p>
                </div>
                <a href="?action=add&id=none&error=0" class="non-style-link">
                    <button class="login-btn btn-primary btn button-icon" style="display: flex;justify-content: center;align-items: center; background-image: url('{{ asset('img/icons/add.svg') }}'); padding-left: 35px;">Add New Faculty</button>
                </a>
            </div>

            {{-- ── Main Data Panel ── --}}
            <div style="padding: 0 20px 20px;">
                <div class="db-panel">
                    <p class="db-heading-appo" style="padding: 5px 10px 15px; margin: 0; font-size: 18px;">All Faculty ({{ $faculties->count() }})</p>
                    
                    <div class="abc scroll" style="height: auto; max-height: 60vh;">
                        <table width="100%" class="sub-table scrolldown" border="0" style="margin: 0;">
                        <thead>
                        <tr>
                                <th class="table-headin">Faculty Name</th>
                                <th class="table-headin">Email</th>
                                <th class="table-headin">Subject</th>
                                <th class="table-headin" style="text-align: center !important;">Events</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($faculties->count() == 0)
                                <tr>
                                    <td colspan="4">
                                        <div class="db-empty" style="padding: 40px 12px;">
                                            <img src="{{ asset('img/notfound.svg') }}">
                                            <p style="font-size: 16px; font-weight: 500;">We couldn't find anything related to your keywords!</p>
                                            <a class="non-style-link" href="{{ url('/admin/faculty') }}">
                                                <button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center; margin: 0 auto;">&nbsp; Show all Faculty &nbsp;</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach($faculties as $fac)
                                    <tr>
                                        <td> &nbsp;{{ substr($fac->facname,0,30) }}</td>
                                        <td>{{ substr($fac->facemail,0,20) }}</td>
                                        <td>{{ substr($fac->subject,0,20) }}</td>
                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        <a href="?action=edit&id={{ $fac->facid }}&error=0" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-edit"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Edit</font></button></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="?action=view&id={{ $fac->facid }}" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                        <a href="?action=drop&id={{ $fac->facid }}&name={{ urlencode($fac->facname) }}" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Remove</font></button></a>
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
    </div>
    
    @if($action=='drop')
        <div id="popup1" class="overlay">
                <div class="popup">
                <center>
                    <h2>Are you sure?</h2>
                    <a class="close" href="{{ url('/admin/faculty') }}">&times;</a>
                    <div class="content">
                        You want to delete this record<br>({{ substr(urldecode($nameget),0,40) }}).
                    </div>
                    <div style="display: flex;justify-content: center;">
                        <form action="{{ route('admin.faculty.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;Yes&nbsp;</font></button>
                        </form>
                    &nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/admin/faculty') }}" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                    </div>
                </center>
        </div>
        </div>
    @elseif($action=='view')
        <div id="popup1" class="overlay">
                <div class="popup">
                <center>
                    <h2></h2>
                    <a class="close" href="{{ url('/admin/faculty') }}">&times;</a>
                    <div class="content">
                        ConsultEase<br>
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
                                {{ $facultyDetails->facname }}<br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="Email" class="form-label">Email: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            {{ $facultyDetails->facemail }}<br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="Tele" class="form-label">Telephone: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            {{ $facultyDetails->factel }}<br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="spec" class="form-label">Subject: </label>
                            </td>
                        </tr>
                        <tr>
                        <td class="label-td" colspan="2">
                        {{ $facultyDetails->subject }}<br><br>
                        </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="{{ url('/admin/faculty') }}"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                            </td>
                        </tr>
                    </table>
                    </div>
                </center>
                <br><br>
        </div>
        </div>
    @elseif($action=='add')
        @php
            $errorlist = [
                '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Confirmation Error! Reconform Password</label>',
                '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                '4' => "",
                '0' => '',
            ];
        @endphp
        @if($error_1 != '4')
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="{{ url('/admin/faculty') }}">&times;</a>
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">{!! $errorlist[$error_1] !!}</td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Faculty.</p><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <form action="{{ route('admin.faculty.add') }}" method="POST" class="add-new-form">
                                    @csrf
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="name" class="input-text" placeholder="Faculty Name" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="email" name="email" class="input-text" placeholder="Email Address" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Subject: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="spec" class="input-text" placeholder="Subject" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="password" class="form-label">Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="password" class="input-text" placeholder="Define a Password" required><br>
                                </td>
                            </tr><tr>
                                <td class="label-td" colspan="2">
                                    <label for="cpassword" class="form-label">Confirm Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="cpassword" class="input-text" placeholder="Confirm Password" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="submit" value="Add" class="login-btn btn-primary btn">
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
        @else
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br><br><br>
                        <h2>New Record Added Successfully!</h2>
                        <a class="close" href="{{ url('/admin/faculty') }}">&times;</a>
                        <div class="content"></div>
                        <div style="display: flex;justify-content: center;">
                        <a href="{{ url('/admin/faculty') }}" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        </div>
                        <br><br>
                    </center>
            </div>
            </div>
        @endif
    @elseif($action=='edit')
        @php
            $errorlist = [
                '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Confirmation Error! Reconform Password</label>',
                '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                '4' => "",
                '0' => '',
            ];
        @endphp
        @if($error_1 != '4')
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="{{ url('/admin/faculty') }}">&times;</a>
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">{!! $errorlist[$error_1] !!}</td>
                            </tr>
                            <tr >
                                <td colspan="1" class="nav-bar" style="display: flex; align-items: center;">
                                    @include('components.hamburger')
                                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Faculty Providers</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Edit Faculty Details.</p>
                                    Faculty ID : {{ $id }} (Auto Generated)<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <form action="{{ route('admin.faculty.edit') }}" method="POST" class="add-new-form">
                                    @csrf
                                    <label for="Email" class="form-label">Email: </label>
                                    <input type="hidden" value="{{ $id }}" name="id00">
                                    <input type="hidden" name="oldemail" value="{{ $facultyDetails->facemail }}" >
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <input type="email" name="email" class="input-text" placeholder="Email Address" value="{{ $facultyDetails->facemail }}" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="name" class="input-text" placeholder="Faculty Name" value="{{ $facultyDetails->facname }}" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" value="{{ $facultyDetails->factel }}" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Subject: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="spec" class="input-text" placeholder="Subject" value="{{ $facultyDetails->subject }}" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="password" class="form-label">Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="password" class="input-text" placeholder="Define a Password" required><br>
                                </td>
                            </tr><tr>
                                <td class="label-td" colspan="2">
                                    <label for="cpassword" class="form-label">Confirm Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="cpassword" class="input-text" placeholder="Confirm Password" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="submit" value="Save" class="login-btn btn-primary btn">
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
        @else
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br><br><br>
                        <h2>Edit Successfully!</h2>
                        <a class="close" href="{{ url('/admin/faculty') }}">&times;</a>
                        <div class="content"></div>
                        <div style="display: flex;justify-content: center;">
                        <a href="{{ url('/admin/faculty') }}" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        </div>
                        <br><br>
                    </center>
            </div>
            </div>
        @endif
    @endif
</div>
</body>
</html>
