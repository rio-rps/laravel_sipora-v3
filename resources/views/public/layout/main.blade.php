<!DOCTYPE html>
<html lang="en">
<title>{{ config('app.name') }}</title>
<link rel="apple-touch-icon" href="{{ asset('images/logo/logo_dishub.jpg') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/logo_dishub.jpg') }}">

<head>
    <meta charset="utf-8">
    <title>SIPORA - SISTEM INFORMASI PENGAWASAN ANGKUTAN ORANG DAN BARANG</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="SIPORA" name="keywords">
    <meta content="SIPORA" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('public/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    @include('public.layout.nav')
    @yield('content')
    @include('public.layout.footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="{{ asset('private/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('public/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('public/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('public/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('public/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('public/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('public/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('private/js/myscript.js') }}"></script>
    <script src="{{ asset('private/js/myscriptpost.js') }}"></script>

    <script src="{{ asset('public/js/main.js') }}"></script>
    <script src="{{ asset('add-plugins/stylecjs.js') }}"></script>
</body>

</html>
