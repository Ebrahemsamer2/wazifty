@extends('layouts.app', ['title' => __('Job Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Jobs') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('jobs.create') }}" class="btn btn-sm btn-primary">{{ __('Add job') }}</a>
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
                    <div class="all-jobs">
                        <div class="job" id="{{ $job->id }}">
                            
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <h2 class="card-title">{{ $job->title }} 
                                                <span style="margin-left: 30px; font-weight: bold; font-size: 13px;" class="text-{{ $job->active ? 'success' : 'warning' }}">{{ $job->active ? 'Activated ' : 'Deactivated ' }}job
                                                </span>
                                            </h2>
                                            <h4 class="card-subtitle mb-2">{{ $job->subtitle }}
                                            </h4>
                                            <hr>
                                            <div class="job-about">
                                                <h4>About job</h4>

                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h5 class="text-center">Category</h5>
                                                        <h5 class="text-center">{{ Str::limit($job->category->name, 20) }}</h5>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <h5 class="text-center">Job type</h5>
                                                        <h5 class="text-center">{{ $job->job_type }}</h5>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <h5 class="text-center">Experience needed</h5>
                                                        <h5 class="text-center">{{ $job->exp_from }} - {{ $job->exp_to }} years</h5>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <h5 class="text-center">Job salary</h5>
                                                        <h5 class="text-center">{{ Str::limit($job->salary, 20) }}</h5>
                                                    </div>

                                                </div>

                                            </div>   
                                            <hr>
                                            <div class="job-description">
                                                <h4>Job description</h4>
                                                <p class="">
                                                    {{ $job->job_description }}
                                                </p>
                                            </div>
                                            <hr>
                                            <div class="job-responsibility">
                                                <h4>Job responsibility</h4>
                                                <?php $responsibilities = explode(',', $job->responsibility); ?>
                                                <ul>
                                                    @foreach($responsibilities as $responsibility)
                                                    <li>{{ $responsibility }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <hr>
                                            <div class="job-requirements">
                                                <h4>Job requirements</h4>
                                                <?php $requirements = explode(',', $job->requirements); ?>
                                                <ul>
                                                    @foreach($requirements as $requirement)
                                                    <li>{{ $requirement }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <hr>
                                            <div class="job-skills">
                                                <h4>Job skills</h4>
                                                <?php $skills = explode(',', $job->skills); ?>
                                                <ul>
                                                    @foreach($skills as $skill)
                                                    <li>{{ $skill }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <hr>
                                        </div> 
                                        <div class="col-sm">
                                            @if($job->user->picture)
                                                <img class="rounded-circle" src="{{ asset('images') }}/{{ $job->user->picture->filename }}" width="100" height="100">
                                            @else
                                                <img src="{{ asset('images') }}/user.jpg" width="100" height="100">
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <form class="inline-form" action="/admin/jobs/{{ $job->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="/admin/jobs/{{ $job->id }}/edit" class="btn btn-info btn-sm">Edit</a>
                                        <input onclick="confirm('{{ __("Are you sure you want to delete this job?") }}') ? this.parentElement.submit() : ''" type="submit" name="delete" value="Delete Job" class="btn btn-danger btn-sm">
                                    </form>
                                    <form class="inline-form" action="/admin/jobs/{{ $job->id }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                    
                                        @if($job->active == 1)
                                            <input type="hidden" value="0" name="active">
                                            <input type="submit" value="Deactivate" class="btn btn-warning btn-sm">
                                        @else
                                            <input type="hidden" value="1" name="active">
                                            <input class="btn btn-success btn-sm" type="submit" value="Activate">
                                        @endif
                                    </form>
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


