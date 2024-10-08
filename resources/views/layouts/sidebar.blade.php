<ul class="navbar-nav bg-gradient-light sidebar sidebar-light accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/logo.png') }}" alt="logo" width="30px">

        </div>
        <div class="sidebar-brand-text mx-3">PHIRAKA</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('fibonacci.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('fibonacci.index') }}">
            <i class="fas ri-hashtag"></i>
            <span>Fibonacci</span></a>
    </li>

    <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas ri-group-line"></i>
            <span>User Settings</span></a>
    </li>

    <li class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('profile') }}">
            <i class="fas ri-user-line"></i>
            <span>Profile</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
