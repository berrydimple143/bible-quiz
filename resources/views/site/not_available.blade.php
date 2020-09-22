@extends('layouts.filtered')
@section('title', $title)
@section('content')
<section class="main-container col1-layout">
    <div class="main container">
        <div class="error-page">
            <div class="container">
              <div class="error_pagenotfound"> <strong>Not <span id="animate-arrow">A</span>vailable </strong><br />
                <em>Sorry for the inconvenience! This feature is not yet available.</em>
                <p>Please bear with us. Thank you.</p>
                <br />
                <a href="{{ route('site') }}" class="button-back"><i class="fa fa-arrow-circle-right fa-lg"></i>&nbsp; Go home</a> </div>
            </div>
        </div>
    </div>
</section>
@endsection