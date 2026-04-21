<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">  
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">  
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        
    <title>Students</title>
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
                @include('shared.sidebar-admin', ['activePage' => 'student'])
<div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">

                    <a href="{{ url('/admin/dashboard') }}" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                        
                    </td>
                    <td>
                        <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                            @include('shared.hamburger')
                            <form action="{{ url('/admin/student') }}" method="post" class="header-search" style="flex:1 1 320px;">
                                @csrf
                                <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Student name or Email" list="student">&nbsp;&nbsp;
                                
                                <datalist id="student">
                                @foreach($studentDataList as $s)
                                    <option value="{{ $s->sname }}"><br/>
                                    <option value="{{ $s->semail }}"><br/>
                                @endforeach
                                </datalist>
                                
                           
                                <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                            
                            </form>
                        </div>
                        
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
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Students ({{ $students->count() }})</p>
                    </td>
                    
                </tr>
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown"  style="border-spacing:0;">
                        <thead>
                        <tr>
                                <th class="table-headin">Name</th>
                                <th class="table-headin">Telephone</th>
                                <th class="table-headin">Email</th>
                                <th class="table-headin">Date of Birth</th>
                                <th class="table-headin">Events</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($students->count() == 0)
                                <tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="{{ asset('img/notfound.svg') }}" width="25%">
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="{{ url('/admin/student') }}"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Students &nbsp;</button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                </tr>
                            @else
                                @foreach($students as $student)
                                    <tr>
                                        <td> &nbsp;{{ substr($student->sname,0,35) }}</td>
                                        <td>{{ substr($student->stel,0,10) }}</td>
                                        <td>{{ substr($student->semail,0,20) }}</td>
                                        <td>{{ substr($student->sdob,0,10) }}</td>
                                        <td >
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id={{ $student->sid }}" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       
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
    
    @if($action=='view' && $studentDetails)
        <div id="popup1" class="overlay">
                <div class="popup popup--profile-id">
                    <a class="close" href="{{ url('/admin/student') }}">&times;</a>
                    <div class="profile-id-card">
                        <div class="profile-id-card__top">
                            <div>
                                <span class="profile-id-card__eyebrow">Student Profile</span>
                                <h2 class="profile-id-card__title">Student Information Card</h2>
                                <p class="profile-id-card__subtitle">A clearer ID-style view for quick record checking.</p>
                            </div>
                            <div class="profile-id-card__badge">P-{{ $id }}</div>
                        </div>

                        <div class="profile-id-card__hero">
                            <div class="profile-id-card__avatar-wrap">
                                <img
                                    src="{{ $studentDetails->profile_pic ? asset('storage/' . $studentDetails->profile_pic) : asset('img/user.png') }}"
                                    alt="{{ $studentDetails->sname }}"
                                    class="profile-id-card__avatar"
                                >
                            </div>
                            <div class="profile-id-card__hero-copy">
                                <p class="profile-id-card__role">Registered Student</p>
                                <h3 class="profile-id-card__name">{{ $studentDetails->sname }}</h3>
                                <p class="profile-id-card__meta">{{ $studentDetails->semail }}</p>
                                <div class="profile-id-card__chips">
                                    <span class="status-chip status-chip--success">Active Record</span>
                                    <span class="profile-id-card__micro">ID {{ $id }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="profile-id-card__grid">
                            <div class="profile-id-card__field">
                                <span class="profile-id-card__label">Student ID</span>
                                <div class="profile-id-card__value">P-{{ $id }}</div>
                            </div>
                            <div class="profile-id-card__field">
                                <span class="profile-id-card__label">Date of Birth</span>
                                <div class="profile-id-card__value">{{ $studentDetails->sdob }}</div>
                            </div>
                            <div class="profile-id-card__field">
                                <span class="profile-id-card__label">Telephone</span>
                                <div class="profile-id-card__value">{{ $studentDetails->stel }}</div>
                            </div>
                            <div class="profile-id-card__field">
                                <span class="profile-id-card__label">Email</span>
                                <div class="profile-id-card__value">{{ $studentDetails->semail }}</div>
                            </div>
                            <div class="profile-id-card__field profile-id-card__field--wide">
                                <span class="profile-id-card__label">Address</span>
                                <div class="profile-id-card__value">{{ $studentDetails->saddress }}</div>
                            </div>
                        </div>

                        <div class="dialog-actions" style="padding: 0 24px 24px;">
                            <a href="{{ url('/admin/student') }}" class="non-style-link">
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

