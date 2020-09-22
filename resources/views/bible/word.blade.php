@extends('layouts.games')
@section('title', $title)
@section('content')
<section class="blog_post">
    <div class="container"> 
      <div class="row">
        <div class="col-xs-12 col-sm-9">
            @include('partials.ads.header')
            <div class="entry-detail">
                <div class="content-text clearfix">
                      <h3 class="text-center">Search result for the word "{{ $params['word'] }}" in the Bible</h3>
                      <center>
                      <form class="form-inline">
                          <div class="form-group">
                            <div id="search">
                                <div class="input-group">
                                    <input type="text" name="keyword_search" id="keyword_search" style="padding: 10px; width: 400px;" placeholder="Type any words to search here ...">
                                    <button class="btn-search" id="search-word" type="button"><i class="fa fa-search"></i> Find</button>
                                </div>
                            </div>
                          </div>
                      </form>
                      </center>
                      <br/><br/>
                      <ul class="menu-items col-xs-12">
                          @if($params['word_counter'] > 0)
                              @foreach($model as $vrs)
                                <?php 
                                    $wd = $params['word'];
                                    $rp = '<mark>' . $wd . '</mark>';
                                    $wrd = str_replace($wd, $rp, $vrs); 
                                ?>
                                <li style="list-style: none; padding: 3px;">{!! $wrd !!}</li>
                              @endforeach
                          @else
                            <li style="list-style: none; padding: 3px;">The word you are looking for cannot be found in this version of the Bible ...</li>
                          @endif
                      </ul>
                </div>
            </div>
            @include('partials.ads.footer')
        </div>
        <aside class="sidebar col-xs-12 col-sm-3"> 
          <div class="block blog-module">
            <div class="sidebar-bar-title">
              <h3>Word Information</h3>
            </div>
            <div class="block_content"> 
              <div class="layered">
                <div class="layered-content">
                    <p><b>Old Testament Occurence:</b> <span class="badge badge-green">{{ $params['otcount'] }} times</span></p>
                    <p><b>New Testament Occurence:</b> <span class="badge badge-green">{{ $params['ntcount'] }} times</span></p>
                </div>
              </div>
            </div>
          </div>
          @include('partials.ads.sidebar')
        </aside>
      </div> 
    </div>
</section>
@endsection