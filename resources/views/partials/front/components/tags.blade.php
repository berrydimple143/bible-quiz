<div class="popular-tags-area block">
<div class="sidebar-bar-title">
  <h3>Popular Tags</h3>
</div>
<div class="tag">
  @if($tags->count() > 0)
  <ul>
    @foreach($tags as $tg)
        <li><a href="{{ route('search.tag', ['id' => $tg->id]) }}">{{ $tg->name }}</a></li>
    @endforeach
    <li><a href="{{ route('all.tags') }}">View All Tags</a></li>
  </ul>
  @else 
    <p>No tags yet..</p>
  @endif
</div>
</div>