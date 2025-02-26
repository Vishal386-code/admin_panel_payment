<nav class="main-header navbar navbar-expand-lg navbar-white navbar-light">
    <div class="container-fluid">
        <!-- Left Side -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right Side -->
        <ul class="navbar-nav ml-auto">
            <!-- Profile Dropdown -->
            @if(Auth::check())
         
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-toggle="dropdown">
                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="rounded-circle" width="35" height="35" alt="Profile">

                    <span class="ml-2 d-none d-sm-inline">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('profile.show') }}" class="dropdown-item">
                        <i class="fas fa-user-circle mr-2"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
            @endif
        </ul>
    </div>
</nav>
