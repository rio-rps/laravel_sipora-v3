<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('images/logo/logo_prov.png') }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('private/images/ico/favicon.ico') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('private/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('private/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('private/vendors/css/forms/icheck/custom.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/components.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/pages/login-register.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<style>
    .bg-utama {
        /* background-image: url('public/images/profil/bg.jpg'); */
        background-image: url("{{ asset('images/logo/bg.jpeg') }}");
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
    }
</style>

<body class="vertical-layout vertical-menu 1-column  bg-utama blank-page blank-page" data-open="click"
    data-menu="vertical-menu" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <!-- <div class="card-title text-center">
                                        <div class="p-1"><img src="{{ asset('/') }}private/images/logo/stack-logo-dark.png" alt="branding logo"></div>
                                    </div> -->
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span style="font-weight:bold;font-size:15px;">BUAT AKUN LOGIN</span></h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        @error('keterangan')
                                            <div class="alert alert-danger mg-b-0" role="alert">
                                                <button aria-label="Close" class="close" data-bs-dismiss="alert"
                                                    type="button">
                                                    <span aria-hidden="true">×</span>
                                                </button> {{ $message }}
                                            </div>
                                        @enderror


                                        <form action="{{ url('register/do_register') }}" method="post"
                                            class="form-horizontal form-simple" novalidate>
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                                <input type="text"
                                                    class="form-control form-control-lg @error('name') is-invalid @enderror mb-1"
                                                    name="name" autofocus placeholder="Masukan Nama" type="text"
                                                    value="{{ old('name') }}">
                                                <div class="form-control-position">
                                                    <i class="feather icon-user"></i>
                                                </div>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                                <input type="text" autocomplete="none"
                                                    class="form-control form-control-lg @error('email') is-invalid @enderror mb-1"
                                                    name="email" placeholder="Masukkan Email" type="text"
                                                    value="{{ old('email') }}">
                                                <div class="form-control-position">
                                                    <i class="feather icon-mail"></i>
                                                </div>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </fieldset>
                                            <button type="submit" class="btn btn-success btn-lg btn-block"><i
                                                    class="feather icon-unlock"></i> DAFTAR</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="">
                                        <p class="float-sm-left text-center m-0"><a href="#"
                                                data-toggle="modal" data-target="#my-modal" class="card-link">Lupa
                                                Password</a></p>
                                        <p class="float-sm-right text-center m-0">Punya Akun ? <a
                                                href="{{ route('login') }}" class="card-link">Login</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('private/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('private/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('private/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('private/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('private/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('private/js/scripts/forms/form-login-register.js') }}"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>

<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel5"><b>LUPA PASSWORD</b></h4>
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apabila lupa password silakan hubungi call center kami.</p>
                <p><i class="fa fa-phone-square"></i> 0821321231</p>
                <p>atau Anda bisa juga mengunjungi kantor kami Dinas Perhubungan Sumatera Selatan</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>
