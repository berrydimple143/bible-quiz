  <div class="block blog-module">
    <div class="sidebar-bar-title">
      <h3>Popular Posts</h3>
    </div>
    <div class="block_content"> 
      <div class="layered">
        <div class="layered-content">
          <ul class="blog-list-sidebar">
            @if($populars->count() > 0)
                @foreach($populars as $pop)
                <?php
                    $pb = new \Carbon\Carbon($pop->date_posted);
                    $pub = $pb->toFormattedDateString();
                    $img = asset('front/images/blog-img1.jpg');
                    if($pop->photo != "") {
                        $img = asset('uploads/photos/'.$pop->photo);
                    }
                    $slug = $pop->slug . '-' . $pop->id;
                    $rt = route('single.post', ['slug' => $slug]);
                ?>
                <li>
                  <div class="post-thumb"> <a href="{{ $rt }}"><img src="{{ $img }}" class="img-responsive" alt="Blog"></a> </div>
                  <div class="post-info">
                    <h5 class="entry_title"><a href="{{ $rt }}">{{ $pop->title }}</a></h5>
                    <div class="post-meta"> <span class="date"><i class="fa fa-calendar"></i> {{ $pub }}</span> &nbsp;<span class="comment-count"> <i class="fa fa-comment-o"></i> {{ $pop->comments_count }} </span> </div>
                  </div>
                </li>
                @endforeach
            @else
                <li><h5 class="entry_title">No popular posts yet ...</h5></li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div>