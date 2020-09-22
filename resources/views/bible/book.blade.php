<?php
    $vcount = (int)$params['verse_count'];
    $ccount = (int)$params['chapter_count'];
    $book = $params['book'];
?>
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
                      <h3 class="text-center"><i class="fa fa-book"></i>&nbsp;King James Version Bible&nbsp;<i class="fa fa-book"></i></h3>
                      <form class="form-inline">
                          <div class="form-group">
                            <div id="search">
                                <div class="input-group">
                                    <select class="cate-dropdown" id="book_name" name="book_name">
                                      <option value="{{ $book }}">{{ $book }}</option>
                                      @foreach($params['books'] as $bk)
                                        @if($bk != $book)
                                            <option value="{{ str_replace(' ', '', $bk) }}">&nbsp;{{ $bk }}</option>
                                        @endif
                                      @endforeach
                                    </select>
                                    <button class="btn-search" id="btn-search" type="button">Book</button>
                                </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div id="search">
                                <div class="input-group">
                                    <select class="cate-dropdown" id="chapter" name="chapter" style="width: 70px;">
                                      <option value="{{ $params['chapter'] }}">{{ $params['chapter'] }}</option>
                                      @for($j = 1; $j <= $ccount; $j++)
                                        @if($j != $params['chapter'])
                                            <option value="{{ $j }}">&nbsp;{{ $j }}</option>
                                        @endif
                                      @endfor
                                    </select>
                                    <button class="btn-search" id="btn-search" type="button">Chapter</button>
                                </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div id="search">
                                <div class="input-group">
                                    <select class="cate-dropdown" id="verse" name="verse" style="width: 70px;">
                                      <option value="{{ $params['verse'] }}">{{ $params['verse'] }}</option>
                                      @for($i = 1; $i <= $vcount; $i++)
                                        @if($i != $params['verse'])
                                            <option value="{{ $i }}">&nbsp;{{ $i }}</option>
                                        @endif
                                      @endfor
                                    </select>
                                    <button class="btn-search" id="btn-search" type="button">Verse</button>
                                </div>
                              </div>
                          </div>
                          <button type="button" class="button" id="search-passage"><i class="fa fa-search"></i>&nbsp; <span>Search</span></button>
                      </form>
                      <br/><br/>
                      <ul class="menu-items col-xs-12">
                          @foreach($model['verses'] as $vrs)
                            <?php $ptitle = App\Http\Controllers\FunctionController::getTopic($book, $params['chapter'], $vrs['verse']); ?>
                            @if($ptitle != "")
                                <li style="list-style: none; text-align: center;"><h1>{{ $ptitle }}<h1></li>
                            @endif
                            @if($vrs['text'] == $params['found_verse'])
                                <li style="list-style: none; padding: 5px; background-color: green; color: white; font-size: 12pt; font-weight: bold;">{{ $params['short'] }}&nbsp;{{ $params['chapter'] }}:{{ $vrs['verse'] }}&nbsp;{{ $vrs['text'] }}</li>
                            @else
                                <li style="list-style: none; padding: 3px;"><b>{{ $params['short'] }}&nbsp;{{ $params['chapter'] }}:{{ $vrs['verse'] }}</b>&nbsp;{{ $vrs['text'] }}</li>
                            @endif
                          @endforeach
                      </ul>
                </div>
            </div>
            @include('partials.ads.footer')
        </div>
        @include('partials.front.components.bible_sidebar')
      </div> 
    </div>
</section>
@endsection