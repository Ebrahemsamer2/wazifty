@extends('layouts.app', ['title' => __('Post Management')])

@section('css')

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#postcontent'
        });
    </script>

@endsection

@section('content')
    @include('admin.jobs.partials.header', ['title' => __('Add Post')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Post Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('jobs.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="create-post" method="post" action="{{ route('posts.store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('Post information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Post Title') }}</label>
                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Post Title') }}" value="{{ old('title') }}" required autofocus>
                                    <p class="title-error js-error">Post title must be between 50 - 150 characters, specific and alphabets only</p>
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('excerpt')?' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-excerpt">{{ __('Post Excerpt ( Optional )') }}</label>
                                    <textarea name="excerpt" id="input-excerpt" class="form-control form-control-alternative{{ $errors->has('excerpt') ? ' is-invalid' : '' }}" placeholder="{{ __('Post excerpt') }}">{{ old('excerpt') }}</textarea>
                                    <p class="excerpt-error js-error">Post excerpt must be between 100 - 1000 characters, specific and alphabets only</p>
                                    @if ($errors->has('excerpt'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('excerpt') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('body') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="postcontent">{{ __('Your post') }}</label>
                                    <textarea name="body" id="postcontent" class="form-control-alternative {{ $errors->has('body') ? ' is-invalid' : '' }}" placeholder="{{ __('Your post...') }}"></textarea>
                                    <p class="body-error js-error">Post must be between 500 - 10000 characters</p>
                                    @if ($errors->has('body'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('body') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="input-category">{{ __('Post Category') }}</label>
                                    <select name="category_id" id="input-category" class="form-control form-control-alternative" required>
                                    	<option value="">Select Category</option>
                                    	@foreach(\App\PostCategory::all() as $category)
                                    	   <option value="{{$category->id}}">{{ $category->name}}</option>
                                        @endforeach
                                    </select>
                                    <p class="category-error js-error">Please select category.</p>
                                    @if ($errors->has('category'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('tags') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-tags">{{ __('Post Tags ( Optional )') }}</label>
                                    <input type="text" name="tags" id="input-tags" class="form-control form-control-alternative{{ $errors->has('tags') ? ' is-invalid' : '' }}" placeholder="{{ __('Post tags...') }}" value="{{ old('tags') }}">

                                    <p class="tags-error js-error">Tag must be between 4 - 50 characters</p>

                                    @if ($errors->has('tags'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tags') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('thumbnail') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-thumbnail">{{ __('Post Thumbnail') }}</label>
                                    <input type="file" name="thumbnail" id="input-thumbnail" class="form-control form-control-alternative{{ $errors->has('thumbnail') ? ' is-invalid' : '' }}" placeholder="{{ __('Post thumbnail...') }}" value="{{ old('thumbnail') }}">

                                    @if ($errors->has('thumbnail'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('thumbnail') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <input type="hidden" value="{{auth()->user()->id}}" name="user_id">
                                <div class="text-center">
                                    <input value="Save" id="save-post" type="submit" class="btn btn-success mt-4" />
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