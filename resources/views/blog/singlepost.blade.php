@include('blog.includes.header')

	
    <!-- Banner Starts Here -->
    <div style="background-color: #000;">
    <div class="banner" style="background-image: url(/blog_assets/images/{{$post->thumbnail->filename}}); opacity: .9;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="header-text caption">
              <h2>{{$post->title}}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
    <!-- Banner Ends Here -->

    <div class="content">
    	
    	<div class="container-fluid">
    		
    		<div class="row">
    			
    			<div class="col-sm-8">
    				<div class="post-content">
    		
    					<p class="content-text">{!! $post->body !!}</p>

    				</div>
    			</div>

    			<div class="col-sm">
    				
					<div class="latest-posts">
              
		              <div class="header">
		                <h4>Latest Articles</h4>
		              </div>

		              <div class="body">

		                  @foreach($latest_posts as $post)
		                  <div class="post">
		                    
		                    <div class="row">
		                      <div class="col-sm-3">
		                        <div class="img">
		                          <a href="/blog/post/{{$post->slug}}">
		                            @if($post->thumbnail)

		                              @if(file_exists('blog_assets/images/'.$post->thumbnail->filename))
		                                <img class="ml-2" width="90" height="60" src="/blog_assets/images/{{$post->thumbnail->filename}}">
		                                @else
		                                <img class="ml-2" width="90" height="60" src="/blog_assets/mainimages/post_placeholder.jpg">
		                              @endif
		                            @else
		                            <img class="ml-2" width="90" height="60" src="/blog_assets/mainimages/post_placeholder.jpg">
		                            @endif
		                          </a>
		                        </div>
		                      </div>
		                      <div class="col-sm">
		                        <a href="/blog/post/{{$post->slug}}"><h6>{{ $post->title }}</h6></a>
		                        <span class="text-grey">{{ $post->created_at->diffForHumans() }}</span>
		                      </div>
		                    </div>
		                  </div>
		                  @endforeach
		                
		              </div>
		            </div>


		            <div class="hottest-posts">
              
		              <div class="header">
		                <h4>Hottest Articles</h4>
		              </div>

		              <div class="body">

		                  @foreach($hottest_posts as $post)
		                  <div class="post">
		                    
		                    <div class="row">
		                      <div class="col-sm-3">
		                        <div class="img">
		                          <a href="/blog/post/{{$post->slug}}">
		                            @if($post->thumbnail)

		                              @if(file_exists('blog_assets/images/'.$post->thumbnail->filename))
		                                <img class="ml-2" width="90" height="60" src="/blog_assets/images/{{$post->thumbnail->filename}}">
		                                @else
		                                <img class="ml-2" width="90" height="60" src="/blog_assets/mainimages/post_placeholder.jpg">
		                              @endif
		                            @else
		                            <img class="ml-2" width="90" height="60" src="/blog_assets/mainimages/post_placeholder.jpg">
		                            @endif
		                          </a>
		                        </div>
		                      </div>
		                      <div class="col-sm">
		                        <a href="/blog/post/{{$post->slug}}"><h6>{{ $post->title }}</h6></a>
		                        <span class="text-grey">{{ $post->created_at->diffForHumans() }}</span>
		                      </div>
		                    </div>
		                  </div>
		                  @endforeach
		                
		              </div>
		            </div>

    			</div>

    		</div>

    	</div>

    </div>





@include('blog.includes.footer')

