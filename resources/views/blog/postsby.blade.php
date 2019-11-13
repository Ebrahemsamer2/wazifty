@include('blog.includes.header')

	
    <!-- Banner Starts Here -->
    <div style="background-color: #000;">
    <div class="banner" style="padding: 100px 0; background-image: url(/blog_assets/mainimages/background.jpg); opacity: .8;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="header-text caption post">

            	  @isset($author)

              	<h2 style="margin-bottom: 0;" class="post-title">Author: {{$author->name}}</h2>

              	@endisset

              	@isset($tag)

              	<h2 style="margin-bottom: 0;" class="post-title">Tag: {{$tag}}</h2>

              	@endisset

              	@isset($category)

              	<h2 style="margin-bottom: 0;" class="post-title">Category: {{$category->name}}</h2>

              	@endisset
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
    <!-- Banner Ends Here -->

    <div class="home">
    	
    	<div class="container">
    		
			     @isset($author)

          	<h4 style="margin-bottom: 20px;" class="">{{$author->name}} posts</h4>

          	@endisset

          	@isset($tag)

          	<h4 style="margin-bottom: 20px;"  class="">Tag: {{$tag}}</h4>

          	@endisset

          	@isset($category)

          	<h4 style="margin-bottom: 20px;" class="">Category: {{$category->name}}</h4>

          	@endisset

    	<div class="row">
          <div class="col-sm-9">
            
            <div class="posts">
              
              <div class="row">
                @if(count($posts))
                @foreach($posts as $post)
                  <div class="col-sm-6">
                    <div class="post">
                      <div class="post-thumbnail">
                        <a href="/blog/post/{{$post->slug}}">
                          <img src="/blog_assets/images/{{$post->thumbnail->filename}}" class="img-fluid">
                        </a>
                      </div>
                      <div class="post-heading">
                        <a href="/blog/{{$post->slug}}"><h5>{{$post->title}}</h5></a>
                      </div>
                      <div class="post-excerpt">
                        <a href="/blog/post/{{$post->slug}}">
                          <p class="lead">{{ $post->excerpt ? \Str::limit($post->excerpt, 100) : \Str::limit( strip_tags($post->body), 100) }}</p>
                        </a>
                      </div>
                      <div class="actions">
                        <a class="btn btn-primary" href="/blog/post/{{$post->slug}}">Read more</a>
                      </div>
                    </div>
                  </div>
                @endforeach
                @else
                <p class="lead">There're no posts to show</p>
                @endif
              </div>
            </div>
          </div>

          <div class="col-sm">
            
            @include('blog.includes.category_sidebar')

            @include('blog.includes.hottest_posts_sidebar')

            @include('blog.includes.hottest_authors_sidebar')

          </div>
        </div>
        {{ $posts->links() }}
    	</div>
    </div>

@include('blog.includes.footer')

