@extends('layouts.user')

@section('title', $user->name . ' profile | WAZIFTY')

@section('css')

<!-- My Home Custom CSS ( Home )-->
<link type="text/css" href="/css/home_custom.css" rel="stylesheet">

<!-- My User profile Custom CSS ( edit user profile )-->
<link type="text/css" href="/css/userprofile.css" rel="stylesheet">

@endsection

@section('content')

<div id="cv" class="instaFade">
	<div class="mainDetails">
		<div id="headshot" class="quickFade">
			@if($user->picture)
			<img width="150" height="150" class="rounded-circle" src="/images/{{$user->picture->filename}}" alt="{{$user->name}}" />
			@else
			<img width="150" height="150" class="rounded-circle" src="/images/user.jpg" alt="{{$user->name}}" />
			@endif
		</div>
		
		<div id="name">
			<h1 class="quickFade delayTwo">{{ $user->name }}</h1>
			<h2 class="quickFade delayThree">{{ $user->userprofile->job_title ? $user->userprofile->job_title : 'Not defined' }} </h2>
		</div>
		
		<div id="contactDetails" class="quickFade delayFour">
			<ul>
				<li><i class="fas fa-envelope text-blue"></i><a href="mailto:{{$user->email}}" target="_blank"> {{ $user->email }}</a></li>
				<li><i class="far fa-address-card text-blue"></i> {{ $user->userprofile->address }}</li>
				<li><i class="fab fa-linkedin text-blue"></i> <a href="{{$user->userprofile->linkedin}}"> {{ Str::limit($user->userprofile->linkedin, 30) }}</a></li>
				<li><i class="fas fa-link text-blue"></i> <a href="{{$user->userprofile->portfolio}}"> {{ Str::limit($user->userprofile->portfolio, 30) }}</a></li>
				<li><i class="fas fa-mobile-alt text-blue"></i> {{ $user->userprofile->phone ? $user->userprofile->phone : 'Not defined' }}</li>

			</ul>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="mainArea" class="quickFade delayFive">
		<section>
			<article>
				<div class="sectionTitle">
					<h1>Summary</h1>
				</div>
				
				<div class="sectionContent">
					<p>{{ $user->userprofile->summary ? $user->userprofile->summary : 'Not defined' }}</p>
				</div>
			</article>
			<div class="clear"></div>
		</section>
		
		<section>
			<div class="sectionTitle">
				<h1>Education</h1>
			</div>
			
			<div class="sectionContent">
				<article>
					@if($user->userprofile->college)
					<h2>{{$user->userprofile->college}}</h2>
					<p class="subDetails">{{ $user->userprofile->graduation_date }}</p>
					<p>{{ $user->userprofile->degree }}</p>
					@else
					<p>Not defined</p>
					@endif
				</article>
			</div>
			<div class="clear"></div>
		</section>

		<section>
			<div class="sectionTitle">
				<h1>Skills</h1>
			</div>
			
			<div class="sectionContent">
				@if($user->userprofile->skills)
				<ul class="keySkills">
					@foreach(explode(',',$user->userprofile->skills) as $skill)
					<li>{{ $skill }}</li>
					@endforeach
				</ul>
				@else
				<p>Not defined</p>
				@endif
			</div>
			<div class="clear"></div>
		</section>
		
	</div>

</div>
	
	@if($user->resume)

	<form method="get" action="/resume/{{ $user->resume->filename }}" style="margin: 10px 0 50px 0;" class="user-resume">
		<input  type="submit" style="margin-left: 120px;" class="btn btn-info" value="User resume" /> 
	</div>

	@endif
@endsection

@section('scripts')

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3753241-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>


@endsection