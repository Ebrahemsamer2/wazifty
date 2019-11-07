
@extends("layouts.user")

@section('title', $job->slug . ' applications | WAZIFTY')

@section('css')

<!-- My Home Custom CSS ( Home )-->
<link type="text/css" href="/css/home_custom.css" rel="stylesheet">

<!-- My User profile Custom CSS ( edit user profile )-->
<link type="text/css" href="/css/jobapplications.css" rel="stylesheet">

@endsection


@section('content')


	<div class="container">
		
		<div class="job-applications">
			
			<div class="header">
				<h1>{{ $job->title }}</h1>
				<p>{{ $job->subtitle }}</p>
			
				<div class="related-info">
					<span class="date">{{ $job->created_at->diffForHumans() }}</span>
					<span class="{{ $job->active == 1 ? 'activated':'deactivated' }}">{{ $job->active == 1 ? 'activated':'Deactivated' }}</span>

					<span class="float-right {{ count($job->application->users) > 0 ? 'text-green':'text-grey' }}">{{ count($job->application->users) ? count($job->application->users) . ' employees applied' : 'No one has applied'}}</span>

				</div>
			</div>

			<div class="applications">
				
				<div class="row">
					@if(count($users_applications))
					@foreach($users_applications as $user)
					<div class="col-sm-3">
						
						<div class="application">

							<h2 class="username">{{ $user->name }}</h2>
							@if($user->userprofile->college)
							<h4>Graduated from: <span class="college">{{ $user->userprofile->college }}</span></h4>
							@else
							<span>Not defined</span>
							@endif
							@if($user->userprofile->graduation_year)
							<span class="graduation_year">{{ $user->userprofile->graduation_year }}</span><br>
							@endif
							<div class="actions">
								<a target="_black" href="/user/{{ $user->id }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Employee profile</a>
								<form method="POST" action="/company/{{$id}}/job/{{$job->slug}}/applications" id="rejectForm">

									<?php
									$class = ''; 
									$attr = ''; 
									$rejectValue = 'Reject'; 
									$acceptValue = 'Accept'; 

									$accepted = $user->applications()->where('application_id',$job->application->id)->first()->pivot->accepted;
									if( $accepted == -1) {
										$class = 'btn btn-secondary btn-sm';
										$attr = 'disabled';
										$rejectValue = 'Rejected';

										?>

										<img rel="icon" width="22" class="rejected-image rounded-circle" height="22" src="/icons/rejected.webp"/>

										<?php
									}else if($accepted == 1) {
										$attr = 'disabled';
										$acceptValue = 'Accepted';
									?>
										<img rel="icon" width="20" class="rounded-circle accepted-image" height="20" src="/icons/accepted.ico"/>
									<?php
									}
									?>
									@csrf
									@method('PATCH')
									@if($accepted >= 0)

									<a data-target="#contactModel" data-toggle="modal" <?php echo "{$attr}" ?> href="/user/{{$user->id}}/contact" class="btn btn-info btn-sm {$class}">Contact
									</a>

									@endif
									<input type="hidden" value="{{$user->id}}" name="user_id">
									<input type="hidden" value="{{$job->slug}}" name="slug">

									<input type="submit" value="{{$rejectValue}}" <?php echo "{$attr}" ?> id="rejectButton" class="btn btn-danger btn-sm {{$class}}" name="reject">

									<input type="submit" value="{{$acceptValue}}" <?php echo "{$attr}" ?> id="acceptButton" class="btn btn-success btn-sm {{$class}}" name="accept" />

								</form>
								<a style="font-size: 14px;" target="_blank" href="/user/{{ $user->id }}/contact">Conversation history</a>
							</div>
						</div>

					</div>
					@endforeach
					@else
						<p>No one applied yet.</p>
					@endif
				</div>

			</div>
		</div>
	</div>

@if($accepted >= 0)
	<!-- Modal -->
<div class="modal fade" id="contactModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{auth()->user()->name}} message: {{ $user->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div id="output"></div>
        <form id="messageForm" method="POST" action="{{ $_SERVER['PHP_SELF'] }}">
        	
        	@csrf
        	<input type="hidden" name="user_id" value="{{ $user->id }}">
        	<input type="hidden" name="company_id" value="{{ auth()->user()->id }}">
        	<input type="hidden" name="from" value="company">
        	<input type="hidden" name="read" value="0">
        	<textarea class="form-control" name="message" id="message" placeholder="You message"></textarea>

        	<button id="send" type="submit" class="btn btn-success btn-sm float-right">Send</button>
        	<a target="_blank" id="conversationLink" href="/user/{{ $user->id }}/contact" class="float-left">Conversation history</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endif

@endsection