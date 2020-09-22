@extends('layouts.front')
@section('title', $title)
@section('content')
<section class="container">
    <div class="sitemap-page">
        <div class="page-title">
          <h2 class="text-center">List of All Blog Categories with number of blog posts</h2>
        </div>
        <div class="col-xs-24 col-sm-12 col-md-12 col-lg-12">&nbsp;</div>
          <?php
            $cntr = ($allcategories->count() / 4) + 2;
            $i = 1;
          ?>
          <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
            <ul class="simple-list arrow-list bold-list">
             @foreach($allcategories as $cat)
                <?php $slg = \Illuminate\Support\Str::slug($cat->name, '-') . '-' . $cat->id; ?>
                @if($i <= $cntr)
                    <li><i class="fa fa-check-square-o"></i> <a href="{{ route('blog.categories', ['slug' => $slg]) }}">{{ $cat->name }}</a>&nbsp;<span>({{ $cat->posts_count }})</span></li>
                    <?php $k = $i; ?>
                @endif
                <?php $i++; ?>
             @endforeach
            </ul>
          </div>
          <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
            <ul class="simple-list arrow-list bold-list">
             <?php $i= 1; ?>
             @foreach($allcategories as $cat)
                <?php $slg = \Illuminate\Support\Str::slug($cat->name, '-') . '-' . $cat->id; ?>
                @if($i > $k && $i < ($cntr * 2))
                    <li><i class="fa fa-check-square-o"></i> <a href="{{ route('blog.categories', ['slug' => $slg]) }}">{{ $cat->name }}</a>&nbsp;<span>({{ $cat->posts_count }})</span></li>
                    <?php $n = $i; ?>
                @endif
                <?php $i++; ?>
             @endforeach
            </ul>
          </div>
          <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
            <ul class="simple-list arrow-list bold-list">
             <?php $i = 1; ?>
             @foreach($allcategories as $cat)
                <?php $slg = \Illuminate\Support\Str::slug($cat->name, '-') . '-' . $cat->id; ?>
                @if($i > $n && $i < ($cntr * 3))
                    <li><i class="fa fa-check-square-o"></i> <a href="{{ route('blog.categories', ['slug' => $slg]) }}">{{ $cat->name }}</a>&nbsp;<span>({{ $cat->posts_count }})</span></li>
                    <?php $p = $i; ?>
                @endif
                <?php $i++; ?>
             @endforeach
            </ul>
          </div>
          <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
            <ul class="simple-list arrow-list bold-list">
             <?php $i = 1; ?>
             @foreach($allcategories as $cat)
                <?php $slg = \Illuminate\Support\Str::slug($cat->name, '-') . '-' . $cat->id; ?>
                @if($i > $p)
                    <li><i class="fa fa-check-square-o"></i> <a href="{{ route('blog.categories', ['slug' => $slg]) }}">{{ $cat->name }}</a>&nbsp;<span>({{ $cat->posts_count }})</span></li>
                @endif
                <?php $i++; ?>
             @endforeach
            </ul>
          </div>
    </div>
    <div>&nbsp;</div>
</section>
@endsection