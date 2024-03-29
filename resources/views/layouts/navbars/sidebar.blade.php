<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}" target="_blank">
            <span style="color: #5e72e4; font-size: 30px;">WAZIFTY</span>
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item <?php if(\Request::is('admin/dashboard')) echo 'active' ?>">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                @if(auth()->user()->isOwner())
                <li class="nav-item <?php if(\Request::is('admin/admins*')) echo 'active' ?>">
                    <a class="nav-link" href="#admins" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                        <i class="fas fa-user-secret" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Admin') }}</span>
                    </a>

                    <div class="collapse" id="admins">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admins.index') }}">
                                    {{ __('Admin Management') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admins.create') }}">
                                    {{ __('New admin') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                <li class="nav-item <?php if(\Request::is('admin/users*')) echo 'active' ?>">
                    <a class="nav-link" href="#users" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="users">
                        <i class="fas fa-users text-blue"></i>
                        <span class="nav-link-text">{{ __('Users') }}</span>
                    </a>

                    <div class="collapse" id="users">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.index') }}">
                                    {{ __('User Management') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.create') }}">
                                    {{ __('New User') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item <?php if(\Request::is('admin/jobs*')) echo 'active' ?>">
                    <a class="nav-link" href="#jobs" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="users">
                        <i class="fas fa-briefcase text-blue"></i>
                        <span class="nav-link-text">{{ __('Jobs') }}</span>
                    </a>

                    <div class="collapse" id="jobs">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/jobs">
                                    {{ __('All Jobs') }}
                                </a>
                            </li>
                            @if(auth()->user()->emp_type == "employer")
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/jobs/create">
                                    {{ __('New Job') }}
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>

                <li class="nav-item <?php if(\Request::is('admin/jobcategories*')) echo 'active' ?>">
                    <a class="nav-link" href="/admin/jobcategories">
                        <i class="fas fa-list text-blue"></i> {{ __('Categories') }}
                    </a>
                </li>

                <li class="nav-item <?php if(\Request::is('admin/applications*')) echo 'active' ?>">
                    <a class="nav-link" href="/admin/applications">
                        <i class="fas fa-poll-h text-blue"></i> {{ __('Applications') }}
                    </a>
                </li>
                <li class="nav-item <?php if(\Request::is('admin/resumes*')) echo 'active' ?>">
                    <a class="nav-link" href="/admin/resumes">
                        <i class="fas fa-file-alt text-blue"></i> {{ __('Resumes') }}
                    </a>
                </li>
                <li class="nav-item <?php if(\Request::is('admin/usersmessages*')) echo 'active' ?>">
                    <a class="nav-link" href="/admin/usermessages">
                        <i class="fas fa-comment-alt text-blue"></i> {{ __('Users messages') }}
                    </a>
                </li>


            </ul>
            
            <!-- Divider -->
            <hr class="my-3">

            <ul class="navbar-nav">

                <li class="nav-item <?php if(\Request::is('admin/blog/posts*')) echo 'active' ?>">
                    <a class="nav-link" href="#posts" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="posts">
                        <i class="far fa-newspaper text-blue"></i>
                        <span class="nav-link-text">{{ __('Posts') }}</span>
                    </a>

                    <div class="collapse" id="posts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/blog/posts">
                                    {{ __('All Posts') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/blog/posts/create">
                                    {{ __('New Post') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item <?php if(\Request::is('admin/blog/categories*')) echo 'active' ?>">
                    <a class="nav-link" href="/admin/blog/categories">
                        <i class="fas fa-list text-blue"></i> {{ __('Categories') }}
                    </a>
                </li>

                <li class="nav-item <?php if(\Request::is('admin/blog/comments*')) echo 'active' ?>">
                    <a class="nav-link" href="/admin/blog/comments">
                        <i class="fas fa-comments text-blue"></i> {{ __('Comments') }}
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>