<!-- resources/views/contact.blade.php -->
@extends('layout.app')

@section('title', 'About Us')

@section('content')


    <section class="about" id="about">
        <div class="container">
            <div class="section-title text-center">
                ABOUT <span class="fw-bold">US</span>
            </div>

            <div class="row gx-2 gy-4 mt-sm-4 mt-2">
                <div class="col-lg-4">
                    <div class="about-image">
                        <img src="{{ asset('assets/img/about_image.svg') }}" alt="About image">

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="about-content">
                        <p class="p1">Welcome to Prescripto, your trusted partner in managing your healthcare needs
                            conveniently and efficiently. At Prescripto, we understand the challenges individuals face when
                            it comes to scheduling doctor appointments and managing their health records.</p>
                        <p class="p2">Prescripto is committed to excellence in healthcare technology. We continuously
                            strive to enhance our platform, integrating the latest advancements to improve user experience
                            and deliver superior service. Whether you're booking your first appointment or managing ongoing
                            care, Prescripto is here to support you every step of the way</p>
                        <h3>Our Vision</h3>
                        <p class="p3">Our vision at Prescripto is to create a seamless healthcare experience for every
                            user. We aim to bridge the gap between patients and healthcare providers, making it easier for
                            you to access the care you need, when you need it.</p>
                    </div>
                </div>

            </div>


            <section class="whychoose">
                <div class="container">
                    <div class="row">
                        <h1 class="section-title text-uppercase fw-normal">why <span class="fw-bold">choose us</span></h1>
                    </div>

                    <div class="row mt-md-4 mt-2   gy-4">
                        <div class="col-md-4 whychoose-item">
                            <h3>Efficiency:</h3>
                            <p>Streamlined appointment scheduling that fits into your busy lifestyle.</p>
                        </div>
                        <div class="col-md-4  whychoose-item">
                            <h3>Convenience:</h3>
                            <p>Access to a network of trusted healthcare professionals in your area.</p>
                        </div>
                        <div class="col-md-4  whychoose-item">
                            <h3>Personalization:</h3>
                            <p>Tailored recommendations and reminders to help you stay on top of your health.</p>
                        </div>
                    </div>
                </div>
               
            </section>
          
        </div>
    </section>



@endsection
