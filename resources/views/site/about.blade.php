@extends('layouts.front')
@section('title', $title)
@section('content')
<div class="main container">
    <div class="about-page">
        <div class="col-xs-12 col-sm-6">           
          <h1>Our <span class="text_color">Tasks</span></h1>
          <p align="justify">We provide a very easy-to-use blogging system among all other systems available on the internet nowadays.  
            We eliminate factors or features that lead to confusion and rather focus on providing essential tools a blogger or anyone really needed.
            When we blog, we do this for many reasons. Among these are expressing ourselves and sharing our passions, making a difference, sharing our knowledge,
            refining our writing skills, we do it for business purposes, building our professional networks, online presence or exposure, becoming an authority in our industries,
            building our online portfolios, etc.</p>
            <p><strong>How can we do these things? Here are the great features that we know people all around the world will surely love:</strong></p>
          <ul>
            <li><i class="fa fa-arrow-right"></i>  <a href="#">Feature that focuses solely on blog creation, editing and deleting.</a></li>
            <li><i class="fa fa-arrow-right"></i>  <a href="#">Feature that deals on uploading images, editing and deleting.</a></li>
            <li><i class="fa fa-arrow-right"></i>  <a href="#">SEO optimized blog posts/articles. No hassle on your part.</a></li>
            <li><i class="fa fa-arrow-right"></i>  <a href="{{ route('subscribe') }}">All these stuffs at a very affordable price.</a></li>
          </ul>
          <p>&nbsp;</p>
          <p align="justify">On the side we are also a provider of different Bible tools and entertainments.</p>
        </div>
        <div class="col-xs-12 col-sm-6">
          <div class="single-img-add sidebar-add-slider">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
              
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active"> <img src="{{ asset('front/images/about_slider/about1.jpg') }}" alt="slide1"> </div>
                <div class="item"> <img src="{{ asset('front/images/about_slider/about2.jpg') }}" alt="slide2"> </div>
                <div class="item"> <img src="{{ asset('front/images/about_slider/about3.jpg') }}" alt="slide3"> </div>
                <div class="item"> <img src="{{ asset('front/images/about_slider/about4.jpg') }}" alt="slide4"> </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection