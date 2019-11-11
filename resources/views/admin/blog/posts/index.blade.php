@extends('layouts.app', ['title' => 'Posts Management'])

@section('content')
    @include('layouts.headers.cards')


    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Posts') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary">{{ __('Add post') }}</a>
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
                    <div class="all-posts">
                        <div class="row">
                        @if(count($posts))
                        @foreach($posts as $post)
                            <div class="col-sm-4">
                                
                                <div class="post">
                                    
                                    <div class="card" style="width: 18rem;">
                                      <img src="/blog/images/{{$post->thumbnail->filename}}" class="card-img-top" alt="...">
                                      <div class="card-body">
                                        <h5 class="card-title">{{$post->title}}</h5>
                                        <p class="card-text">{{ $post->excerpt ? \Str::limit($post->excerpt, 100) : \Str::limit(strip_tags($post->body), 100) }}</p>
                                         
                                        <form action="{{ route('posts.destroy', $post) }}" method="post">
                                            @csrf
                                            @method('delete')
                                        
                                            <a class="btn btn-info btn-sm" href="{{ route('posts.edit', $post) }}">{{ __('Edit') }}</a>
                                            <button class="btn btn-danger btn-sm" type="button"onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                            {{ __('Delete') }}
                                            </button>
                                            <a target="_blank" class="btn btn-default btn-sm" href="{{ route('posts.show', $post) }}">{{ __('Preview') }}</a>
                                        </form>

                                      </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                        @else
                            <p>No posts to show</p>
                        @endif
                        </div>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $posts->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection