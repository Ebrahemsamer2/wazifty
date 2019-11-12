@include('blog.includes.header')

	
    <!-- Banner Starts Here -->
    <div style="background-color: #000;">
    <div class="banner" style="background-image: url(/blog_assets/images/{{$post->thumbnail->filename}}); opacity: .8;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="header-text caption post">
              <h2 class="post-title">{{$post->title}}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
    <!-- Banner Ends Here -->

    <div class="content">
    	
    	<div class="container">
    		
    		<div class="row">
    			
    			<div class="col-sm-8">
    				<div class="post-content">
    		
    					<p class="content-text">{!! $post->body !!}</p>

    				</div>
<hr>
    				<div class="comment-section">
    					<h3>Comments</h3>
    					<div id="comments">
    						
    					@foreach($comments as $comment)
    					<div class="row {{ $comment->comment_type == 'reply' ? 'reply' : '' }}">
    						<div class="col-sm-2">
    							<div class="commenter-image">
    								@if($comment->user->picture)
    								<img src="/images/{{ $comment->user->picture->filename }}" width="80" height="80">
    								@else
    								<img src="/images/user.jpg" width="80" height="80">
    								@endif
    							</div>
    						</div>
    						<div class="col-sm">
    							<div class="comment" id="comment{{$comment->id}}">
    								<span class="text-gray">{{$comment->created_at ? $comment->created_at->diffForHumans() : ''}}
    								</span>
    								<p>{{ $comment->comment }}</p>
    								@auth
    								@if(auth()->user()->id == $comment->user_id)
    								<form method="post" action="">
    									<a href="" class="btn btn-secondary btn-sm">Edit</a>
    									@if($comment->comment_type == 'comment')
    									<a href="" class="btn btn-info btn-sm">Reply</a>
    									@endif
    									<input type="submit" value="Delete" class="btn btn-danger btn-sm" />
    								</form>
    								@endif
    								@endauth
    							</div>
    						</div>
    					</div>
    					@endforeach
    					<hr>
    					<div class="add-comment">
    						<h4>Add comment</h4>
    						@guest
    						<p>please <a href="/login">login</a> to add comments</p>
    						@endguest
    						@auth
    						<form id="addcommentform" method="post" action="{{ route('comments.store') }}">
    							@csrf

    							<input type="hidden" name="comment_type" value="comment">
    							<input type="hidden" name="post_id" value="{{$post->id}}">
    							<input type="hidden" name="slug" value="{{$post->slug}}">
    							<textarea name="comment" placeholder="Your comment..." rows="4" class="form-control mb-2"></textarea>
    							<p class="comment-error js-error">Your comment is too long ( Maximum: 500 characters ).</p>
    							<input type="submit" name="addcomment" class="float-right btn btn-success" value="Comment">
    						</form>
    						@endauth
    					</div>
    				</div>
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
		                                <img class="ml-2" width="80" height="60" src="/blog_assets/images/{{$post->thumbnail->filename}}">
		                                @else
		                                <img class="ml-2" width="80" height="60" src="/blog_assets/mainimages/post_placeholder.jpg">
		                              @endif
		                            @else
		                            <img class="ml-2" width="80" height="60" src="/blog_assets/mainimages/post_placeholder.jpg">
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
		                                <img class="ml-2" width="80" height="60" src="/blog_assets/images/{{$post->thumbnail->filename}}">
		                                @else
		                                <img class="ml-2" width="80" height="60" src="/blog_assets/mainimages/post_placeholder.jpg">
		                              @endif
		                            @else
		                            <img class="ml-2" width="80" height="60" src="/blog_assets/mainimages/post_placeholder.jpg">
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

