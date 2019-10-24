@extends('layouts.user')

@section('title', 'Home | WAZIFTY')


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
					<h1>WAZIFTY has a blog.</h1>
					<p>In this blog we share our experience, knowledge, experements and information about many things like technology, jobs, how to write your resume and many things, Follow us.</p>
				</div>
				<div class="col-sm">
					 <a href="/blog" class="btn btn-primary">Our blog</a>
				</div>
			</div>
		</div>


	<div class="container">
		<div class="text-center" id="people-say">
			<h1 >What users say?</h1>

			<div class="row">
				<div class="col-md-6 mb-4">
					
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

				<div class="col-md-6 mb-4">
					
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
			</div>

		</div>

	</div>

@endsection



