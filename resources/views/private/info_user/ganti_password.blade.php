@extends('private.layout.main')

@section('isi')
    <div class="content-body">
        <div class="card shadow-sm border-0">
            <div class="card-header  bg-secondary text-white d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">
                    <i class="fa fa-info-circle mr-2 text-primary"></i><strong>INFORMASI</strong>
                </h4>
            </div>

            @if (getSttsUser() == 2)
                <div class="card-body">
                    <div class="bs-callout-danger callout-border-left callout-bordered mt-1 p-1">
                        <h4 class="alert-heading mb-1"><i class="fa fa-shield mr-1"></i> Peringatan Keamanan</h4>
                        <p>
                            Saat ini akun Anda <b>di Blokir</b>. Silakan Hubungi Admin
                        </p>
                        <p class="mb-0">
                            <a href="{{ route('logout') }}" class="font-weight-bold">Klik Logout</a>
                        </p>
                    </div>
                </div>
            @elseif (getSttsUser() == 3)
                {{-- Password Wajib Diganti --}}
                <div class="card-body">
                    <div class="bs-callout-danger callout-border-left callout-bordered mt-1 p-1">
                        <h4 class="alert-heading mb-1"><i class="fa fa-shield mr-1"></i> Peringatan Keamanan</h4>
                        <p>
                            Kami mendeteksi bahwa kondisi password Anda <b>tidak aman</b>
                        </p>
                        <p>
                            Untuk melindungi akun Anda, silakan segera melakukan perubahan password.
                        </p>
                        <p class="mb-0">
                            <a href="{{ route('pengaturanakun.index') }}" class="font-weight-bold">Klik di sini untuk
                                memperbaiki</a>
                        </p>
                    </div>
                </div>
            @elseif (getSttsUser() == 4)
                {{-- Password Lemah --}}

                <div class="card-body">
                    <div class="bs-callout-danger callout-border-left callout-bordered mt-1 p-1">
                        <h4 class="alert-heading mb-1"><i class="fa fa-shield mr-1"></i> Peringatan Keamanan</h4>
                        <p>
                            Kami mendeteksi bahwa password Anda termasuk kategori <b>lemah</b>
                        </p>
                        <p>
                            Disarankan untuk segera memperkuat password demi keamanan akun.
                        </p>
                        <p class="mb-0">
                            <a href="{{ route('pengaturanakun.index') }}" class="font-weight-bold">Klik di sini untuk
                                memperbaiki</a>
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
