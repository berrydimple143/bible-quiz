@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="alert bg-red" role="alert">
        <p>{{ $err }}</p>
    </div>
@endsection