@extends('private.layout.main')
@section('isi')
    <style>
        .table-hover tbody tr:hover {
            background-color: #b4d6f7 !important;
            /* warna biru muda */
            transition: background-color 0.3s ease;
            cursor: pointer;
        }
    </style>
    <div class="content-body">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">
                    <i class="fas fa-building"></i> <b>{{ $title }}</b>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="DataTables_Table_0" class="table table-striped table-hover  zero-configuration"
                        style="width:100%; font-size:10px;">
                        <thead class="thead-dark">
                            <tr>
                                <th width="1%"><i class="fas fa-list-ol"></i> No</th>
                                <th><i class="fas fa-calendar"></i> Tanggal Terdaftar</th>
                                <th><i class="fas fa-briefcase"></i> Badan Usaha</th>
                                <th><i class="fas fa-industry"></i> Nama Perusahaan / Personal</th>
                                <th><i class="fas fa-user-tie"></i> Nama Pemimpin / Pemilik</th>
                                <th><i class="fas fa-envelope"></i> Email</th>
                                <th><i class="fas fa-phone"></i> No Handphone</th>
                                <th><i class="fas fa-map-marker-alt"></i> Alamat</th>
                                <th><i class="fas fa-map-marker-alt"></i> Kendaraan</th>
                                <th><i class="fas fa-map-marker-alt"></i> Masuk</th>
                                <th><i class="fas fa-map-marker-alt"></i> Proses</th>
                                <th><i class="fas fa-map-marker-alt"></i> Selesai</th>
                                <th><i class="fas fa-map-marker-alt"></i> Tolak</th>
                                <th width="10%"><i class="fas fa-cogs"></i> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $resultB)
                                <tr>
                                    <td align="center"><b>{{ $loop->iteration }}</b></td>
                                    <td>{{ cek_date_ddmmyyyy_his_v1($resultB->created_at) }}</td>
                                    <td>{{ $resultB->nm_badan_usaha }}</td>
                                    <td>{{ $resultB->nm_perusahaan_personal }}</td>
                                    <td>{{ $resultB->nm_pimpinan_pemilik }}</td>
                                    <td>{{ $resultB->email }}</td>
                                    <td>{{ $resultB->no_telp }}</td>
                                    <td style="white-space: nowrap;">
                                        {{ \Illuminate\Support\Str::limit($resultB->alamat_biodata, 40) }}
                                    </td>
                                    <td align="center">{{ $resultB->jml_kendaraan }}</td>
                                    <td align="center">{{ $resultB->jml_masuk }}</td>
                                    <td align="center">{{ $resultB->jml_proses }}</td>
                                    <td align="center">{{ $resultB->jml_selesai }}</td>
                                    <td align="center">{{ $resultB->jml_tolak }}</td>
                                    <td align="center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button type="button" class="btn btn-sm btn-secondary mr-1"
                                                id="tombolModalForm"
                                                data-url="{{ route('badanUsaha_detail', $resultB->id_biodata) }}"
                                                title="Lihat Data">
                                                <i class="fa fa-id-card"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="viewModal" style="display:none;"></div>
    <div class="viewModal2" style="display:none;"></div>

    {{-- Tambahkan Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
@endsection
