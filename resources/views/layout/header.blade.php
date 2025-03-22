<header class="header  bg-body-white" id="header">
    <nav class="navbar navbar-expand-lg">
        <div class="container ">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="" class="img-fluid">
            </a>

            <div class="collapse navbar-collapse justify-content-end justify-content-sm-between"
                id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('alldoctors') }}">All Doctors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">contact</a>
                    </li>
                </ul>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>




            @if(!Auth::check())
            <a href="{{route('register')}}" class="btn create-btn">Create account</a>
            @else
            <div class="profile-dropdown" >
                <div class="profile-image" id="profile-dropdown">
                    <img class="img-fluid rounded-circle" 
                    src="{{Auth::user()->profile_image ? 
                    url('storage/' . Auth::user()->profile_image)
                    : asset('assets/img/profile_img.svg') }}"
                    
                     alt="profile image">
                    <span><i class="bi bi-chevron-down"></i></span>
                </div>
                <ul class="profile-dropdown-menus" id="profile-dropdown-menus">
                    <li><a class="dropdown-item " href="{{route('my-profile')}}">My Profile</a></li>
                    <li><a class="dropdown-item" href="{{route('my-appointments')}}">My Appointment's</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            @endif


        </div>
    </nav>

</header>
