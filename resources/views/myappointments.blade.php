@extends('layout.auth')

@section('title', 'My Profile')

@section('authcontent')
    <section class="my-appointment" id="my-appointment">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> {{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h1 class="section-title">My Appointments</h1>
            <div class="horizontal"></div>

            @foreach ($myAllAppointments as $appointment)
                <div class="row my-appointment-item gy-3">
                    <div class="col-lg-10  ">
                        <div class="my-appointment-left gx-2">
                            <div class="my-appointment-img">
                                <img src="{{ str_starts_with($appointment->doctor->user->profile_image, 'profile_images/')
                                    ? asset('storage/' . $appointment->doctor->user->profile_image)
                                    : asset('assets/img/' . $appointment->doctor->user->profile_image) }}"
                                    alt="{{ $appointment->doctor->user->profile_image }}" class="img-fluid">
                            </div>
                            <div class="my-appointment-info">
                                <h3 class="doctor-name">{{ $appointment->doctor->user->fullname }}</h3>
                                <p class="doctor-type">{{ $appointment->doctor->speciality }} </p>
                                <h5>Address:</h5>
                                <p>{{ $appointment->doctor->user->address }}</p>
                                <p>
                                <h5>Date & Time:</h5>
                                {{ \Carbon\Carbon::parse($appointment->slot->date)->format('d, F, Y') }} |
                                {{ \Carbon\Carbon::parse($appointment->slot->time)->format('g:i A') }}</p>

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2   appointment-btns">
                        <div class="btns">
                            <button type="button" id="payHere" class="pay-appointment">Pay here</button>
                            <button id="razorpayBtn" class="pay pay-appointment mb-2"
                                style="display: none;">Razorpay</button>
                            <a href="#" class="pay pay-appointment mb-2" style="display: none;">Stripe</a>

                            <a href="{{ route('cencel-appointment', $appointment->id) }}" class="cencel-appointment ">Cancel
                                appointment</a>
                        </div>
                    </div>
                </div>
                <div class="horizontal"></div>
            @endforeach












        </div>
    </section>

    <script>
        document.getElementById("razorpayBtn")?.addEventListener("click", function() {
            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}",
                "amount": 50,
                "currency": "INR",
                "name": "Prescripto",
                "description": "Test Transaction",
                "order_id": "f123456f",
                "handler": function(response) {
                    window.location.href = "/payment-success?razorpay_payment_id=" + response
                        .razorpay_payment_id;
                }
            };
            console.log(options);
            var rzp = new Razorpay(options);
            rzp.open();
        })
    </script>
@endsection
