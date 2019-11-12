@extends('layouts.app', ['title' => __('Comment Management')])

@section('content')
    @include('admin.users.partials.header', ['title' => __('Edit Comment')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Comment Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('comments.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('comments.update', $comment) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Comment information') }}</h6>
                            <div class="pl-lg-4">

                                <div class="form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-comment">{{ __('Comment') }}</label>
                                    <textarea name="comment" id="input-comment" class="form-control form-control-alternative{{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="Your Comment...">{{$comment->comment}}</textarea>
                                    
                                    @if ($errors->has('comment'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comment') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
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