@include('blog.includes.header')

	
    <!-- Banner Starts Here -->

<div class="image-box">
    <div class="image-box__background" style="--image-url: url('/blog_assets/images/{{$post->thumbnail->filename}}')"
    ></div>
    <div class="image-box__overlay"></div>
    <div class="image-box__content header-text caption post">
        <h1 class="post-title">{{ $post->title }}
        <br><br><a href="/blog/author/{{$post->user->name}}" style="color: #bbbbbb;
    font-size: 18px;
    margin-left: 30%;
    margin-top: 20px;">
        	@if($post->user->picture)
        		<img style="margin-right: 10px;" class="rounded-circle" width="60" height="60" src="/images/{{$post->user->picture->filename}}">
        	@else
        		<img class="rounded-circle" width="60" height="60" src="/images/user.jpg">
        	@endif
        	{{$post->user->name}}<span style="font-size: 12px;margin-left: 15px;">
        	{{$post->created_at->diffForHumans()}}</span>
        </a>
        </h1>
    </div>
</div>


    <!-- Banner Ends Here -->

    <div class="content single">
    	
    	<div class="container">
    		
    		<div class="row">
    			
    			<div class="col-lg-8 col-md-12">

    				<div class="post-content">
    				
    					<p class="content-text">{!! $post->body !!}</p>

    					<div class="post-info">
    						<p class="cat"><i class="fas fa-list"></i> Category: <span > <a href="/blog/category/{{$post->category->name}}">{{$post->category->name}}</a></span></p>
    						<p class="tags"><i class="fas fa-tag"></i> Tags: 
    							@foreach(explode(' ', $post->tags) as $tag)
    							<span>
    							<a href="/blog/tag/{{$tag}}">{{$tag}}</a>
    							</span>
    							@endforeach
    						</p>
    					</div>

					</div>
<hr>
    				<div class="comment-section">
    					<h3>Comments</h3>
    					<div id="comments">
    					@if(count($comments))
    					@foreach($comments as $comment)
    					<div class="comment{{$comment->id}} row {{ $comment->comment_type == 'reply' ? 'reply' : '' }}">
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
    							<div class="comment">
    								<span class="text-gray">{{$comment->created_at ? $comment->created_at->diffForHumans() : ''}}
    								</span>
    								<p class="{{$comment->id}}">{{ $comment->comment }}</p>
    								@auth
    								@if(auth()->user()->id == $comment->user_id)
    								<form class="deletecomment" method="post" action="/blog/post/{{$comment->post->slug}}">
    									@csrf
    									@method('DELETE')

    									<a data-target="#updatecomment{{$comment->id}}" data-toggle="modal" href="" class="btn btn-secondary btn-sm">Edit</a>
    									<input type="hidden" name="comment_id" value="{{ $comment->id }}">
    									<input type="hidden" name="slug" value="{{ $comment->post->slug }}">
    									<input onclick="return confirm('Are you sure?');" type="submit" value="Delete" class="btn btn-danger btn-sm" />
    								</form>
    								@endif
    								@endauth
    							</div>
    						</div>
    					</div>












    					<div class="modal fade" id="updatecomment{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  							<div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title">Update you comment</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        <form method="POST" action="" class="updatecommentform">
							        	@csrf
							        	@method('PUT')

							        	<input type="hidden" name="comment_id" value="{{$comment->id}}">
							        	<input type="hidden" name="slug" value="{{$comment->post->slug}}">
							        	<textarea class="form-control" name="comment" >{{ $comment->comment }}</textarea>
							        	<p class="edit-comment-error js-error">Your comment is too long ( Maximum: 500 characters ).</p>
							        	<input type="submit" class="btn btn-success mt-2 float-right" name="updatecomment" value="Update">
							        </form>
							      </div>
							      
							    </div>
						  	</div>
						</div>





    					@endforeach
    					@else
    					<p>There're no comments</p>
    					@endif
    					<hr>
    					<div class="add-comment">
    						<h4>Add comment</h4>
    						@guest
    						<p>please <a href="/login">login</a> to add comments</p>
    						@endguest
    						@auth
    						<form id="addcommentform" method="post" action="{{ route('comments.store') }}">
    							@csrf

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

    			<div class="col-sm col-md">
    				


    				<div class="author-posts">
              
		              <div class="header">
		                <h4>{{explode(' ', $post->user->name)[0]}}'s Latest posts</h4>
		              </div>

		              <div class="body">

		                  @foreach($author_posts as $post)
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

