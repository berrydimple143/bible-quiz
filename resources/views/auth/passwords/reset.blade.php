@extends('layouts.front')
@section('title', $title)
@section('content')
<section class="main-container col1-layout">
 <div class="main container">
    <div class="page-content">
        <div class="account-login">
          <div class="box-authentication">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @else
                    <form class="form-vertical" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <h4>Reset Password</h4><hr width="100%" /><br/>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-6 control-label">Email address<span class="required">*</span></label>
                                <div class="col-md-6">
                                    <input id="email" type="email" style="width: 400px;" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">&nbsp;</div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-6 control-label">New Password<span class="required">*</span></label>
                                <div class="col-md-6">
                                    <input id="password" type="password" style="width: 400px;" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">&nbsp;</div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-6 control-label">Confirm New Password<span class="required">*</span></label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" style="width: 400px;" class="form-control" name="password_confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">&nbsp;</div>
                            <div class="form-group">
                                <div class="col-md-offset-6 col-md-6">
                                    <button type="submit" class="button"><i class="fa fa-key"></i>&nbsp; <span>Reset Password</span></button><br/><br/>
                                </div>
                            </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
 </div>
</section> 
@endsection