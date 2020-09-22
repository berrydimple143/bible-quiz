<div class="single-box">
<h2 class="">Comments</h2>
<div class="comment-list">
  <ul>
    @forelse($params['pcomments'] as $cmt)
        <?php
            $pb = new \Carbon\Carbon($cmt->created_at);
            $publ = $pb->toFormattedDateString();
            $av = new \YoHang88\LetterAvatar\LetterAvatar($cmt->name, 'circle', 61);
        ?>
        <li>
          <div class="avartar"> <img src="{{ $av }}" alt="Avatar"> </div>
          <div class="comment-body">
            <div class="comment-meta"> <span class="author"><a href="#">{{ $cmt->name }}</a></span> <span class="date">{{ $publ }}</span> </div>
            <div class="comment">{{ $cmt->message }}</div>
          </div>
        </li>
    @empty
        <li><div class="comment">No comments yet ...</div></li>
    @endforelse
  </ul>
</div>
</div>