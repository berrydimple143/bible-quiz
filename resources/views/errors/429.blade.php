@extends('layouts.error')
@section('title', 'Too Many Requests')
@section('content')
<section class="main-container col1-layout">
  <div class="main container">
    <div class="error-page">
        <div class="container">
          <div class="error_pagenotfound"> <strong>4<span id="animate-arrow">2</span>9 </strong> <br />
            <b>Oops... warning!</b> <em>You have too many requests.</em>
            <p>Try using the button below to go to main page of the site</p>
            <br />
            <a href="{{ route('site') }}" class="button-back"><i class="fa fa-arrow-circle-left fa-lg"></i>&nbsp; Go Home</a> 
          </div>
        </div>
    </div>
  </div>
</section>
@endsection