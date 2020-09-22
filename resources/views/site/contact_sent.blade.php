@extends('layouts.filtered')
@section('title', $title)
@section('content')
<section class="main-container col1-layout">
    <div class="main container">
        <div class="error-page">
            <div class="container">
              <div class="error_pagenotfound"> <strong>Th<span id="animate-arrow">an</span>ks </strong> <br />
                <em>We're so glad that you've let us know.</em>
                <p>We'll respond to you as quickly as possible.</p>
                <br />
                <a href="{{ route('site') }}" class="button-back"><i class="fa fa-arrow-circle-right fa-lg"></i>&nbsp; Go home</a> </div>
            </div>
        </div>
    </div>
</section>
@endsection