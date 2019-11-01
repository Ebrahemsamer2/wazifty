<!DOCTYPE html>
<html lang="{{ app()->getlocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>
        
        <!-- Logo -->
        <link href="{{ asset('argon') }}/img/brand/browser_logo.jpg" rel="icon" type="image/png">
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:500,600&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Lato:300,700&display=swap" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <!-- Argon CSS -->
        <link type="text/css" href="/argon/css/argon.min.css" rel="stylesheet">

        @yield('css')
      
    </head>
    <body class="{{ app()->getlocale() ? app()->getlocale() : 'en' }}">
    	
	    <header>
	        <div class="header">
		        <nav class="navbar navbar-light">
		            <div class="container">
		                <a class="navbar-brand mr-auto" href="/">
		                    <span class="logo"><span>W</span>AZIFTY</span>
		                </a>
		                <ul class="list-unstyled">
		                	<li class="{{ \Request::is('/') ? 'active':'' }}"><a href="/">Home</a></li>
		                	<li class="{{ \Request::is('jobs') ? 'active':'' }}"><a href="/jobs">Jobs</a></li>
		                	<li class=""><a href="#how-it-works">How it works</a></li>
		                	<li class=""><a href="#why-us">Why us</a></li>
		                	<li class="{{ \Request::is('contact') ? 'active':'' }}"><a href="#contact">Contact</a></li>
		                	<li>
		                		<div class="dropdown">
									<button class="dropbtn">Languages <i style="font-size: 12px;" class="fas fa-sort-down"></i></button>
									<div class="dropdown-content">
									    <a href="/ar">Arabic</a>
									    <a href="/en">English</a>
									  </div>
								</div>
		                	</li>
		                </ul>
		                <span class="search-toggler" style="margin-right: 20px; cursor: pointer;">
		                    <i class="fas fa-search"></i>
		                    <div class="search-form">
		                    	<i class="fas fa-arrow-up"></i>
		                    	<form autocomplete="off" method="post" action="">
		                    		@csrf
		                    		<input id="search" class="form-control" type="text" name="q" placeholder="Search jobs or companies...">
		                    	</form>
		                    </div>
		                </span>
		                @auth
	                    	<div class="dropdown">
							  <a class="dropdown-toggle" href="#" role="button" id="user_menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    @if(auth()->user()->picture && file_exists('images/'.auth()->user()->picture->filename))
	                    		<img class="rounded-circle" width="40" height="40" src="/images/{{ auth()->user()->picture->filename }}">
		                    	@else
		                    		<img width="40" height="40" src="/images/user.jpg">
		                    	@endif
							  </a>

							  <div class="dropdown-menu" aria-labelledby="user_menu">
							  	@auth
							  		@if(auth()->user()->admin == 1)
							    	<a class="dropdown-item" href="/admin/dashboard"><i class="ni ni-tv-2 text-primary text-blue"></i> Admin dashboard</a>
							    	@endif
							    @endauth
							    <a class="dropdown-item" href="<?php if(auth()->user()->emp_type =='employee') echo '/user';else echo '/company'; ?>/profile"><i class="ni ni-single-02 text-blue"></i> Profile</a>
							    <a class="dropdown-item" href="/user/applications"><i class="fas fa-poll-h text-blue"></i> Applications</a>
							    <a class="dropdown-item" href="/user/saved-jobs"><i class="fas fa-briefcase text-blue"></i> Saved jobs</a>
							    <div class="dropdown-divider"></div>
			                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
			                    document.getElementById('logout-form').submit();">
			                        <i class="ni ni-user-run text-blue"></i>
			                        <span>{{ __('text.logout') }}</span>
			                    </a>

			                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
			                    	@csrf
			                        
			                    </form>
							  </div>
							</div>

	                    @endauth
	                    @guest
		                <a href="{{route('login')}}" class="btn btn-login">
		                    <span class="lnr lnr-user"></span>
		                    Login
		                </a>
		                @endguest
<!-- 		                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
		                        aria-label="Toggle navigation">
		                   	<span class="navbar-toggler-icon"></span>
		                </button> -->
		            </div>
		        </nav>
	    	</div>
		</header>

		@yield('main-header')

		<div class="main-content <?php if(\Request::is('/')) echo 'bg-white';else echo 'bg-grey'; ?> ">
		
			@yield('content')
		
		</div>

		<!-- Scripts -->

	    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
        <script src="{{ asset('js') }}/user_custom.js"></script>

        @yield('scripts')

    </body>
</html>