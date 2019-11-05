@extends('layouts.user')

@section('title', $user->name . ' applications | WAZIFTY')

@section('css')

<!-- My Home Custom CSS ( Home )-->
<link type="text/css" href="/css/home_custom.css" rel="stylesheet">

<!-- My User profile Custom CSS ( edit user profile )-->
<link type="text/css" href="/css/userapplications.css" rel="stylesheet">

@endsection

@section('content')

	
	<div class="container">
		
		<div class="all-applications">

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

			<div class="heading">
			 	<h1> Your applications</h1>
			 	<span>Only applications that are not seen can be updated.</span>
		 	</div>
			<div class="row">
				<?php $i = 0; ?>
				@foreach($applications as $application)
				<div class="col-sm-3">
					<div class="application">
						
					<h2>{{ $application->job->title }}</h2>
					<span>{{ \Carbon\Carbon::parse($application->pivot->created_at)->diffForHumans() }}</span>
					<ul>
						<li class=" {{ $application->pivot->seen ? 'text-green':''}}">Seen</li>
						<li class=" {{ $application->pivot->contact ? 'text-green':''}}">Contact</li>
						<li class="@if($application->pivot->accepted) {{ 'text-green' }}@endif  @if($application->pivot->accepted == -1){{ 'text-danger'}} @endif"> @if($application->pivot->accepted >= 0 ){{ 'Accepted' }} @endif @if($application->pivot->accepted == -1 ){{ 'Rejected' }} @endif</li>
					</ul>	

					@if(count($application->questions))

						<button <?php if( $application->pivot->seen ) echo 'disabled'; ?> data-toggle="modal" data-target="#update_answers{{$i}}" class="btn btn-info <?php if( $application->pivot->seen ) echo 'disabled-btn'; ?>">Update answers</button>
					@else

						<p><i class="fas fa-info-circle text-blue"></i> No questions related to this application</p>

					@endif
					</div>
				</div>






@if(! $application->pivot->seen)
<!-- Questions Modal -->
<div class="modal fade" id="update_answers{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update your answers</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form autocomplete="off" method="post" action="/user/applications">
      		@csrf
      		@method('PATCH')

      		<?php $j=1; ?>

      		@foreach($application->questions as $question)
      		<div class="form-group">
      			<p class="question">{{ $question->title }}</p>
      			<input type="hidden" value="{{ count($application->questions) }}" name="questions_number">	
      			<input type="hidden" value="{{ $question->id }}" name="question{{$j}}">	
      			
      			<?php 
      				$answer = \App\Answer::where('user_id', $user->id)->where('question_id', $question->id)->first();
      			?>
      			<input type="hidden" name="answer_id{{$j}}" value="{{ $answer->id }}">
      			<input value="{{ $answer->the_answer }}" id="answer{{$j}}" type="text" name="answer{{$j}}" placeholder="Your answer" class="form-control">
      		</div>
      		<?php $j++; ?>
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
@endif

<?php
// counting modals  
$i++;
?>



				@endforeach
			</div>

		</div>

	</div>

@endsection