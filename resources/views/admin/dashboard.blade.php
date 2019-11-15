@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Recent users</h3>
                        </div>
                        <div class="col text-right">
                            <a href="/admin/users" class="btn btn-sm btn-primary">See all</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center recent-jobs table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Verified</th>
                                    <th scope="col">Usebr type</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users))
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">
                                        {{\Str::limit($user->name, 20)}}
                                    </th>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td class="{{$user->email_verified_at ? 'text-success' : 'text-danger'}}">
                                        @if($user->email_verified_at)
                                            Verified
                                        @else
                                            Unverified    
                                        @endif
                                    </td>
                                    <td>
                                        {{$user->emp_type}}
                                    </td>
                                    <td>
                                        <form class="inline-form" action="{{ route('users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-primary btn-sm">Edit</a>
                                            <input onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''" type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>  

            </div>


        </div>
        <div class="row mt-5">
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Recent jobs</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/admin/jobs" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center recent-jobs table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Job title</th>
                                    <th scope="col">Work place</th>
                                    <th scope="col">Applied users</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($jobs))
                                @foreach($jobs as $job)
                                <tr>
                                    <th scope="row">
                                        {{\Str::limit($job->title, 40)}}
                                    </th>
                                    <td>
                                        {{$job->work_place}}
                                    </td>
                                    <td>
                                        {{count($job->application->users)}}
                                    </td>
                                    <td>
                                        <form class="inline-form" action="{{ route('jobs.destroy', $job) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="/admin/jobs/{{ $job->id }}" class="btn btn-info btn-sm">Show</a>
                                            <a href="/admin/jobs/{{ $job->id }}/edit" class="btn btn-primary btn-sm">Edit</a>
                                            <input onclick="confirm('{{ __("Are you sure you want to delete this job?") }}') ? this.parentElement.submit() : ''" type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Recent articles</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/admin/blog/posts" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($posts))
                                @foreach($posts as $post)
                                <tr>
                                    <th scope="row">
                                        <a target="_blank" href="/blog/post/{{$post->slug}}">{{\Str::limit($post->title, 50)}}</a>
                                    </th>
                                    <td class="text-center">
                                        {{count($post->comments)}}
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection