<link rel="stylesheet" type="text/css" href="{{ asset('private/css/bootstrap.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('private/css/bootstrap-extended.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('private/css/colors.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('private/css/core/colors/palette-gradient.css') }}">
<!-- BEGIN: Content-->
<div class="content-body">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-lg-6 col-md-12 col-12 box-shadow-2 p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><b>{{ $title }}</b></h4>
                    <hr class="border-secondary">
                </div>


                <div class="card-body" style="margin-top: -45px;">
                    <div class="card">
                        <table style="vertical-align: top;" class="table-striped  " style="width:100%;">

                            <body>
                                <tr>
                                    <td style="vertical-align: top;">Tanggal Kirim Permohonan</td>
                                    <td style="vertical-align: top;"> :</td>
                                    <td style="vertical-align: top;">
                                        {{ cek_date_ddmmyyyy_his_v1($row->tgl_kirim_permohonan) }}</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Tanggal Proses</td>
                                    <td width="1%" style="vertical-align: top;">:</td>
                                    <td style="vertical-align: top;">
                                        {{ isset($row_validasi->tgl_validasi_proses) ? cek_date_ddmmyyyy_his_v1($row_validasi->tgl_validasi_proses) : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal DIsetujui</td>
                                    <td>:</td>
                                    <td>{{ isset($row_validasi->tgl_validasi_selesai) ? cek_ddmmyy_v1($row_validasi->tgl_validasi_selesai) : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>{!! status_permohonan($row_validasi->status_validasi) !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Badan Usaha</td>
                                    <td width="1%">:</td>
                                    <td style="vertical-align: top;">{{ $row->BadanUsaha->nm_badan_usaha }}</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Nama Perusahaan / Personal</td>
                                    <td width="1%" style="vertical-align: top;">:</td>
                                    <td style="vertical-align: top;">{{ $row->nm_perusahaan_personal }}</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Nama Pimpinan / Pemilik</td>
                                    <td width="1%" style="vertical-align: top;">:</td>
                                    <td style="vertical-align: top;">{{ $row->nm_pimpinan_pemilik }}</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Alamat</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td style="vertical-align: top;">{{ $row->alamat_biodata }}</td>
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
                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Jenis Permohonan</td>
                                    <td width="1%" style="vertical-align: top;">:</td>
                                    <td>{{ $row->JjenisPermohonan->nm_jenis_permohonan }}</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Permohonan</td>
                                    <td width="1%" style="vertical-align: top;">:</td>
                                    <td>{{ $row->JPermohonan->nm_par_permohonan }}</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Trayek</td>
                                    <td width="1%" style="vertical-align: top;">:</td>
                                    <td>{{ $row->id_trayek == 0 ? '-' : $row->Jtrayek->nm_trayek }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Angkutan</td>
                                    <td width="1%">:</td>
                                    <td>{{ $row->JjenisAngkutan->nm_jenis_angkutan }}</td>
                                </tr>
                                <tr>
                                    <td>Mengangkut</td>
                                    <td width="1%">:</td>
                                    <td>{{ $row->jmengangkut->nm_mengangkut }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Merek / Type kendaraan</td>
                                    <td width="1%">:</td>
                                    <td>{{ $row->JkendaraanMerek->nm_merek_kendaraan . ' / ' . $row->JkendaraanType->nm_type_kendaraan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama kendaraan</td>
                                    <td width="1%">:</td>
                                    <td>{{ $row->nm_kendaraan }}</td>
                                </tr>
                                <tr>
                                    <td>Plat No. Kendaraan</td>
                                    <td width="1%">:</td>
                                    <td>{{ $row->plat_no_kendaraan }}</td>
                                </tr>
                                <tr>
                                    <td>Daya Angkut Orang</td>
                                    <td width="1%">:</td>
                                    <td>{{ $row->daya_angkut_orang }}</td>
                                </tr>
                                <tr>
                                    <td>Daya Angkut Barang</td>
                                    <td width="1%">:</td>
                                    <td>{{ $row->daya_angkut_barang }} kg</td>
                                </tr>
                                <tr>
                                    <td>Tahun Pembuatan</td>
                                    <td width="1%">:</td>
                                    <td>{{ $row->thn_pembuatan }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Rangka</td>
                                    <td width="1%">:</td>
                                    <td>{{ $row->no_rangka }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Mesin</td>
                                    <td width="1%">:</td>
                                    <td>{{ $row->no_mesin }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Nomor Kartu Pengawas</td>
                                    <td width="1%" style="vertical-align: top;">:</td>
                                    <td style="vertical-align: top;">{{ $row_validasi->no_kartu_pengawas ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Tanggal SK</td>
                                    <td width="1%" style="vertical-align: top;">:</td>
                                    <td>{{ isset($row_validasi->tgl_sk) ? cek_ddmmyy_v1($row_validasi->tgl_sk) : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Nomor SK</td>
                                    <td width="1%" style="vertical-align: top;">:</td>
                                    <td style="vertical-align: top;">{{ $row_validasi->no_sk ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Tanggal Awal</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td>{{ isset($row_validasi->tgl_awal) ? cek_ddmmyy_v1($row_validasi->tgl_awal) : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Tanggal Akhir</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td>{{ isset($row_validasi->tgl_akhir) ? cek_ddmmyy_v1($row_validasi->tgl_akhir) : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>
                                </tr>
                                <tr class="alert alert-secondary">
                                    <td colspan="3">
                                        <span style="color:#FFFFFF;"> &nbsp;&nbsp; <i class=" fa fa-edit"></i>
                                            KIR</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: top;">Tanggal Awal</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td>{{ isset($row_validasi->tgl_kir_awal) ? cek_ddmmyy_v1($row_validasi->tgl_kir_awal) : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Tanggal Akhir</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td>{{ isset($row_validasi->tgl_kir_akhir) ? cek_ddmmyy_v1($row_validasi->tgl_kir_akhir) : '-' }}
                                    </td>
                                </tr>
                            </body>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
