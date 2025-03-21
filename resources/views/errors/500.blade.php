@extends('layouts.auth')

@section('authcontent')
    <h2>Oops! Something went wrong.</h2>
    <p>{{ $exception->getMessage() }}</p>
    <a href="{{ route('/') }}">Go Home</a>
@endsection
