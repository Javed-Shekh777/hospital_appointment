@extends('layout.auth')

@section('title', 'My Profile')

@section('authcontent')
    <section class="my-appointment" id="my-appointment">
        <div class="container">
            <h1 class="section-title">My Appointments</h1>
            <div class="horizontal"></div>

            <div class="row my-appointment-item gy-3">
                <div class="col-lg-10  ">
                    <div class="my-appointment-left gx-2">
                        <div class="my-appointment-img">
                            <img src="{{ asset('assets/img/gen-p-10.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="my-appointment-info">
                            <h3 class="doctor-name">Dr. Richard James</h3>
                            <p class="doctor-type">General physician </p>
                            <h5>Address:</h5>
                            <p>57th Cross, Richmond Circle, Church Road, London</p>
                            <p>
                            <h5>Date & Time:</h5> 25, July, 2024 | 8:30 PM</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2   appointment-btns">
                    <div class="btns">
                        <a href="#" class="pay-appointment">Pay here</a>
                        <a href="#" class="cencel-appointment ">Cancel appointment</a>
                    </div>
                </div>
            </div>
            <div class="horizontal"></div>

            <div class="row my-appointment-item gy-5">
                <div class="col-lg-10  ">
                    <div class="my-appointment-left gx-2">
                        <div class="my-appointment-img">
                            <img src="{{ asset('assets/img/gen-p-10.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="my-appointment-info">
                            <h3 class="doctor-name">Dr. Richard James</h3>
                            <p class="doctor-type">General physician </p>
                            <h5>Address:</h5>
                            <p>57th Cross, Richmond Circle, Church Road, London</p>
                            <p>
                            <h5>Date & Time:</h5> 25, July, 2024 | 8:30 PM</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2   appointment-btns">
                    <div class="btns">
                        <a href="#" class="pay-appointment">Pay here</a>
                        <a href="#" class="cencel-appointment ">Cancel appointment</a>
                    </div>
                </div>
            </div>
            <div class="horizontal"></div>


            <div class="row my-appointment-item gy-3">
                <div class="col-lg-10  ">
                    <div class="my-appointment-left gx-2">
                        <div class="my-appointment-img">
                            <img src="{{ asset('assets/img/gen-p-10.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="my-appointment-info">
                            <h3 class="doctor-name">Dr. Richard James</h3>
                            <p class="doctor-type">General physician </p>
                            <h5>Address:</h5>
                            <p>57th Cross, Richmond Circle, Church Road, London</p>
                            <p>
                            <h5>Date & Time:</h5> 25, July, 2024 | 8:30 PM</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2   appointment-btns">
                    <div class="btns">
                        <a href="#" class="pay-appointment">Pay here</a>
                        <a href="#" class="cencel-appointment ">Cancel appointment</a>
                    </div>
                </div>
            </div>
            <div class="horizontal"></div>








        </div>
    </section>
@endsection
