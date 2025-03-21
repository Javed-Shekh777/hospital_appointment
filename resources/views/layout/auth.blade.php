<!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layout.head')
 

<body>
    @include('layout.header')

    <main>
        @yield('authcontent') <!-- Dynamic Content -->
    </main>





    <!-- Vendor JS Files -->
    <script src="{{ secure_asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ secure_asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ secure_asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ secure_asset('assets/js/main.js') }}"></script>
    <script>
        document.getElementById("profile_image").addEventListener("change", function(event) {
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

</body>

</html>
