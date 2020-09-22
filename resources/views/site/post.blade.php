@extends('layouts.front')
@section('title', $title)
@section('content')
<section class="blog_post">
    <div class="container"> 
      <div class="row">
        <div class="col-xs-12 col-sm-9">
            <div class="entry-detail">
                <div class="page-title">
                  <h1>{{ $model->title }}</h1>
                </div>
                <div class="entry-photo">
                  @if($params['img'] != "")
                    <figure><img src="{{ $params['img'] }}" width="700" height="300" alt="{{ $model->title }}"></figure>
                  @endif
                </div>
                <div class="entry-meta-data"> <span class="author"> <i class="fa fa-user"></i>&nbsp; Author: <a href="#">{{ $model->author }}</a></span> <span class="cat"> <i class="fa fa-folder"></i>&nbsp; <a href="#">{{ $model->category->name }}</a></span> <span class="comment-count"> <i class="fa fa-comment"></i>&nbsp; {{ $model->comments_count }} </span> <span class="date"><i class="fa fa-calendar">&nbsp;</i>&nbsp; {{ $params['pub'] }}</span>
                  <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>&nbsp; <span>(5 votes)</span></div>
                </div>
                <div class="content-text clearfix">
                    {!! $params['body'] !!}
                </div>
                <div class="entry-tags"> <span>Tags:</span>
                    <?php $t = 0; ?>
                    @forelse($model->tagNames() as $tg)
                        <?php $tag = Conner\Tagging\Model\Tag::where('name', $tg)->first(); ?>
                        @if($t < count($model->tagNames()) - 1)
                            <a href="{{ route('search.tag', ['id' => $tag->id]) }}">{{ $tg }}, </a>
                        @else
                            <a href="{{ route('search.tag', ['id' => $tag->id]) }}">{{ $tg }}</a>
                        @endif
                        <?php $t++; ?>
                    @empty
                        <em>This post has not been tagged yet.</em>
                    @endforelse
                </div>
            </div>  
            @include('partials.front.components.comment_list')
            @include('partials.front.components.comment_form')
            @include('partials.ads.footer')
        </div>
        @include('partials.front.components.sidebar')
      </div> 
    </div>
</section>
@endsection