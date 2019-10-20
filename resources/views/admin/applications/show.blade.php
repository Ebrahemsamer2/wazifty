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
								  	<div class="card-footer border-success">
								  		<a id="addQuestionButton" data-toggle="modal" data-target="#questions" class="{{  count($application->questions) == 5 ? 'disabled' : '' }} btn btn-primary btn-sm" href="/admin/applications/{{ $application->id }}/questions">Add question
                                        </a>
                                        @if(count($application->questions) == 5)
                                            <p class="text-muted">You reached to the limit of questions</p>
                                        @endif
                                        <!-- Modal -->
                                        <div class="modal fade" id="questions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Application questions</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <form id="questionsForm" autocomplete="off" method="post" action="{{ route('admin.applications.create', $application->id) }}">
                                                    @csrf
                                                    <?php $i = count($application->questions); ?>
                                                    @while( $i < 5)
                                                    <?php $i++; ?>
                                                    <div class="form-group">
                                                        <input id="question{{$i}}" placeholder="Question {{$i}}" type="text" class="form-control">
                                                        <p class="question-error{{$i}} js-error">Question must be specific and between 20 - 200 characters.</p>
                                                    </div>
                                                    @endwhile
                                                </form>
                                              </div>
                                              <div class="modal-footer">
                                                <button name="close" data-dismiss='modal' type="submit" class="btn btn-secondary">Close</button>
                                                <button id="questionsFormButton" name="add" type="submit" class="btn btn-primary" >Yes</a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

								  	</div>
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