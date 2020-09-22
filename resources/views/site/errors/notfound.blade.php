@extends('layouts.filtered')
@section('title', $title)
@section('content')
<section class="blog_post">
    <div class="container"> 
      <div class="row">
        <div class="col-xs-12 col-sm-9">
            <div class="entry-detail">
                <div class="error_pagenotfound"> <strong>O<span id="animate-arrow">o</span>ps</strong> <br />
                    <em>A category you've selected has no articles yet.</em>
                    <p>Please choose a category that has already articles in it. And if you've selected a category with articles and you still see this page 
                        maybe those articles were disabled by the administrator due to some valid reasons.</p>
                    <br />
                    <a href="{{ route('site') }}" class="button-back"><i class="fa fa-arrow-circle-left fa-lg"></i>&nbsp; Go back</a> 
                </div>
            </div>  
        </div>
        @include('partials.front.components.sidebar')
      </div> 
    </div>
</section>
@endsection