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
	                                
									<div class="card text-white bg-primary mb-3">  
									  	<div class="card-body">
									    	<h6 class="card-title text-white"><a href="/admin/users/{{ $application->user->id }}/edit"><strong class="text-dark">{{ $application->user->name }}</strong></a><br>has applied to<br><a href="/admin/jobs/{{ $application->job->id }}/edit"><strong class="text-dark">{{ Str::limit($application->job->title,50) }}</strong></a> job</h6>
									    	<p class="card-text">
									    		<strong class=" <?php if($application->seen) echo 'text-green';else echo 'text-grey'; ?>" >
									    				Seen
									    		</strong><br>
									    		<strong class=" <?php if($application->contact) echo 'text-green';else echo 'text-grey'; ?>" >
									    				Contact
									    		</strong><br>
									    		<strong class=" <?php if($application->accepted == 1) echo 'text-green';else if($application->accepted == -1) echo 'text-danger'; else echo 'text-grey'; ?>" >
									    				@if($application->accepted == -1)
									    					Rejected
									    				@else
									    					Accepted
									    				@endif
									    		</strong>
									    	</p>
									    	<p class="application-time">{{ $application->created_at->diffForHumans() }}</p>
										  	<div class="card-footer bg-transparent border-light">
										  		<form method="POST">
										  			@csrf
										  			@method('DELETE')
										  			<a class="btn btn-info btn-sm" href="/admin/applications/{{ $application->id }}/edit">Edit</a>
										  			<input type="submit" value="Delete" name="submit" class="btn btn-danger btn-sm">
										  		</form>
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