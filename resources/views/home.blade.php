@extends('layouts.user')

@section('title', 'Home | Find your job in easy way at WAZIFTY')


@section('main-header')

	<div class="main-header">
		
		<div class="main-intro text-center">	
			<p>Find your job from home.</p>
			<p>Join many employees who have found their jobs here.</p>

			<a href="/jobs" class="btn btn-primary">Browse jobs</a>
			<a href="/register" class="btn btn-success">Start now</a>

			<p class="text-center">Join over 100,000 employees and employers in many different countries.</p>
		</div>

	</div>

@endsection

@section('content')

	<div class="container">
		
		<div id="how-it-works" class="text-center">
			<h1>How it works</h1>

			<div class="row">
				<div class="col-sm-4">
					<span>1</span>
					<h2>Good profile</h2>
					<p>Companies are usually looking for employees with good summaries and skills so, its really important to complete your profile.</p>
				</div>
				<div class="col-sm-4">
					<span>2</span>
					<h2>Your resume</h2>
					<p>Your resume is your best friend. companies will see your profile and also your resume, so make sure that you've worked on it correctly and upload it.</p>
				</div>
				<div class="col-sm-4">
					<span>3</span>
					<h2>ready to apply</h2>
					<p>Well done, after completing your profile and uploading your impresive resume go and find <a style="font-weight: bold;" href="/jobs">jobs</a> and get yours.</p>
				</div>

			</div>

		</div>


	</div>

		<div id="our-blog">
			<div class="row">
				<div class="col-sm-8">
					<h1>WAZIFTY has blog.</h1>
					<p>In this blog we share our experience, knowledge, experements and information about many things like technology, jobs, how to write your resume and many things, Follow us.</p>
				</div>
				<div class="col-sm">
					 <a href="/blog" class="btn btn-primary">OUR BLOG</a>
				</div>
			</div>
		</div>


	<div class="container">
		<div class="text-center" id="people-say">
			<h1 >What users say?</h1>
			
			<div class="row">
				@if(count($messages) != 2)
				<div id="c1" class="col-md-6 mb-4">
					<div class="card" style="max-width: 22rem;">
						<div class="top-section"></div>
			  			<img width="100" height="100" src="/images/user.jpg" class="" alt="User picture">
				  		<div class="card-body text-center">
						    <h3 class="card-title">Ahmed omar</h3>
						    <hr>
						    <p class="card-text">This is really great website.</p>
			  			</div>
					</div>

				</div>

				<div id="c2" class="col-md-6 mb-4">
					<div class="card" style="max-width: 22rem;">
						<div style="background:linear-gradient(40deg,#2096ff,#05ffa3)!important;" class="top-section"></div>
			  			<img width="100" height="100" src="/images/user.jpg" class="" alt="User picture">
				  		<div class="card-body text-center">
						    <h3 class="card-title">Esraa mohammed</h3>
						    <hr>
						    <p class="card-text">Thanks you I got my first interview from here.</p>
			  			</div>
					</div>
				</div>
				@else

				@foreach($messages as $message)

				<div id="c2" class="col-md-6 mb-4">
					<div class="card" style="max-width: 22rem;">
						<div style="background:linear-gradient(40deg,#2096ff,#05ffa3)!important;" class="top-section"></div>
						@if(\App\User::where('email', $message->email)->first()->picture)
							<?php $picture = \App\User::where('email', $message->email)->first()->picture;
							?>
							<img width="100" height="100" src="/images/{{ $picture->filename }}" class="dounded-circle" alt="User picture">
						@else
							<img width="100" height="100" src="/images/user.jpg" class="rounded-circle" alt="User picture">
						@endif
			  			<div class="card-body text-center">
						    <h3 class="card-title">{{$message->username}}</h3>
						    <hr>
						    <p class="card-text">{{$message->message}}</p>
			  			</div>
					</div>
				</div>
				@endforeach

				@endif
			</div>

		</div>



		<div id="features" class="text-center">
			<h1>Get your dream job in the easiest way</h1>

			<div class="row">
				
				<div class="col-sm-6 text-left">
					
					<div class="row">
						
						<div class="col-sm-2">
							<i class="fas fa-money-check-alt"></i>
						</div>

						<div class="col-sm">
							<h2>No paid plans</h2>
							<p>WAZIFTY will always be free, no credit-card information is required before or after registeration.</p>
						</div>
					</div>

				</div>

				<div class="col-sm-6 text-left">
					
					<div class="row">
						
						<div class="col-sm-2">
							<i class="fas fa-tachometer-alt"></i>
						</div>

						<div class="col-sm">
							<h2>Fast & flexible</h2>
							<p>WAZIFTY is simple and has many features including the speed of the site and the flexiblity.</p>
						</div>
					</div>

				</div>

				<div class="col-sm-6 text-left">
					
					<div class="row">
						
						<div class="col-sm-2">
							<i class="fas fa-comments"></i>
						</div>

						<div class="col-sm">
							<h2>Easy communication</h2>
							<p>As soon as you apply to any company's job,this company will be able to communicate with you through simple chat system.</p>
						</div>
					</div>

				</div>

				<div class="col-sm-6 text-left">
					
					<div class="row">
						
						<div class="col-sm-2">
							<i class="fas fa-mobile-alt"></i>
							<i class="fas fa-tablet"></i>
						</div>

						<div class="col-sm">
							<h2>Responsive</h2>
							<p>WAZIFTY is a responsive website which means you will able to use it on phone or tablet as on laptop.</p>
						</div>
					</div>

				</div>

			</div>

		</div>


		<div id="contact" class="text-center">
			<h1>Share your experience with us.</h1>

			<div class="row">
				<div class="col-sm-8 offset-sm-2">
					
					<div class="contact-form">
						
						<form id="contactForm" autocomplete="off" method="post" action="/">
							
							<span id="form_output"></span>
							@auth
							<input type="hidden" name="username" value="{{ auth()->user()->name }}">
							@endauth
							<div class="form-group">
								<input id="email" placeholder="Your email..." value="@auth {{ auth()->user()->email }} @endauth" type="email" name="email" class="form-control" required>
								<p class="home-email-input js-error">Email is not valid</p>

								@if($errors->has('email'))
									<div class="alert alert-danger">
										{{ $errors->first('email') }}
									</div>
								@endif

							</div>
							<div class="form-group">
								<textarea rows="4" id="message" placeholder="Tell us why you like this website..." name="message" class="form-control" required></textarea>
								<p class="home-message-input js-error">You message must be between 10 - 500 characters.</p>

								@if($errors->has('message'))
									<div class="alert alert-danger">
										{{ $errors->first('message') }}
									</div>
								@endif

							</div>

							<input type="submit" class="btn btn-primary float-right" value="Send">

						</form>

					</div>
				</div>

			</div>
		</div>
	</div>

@endsection



