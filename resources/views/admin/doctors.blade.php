@extends('admin.main')


@section('title', 'All Doctors')

@section('sidebarcontent')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> {{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section class="top-doctors  " id="top-doctors">
        <div class="container-fluid  ">
            <div class="section-title fs-4 mb-3  px-3"> All Doctors</div>



            <div class="container  mt-2" id="dash-doctor">
                <div class="doctors">
                    @foreach ($doctors as $doctor)
                    
                        <div class="doctor" title="View Doctor Details">
                            <div class="doctor-img">
                                <img src="{{ str_starts_with($doctor->user->profile_image, 'profile_images/')
                                    ? asset('storage/' . $doctor->user->profile_image)
                                    : asset($doctor->user->profile_image) }}"
                                    class="img-fluid" alt="{{ $doctor->user->profile_image }}">
                                <div class="icons">
                                    <a class="edit" href="{{ route('admin.doctor.edit', $doctor->id) }}"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('admin.doctor.delete', $doctor->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="doctor-info">
                                <p class="doctor-isavailable"> <span></span>Available </p>
                                <h3 class="doctor-name">{{ $doctor->user->fullname }}</h3>
                                <p class="doctor-type">{{ $doctor->speciality }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection()
