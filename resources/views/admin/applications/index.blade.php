@extends('layouts.app', ['title' => 'Applications Management'])

@section('content')
	@include('layouts.headers.cards')


	<div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Applications') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- All Job Content -->
                    <div class="all-applications">
                        <div class="row">
                        	
                        @foreach($applications as $application)
                        	<div class="col-sm-3">
                        		
	                            <div class="application" id="{{ $application->id }}">
	                                
									<div class="card text-white mb-3">  
									  	<div class="card-body ">
									    	<h6 class="card-title text-white"><a href="/admin/jobs/{{ $application->job->id }}"><strong class="text-dark">{{ $application->job->title }}</strong></a></h6>
									    	<h6 class="card-subtitle mb-2 text-muted">
									    		{{ count($application->questions) }} question related to application
									    	</h6>
									    	<p class="application-time">{{ $application->created_at->diffForHumans() }} <span style="margin-left: 15px; font-weight: bold;" class="{{ $application->job->active == 1 ? 'text-success': 'text-warning' }}">{{ $application->job->active == 1 ? 'Activated job': 'Deactivated job' }}</span></p>
										  	<div class="card-footer bg-transparent border-success">
										  	<a class="btn btn-info btn-sm" href="/admin/applications/{{ $application->id }}">Show</a>
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
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection