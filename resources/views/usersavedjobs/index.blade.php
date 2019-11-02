@extends('layouts.user')

@section('title', $user->name . ' saved jobs | WAZIFTY')

@section('css')

<!-- My Home Custom CSS ( Home )-->
<link type="text/css" href="/css/home_custom.css" rel="stylesheet">

<!-- My User Saved jobs Custom CSS ( user saved jobs )-->
<link type="text/css" href="/css/usersavedjobs.css" rel="stylesheet">

@endsection

@section('content')

	
	<div class="container">
		
		<div class="all-saved-jobs">

			@if($errors->any())
				@foreach($errors->all() as $error)
				<div class="alert alert-danger">
					{{ $error }}
				</div>
				@endforeach
			@endif

			@if(\Session::get('status'))
			<div class="alert alert-success">
				{{ \Session::get('status') }}
			</div>
			@endif

			<div class="heading">
			 	<h1> Your saved jobs</h1>
		 	</div>
			<div class="row">
				@if(count($saved_jobs))

				@foreach($saved_jobs as $job)
					<div class="col-sm-6">
					 		
						<div class="job bg-white">
							<div class="row">
								<div class="col-sm-7">
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
								<span class="{{ $job->active ? 'text-green' : 'text-danger' }}">
									@if($job->active)
									Activated
									@else
									Deactivated
									@endif
								</span>
							</div>
							<hr>
							<div class="actions">
								<form method="post" action="/user/saved-jobs">
									@csrf
									<input type="hidden" value="{{ $job->id }}" name="job_id">
									@if(! auth()->user()->isSaved($job->id))
									<input class="btn btn-info btn-sm" type="submit" value="Save" name="save">
									@else
									<input class="btn btn-secondary btn-sm" type="submit" value="Unsave" name="unsave">
									@endif
									<a class="btn btn-warning btn-sm" href="/jobs/{{ $job->slug }}" target="_blank">Preview</a>
								</form>
							</div>
						</div>
					</div>
					@endforeach
					@endif
			</div>
		</div>
	</div>
@endsection