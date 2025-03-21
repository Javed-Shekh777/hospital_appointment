<!-- resources/views/contact.blade.php -->
@extends('layout.app')

@section('title', 'Contact Us')

@section('content')


    <section class="contact" id="contact">
        <div class="container ">
            <div class="section-title text-center">
                CONTACT <span class="fw-bold">US</span>
            </div>

            <div class="row gy-4 w-100   align-items-center  ">
                <div class="col-lg-6   ">
                    <div class="contact-image">
                        <img src="{{ asset('assets/img/contact_image.svg') }}" alt="" class="img-fluid">

                    </div>
                </div>
                <div class="col-lg-6 justify-content-end mt-4 ">
                    <ul class="contact-info">
                        <li>
                            <h3 class="text-uppercase">Our office</h3>
                        </li>
                        <li>
                            <p class="p1">54709 Willms Station</p>
                            <p>Suite 350, Washington, USA</p>
                        </li>
                        <li>
                            <p>Tel: (415) 555‑0132</p>
                            <p>Email: greatstackdev@gmail.com</p>
                        </li>

                        <li>
                            <h3>Careers at PRESCRIPTO</h3>
                        </li>
                        <li>
                            <p>Learn more about our teams and job openings.</p>
                        </li>
                        <li><a href="#">Explore Jobs</a></li>
                    </ul>
                </div>
            </div>


        </div>



        </div>
    </section>



@endsection
