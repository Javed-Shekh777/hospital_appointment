@extends('layout.auth')

@section('title', 'My Profile')

@section('authcontent')
    <section class="my-profile" id="my-profile">
        <div class="container">


            <div class="row forum active" id="forum">
                <div class="col-lg-5">
                    <div class="  profile-images ">
                        <div class="image profile-image">

                            <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('assets/img/profile_pic.svg') }}"
                                alt="" class="img-fluid rounded "
                                style="height: 150px;width:150px;object-fit:cover;">
                        </div>
                    </div>
                    <h1 class="username">{{ Auth::user()->fullname }}</h1>
                    <div class="horizontal"></div>
                    <div class="contact-information">
                        <h3 class="section-title">Contact information</h3>
                        <div class="info1">
                            <p class="label">Email id:</p>
                            <p class="email">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="info1">
                            <p class="label">Phone:</p>
                            <p class="phone">{{ Auth::user()->phone }}</p>
                        </div>
                        <div class="info1">
                            <p class="label">Address:</p>
                            <p>{{ Auth::user()->address }}</p>
                        </div>
                    </div>

                    <div class="basic-information">
                        <h3 class="section-title">basic information</h3>
                        <div class="info1">
                            <p class="label">Gender:</p>
                            <p>{{ Auth::user()->gender }}</p>
                        </div>
                        <div class="info1">
                            <p class="label">Birthday:</p>
                            <p>{{ Auth::user()->dob }}</p>
                        </div>
                    </div>

                    <div class="buttons">
                        <button type="button" id="profile-form-btn" class="edit">Edit</button>

                    </div>
                </div>
            </div>


            <div class="row profile-form" id="profile-form">
                <form action="{{ route('my-profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-5">
                        <div class="  profile-images ">
                            <div class="image profile-image">
                                <img src="{{ Auth::user()->profile_image
                                    ? asset('storage/' . Auth::user()->profile_image)
                                    : asset('assets/img/profile_pic.svg') }}"
                                    alt="" class="img-fluid rounded "
                                    style="height: 150px;width:150px;object-fit:cover;">
                            </div>
                            <div class="image profile-image">
                                <label for="profile_image" style="cursor: pointer;" class="">
                                    <input type="file" class="form-control d-none" name="profile_image"
                                        id="profile_image" accept="image/*">
                                    <img id="previewImage" style="height: 150px;width:150px;object-fit:cover;"
                                        src="{{ asset('assets/img/upload_area.svg') }}" class="img-fluid rounded"
                                        alt="Profile Image">
                                </label>
                            </div>
                        </div>
                        <h1 class="username">
                            <input type="text" value="{{ Auth::user()->fullname }}" name="fullname">
                        </h1>
                        <div class="horizontal"></div>
                        <div class="contact-information">
                            <h3 class="section-title">Contact information</h3>
                            <div class="info1">
                                <p class="label">Email id:</p>

                                <p class="email">
                                    <input type="text" name="email" id="email" value="{{ Auth::user()->email }}">
                                </p>
                            </div>
                            <div class="info1">
                                <p class="label">Phone:</p>
                                <p class="phone">
                                    <input type="text" name="phone" id="phone" value="{{ Auth::user()->phone }}">
                                </p>
                            </div>
                            <div class="info1">
                                <p class="label">Address:</p>
                                <p>
                                    <textarea name="address" id="address">
                                {{ Auth::user()->address }}
                            </textarea>
                                </p>
                            </div>
                        </div>

                        <div class="basic-information">
                            <h3 class="section-title">basic information</h3>
                            <div class="info1">
                                <p class="label"><label for="gender">Gender</label></p>
                                <p>
                                    Male: <input type="radio" name="gender" value="Male"
                                        {{ old('gender', Auth::user()->gender) == 'Male' ? 'checked' : '' }}
                                        id="gender_male">
                                    Female: <input type="radio" name="gender" value="Female"
                                        {{ old('gender', Auth::user()->gender) == 'Female' ? 'checked' : '' }}
                                        id="gender_female">
                                    Other: <input type="radio" name="gender" value="Other"
                                        {{ old('gender', Auth::user()->gender) == 'Other' ? 'checked' : '' }}
                                        id="gender_other">
                                </p>
                            </div>
                            <div class="info1">
                                <p class="label">Birthday:</p>
                                <p> <input type="date" name="dob" id="dob"
                                        value="{{ Auth::user()->dob }}">
                                </p>
                            </div>
                        </div>

                        <div class="buttons">
                            <button href="#" id="profile-form-close" class="save">Save information</button>

                        </div>
                    </div>
                </form>

            </div>

        </div>
    </section>


@endsection
