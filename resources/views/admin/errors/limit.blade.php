@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="alert bg-red" role="alert">
        <h3>{{ $err }}</h3>
        <p>Conside upgrading your membership. It's very affordable!</p><br/>
        <a href="{{ route('subscribe') }}"><button class="btn bg-green waves-effect" type="button"><i class="material-icons">shopping_cart</i> SUBSCRIBE NOW</button></a>
    </div>
@endsection