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
                                <h3 class="mb-0">{{ __('Application') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                
                            </div>
                        </div>
                    </div>

                    <!-- All Application Content -->
                    <div class="all-applications">
                        		
                        <div class="application" id="{{ $application->id }}">
                            
							<div class="card text-white mb-3">  
							  	<div class="card-body ">
							    	<h4 class="card-title text-white"><a href="/admin/jobs/{{ $application->job->id }}"><strong class="text-dark">{{ $application->job->title }}</strong></a></h4>

                                    @if(count($application->questions))
							    	<h5 class="card-subtitle mb-2 text-muted">
                                        <?php $i= 1; ?>
                                        Application Questions <br> 
                                    </h5>  
                                    <div class="application-questions border-success">  
                                        @foreach($application->questions as $question)
                                        <strong class="text-dark">Question <?php echo $i;$i++; ?></strong>
                                        <p style="margin-left: 10px;" class="text-dark">{{ $question->title }}</p>
                                        @endforeach               
                                    </div>
                                    @else
                                        <p class="text-dark text-muted">No question at this application</p>@endif 
							    	<p class="application-time">{{ $application->created_at->diffForHumans() }} <span style="margin-left: 15px; font-weight: bold;" class="{{ $application->job->active == 1 ? 'text-success': 'text-warning' }}">{{ $application->job->active == 1 ? 'Activated job': 'Deactivated job' }}</span></p>
								  	<!-- <div class="card-footer bg-transparent border-success">
								  		<form method="POST" action="/admin/applications/{{ $application->id }}">
								  			@csrf
								  			@method('DELETE')
								  			<input type="submit" value="Delete" name="submit" class="btn btn-danger btn-sm">
								  		</form>
								  	</div> -->
							  	</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection