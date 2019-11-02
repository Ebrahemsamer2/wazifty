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
				
				<div class="single-job">
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

					<div class="head bg-white">
						<div class="row">
							<div class="col-sm-8">
								<div class="head-title">
									<h1>{{ $job->title }}</h1>
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
						<div class="apply-btn">
							<div class="row">
								@auth
								@if(!  auth()->user()->applications()->where('id', $job->application->id)->exists()  )

								<div class="col-sm-4">
									@if(count($job->application->questions) == 0)	
									<form method="post" action="/jobs/{{$job->slug}}">
										@csrf
										<input <?php if(! auth()->user() || auth()->user()->emp_type == "employer") echo 'disabled'; ?> type="submit" name="apply" value="Apply" class="btn btn-primary <?php if(! auth()->user() || auth()->user()->emp_type == "employer") echo 'disabled-btn';?>" >
										
										<input type="hidden" value="{{$job->application->id}}" name="application_id">
									</form>
									@else
									<button data-toggle="modal" data-target="#questions-modal" <?php if(! auth()->user() || auth()->user()->emp_type == "employer" ) echo 'disabled'; ?> type="button" class="btn btn-primary <?php if(! auth()->user() || auth()->user()->emp_type == "employer" ) echo 'disabled-btn';?>">Apply</button>
									@endif
									@guest
									<span>Please <a href="/login">Login</a> to apply</span>
									@endguest
									@if(auth()->user()->emp_type == "employer")
									<span>Only users can apply</span>
									@endif
								</div>

								@else
								<div class="col-sm-8 mt-2">
									<span class="text-green">You've already applied to this job <a href="/">View application</a></span>
								</div>
								@endif
								@endauth

								@guest

								<div class="col-sm-4">
									@if(count($job->application->questions) == 0)	
									<form method="post" action="/jobs/{{$job->slug}}">
										@csrf
										<input <?php if(! auth()->user()) echo 'disabled'; ?> type="submit" name="apply" value="Apply" class="btn btn-primary <?php if(! auth()->user()) echo 'disabled-btn';?>" >
										
										<input type="hidden" value="{{$job->application->id}}" name="application_id">
									</form>
									@else
									<button data-toggle="modal" data-target="#questions-modal" <?php if(! auth()->user()) echo 'disabled'; ?> type="button" class="btn btn-primary <?php if(! auth()->user()) echo 'disabled-btn';?>">Apply</button>
									@endif
									@guest
									<span>Please <a href="/login">Login</a> to apply</span>
									@endguest
								</div>

								@endguest


								<div class="col-sm">
									<span class=" text-green float-right">{{ count($job->application->users) == 0 ? 'You will be the first applicant for this job' : count($job->application->users) . ' applied' }}</span>
								</div>
							</div>
						</div>
					</div>
						

					<div class="about bg-white">
                        <h4>About job</h4>

                        <div class="row">
                            <div class="col-sm-4">
                                <h5 class="text-center">Category</h5>
                                <h5 class="text-center">{{ Str::limit($job->category->name, 20) }}</h5>
                            </div>
                            <div class="col-sm-4">
                                <h5 class="text-center">Job type</h5>
                                <h5 class="text-center">{{ $job->job_type }}</h5>
                            </div>
                            <div class="col-sm-4">
                                <h5 class="text-center">Experience needed</h5>
                                <h5 class="text-center">{{ $job->exp_from }} - {{ $job->exp_to }} years</h5>
                            </div>
                            <div class="col-sm-4">
                                <h5 class="text-center">Job salary</h5>
                                <h5 class="text-center">{{ $job->salary }}</h5>
                            </div>
                            <div class="col-sm-4">
                                <h5 class="text-center">Work place</h5>
                                <h5 class="text-center">{{ $job->work_place }}</h5>
                            </div>

                        </div>

                    </div> 
						
					<div class="description bg-white">
						<h4>Job description</h4>
						<p>{{ $job->job_description }}</p>
					</div>

					<div class="responsibility bg-white">
						<h4>Responsibility</h4>
						@foreach(explode(',', $job->responsibility) as $res)
						<p> - {{ $res }}</p>
						@endforeach
					</div>
					
					<div class="requirements bg-white">
						<h4>Job requirements</h4>
						@foreach(explode(',', $job->requirements) as $requirement)
						<p> - {{ $requirement }}</p>
						@endforeach
					</div>
					<div class="skills bg-white">
						<h4>Skills needed</h4>
						@foreach(explode(',', $job->skills) as $skill)
						<p> - {{ $skill }}</p>
						@endforeach
					</div>

					<hr>
					<div class="actions bg-white">
						<form method="post" action="/jobs">
							<input <?php if(! auth()->user()) echo 'disabled'; ?> class="btn btn-info @guest {{ 'disabled-btn' }} @endguest" type="submit" value="Save" name="savejob">
						</form>
						@guest
						<span>Please <a href="/login">{{ __('Sign in') }}</a> to apply</span>
						@endguest
					</div>

				</div>
			</div>
			<div class="col-sm">
					
				<div class="about-company bg-white">
					<h3>About <a href="/"> {{ $job->user->name }}</a></h3>
					<hr>
					<div class="content">
						@if($job->user->companyprofile)
						<p>{{ $job->user->companyprofile->about }}</p>
						@else
						<p>Added by Admin</p>
						@endif
					</div>
				</div>

				<div class="related-jobs bg-white">
					<h3>Related jobs</h3>
					<hr>
					<div class="related">
						@foreach($related_jobs as $related_job)
						<div class="job">
							<div class="row">
								<div class="col-sm-9">
									<h4 class="title">
										<a href="/jobs/{{ $related_job->slug }}">{{ $related_job->title }}</a>
									</h4>
								</div>
								<div class="col-sm">
								@if($related_job->user->picture)
									<img width="50" height="50" src="/images/{{ $related_job->user->picture->filename }}" class="rounded-circle">
								@else
									<img width="50" height="50" src="/images/user.jpg" class="rounded-circle">
								@endif
								</div>
							</div>
							<div class="info">
								<span class="date">{{$related_job->created_at->diffForHumans()}}</span>
								<span class="apply {{ count($related_job->application->users) != 0 ? 'text-green' : 'text-gray' }}">
									{{ count($related_job->application->users) == 0 ? 'There are no applicants' : count($related_job->application->users) . ' applied'}} 
								</span>
							</div>
						</div>
						@endforeach
					</div>
				</div>

			</div>

		</div>
	</div>


<!-- Questions Modal -->
<div class="modal fade" id="questions-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please answer these questions </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="/jobs/{{ $job->slug }}">
      		@csrf

      		<?php $i=1; ?>
      		@foreach($job->application->questions as $question)
      		<div class="form-group">
      			<p class="question">{{ $question->title }}</p>
      			<input type="hidden" value="{{ $question->id }}" name="question{{$i}}">	
      			<input id="answer{{$i}}" type="text" name="answer{{$i}}" placeholder="Your answer" class="form-control">
      		</div>
      		<?php $i++; ?>
	      	@endforeach	

	      	<div class="float-right">
		      	<button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
	        	<button type="submit" class="btn btn-primary" name="saveanswers">Save answers</button>
        	</div>

      	</form>  
      </div>

    </div>
  </div>
</div>
@endsection