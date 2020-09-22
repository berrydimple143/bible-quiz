@extends('layouts.admin')
@section('title', $title)
@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>{{ strtoupper($title) }}</h2>
            </div>
            <div class="body">
                <div class="alert bg-pink" role="alert">
                    <div class="card">
                        <div class="header bg-orange">
                            <h2>IMAGE CURRENT INFORMATION:</h2>
                        </div>
                        <?php 
                            $src = 'uploads/photos/'. $model->filename; 
                            $msg = "Copy this link and use this on your post editor by inserting an image.";
                        ?>
                        <div class="body bg-green">
                            <h5>Filename: {{ $model->filename }}</h5>
                            <h5>Caption: "{{ $model->title }}"</h5>
                            <h5>Status: {{ $model->status }}</h5>
                            <h5>Used: {{ $model->selected }}</h5>
                            <h5>Description: {{ Illuminate\Support\Str::limit($model->description, 125) }}</h5>
                            <h5>Location: <a href="{{ asset($src) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="{{ $msg }}">{{ asset($src) }}</a></h5>
                        </div>
                    </div>
                    <span><a href="{{ route('photo.edit', ['id' => $model->id]) }}"><button class="btn bg-orange waves-effect" type="button"><i class="material-icons">edit</i> {{ $params['btn1'] }}</button></a></span>
                    <span>&nbsp;&nbsp;</span>
                    <span><a href="{{ route('photo.delete', ['id' => $model->id]) }}"><button class="btn bg-red waves-effect" type="button"><i class="material-icons">delete</i> {{ $params['btn2'] }}</button></a></span>
                    @if($user->membership == "admin")
                        <span>&nbsp;&nbsp;</span>
                        @if($model->status != "active")
                            <span><a href="{{ route('photo.activate', ['id' => $model->id]) }}"><button class="btn bg-green waves-effect" type="button"><i class="material-icons">thumb_up</i> {{ $params['btn3'] }}</button></a></span>
                        @else
                            <span><a href="{{ route('photo.deactivate', ['id' => $model->id]) }}"><button class="btn bg-black waves-effect" type="button"><i class="material-icons">thumb_down</i> {{ $params['btn4'] }}</button></a></span>
                        @endif
                        <span>&nbsp;&nbsp;</span>
                        <span><a href="{{ route('photo.deselect', ['id' => $model->id]) }}"><button class="btn bg-blue waves-effect" type="button"><i class="material-icons">thumb_down</i> {{ $params['btn5'] }}</button></a></span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('[data-toggle="tooltip"]').tooltip();
</script>
@endsection