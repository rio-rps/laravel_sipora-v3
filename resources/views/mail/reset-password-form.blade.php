@section('content')
    <style>
        .bgg {
            background-image: url('{{ asset('images/img/bg1.jpg') }}');
        }

        .card-custom {
            border-radius: 1rem;
            overflow: hidden;
        }

        .form-control {
            border-radius: 0.5rem;
        }
    </style>
    <div class="container-fluid service py-5 bgg">
        <div class="container service-section py-5">
            <div class="text-center mx-auto  wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="mb-2 fw-bold text-white">Perubahan Password</h4>
                <p class="mb-4 text-light">
                    Silakan masukkan password baru Anda untuk bisa login ke sistem SIPORA.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card shadow-lg card-custom">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fa fa-unlock-alt me-2"></i> Atur Ulang Password</h4>
                        </div>
                        <div class="service-days p-4">
                            <form action="{{ route('password.update') }}" method="POST" class="formActData">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">

                                <!-- Password Baru -->
                                <div class="mb-4 position-relative">
                                    <label for="password" class="form-label fw-bold">Password Baru</label>
                                    <input type="password" name="password" autocomplete="off"
                                        class="form-control border-0 border-bottom rounded-0 ps-0 pe-5"
                                        placeholder="Masukkan password baru" id="password"
                                        oninput="checkPasswordStrength(this.value); checkPasswordMatch();">
                                    <button type="button"
                                        class="btn btn-sm btn-link position-absolute top-50 end-0 translate-middle-y"
                                        onclick="togglePassword('password', this)">
                                        <i class="fa fa-eye-slash"></i>
                                    </button>

                                    <!-- Line Strength -->
                                    <div class="mt-2">
                                        <div id="password-strength-bar"
                                            style="height: 5px; width: 100%; background: #e0e0e0;">
                                            <div id="password-strength-fill"
                                                style="height: 100%; width: 0%; background: red;"></div>
                                        </div>
                                        <small id="password-strength-text" class="form-text ms-1 mt-1 d-block"></small>
                                    </div>
                                </div>

                                <!-- Konfirmasi Password -->
                                <div class="mb-4 position-relative">
                                    <label for="password_confirmation" class="form-label fw-bold">Konfirmasi
                                        Password</label>
                                    <input type="password" name="password_confirmation" autocomplete="off"
                                        class="form-control border-0 border-bottom rounded-0 ps-0 pe-5"
                                        placeholder="Ulangi password baru" id="password_confirmation"
                                        oninput="checkPasswordMatch();">
                                    <button type="button"
                                        class="btn btn-sm btn-link position-absolute top-50 end-0 translate-middle-y"
                                        onclick="togglePassword('password_confirmation', this)">
                                        <i class="fa fa-eye-slash"></i>
                                    </button>

                                    <!-- Match Info -->
                                    <small id="password-match-text" class="form-text ms-1 mt-1 d-block"></small>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <div>
                                        <a href="{{ route('login') }}" class="text-decoration-none btn btn-link p-0">
                                            <i class="fa fa-arrow-left"></i> Kembali ke Halaman Login
                                        </a>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-success fs-5 py-2 tombolResetAct"
                                            id="tombolActSave">
                                            <i class="fa fa-check-circle me-2"></i>Reset Password
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection('content')
