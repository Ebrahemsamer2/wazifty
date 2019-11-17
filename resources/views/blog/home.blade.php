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
              	<form id="search_form" autocomplete="off" method="get" action="/blog/search">
                  <div class="searchText">
                  
                    <input type="text" name="q" class="searchText" placeholder="what do you want to read..." required>

                  </div>
                    <input type="submit" class="main-button" value="Search Now">
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
          <div class="col-lg-9 col-md-12">
            
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
                        <a href="/blog/post/{{$post->slug}}"><h5>{{$post->title}}</h5></a>
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


          <div class="col-sm col-md">
            
            @include('blog.includes.category_sidebar')

            @include('blog.includes.hottest_posts_sidebar')

            @include('blog.includes.hottest_authors_sidebar')
            
          </div>
        </div>
        {{ $posts->links() }}
      </div>
    </div>

@include('blog.includes.footer')