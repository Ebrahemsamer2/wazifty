@extends('layouts.user')

@section('title', $user->name . ' profile | WAZIFTY')

@section('content')

	<div class="container">
		
		<div class="basic-info">
			
			<div class="row">
				<div class="col-sm-3">
					
					@if($user->picture)
					<img src="/images/{{ auth()->user()->picture->filename }}" width="150" height="150" class="rounded-circle">
					@else
					<img src="/images/user.jpg" width="150" height="150" class="rounded-circle">
					@endif

					<button style="margin-left: -20px;" id="uplaodButton" class="btn btn-sm btn-info mr-4">{{ __('Update picture') }}</button>

                    <form method="POST" action="/user/profile" class="hidden" enctype="multipart/form-data">
                        @csrf
                        <input id="uploadBox" type="file" name="filename">
                    </form>
				</div>
				<div class="col-sm-7 bg-white">
					<form autocomplete="off" method="POST" action="/user/profile">
						@csrf
						@method('PATCH')
						<h2>Basic info</h2>
						<div class="form-group">	
							<input value="{{ $user->name }}" placeholder="Your username..." type="text" class="form-control" name="name">
						</div>

						<div class="form-group">	
							<input value="{{ $user->email }}" placeholder="Your email..." type="text" class="form-control" name="email">
						</div>

						<div class="form-group">	
							<input value="{{ $user->userprofile->address }}" placeholder="Your address..." type="text" class="form-control" name="address">
						</div>

						<div class="form-group">	
							<input value="{{ $user->userprofile->phone }}" placeholder="Your phone..." type="text" class="form-control" name="phone">
						</div>

						<input value="Save" type="submit"  name="submitbasicinfo" class="btn btn-primary">
					</form>

				</div>
				<div class="col-sm"></div>
			</div>
		</div>

		<div class="password-info">
			<div class="row">
				
				<div class="col-sm-7 offset-sm-3 bg-white">

					<form autocomplete="off" method="POST" action="/user/profile">
						@csrf
						@method('patch')

						<h2>Change password</h2>
						<div class="form-group">	
							<input placeholder="Current password" type="password" class="form-control" name="old_password">
						</div>

						<div class="form-group">	
							<input placeholder="New password" type="password" class="form-control" name="new_password">
						</div>

						<div class="form-group">	
							<input placeholder="Confirm new password" type="password" class="form-control" name="new_password_confirmation">
						</div>

						<input value="Change password" type="submit"  name="submitchangepassword" class="btn btn-primary">
					</form>

				</div>
				<div class="col-sm"></div>
			</div>
		</div>

		<div class="employer-info ">
			<div class="row">
				
				<div class="col-sm-7 offset-sm-3 bg-white">

					<form autocomplete="off" method="POST" action="/user/profile">
						@csrf
						@method('patch')

						<h2>Employment info</h2>
						<div class="form-group">	
							<input placeholder="Your job title (ex: Front-end developer, Accountant ...)" type="text" value="{{$user->userprofile->job_title}}" class="form-control" name="job_title">
						</div>

						<div class="form-group">	
							<textarea rows="3" placeholder="Your Summary" class="form-control" name="summary">{{ $user->userprofile->summary }}</textarea>
						</div>

						<div class="form-group">	
							<p>Every skill must be seperated with comma (,)</p>
							<textarea rows="3" placeholder="Your skills (ex: HTML, CSS, Javascript...)" class="form-control" name="skills">{{ $user->userprofile->skills }}</textarea>
						</div>

						<input value="Save" type="submit"  name="submitemploymentinfo" class="btn btn-primary">
					</form>

				</div>
				<div class="col-sm"></div>
			</div>
		</div>

		<div class="other-info ">
			<div class="row">
				
				<div class="col-sm-7 offset-sm-3 bg-white">

					<form autocomplete="off" method="POST" action="/user/profile">
						@csrf
						@method('patch')

						<h2>Online Presence</h2>
						<div class="form-group">	
							<input placeholder="Your github account" type="link" value="{{$user->userprofile->github}}" class="form-control" name="github">
						</div>

						<div class="form-group">
							<input placeholder="Your portfolio" type="link" value="{{$user->userprofile->portfolio}}" class="form-control" name="portfolio">
						</div>

						<div class="form-group">	
							<input placeholder="Your linkedin account" type="link" value="{{$user->userprofile->linkedin}}" class="form-control" name="linkedin">
						</div>

						<div class="form-group">	
							<input placeholder="Your Website" type="link" value="{{$user->userprofile->website}}" class="form-control" name="website">
						</div>

						<input value="Save" type="submit"  name="submitotherinfo" class="btn btn-primary">
					</form>

				</div>
				<div class="col-sm"></div>
			</div>
		</div>

	</div>

	@if(\Session::has('status'))
		<div class="alert alert-success">
			 {{ \Session::get('status') }}
		</div>
	@endif

	@if($errors->any())
		@foreach($errors->all() as $error)
			<div class="alert alert-danger">
				{{$error}}
			</div>
		@endforeach
	@endif

@endsection