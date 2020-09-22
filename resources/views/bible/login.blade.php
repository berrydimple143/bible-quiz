@extends('layouts.games')
@section('title', $title)
@section('content')
<section class="main-container col1-layout">
 <div class="main container">
  <div class="page-content">
        <div class="account-login">
          <div class="box-authentication">
            <form class="form-horizontal" method="POST" action="{{ route('player.login') }}">
            {{ csrf_field() }}
            <h4>Please Login as Player</h4>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
           <p class="before-login-text">Welcome back! Sign in to your account</p>
            <label for="email">Email address<span class="required">*</span></label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            <label for="password">Password<span class="required">*</span></label>
            <input id="password" type="password" name="password" class="form-control" required>
            <p class="forgot-pass"><a href="{{ route('password.request') }}">Forgot your password?</a></p>
            <label class="inline" for="remember">
			<input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>&nbsp;&nbsp; Remember me</label><br/>
            <button type="submit" class="button"><i class="fa fa-unlock-alt"></i>&nbsp; <span>Login</span></button>
		  </form>
          </div>
          <div class="box-authentication">
            <a href="{{ route('bible.quiz') }}" class="btn btn-sm btn-primary pull-right"><<&nbsp; <span>Back to the quiz page</span></a><br/>
            @include('partials.front.components.game_benefits')
          </div>
    </div>
  </div>
 </div>
</section> 
@endsection