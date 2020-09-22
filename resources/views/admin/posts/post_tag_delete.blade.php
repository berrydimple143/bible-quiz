@extends('layouts.admin')
@section('title', $title)
@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>{{ strtoupper($title) }}<a href="{{ route('post.tags', ['id' => $params]) }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">arrow_back</i> BACK TO TAGS</button></a></h2>
            </div>
            <div class="body">
                <div class="alert bg-pink" role="alert">
                    <h4 class="alert-heading">Warning! This tag will be untag permanently.</h4>
                    <p>Are you sure you want to untag this tag name "{{ $model->name }}" from this article?</p><br/>
                    {!! Form::open(['route' => 'post.tag.destroy', 'method' => 'POST']) !!}
                        {{ Form::hidden('postid', $params) }}
                        {{ Form::hidden('tag', $model->name) }}
                        {{ Form::hidden('tag_id', $model->id) }}
                        <button class="btn bg-red waves-effect" type="submit"><i class="material-icons">delete</i> UNTAG NOW</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection