@extends('private.layout.main')
@section('isi')
    @if ($session == true)
        <div class="row ">
            <div class="col-md-12">
                <div style="overflow-x: auto;">
                    <div class="d-flex flex-nowrap">
                        <!-- Dikirim -->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-12 flex-shrink-0">
                            <div class="card shadow-sm border-left-primary py-1 px-2">
                                <div class="card-body py-2 px-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-paper-plane fa-2x text-primary mr-2"></i>
                                        <div>
                                            <div class="text-xs text-primary text-uppercase font-weight-bold mb-1">Permohonan
                                            </div>
                                            <div class="small font-weight-bold text-dark">{{ format_rupiah($dikirim) }}
                                                Dikirim
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Diproses -->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-12 flex-shrink-0">
                            <div class="card shadow-sm border-left-warning py-1 px-2">
                                <div class="card-body py-2 px-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-spinner fa-2x text-warning mr-2"></i>
                                        <div>
                                            <div class="text-xs text-warning text-uppercase font-weight-bold mb-1">
                                                Permohonan
                                            </div>
                                            <div class="small font-weight-bold text-dark">{{ format_rupiah($diproses) }}
                                                Diproses
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Diterima -->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-12 flex-shrink-0">
                            <div class="card shadow-sm border-left-success py-1 px-2">
                                <div class="card-body py-2 px-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-check-circle fa-2x text-success mr-2"></i>
                                        <div>
                                            <div class="text-xs text-success text-uppercase font-weight-bold mb-1">
                                                Permohonan
                                            </div>
                                            <div class="small font-weight-bold text-dark">{{ format_rupiah($diterima) }}
                                                Diterima
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ditolak -->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-12 flex-shrink-0">
                            <div class="card shadow-sm border-left-danger py-1 px-2">
                                <div class="card-body py-2 px-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-times-circle fa-2x text-danger mr-2"></i>
                                        <div>
                                            <div class="text-xs text-danger text-uppercase font-weight-bold mb-1">Permohonan
                                            </div>
                                            <div class="small font-weight-bold text-dark">{{ format_rupiah($ditolak) }}
                                                Ditolak
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">
                            <div class="list-group">
                                <a class="list-group-item list-group-item-action active">LOG ACTIVITY</a>
                                <a class="list-group-item  ">
                                    <div class="col-sm-12">
                                        <table class="table" style="font-size: 12px;">
                                            <thead>
                                                <tr>
                                                    <th width="1%">No</th>
                                                    <th width="20%">Tanggal</th>
                                                    <th>Log</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($Log as $LogAss)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td>{{ cek_date_ddmmyyyy_his_v1($LogAss->created_at) }}</td>
                                                        <td>{{ $LogAss->aktivitas }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3" class="text-danger">Hanya Menampilkan 10
                                                        Aktifitas Terakhir</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </a>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($session == false)
        <div class="content-body">
            <div class="card shadow-sm border-0">
                <div class="card-header  bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <i class="fa fa-info-circle mr-2 text-primary"></i><strong>INFORMASI</strong>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="bs-callout-danger callout-border-left callout-bordered mt-1 p-1">
                        <h4 class="danger">PENTING !</h4>
                        <p>
                            SILAKAN LENGKAPI BIODATA AGAR BISA MENGGUNAKAN SEMUA FITUR - FITUR MENU YANG TERSEDIA.<br>
                            LENGKAPI BIODATA : <a href="{{ route('biodata.index') }}">LINK</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    @endif
@endsection
