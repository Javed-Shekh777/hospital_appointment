@extends('admin.main')

@section('title', 'All Users')

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
            <table class="table table-bordered table-striped align-middle mb-0 p-2 bg-white">
                <thead class="bg-light">
                    <tr>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Patient</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Speciality (if Doctor)</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th style="min-width: 250px;">Address</th>
                        <th>Total Appointments</th>
                        <th>Total Payments</th>
                        <th>Last Appointment</th>
                        <th>Status</th>
                        <th>Registered On</th>
                        <th>Operations</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                        <tr class="">
                            <td>{{ $user->id }}</td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ str_starts_with($user->profile_image, 'profile_images/')
                                        ? asset('storage/' . $user->profile_image)
                                        : asset($user->profile_image) }}"
                                        alt="{{$user->profile_image}}" style="width: 50px; height: 50px" class="rounded-circle border " />
                                    <div class="ms-2">
                                        <p class="fw-bold mb-1" style="white-space: nowrap;">{{ $user->fullname }}</p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class=" d-inline-block">{{ $user->email }}</span>
                            </td>
                            <td>{{ ucfirst($user->role) }}</td>

                            <td class="" style="white-space: nowrap;">{{ $user->phone }}
                            </td>

                            <td>
                                @if ($user->doctor)
                                    {{ $user->doctor->speciality }}
                                @else
                                    N/A
                                @endif
                            </td>


                            <td class="" style="white-space: nowrap;">{{ $user->dob }}</td>
                            <td><span class=" d-inline-block">{{ $user->gender }}</span>
                            </td>
                            <td> {{ $user->address }}</td>

                            <td>{{ $user->appointments->count() }}</td>
                            <td>{{ $user->payments->count() }}</td>
                            <td>{{ $user->appointments->last()->appointment_date ?? 'N/A' }}</td>
                            <td>
                                @if ($user->appointments->count() > 0)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>

                            <td class="" style="white-space: nowrap;">
                                {{ $user->created_at->format('d M, Y') }}</td>

                            <td class="text-center" style="white-space: nowrap;">
                                <div class="btn-group">
                                    <a href="{{ route('admin.all-users.view',$user->id) }}" class="btn btn-info btn-sm me-1 " >View</a>
                                    <a href="{{ route('admin.all-users.delete',$user->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                                
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </section>
    

    </section>


     
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has("user")) {
                let userModal = new bootstrap.Modal(document.getElementById("userModal"));
                userModal.show();
            }
        });
        </script>
        



@endsection()
