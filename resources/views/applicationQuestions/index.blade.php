@extends("layouts.user")

@section('title', 'Company Jobs Applications | WAZIFTY')

@section('css')

<!-- My Home Custom CSS ( Home )-->
<link type="text/css" href="/css/home_custom.css" rel="stylesheet">

<!-- My User profile Custom CSS ( edit user profile )-->
<link type="text/css" href="/css/admin_custom.css" rel="stylesheet">

@endsection


@section('content')

    <div class="container">
    	<!-- All Job Content -->
        <div class="all-applications">
            <div class="heading ml-2" style="margin-bottom: 50px;">
                <h1>You applications</h1>
                <span style="margin-left: 10px;">Note: Every application is related to a specific job, to add more question to any of your jobs click the show button.</span>
            </div>
            <div class="row">
            @foreach($applications as $application)
            	<div class="col-lg-3 col-md-6">
            		
                    <div class="application" id="{{ $application->id }}">
                        
    					<div class="card text-white mb-3">  
    					  	<div class="card-body ">
    					    	<h6 class="card-title text-white"><a href="/jobs/{{ $application->job->slug }}"><strong class="text-dark">{{ $application->job->title }}</strong></a></h6>
    					    	<h6 class="card-subtitle mb-2 text-muted">
    					    		{{ count($application->questions) }} question related to application
    					    	</h6>
    					    	<p class="application-time">{{ $application->created_at->diffForHumans() }} <span style="margin-left: 15px; font-weight: bold;" class="{{ $application->job->active == 1 ? 'text-success': 'text-warning' }}">{{ $application->job->active == 1 ? 'Activated job': 'Deactivated job' }}</span></p>
    						  	<div class="card-footer bg-transparent border-success">
    						  	<a class="btn btn-info btn-sm" href="/company/jobs/applications/{{ $application->id }}">Show</a>
                                <a class="btn btn-primary btn-sm"  target="_blank" href="/company/{{auth()->user()->id}}/job/{{$application->job->slug}}/applications"> Applicants </a>
    						  	</div>
    					  	</div>
    					</div>

                    </div>
           		</div>
            @endforeach
        	</div>
        </div>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                {{ $applications->links() }}
            </nav>
        </div>
    </div>
@endsection