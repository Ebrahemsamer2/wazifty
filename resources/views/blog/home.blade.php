@include('blog.includes.header')

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <div class="header-text caption">
              <h2>Search your article</h2>
              <div id="search-section">
              	<form id="suggestion_form" name="gs" method="get" action="#">
                  <div class="searchText">
                  
                    <input type="text" name="q" class="searchText" placeholder="what do you want to read..." autocomplete="off">

                  </div>
                    <input type="submit" name="results" class="main-button" value="Search Now">
                 </form>
               <div class="advSearch_chkbox">
               </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->




    <!-- Posts -->
    <div class="home">
      
      <div class="container">
        <div class="row">
          <div class="col-sm-9">
            
            <div class="posts">
              
              <div class="row">
                
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

              </div>
            </div>
          </div>


          <div class="col-sm">
            
            <div class="categories force-overflow" id="style-7">
              
              <div class="header">
                <h4>Categories</h4>
              </div>

              <div class="body">
                <ul class="list-unstyled">
                  @foreach($categories as $cat)
                    <li><a href=""> {{ $cat->name }} </a></li>
                  @endforeach
                </ul>
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
                
              </div>
            </div>


            <div class="hottest-authors">
              
              <div class="header">
                <h4>Favourite authors</h4>
              </div>

              <div class="body">

                  @foreach($hottest_authors as $author)
                  <div class="author">
                    
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="img">
                          @if($author->picture)
                          <a href="">
                            @if(file_exists('images/'. $author->picture->filename))
                            <img class="rounded-circle ml-2" width="50" height="50" class="" src="/images/{{ $author->picture->filename }}">
                            @else
                              <img class="rounded-circle ml-2" width="50" height="50" class="" src="/images/user.jpg">
                            @endif
                          </a>
                          @else
                          <img class="rounded-circle ml-2" width="50" height="50" class="" src="/images/user.jpg">
                          @endif
                        </div>
                      </div>
                      <div class="col-sm">
                        <a href=""><h6>{{ $author->name }}</h6></a>
                        <span class="text-grey">{{ $author->posts_count }} posts</span>
                      </div>
                    </div>
                  </div>
                  @endforeach
                
              </div>

            </div>

          </div>

        </div>
        {{ $posts->links() }}
      </div>

    </div>










@include('blog.includes.footer')