<!-- resources/views/errors/500.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Something went wrong!</h1>
    <p>We are working on it. Please try again later.</p>
    <a href="{{ url('/') }}">Go to Homepage</a>
@endsection
