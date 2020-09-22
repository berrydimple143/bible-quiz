@extends('layouts.filtered')
@section('title', $title)
@section('content')
<section class="main-container col1-layout">
  <div class="main container">
    <div class="error-page">
        <div class="container">
          <div class="error_pagenotfound"> <strong>Th<span id="animate-arrow">an</span>ks </strong> <br />
            <b>Congratulations!</b> <em>Your free trial subscription has been approved.</em>
            <p>You can now create {{ $params->article }} blog post and upload {{ $params->image }} image for use.</p>
            <p>Note: Your account will expire until 2 days.</p>
            <br />
            <a href="{{ route('login') }}" class="button-back"><i class="fa fa-arrow-circle-right fa-lg"></i>&nbsp; Login to your account now</a> 
          </div>
        </div>
    </div>
   </div>
</section>
@endsection