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
                @include('shared.sidebar-student', ['activePage' => 'faculty'])
<div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">
                        <a href="{{ url('/student/dashboard') }}" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                            @include('shared.hamburger')
                            <form action="{{ url('/student/faculty') }}" method="post" class="header-search" style="flex:1 1 320px;">
                                @csrf
                                <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Faculty name or Email" list="faculty">&nbsp;&nbsp;
                                <datalist id="faculty">
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->facname }}"></option>
                                        <option value="{{ $faculty->facemail }}"></option>
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
                            {{ date('Y-m-d') }}
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="{{ asset('img/calendar.svg') }}" width="100%"></button>
                    </td>
                </tr>

               <tr>
                   <td colspan="4" style="padding-top:10px;">
                       <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">My Faculty ({{ $faculties->count() }})</p>
                   </td>
               </tr>

                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin">Faculty Name</th>
                                <th class="table-headin">Email</th>
                                <th class="table-headin">Subject</th>
                                <th class="table-headin">Events</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($faculties->count() == 0)
                                <tr>
                                <td colspan="4">
                                <br><br><br><br>
                                <center>
                                <img src="{{ asset('img/notfound.svg') }}" width="25%">
                                <br>
                                <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                <a class="non-style-link" href="{{ url('/student/faculty') }}"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Faculty &nbsp;</font></button>
                                </a>
                                </center>
                                <br><br><br><br>
                                </td>
                                </tr>
                            @else
                                @foreach($faculties as $faculty)
                                    <tr>
                                        <td> &nbsp;{{ substr($faculty->facname,0,30) }}</td>
                                        <td>{{ substr($faculty->facemail,0,20) }}</td>
                                        <td>
                                            @if(isset($subjects[$faculty->subject]))
                                                {{ substr($subjects[$faculty->subject]->sname,0,20) }}
                                            @else
                                                Unknown
                                            @endif
                                        </td>
                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                            <a href="?action=view&id={{ $faculty->facid }}" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="?action=availability&id={{ $faculty->facid }}&name={{ $faculty->facname }}"  class="non-style-link"><button  class="btn-primary-soft btn button-icon"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Availability</font></button></a>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="?action=book&id={{ $faculty->facid }}&name={{ $faculty->facname }}"  class="non-style-link"><button  class="btn-primary-soft btn button-icon menu-icon-session-active"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Book Now</font></button></a>
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

    @if($action == 'view')
        <div id="popup1" class="overlay">
            <div class="popup popup--profile-id">
                    <a class="close" href="{{ url('/student/faculty') }}">&times;</a>
                    <div class="profile-id-card">
                        <div class="profile-id-card__top">
                            <div>
                                <span class="profile-id-card__eyebrow">Faculty Profile</span>
                                <h2 class="profile-id-card__title">Faculty Information Card</h2>
                                <p class="profile-id-card__subtitle">A cleaner ID-style summary so students can quickly verify faculty details before booking.</p>
                            </div>
                            <div class="profile-id-card__badge">F-{{ $selectedFaculty->facid ?? '--' }}</div>
                        </div>

                        <div class="profile-id-card__hero">
                            <div class="profile-id-card__avatar-wrap">
                                <img
                                    src="{{ $selectedFaculty->profile_pic ? asset('storage/' . $selectedFaculty->profile_pic) : asset('img/user.png') }}"
                                    alt="{{ $selectedFaculty->facname }}"
                                    class="profile-id-card__avatar"
                                >
                            </div>
                            <div class="profile-id-card__hero-copy">
                                <p class="profile-id-card__role">Faculty Member</p>
                                <h3 class="profile-id-card__name">{{ $selectedFaculty->facname }}</h3>
                                <p class="profile-id-card__meta">{{ $selectedFaculty->facemail }}</p>
                                <div class="profile-id-card__chips">
                                    <span class="status-chip status-chip--success">Available for Booking</span>
                                    <span class="profile-id-card__micro">Faculty ID {{ $selectedFaculty->facid ?? '--' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="profile-id-card__grid">
                            <div class="profile-id-card__field">
                                <span class="profile-id-card__label">Faculty ID</span>
                                <div class="profile-id-card__value">F-{{ $selectedFaculty->facid ?? '--' }}</div>
                            </div>
                            <div class="profile-id-card__field">
                                <span class="profile-id-card__label">Subject</span>
                                <div class="profile-id-card__value">{{ $spcil_name }}</div>
                            </div>
                            <div class="profile-id-card__field">
                                <span class="profile-id-card__label">Telephone</span>
                                <div class="profile-id-card__value">{{ $selectedFaculty->factel }}</div>
                            </div>
                            <div class="profile-id-card__field">
                                <span class="profile-id-card__label">Email</span>
                                <div class="profile-id-card__value">{{ $selectedFaculty->facemail }}</div>
                            </div>
                            <div class="profile-id-card__field profile-id-card__field--wide">
                                <span class="profile-id-card__label">Role</span>
                                <div class="profile-id-card__value">Faculty Member</div>
                            </div>
                        </div>

                        <div class="dialog-actions" style="padding: 0 24px 24px;">
                            <a href="{{ url('/student/faculty') }}" class="non-style-link">
                                <button class="btn-primary-soft btn">Close Card</button>
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    @elseif($action == 'availability')
        @php
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            $has_availability = false;
        @endphp
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2>Availability for {{ substr($name,0,40) }}</h2>
                    <a class="close" href="{{ url('/student/faculty') }}">&times;</a>
                    <div class="content">
                        <table class="sub-table" border="0" style="width:100%; text-align:left;">
                            <thead>
                                <tr>
                                    <th class="table-headin">Day</th>
                                    <th class="table-headin">Available Time for Consultation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($d=1; $d<=7; $d++)
                                    @php
                                        $day_name = $days[$d-1];
                                        $slots = isset($availabilities[$d]) ? $availabilities[$d] : [];
                                        $times = [];
                                        foreach($slots as $slot){
                                            $times[] = substr($slot->start_time, 0, 5) . ' - ' . substr($slot->end_time, 0, 5);
                                        }
                                        $time_str = implode(', ', $times);
                                    @endphp
                                    @if(count($times) > 0)
                                        @php $has_availability = true; @endphp
                                        <tr>
                                            <td>{{ $day_name }}</td>
                                            <td>{{ $time_str }}</td>
                                        </tr>
                                    @endif
                                @endfor

                                @if(!$has_availability)
                                    <tr><td colspan="2" style="text-align:center;">No availability set.</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div style="display: flex;justify-content: center;margin-top:20px;">
                        <a href="{{ url('/student/faculty') }}" class="non-style-link"><button class="btn-primary btn">OK</button></a>
                    </div>
                </center>
            </div>
        </div>
    @elseif($action == 'book')
        {{-- For booking, we normally wouldn't show the logic entirely inside the blade view in Laravel. However, to maintain similarity with the original system, we handle the booking result view based on a future controller method mapped to POST session...
             Since the controller right now only passes $action = 'book', we will just redirect or show a prompt to initiate booking via a form --}}
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2>Redirect to Booking?</h2>
                    <a class="close" href="{{ url('/student/faculty') }}">&times;</a>
                    <div class="content">
                        You want to book a session with <br>({{ substr($name,0,40) }}).
                    </div>
                    <form action="{{ url('/student/schedule') }}" method="post" style="display: flex">
                        @csrf
                        <input type="hidden" name="search" value="{{ $name }}">
                        <div style="display: flex;justify-content:center;margin-left:0;margin-top:6%;margin-bottom:6%;">
                            <input type="submit" value="Yes" class="btn-primary btn">
                        </div>
                    </form>
                </center>
            </div>
        </div>
    @endif
</div>
    @include('shared.notifications')
</body>
</html>

