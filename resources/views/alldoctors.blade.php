<!-- resources/views/contact.blade.php -->
@extends('layout.app')

@section('title', 'All Doctors')

@section('content')



    <section class="top-doctors" id="top-doctors">
        <div class="container doctor-filter-container">
            <p>Browse through the doctors specialist</p>
            <button class="filter-icon" id="filter-icon"><i class="bi bi-filter"></i></button>


            <div class="d-flex main ">

                <div class="doctor-filter" id="doctor-filter">
                    <a href="{{ url('/alldoctors') }}" class="doctor-filter-btn {{ request('specialization') ? '':'active' }}">All</a>
                    <a href="{{ url('/alldoctors?specialization=General physician') }}" class="doctor-filter-btn {{ request('specialization')== 'General physician' ? 'active':'' }}">General physician</a>
                    <a href="{{ url('/alldoctors?specialization=Gynecologist') }}" class="doctor-filter-btn {{ request('specialization') == 'Gynecologist' ? 'active':'' }}">Gynecologist</a>
                    <a href="{{ url('/alldoctors?specialization=Dermatologist') }}" class="doctor-filter-btn {{ request('specialization')== 'Dermatologist' ? 'active':'' }}">Dermatologist</a>
                    <a href="{{ url('/alldoctors?specialization=Pediatricians') }}" class="doctor-filter-btn {{ request('specialization') == 'Pediatricians' ? 'active':'' }}">Pediatricians</a>
                    <a href="{{ url('/alldoctors?specialization=Neurologist') }}" class="doctor-filter-btn {{ request('specialization')== 'Neurologist' ? 'active':'' }}">Neurologist</a>
                    <a href="{{ url('/alldoctors?specialization=Gastriontrologist') }}" class="doctor-filter-btn {{ request('specialization')== 'Gastroenterologist' ? 'active':'' }}">Gastroenterologist</a>
                </div>
            


                <div class="container">
                    <div class="doctors mt-sm-4 mt-2">
                        @foreach ($doctors as $doctor)
                        <a href="{{route('doctor',$doctor->id)}}">
                            <div class="doctor">
                                <div class="doctor-img">
                                    <img src="{{ str_starts_with($doctor->user->profile_image, 'profile_images/')
                                        ? asset('storage/' . $doctor->user->profile_image)
                                        : asset($doctor->user->profile_image) }}"
                                        alt="{{$doctor->user->profile_image}} ">
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

            </div>


        </div>
    </section>




@endsection
