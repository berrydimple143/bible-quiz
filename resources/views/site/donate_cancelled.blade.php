@extends('layouts.filtered')
@section('title', $title)
@section('content')
<section class="main-container col1-layout">
  <div class="main container">
    <div class="error-page">
        <div class="container">
          <div class="error_pagenotfound"> <strong>Th<span id="animate-arrow">an</span>ks </strong> <br />
            <b>We appreciate your attempt to give for the ministry of our Lord.</b>
            <p>We are hoping that you'll find this mission very helpful for the furtherance of the Kingdom of God.</p>
            <br />
            <a href="{{ route('site') }}" class="button-back"><i class="fa fa-arrow-circle-right fa-lg"></i>&nbsp; Go back home</a> </div>
        </div>
    </div>
   </div>
</section>
@endsection