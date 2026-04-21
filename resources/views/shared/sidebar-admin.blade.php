@php
    $activePage = $activePage ?? 'dashboard';
@endphp

<div class="menu menu--fixed">
    <div class="app-sidebar-top">
        <div class="app-profile-card">
            <div class="app-profile-media">
                <div class="app-profile-avatar-wrap">
                    <img src="{{ asset('img/user.png') }}" alt="Administrator" class="app-profile-avatar">
                </div>
                <div class="app-profile-copy">
                    <p class="profile-title">Administrator</p>
                    <p class="profile-subtitle">{{ $admin->aemail }}</p>
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

    <nav class="app-sidebar-nav" aria-label="Admin navigation">
        <a href="{{ route('admin.dashboard') }}" class="app-nav-link menu-icon-dashbord {{ $activePage === 'dashboard' ? 'app-nav-link--active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.faculty') }}" class="app-nav-link menu-icon-faculty {{ $activePage === 'faculty' ? 'app-nav-link--active' : '' }}">Faculty</a>
        <a href="{{ route('admin.schedule') }}" class="app-nav-link menu-icon-schedule {{ $activePage === 'schedule' ? 'app-nav-link--active' : '' }}">Schedule</a>
        <a href="{{ route('admin.appointment') }}" class="app-nav-link menu-icon-appoinment {{ $activePage === 'appointment' ? 'app-nav-link--active' : '' }}">Appointment</a>
        <a href="{{ route('admin.student') }}" class="app-nav-link menu-icon-student {{ $activePage === 'student' ? 'app-nav-link--active' : '' }}">Students</a>
        <a href="{{ route('admin.settings') }}" class="app-nav-link menu-icon-settings {{ $activePage === 'settings' ? 'app-nav-link--active' : '' }}">Profile</a>
        <button type="button" class="app-nav-link app-nav-link--button menu-icon-notifications" id="notification-btn">Notifications</button>
    </nav>
</div>
