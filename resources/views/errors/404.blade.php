@extends('layouts.master')
@section('title', 'Error 404')

@section('content')
<div class="container my-5 text-center">
    <img class="mw-100" src="{{ asset('/assets/images/maintance/404.png') }}" alt="error 404">
    <a href="{{ url('') }}">Home</a>
</div>
@endsection
