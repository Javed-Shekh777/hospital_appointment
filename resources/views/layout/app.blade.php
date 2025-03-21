<!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layout.head')
@section('title', 'Home')


<body>
    @include('layout.header')

    <main>
        @yield('content') <!-- Dynamic Content -->
    </main>

    @include('layout.footer')




  <!-- Vendor JS Files -->
  <script src="{{ secure_asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ secure_asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ secure_asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
 
  <!-- Main JS File -->
  <script src="{{ secure_asset('assets/js/main.js') }}"></script>

</body>

</html>
