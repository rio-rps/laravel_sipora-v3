<style>
    @media print {
        .bg-primary {
            background-color: #0d6efd !important;
            color: white !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .text-white {
            color: white !important;
        }

        .fw-bold {
            font-weight: bold !important;
        }
    }
</style>

<script>
    //window.print();
</script>
<title>INFORMASI KARTU PENGAWAS</title>
<link rel="stylesheet" type="text/css" href="{{ asset('private/css/bootstrap.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('private/css/bootstrap-extended.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="apple-touch-icon" href="{{ asset('images/logo/logo_prov.png') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/logo_prov.png') }}">
<!-- BEGIN: Content-->
<div class="content-body">
    <div class="col-12 d-flex align-items-center justify-content-center mt-2">
        <div class="col-lg-6 col-md-12 col-12 box-shadow-2 p-0">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="card-title font-weight-bold">{{ $title }}</h4>
                </div>


                <div class="card-body">
                    <div class="card">
                        <table style="vertical-align: top;" class="table-striped  " style="width:100%;">

                            <body>
                                <tr>
                                    <td style="vertical-align: top;" width="40%">Tanggal Kirim Permohonan</td>
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
                                    <td>Tanggal Disetujui</td>
                                    <td>:</td>
                                    <td>{{ isset($row_validasi->tgl_validasi_selesai) ? cek_ddmmyy_v1($row_validasi->tgl_validasi_selesai) : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>PIC Validasi Data</td>
                                    <td>:</td>
                                    <td>{{ $row->nm_kabkota }}</td>
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
                                <td colspan="3" class="bg-info font-weight-bold">
                                    &nbsp; <i class="fa fa-edit"></i>
                                    BADAN USAHA
                                </td>
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
                                <td colspan="3" class="bg-info font-weight-bold">
                                    &nbsp; <i class="fa fa-edit"></i>
                                    PERMOHONAN
                                </td>
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
                                <td colspan="3" class="bg-info font-weight-bold">
                                    &nbsp; <i class="fa fa-edit"></i>
                                    DATA KENDARAAN
                                </td>
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
                                    <td>Warna TNKB</td>
                                    <td width="1%">:</td>
                                    <td>
                                        {{ $row->warna_tnkb ? $row->warna_tnkb : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bahan Bakar</td>
                                    <td width="1%">:</td>
                                    <td>
                                        {{ $row->bahan_bakar ? $row->bahan_bakar : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Daya Angkut Orang</td>
                                    <td width="1%">:</td>
                                    <td>{{ format_rupiah($row->daya_angkut_orang) }} Orang</td>
                                </tr>
                                <tr>
                                    <td>Daya Angkut Barang</td>
                                    <td width="1%">:</td>
                                    <td>{{ format_rupiah($row->daya_angkut_barang) }} kg</td>
                                </tr>
                                <tr>
                                    <td>Tahun Pembuatan</td>
                                    <td width="1%">:</td>
                                    <td>{{ $row->thn_pembuatan }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nomor Faktur Jual Beli</td>
                                    <td width="1%">:</td>
                                    <td>
                                        {{ $row->nmr_faktur_jual_beli ? $row->nmr_faktur_jual_beli : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Faktur</td>
                                    <td width="1%">:</td>
                                    <td>{{ $row->tgl_faktur_jual_beli ? cek_date_ddmmyyyy_his_v2($row->tgl_faktur_jual_beli) : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>
                                </tr>
                                <td colspan="3" class="bg-info font-weight-bold">
                                    &nbsp; <i class="fa fa-edit"></i>
                                    KARTU PENGAWAS
                                </td>
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
                                @php
                                    use Carbon\Carbon;
                                @endphp

                                <tr>
                                    <td style="vertical-align: top;">Tanggal Akhir</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td>
                                        @if (!empty($row_validasi->tgl_akhir))
                                            @php
                                                $tglAkhir = Carbon::parse($row_validasi->tgl_akhir);
                                            @endphp

                                            <span style="color: {{ $tglAkhir->isPast() ? 'red' : 'inherit' }};">
                                                {{ cek_ddmmyy_v1($row_validasi->tgl_akhir) }}
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>


                                <tr>
                                    <td style="vertical-align: top;">Status</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td>
                                        @if ($row->id_par_permohonan != 7)
                                            @if (!empty($row_validasi->tgl_akhir))
                                                @php
                                                    $tglAkhir = \Carbon\Carbon::parse($row_validasi->tgl_akhir);
                                                @endphp

                                                @if ($tglAkhir->isPast())
                                                    <span style="color: red; font-weight: bold;">
                                                        Masa Kartu Pengawas Sudah Habis, Silakan Hubungi Admin
                                                    </span>
                                                @else
                                                    <span style="color: green;">
                                                        Masih Berlaku
                                                    </span>
                                                @endif
                                            @else
                                                -
                                            @endif
                                        @else
                                            -
                                        @endif

                                    </td>
                                </tr>


                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Nomor Uji Kendaraan</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td>{{ $row->nomor_uji ? $row->nomor_uji : '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Kombinasi yang diperbolehkan</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td style="vertical-align: top;">
                                        {{ $row->kombinasi_yg_diperoleh ? $row->kombinasi_yg_diperoleh : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">SK Register Uji Type</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td>{{ $row->sk_reg_uji_type ? $row->sk_reg_uji_type : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Keterangan Lain-lain</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td style="vertical-align: top;">{{ $row->ket_lain ? $row->ket_lain : '-' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>
                                </tr>

                                <td colspan="3" class="bg-info font-weight-bold">
                                    &nbsp; <i class="fa fa-edit"></i>
                                    K I R
                                </td>

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
                                {{--  @if (getLevel() == 1 || getLevel() == 2)
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            @php
                                                $id = Crypt::encrypt($row->id_permohonan_izin);
                                            @endphp
                                            <a href="{{ route('laporan.cetakSuratRekomendasiKepala', $id) }}"
                                                class="btn btn-secondary mt-2" target="_blank">
                                                <i class="fa fa-print"></i> CETAK
                                            </a>
                                        </td>
                                    </tr>
                                @endif  --}}

                                @if (Auth::check() && getLevel())
                                    @if (in_array(getLevel(), [1, 2]))
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                @php
                                                    $id = Crypt::encrypt($row->id_permohonan_izin);
                                                @endphp
                                                <a href="{{ route('laporan.cetakSuratRekomendasiKepala', $id) }}"
                                                    class="btn btn-secondary mt-2" target="_blank">
                                                    <i class="fa fa-print"></i> CETAK
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @else
                                    {{--  <tr>
                                        <td colspan="3" class="text-center text-muted">
                                            <em>Silakan login untuk mencetak.</em>
                                        </td>
                                    </tr>  --}}
                                @endif


                            </body>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
