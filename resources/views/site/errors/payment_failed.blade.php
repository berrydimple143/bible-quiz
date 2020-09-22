@extends('layouts.filtered')
@section('title', $title)
@section('content')
<section class="main-container col1-layout">
  <div class="main container">
    <div class="error-page">
        <div class="container">
          <div class="error_pagenotfound"> <strong>Oo<span id="animate-arrow">p</span>s!! </strong> <br />
            <b>Sorry!</b> <em>There was an error in the payment process.</em>
            <p>Please try going back to the subscription page by clicking the button below, fill-up the form again, check your details carefully  and/or maybe select a different payment method.</p>
            <br />
            <a href="{{ route('subscribe') }}"><button class="button"><i class="fa fa-arrow-left"></i>&nbsp; <span>Back to subscription page</span></button></a>
          </div>
        </div>
    </div>
  </div>
</section>
@endsection