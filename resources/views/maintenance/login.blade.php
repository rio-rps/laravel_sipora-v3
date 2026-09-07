<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Maintenance - SIPORA</title>
    <link rel="apple-touch-icon" href="{{ asset('images/logo/logo_dishub.jpg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/logo_dishub.jpg') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 20px;

            font-family: "Segoe UI", Arial, sans-serif;

            background:
                radial-gradient(circle at top left,
                    rgba(30, 136, 229, .18),
                    transparent 40%),
                linear-gradient(135deg,
                    #071c33 0%,
                    #0d3558 50%,
                    #0b5a78 100%);
        }

        .login-card {
            width: 100%;
            max-width: 430px;

            padding: 40px;

            background: rgba(255, 255, 255, .97);

            border-radius: 22px;

            box-shadow:
                0 30px 80px rgba(0, 0, 0, .35);
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo img {
            width: 110px;
            height: auto;
        }

        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand h1 {
            margin: 0;

            color: #16324f;

            font-size: 25px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .brand p {
            margin: 7px 0 0;

            color: #64748b;

            font-size: 12px;
        }

        .maintenance-label {
            display: flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            margin-bottom: 25px;

            color: #ea580c;

            font-size: 12px;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;

            margin-bottom: 7px;

            color: #334155;

            font-size: 13px;
            font-weight: 600;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;

            top: 50%;
            left: 15px;

            transform: translateY(-50%);

            color: #94a3b8;
        }

        .form-control {
            width: 100%;

            height: 45px;

            padding: 0 15px 0 43px;

            border: 1px solid #e2e8f0;

            border-radius: 10px;

            outline: none;

            color: #334155;

            font-size: 13px;

            transition: .2s;
        }

        .form-control:focus {
            border-color: #0284c7;

            box-shadow:
                0 0 0 3px rgba(2, 132, 199, .10);
        }

        .btn-login {
            width: 100%;

            height: 46px;

            margin-top: 10px;

            border: 0;

            border-radius: 10px;

            background:
                linear-gradient(135deg,
                    #075985,
                    #0284c7);

            color: #ffffff;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;

            transition: .2s;
        }

        .btn-login:hover {
            transform: translateY(-1px);

            box-shadow:
                0 8px 20px rgba(2, 132, 199, .25);
        }

        .alert {
            padding: 12px 14px;

            margin-bottom: 20px;

            border-radius: 9px;

            font-size: 12px;
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
        }

        .footer {
            margin-top: 25px;

            padding-top: 20px;

            text-align: center;

            border-top: 1px solid #e2e8f0;

            color: #94a3b8;

            font-size: 11px;
            line-height: 1.6;
        }

        .footer strong {
            color: #475569;
        }

        @media (max-width: 480px) {

            .login-card {
                padding: 30px 25px;
            }

            .logo img {
                width: 90px;
            }

        }
    </style>

</head>

<body>

    <div class="login-card">

        {{-- LOGO --}}
        <div class="logo">

            <img src="{{ asset('images/logo/logo_prov1.png') }}" alt="Pemerintah Provinsi Sumatera Selatan">

        </div>


        {{-- BRAND --}}
        <div class="brand">

            <h1>SIPORA</h1>

            <p>
                Sistem Informasi Pengawasan Angkutan Orang dan Barang
            </p>

        </div>


        {{-- LABEL --}}
        <div class="maintenance-label">

            <i class="fas fa-tools"></i>

            LOGIN PENGELOLA MAINTENANCE

        </div>


        {{-- ERROR --}}
        @if (session('error'))
            <div class="alert alert-danger">

                <i class="fas fa-exclamation-circle"></i>

                {{ session('error') }}

            </div>
        @endif


        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="alert alert-success">

                <i class="fas fa-check-circle"></i>

                {{ session('success') }}

            </div>
        @endif


        {{-- VALIDATION --}}
        @if ($errors->any())
            <div class="alert alert-danger">

                {{ $errors->first() }}

            </div>
        @endif


        {{-- FORM --}}
        <form method="POST" action="{{ route('maintenance.proses') }}">

            @csrf


            {{-- email --}}
            <div class="form-group">

                <label>
                    Email
                </label>

                <div class="input-wrapper">

                    <i class="fas fa-user"></i>

                    <input type="text" name="email" class="form-control" value="{{ old('email') }}"
                        placeholder="Masukkan email" autocomplete="email" autofocus>

                </div>

            </div>


            {{-- PASSWORD --}}
            <div class="form-group">

                <label>
                    Password
                </label>

                <div class="input-wrapper">

                    <i class="fas fa-lock"></i>

                    <input type="password" name="password" class="form-control" placeholder="Masukkan password"
                        autocomplete="current-password">

                </div>

            </div>


            <button type="submit" class="btn-login">

                <i class="fas fa-sign-in-alt"></i>

                &nbsp;

                Masuk ke Maintenance

            </button>

        </form>


        {{-- FOOTER --}}
        <div class="footer">

            <strong>SIPORA</strong>

            <br>

            Pemerintah Provinsi Sumatera Selatan

        </div>

    </div>

</body>

</html>
