@extends('layouts.error')
@section('title', 'Page Expired')
@section('content')
<section class="main-container col1-layout">
  <div class="main container">
    <div class="error-page">
        <div class="container">
          <div class="error_pagenotfound"> <strong>4<span id="animate-arrow">1</span>9 </strong> <br />
            <b>Oops... Page is Expired!</b> <em>What took you so long?</em>
            <p>Try using the button below to go to main page of the site</p>
            <br />
            <a href="{{ route('site') }}" class="button-back"><i class="fa fa-arrow-circle-left fa-lg"></i>&nbsp; Go Home</a> 
          </div>
        </div>
    </div>
  </div>
</section>
@endsection