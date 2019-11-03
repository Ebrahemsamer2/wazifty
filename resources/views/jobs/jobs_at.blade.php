@extends('layouts.user')

@isset($place)
	@isset($category)
		@section('title', $category->name .' Jobs at ' . $place .' | Find your job in easy way at WAZIFTY')
	@endisset
@endisset

@isset($place)
	@section('title', 'Jobs at ' . $place .' | Find your job in easy way at WAZIFTY')
@endisset

@isset($category)
	@section('title', $category->name . ' Jobs | Find your job in easy way at WAZIFTY')
@endisset

@section('css')

<!-- My Home Custom CSS ( Home )-->
<link type="text/css" href="/css/home_custom.css" rel="stylesheet">

<!-- My User Custom CSS ( Jobs )-->
<link type="text/css" href="/css/jobs_custom.css" rel="stylesheet">

@endsection

@section('content')
	
	<div class="container">	
		<div class="row">
			<div class="col-sm-12 jobs">
				
				<div class="all-jobs">
					
					<div class="jobs-heading">
						<div class="row">
							<div class="col-sm-6">
								@if(isset($place))
									@if(isset($category))
									<h1>{{ $category->name }} Jobs available in {{$place}}</h1>
									@else
									<h1>Jobs available in {{$place}}</h1>
									@endif
								@else
									@if(isset($category))
									<h1>{{ $category->name }} Jobs available </h1>
									@endif	
								@endif

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
							<form method="post" action="/user/saved-jobs">
								@csrf
								<input type="hidden" value="{{ $job->id }}" name="job_id">
								@auth	
								@if(! auth()->user()->isSaved($job->id))
								<input class="btn btn-info btn-sm" type="submit" value="Save" name="save">
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
					<div class="alert text-center">
						<p style="font-size: 20px;">No jobs found at this city</p>
					</div>
					@endif
				</div>
				<div class="pagination">
					{{ $jobs->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection