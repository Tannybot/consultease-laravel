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
    <title>Faculty</title>
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
                                    <img src="{{ asset('img/user.png') }}" alt="Administrator" style="width: 91.85px; height: 91.85px; border-radius:50%">
                                </td>
                                <td style="padding:0;margin:0;">
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
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord">
                        <a href="{{ url('/admin/dashboard') }}" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-faculty menu-active menu-icon-faculty-active">
                        <a href="{{ url('/admin/faculty') }}" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Faculty</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-schedule">
                        <a href="{{ url('/admin/schedule') }}" class="non-style-link-menu"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="{{ url('/admin/appointment') }}" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-student">
                        <a href="{{ url('/admin/student') }}" class="non-style-link-menu"><div><p class="menu-text">Students</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-settings">
                        <a href="{{ url('/admin/settings') }}" class="non-style-link-menu"><div><p class="menu-text">Profile</p></div></a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="dash-body">
            <div class="page-shell">
                <div class="page-toolbar">
                    <div class="page-toolbar__group">
                        <a href="{{ url('/admin/dashboard') }}" class="non-style-link">
                            <button class="login-btn btn-primary-soft btn btn-icon-back">Back</button>
                        </a>
                        <div>
                            <div class="page-toolbar__group">
                                @include('shared.hamburger')
                                <h1 class="page-toolbar__title">Faculty Management</h1>
                            </div>
                            <p class="page-toolbar__subtitle">Search faculty records, review account details, and manage faculty access from one screen.</p>
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
                            <h2 class="page-card__title">Faculty directory</h2>
                            <p class="page-card__description">Search by faculty name or email to locate the right record quickly.</p>
                        </div>
                        <a href="?action=add&id=none&error=0" class="non-style-link">
                            <button class="login-btn btn-primary btn button-icon" style="background-image: url('{{ asset('img/icons/add.svg') }}'); padding-left: 36px;">Add New Faculty</button>
                        </a>
                    </div>

                    <form action="{{ url('/admin/faculty') }}" method="post" class="toolbar-search" style="margin-top: 18px;">
                        @csrf
                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Search faculty name or email" list="faculty">
                        <datalist id="faculty">
                            @foreach($facultyList as $fac)
                                <option value="{{ $fac->facname }}"></option>
                                <option value="{{ $fac->facemail }}"></option>
                            @endforeach
                        </datalist>
                        <input type="submit" value="Search" class="btn btn-primary-soft">
                    </form>
                </div>

                <div class="page-card">
                    <div class="page-card__header">
                        <div>
                            <span class="page-card__eyebrow">Records</span>
                            <h2 class="page-card__title">All Faculty ({{ $faculties->count() }})</h2>
                            <p class="page-card__description">Browse faculty accounts, review subject assignments, and open quick actions below.</p>
                        </div>
                    </div>

                    @if($faculties->count() == 0)
                        <div class="empty-state">
                            <img src="{{ asset('img/notfound.svg') }}" alt="No faculty found">
                            <p>We could not find anything related to your search.</p>
                            <a class="non-style-link" href="{{ url('/admin/faculty') }}">
                                <button class="login-btn btn-primary-soft btn">Show all faculty</button>
                            </a>
                        </div>
                    @else
                        <div class="record-card-grid">
                            @foreach($faculties as $fac)
                                <div class="record-card">
                                    <div>
                                        <h3 class="record-card__title">{{ substr($fac->facname,0,30) }}</h3>
                                        <p class="record-card__copy">{{ substr($fac->facemail,0,30) }}</p>
                                    </div>

                                    <div>
                                        <p class="record-card__meta"><strong>Subject:</strong> {{ substr($fac->subject,0,40) }}</p>
                                    </div>

                                    <div class="record-card__actions">
                                        <a href="?action=edit&id={{ $fac->facid }}&error=0" class="non-style-link">
                                            <button class="btn-primary-soft btn button-icon btn-edit">Edit</button>
                                        </a>
                                        <a href="?action=view&id={{ $fac->facid }}" class="non-style-link">
                                            <button class="btn-primary-soft btn button-icon btn-view">View</button>
                                        </a>
                                        <a href="?action=drop&id={{ $fac->facid }}&name={{ urlencode($fac->facname) }}" class="non-style-link">
                                            <button class="btn-primary-soft btn button-icon btn-delete">Remove</button>
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

    @if($action=='drop')
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2>Delete faculty record?</h2>
                    <a class="close" href="{{ url('/admin/faculty') }}">&times;</a>
                    <div class="content">You are about to delete <b>{{ substr(urldecode($nameget),0,40) }}</b>.</div>
                    <div class="dialog-actions">
                        <form action="{{ route('admin.faculty.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="btn-primary btn">Yes, delete</button>
                        </form>
                        <a href="{{ url('/admin/faculty') }}" class="non-style-link">
                            <button class="btn-primary-soft btn">Cancel</button>
                        </a>
                    </div>
                </center>
            </div>
        </div>
    @elseif($action=='view')
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <a class="close" href="{{ url('/admin/faculty') }}">&times;</a>
                    <div class="app-form-card" style="text-align:left;">
                        <div class="page-card__header">
                            <div>
                                <span class="page-card__eyebrow">Faculty Profile</span>
                                <h2 class="page-card__title">View details</h2>
                            </div>
                        </div>
                        <div class="detail-list">
                            <div class="detail-list__item">
                                <span class="detail-list__label">Name</span>
                                <div class="detail-list__value">{{ $facultyDetails->facname }}</div>
                            </div>
                            <div class="detail-list__item">
                                <span class="detail-list__label">Email</span>
                                <div class="detail-list__value">{{ $facultyDetails->facemail }}</div>
                            </div>
                            <div class="detail-list__item">
                                <span class="detail-list__label">Telephone</span>
                                <div class="detail-list__value">{{ $facultyDetails->factel }}</div>
                            </div>
                            <div class="detail-list__item">
                                <span class="detail-list__label">Subject</span>
                                <div class="detail-list__value">{{ $facultyDetails->subject }}</div>
                            </div>
                        </div>
                        <div class="dialog-actions">
                            <a href="{{ url('/admin/faculty') }}" class="non-style-link">
                                <button class="btn-primary-soft btn">Close</button>
                            </a>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    @elseif($action=='add')
        @php
            $errorlist = [
                '1' => 'Already have an account for this email address.',
                '2' => 'Password confirmation error. Please confirm your password again.',
                '3' => '',
                '4' => '',
                '0' => '',
            ];
        @endphp
        @if($error_1 != '4')
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <a class="close" href="{{ url('/admin/faculty') }}">&times;</a>
                        <div class="app-form-card" style="text-align:left;">
                            <div class="page-card__header">
                                <div>
                                    <span class="page-card__eyebrow">New Faculty</span>
                                    <h2 class="page-card__title">Add faculty record</h2>
                                </div>
                            </div>

                            @if($errorlist[$error_1] !== '')
                                <div class="status-banner status-banner--error" style="margin-bottom: 16px;">{{ $errorlist[$error_1] }}</div>
                            @endif

                            <form action="{{ route('admin.faculty.add') }}" method="POST" class="auth-form">
                                @csrf
                                <div class="app-form-grid">
                                    <div class="full auth-field">
                                        <label for="add_name" class="form-label">Name</label>
                                        <input id="add_name" type="text" name="name" class="input-text" placeholder="Faculty name" required>
                                    </div>
                                    <div class="auth-field">
                                        <label for="add_email" class="form-label">Email</label>
                                        <input id="add_email" type="email" name="email" class="input-text" placeholder="Email address" required>
                                    </div>
                                    <div class="auth-field">
                                        <label for="add_tele" class="form-label">Telephone</label>
                                        <input id="add_tele" type="tel" name="Tele" class="input-text" placeholder="Telephone number" required>
                                    </div>
                                    <div class="full auth-field">
                                        <label for="add_spec" class="form-label">Subject</label>
                                        <input id="add_spec" type="text" name="spec" class="input-text" placeholder="Subject" required>
                                    </div>
                                    <div class="auth-field">
                                        <label for="add_password" class="form-label">Password</label>
                                        <input id="add_password" type="password" name="password" class="input-text" placeholder="Define a password" required>
                                    </div>
                                    <div class="auth-field">
                                        <label for="add_cpassword" class="form-label">Confirm password</label>
                                        <input id="add_cpassword" type="password" name="cpassword" class="input-text" placeholder="Confirm password" required>
                                    </div>
                                </div>
                                <div class="app-form-actions">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                                    <input type="submit" value="Add" class="login-btn btn-primary btn">
                                </div>
                            </form>
                        </div>
                    </center>
                </div>
            </div>
        @else
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2>Faculty added successfully</h2>
                        <a class="close" href="{{ url('/admin/faculty') }}">&times;</a>
                        <div class="dialog-actions">
                            <a href="{{ url('/admin/faculty') }}" class="non-style-link">
                                <button class="btn-primary btn">OK</button>
                            </a>
                        </div>
                    </center>
                </div>
            </div>
        @endif
    @elseif($action=='edit')
        @php
            $errorlist = [
                '1' => 'Already have an account for this email address.',
                '2' => 'Password confirmation error. Please confirm your password again.',
                '3' => '',
                '4' => '',
                '0' => '',
            ];
        @endphp
        @if($error_1 != '4')
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <a class="close" href="{{ url('/admin/faculty') }}">&times;</a>
                        <div class="app-form-card" style="text-align:left;">
                            <div class="page-card__header">
                                <div>
                                    <span class="page-card__eyebrow">Edit Faculty</span>
                                    <h2 class="page-card__title">Update faculty details</h2>
                                    <p class="page-card__description">Faculty ID: {{ $id }} (auto generated)</p>
                                </div>
                            </div>

                            @if($errorlist[$error_1] !== '')
                                <div class="status-banner status-banner--error" style="margin-bottom: 16px;">{{ $errorlist[$error_1] }}</div>
                            @endif

                            <form action="{{ route('admin.faculty.edit') }}" method="POST" class="auth-form">
                                @csrf
                                <input type="hidden" value="{{ $id }}" name="id00">
                                <input type="hidden" name="oldemail" value="{{ $facultyDetails->facemail }}">

                                <div class="app-form-grid">
                                    <div class="auth-field">
                                        <label for="edit_email" class="form-label">Email</label>
                                        <input id="edit_email" type="email" name="email" class="input-text" placeholder="Email address" value="{{ $facultyDetails->facemail }}" required>
                                    </div>
                                    <div class="auth-field">
                                        <label for="edit_name" class="form-label">Name</label>
                                        <input id="edit_name" type="text" name="name" class="input-text" placeholder="Faculty name" value="{{ $facultyDetails->facname }}" required>
                                    </div>
                                    <div class="auth-field">
                                        <label for="edit_tele" class="form-label">Telephone</label>
                                        <input id="edit_tele" type="tel" name="Tele" class="input-text" placeholder="Telephone number" value="{{ $facultyDetails->factel }}" required>
                                    </div>
                                    <div class="auth-field">
                                        <label for="edit_spec" class="form-label">Subject</label>
                                        <input id="edit_spec" type="text" name="spec" class="input-text" placeholder="Subject" value="{{ $facultyDetails->subject }}" required>
                                    </div>
                                    <div class="auth-field">
                                        <label for="edit_password" class="form-label">Password</label>
                                        <input id="edit_password" type="password" name="password" class="input-text" placeholder="Define a password" required>
                                    </div>
                                    <div class="auth-field">
                                        <label for="edit_cpassword" class="form-label">Confirm password</label>
                                        <input id="edit_cpassword" type="password" name="cpassword" class="input-text" placeholder="Confirm password" required>
                                    </div>
                                </div>

                                <div class="app-form-actions">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                                    <input type="submit" value="Save" class="login-btn btn-primary btn">
                                </div>
                            </form>
                        </div>
                    </center>
                </div>
            </div>
        @else
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2>Faculty updated successfully</h2>
                        <a class="close" href="{{ url('/admin/faculty') }}">&times;</a>
                        <div class="dialog-actions">
                            <a href="{{ url('/admin/faculty') }}" class="non-style-link">
                                <button class="btn-primary btn">OK</button>
                            </a>
                        </div>
                    </center>
                </div>
            </div>
        @endif
    @endif
</body>
</html>
