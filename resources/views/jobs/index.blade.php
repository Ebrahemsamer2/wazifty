@extends('layouts.user')

@section('title', 'Jobs | Find your job in easy way at WAZIFTY')

@section('content')
	
	<div class="container">	
		<div class="row">
			<div class="col-sm-8">
				
				<div class="all-jobs">
					
					<div class="jobs-heading">
						<h1>Opportunities for you</h1>
					</div>
					@foreach($jobs as $job)
					<div class="job">
						<div class="row">
							<div class="col-sm-8">
								<div class="head">
									<h2>{{ $job->title }}</h2>
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
						<hr>
						<div class="actions">
							<form method="post" action="/jobs">
								<input class="btn btn-info btn-sm" type="submit" value="Save" name="savejob">
								<a class="btn btn-warning btn-sm" href="/jobs/{{ $job->slug }}" target="_blank">Preview</a>
								<input value="Apply" type="submit" name="apply" class="btn btn-primary btn-sm float-right">
							</form>
						</div>
					</div>
					@endforeach
				</div>

			</div>
			<div class="col-sm">
				
			</div>
		</div>
	</div>
@endsection