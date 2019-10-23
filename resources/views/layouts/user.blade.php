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
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:500,600&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <!-- Argon CSS -->
        <link type="text/css" href="/argon/css/argon.min.css" rel="stylesheet">
        <!-- My Admin Custom CSS -->
        <link type="text/css" href="/css/user_custom.css" rel="stylesheet">
    </head>
    <body>
    	
	    <header>
	        <div class="header">
		        <nav class="navbar navbar-light">
		            <div class="container">
		                <a class="navbar-brand mr-auto" href="/">
		                    <span class="logo"><span>W</span>AZIFTY</span>
		                </a>
		                <ul class="list-unstyled">
		                	<li class="{{ \Request::is('home') ? 'active':'' }}"><a href="/">Home</a></li>
		                	<li class="{{ \Request::is('jobs') ? 'active':'' }}"><a href="">Jobs</a></li>
		                	<li class="{{ \Request::is('contact') ? 'active':'' }}"><a href="">Contact</a></li>
		                	<li class="{{ \Request::is('about') ? 'active':'' }}"><a href="">About</a></li>
		                </ul>
		                <span class="search-toggler" style="margin-right: 10px;">
		                    <i class="fas fa-search"></i>
		                </span>
		                @auth
	                    	@if(auth()->user()->picture && file_exists('images/'.auth()->user()->picture->filename))
	                    		<img class="rounded-circle" width="40" height="40" src="/images/{{ auth()->user()->picture->filename }}">
	                    	@else
	                    		<img width="40" height="40" src="/images/user.jpg">
	                    	@endif
	                    @endauth
	                    @guest
		                <a href="https://app.perfectlyspoken.com/auth/login" class="btn btn-login">
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

		<div class="main-content">
			@yield('content')
		</div>

		<!-- Scripts -->

	    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
        <script src="{{ asset('js') }}/user_custom.js"></script>


    </body>
</html>