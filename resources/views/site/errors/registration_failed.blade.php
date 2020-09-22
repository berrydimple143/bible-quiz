@extends('layouts.filtered')
@section('title', $title)
@section('content')
<section class="main-container col1-layout">
  <div class="main container">
    <div class="error-page">
        <div class="container">
          <div class="error_pagenotfound"> <strong>Oo<span id="animate-arrow">p</span>s!! </strong> <br />
            <b>Sorry {{ $params }}!</b> <em>You can't select a free subscription again.</em>
            <p>Please try going back to the subscription page by clicking the button below and choose a different subscription.</p>
            <br/>
            <a href="{{ route('subscribe') }}"><button class="button"><i class="fa fa-arrow-left"></i>&nbsp; <span>Back to subscription page</span></button></a>
          </div>
        </div>
    </div>
  </div>
</section>
@endsection