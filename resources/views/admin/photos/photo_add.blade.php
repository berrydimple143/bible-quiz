@extends('layouts.admin')
@section('title', $title)
@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>{{ strtoupper($title) }}<a href="{{ route('photos') }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">arrow_back</i> BACK TO PHOTO GALLERY</button></a></h2>
            </div>
            <div class="body">
                {!! Form::open(['route' => 'photo.store', 'method' => 'POST', 'files' => true]) !!}
                    @include('partials.admin.forms.photo_form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection