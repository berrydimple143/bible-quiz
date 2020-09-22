<div class="single-box">
<h2 class="">Discussion</h2>
<div class="comment-list">
  <ul>
    @forelse($params['chats'] as $cmt)
        <?php
            $pb = new \Carbon\Carbon($cmt->created_at);
            $publ = $pb->toFormattedDateString();
            $av = asset('uploads/profiles/'. $cmt->user->picture);
        ?>
        <li>
          <div class="avartar"> <img src="{{ $av }}" alt="Picture of {{ $cmt->user->firstname }}"> </div>
          <div class="comment-body">
            <div class="comment-meta"> <span class="author"><a href="#">{{ $cmt->user->username }}</a></span> <span class="date">{{ $publ }}</span> </div>
            <div class="comment">{{ $cmt->message }}</div>
          </div>
        </li>
    @empty
        <li><div class="comment">No discussions yet ...</div></li>
    @endforelse
  </ul>
</div>
</div>