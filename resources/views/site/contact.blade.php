@extends('layouts.filtered')
@section('title', $title)
@section('content')
<section class="main-container col1-layout">
  <div class="main container">
    <div class="row">
        <section class="col-main col-sm-12">
          <div id="contact" class="page-content page-contact">
              <div class="page-title">
                <h2>Contact Us</h2>
              </div>
            <div id="message-box-contact">We're always available for you</div>
            <div class="row">
              <div class="col-xs-12 col-sm-6" id="contact_form_map">
                <h3 class="page-subheading">Let's get in touch</h3>
                <p>
                    Please don't hesitate to contact us either by filling up the form provided at the right side of this page or just sending 
                    us an email through the details provided below. You can also call us directly at our landline or mobile number.
                </p>
                <br/>
                <h4>Fill-up Form Instructions</h4>
                <ul>
                    <li>Red asterisk (*) means this field is required</li>
                    <li>Fill-up valid inputs such as email, etc.</li>
                    <li>Note: Some fields have minimum and maximum length</li>
                </ul>
                <br/>
                <ul class="store_info">
                  <li><i class="fa fa-home"></i>Davao City, Philippines 8000</li>
                  <li><i class="fa fa-phone"></i><span>+ 63 910 437 4372</span></li>
                  <li><i class="fa fa-fax"></i><span>(082) 225 3844</span></li>
                  <li><i class="fa fa-envelope"></i>Email: <span><a href="mailto:dimplevirgil@gmail.com">dimplevirgil@gmail.com</a></span></li>
                </ul>
              </div>
              <div class="col-sm-6">
                <h3 class="page-subheading">Drop us an email</h3>
                {!! Form::open(['route' => 'contact.send', 'method' => 'POST', 'id' => 'contact-form']) !!}
                <div class="contact-form-box">
                  <div class="form-selector">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control input-sm" id="name" name="name" required />
                  </div>
                  <div class="form-selector">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control input-sm" id="email" name="email" required />
                  </div>
                  <div class="form-selector">
                    <label>Phone / Mobile (Optional)</label>
                    <input type="text" class="form-control input-sm" id="phone" name="phone" />
                  </div>
                  <div class="form-selector">
                    <label>Message <span class="text-danger">*</span></label>
                    <textarea class="form-control input-sm" rows="10" id="message" name="message" required></textarea>
                  </div>
                  <div class="form-selector">
                    <button type="submit" class="button"><i class="fa fa-send"></i>&nbsp; <span>Send Message</span></button>
                    &nbsp; <button class="button" id="clear-cf"><i class="fa fa-clear"></i>&nbsp; <span>Clear</span></button>
                </div>
                {!! Form::close() !!}
              </div>
            </div>
          </div>
          </div>
        </section>
    </div>
  </div>
</section>
@endsection