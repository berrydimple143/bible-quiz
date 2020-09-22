@extends('layouts.front')
@section('title', $title)
@section('content')
    <section class="blog_post">
    <div class="container"> 
      <div class="row">
        <div class="col-xs-12 col-sm-9" id="center_column">
          @include('partials.ads.header')
          <div class="center_column">
            <div class="page-title">
              <h2>Latest Blog posts</h2>
            </div>
            <ul class="blog-posts">
                  @forelse($model as $pst)
                    <?php
                        $pb = new \Carbon\Carbon($pst->date_posted);
                        $pub = $pb->toFormattedDateString();
                        $img = asset('front/images/blog-img1.jpg');
                        $filename = "";
                        if($pst->photo != "") {
                            $img = asset('uploads/photos/'.$pst->photo);
                            $filename = $pst->photo;
                        }
                        $slug = $pst->slug . '-' . $pst->id;
                        $rt = route('single.post', ['slug' => $slug]);
                        $bdy = App\Http\Controllers\FunctionController::cleanBody($pst->body, 50);
                    ?>
                      <li class="post-item">
                        <article class="entry">
                          <div class="row">
                            <div class="col-sm-5">
                              <div class="entry-thumb image-hover2"> <a href="{{ $rt }}">
                                <figure><img src="{{ $img }}" alt="{{ $pst->title }}"></figure>
                                </a> </div>
                            </div>
                            <div class="col-sm-7">
                              <h3 class="entry-title"><a href="{{ $rt }}">{{ $pst->title }}</a></h3>
                              <div class="entry-meta-data"> <span class="author"> <i class="fa fa-user"></i>&nbsp; by: <a href="#">{{ $pst->author }}</a></span> <span class="cat"> <i class="fa fa-folder"></i>&nbsp; <a href="#">{{ $pst->category->name }}</a></span> <span class="comment-count"> <i class="fa fa-comment"></i>&nbsp; {{ $pst->comments_count }} </span> <span class="date"><i class="fa fa-calendar"></i>&nbsp; {{ $pub }}</span> </div>
                              <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>&nbsp; <span>(5 votes)</span></div>
                              <div class="entry-excerpt">{{ $bdy }}</div>
                              <a href="{{ $rt }}" class="button read-more">Read more&nbsp; <i class="fa fa-angle-double-right"></i></a> 
                             </div>
                          </div>
                        </article>
                      </li>
                  @empty
                    <li class="post-item"><h2>No articles ever published yet.</h2></li>
                  @endforelse
            </ul>
            <div class="sortPagiBar">
              <div class="pagination-area " style="visibility: visible;">
                {!! $post_paginator !!}
              </div>
            </div>
          </div>
          @include('partials.ads.footer')
        </div>
        @include('partials.front.components.sidebar')
      </div> 
    </div>
  </section>
@endsection