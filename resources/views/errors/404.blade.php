<!-- resources/views/errors/404.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Oops! Page not found</h1>
    <p>The page you are looking for does not exist.</p>
    <a href="{{ url('/') }}">Go to Homepage</a>
@endsection
