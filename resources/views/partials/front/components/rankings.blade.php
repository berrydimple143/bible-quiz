<div class="table-responsive">
    <table class="table table-bordered cart_summary">
      <thead>
        <tr>
          <th>Username</th>
          <th>Score</th>
        </tr>
      </thead>
      <tbody>
        @forelse($params['rankings'] as $rank)
        <tr>
          <td class="price"><span>{{ $rank->user->username }}</span></td>
          <td class="availability in-stock"><span class="label">{{ $rank->score }}</span></td>
        </tr>
        @empty
            <tr><td colspan="2">No rankings yet for this level ...</td></tr>
        @endforelse
      </tbody>
    </table>
</div>