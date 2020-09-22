@extends('layouts.admin')
@section('title', $title)
@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-24">
        <div class="card">
            <div class="header">
                <h2>You are about to change your email address</h2>
            </div>
            <div class="body">
                {!! Form::open(['route' => 'email.update', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <div class="form-line">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Type your email here ..." value="{{ $user->email }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger"><i class="material-icons">edit</i> CHANGE NOW</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection