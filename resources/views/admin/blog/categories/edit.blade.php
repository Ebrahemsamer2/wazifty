@extends('layouts.app', ['title' => __('Categories Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Categories') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">{{ __('Add category') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
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
                    <div class="col-12">
                    	<form autocomplete="off" id="postcategory-form" method="POST" action="{{ route('categories.update', $category->id) }}">
                    		@csrf
                            @method('PUT')

                    		<div class="row">
                    			<div class="col-sm-10">
	                    			<input value="{{ $category->name }}" class="form-control" type="text" name="name">
	                    		</div>
	                    		<div class="col-sm">
	                    			<input class="btn btn-primary" type="submit" value="Update">
	                    		</div>
                    		</div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection
