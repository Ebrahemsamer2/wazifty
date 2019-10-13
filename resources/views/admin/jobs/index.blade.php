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
                        
                        @foreach($jobs as $job)
                            <div class="job" id="{{ $job->id }}">
                                
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <h4 class="card-title">{{ $job->title }}</h5>
                                                <h5 class="card-subtitle mb-2 text-muted">{{ $job->subtitle }}</h6>
                                                <p class="card-text">{{ $job->job_description }}</p>
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

                        @endforeach
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $jobs->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection


