<div class="block blog-module">
    <div class="sidebar-bar-title">
      <h3>Recent Comments</h3>
    </div>
    <div class="block_content">
      <div class="layered">
        <div class="layered-content">
          <ul class="recent-comment-list">
            @forelse($comments as $cm)
                @if($cm->post->status == "active")
                    <?php
                        $slug = $cm->post->slug . '-' . $cm->post->id;
                        $rt = route('single.post', ['slug' => $slug]);
                    ?>
                    <li>
                      <h5><a href="{{ $rt }}">{{ $cm->post->title }}</a></h5>
                      <div class="comment"> "{!! Illuminate\Support\Str::limit($cm->message, 70) !!}" </div>
                      <div class="author">Posted by <a href="{{ $rt }}">{{ $cm->name }}</a></div>
                    </li>
                @endif
            @empty
                <li><h5 class="entry_title">No comments created yet ...</h5></li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
</div>