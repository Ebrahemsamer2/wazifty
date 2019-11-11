<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <title>WAZIFTY blog</title>

    <!-- Bootstrap core CSS -->
    <link href="/argon/css/argon.css" rel="stylesheet">
    <link href="/blog_assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/blog_assets/css/templatemo-host-cloud.css">

    <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="/argon/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="/argon/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="/blog_assets/css/fontawesome.css">
    <link rel="stylesheet" href="/blog_assets/css/templatemo-host-cloud.css">
    <link rel="stylesheet" href="/blog_assets/css/owl.css">
    <link rel="stylesheet" href="/blog_assets/css/custom.css">

  </head>

  <body>

    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.html"><h2>WAZ <em>IFTY</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="/blog">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/aboutus">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/services">Our Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/contact">Contact Us</a>
              </li>
            </ul>
          </div>
          <div class="functional-buttons">
            @guest
            <ul>
              <li><a href="/login">Log in</a></li>
              <li><a href="/register">Sign Up</a></li>
            </ul>
            @endguest
            @auth
            <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        @if(auth()->user()->picture)
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('images') }}/{{ auth()->user()->picture->filename }}">
                        </span>
                        @else
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('images') }}/user.jpg">
                        </span>
                        @endif
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('text.welcome') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('text.profile') }}</span>
                    </a>
                    <a href="/admin/profile/jobs" class="dropdown-item">
                        <i class="fas fa-briefcase "></i>
                        <span>{{ __('text.jobs') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('text.activity') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('text.logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
            @endauth
          </div>
        </div>
      </nav>
    </header>

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
                        <a href="">
                          <img src="/blog_assets/images/{{$post->thumbnail->filename}}" class="img-fluid">
                        </a>
                      </div>
                      <div class="post-heading">
                        <a href="/"><h5>{{$post->title}}</h5></a>
                      </div>
                      <div class="post-excerpt">
                        <a href="">
                          <p class="lead">{{ $post->excerpt ? \Str::limit($post->excerpt, 100) : \Str::limit( strip_tags($post->body), 100) }}</p>
                        </a>
                      </div>
                      <div class="actions">
                        <a class="btn btn-primary" href="/">Read more</a>
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
                          <a href="">
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
                        <a href=""><h6>{{ $post->title }}</h6></a>
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


















    <!-- Footer Starts Here -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="footer-item">
              <div class="footer-heading">
                <h2>About Us</h2>
              </div>
              <p>WAZIFTY is provided by Ebrahem for free of charge. Anyone can use this website for free you can find you job read useful articles.</p>
            </div>
          </div>
          
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="footer-item">
              <div class="footer-heading">
                <h2>Blog links</h2>
              </div>
              <ul class="footer-list">
                <li><a href="/">Home</a></li>
                <li><a href="/aboutus">About us</a></li>
                <li><a href="/services">Our services</a></li>
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
              </ul>
            </div>
          </div>
          
          
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="footer-item">
              <div class="footer-heading">
                <h2>WZIFTY Links</h2>
              </div>
              <ul class="footer-list">
                <li><a href="#">Browse Jobs</a></li>
                <li><a href="#">How it works</a></li>
                <li><a href="#">Why us</a></li>
                <li><a href="#">What users say?</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </div>
          </div>
          
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="footer-item">
              <div class="footer-heading">
                <h2>More Information</h2>
              </div>
              <ul class="footer-list">
                <li>Phone: <a href="#">010-020-0560</a></li>
                <li>Email: <a href="#">mail@wazifty.com</a></li>
                <li>Support: <a href="#">support@wazifty.com</a></li>
                <li>Website: <a href="#">www.wazifty.com</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-12">
            <div class="sub-footer">
              <p>Copyright &copy; 2020 WAZIFTY Company
				- Designed by <a rel="nofollow" href="http://ebrahemsamer2.000webhostapp.com">Ebrahem Samer</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer Ends Here -->

    <!-- Bootstrap core JavaScript -->
    <script src="/blog_assets/vendor/jquery/jquery.min.js"></script>
    <script src="/blog_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="/blog_assets/js/custom.js"></script>
    <script src="/blog_assets/js/owl.js"></script>
    <script src="/blog_assets/js/accordions.js"></script>


    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>

  </body>
</html>