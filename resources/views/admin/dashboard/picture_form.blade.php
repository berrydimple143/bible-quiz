@extends('layouts.admin')
@section('title', $title)
@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>{{ strtoupper($title) }}<a href="{{ route('dashboard') }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">arrow_back</i> BACK TO THE DASHBOARD</button></a></h2>
            </div>
            <div class="body">
                {!! Form::open(['route' => 'picture.update', 'method' => 'POST', 'files' => true]) !!}
                    <div class="form-group form-float">
                        <div class="form-line">
                            {{ Form::file('picture', ['required']) }}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect"><i class="material-icons">file_upload</i> Upload Now</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection