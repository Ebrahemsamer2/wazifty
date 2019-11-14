<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <title>WAZIFTY BLOG</title>

    <!-- Bootstrap core CSS -->
    <link href="/argon/css/argon.css" rel="stylesheet">
    <link href="/blog_assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/blog_assets/css/templatemo-host-cloud.css">

    <!-- Logo -->
    <link href="{{ asset('argon') }}/img/brand/browser_logo.jpg" rel="icon" type="image/png">

    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/argon/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="/argon/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="/blog_assets/css/fontawesome.css">
    <link rel="stylesheet" href="/blog_assets/css/templatemo-host-cloud.css">
    <link rel="stylesheet" href="/blog_assets/css/owl.css">
    <link rel="stylesheet" href="/blog_assets/css/custom.css">

  </head>

  <body>

    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="/blog"><h2>WAZ <em>IFTY</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item @if(\Request::is('blog')) {{'active'}} @endif">
                <a class="nav-link" href="/blog">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item @if(\Request::is('blog/aboutus')) {{'active'}} @endif">
                <a class="nav-link" href="/blog/aboutus">About Us</a>
              </li>
              <li class="nav-item @if(\Request::is('blog/contact')) {{'active'}} @endif">
                <a class="nav-link" href="/blog/contact">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/">Back to wazifty</a>
              </li>
            </ul>
          </div>
          <div class="functional-buttons">
            @guest
            <ul>
              <li><a href="/login">Log in</a></li>
              <li><a href="/register">Sign Up</a></li>
            </ul>
            @endguest
            @auth
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
                            <span class="mb-0 text-sm  font-weight-bold">{{ \Str::limit(auth()->user()->name, 13) }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    @if(auth()->user()->admin == 1)
                    <a href="/admin" class="dropdown-item">
                        <i class="ni ni-tv-2 text-primary"></i>
                        <span> Admin fashboard</span>
                    </a>
                    @endif
                    <a href="<?php if(auth()->user()->emp_type =='employee') echo '/user';else echo '/company'; ?>/profile" class="dropdown-item">
                        <i class="fas fa-user-edit"></i>
                        <span>Edit profile</span>
                    </a>
                    @if(auth()->user()->emp_type == "employer")
                    <a href="/user/{{auth()->user()->id}}/profile" class="dropdown-item">
                        <i class="fa fa-eye"></i>
                        <span>Preview profile</span>
                    </a>
                    @else
                    <a href="/company/{{auth()->user()->id}}/profile" class="dropdown-item">
                        <i class="fa fa-eye"></i>
                        <span>Preview profile</span>
                    </a>
                    @endif
                    @if(auth()->user()->emp_type == "employee")
                    <a href="/user/applications" class="dropdown-item">
                        <i class="fas fa-poll-h"></i>
                        <span>Applications</span>
                    </a>
                    <a href="/user/saved-jobs" class="dropdown-item">
                        <i class="fas fa-briefcase"></i>
                        <span>Saved jobs</span>
                    </a>
                    @endif
                    @if(auth()->user()->emp_type == "employer")
                    <a class="dropdown-item" href="/company/jobs/applications"><i class="fas fa-poll-h "></i>
                        <span>Applications</span>
                    </a>
                    <a class="dropdown-item" href="/newjob"><i class="fas fa-briefcase "></i>
                        <span>New job</span>
                    </a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run "></i>
                        <span>{{ __('text.logout') }}</span>
                    </a>

                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
          </ul>
            @endauth
          </div>
        </div>
      </nav>
    </header>