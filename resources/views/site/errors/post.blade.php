@extends('layouts.filtered')
@section('title', $title)
@section('content')
<section class="blog_post">
    <div class="container"> 
      <div class="row">
        <div class="col-xs-12 col-sm-9">
            <div class="entry-detail">
                @if($params == "publishing")
                    <div class="error_pagenotfound"> <strong>O<span id="animate-arrow">o</span>ps</strong> <br />
                        <em>This article is not yet published.</em>
                        <p>Please go back to the list of articles by clicking the button below.</p>
                        <br />
                        <a href="{{ route('site') }}" class="button-back"><i class="fa fa-arrow-circle-left fa-lg"></i>&nbsp; Click here</a> 
                    </div>
                @elseif ($params == "disabled")
                    <div class="error_pagenotfound"> <strong>O<span id="animate-arrow">o</span>ps</strong><br />
                        <em>This article has been disabled by our system administrator</em>
                        <p>
                            Maybe your subscription plan is over. You can still login with your account and renew or upgrade your membership to continue viewing, editing, and/or adding posts.
                            And if you have any questions, comments or suggestions please feel free to reach us through our contact form.
                        </p>
                        <p>Please go back to the list of articles by clicking the button below.</p>
                        <br />
                        <a href="{{ route('site') }}" class="button-back"><i class="fa fa-arrow-circle-left fa-lg"></i>&nbsp; Click here</a> 
                    </div>
                @else
                    <div class="error_pagenotfound"> <strong>O<span id="animate-arrow">o</span>ps</strong><br />
                        <em>This article contains obscene content(s)</em>
                        <p>Our system administrator is still reviewing this one. And if you have any questions, comments or suggestions please feel free to reach us through our contact form.</p>
                        <p>Please go back to the list of articles by clicking the button below.</p>
                        <br />
                        <a href="{{ route('site') }}" class="button-back"><i class="fa fa-arrow-circle-left fa-lg"></i>&nbsp; Click here</a> 
                    </div>
                @endif
            </div>  
        </div>
        @include('partials.front.components.sidebar')
      </div> 
    </div>
</section>
@endsection