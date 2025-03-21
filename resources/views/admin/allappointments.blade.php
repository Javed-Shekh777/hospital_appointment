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

        <section class="appointment-table px-sm-3 my-3 table-responsive">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th scope="col">#</th>
                        <th>Patient</th>
                        <th>Department</th>
                        <th>Age</th>
                        <th>Date & Time</th>
                        <th>Doctor</th>
                        <th>Fees</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
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
