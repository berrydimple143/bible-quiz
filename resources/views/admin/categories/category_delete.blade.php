@extends('layouts.admin')
@section('title', $title)
@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>{{ strtoupper($title) }}<a href="{{ route('categories') }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">arrow_back</i> BACK TO CATEGORIES</button></a></h2>
            </div>
            <div class="body">
                <div class="alert bg-pink" role="alert">
                    <h4 class="alert-heading">Warning! This category will be deleted permanently.</h4>
                    <p>Are you sure you want to delete "{{ $model->name }}"?</p><br/>
                    {!! Form::open(['route' => ['category.destroy', $model->id], 'method' => 'post']) !!}
                        {{ method_field('DELETE') }}
                        <button class="btn bg-red waves-effect" type="submit"><i class="material-icons">delete</i> DELETE NOW</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection