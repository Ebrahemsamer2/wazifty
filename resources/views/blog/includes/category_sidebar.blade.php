<div class="categories force-overflow" id="style-7">
              
  <div class="header">
    <h4>Categories</h4>
  </div>

  <div class="body">
    <ul class="list-unstyled">
      @if(count($categories))
      @foreach($categories as $cat)
        <li><a href="/blog/category/{{$cat->name}}"> {{ $cat->name }} </a></li>
      @endforeach
      @else
      <p>There're no categories to show</p>
      @endif
    </ul>
  </div>

</div>