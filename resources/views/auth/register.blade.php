@extends('layout.auth')

@section('title', 'Register')


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
                            <h1>Create Account</h1>
                            <p>Please sign up to book appointment</p>
                            <form action="{{ route('register.post') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullname" value="{{ old('fullname') }}"
                                        name="fullname">
                                    @if ($errors->has('fullname'))
                                        <span style="color: red;">{{ $errors->first('fullname') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{ old('email') }}"
                                        name="email">
                                    @if ($errors->has('email'))
                                        <span style="color: red;">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="role" class="form-label">User Type</label>
                                    <select class="form-select" id="role" name="role" aria-label="Default select example">
                                        @php
                                            $usersType = ['admin', 'doctor', 'patient'];
                                        @endphp
                                        @foreach ($usersType as $item)
                                            <option value="{{ $item }}" {{ old('role') == $item ? 'selected' : '' }}>
                                                {{ ucfirst($item) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role'))
                                        <span style="color: red;">{{ $errors->first('role') }}</span>
                                    @endif
                                </div>
                                


                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" class="form-control" id="password" name="password">
                                    @if ($errors->has('password'))
                                        <span style="color: red;">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <button class="btn register-btn">Create account</button>
                                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
