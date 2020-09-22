@extends('layouts.games')
@section('title', $title)
@section('content')
<section class="main-container col1-layout">
  <div class="main container">
  <div class="page-content">
    <div class="account-login">
        <div class="col-md-3 col-sm-2"></div>
        <div class="col-md-6 col-sm-8">
                <div class="row">
                  {!! Form::open(['route' => 'register.player', 'method' => 'POST', 'files' => true, 'id' => 'payment-form']) !!}
                  <center>
                      <div class="col-xs-12">
                        <div class="check-title">
                          <h2 class="text-green">New Player Registration Form</h2>
                        </div>
                      </div>
                  </center>
                  <div class="col-xs-12">&nbsp;</div>
                  <div class="col-sm-6">
                    <label for="firstname">First Name <span class="required">*</span></label>
                    <div class="input-text">
                      {{ Form::text('firstname', null, ['class' => 'form-control', 'id' => 'firstname', 'required']) }}
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <label for="lastname">Last Name <span class="required">*</span></label>
                    <div class="input-text">
                      {{ Form::text('lastname', null, ['class' => 'form-control', 'id' => 'lastname', 'required']) }}
                    </div>
                  </div>
                  <div class="col-xs-12">&nbsp;</div>
                  <div class="col-sm-6">
                    <label for="email">Email <span class="required">*</span></label>
                    <div class="input-text">
                      {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'required']) }}
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <label for="username">Username <span class="required">*</span></label>
                    <div class="input-text">
                      {{ Form::text('username', null, ['class' => 'form-control', 'id' => 'username', 'required']) }}
                    </div>
                  </div>
                  <div class="col-xs-12">&nbsp;</div>
                  <div class="col-sm-6">
                    <label for="password">Password <span class="required">*</span></label>
                    <div class="input-text">
                      <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
                    <div class="input-text">
                      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-xs-12">&nbsp;</div>
                  <div class="col-xs-12">
                      <label for="password_confirmation">Profile Picture</label>
                      <div class="input-text">
                          {{ Form::file('picture') }}
                      </div>
                  </div>
                  <div class="col-xs-12">&nbsp;</div>
                  <div class="col-xs-12"><hr width="100%"></div>
                  <div class="col-xs-6">
                    <div class="submit-text">
                        <button type="submit" class="button"><i class="fa fa-send"></i>&nbsp; <span>Register Now</span></button>
                    </div>
                  </div>
                  {!! Form::close() !!}
                  <div class="col-xs-6">
                    <div class="submit-text">
                      <a href="{{ route('bible.quiz') }}"><button class="button"><i class="fa fa-arrow-left"></i>&nbsp; <span>Back to the quiz</span></button></a>
                    </div>
                  </div>
                </div>
          </div>
    </div>
  </div>
 </div>
</section>
@endsection