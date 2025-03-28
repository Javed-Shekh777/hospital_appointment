@extends('admin.main')

@section('title', 'Dashboard')

@section('sidebarcontent')

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{ session('success') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
    <section class="container-fluid my-sm-3 my-2">
        <div class="row px-sm-3  py-2  gy-4 gx-3">
            @if(Auth::user()->role == 'doctor')
            <div class="col-lg-4">
                <div class="box">
                    <div class="box-iconbox"><i class="bi bi-person-circle"></i></div>
                    <div class="box-info">
                        <h3>{{$totalEarning}}</h3>
                        <p>Earning</p>
                    </div>
                </div>
            </div>
            @endif
            @if(Auth::user()->role == 'admin')

            <div class="col-lg-4">
                <div class="box">
                    <div class="box-iconbox"><i class="bi bi-person-circle"></i></div>
                    <div class="box-info">
                        <h3>{{$doctorCount}}</h3>
                        <p>Doctors</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="col-lg-4">
                <div class="box">
                    <div class="box-iconbox"><i class="bi bi-person-circle"></i></div>
                    <div class="box-info">
                        <h3>{{$appointmentCount}}</h3>
                        <p>Appointments</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="box">
                    <div class="box-iconbox"><i class="bi bi-person-circle"></i></div>
                    <div class="box-info">
                        <h3>{{$patientCount}}</h3>
                        <p>Patients</p>
                    </div>
                </div>
            </div>
           
        </div>

        <div class="row px-sm-3  py-2  gy-4 gx-3 latest-appointments-container">
            <div class="col">
                <div class="card">
                    <div class="latest-appointments">
                        <i class="bi bi-list-task"></i>
                        <span>Latest Appointments</span>
                    </div>
                    <div class="card-body ">
                        @foreach ($latestAppointments as $latestAppointment)
                        <div class="box1">
                            <div class="card-body-left">
                                <img 
                                src="{{ str_starts_with($latestAppointment->doctor->user->profile_image, 'profile_images/')
                                ? asset('storage/' . $latestAppointment->doctor->user->profile_image)
                                : asset( $latestAppointment->doctor->user->profile_image) }}"
                                  alt="Doctor image" class="img-fluid">
                                <div class="info">
                                    <h3>{{$latestAppointment->doctor->user->fullname}}</h3>
                                    <p>Booking on {{ \Carbon\Carbon::parse($latestAppointment->slot->date)->format('d, F, Y') }}
                                        {{ \Carbon\Carbon::parse($latestAppointment->slot->time)->format('g:i A') }}</p>
                                </div>
                            </div>
                            <div class="card-body-right">
                                <a href="#" class="cancel"><i class="bi bi-x-lg"></i></a>
                                <a href="#" class="done"><i class="bi bi-check-lg"></i></a>
                            </div>
                        </div>
                        @endforeach
                       


                        <div class="box1">
                            <div class="card-body-left">
                                <img src="{{ asset('assets/img/profile_img.svg') }}" alt="profileImage" class="img-fluid">
                                <div class="info">
                                    <h3>Dr. Richard James</h3>
                                    <p>Booking on 24th July, 2024</p>
                                </div>
                            </div>
                            <div class="card-body-right">
                                <a href="#" class="cancel"><i class="bi bi-x-lg"></i></a>
                                <a href="#" class="done"><i class="bi bi-check-lg"></i></a>
                            </div>
                        </div>


                        <div class="box1">
                            <div class="card-body-left">
                                <img src="{{ asset('assets/img/profile_img.svg') }}" alt="Profile image" class="img-fluid">
                                <div class="info">
                                    <h3>Dr. Richard James</h3>
                                    <p>Booking on 24th July, 2024</p>
                                </div>
                            </div>
                            <div class="card-body-right">
                                <a href="#" class="cancel"><i class="bi bi-x-lg"></i></a>
                                <a href="#" class="done"><i class="bi bi-check-lg"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
