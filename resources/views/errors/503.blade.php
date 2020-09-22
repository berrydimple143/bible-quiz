@extends('layouts.error')
@section('title', 'Service Unavailable')
@section('content')
<section class="main-container col1-layout">
  <div class="main container">
    <div class="error-page">
        <div class="container">
          <div class="error_pagenotfound"> <strong>5<span id="animate-arrow">0</span>3 </strong> <br />
            <b>Oops... Service Unavailable!</b> <em>Sorry! The service you're looking for is unavailable.</em>
            <p>Try using the button below to go to main page of the site</p>
            <br />
            <a href="{{ route('site') }}" class="button-back"><i class="fa fa-arrow-circle-left fa-lg"></i>&nbsp; Go Home</a> 
          </div>
        </div>
    </div>
  </div>
</section>
@endsection