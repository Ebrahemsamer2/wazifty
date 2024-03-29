@extends('layouts.app', ['title' => __('Job Management')])

@section('content')
    @include('admin.jobs.partials.header', ['title' => __('Edit Job')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Job Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('jobs.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            @if (session('status'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <form id="create-job" method="post" action="{{ route('jobs.update', $job) }}" autocomplete="off">
                            @csrf
                            @method('PATCH')
                            <h6 class="heading-small text-muted mb-4">{{ __('Job information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Job Title') }}</label>
                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Job Title') }}" value="{{ $job->title }}" required autofocus>
                                    <p class="title-error js-error">Job title must be between 10 - 100 characters, specific and alphabets only</p>
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('subtitle') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-subtitle">{{ __('Job Subtitle ( Optional )') }}</label>
                                    <input type="text" name="subtitle" id="input-subtitle" class="form-control form-control-alternative{{ $errors->has('subtitle') ? ' is-invalid' : '' }}" placeholder="{{ __('Job Subtitle') }}" value="{{ $job->subtitle }}">
                                    <p class="subtitle-error js-error">Job subtitle must be between 20 - 200 characters, specific and alphabets only</p>
                                    @if ($errors->has('subtitle'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subtitle') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('job_description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-job-desc">{{ __('Job Description') }}</label>
                                    <textarea name="job_description" id="input-job-desc" class="form-control form-control-alternative{{ $errors->has('job_description') ? ' is-invalid' : '' }}" placeholder="{{ __('Job Description') }}" required>{{ $job->job_description }}</textarea>
                                    <p class="job-description-error js-error">Job description must be between 20 - 1000 characters</p>
                                    @if ($errors->has('job_description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('job_description') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="input-job-type">{{ __('Job Type') }}</label>
                                    <select name="job_type" id="input-job-type" class="form-control form-control-alternative" required>
                                    	<option value="">Job Type</option>
                                    	<option <?php if($job->job_type == "Full Time") echo "selected" ?> value="Full Time">Full Time</option>
                                    	<option <?php if($job->job_type == "Part Time") echo "selected" ?> value="Part Time">Part Time</option>
                                    	<option <?php if($job->job_type == "Internship") echo "selected" ?> value="Internship">Internship</option>
                                    </select>
                                    <p class="job-type-error js-error">Please select one of  job types.</p>
                                    @if ($errors->has('job_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('job_type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('from') ? ' has-danger' : '' }}">
                                	<label class="form-control-label" for="input-from">{{ __('Experience Needed') }}</label><br>

                                    <label class="form-control-label inline-label" for="input-exp-from">{{ __('From') }}</label>
                                    <input value="{{ $job->exp_from }}" min="0" type="number" name="exp_from" id="input-exp-from" class="form-control form-control-alternative inline-input {{ $errors->has('exp_from') ? ' is-invalid' : '' }}" required>
                                    <p class="job-exp-from-error js-error">Please fill this input</p>
                                    @if ($errors->has('exp_from'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('exp_from') }}</strong>
                                        </span>
                                    @endif

                                    <label class="form-control-label inline-lebel" for="input-exp-to">{{ __('To') }}</label>

                                    <input value="{{ $job->exp_to }}" min="1" type="number" name="exp_to" id="input-exp-to" class="form-control form-control-alternative inline-input{{ $errors->has('exp_to') ? ' is-invalid' : '' }}" required>
                                    <p class="job-exp-to-error js-error">Please fill this input ( experience needed `To` field must be greater than experience needed 'From' field )</p>
                                    @if ($errors->has('exp_to'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('exp_to') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('responsibility') ? ' has-danger' : '' }}">
                                    <label class="form-control-label inline-lebel" for="input-responsibility">{{ __('Job Responsibility') }} <p class="hint">Please seperate every responsibility item with dot ( . ).</p></label>

                                    <textarea name="responsibility" id="input-responsibility" class="form-control form-control-alternative{{ $errors->has('responsibility') ? ' is-invalid' : '' }}" placeholder="{{ __('Job Responsibility') }}" required>{{ $job->responsibility }}</textarea>
                                    <p class="job-responsibility-error js-error">Job responsibility must be between 20 - 1000 characters seperated by dot ( . ) </p>
                                    @if ($errors->has('responsibility'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('responsibility') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('requirements') ? ' has-danger' : '' }}">
                                    <label class="form-control-label inline-lebel" for="input-requirements">{{ __('Job Requirements') }} <p class="hint">Please seperate every requirement item with dot ( . ).</p></label>

                                    <textarea name="requirements" id="input-requirements" class="form-control form-control-alternative{{ $errors->has('requirements') ? ' is-invalid' : '' }}" placeholder="{{ __('Job Requirements') }}" required>{{ $job->requirements }}</textarea>
                                    <p class="job-requirements-error js-error">Job requirements must be between 20 - 1000 characters seperated by dot ( . ) </p>
                                    @if ($errors->has('requirements'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('requirements') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('skills') ? ' has-danger' : '' }}">
                                    <label class="form-control-label inline-lebel" for="input-skills">{{ __('Job Skills') }} <p class="hint">Please seperate every skill with comma ( , ).</p></label>

                                    <textarea name="skills" id="input-skills" class="form-control form-control-alternative{{ $errors->has('skills') ? ' is-invalid' : '' }}" placeholder="{{ __('Job Skills') }}" required>{{ $job->skills }}</textarea>
                                    <p class="job-skills-error js-error">Job skiils must be between 20 - 1000 characters seperated by comma ( , ) </p>
                                    @if ($errors->has('skills'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('skills') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('salary') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-salary">{{ __('Job Salary') }}</label>
                                    <input value="{{ $job->salary }}" type="text" name="salary" id="input-salary" class="form-control form-control-alternative{{ $errors->has('salary') ? ' is-invalid' : '' }}" placeholder="{{ __('ex: Paid, Unpaid, Confidential, 2500, 5000, 2000 + bonus .....') }}" value="{{ old('salary') }}" required>

                                    <p class="job-salary-error js-error">Job salary must be between 4 - 50 characters</p>

                                    @if ($errors->has('salary'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('salary') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('work_place') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-work-place">{{ __('Job Work Place') }}</label>
                                    <input type="text" name="work_place" id="input-work-place" class="form-control form-control-alternative{{ $errors->has('work_place') ? ' is-invalid' : '' }}" placeholder="{{ __('Job Work Place') }}" value="{{ $job->work_place }}" required>
                                    <p class="work-place-error js-error">Job work place must be between 3 - 50 characters and specific country / city</p>
                                    @if ($errors->has('work_place'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('work_place') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="input-category-id">{{ __('Job Category') }}</label>
                                    <select name="category_id" id="input-category-id" class="form-control form-control-alternative" required>
                                    	<option value="">Job Category</option>
                                   
                                    	@foreach($cats as $cat)

                                    		<option <?php if($job->category_id == $cat->id) echo "selected"; ?> value="{{ $cat->id }}">{{ $cat->name }}</option>

                                    	@endforeach

                                    </select>
                                    <p class="job-category-id-error js-error">Select job category</p>
                                    @if ($errors->has('category_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <!-- <input type="hidden" value="1" name="active"> -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                                </div>
                            </div>
                            <input type="hidden" name="fromadmin" value="1">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection