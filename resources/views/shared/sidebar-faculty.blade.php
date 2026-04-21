@php
    $activePage = $activePage ?? 'dashboard';
@endphp

<div class="menu menu--fixed">
    <div class="app-sidebar-top">
        <div class="app-profile-card">
            <div class="app-profile-media">
                <div class="app-profile-avatar-wrap">
                    <img src="{{ $faculty->profile_pic ? asset('storage/' . $faculty->profile_pic) : asset('img/user.png') }}" alt="{{ $faculty->facname }}" class="app-profile-avatar">
                </div>
                <div class="app-profile-copy">
                    <p class="profile-title">{{ $faculty->facname }}</p>
                    <p class="profile-subtitle">{{ $faculty->facemail }}</p>
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

    <nav class="app-sidebar-nav" aria-label="Faculty navigation">
        <a href="{{ route('faculty.dashboard') }}" class="app-nav-link menu-icon-dashbord {{ $activePage === 'dashboard' ? 'app-nav-link--active' : '' }}">Dashboard</a>
        <a href="{{ route('faculty.appointment') }}" class="app-nav-link menu-icon-appoinment {{ $activePage === 'appointment' ? 'app-nav-link--active' : '' }}">My Appointments</a>
        <a href="{{ route('faculty.schedule') }}" class="app-nav-link menu-icon-session {{ $activePage === 'schedule' ? 'app-nav-link--active' : '' }}">My Sessions</a>
        <a href="{{ route('faculty.student') }}" class="app-nav-link menu-icon-student {{ $activePage === 'student' ? 'app-nav-link--active' : '' }}">My Students</a>
        <a href="{{ route('faculty.settings') }}" class="app-nav-link menu-icon-settings {{ $activePage === 'settings' ? 'app-nav-link--active' : '' }}">Settings</a>
        <button type="button" class="app-nav-link app-nav-link--button menu-icon-notifications" id="notification-btn">Notifications</button>
    </nav>
</div>
