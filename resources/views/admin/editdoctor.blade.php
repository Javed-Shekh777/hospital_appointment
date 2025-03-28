@extends('admin.main')


@section('title', 'Update Doctor')

@section('sidebarcontent')
    <section class=" ">

        <div class="container-fluid mx-sm-4   mx-2 py-3 add-doctor">
            <div class="section-title fs-4 mb-1 pb-0 text-center ">Update Doctor</div>

            <div class="row h-100">
                <div class="col-xl-8 col-md-12   mx-lg-auto border border-success rounded px-sm-4  px-2">
                    <form action="{{ route('admin.doctor.update', $doctor->id) }}" class="row" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="my-2 d-flex align-items-center gap-2 flex-wrap">
                            <img src="{{ str_starts_with($doctor->user->profile_image, 'profile_images/')
                                ? asset('storage/' . $doctor->user->profile_image)
                                : asset($doctor->user->profile_image) }}"
                                style="width: 100px;height: 100px;object-fit: cover;border-radius: 50%;"
                                class="rounded-circle img-fluid" alt="{{$doctor->user->profile_image}}">

                            <label for="profile_image" style="cursor: pointer;" class="border rounded-circle">
                                <input type="file" class="form-control d-none" name="profile_image" id="profile_image"
                                    accept="image/*">
                                <img id="previewImage" src="{{ asset('assets/img/upload.svg') }}"
                                    style="width: 100px;height: 100px;object-fit: cover;border-radius: 50%;"
                                    class="rounded-circle img-fluid" alt="Profile Image">
                            </label>

                            <h4 class="ms-3">Upload Doctor Picture</h4>
                        </div>

                        <div class="row  ">
                            <div class="col-lg-6  mb-3">
                                <label for="name" class="form-label">Doctor name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $doctor->user->fullname) }}" id="name" placeholder="Name">
                                @if ($errors->has('name'))
                                    <span style="color: red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="speciality" class="form-label">Speciality</label>
                                <select class="form-select" name="speciality" aria-label="Default select example">
                                    @php
                                        $specialities = [
                                            'General physician',
                                            'Gynecologist',
                                            'Dermatologist',
                                            'Pediatricians',
                                            'Neurologist',
                                            'Gastriontrologist',
                                        ];
                                    @endphp

                                    @foreach ($specialities as $item)
                                        <option value="{{ $item }}"
                                            {{ old('speciality', $doctor->speciality) == $item ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('speciality'))
                                    <span style="color: red;">{{ $errors->first('speciality') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row  ">
                            <div class="col-lg-6 mb-3">
                                <label for="email" class="form-label">Doctor Email</label>
                                <input type="email" name="email" value="{{ old('email', $doctor->user->email) }}"
                                    class="form-control" id="email" placeholder="Your email">
                                @if ($errors->has('email'))
                                    <span style="color: red;">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="education" class="form-label">Education</label>
                                <input type="text" name="education" value="{{ old('education', $doctor->education) }}"
                                    class="form-control" id="education" placeholder="Education">
                                @if ($errors->has('education'))
                                    <span style="color: red;">{{ $errors->first('education') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="row ">
                            <div class="col-lg-6 ">
                                <label for="password" class="form-label">Doctor Password</label>
                                <input type="text" name="password" id="password" class="form-control"
                                    placeholder="Enter new password (optional)">

                            </div>
                            <div class="col-lg-6 ">
                                <label for="address" class="form-label">Address</label>
                                <textarea cols="3" rows="3" class="form-control mb-3" name="address" id="address" placeholder="Address">{{ old('address', $doctor->user->address) }}</textarea>
                                @if ($errors->has('address'))
                                    <span style="color: red;">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="experience" class="form-label">Experience</label>
                                <select class="form-select" id="experience" name="experience"
                                    aria-label="Default select example">
                                    @php
                                        $experiences = ['1', '2', '3', '5', '7', '10', '15'];
                                    @endphp
                                    @foreach ($experiences as $item)
                                        <option value="{{ $item }}"
                                            {{ old('experience', $doctor->experience) == $item ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach


                                </select>
                                @if ($errors->has('experience'))
                                    <span style="color: red;">{{ $errors->first('experience') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" value="{{ old('phone', $doctor->user->phone) }}"
                                    class="form-control" name="phone" id="phone" placeholder="Your Phone">
                                @if ($errors->has('phone'))
                                    <span style="color: red;">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="fees" class="form-label">Fees</label>
                                <input type="number" value="{{ old('fees', $doctor->fees) }}" class="form-control"
                                    name="fees" id="fees" placeholder="Your fees">
                                @if ($errors->has('fees'))
                                    <span style="color: red;">{{ $errors->first('fees') }}</span>
                                @endif
                            </div>

                        </div>

                        <div class="row">
                            <div class="mb-3">
                                <label for="about" class="form-label">About me</label>
                                <textarea class="form-control" id="about" name="about" rows="6" placeholder="write about yourself">{{ old('about', $doctor->about) }}</textarea>
                                @if ($errors->has('about'))
                                    <span style="color: red;">{{ $errors->first('about') }}</span>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn mb-2 create-btn px-5" style="width: fit-content;">Update
                            Doctor</button>

                    </form>
                </div>
            </div>



        </div>



    </section>

    <script>
        document.getElementById("profile_image")?.addEventListener("change", function(event) {
            let file = event.target.files[0]; // Selected file
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("previewImage").src = e.target.result; // Show preview
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
