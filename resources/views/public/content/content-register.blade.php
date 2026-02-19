@section('content')
    <style>
        .bgg {
            background-image: url('{{ asset('images/img/bg1.jpg') }}');
        }
    </style>

    <div class="container-fluid service py-5 bgg">
        <div class="container service-section py-5">
            <div class="text-center mx-auto   wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="mb-2 fw-bold text-white">Registrasi Akun Perusahaan</h4>
                <p class="mb-4 text-light">
                    Untuk dapat menggunakan manfaat dari pelayanan sistem informasi pengawasan angkutan orang dan barang
                    silahkan meregistrasikan akun perusahaan Anda.
                </p>
            </div>

            <div class="row g-4 mt-0">
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-days p-4 " style="text-align: justify;">
                        <span class="fw-bold fs-5"><u>Tata Cara Registrasi :</u></span><br><br>
                        &nbsp;&nbsp;&nbsp;&nbsp; Tahap pertama yang wajib dilakukan yaitu melakukan Registrasi Akun untuk
                        mendapatkan akses ke pelayanan dengan mengisi form pada halaman Registrasi Akun.<br><br>
                        &nbsp;&nbsp;&nbsp;&nbsp; Pastikan anda mengisi data-data tersebut dengan data yang benar dan email
                        yang aktif, aktivasi user dan password akan dikirim ke email Anda.<br><br>
                        <b>Catatan:</b><br>
                        <ol class="fn-13">
                            <li>Registrasi akun hanya dapat dilakukan 1 kali saja.</li>
                            <li>Jika telah memiliki akun selanjutnya lakukan aktivasi dengan cara upload dokumen legalitas
                                perusahaan.</li>
                            <li>Pastikan akses anda disimpan dan tidak dishare ke pihak lain.</li>
                        </ol>
                    </div>
                </div>
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-days p-4">
                        <span class="fw-bold fs-5"><u>Form Registrasi :</u></span><br><br>
                        <form action="{{ route('store_register') }}" method="POST" class="formActData">
                            @csrf
                            <div class="row g-4">
                                <div class="mb-2 position-relative">
                                    <label for="name" class="form-label fs-5">Nama Perusahaan
                                        <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text">
                                            <i class="fa fa-user fs-5"></i>
                                        </span>
                                        <input type="text" class="form-control fs-5 " name="name" id="name"
                                            placeholder="Ketikan Nama Perusahaan...." autofocus>
                                    </div>
                                </div>
                                <div class="mb-2 position-relative">
                                    <label for="email" class="form-label fs-5">Email
                                        <span class="text-danger">*</span></label>
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text">
                                            <i class="fa  fa-envelope fs-5"></i>
                                        </span>
                                        <input type="text" autocomplete="off" class="form-control fs-5  " name="email"
                                            id="email" placeholder="Ketikan email....">
                                    </div>
                                </div>
                                {{--  {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}  --}}
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <div>
                                        <a href="{{ route('login') }}" class="text-decoration-none btn btn-link p-0">
                                            <i class="fa fa-arrow-left"></i> Kembali ke Halaman Login
                                        </a>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary w-100  fs-5 py-2 tombolRegister"
                                            id="tombolActSave">
                                            <i class="fa fa-unlock-alt fs-5"></i> Register Now</button>
                                    </div>
                                </div>



                                {{--  <div class="mt-3 text-center">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#my-modal"
                                        class="text-decoration-none">Lupa
                                        Password</a> |
                                    <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                                </div>  --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
