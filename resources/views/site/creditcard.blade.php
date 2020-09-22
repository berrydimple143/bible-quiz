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
                      {!! Form::open(['route' => 'creditcard.pay', 'method' => 'POST', 'id' => 'creditcard-form']) !!}
                      <input type="hidden" name="userid" id="userid" value="{{ $id }}">
                      <input type="hidden" name="duration" id="duration" value="{{ $duration }}">
                      <input type="hidden" name="stype" id="stype" value="{{ $stype }}">
                      <input type="hidden" name="firstname" id="firstname" value="{{ $firstname }}">
                      <input type="hidden" name="lastname" id="lastname" value="{{ $lastname }}">
                      <center>
                          <div class="col-xs-12">
                            <div class="check-title">
                              <h4 class="text-green">Please fill-up your credit card information completely</h4>
                            </div>
                          </div>
                      </center>
                      <div class="col-xs-12">&nbsp;</div>
                      <div class="col-sm-6">
                        <label for="ctype">Credit Card Type <span class="required">*</span></label>
                        <div class="input-text">
                            <select name="ctype" id="ctype" style="width: 245px;" id="plan">
                              <option value="visa">Visa</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <label for="cvv">Card Verification Value (Cvv2) <span class="required">*</span></label>
                        <div class="input-text">
                            <input type="text" name="cvv" id="cvv" class="form-control">
                        </div>
                      </div>
                      <div class="col-xs-12">&nbsp;</div>
                      <div class="col-sm-12">
                        <label for="cardno">Card Number <span class="required">*</span></label>
                        <div class="input-text">
                          <input type="text" name="cardno" id="cardno" class="form-control">
                        </div>
                      </div>
                      <div class="col-xs-12">&nbsp;</div>
                      <div class="col-sm-6">
                        <label for="xmonth">Expiration Month <span class="required">*</span></label>
                        <div class="input-text">
                            <select name="xmonth" id="xmonth" style="width: 245px;" id="plan">
                              <option value="01">January</option>
                              <option value="02">February</option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <label for="xyear">Expiration Year <span class="required">*</span></label>
                        <div class="input-text">
                            <select name="xyear" id="xyear" style="width: 245px;" id="plan">
                              <?php foreach($xyr as $yr) : ?>
                                <option value="{{ $yr }}">{{ $yr }}</option>
                              <?php endforeach; ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-xs-12">&nbsp;</div>
                      <div class="col-xs-12"><hr width="100%"></div>
                      <div class="col-xs-6">
                        <div class="submit-text">
                          <button type="submit" class="button"><i class="fa fa-check"></i>&nbsp; <span>Pay Now</span></button>
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