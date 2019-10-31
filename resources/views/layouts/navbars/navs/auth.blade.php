<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('home') }}">
            @if(\Request::is('admin/dashboard*')) 
                Dashboard 
            @elseif(\Request::is('admin/admins*'))
                Admins
            @elseif(\Request::is('admin/users*'))
                Users
            @elseif(\Request::is('admin/jobs*'))
                Jobs
            @elseif(\Request::is('admin/applications*'))
                Applications
            @elseif(\Request::is('admin/resumes*'))
                Resumes
            @elseif(\Request::is('admin/usermessages*'))
                User messages
            @endif
        </a>

        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
            <div class="form-group mb-0">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>  
                    <input name="q" class="form-control" placeholder="Search" type="text">
                </div>
            </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        @if(auth()->user()->picture)
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('images') }}/{{ auth()->user()->picture->filename }}">
                        </span>
                        @else
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('images') }}/user.jpg">
                        </span>
                        @endif
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('text.welcome') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('text.profile') }}</span>
                    </a>
                    <a href="/admin/profile/jobs" class="dropdown-item">
                        <i class="fas fa-briefcase "></i>
                        <span>{{ __('text.jobs') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('text.activity') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('text.logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>