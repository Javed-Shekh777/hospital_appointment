@extends('layout.auth')

@section('title', 'Login')


@section('authcontent')
    <section class="register" id="register">
        <div class="container">
           
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong> {{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-lg-4  column col-xxl-8 col-xl-6   mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h1>Login</h1>
                            <p>Please login to book appointment</p>
                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{ old('email') }}"
                                        name="email">
                                    @if ($errors->has('email'))
                                        <span style="color: red;">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" class="form-control" id="password" name="password">
                                    @if ($errors->has('password'))
                                        <span style="color: red;">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <button type="submit" class="btn register-btn">Login</button>
                                <p>New User Create an account? <a href="{{ route('register') }}">Register here</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
