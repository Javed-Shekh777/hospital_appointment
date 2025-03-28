@extends('admin.main')

@section('title', 'All Patients')

@section('sidebarcontent')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> {{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section class="container-fluid my-sm-3 my-2">

        <div class="section-title fs-4 mb-0 pb-0"> All Patients</div>

        <section class="appointment-table  px-sm-3 my-3 table-responsive">
            <table class="table align-middle mb-0 p-2 bg-white">
                <thead class="bg-light">
                    <tr>
                    <tr>
                        <th>ID</th>
                        <th>Patient</th>
                        <th>Email</th>
                        <th>Phone</th>

                        @if (auth()->user()->role == 'admin')
                        <th>DOB</th>
                        <th>Gender</th>
                        <th style="min-width: 250px;">Address</th>
                        @endif

                        <th>Total Appointments</th>
                        <th>Last Appointment</th>
                        <th>Status</th>

                        @if (auth()->user()->role == 'admin')
                            <th>Registered On</th>
                        @endif
                    </tr>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($patients as $patient)
                        <tr class="py-3">
                            <td>{{ $patient->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img  src="{{ str_starts_with($patient->profile_image, 'profile_images/')
                                    ? asset('storage/' . $patient->profile_image)
                                    : asset($patient->profile_image) }}"
                                        alt="{{$patient->profile_image}}" style="width: 45px; height: 45px" class="rounded-circle border" />
                                    <div class="ms-2">
                                        <p class="fw-bold mb-1" style="white-space: nowrap;">{{$patient->fullname}}</p>
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <span class=" d-inline-block">{{ $patient->email }}</span>
                            </td>
                            
                                <td class="" style="white-space: nowrap;">{{ $patient->phone }}
                            </td>

                            @if (auth()->user()->role == 'admin')
                            <td class="" style="white-space: nowrap;">{{ $patient->dob }}</td>
                            <td><span class=" d-inline-block">{{ $patient->gender }}</span>
                            </td>
                            <td > {{ $patient->address }}</td>
                            @endif

                            <td>{{ $patient->appointments->count() }}</td>
                            <td>{{ $patient->appointments->last()->appointment_date ?? 'N/A' }}</td>
                            <td>
                                @if ($patient->appointments->count() > 0)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>

                            @if (auth()->user()->role == 'admin')
                            <td class="" style="white-space: nowrap;">{{ $patient->created_at->format('d M, Y') }}</td>
                            @endif
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </section>






    </section>
@endsection()
