<div class="hottest-posts">
              
              <div class="header">
                <h4>Hottest Articles</h4>
              </div>

              <div class="body">
                  @if(count($hottest_posts))
                  @foreach($hottest_posts as $post)
                  <div class="post">
                    
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="img">
                          <a href="/blog/post/{{$post->slug}}">
                            @if($post->thumbnail)

                              @if(file_exists('blog_assets/images/'.$post->thumbnail->filename))
                                <img class="ml-2" width="50" height="50" src="/blog_assets/images/{{$post->thumbnail->filename}}">
                                @else
                                <img class="ml-2" width="50" height="50" src="/blog_assets/mainimages/post_placeholder.jpg">
                              @endif
                            @else
                            <img class="ml-2" width="50" height="50" src="/blog_assets/mainimages/post_placeholder.jpg">
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
                  @else
                  <p>There're no posts to show</p>
                  @endif
              </div>
            </div>