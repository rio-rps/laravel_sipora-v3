@extends('private.layout.main')

@section('isi')

    <div class="content-body">

        <div class="card shadow-sm border-0">

            {{-- HEADER --}}
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">

                <h4 class="card-title mb-0">
                    <i class="fa fa-info-circle mr-2 text-primary"></i>
                    <strong>INFORMASI</strong>
                </h4>

            </div>


            {{-- STATUS 2 --}}
            @if (getSttsUser() == 2)
                <div class="card-body">

                    <div class="bs-callout-danger callout-border-left callout-bordered mt-1 p-1">

                        <h4 class="alert-heading mb-1">
                            <i class="fa fa-shield mr-1"></i>
                            Peringatan Keamanan
                        </h4>

                        <p>
                            Saat ini akun Anda <b>di Blokir</b>.
                            Silakan Hubungi Admin.
                        </p>

                        <p class="mb-0">

                            <a href="{{ route('logout') }}" class="font-weight-bold">

                                Klik Logout

                            </a>

                        </p>

                    </div>

                </div>


                {{-- STATUS 3 --}}
            @elseif (getSttsUser() == 3)
                <div class="card-body">

                    <div class="bs-callout-danger callout-border-left callout-bordered mt-1 p-1">

                        <h4 class="alert-heading mb-1">

                            <i class="fa fa-shield mr-1"></i>
                            Password Wajib Diganti

                        </h4>

                        <p>
                            Kami mendeteksi bahwa password akun Anda
                            <b>dibuat oleh sistem</b>.
                        </p>

                        <p>
                            Untuk melindungi akun Anda,
                            silakan segera melakukan perubahan password.
                        </p>

                        <p class="mb-0">

                            <a href="{{ route('pengaturanakun.index') }}" class="font-weight-bold">

                                Klik di sini untuk mengganti password

                            </a>

                        </p>

                    </div>

                </div>


                {{-- STATUS 4 --}}
            @elseif (getSttsUser() == 4)
                <div class="card-body">

                    {{-- PASSWORD EXPIRED --}}
                    @if ($jenisPeringatan == 'password_expired')
                        <div class="bs-callout-danger callout-border-left callout-bordered mt-1 p-1">

                            <h4 class="alert-heading mb-1">

                                <i class="fa fa-clock-o mr-1"></i>
                                Password Telah Kedaluwarsa

                            </h4>

                            <p>
                                Password Anda telah melewati
                                <b>masa berlaku 30 hari</b>.
                            </p>

                            <p>
                                Demi keamanan akun, Anda diwajibkan
                                untuk mengganti password sebelum
                                dapat menggunakan sistem kembali.
                            </p>

                            <p class="mb-0">

                                <a href="{{ route('pengaturanakun.index') }}" class="font-weight-bold">

                                    Klik di sini untuk mengganti password

                                </a>

                            </p>

                        </div>


                        {{-- PASSWORD BELUM PERNAH DIUBAH --}}
                    @elseif ($jenisPeringatan == 'password_belum_diubah')
                        <div class="bs-callout-danger callout-border-left callout-bordered mt-1 p-1">

                            <h4 class="alert-heading mb-1">

                                <i class="fa fa-shield mr-1"></i>
                                Password Wajib Diganti

                            </h4>

                            <p>
                                Sistem belum mencatat tanggal perubahan
                                password akun Anda.
                            </p>

                            <p>
                                Demi keamanan akun, silakan segera
                                melakukan perubahan password.
                            </p>

                            <p class="mb-0">

                                <a href="{{ route('pengaturanakun.index') }}" class="font-weight-bold">

                                    Klik di sini untuk mengganti password

                                </a>

                            </p>

                        </div>


                        {{-- PASSWORD LEMAH --}}
                    @elseif ($jenisPeringatan == 'password_lemah')
                        <div class="bs-callout-danger callout-border-left callout-bordered mt-1 p-1">

                            <h4 class="alert-heading mb-1">

                                <i class="fa fa-shield mr-1"></i>
                                Password Lemah

                            </h4>

                            <p>
                                Kami mendeteksi bahwa password Anda
                                termasuk kategori <b>lemah</b>.
                            </p>

                            <p>
                                Disarankan untuk segera memperkuat
                                password demi keamanan akun Anda.
                            </p>

                            <p class="mb-0">

                                <a href="{{ route('pengaturanakun.index') }}" class="font-weight-bold">

                                    Klik di sini untuk memperkuat password

                                </a>

                            </p>

                        </div>
                    @endif

                </div>
            @endif

        </div>

    </div>

@endsection
