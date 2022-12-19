@extends('layouts.master')
@section('title', 'Error 403')

@section('content')
<div class="container my-5 text-center">
    <img class="mw-100" src="{{ asset('/assets/images/maintance/403.gif') }}" alt="error 403">
</div>
@endsection
