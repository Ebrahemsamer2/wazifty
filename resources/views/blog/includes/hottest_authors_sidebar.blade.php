<div class="hottest-authors">
              
              <div class="header">
                <h4>Favourite authors</h4>
              </div>

              <div class="body">
                  @if(count($hottest_authors))
                  @foreach($hottest_authors as $author)
                  <div class="author">
                    
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="img">
                          @if($author->picture)
                          <a href="/blog/author/{{$author->name}}">
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
                        <a href="/blog/author/{{$author->name}}"><h6>{{ $author->name }}</h6></a>
                        <span class="text-grey">{{ $author->posts_count }} posts</span>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  @else
                  <p>There're no posts to show</p>
                  @endif
              </div>
            </div>