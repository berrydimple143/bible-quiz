@extends('layouts.filtered')
@section('title', $title)
@section('content')
<section class="main-container col1-layout">
  <div class="main container">
    <div class="error-page">
        <div class="container">
          <div class="error_pagenotfound"> <strong>Th<span id="animate-arrow">an</span>ks </strong> <br />
            <b>We greatly appreciate your kindness and generousity to the ministry of our Lord.</b>
            <p>Expect more blessings from our loving God to come to you:</p>
            <blockquote>
                Give, and it shall be given unto you; good measure, pressed down, and shaken together, and running over, shall men give into your bosom. For with the same measure that ye mete withal it shall be measured to you again. 
                <b>Luke 6:38</b>
            </blockquote>
            <br />
            <a href="{{ route('site') }}" class="button-back"><i class="fa fa-arrow-circle-right fa-lg"></i>&nbsp; Go back home</a> </div>
        </div>
    </div>
   </div>
</section>
@endsection