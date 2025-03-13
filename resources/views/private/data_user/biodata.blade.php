@extends('private.layout.main')
@section('isi')


<div class="content-body">
    <div class="card">
        <div class="card-header">

            <h4 class="card-title"><b>{{ $title }}</b></h4>
            <hr class="border-secondary">
        </div>
        <div class="card-body" style="margin-top: -45px;">
            @if ($row)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="40%">Badan Usaha</td>
                            <td width="1%">:</td>
                            <td>{{ $row->BadanUsaha->nm_badan_usaha }}</td>
                        </tr>
                        <tr>
                            <td>Nama Perusahaan / Personal</td>
                            <td>:</td>
                            <td>{{ $row->nm_perusahaan_personal }}</td>
                        </tr>
                        <tr>
                            <td>Nama Pimpinan / Pemilik</td>
                            <td>:</td>
                            <td>{{ $row->nm_pimpinan_pemilik }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ $row->email }}</td>
                        </tr>
                        <tr>
                            <td>No Hp</td>
                            <td>:</td>
                            <td>{{ $row->no_telp }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @else
            <div class="card-body">
                <div class="alert alert-danger" role="alert">
                    Data Kosong, Pengguna Belum Mengupdate Data !
                </div>
            </div>
            @endif
        </div>
        <div class="card-footer">
        </div>
    </div>

</div>
@endsection