<!-- resources/views/contact.blade.php -->
@extends('layout.app')

@section('title', 'Doctor Info')

@section('content')



    <section class="doctorInfo" id="doctor">

        <div class="container">
            <div class="row gx-3 gy-4 doctor">

                <div class="col-lg-3 col1 col-md-6">
                    <div class="image">
                        <img src="{{ str_starts_with($doctor->user->profile_image, 'profile_images/')
                            ? asset('storage/' . $doctor->user->profile_image)
                            : asset($doctor->user->profile_image) }}"
                            alt="{{ $doctor->user->profile_image }}">
                    </div>
                </div>
                <div class="col-lg-9 col2  col-md-6">
                    <div class="doctor-info ">
                        <h3 class="name">{{ $doctor->user->fullname }} <span class="verified"><i
                                    class="bi bi-patch-check-fill"></i></span></h3>
                        <p class="education">
                            <span>{{ $doctor->education }} - {{ $doctor->speciality }}</span>
                            <span class="experience">{{ $doctor->experience }} Years</span>
                        </p>
                        <h3 class="about">About <i class="bi bi-info-circle"></i> </h3>
                        <p class="description">{{ $doctor->about }}</p>
                        <h3 class="fees ">Appointment Fees : <span class="rupee">Rs{{ $doctor->fees }}</span></h3>


                    </div>

                </div>
            </div>
        </div>

        <div class="container">

            <div class="row gx-3 gy-4 doctor-booking">

                <div class="col-lg-3 col1  d-md-block d-none">
                </div>

                <div class="col-lg-9 col2   ">
                    <form action="{{ route('book-appointment') }}" method="POST" class="booking-form p-0 m-0">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <input type="hidden" value="{{old('date')}}" name="date" id="selectedDate">
                        <input type="hidden" value="" name="day" id="selectedDay">
                        <input type="hidden" value="" name="time" id="selectedTime">
                        <input type="hidden" value="" name="slot_id" id="slotId">
                        <input type="hidden" name="patient_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                        <h3 class="sectionTitle">Booking slots</h3>

                        <!-- Date Selection -->
                        <div class="row text-center flex-wrap date">
                            @foreach ($groupedSlots as $date => $slots)
                                @php
                                    $dayName = \Carbon\Carbon::parse($date)->format('D');
                                    $dayNum = \Carbon\Carbon::parse($date)->format('d');
                                @endphp

                                <div class="col-auto {{ old('date') == $date ? 'active' : '' }}"
                                    onclick="selectDate(this, '{{ $date }}','{{ $slots[0]->id }}')">
                                    <p class="day">{{ $dayName }}</p>
                                    <p class="day-num">{{ $dayNum }}</p>
                                </div>
                            @endforeach
                        </div>
                        @error('date')
                            <small class="text-danger d-block">⚠️ {{ $message }}</small>
                        @enderror

                        <!-- Time Slots -->
                        <div id="slot-container">
                            @foreach ($groupedSlots as $date => $slots)
                                @php

                                @endphp
                                <div class="row text-center time flex-wrap gx-3 gy-3 time-slots {{ old('date') == $date ? 'active' : '' }}"
                                    data-date="{{ $date }}"
                                    style="display: none;">
                                    @foreach ($slots as $slot)
                                        @php
                                            $startTime = \Carbon\Carbon::parse($slot->start_time);
                                            $endTime = \Carbon\Carbon::parse($slot->end_time);

                                        @endphp
                                        @while ($startTime < $endTime)
                                            @php
                                                $nextHour = $startTime->copy()->addHour();
                                            @endphp
                                            <div class="col-auto"
                                                onclick="selectTime(this, '{{ $startTime->format('h:i:s') }}')">
                                                <p class="t">{{ $startTime->format('h:i A') }}</p>
                                            </div>
                                            @php
                                                $startTime = $nextHour;
                                            @endphp
                                        @endwhile
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        @error('time')
                            <small class="text-danger d-block">⚠️ {{ $message }}</small>
                        @enderror

                        @error('slot_id')
                            <small class="text-danger d-block">⚠️ {{ $message }}</small>
                        @enderror

                        <button type="submit" class="main-btn my-4">Book an appointment <i
                                class="bi bi-arrow-right"></i></button>
                    </form>


                </div>
            </div>
        </div>
    </section>


    <section class="top-doctors" id="top-doctors pt-0">
        <div class="container">
            <div class="row text-center top-doctors ">
                <h1 class="section-title text-center">Related Doctors</h1>
                <p class="section-dec  col-sm-5 mx-auto text-center">Simply browse through our extensive list of trusted
                    doctors.</p>
            </div>

            <div class="doctors">
                @foreach ($doctors as $doctor)
                    <div class="doctor">
                        <a href="{{ route('doctor', $doctor->id) }}">

                            <div class="doctor-img">
                                <img src="{{ str_starts_with($doctor->user->profile_image, 'profile_images/')
                                    ? asset('storage/' . $doctor->user->profile_image)
                                    : asset($doctor->user->profile_image) }}"
                                    alt="{{ $doctor->user->profile_image }}">
                            </div>
                            <div class="doctor-info">
                                <p class="doctor-isavailable"> <span></span>Available </p>
                                <h3 class="doctor-name">{{ $doctor->user->fullname }}</h3>
                                <p class="doctor-type">{{ $doctor->speciality }}</p>
                            </div>
                        </a>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
