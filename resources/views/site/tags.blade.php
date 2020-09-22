@extends('layouts.front')
@section('title', $title)
@section('content')
<section class="container">
    <div class="sitemap-page">
        @if($alltags->count() > 0)
            <ul class="menu-items col-xs-12">
              <div class="title title_font"><h3>List of all tags in all articles</h3></div><br/>
              <?php $arr = []; ?>
              @foreach($alltags as $tgd)
                  @if(!in_array($tgd->name, $arr))
                      <li class="menu-item depth-1 menucol-1-3" style="list-style: none;">
                        <ul class="submenu">
                          <li class="menu-item" style="list-style: none;">
                            <div class="title"><a href="{{ route('search.tag', ['id' => $tgd->id]) }}"><i class="fa fa-check-square-o"></i> {{ $tgd->name }}</a></div>
                          </li>
                        </ul>
                      </li>
                      <?php $arr[] = $tgd->name; ?>
                  @endif
              @endforeach
            </ul>
        @else 
            <div class="page-title">
              <h2 class="text-center">No tags available yet for all posts.</h2>
            </div>
        @endif
    </div>
    @include('partials.ads.footer')
    <div>&nbsp;</div>
</section>
@endsection