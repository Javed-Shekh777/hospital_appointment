<!-- resources/views/contact.blade.php -->
@extends('layout.app')

@section('title', 'Hospital')

@section('content')

    <section class="hero" id="home">
        <div class="container">
            <div class="row gy-4">
                <div class="col-xl-6 hero-left">
                    <h1 class="hero-title"><span>Book appointment</span> <span>with trusted doctors</span></h1>
                    <div class="hero-sub">
                        <div class="hero-sub-img">
                            <img src="{{ asset('assets/img/hero-3.svg') }}" alt="Hero1" class="img-fluid">
                            <img src="{{ asset('assets/img/hero-2.svg') }}" alt="Hero2" class="img-fluid">
                            <img src="{{ asset('assets/img/hero-1.svg') }}" alt="Hero3" class="img-fluid">
                        </div>
                        <p class="hero-desc">Simply browse through our extensive list of trusted doctors,
                            schedule your appointment hassle-free.</p>
                    </div>
                    <a href="{{route('alldoctors')}}" class="btn hero-btn">Book appointment <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="col-xl-6 hero-right">
                    <img src="{{ asset('assets/img/hero.svg') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </section>


    {{-- Home page  --}}
    <section class="findoctors" id="finddoctors">
        <div class="container">
            <div class="row text-center">
                <h1 class="section-title text-center">Find by Speciality</h1>
                <p class="section-dec col-sm-5 mx-auto text-center">Simply browse through our extensive list of trusted
                    doctors, schedule your appointment hassle-free.</p>
            </div>
            <div class="row doctors-types">
                <div class="col-lg-10  mx-auto">
                    <div class="row gy-5 gx-2   doctors-type">
                        <div class="col-xl-2 col-md-4 col-sm-6">
                            <a href="{{ url('/alldoctors?specialization=General physician') }}">
                                <div class="doc-type">
                                    <img src="{{ asset('assets/img/General_physician.svg') }}" alt="">
                                    <h3 class="doc-type-name" style="flex-shrink: 0;">General Physician</h3>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-2 col-md-4 col-sm-6">
                            <a href="{{ url('/alldoctors?specialization=Gynecologist') }}">
                                <div class="doc-type">
                                    <img src="{{ asset('assets/img/Gynecologist.svg') }}" alt="">
                                    <h3 class="doc-type-name">Gynecologist</h3>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6">
                            <a href="{{ url('/alldoctors?specialization=Dermatologist') }}">
                                <div class="doc-type">
                                    <img src="{{ asset('assets/img/Dermatologist.svg') }}" alt="">
                                    <h3 class="doc-type-name">Dermatologist</h3>
                                </div>
                            </a>

                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6">
                            <a href="{{ url('/alldoctors?specialization=Pediatricians') }}">
                                <div class="doc-type">
                                    <img src="{{ asset('assets/img/Pediatricians.svg') }}" alt="">
                                    <h3 class="doc-type-name">Pediatricians</h3>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6">
                            <a href="{{ url('/alldoctors?specialization=Neurologist') }}">
                                <div class="doc-type">
                                    <img src="{{ asset('assets/img/Neurologist.svg') }}" alt="">
                                    <h3 class="doc-type-name">Neurologist</h3>
                                </div>
                            </a>

                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6">
                            <a href="{{ url('/alldoctors?specialization=Gastriontrologist') }}">

                                <div class="doc-type">
                                    <img src="{{ asset('assets/img/Gastroenterologist.svg') }}" alt="">
                                    <h3 class="doc-type-name">Gastroenterologist</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="top-doctors" id="top-doctors">
        <div class="container">
            <div class="row text-center top-doctors ">
                <h1 class="section-title text-center">Top Doctors to Book</h1>
                <p class="section-dec  col-sm-5 mx-auto text-center">Simply browse through our extensive list of trusted
                    doctors..</p>
            </div>

            <div class="doctors mt-sm-4 mt-2">
                @foreach ($doctors as $doctor)
                <a href="{{route('doctor',$doctor->id)}}">
                    <div class="doctor">
                        <div class="doctor-img">
                            <img src="{{ str_starts_with($doctor->user->profile_image, 'profile_images/')
                                ? asset('storage/' . $doctor->user->profile_image)
                                : asset('assets/img/' . $doctor->user->profile_image) }}"
                                alt="">
                        </div>
                        <div class="doctor-info">
                            <p class="doctor-isavailable"> <span></span>Available </p>
                            <h3 class="doctor-name">{{$doctor->user->fullname}}</h3>
                            <p class="doctor-type">{{$doctor->speciality}} </p>
                        </div>
                    </div>
                </a>
                    
                @endforeach

            </div>

            <div class="more">
                <button class="">More</button>
            </div>
        </div>
    </section>

    <section class="  bookappointment" id="home">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 hero-left">
                    <h1 class="hero-title"><span>Book appointment</span> <span>with 100+ Trusted Doctors</span></h1>
                    <a href="#" class="btn hero-btn">Create account <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="col-lg-6 hero-right">
                    <img src="{{ asset('assets/img/appointment-doc-img.svg') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </section>


@endsection
