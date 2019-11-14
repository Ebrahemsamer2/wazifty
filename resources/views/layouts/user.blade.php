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

        <link rel="stylesheet" type="text/css" href="/css/footer.css">

        @yield('css')
      	
      	<style>
      		body .main-content {
      			padding-top: 50px;
      		}
      	</style>
    </head>
    <body class="{{ app()->getlocale() ? app()->getlocale() : 'en' }}">
    	
	    <header style="width: 100%;z-index:999;position:fixed;">
	        <div class="header">
		        <nav class="navbar navbar-light" id="navbarSupportedContent">
		            <div class="container">
		                <a class="navbar-brand mr-auto" href="/">
		                    <span class="logo"><span>W</span>AZIFTY</span>
		                </a>
		                <ul class="list-unstyled">
		                	<li class="{{ \Request::is('/') ? 'active':'' }}"><a href="/">Home</a></li>
		                	<li class="{{ \Request::is('jobs') ? 'active':'' }}"><a href="/jobs">Jobs</a></li>
		                	<li class=""><a href="/#how-it-works">How it works</a></li>
		                	<li class=""><a href="/#why-us">Why us</a></li>
		                	<li class="{{ \Request::is('contact') ? 'active':'' }}"><a href="/#contact">Contact</a></li>
		                	
		                </ul>
		                <span class="search-toggler" style="margin-right: 20px; cursor: pointer;">
		                    <i class="fas fa-search"></i>
		                    <div style="@guest {{'right: 184px;'}} @endguest" class="search-form">
		                    	<i class="fas fa-arrow-up"></i>
		                    	<form autocomplete="off" method="get" action="/jobs/search">
		                    		<input id="search" class="form-control" type="text" name="q" placeholder="Search jobs">
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
							    <a class="dropdown-item" href="<?php if(auth()->user()->emp_type =='employee') echo '/user';else echo '/company'; ?>/profile"><i class="fas fa-user-edit text-blue"></i> Edit profile</a>
							    @if(auth()->user()->emp_type == "employee")
							    <a class="dropdown-item" href="/user/{{ auth()->user()->id }}"><i class="fa fa-eye text-blue"></i> Preview profile</a>
							    @else
							    <a class="dropdown-item" href="/company/{{ auth()->user()->id }}"><i class="fa fa-eye text-blue"></i> Preview profile</a>
							    @endif


							    @if(auth()->user()->emp_type == "employee")
							    <a class="dropdown-item" href="/user/applications"><i class="fas fa-poll-h text-blue"></i> Applications</a>
							    <a class="dropdown-item" href="/user/saved-jobs"><i class="fas fa-briefcase text-blue"></i> Saved jobs</a>
							    @endif
							    @if(auth()->user()->emp_type == "employer")
							    <a class="dropdown-item" href="/company/jobs/applications"><i class="fas fa-poll-h text-blue"></i> Applications</a>

							    <a class="dropdown-item" href="/newjob"><i class="fas fa-briefcase text-blue"></i> New job</a>
							    
							    
							    @endif
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

		                @auth
		                @if(auth()->user()->emp_type == 'employer')
		                <a id="messagerLink" href="/user/{{auth()->user()->getFirstChat()}}/contact">
		                	<i id="<?php if(auth()->user()->checkUnReadMessages('nothing') == 1) echo 'messangerIcon' ; ?>" style="font-size: 25px; margin-left: 15px; color: #5e72e4;" class="fab fa-facebook-messenger"></i>
		                </a>
		                @else
		                <a id="messagerLink" href="/company/{{auth()->user()->getFirstChat()}}/contact">
		                	<i id="<?php if(auth()->user()->checkUnReadMessages('nothing') == 1) echo 'messangerIcon'; ?>" style="font-size: 25px; margin-left: 15px; color: #5e72e4;" class="fab fa-facebook-messenger"></i>
		                </a>
		                @endif
		                @endauth
		            </div>
		        </nav>
	    	</div>
		</header>

		@yield('main-header')

		<div class="main-content <?php if(\Request::is('/')) echo 'bg-white';else echo 'bg-grey'; ?> ">
		
			@yield('content')
		
		</div>


		<!-- Footer Starts Here -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="footer-item">
              <div class="footer-heading">
                <h2>About Us</h2>
              </div>
              <p>WAZIFTY is provided by Ebrahem for free of charge. Anyone can use this website for free you can find you job read useful articles.</p>
            </div>
          </div>
          
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="footer-item">
              <div class="footer-heading">
                <h2>Blog links</h2>
              </div>
              <ul class="footer-list">
                <li><a href="/blog">Home</a></li>
                <li><a href="/blog/aboutus">About us</a></li>
                <li><a href="/blog/services">Our services</a></li>
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
              </ul>
            </div>
          </div>
          
          
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="footer-item">
              <div class="footer-heading">
                <h2>WZIFTY Links</h2>
              </div>
              <ul class="footer-list">
                <li><a href="/jobs">Browse Jobs</a></li>
                <li><a href="/#how-it-works">How it works</a></li>
                <li><a href="/#why-us">Why us</a></li>
                <li><a href="/#what-users-say">What users say?</a></li>
                <li><a href="/#contact">Contact</a></li>
              </ul>
            </div>
          </div>
          
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="footer-item">
              <div class="footer-heading">
                <h2>More Information</h2>
              </div>
              <ul class="footer-list">
                <li>Phone: <a href="#">010-020-0560</a></li>
                <li>Email: <a href="#">mail@wazifty.com</a></li>
                <li>Support: <a href="#">support@wazifty.com</a></li>
                <li>Website: <a href="#">www.wazifty.com</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-12">
            <div class="sub-footer">
              <p>Copyright &copy; 2020 WAZIFTY Company
				- Designed by <a rel="nofollow" href="http://ebrahemsamer2.000webhostapp.com">Ebrahem Samer</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer Ends Here -->

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