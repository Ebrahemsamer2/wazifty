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
						<div class="row">
							<div class="col-sm-6">
								<h1>Opportunities for you</h1>
							</div>
							<div class="col-sm">
										
								<div class="row">
									<div class="col-sm-6">
										<select class="form-control" name="category">
											<option value="">Job category</option>
											@foreach(\App\Category::pluck('name','id')->unique() as $id => $name)
												<option <?php if(isset($category) && $category->name == $name) echo 'selected'; ?> value="{{ $name }}">{{ $name }}</option>
											@endforeach
										</select>
									</div>
									<div class="col-sm-6">
										<select class="form-control" name="place">
											<option value="">Job place</option>
											@foreach(\App\Job::pluck('work_place')->unique() as $work_place)
												<option <?php if(isset($place) && $place == $work_place) echo 'selected'; ?> value="{{ $work_place }}">{{ $work_place }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						
					</div>

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
					@if(count($jobs))
					@foreach($jobs as $job)
					<div class="job bg-white">
						<div class="row">
							<div class="col-sm-8">
								<div class="head">
									<h2><a href="/jobs/{{$job->slug}}">{{ \Str::limit($job->title, 50) }}</a></h2>
									<h4>{{ \Str::limit($job->subtitle, 100) }}</h4>
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
							<p>{{ \Str::limit($job->job_description, 200) }}</p>
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
							<form method="post" action="/user/saved-jobs">
								@csrf
								<input type="hidden" value="{{ $job->id }}" name="job_id">
								@auth	
								@if(! auth()->user()->isSaved($job->id))
								<input <?php if(! auth()->user() || auth()->user()->emp_type == "employer") echo 'disabled'; ?> class="btn btn-info btn-sm <?php if(! auth()->user() || auth()->user()->emp_type == "employer") echo 'disabled-btn'; ?>" type="submit" value="Save" name="save">
								@else
								<input class="btn btn-secondary btn-sm" type="submit" value="Unsave" name="unsave">
								@endif
								@endauth
								@guest
								<input class="btn btn-info btn-sm" type="submit" value="Save" name="save">
								@endguest
								<a class="btn btn-warning btn-sm" href="/jobs/{{ $job->slug }}" target="_blank">Preview</a>
							</form>
						</div>
					</div>
					@endforeach
					@else
					<p>There're no jobs to show</p>
					@endif
				</div>
				<div class="pagination">
					{{ $jobs->links() }}
				</div>
			</div>
			<div class="col-sm">
				<div class="recent-cairo bg-white">
					<h2>Recent jobs at cairo <a href="/cairo-jobs">View all</a></h2>
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
					<h2>Recent jobs at alex <a href="/alexandria-jobs">View all</a></h2>
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