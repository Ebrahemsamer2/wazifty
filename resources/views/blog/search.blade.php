@include('blog.includes.header')

	
    <!-- Banner Starts Here -->
    <div style="background-color: #000;">
    <div class="banner" style="padding: 100px 0; background-image: url(/blog_assets/mainimages/background.jpg); opacity: .8;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="header-text caption post">
            	  <h2 style="margin-bottom: 0;" class="post-title">Search: {{$q}}</h2>
        
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
    <!-- Banner Ends Here -->

    <div class="home">
    	
    	<div class="container">

        @if(count($results))
          <h4 style="margin-bottom: 20px;" class="">{{ count($results) }} result</h4>
        @endif 	
    	<div class="row">
          <div class="col-sm-9">
            
            <div class="posts">
              
              <div class="row">
                @if(count($results))
                @foreach($results as $result)
                  <div class="col-sm-6">
                    <div class="post">
                      <div class="post-thumbnail">
                        <a href="/blog/post/{{$result->slug}}">
                          <img src="/blog_assets/images/{{$result->thumbnail->filename}}" class="img-fluid">
                        </a>
                      </div>
                      <div class="post-heading">
                        <a href="/blog/{{$result->slug}}"><h5>{{$result->title}}</h5></a>
                      </div>
                      <div class="post-excerpt">
                        <a href="/blog/post/{{$result->slug}}">
                          <p class="lead">{{ $result->excerpt ? \Str::limit($result->excerpt, 100) : \Str::limit( strip_tags($result->body), 100) }}</p>
                        </a>
                      </div>
                      <div class="actions">
                        <a class="btn btn-primary" href="/blog/post/{{$result->slug}}">Read more</a>
                      </div>
                    </div>
                  </div>
                @endforeach
                @else
                <p>No Results to show</p>
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
        
    	</div>
    </div>

@include('blog.includes.footer')

