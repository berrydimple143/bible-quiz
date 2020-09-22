<footer>
<div class="footer-newsletter">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-7">
        {!! Form::open(['route' => 'subscribe.newsletter', 'method' => 'POST', 'id' => 'newsletter-validate-detail']) !!}
          <h3 class="hidden-sm">Subscribe for newsletter</h3>
          <div class="newsletter-inner">
            <input class="newsletter-email" name='lettermail' id="lettermail" placeholder='Enter Your Email' required />
            <button class="button subscribe" type="submit" title="Subscribe">Subscribe</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-6 col-md-4 col-xs-12 col-lg-3">
      <div class="footer-logo"><a href="{{ route('site') }}"><div id="demo1" class="demo"><h3>Storehouse</h3></div></a> </div>
      <p>You can reach us through the following contact details below:</p>
      <div class="footer-content">
        <div class="email"> <i class="fa fa-envelope"></i>
          <p><a href="mailto:dimplevirgil@gmail.com">dimplevirgil@gmail.com</a></p>
        </div>
        <div class="phone"> <i class="fa fa-phone"></i>
          <p>Phone: (082) 225 3844</p>
        </div>
        <div class="phone"> <i class="fa fa-phone"></i>
          <p>Mobile: +639104374372</p>
        </div>
        <div class="address"> <i class="fa fa-map-marker"></i>
          <p>Davao City, Philippines 8000</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3 col-xs-12 col-lg-3 collapsed-block">
      <div class="footer-links">
        <h3 class="links-title">Menu<a class="expander visible-xs" href="#TabBlock-1">+</a></h3>
        <div class="tabBlock" id="TabBlock-1">
          <ul class="list-links list-unstyled">
            <li><a href="{{ route('site') }}">Home</a></li>
            <li><a href="{{ route('contact') }}">Contact Us</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('blogs') }}">Blogs</a></li>
            <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3 col-xs-12 col-lg-3 collapsed-block">
      <div class="footer-links">
        <h3 class="links-title">Other Pages<a class="expander visible-xs" href="#TabBlock-3">+</a></h3>
        <div class="tabBlock" id="TabBlock-3">
          <ul class="list-links list-unstyled">
            <li> <a href="{{ route('view.sitemap') }}">Sitemap</a></li>
            <li> <a href="{{ route('bible') }}">Bible (KJV)</a></li>
            <li> <a href="{{ route('site') }}">Bible Quiz</a></li>
            <li> <a href="{{ route('login') }}">Login</a></li>
            <li> <a href="{{ route('subscribe') }}">Subscribe</a></li>
            <li> <a href="{{ route('all.categories') }}">All blog categories</a></li>
            <li> <a href="{{ route('all.tags') }}">All tags</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-2 col-xs-12 col-lg-3 collapsed-block">
      <div class="footer-links">
        <h3 class="links-title">Random Blog Categories<a class="expander visible-xs" href="#TabBlock-4">+</a></h3>
        <div class="tabBlock" id="TabBlock-4">
          <ul class="list-links list-unstyled">
            @foreach($othercategories as $other)
                <li><a href="{{ $other->id }}">{{ $other->name }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="footer-coppyright">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-xs-12 coppyright"> Copyright © 2019 <a href="#"> Storehouse </a>. All Rights Reserved. </div>
      <div class="col-sm-6 col-xs-12">
        <div class="payment">
          <ul>
            <li><a href="#"><img title="Visa" alt="Visa" src="{{ asset('front/images/visa.png') }}"></a></li>
            <li><a href="#"><img title="Paypal" alt="Paypal" src="{{ asset('front/images/paypal.png') }}"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</footer>
<a href="#" class="totop"> </a> 