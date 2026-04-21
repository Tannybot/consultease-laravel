@php
    $activePage = $activePage ?? 'dashboard';
@endphp

<div class="menu menu--fixed">
    <div class="app-sidebar-top">
        <div class="app-profile-card">
            <div class="app-profile-media">
                <div class="app-profile-avatar-wrap">
                    <img src="{{ $student->profile_pic ? asset('storage/' . $student->profile_pic) : asset('img/user.png') }}" alt="{{ $student->sname }}" class="app-profile-avatar">
                </div>
                <div class="app-profile-copy">
                    <p class="profile-title">{{ $student->sname }}</p>
                    <p class="profile-subtitle">{{ $student->semail }}</p>
                </div>
            </div>
            <div class="app-profile-actions">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn btn-primary-soft btn">Log out</button>
                </form>
            </div>
        </div>
    </div>

    <nav class="app-sidebar-nav" aria-label="Student navigation">
        <a href="{{ route('student.dashboard') }}" class="app-nav-link menu-icon-home {{ $activePage === 'dashboard' ? 'app-nav-link--active' : '' }}">Home</a>
        <a href="{{ route('student.faculty') }}" class="app-nav-link menu-icon-faculty {{ $activePage === 'faculty' ? 'app-nav-link--active' : '' }}">All Faculty</a>
        <a href="{{ route('student.schedule') }}" class="app-nav-link menu-icon-session {{ $activePage === 'schedule' ? 'app-nav-link--active' : '' }}">Scheduled Sessions</a>
        <a href="{{ route('student.appointment') }}" class="app-nav-link menu-icon-appoinment {{ $activePage === 'appointment' ? 'app-nav-link--active' : '' }}">My Bookings</a>
        <a href="{{ route('student.settings') }}" class="app-nav-link menu-icon-settings {{ $activePage === 'settings' ? 'app-nav-link--active' : '' }}">Settings</a>
        <button type="button" class="app-nav-link app-nav-link--button menu-icon-notifications" id="notification-btn">Notifications</button>
    </nav>
</div>
