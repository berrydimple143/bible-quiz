@extends('layouts.filtered')
@section('title', $title)
@section('content')
<section class="main-container col1-layout">
  <div class="main container">
    <div class="page-content">
        <div class="account-login">
          <div class="box-authentication">
          {!! Form::open(['route' => 'register', 'method' => 'POST', 'id' => 'registration-form', 'class' => 'form-horizontal']) !!}
            {{ csrf_field() }}
            <h4>Register for free</h4><p>Create your very own account</p>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <label for="firstname">First Name<span class="required">*</span></label>
            <input id="firstname" name="firstname" type="text" class="form-control" value="{{ old('firstname') }}">
            <label for="lastname">Last Name<span class="required">*</span></label>
            <input id="lastname" name="lastname" type="text" class="form-control" value="{{ old('lastname') }}">
            <label for="email">Email<span class="required">*</span></label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}">
            <label for="password">Password<span class="required">*</span></label>
            <input id="password" type="password" name="password" class="form-control" required>
            <label for="password_confirmation">Confirm Password<span class="required">*</span></label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required><br/>
            <button type="submit" class="button"><i class="fa fa-user"></i>&nbsp; <span>Register</span></button>
          {!! Form::close() !!}
          </div>
          <div class="box-authentication">
            @include('partials.front.components.benefits')
          </div>
    </div>
  </div>
 </div>
</section>
@endsection