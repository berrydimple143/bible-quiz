@extends('layouts.front')
@section('title', $title)
@section('content')
<section class="container">
    <div class="sitemap-page">
        @if(count($params) > 0)
            <ul class="menu-items col-xs-12">
              <div class="title title_font"><center><h3>Sitemap of Online Storehouse</h3></center></div><br/>
              <?php $arr = []; ?>
              @foreach($params as $map)
                  @if(!in_array($map['loc'], $arr))
                      <?php
                            $lnk = $map['loc'];
                            $mptxt = "";
                            if($lnk == "http://onlinestorehouse.com" or $lnk == "http://onlinestorehouse.com/") {
                                $mptxt = "Home";
                            } else {
                                $mptxt = str_replace("http://onlinestorehouse.com/", "", $lnk);
                                $mptxt = str_replace("/", " ", $mptxt);
                                $mptxt = str_replace("-", " ", $mptxt);
                            }
                            $lnk = str_replace("http", "https", $lnk);
                      ?>
                      <li class="menu-item depth-1 menucol-1-3" style="list-style: none;">
                        <ul class="submenu">
                          <li class="menu-item" style="list-style: none;">
                            <div class="title"><a href="{{ $lnk }}"><i class="fa fa-check-square-o"></i> {{ $mptxt }}</a></div>
                          </li>
                        </ul>
                      </li>
                      <?php $arr[] = $map['loc']; ?>
                  @endif
              @endforeach
            </ul>
        @else 
            <div class="page-title">
              <h2 class="text-center">No sitemap yet.</h2>
            </div>
        @endif
    </div>
    <div>&nbsp;</div>
</section>
@endsection