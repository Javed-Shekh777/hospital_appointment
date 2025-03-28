<!DOCTYPE html>
<html lang="en">

@include('layout.head')

<body>
    <header class="dashboard-navbar   bg-body-white" id="header">
        <nav class="navbar ">
            <div class="container-fluid ">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                        <img src="{{ secure_asset('assets/img/logo.svg') }}" alt="" class="img-fluid" class="profile image">
                    </a>
                    <div class="sidebar-btn" id="sidebarBtn"><i class="bi bi-list"></i></div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn create-btn ">Logout</button>
                </form>
            </div>
        </nav>
    </header>

    <main class="dashboard">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-wrapper">
                <ul class="sidebar-list">
                    <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                            <span class="sidebar-link-icon"><i class="bi bi-house-door"></i></span>
                            <span class="sidebar-link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.allappointments') ? 'active' : '' }}">
                        <a href="{{ route('admin.allappointments') }}" class="sidebar-link">
                            <span class="sidebar-link-icon"><i class="bi bi-calendar"></i></span>
                            <span class="sidebar-link-title">Appointments</span>
                        </a>
                    </li>
                    @if(Auth::check() && (Auth::user()->role == 'admin'))
                    <li class="sidebar-item {{ request()->routeIs('admin.adddoctor') ? 'active' : '' }}">
                        <a href="{{ route('admin.adddoctor') }}" class="sidebar-link">
                            <span class="sidebar-link-icon"><i class="bi bi-plus-square"></i></span>
                            <span class="sidebar-link-title">Add Doctor</span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::check() && (Auth::user()->role == 'admin'))
                   
                    <li class="sidebar-item {{ request()->routeIs('admin.doctors') ? 'active' : '' }}">
                        <a href="{{ route('admin.doctors') }}" class="sidebar-link">
                            <span class="sidebar-link-icon"><i class="bi bi-people"></i></span>
                            <span class="sidebar-link-title">Doctor List</span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::check() && (Auth::user()->role == ('doctor'||'admin')))
                   
                    <li class="sidebar-item {{ request()->routeIs('admin.allpatients') ? 'active' : '' }}">
                        <a href="{{ route('admin.allpatients') }}" class="sidebar-link">
                            <span class="sidebar-link-icon"><i class="bi bi-people"></i></span>
                            <span class="sidebar-link-title">Patients</span>
                        </a>
                    </li>
                    @endif

                    @if(Auth::check() && (Auth::user()->role == ('admin')))
                   
                    <li class="sidebar-item {{ request()->routeIs('admin.allusers') ? 'active' : '' }}">
                        <a href="{{ route('admin.allusers') }}" class="sidebar-link">
                            <span class="sidebar-link-icon"><i class="bi bi-people"></i></span>
                            <span class="sidebar-link-title">All Users</span>
                        </a>
                    </li>
                    @endif

                </ul>

            </div>
        </aside>

        <section class="sidebar-content w-100">
            @yield('sidebarcontent')
        </section>
    </main>





    <!-- Vendor JS Files -->
    <script src="{{ secure_asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ secure_asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ secure_asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ secure_asset('assets/js/main.js') }}"></script>
</body>

</html>
