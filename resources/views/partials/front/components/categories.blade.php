<div class="block blog-module">
    <div class="sidebar-bar-title">
      <h3>Blog Categories</h3>
    </div>
    <div class="block_content"> 
      <div class="layered layered-category">
        <div class="layered-content">
          <ul class="tree-menu">
            @foreach($categories as $cat)
                <?php $slg = \Illuminate\Support\Str::slug($cat->name, '-') . '-' . $cat->id; ?>
                <li><a href="{{ route('blog.categories', ['slug' => $slg]) }}"><i class="fa fa-angle-right"></i>&nbsp; {{ $cat->name }}</a></li>
            @endforeach
            <li><a href="#"><i class="fa fa-search"></i>&nbsp; Browse All Categories</a></li>
          </ul>
        </div>
      </div>
    </div>
</div>