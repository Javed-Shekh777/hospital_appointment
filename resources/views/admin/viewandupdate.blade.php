@extends('admin.main')


@section('title', 'View And Update User')

@section('sidebarcontent')
    <section class=" ">

        <div class="container-fluid mx-sm-4   mx-2 py-3 add-doctor">
            <div class="section-title fs-4 mb-1 pb-0 text-center ">View And Update User</div>

            <div class="row h-100">
                <div class="col-xl-8 col-md-12   mx-lg-auto border border-success rounded px-sm-4  px-2">
                    <form action="{{ route('admin.all-users.update', $user->id) }}" class="row" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="my-2 d-flex align-items-center gap-2 flex-wrap">
                            <img src="{{ str_starts_with($user->profile_image, 'profile_images/')
                                ? asset('storage/' . $user->profile_image)
                                : asset($user->profile_image) }}"
                                style="width: 100px;height: 100px;object-fit: cover;border-radius: 50%;"
                                class="rounded-circle img-fluid" alt="{{$user->profile_image}}">

                            <label for="profile_image" style="cursor: pointer;" class="border rounded-circle">
                                <input type="file" class="form-control d-none" name="profile_image" id="profile_image"
                                    accept="image/*">
                                <img id="previewImage" src="{{ asset('assets/img/upload.svg') }}"
                                    style="width: 100px;height: 100px;object-fit: cover;border-radius: 50%;"
                                    class="rounded-circle img-fluid" alt="Profile Image">
                            </label>

                            <h4 class="ms-3">Upload User Picture</h4>
                        </div>

                        <div class="row  ">
                            <div class="col-lg-6  mb-3">
                                <label for="fullname" class="form-label">User name</label>
                                <input type="text" class="form-control" name="fullname"
                                    value="{{ old('fullname', $user->fullname) }}" id="fullname" placeholder="Name">
                                @if ($errors->has('fullname'))
                                    <span style="color: red;">{{ $errors->first('fullname') }}</span>
                                @endif
                            </div>

                            <div class="col-lg-6  mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email"
                                    value="{{ old('email', $user->email) }}" id="email" placeholder="Name">
                                @if ($errors->has('email'))
                                    <span style="color: red;">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row  ">
                            <div class="col-lg-6 mb-3">
                                <label for="dob" class="form-label">DOB</label>
                                <input type="date" name="dob" value="{{ old('dob', $user->dob) }}"
                                    class="form-control" id="dob">
                                @if ($errors->has('dob'))
                                    <span style="color: red;">{{ $errors->first('dob') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" value="{{ old('phone', $user->phone) }}" class="form-control"
                                    name="phone" id="phone" placeholder="Your Phone">
                                @if ($errors->has('phone'))
                                    <span style="color: red;">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="row ">
                            <div class="col-lg-6 mb-3">
                                <label for="status" class="form-label w-100">Status</label>
                                @if ($user->appointments->count() > 0)
                                    <span class="  bg-success btn ">Active</span>
                                @else
                                    <span class="  bg-secondary btn">Inactive</span>
                                @endif

                            </div>
                            <div class="col-lg-6 ">
                                <label for="address" class="form-label">Address</label>
                                <textarea cols="3" rows="3" class="form-control mb-3" name="address" id="address" placeholder="Address">{{ old('address', $user->address) }}</textarea>
                                @if ($errors->has('address'))
                                    <span style="color: red;">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>

                       


                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role"
                                    aria-label="Default select example">
                                    @php
                                        $roles = ['admin', 'patient', 'doctor'];
                                    @endphp
                                    @foreach ($roles as $item)
                                        <option value="{{ $item }}"
                                            {{ old('role', $user->role) == $item ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach


                                </select>
                                @if ($errors->has('role'))
                                    <span style="color: red;">{{ $errors->first('role') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="gender" class="form-label">Gender</label>

                                <div class="d-flex">

                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="gender" value="Male"
                                            id="gender_male" {{ old('gender', $user->gender) == 'Male' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gender">Male</label>
                                    </div>
                                    <div class="form-check ms-1 ">
                                        <input class="form-check-input" type="radio" name="gender" value="Male"
                                            id="gender_female" {{ old('gender', $user->gender) == 'Female' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender">Female</label>
                                    </div>
                                    <div class="form-check ms-1">
                                        <input class="form-check-input" type="radio" name="gender" value="Male"
                                            id="gender_other" {{ old('gender', $user->gender) == 'Other' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gender">Other</label>
                                    </div>
    
                                </div>
                            
                                @if ($errors->has('gender'))
                                    <span style="color: red;">{{ $errors->first('gender') }}</span>
                                @endif
                            </div>
                             
                        </div>

                     

                        
                        <div class="row" id="roleDoctorMax" style="display: none;">
                            <div class="col-lg-6 mb-3">
                                <label for="fees" class="form-label">Fees</label>
                                <input type="number" value="{{ old('fees') }}" class="form-control"
                                    name="fees" id="fees" placeholder="Your fees">
                                @if ($errors->has('fees'))
                                    <span style="color: red;">{{ $errors->first('fees') }}</span>
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
                                            {{ old('speciality') == $item ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('speciality'))
                                    <span style="color: red;">{{ $errors->first('speciality') }}</span>
                                @endif
                            </div>

                        </div>

                        <div class="row" id="education" style="display: none;">
                            <div class="col-lg-6 mb-3">
                                <label for="experience" class="form-label">Experience</label>
                                <select class="form-select" id="experience" name="experience"
                                    aria-label="Default select example">
                                    @php
                                        $experiences = ['1', '2', '3', '5', '7', '10', '15'];
                                    @endphp
                                    @foreach ($experiences as $item)
                                        <option value="{{ $item }}"
                                            {{ old('experience') == $item ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach


                                </select>
                                @if ($errors->has('experience'))
                                    <span style="color: red;">{{ $errors->first('experience') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="education" class="form-label">Education</label>
                                <input type="text" value="{{ old('education') }}"
                                    class="form-control" name="education" id="education" placeholder="Your Education">
                                @if ($errors->has('education'))
                                    <span style="color: red;">{{ $errors->first('education') }}</span>
                                @endif
                            </div>

                        </div>

                        @if($user->role == 'doctor')
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="fees" class="form-label">Fees</label>
                                <input type="number" value="{{ old('fees', optional($user->doctor)->fees) }}" class="form-control"
                                    name="fees" id="fees" placeholder="Your fees">
                                @if ($errors->has('fees'))
                                    <span style="color: red;">{{ $errors->first('fees') }}</span>
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
                                            {{ old('speciality', optional($user->doctor)->speciality) == $item ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('speciality'))
                                    <span style="color: red;">{{ $errors->first('speciality') }}</span>
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
                                            {{ old('experience', optional($user->doctor)->experience) == $item ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach


                                </select>
                                @if ($errors->has('experience'))
                                    <span style="color: red;">{{ $errors->first('experience') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="education" class="form-label">Education</label>
                                <input type="text" value="{{ old('education', optional($user->doctor)->education) }}"
                                    class="form-control" name="education" id="education" placeholder="Your Education">
                                @if ($errors->has('education'))
                                    <span style="color: red;">{{ $errors->first('education') }}</span>
                                @endif
                            </div>
                        </div>

                        @if($user->doctor->slots && count($user->doctor->slots) > 0)
                        <button type="button" style="width: fit-content;" class="btn  ms-auto btn-primary mb-3 me-2" id="add_slot">+ Add Slot</button>

                            @foreach($user->doctor->slots as $slot)
                            <div class="row">
                                <input type="hidden" name="slot_id[]" value="{{ $slot->id }}">
                                <div class="col-lg-6 mb-3">
                                    <label for="slot_date" class="form-label">Available Date</label>
                                    <input type="date" class="form-control" value="{{old('slot_date',$slot->date)}}" name="slot_date[]" id="slot_date">
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <label for="slot_start_time" class="form-label">Start Time</label>
                                    <input type="time" class="form-control" value="{{old('start_time',$slot->start_time)}}" name="slot_start_time[]" id="slot_start_time">
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <label for="slot_end_time" class="form-label">End Time</label>
                                    <input type="time" class="form-control"  value="{{old('end_time',$slot->end_time)}}" name="slot_end_time[]" id="slot_end_time">
                                </div>
                            </div>
                            @endforeach
                        <div id="slot_container"></div>

                        @endif
                        @endif

                        
                        <div class="addSlots" id="addSlots" style="display: none;">
                            
                        <button type="button" style="width: fit-content;" class="btn  ms-auto btn-primary mb-3 " id="add_slot">+ Add Slot</button>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="slot_date" class="form-label">Available Date</label>
                                <input type="date" class="form-control" name="slot_date[]" id="slot_date">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="slot_start_time" class="form-label">Start Time</label>
                                <input type="time" class="form-control" name="slot_start_time[]" id="slot_start_time">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="slot_end_time" class="form-label">End Time</label>
                                <input type="time" class="form-control" name="slot_end_time[]" id="slot_end_time">
                            </div>
                        </div>
                        
                        
                        <!-- Here new slots will be added -->
                        <div id="slot_container"></div>
                        </div>
                      

                      
                        <div class="row" class="roleDoctorAbout" id="roleDoctorAbout" style="display: none;">
                            <div class="mb-3">
                                <label for="about" class="form-label">About me</label>
                                <textarea class="form-control" id="about" name="about" rows="6" placeholder="write about yourself">{{ old('about') }}</textarea>
                                @if ($errors->has('about'))
                                    <span style="color: red;">{{ $errors->first('about') }}</span>
                                @endif
                            </div>
                        </div>
                        @if($user->role == 'doctor')
                        <div class="row">
                            <div class="mb-3">
                                <label for="about" class="form-label">About me</label>
                                <textarea class="form-control" id="about" name="about" rows="6" placeholder="write about yourself">{{ old('about', optional($user->doctor)->about) }}</textarea>
                                @if ($errors->has('about'))
                                    <span style="color: red;">{{ $errors->first('about') }}</span>
                                @endif
                            </div>
                        </div>
                        @endif


                        <div class="d-flex align-items-center gx-2 gap-2 justify-content-md-start justify-content-center my-3">
                            <button type="submit" class="btn create-btn px-3" style="width: fit-content;">Update User</button>
                            <a href="{{route('admin.allusers')}}" class="btn px-3 btn-secondary">Back</a>
                        </div>

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
