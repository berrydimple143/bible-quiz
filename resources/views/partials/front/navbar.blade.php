<nav>
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-4">
          <div class="mm-toggle-wrap">
            <div class="mm-toggle"> <i class="fa fa-align-justify"></i> </div>
            <span class="mm-label">Categories</span> </div>
          <div class="mega-container visible-lg visible-md visible-sm">
            <div class="navleft-container">
              <div class="mega-menu-title">
                <h3>Categories</h3>
              </div>
              <div class="mega-menu-category">
                <ul class="nav">
                  @foreach($categories as $ct)
                    <?php $slg = \Illuminate\Support\Str::slug($ct->name, '-') . '-' . $ct->id; ?>
                    <li class="nosub"><a href="{{ route('blog.categories', ['slug' => $slg]) }}"><i class="icon fa fa-{{ $ct->icon }} fa-fw"></i> {{ $ct->name }}</a></li>
                  @endforeach
                  <li class="nosub"><a href="{{ route('all.categories') }}"><i class="icon fa fa-search fa-fw"></i> Browse all categories</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-9 col-sm-8">
          <div class="mtmegamenu">
            @include('partials.front.menu')
          </div>
        </div>
      </div>
    </div>
</nav>