@section('content')
    <style>
        .bgg {
            background-image: url('{{ asset('images/img/bg1.jpg') }}');
        }
    </style>
    <div class="container-fluid service py-5 bgg">
        <div class="container service-section py-5">
            <div class="text-center mx-auto  wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="mb-2 fw-bold text-white">Terimakasih sudah melakukan
                    Register Akun</h4>
                <p class="mb-4 text-light">
                    Silakan login menggunakan akun yang terdaftar di sistem SIPORA.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8 col-xl-8 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="card shadow-lg border-1 service-days">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0 text-white">
                                <i class="fa fa-check-circle me-2"></i>Registrasi Berhasil
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless mb-4">
                                <tr>
                                    <th style="width: 35%;">Nama</th>
                                    <td style="width: 5%;">:</td>
                                    <td><strong>{{ $name }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td><strong>{{ $email }}</strong></td>
                                </tr>
                                @if ($passwordPlain != 0)
                                    <tr>
                                        <th>Password</th>
                                        <td>:</td>
                                        <td><strong>{{ $passwordPlain }}</strong></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="3">
                                        <div class="border-start border-4 border-warning ps-3 py-2 bg-light">
                                            @if ($passwordPlain != 0)
                                                Kami juga mengirimkan password ke email Anda,
                                            @endif
                                            Silakan cek kotak masuk/spam email
                                            Anda <strong>{{ $email }}</strong>
                                            untuk
                                            melihat password.<br>
                                            Demi keamanan, harap segera mengganti password tersebut setelah login.
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <div class="text-end">
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                    <i class="fa fa-sign-in-alt me-1"></i> Login Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection('content')
