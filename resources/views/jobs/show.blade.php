@extends('layouts.user')

@section('title', 'Jobs | Find your job in easy way at WAZIFTY')

@section('content')
	
	<div class="container">	
		<div class="row">
			<div class="col-sm-8">
				
				<div class="all-jobs">
					
					<div class="jobs-heading">
						<div class="row">
							<h1>Opportunities for you</h1>
						</div>
					</div>
					@foreach($jobs as $job)
					<div class="job">
						<div class="row">
							<div class="col-sm-8">
								<div class="head">
									<h2>{{ $job->title }}</h2>
									<h4>{{ $job->subtitle }}</h4>
								</div>

								<div class="content">
									<p>{{ $job->job_description }}</p>
								</div>

								<div class="actions">
									<form method="post" action="/jobs">
										<input type="submit" value="Save" name="savejob">
										<a href="/jobs/{{ $job->slug }}" target="_blank">Preview</a>
									</form>
								</div>
							</div>
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