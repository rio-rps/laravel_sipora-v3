@section('content')
    <style>
        .bgg {
            background-image: url('{{ asset('images/img/bg1.jpg') }}');
        }
    </style>

    <div class="container-fluid service py-5 bgg">
        <div class="container service-section py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h1 class="display-5 text-white mb-4">Akses Login</h1>
                <p class="mb-0 text-white">Apabila Anda sudah memiliki akun bisa melakukan login di sistem SIPORA.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-0 col-md-1 col-lg-2 col-xl-2"></div>
                <div class="col-md-10 col-lg-8 col-xl-8 wow fadeInUp" data-wow-delay="0.2s">

                    <div class="row">
                        <div class="col-0 col-md-1 col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8 wow fadeInUp" data-wow-delay="0.2s">

                            <div class="card shadow-lg border-1  service-days">
                                <div class="card-header bg-primary text-white">
                                    <h4 class="mb-0 text-white">
                                        <i class="fa fa-user me-2"></i>
                                        SIPORA
                                    </h4>
                                </div>

                                <form action="{{ route('proses') }}" method="POST" class="formActData">
                                    @csrf
                                    <div class="card-body p-4">
                                        {{-- Email --}}
                                        <div class="mb-3">
                                            <label for="email" class="form-label fs-6 fw-semibold">Email <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="fa fa-envelope text-muted"></i>
                                                </span>
                                                <input type="email" name="email" id="email"
                                                    class="form-control border-start-0 fs-6"
                                                    placeholder="Masukkan email...">
                                            </div>
                                        </div>

                                        {{-- Password --}}
                                        <div class="mb-3">
                                            <label for="password" class="form-label fs-6 fw-semibold">Password <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="fa fa-lock text-muted"></i>
                                                </span>
                                                <input type="password" name="password" id="password"
                                                    class="form-control border-start-0 fs-6"
                                                    placeholder="Masukkan password...">
                                                <button type="button" class="btn btn-outline-secondary" onclick="show()">
                                                    <i class="fa fa-eye-slash eye"></i>
                                                </button>
                                            </div>
                                        </div>


                                        {{-- Submit Button --}}
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary w-100  fs-5 py-2 tombolLogin"
                                                id="tombolActSave">
                                                <i class="fa fa-sign-in-alt fs-5"></i> Login
                                            </button>
                                        </div>

                                        {{-- Links --}}
                                        <div class="mt-3 text-center">
                                            <a href="#" id="tombol-act-modal"
                                                data-url="{{ route('mshow_lupa_email') }}" class="text-decoration-none">Lupa
                                                Email?</a> |
                                            <a href="#"id="tombol-act-modal"
                                                data-url="{{ route('mshow_lupa_password') }}"
                                                class="text-decoration-none">Lupa
                                                Password?</a> |
                                            <a href="{{ route('register') }}" class="text-decoration-none">Buat Akun
                                                Baru</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="viewModal" style="display:none;"></div>
    <script>
        function show() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
                $('.eye').removeClass("fa-eye-slash");
                $('.eye').addClass("fa-eye");
            } else {
                x.type = "password";
                $('.eye').addClass("fa-eye-slash");
                $('.eye').removeClass("fa-eye");
            }
        }
    </script>
@endsection('content')
