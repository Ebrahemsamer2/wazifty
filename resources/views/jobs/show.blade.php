@extends('layouts.user')

@section('title', 'Jobs | Find your job in easy way at WAZIFTY')

@section('content')
	
	<div class="container">	
		<div class="row">
			<div class="col-sm-8 jobs">
				
				<div class="single-job">
					<div class="head">
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
								<div class="col-sm-4">
									<button type="button" class="btn btn-primary">Apply</button>
								</div>
								<div class="col-sm">
									<span class=" text-green float-right">{{ count($job->application->users) == 0 ? 'You will be the first applicant for this job' : count($job->application->users) . ' applied' }}</span>
								</div>
							</div>
						</div>
					</div>
						

					<div class="about">
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
						
					<div class="description">
						<h4>Job description</h4>
						<p>{{ $job->job_description }}</p>
					</div>

					<div class="responsibility">
						<h4>Responsibility</h4>
						@foreach(explode(',', $job->responsibility) as $res)
						<p> - {{ $res }}</p>
						@endforeach
					</div>
					
					<div class="requirements">
						<h4>Job requirements</h4>
						@foreach(explode(',', $job->requirements) as $requirement)
						<p> - {{ $requirement }}</p>
						@endforeach
					</div>
					<div class="skills">
						<h4>Skills needed</h4>
						@foreach(explode(',', $job->skills) as $skill)
						<p> - {{ $skill }}</p>
						@endforeach
					</div>

					<hr>
					<div class="actions">
						<form method="post" action="/jobs">
							<input class="btn btn-info" type="submit" value="Save" name="savejob">
						</form>
					</div>

				</div>
			</div>
			<div class="col-sm">
					
				<div class="about-company">
					<h3>About <a href="/"> {{ $job->user->name }}</a></h3>
					<hr>
					<div class="content">
						@if($job->user->companyprofile)
						<p>{{ $job->user->companyprofile->about }}</p>
						@elseif($job->user->userprofile)
						<p>Added by Admin</p>
						@endif
					</div>
				</div>

				<div class="related-jobs">
					<h3>Related jobs</h3>
					<hr>
					<div class="related">
						@foreach($related_jobs as $job)
						<div class="job">
							<div class="row">
								<div class="col-sm-9">
									<h4 class="title">
										<a href="/jobs/{{ $job->slug }}">{{ $job->title }}</a>
									</h4>
								</div>
								<div class="col-sm">
								@if($job->user->picture)
									<img width="40" height="40" src="/images/{{ $job->user->picture->filename }}" class="rounded-circle">
								@else
									<img width="40" height="40" src="/images/user.jpg" class="rounded-circle">
								@endif
								</div>
							</div>
							
							<span class="date">{{$job->created_at->diffForHumans()}}</span>
							<span class="apply text-green">{{count($job->application->users)}} applied</span>
						</div>
						@endforeach
					</div>
				</div>

			</div>

		</div>
	</div>
@endsection