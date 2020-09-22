  <header>
    <div class="header-container">
      <div class="header-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-sm-4 hidden-xs"> 
              <!-- Default Welcome Message -->
              <div class="welcome-msg ">Welcome to OnlineStorehouse </div>
              <span class="phone hidden-sm">Call Us: +639104374372</span> </div>
            
            <!-- top links -->
            <div class="headerlinkmenu col-lg-8 col-md-7 col-sm-8 col-xs-12">
              <div class="links">
                <div class="blog"><a title="Log In" href="{{ route('login') }}"><i class="fa fa-unlock-alt"></i><span class="hidden-xs">Log In</span></a></div>
                <div class="myaccount"><a title="Register" href="{{ route('subscribe') }}"><i class="fa fa-user"></i><span class="hidden-xs">Create your article for free</span></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-sm-3 col-md-3 col-xs-12"> 
            <!-- Header Logo -->
            <div class="logo" id="logo-pulse"><a title="Storehouse homepage" href="{{ route('site') }}"><div id="demo1" class="demo"><h2>Storehouse</h2></div></a> </div>
            <!-- End Header Logo --> 
          </div>
          <div class="col-xs-9 col-sm-6 col-md-6"> 
            <!-- Search -->
            
            <div class="top-search">
              <div id="search">
                {!! Form::open(['route' => 'search.blog', 'method' => 'POST', 'id' => 'search-product-form']) !!}
                  <div class="input-group">
                    <select class="cate-dropdown hidden-xs" id="category-selected" name="category_id">
                      <option value="all">All Categories</option>
                      @foreach($allcategories as $allcat)
                        <option value="{{ $allcat->id }}">&nbsp;{{ $allcat->name }}</option>
                      @endforeach
                    </select>
                    <input type="text" class="form-control" id="searched_blog" placeholder="Select category and search blog keyword here ..." name="searched_blog">
                    <button class="btn-search" id="btn-search" type="submit"><i class="fa fa-search"></i></button>
                  </div>
                {!! Form::close() !!}
              </div>
            </div>
            
            <!-- End Search --> 
          </div>
          <!-- top cart -->
          <div class="col-lg-3 col-xs-3 top-cart">&nbsp;</div>
        </div>
      </div>
    </div>
  </header>