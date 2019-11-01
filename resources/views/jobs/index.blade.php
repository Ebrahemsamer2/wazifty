@extends('layouts.user')

@section('title', 'Jobs | Find your job in easy way at WAZIFTY')

@section('css')

<!-- My Home Custom CSS ( Home )-->
<link type="text/css" href="/css/home_custom.css" rel="stylesheet">

<!-- My User Custom CSS ( Jobs )-->
<link type="text/css" href="/css/jobs_custom.css" rel="stylesheet">

@endsection

@section('content')
	
	<div class="container">	
		<div class="row">
			<div class="col-sm-8 jobs">
				
				<div class="all-jobs">
					
					<div class="jobs-heading">
						<h1>Opportunities for you</h1>
					</div>
					@foreach($jobs as $job)
					<div class="job bg-white">
						<div class="row">
							<div class="col-sm-8">
								<div class="head">
									<h2><a href="/jobs/{{$job->slug}}">{{ $job->title }}</a></h2>
									<h4>{{ $job->subtitle }}</h4>
								</div>
							</div>
							<div class="col-sm">
								@if($job->user->picture)
									<img width="80" height="80" src="/images/{{ $job->user->picture->filename }}" class="rounded-circle ml-6">
								@else
									<img width="80" height="80" src="/images/user.jpg" class="rounded-circle ml-6">
								@endif
							</div>
						</div>
						<hr>
						<div class="content">
							<p>{{ $job->job_description }}</p>
						</div>
						<div class="info">
							<span>{{ $job->created_at->diffForHumans() }}</span>
							<span class="{{ $job->active ? 'activated' : 'deactivated' }}">
								@if($job->active)
								Activated
								@else
								Deactivated
								@endif
							</span>
						</div>
						<hr>
						<div class="actions">
							<form method="post" action="/jobs">
								<input class="btn btn-info btn-sm" type="submit" value="Save" name="savejob">
								<a class="btn btn-warning btn-sm" href="/jobs/{{ $job->slug }}" target="_blank">Preview</a>
							</form>
						</div>
					</div>
					@endforeach
				</div>
				<div class="pagination">
					{{ $jobs->links() }}
				</div>
			</div>
			<div class="col-sm">
				<div class="recent-cairo bg-white">
					<h2>Recent jobs at cairo <a href="/jobs/cairo">View all</a></h2>
					<hr>
					@foreach($cairo_jobs as $job)
						<div class="job">
							<h4 class="title">
								<a href="/jobs/{{ $job->slug }}">{{ $job->title }}</a>
							</h4>
							<span class="date">{{$job->created_at->diffForHumans()}}</span>
							<span class="apply text-green">{{count($job->application->users)}} applied</span>
						</div>
					@endforeach
				</div>

				<div class="recent-alex bg-white">
					<h2>Recent jobs at alex <a href="/jobs/alex">View all</a></h2>
					<hr>
					@foreach($alex_jobs as $job)
						<div class="job">
							<h4 class="title">
								<a href="/jobs/{{ $job->slug }}">{{ $job->title }}</a>
							</h4>
							<span class="date">{{$job->created_at->diffForHumans()}}</span>
							<span class="apply text-green">{{count($job->application->users)}} applied</span>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection