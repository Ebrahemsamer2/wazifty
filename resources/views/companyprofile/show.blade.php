@extends("layouts.user")

@section('title', $company->name . ' profile | WAZIFTY')

@section('css')

<!-- My Home Custom CSS ( Home )-->
<link type="text/css" href="/css/home_custom.css" rel="stylesheet">

<!-- My User profile Custom CSS ( edit user profile )-->
<link type="text/css" href="/css/companyprofile.css" rel="stylesheet">

@endsection


@section('content')

	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				
				<div class="header">
					<div class="row">
						<div class="col-sm-3">
							<div class="company-picture">
								@if($company->picture)
								<img src="/images/{{ $company->picture->filename }}" width="150" height="129">
								@else
								<img src="/images/user.jpg" width="150" height="129">
								@endif
							</div>
						</div>

						<div class="col-sm">
							
							<div class="company-info">
								
								<h2>{{ $company->name }}</h2>
								<p class="spec">Specialization</p>
								<p>{{ $company->companyprofile->address }}</p>
							</div>

						</div>
					</div>
				</div>
					
				<div class="about">
					<h2>About the Company</h2>
					<p>{{ $company->companyprofile->about }}</p>
				</div>
				
			</div>
			<div class="col-sm" style="margin-left: -15px;">
				<div class="company-links">
					<h3>Company contacts</h3>
					<ul class="list-unstyled">
						<li><i class="fas fa-map-marker-alt"></i>
							@if($company->companyprofile->address)
								<a> {{ Str::limit($company->companyprofile->address,35) }}</a>
								@else
								<span>Not defined</span>
							@endif
						</li>
						<li><i class="fas fa-globe-americas"></i>
							@if($company->companyprofile->website)
								<a href="{{ $company->companyprofile->website }}"> {{ Str::limit($company->companyprofile->website, 35) }}</a>
								@else
								<span>Not defined</span>
							@endif
						</li>

						<li><i class="fab fa-linkedin-in"></i>
							@if($company->companyprofile->linkedin)
								<a href="{{ $company->companyprofile->linkedin }}"> {{ Str::limit($company->companyprofile->linkedin, 35) }}</a>
								@else
								<span>Not defined</span>
							@endif
						</li>

						<li><i class="fab fa-facebook-square"></i>
							@if($company->companyprofile->facebook)
								<a href="{{ $company->companyprofile->facebook }}"> {{ Str::limit($company->companyprofile->facebook, 35) }}</a>
								@else
								<span>Not defined</span>
							@endif
						</li>

						<li><i class="fas fa-briefcase"></i>
							@if($company->companyprofile->portfolio)
								<a href="{{ $company->companyprofile->portfolio }}"> {{ Str::limit($company->companyprofile->portfolio, 35) }}</a>
								@else
								<span>Not defined</span>
							@endif
						</li>

						<li><i class="fab fa-github-square"></i>
							@if($company->companyprofile->github)
								<a href="{{ $company->companyprofile->github }}"> {{ Str::limit($company->companyprofile->github, 35) }}</a>
								@else
								<span>Not defined</span>
							@endif
						</li>

						<li><i class="fas fa-mobile-alt"></i>
							@if($company->companyprofile->phone)
								<a> {{ Str::limit($company->companyprofile->phone, 35) }}</a>
								@else
								<span>Not defined</span>
							@endif
						</li>
					</ul>

				</div>
			</div>
		</div>

					<div class="row">
						<div class="col-sm-8">
							
						<div class="company-jobs">
						<h2>{{ $company->name }} vacancies</h2>
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
									@if($job->active == 1)
									@if(count($job->application->users))
									<span class="float-right text-green mr-6">
										{{ count($job->application->users) . ' applied'}}
									</span>
									@else
									<span class="float-right text-default mr-6">
										No one applied yet
									</span>
									@endif
									@endif
								</div>
								<hr>
								<div class="actions">
									<form method="post" action="/user/saved-jobs">
										@csrf
										<input type="hidden" value="{{ $job->id }}" name="job_id">
										
										<input <?php if(! auth()->user() || auth()->user()->emp_type == "employer") echo 'disabled'; ?> class="btn btn-info btn-sm <?php if(! auth()->user() || auth()->user()->emp_type == "employer") echo 'disabled-btn';?>" type="submit" value="Save" name="save">

										<a class="btn btn-warning btn-sm" href="/jobs/{{ $job->slug }}" target="_blank">Preview</a>
									</form>
								</div>
							</div><hr>
							@endforeach
							@else
							<p class="text-center no-jobs">No vacancies available</p>
							@endif

							</div>	

						</div>
					</div>

	</div>

@endsection