@extends('admin.main')

@section('title', 'All Appointments')

@section('sidebarcontent')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> {{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section class="container-fluid my-sm-3 my-2">

        <div class="section-title fs-4 mb-0 pb-0"> All Appointments</div>

        <section style="width: fit-content;" class="appointment-table px-sm-3 my-3  table-responsive">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th scope="col">#</th>
                        <th>Patient</th>
                        <th>Age</th>
                        <th>Date & Time</th>
                        @if (auth()->user()->role == 'admin')
                            <th>Department</th>
                            <th>Doctor</th>
                            <th>Fees</th>
                        @endif
                      

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr class="py-3">
                            <td><a title="View User Details" href="{{ route('admin.all-users.view',$appointment->patient->id) }}">{{ $appointment->patient->id }}</a></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ str_starts_with($appointment->patient->profile_image, 'profile_images/')
                                        ? asset('storage/' . $appointment->patient->profile_image)
                                        : asset($appointment->patient->profile_image) }}"
                                        alt="patient image" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1" style="white-space: nowrap;">
                                            {{ $appointment->patient->fullname }}</p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class=" d-inline-block">12</span>
                            </td>
                            <td class="" style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($appointment->slot->date)->format('d, F, Y') }}
                                {{ \Carbon\Carbon::parse($appointment->slot->time)->format('g:i A') }}</td>


                            @if (auth()->user()->role == 'admin')
                                <td>
                                    <p class="fw-normal mb-1" style="white-space: nowrap;">{{$appointment->doctor->speciality}}</p>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img 
                                        src="{{ str_starts_with($appointment->doctor->user->profile_image, 'profile_images/')
                                        ? asset('storage/' . $appointment->doctor->user->profile_image)
                                        : asset( $appointment->doctor->user->profile_image) }}"
                                        alt="Doctor image"
                                            style="width: 45px; height: 45px" class="rounded-circle" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1" style="white-space: nowrap;">{{ $appointment->doctor->user->fullname}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class=" d-inline-block">Rs.{{$appointment->doctor->fees}}</span>
                                </td>
                            @endif

                            

                            <td>
                                <div class="card-body-right">
                                    <a href="#" class="cancel"><i class="bi bi-x-lg"></i></a>
                                    <a href="#" class="done"><i class="bi bi-check-lg"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="py-3">
                        <td>1</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/img/profile_img.svg') }}" alt=""
                                    style="width: 45px; height: 45px" class="rounded-circle" />
                                <div class="ms-3">
                                    <p class="fw-bold mb-1" style="white-space: nowrap;">John Doe</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="fw-normal mb-1" style="white-space: nowrap;">Software engineer</p>
                        </td>
                        <td>
                            <span class=" d-inline-block">12</span>
                        </td>
                        <td class="" style="white-space: nowrap;">24th July, 2024, 10:AM</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/img/profile_img.svg') }}" alt=""
                                    style="width: 45px; height: 45px" class="rounded-circle" />
                                <div class="ms-3">
                                    <p class="fw-bold mb-1" style="white-space: nowrap;">John Doe</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class=" d-inline-block">$50</span>
                        </td>
                        <td>
                            <div class="card-body-right">
                                <a href="#" class="cancel"><i class="bi bi-x-lg"></i></a>
                                <a href="#" class="done"><i class="bi bi-check-lg"></i></a>
                            </div>
                        </td>
                    </tr>


                </tbody>
            </table>
        </section>






    </section>
@endsection()
