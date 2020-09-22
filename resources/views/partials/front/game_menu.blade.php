<ul>
  <li class="mt-root">
    <div class="mt-root-item"><a href="{{ route('site') }}">
      <div class="title title_font"><span class="title-text">Home</span> </div>
      </a></div>
  </li>
  <li class="mt-root">
    <div class="mt-root-item"><a href="{{ route('bible') }}">
      <div class="title title_font"><span class="title-text">Bible</span> </div>
      </a></div>
  </li>
  <li class="mt-root">
    <div class="mt-root-item"><a href="#">
      <div class="title title_font"><span class="title-text">Game Categories</span></div>
      </a>
    </div>
    <ul class="menu-items col-xs-12">
      <div class="title title_font"> <a href="#"> Select quiz by categories </a></div><br/>
      @foreach($params['menu'] as $key => $value)
          <?php
            $label = $value . " questions";
            if($value == 1 or $value == '1') {
                $label = $value . " question";
            }
            $cat = str_replace(" ", "@@@", $key);
          ?>
          <li class="menu-item depth-1 menucol-1-3 ">
            <ul class="submenu">
              <li class="menu-item">
                <div class="title"><a href="{{ route('select.quiz.category', ['level' => $params['qztype'], 'items' => $params['item_count'], 'qcategory' => $cat]) }}"> {{ $key }} <span>({{ $label }})</span></a></div>
              </li>
            </ul>
          </li>
      @endforeach
    </ul>
  </li>
  <li class="mt-root demo_custom_link_cms">
    <div class="mt-root-item"><a href="#">
      <div class="title title_font"><span class="title-text">&nbsp;</span></div>
      </a>
    </div>
  </li>
</ul>