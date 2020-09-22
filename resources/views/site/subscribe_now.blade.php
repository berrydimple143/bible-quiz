@extends('layouts.filtered')
@section('title', $title)
@section('content')
<section class="main-container col1-layout">
  <div class="main container">
  <div class="page-content">
    <div class="account-login">
        <div class="col-md-3 col-sm-2"></div>
        <div class="col-md-6 col-sm-8">
                <div class="row">
                  {!! Form::open(['route' => 'pay.now', 'method' => 'POST', 'id' => 'payment-form']) !!}
                  <input type="hidden" name="userid" id="userid" value="{{ $params['id'] }}">
                  <input type="hidden" name="stype" id="stype" value="{{ $params['stype'] }}">
                  <center>
                      <div class="col-xs-12">
                        <div class="check-title">
                          <h2 class="text-green"><?php echo ucfirst($params['stype']); ?> Subscription at ${{ $params['amt'] }}/month</h2>
                        </div>
                      </div>
                  </center>
                  <div class="col-xs-12">&nbsp;</div>
                  <div class="col-sm-6">
                    <label for="firstname">First Name <span class="required">*</span></label>
                    <div class="input-text">
                      <input type="text" name="firstname" id="firstname" class="form-control" value="{{ $params['firstname'] }}" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <label for="lastname">Last Name <span class="required">*</span></label>
                    <div class="input-text">
                      <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $params['lastname'] }}" required>
                    </div>
                  </div>
                  <div class="col-xs-12">&nbsp;</div>
                  <div class="col-sm-12">
                    <label for="email">Email <span class="required">*</span></label>
                    <div class="input-text">
                      <input type="email" name="email" id="email" class="form-control" value="{{ $params['email'] }}" required>
                    </div>
                  </div>
                  @if(!Auth::check())
                  <div class="col-xs-12">&nbsp;</div>
                  <div class="col-sm-6">
                    <label for="password">Password <span class="required">*</span></label>
                    <div class="input-text">
                      <input type="password" name="password" id="password" class="form-control" value="{{ $params['password'] }}">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
                    <div class="input-text">
                      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ $params['password'] }}">
                    </div>
                  </div>
                  @endif
                  @if($params['stype'] != "free")
                      <div class="col-xs-12">&nbsp;</div>
                      <div class="col-sm-6">
                        <label for="duration">Select Plan Duration <span class="required">*</span></label>
                        <div class="input-text">
                            <select name="duration" id="duration" style="width: 245px;" id="plan">
                              @for($i=1; $i <= 24; $i++)
                                    @if($i == 1)
                                        <option value="{{ $i }}">{{ $i }} month</option>
                                    @elseif($i == 12)
                                        <option value="{{ $i }}">1 year</option>
                                    @elseif($i == 24)
                                        <option value="{{ $i }}">2 years</option>
                                    @else
                                        <option value="{{ $i }}">{{ $i }} months</option>
                                    @endif
                              @endfor
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <label for="payment">Payment Method <span class="required">*</span></label>
                        <div class="input-text">
                            <select name="payment" id="payment" style="width: 245px;" id="plan">
                              <option value="paypal">Paypal</option>
                              <option value="creditcard">Credit Card</option>
                            </select>
                        </div>
                      </div>
                  @endif
                  <div class="col-xs-12">&nbsp;</div>
                  <div class="col-xs-12"><hr width="100%"></div>
                  <div class="col-xs-6">
                    <div class="submit-text">
                      @if($params['stype'] == "free")
                        <button type="submit" class="button"><i class="fa fa-send"></i>&nbsp; <span>Register Now</span></button>
                      @else 
                        <button type="submit" class="button"><i class="fa fa-check"></i>&nbsp; <span>Checkout Now</span></button>
                      @endif
                    </div>
                  </div>
                  {!! Form::close() !!}
                  <div class="col-xs-6">
                    <div class="submit-text">
                      <a href="{{ route('subscribe') }}"><button class="button"><i class="fa fa-arrow-left"></i>&nbsp; <span>Back to subscription page</span></button></a>
                    </div>
                  </div>
                </div>
          </div>
    </div>
  </div>
 </div>
</section>
@endsection