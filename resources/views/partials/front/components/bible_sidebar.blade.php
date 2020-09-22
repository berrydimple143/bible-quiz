<?php
    $fvr = $params['found_verse'];
    $words = App\Http\Controllers\FunctionController::get_word_counts($fvr);
    $longest = App\Http\Controllers\FunctionController::longest_word($fvr);
    $cntr = 0;
?>
<aside class="sidebar col-xs-12 col-sm-3"> 
  <div class="block blog-module">
    <div class="sidebar-bar-title">
      <h3>Search Verse By Topic</h3>
    </div>
    <div class="block_content"> 
      <div class="layered">
        <div class="layered-content">
            <div id="search">
                <form class="search-topic-form">
                  <div class="input-group">
                    <select class="cate-dropdown" id="topic" name="topic" required>
                      <option value="">Select a topic</option>
                      @foreach($params['topics'] as $topic)
                        <?php $sn = App\Http\Controllers\FunctionController::getShortName($topic->book); ?>
                        <option value="{{ $topic->id }}">{{ $topic->title }} ({{ $sn }} {{ $topic->chapter }}:{{ $topic->verse }})</option>
                      @endforeach
                    </select>
                    <button class="btn-search" id="search-topic" type="button">Go</button>
                  </div>
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>
  <div class="block blog-module">
    <div class="sidebar-bar-title">
      <h3>Search Verses By Word</h3>
    </div>
    <div class="block_content"> 
      <div class="layered">
        <div class="layered-content">
            <div id="search">
                <form class="search-word-form">
                  <div class="input-group">
                    <input type="text" name="keyword_search" id="keyword_search" style="padding: 10px;" placeholder="Type any words ...">
                    <button class="btn-search" id="search-word" type="button">Go</button>
                  </div>
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>
  <div class="block blog-module">
    <div class="sidebar-bar-title">
      <h3>Verse Of the day</h3>
    </div>
    <div class="block_content"> 
      <div class="layered">
        <div class="layered-content">
            <blockquote>
                {!! $params['VOD'] !!}
            </blockquote>
        </div>
      </div>
    </div>
  </div>
  <div class="block blog-module">
    <div class="sidebar-bar-title">
      <h3>Verse Information</h3>
    </div>
    <div class="block_content"> 
      <div class="layered">
        <div class="layered-content">
            <p><b>Number of Words:</b> <span class="badge badge-green">{{ str_word_count($fvr) }}</span></p>
            <p><b>Longest Word:</b> {{ ucfirst($longest) }}</p>
            <p><b>Repeated Words:</b></p>
            <ul>
            @foreach($words as $key => $value)
                @if($value > 1)
                    <li>{{ strtoupper($key) }} - {{ $value }} times</li>
                    <?php $cntr++; ?>
                @endif
            @endforeach
            </ul>
            @if($cntr < 1)
                <p>None</p>
            @endif
        </div>
      </div>
    </div>
  </div>
  @include('partials.front.components.paypal_donation')
  @include('partials.ads.sidebar')
</aside>