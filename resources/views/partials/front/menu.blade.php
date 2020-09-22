<ul>
  <li class="mt-root">
    <div class="mt-root-item"><a href="{{ route('site') }}">
      <div class="title title_font"><span class="title-text">Home</span> </div>
      </a></div>
  </li>
  <li class="mt-root">
    <div class="mt-root-item"><a href="#">
      <div class="title title_font"><span class="title-text">Blogs</span></div>
      </a>
    </div>
    <ul class="menu-items col-xs-12">
      <div class="title title_font"> <a href="#"> Browse blog posts by categories </a></div><br/>
      @foreach($allcategories as $allcat)
          <?php $slg = \Illuminate\Support\Str::slug($allcat->name, '-') . '-' . $allcat->id; ?>
          <li class="menu-item depth-1 menucol-1-3 ">
            <ul class="submenu">
              <li class="menu-item">
                <div class="title"> <a href="{{ route('blog.categories', ['slug' => $slg]) }}"> {{ $allcat->name }}</a><span>({{ $allcat->posts_count }})</span></div>
              </li>
            </ul>
          </li>
      @endforeach
    </ul>
  </li>
  <li class="mt-root">
    <div class="mt-root-item"><a href="{{ route('contact') }}">
      <div class="title title_font"><span class="title-text">Contact Us</span> </div>
      </a></div>
  </li>
  <li class="mt-root">
    <div class="mt-root-item"><a href="{{ route('about') }}">
      <div class="title title_font"><span class="title-text">about us</span></div>
      </a></div>
  </li>
  <li class="mt-root demo_custom_link_cms">
    <div class="mt-root-item"><a href="#">
      <div class="title title_font"><span class="title-text">&nbsp;</span></div>
      </a>
    </div>
  </li>
</ul>