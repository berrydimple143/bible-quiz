@extends('layouts.error')
@section('title', 'Unauthorized')
@section('content')
<section class="main-container col1-layout">
  <div class="main container">
    <div class="error-page">
        <div class="container">
          <div class="error_pagenotfound"> <strong>4<span id="animate-arrow">0</span>1 </strong> <br />
            <b>Oops... Unauthorized!</b> <em>You are not authorized to go on.</em>
            <p>Try using the button below to go to main page of the site</p>
            <br />
            <a href="{{ route('site') }}" class="button-back"><i class="fa fa-arrow-circle-left fa-lg"></i>&nbsp; Go Home</a> 
          </div>
        </div>
    </div>
  </div>
</section>
@endsection