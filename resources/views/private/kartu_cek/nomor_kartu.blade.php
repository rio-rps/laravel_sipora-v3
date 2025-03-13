@extends('private.layout.main')
@section('isi')


<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><b>{{ $title }}</b></h4>
            <hr class="border-secondary">
        </div>
        <div class="card-body" style="margin-top: -45px;">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="col-lg-6 col-md-12 col-12 ">
                    MASUKKAN NOMOR KARTU PENGAWAS
                </div>
            </div>
        </div>
    </div>
</div>
<div class="viewModal" style="display:none;"></div>
@endsection