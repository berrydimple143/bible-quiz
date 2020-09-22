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
                    <form class="form-vertical" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <h4>Reset Password</h4><hr width="100%" /><br/>
                        
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email address<span class="required">*</span></label>
                                <div class="col-md-8">
                                    <input id="email" type="email" style="width: 400px;" class="form-control" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-8">
                                    <button type="submit" class="button"><i class="fa fa-envelope"></i>&nbsp; <span>Send Password Reset Link</span></button><br/><br/>
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