@extends('private.layout.main')
@section('isi')


<div class="row justify-content-md-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }}</b></h4>
                <hr class="border-primary">
                <div class="card-text">
                    <p>Anda Telah Melakukan Pendaftaran Peserta Baru Pada Aplikasi Kami.</p>
                    <p>Apabila ada Kendala Terkait Pengoperasian Aplikasi Silakan Hubungi Call Center Kami, Terimakasih</p>
                </div>
            </div>

            <form action="{{ route('aktivasiAkun.store') }}" class="formData" method="POST">
                @csrf
                <div class="card-body">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="tombolSave">
                            <i class="fa fa-check-square-o"></i> <span class="d-sm-inline">Konfirmasi Akun</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="viewModal" style="display:none;"></div>
@endsection