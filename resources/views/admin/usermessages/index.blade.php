@extends('layouts.app', ['title' => __('Messages Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Users Messages') }}</h3>
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
                    <div class="all-messages">

                    	<p style="margin-left: 25px;margin-bottom: 20px; font-size: 18px;color: #a2981f;" class=""><i class="far fa-bell"></i> Activated messages will be displayed at home page</p>

                        @if(count($messages))
                        <div class="row">
	                        @foreach($messages as $message)
	                        <div class="col-sm-3">
	                        	
	                            <div class="message text-center" id="{{ $message->id }}">
	                                
									<div class="card" style="max-width: 22rem;">
										<div class="top-section"></div>
										
							  			<img class="rounded-circle m-auto" width="70" height="70" src="/images/2.jpg" class="" alt="User picture">

								  		<div class="card-body text-center">
										    <h3 class="card-title">{{ $message->username }}</h3>
										    <h5 class="card-title">{{ $message->email }}</h5>
										    <hr>
										    <p class="card-text">{{ $message->message }}</p>
							  			</div>
							  			<div class="card-footer">
							  				<form method="POST" action="/admin/usermessages">
							  					@csrf
                                                @method("PATCH")

                                                <input type="hidden" value="{{ $message->id }}" name="message_id">

                                                @if($message->active == 0)
                                                <input type="hidden" name="active" value="1">
												<input type="submit" name="" value="Active" class="btn btn-success btn-sm float-right">
                                                @else
                                                <input type="hidden" name="active" value="0">
                                                <input type="submit" name="" value="Deactive" class="btn btn-warning btn-sm float-right">
                                                @endif
                                            </form>
                                            <form method="POST" action="/admin/usermessages">
                                                @csrf
                                                @method("DELETE")

                                                <input type="hidden" value="{{ $message->id }}" name="message_id">

												<input class="btn btn-danger btn-sm float-left" type="submit" name="delete" value="Delete">
											</form>
							  			</div>
									</div>

	                            </div>
	                        </div>
	                        @endforeach
                    	</div>
                        @else
                            <p class="text-muted text-center">No Messages to show</p>
                        @endif
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $messages->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection


