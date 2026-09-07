 <style>
     /* =====================================================
       BASE
    ===================================================== */
     body {
         background: #f4f6f9;
         font-family: Arial, Helvetica, sans-serif;
         font-size: 12px;
         color: #343a40;
     }

     .informasi-wrapper {
         max-width: 850px;
         margin: 20px auto;
     }

     .informasi-card {
         border: 0;
         border-radius: 10px;
         overflow: hidden;
         box-shadow: 0 4px 18px rgba(0, 0, 0, .08);
     }

     /* =====================================================
       HEADER
    ===================================================== */
     .informasi-header {
         background: linear-gradient(135deg, #17a2b8, #138496);
         color: #fff;
         padding: 16px 20px;
         display: flex;
         align-items: center;
         justify-content: space-between;
     }

     .informasi-header .header-title {
         margin: 0;
         font-size: 16px;
         font-weight: 700;
         letter-spacing: .2px;
     }

     .informasi-header .header-subtitle {
         font-size: 10px;
         opacity: .85;
         margin-top: 3px;
     }

     .informasi-header .header-icon {
         width: 38px;
         height: 38px;
         border-radius: 50%;
         background: rgba(255, 255, 255, .15);
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 17px;
     }

     /* =====================================================
       CONTENT
    ===================================================== */
     .informasi-body {
         background: #fff;
         padding: 18px;
     }

     .info-table {
         width: 100%;
         border-collapse: collapse;
     }

     .info-table td {
         padding: 6px 5px;
         vertical-align: top;
         border: 0;
         line-height: 1.45;
     }

     .info-table td:first-child {
         width: 34%;
         color: #6c757d;
         font-weight: 500;
     }

     .info-table td:nth-child(2) {
         width: 15px;
         color: #adb5bd;
         font-weight: 600;
     }

     .info-table td:last-child {
         color: #212529;
         font-weight: 600;
     }

     /* =====================================================
       SECTION
    ===================================================== */
     .section-title {
         display: flex;
         align-items: center;
         margin: 15px 0 7px;
         padding: 8px 10px;
         background: #f1f8fa;
         border-left: 3px solid #17a2b8;
         border-radius: 4px;
         color: #117a8b;
         font-size: 11px;
         font-weight: 700;
         text-transform: uppercase;
         letter-spacing: .2px;
     }

     .section-title i {
         margin-right: 7px;
         font-size: 12px;
     }

     .section-divider {
         border: 0;
         border-top: 1px solid #edf0f2;
         margin: 12px 0;
     }

     /* =====================================================
       STATUS
    ===================================================== */
     .badge-status {
         display: inline-flex;
         align-items: center;
         padding: 5px 9px;
         border-radius: 20px;
         font-size: 10px;
         font-weight: 600;
     }

     .badge-status i {
         margin-right: 5px;
     }

     .badge-aktif {
         background: #e8f7ee;
         color: #198754;
     }

     .badge-habis {
         background: #fdeaea;
         color: #dc3545;
     }

     .badge-neutral {
         background: #f1f3f5;
         color: #6c757d;
     }

     .status-date {
         margin-top: 3px;
         font-size: 9px;
         color: #8a9299;
     }

     /* =====================================================
       STATUS KENDARAAN
    ===================================================== */
     .masa-berlaku-box {
         border: 1px solid #e9ecef;
         border-radius: 7px;
         padding: 10px 12px;
         margin-bottom: 8px;
         background: #fff;
     }

     .masa-berlaku-box .masa-title {
         font-size: 10px;
         font-weight: 700;
         color: #495057;
         margin-bottom: 5px;
     }

     .masa-berlaku-box .masa-date {
         font-size: 11px;
         font-weight: 600;
         color: #212529;
     }

     /* =====================================================
       BUTTON
    ===================================================== */
     .btn-cetak {
         border-radius: 5px;
         font-size: 11px;
         font-weight: 600;
         padding: 7px 16px;
     }

     /* =====================================================
       RESPONSIVE
    ===================================================== */
     @media (max-width: 576px) {

         .informasi-wrapper {
             margin: 5px;
         }

         .informasi-body {
             padding: 10px;
         }

         .informasi-header {
             padding: 13px 14px;
         }

         .informasi-header .header-title {
             font-size: 14px;
         }

         .info-table td {
             padding: 5px 3px;
             font-size: 11px;
         }

         .info-table td:first-child {
             width: 38%;
         }

         .section-title {
             font-size: 10px;
         }
     }

     /* =====================================================
       PRINT
    ===================================================== */
     @media print {

         @page {
             size: A4;
             margin: 10mm;
         }

         body {
             background: #fff !important;
             font-size: 10px;
         }

         .informasi-wrapper {
             max-width: 100%;
             margin: 0;
         }

         .informasi-card {
             box-shadow: none !important;
             border: 1px solid #ddd;
         }

         .informasi-header {
             background: #17a2b8 !important;
             color: #fff !important;
             -webkit-print-color-adjust: exact;
             print-color-adjust: exact;
         }

         .section-title {
             background: #f1f8fa !important;
             -webkit-print-color-adjust: exact;
             print-color-adjust: exact;
         }

         .badge-aktif,
         .badge-habis,
         .badge-neutral {
             -webkit-print-color-adjust: exact;
             print-color-adjust: exact;
         }

         .btn-cetak {
             display: none !important;
         }

         .masa-berlaku-box {
             break-inside: avoid;
         }
     }
 </style>

 <title>INFORMASI KARTU PENGAWAS</title>

 <link rel="stylesheet" type="text/css" href="{{ asset('private/css/bootstrap.css') }}">

 <link rel="stylesheet" type="text/css" href="{{ asset('private/css/bootstrap-extended.css') }}">

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <link rel="apple-touch-icon" href="{{ asset('images/logo/logo_prov.png') }}">

 <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/logo_prov.png') }}">


 <div class="container-fluid">

     <div class="informasi-wrapper">

         <div class="card informasi-card">

             {{-- =================================================
                 HEADER
            ================================================== --}}
             <div class="informasi-header">

                 <div>
                     <div class="header-title">
                         <i class="fa fa-id-card-o mr-2"></i>
                         {{ $title }}
                     </div>

                     <div class="header-subtitle">
                         Informasi Permohonan dan Kartu Pengawas Kendaraan
                     </div>
                 </div>

                 <div class="header-icon">
                     <i class="fa fa-car"></i>
                 </div>

             </div>


             {{-- =================================================
                 BODY
            ================================================== --}}
             <div class="informasi-body">

                 <table class="info-table">

                     <tbody>

                         {{-- =================================================
                             INFORMASI PROSES
                        ================================================== --}}
                         <tr>
                             <td colspan="3">
                                 <div class="section-title">
                                     <i class="fa fa-info-circle"></i>
                                     Informasi Proses
                                 </div>
                             </td>
                         </tr>

                         <tr>
                             <td>Tanggal Kirim Permohonan</td>
                             <td>:</td>
                             <td>
                                 {{ cek_date_ddmmyyyy_his_v1($row->tgl_kirim_permohonan) }}
                             </td>
                         </tr>

                         <tr>
                             <td>Tanggal Proses</td>
                             <td>:</td>
                             <td>
                                 {{ isset($row_validasi->tgl_validasi_proses)
                                     ? cek_date_ddmmyyyy_his_v1($row_validasi->tgl_validasi_proses)
                                     : '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Tanggal Disetujui</td>
                             <td>:</td>
                             <td>
                                 {{ isset($row_validasi->tgl_validasi_selesai) ? cek_ddmmyy_v1($row_validasi->tgl_validasi_selesai) : '-' }}
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
                             <td>
                                 {!! status_permohonan($row_validasi->status_validasi) !!}
                             </td>
                         </tr>


                         {{-- =================================================
                             BADAN USAHA
                        ================================================== --}}
                         <tr>
                             <td colspan="3">
                                 <div class="section-title">
                                     <i class="fa fa-building-o"></i>
                                     Badan Usaha
                                 </div>
                             </td>
                         </tr>

                         <tr>
                             <td>Badan Usaha</td>
                             <td>:</td>
                             <td>
                                 {{ $row->BadanUsaha->nm_badan_usaha }}
                             </td>
                         </tr>

                         <tr>
                             <td>Nama Perusahaan / Personal</td>
                             <td>:</td>
                             <td>
                                 {{ $row->nm_perusahaan_personal }}
                             </td>
                         </tr>

                         <tr>
                             <td>Nama Pimpinan / Pemilik</td>
                             <td>:</td>
                             <td>
                                 {{ $row->nm_pimpinan_pemilik }}
                             </td>
                         </tr>

                         <tr>
                             <td>Alamat</td>
                             <td>:</td>
                             <td>
                                 {{ $row->alamat_biodata }}
                             </td>
                         </tr>

                         <tr>
                             <td>Email</td>
                             <td>:</td>
                             <td>{{ $row->email }}</td>
                         </tr>

                         <tr>
                             <td>No. HP</td>
                             <td>:</td>
                             <td>{{ $row->no_telp }}</td>
                         </tr>


                         {{-- =================================================
                             PERMOHONAN
                        ================================================== --}}
                         <tr>
                             <td colspan="3">
                                 <div class="section-title">
                                     <i class="fa fa-file-text-o"></i>
                                     Jenis Permohonan
                                 </div>
                             </td>
                         </tr>

                         <tr>
                             <td>Jenis Permohonan</td>
                             <td>:</td>
                             <td>
                                 {{ $row->JjenisPermohonan->nm_jenis_permohonan }}
                             </td>
                         </tr>

                         <tr>
                             <td>Permohonan</td>
                             <td>:</td>
                             <td>
                                 {{ $row->JPermohonan->nm_par_permohonan }}
                             </td>
                         </tr>

                         <tr>
                             <td>Trayek</td>
                             <td>:</td>
                             <td>
                                 {{ $row->id_trayek == 0 ? '-' : $row->Jtrayek->nm_trayek }}
                             </td>
                         </tr>

                         <tr>
                             <td>Jenis Angkutan</td>
                             <td>:</td>
                             <td>
                                 {{ $row->JjenisAngkutan->nm_jenis_angkutan }}
                             </td>
                         </tr>

                         <tr>
                             <td>Mengangkut</td>
                             <td>:</td>
                             <td>
                                 {{ $row->jmengangkut->nm_mengangkut }}
                             </td>
                         </tr>


                         {{-- =================================================
                             DATA KENDARAAN
                        ================================================== --}}
                         <tr>
                             <td colspan="3">
                                 <div class="section-title">
                                     <i class="fa fa-car"></i>
                                     Data Kendaraan
                                 </div>
                             </td>
                         </tr>

                         <tr>
                             <td>Merek / Type Kendaraan</td>
                             <td>:</td>
                             <td>
                                 {{ $row->JkendaraanMerek->nm_merek_kendaraan }}
                                 /
                                 {{ $row->JkendaraanType->nm_type_kendaraan }}
                             </td>
                         </tr>

                         <tr>
                             <td>Nama Kendaraan</td>
                             <td>:</td>
                             <td>{{ $row->nm_kendaraan }}</td>
                         </tr>

                         <tr>
                             <td>Plat No. Kendaraan</td>
                             <td>:</td>
                             <td>{{ $row->plat_no_kendaraan }}</td>
                         </tr>

                         <tr>
                             <td>Nomor Rangka</td>
                             <td>:</td>
                             <td>{{ $row->no_rangka }}</td>
                         </tr>

                         <tr>
                             <td>Nomor Mesin</td>
                             <td>:</td>
                             <td>{{ $row->no_mesin }}</td>
                         </tr>

                         <tr>
                             <td>Warna TNKB</td>
                             <td>:</td>
                             <td>
                                 {{ $row->warna_tnkb ?: '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Bahan Bakar</td>
                             <td>:</td>
                             <td>
                                 {{ $row->bahan_bakar ?: '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Daya Angkut Orang</td>
                             <td>:</td>
                             <td>
                                 {{ format_rupiah($row->daya_angkut_orang) }}
                                 Orang
                             </td>
                         </tr>

                         <tr>
                             <td>Daya Angkut Barang</td>
                             <td>:</td>
                             <td>
                                 {{ format_rupiah($row->daya_angkut_barang) }}
                                 kg
                             </td>
                         </tr>

                         <tr>
                             <td>Tahun Pembuatan</td>
                             <td>:</td>
                             <td>{{ $row->thn_pembuatan }}</td>
                         </tr>


                         {{-- =================================================
                             FAKTUR
                        ================================================== --}}
                         <tr>
                             <td colspan="3">
                                 <div class="section-title">
                                     <i class="fa fa-file-text"></i>
                                     Dokumen Jual Beli
                                 </div>
                             </td>
                         </tr>

                         <tr>
                             <td>Nomor Faktur Jual Beli</td>
                             <td>:</td>
                             <td>
                                 {{ $row->nmr_faktur_jual_beli ?: '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Tanggal Faktur</td>
                             <td>:</td>
                             <td>
                                 {{ $row->tgl_faktur_jual_beli ? cek_date_ddmmyyyy_his_v2($row->tgl_faktur_jual_beli) : '-' }}
                             </td>
                         </tr>


                         {{-- =================================================
                             KARTU PENGAWAS
                        ================================================== --}}
                         <tr>
                             <td colspan="3">
                                 <div class="section-title">
                                     <i class="fa fa-id-card"></i>
                                     Kartu Pengawas
                                 </div>
                             </td>
                         </tr>

                         <tr>
                             <td>Nomor Kartu Pengawas</td>
                             <td>:</td>
                             <td>
                                 {{ $row_validasi->no_kartu_pengawas ?? '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Tanggal SK</td>
                             <td>:</td>
                             <td>
                                 {{ isset($row_validasi->tgl_sk) ? cek_ddmmyy_v1($row_validasi->tgl_sk) : '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Nomor SK</td>
                             <td>:</td>
                             <td>
                                 {{ $row_validasi->no_sk ?? '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Tanggal Awal</td>
                             <td>:</td>
                             <td>
                                 {{ isset($row_validasi->tgl_awal) ? cek_ddmmyy_v1($row_validasi->tgl_awal) : '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Tanggal Akhir</td>
                             <td>:</td>
                             <td>

                                 @if (!empty($row_validasi->tgl_akhir))
                                     @php
                                         $tglAkhir = \Carbon\Carbon::parse($row_validasi->tgl_akhir);
                                     @endphp

                                     <strong>
                                         {{ cek_ddmmyy_v1($row_validasi->tgl_akhir) }}
                                     </strong>
                                 @else
                                     -
                                 @endif

                             </td>
                         </tr>

                         <tr>
                             <td>Status Kartu</td>
                             <td>:</td>
                             <td>

                                 @if ($row->id_par_permohonan != 7)

                                     @if (!empty($row_validasi->tgl_akhir))

                                         @php
                                             $tglAkhir = \Carbon\Carbon::parse($row_validasi->tgl_akhir);
                                         @endphp

                                         @if ($tglAkhir->isBefore(\Carbon\Carbon::today()))
                                             <span class="badge-status badge-habis">
                                                 <i class="fa fa-exclamation-circle"></i>
                                                 Masa Berlaku Habis
                                             </span>
                                         @else
                                             <span class="badge-status badge-aktif">
                                                 <i class="fa fa-check-circle"></i>
                                                 Masih Berlaku
                                             </span>
                                         @endif
                                     @else
                                         <span class="badge-status badge-neutral">
                                             -
                                         </span>

                                     @endif
                                 @else
                                     <span class="badge-status badge-neutral">
                                         -
                                     </span>

                                 @endif

                             </td>
                         </tr>


                         {{-- =================================================
                             DATA REGISTER UJI
                        ================================================== --}}
                         <tr>
                             <td colspan="3">
                                 <div class="section-title">
                                     <i class="fa fa-certificate"></i>
                                     INFORMASI TAMBAHAN DATA KENDARAAN
                                 </div>
                             </td>
                         </tr>

                         <tr>
                             <td>Nomor Uji Kendaraan</td>
                             <td>:</td>
                             <td>
                                 {{ $row->nomor_uji ?: '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Kombinasi yang Diperbolehkan</td>
                             <td>:</td>
                             <td>
                                 {{ $row->kombinasi_yg_diperoleh ?: '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>SK Register Uji Type</td>
                             <td>:</td>
                             <td>
                                 {{ $row->sk_reg_uji_type ?: '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Keterangan Lain-lain</td>
                             <td>:</td>
                             <td>
                                 {{ $row->ket_lain ?: '-' }}
                             </td>
                         </tr>


                         {{-- =================================================
                             KIR
                        ================================================== --}}
                         <tr>
                             <td colspan="3">
                                 <div class="section-title">
                                     <i class="fa fa-check-square-o"></i>
                                     Uji Kendaraan Bermotor (KIR)
                                 </div>
                             </td>
                         </tr>

                         <tr>
                             <td>Tanggal Awal KIR</td>
                             <td>:</td>
                             <td>
                                 {{ isset($row->tgl_kir_awal) ? cek_ddmmyy_v1($row->tgl_kir_awal) : '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Masa Berlaku KIR s/d</td>
                             <td>:</td>
                             <td>
                                 {{ isset($row->tgl_kir_akhir) ? cek_ddmmyy_v1($row->tgl_kir_akhir) : '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Status KIR</td>
                             <td>:</td>
                             <td>

                                 @if ($row->id_par_permohonan != 7 && !empty($row->tgl_kir_akhir))

                                     @php
                                         $tglAkhirKir = \Carbon\Carbon::parse($row->tgl_kir_akhir);
                                     @endphp

                                     @if ($tglAkhirKir->isBefore(\Carbon\Carbon::today()))
                                         <span class="badge-status badge-habis">
                                             <i class="fa fa-exclamation-circle"></i>
                                             Masa Berlaku KIR Habis
                                         </span>
                                     @else
                                         <span class="badge-status badge-aktif">
                                             <i class="fa fa-check-circle"></i>
                                             Masih Berlaku
                                         </span>
                                     @endif
                                 @else
                                     <span class="badge-status badge-neutral">
                                         -
                                     </span>

                                 @endif

                             </td>
                         </tr>


                         {{-- =================================================
                             PKB
                        ================================================== --}}
                         <tr>
                             <td colspan="3">
                                 <div class="section-title">
                                     <i class="fa fa-money"></i>
                                     Pajak Kendaraan Bermotor (PKB)
                                 </div>
                             </td>
                         </tr>

                         <tr>
                             <td>Tanggal Awal PKB</td>
                             <td>:</td>
                             <td>
                                 {{ isset($row->tgl_pkb_awal) ? cek_ddmmyy_v1($row->tgl_pkb_awal) : '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Masa Berlaku PKB s/d</td>
                             <td>:</td>
                             <td>
                                 {{ isset($row->tgl_pkb_akhir) ? cek_ddmmyy_v1($row->tgl_pkb_akhir) : '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Status PKB</td>
                             <td>:</td>
                             <td>

                                 @if ($row->id_par_permohonan != 7 && !empty($row->tgl_pkb_akhir))

                                     @php
                                         $tglAkhirPKB = \Carbon\Carbon::parse($row->tgl_pkb_akhir);
                                     @endphp

                                     @if ($tglAkhirPKB->isBefore(\Carbon\Carbon::today()))
                                         <span class="badge-status badge-habis">
                                             <i class="fa fa-exclamation-circle"></i>
                                             Masa Berlaku PKB Habis
                                         </span>
                                     @else
                                         <span class="badge-status badge-aktif">
                                             <i class="fa fa-check-circle"></i>
                                             Masih Berlaku
                                         </span>
                                     @endif
                                 @else
                                     <span class="badge-status badge-neutral">
                                         -
                                     </span>

                                 @endif

                             </td>
                         </tr>


                         {{-- =================================================
                             IWKBU
                        ================================================== --}}
                         <tr>
                             <td colspan="3">
                                 <div class="section-title">
                                     <i class="fa fa-credit-card"></i>
                                     Iuran Wajib Kendaraan Bermotor Umum (IWKBU)
                                 </div>
                             </td>
                         </tr>

                         <tr>
                             <td>Tanggal Awal IWKBU</td>
                             <td>:</td>
                             <td>
                                 {{ isset($row->tgl_iwkbu_awal) ? cek_ddmmyy_v1($row->tgl_iwkbu_awal) : '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Masa Berlaku IWKBU s/d</td>
                             <td>:</td>
                             <td>
                                 {{ isset($row->tgl_iwkbu_akhir) ? cek_ddmmyy_v1($row->tgl_iwkbu_akhir) : '-' }}
                             </td>
                         </tr>

                         <tr>
                             <td>Status IWKBU</td>
                             <td>:</td>
                             <td>

                                 @if ($row->id_par_permohonan != 7 && !empty($row->tgl_iwkbu_akhir))

                                     @php
                                         $tglAkhirIWKBU = \Carbon\Carbon::parse($row->tgl_iwkbu_akhir);
                                     @endphp

                                     @if ($tglAkhirIWKBU->isBefore(\Carbon\Carbon::today()))
                                         <span class="badge-status badge-habis">
                                             <i class="fa fa-exclamation-circle"></i>
                                             Masa Berlaku IWKBU Habis
                                         </span>
                                     @else
                                         <span class="badge-status badge-aktif">
                                             <i class="fa fa-check-circle"></i>
                                             Masih Berlaku
                                         </span>
                                     @endif
                                 @else
                                     <span class="badge-status badge-neutral">
                                         -
                                     </span>

                                 @endif

                             </td>
                         </tr>


                         {{-- =================================================
                             CETAK
                        ================================================== --}}
                         @if (Auth::check() && getLevel())

                             @if (in_array(getLevel(), [1, 2]))
                                 <tr>
                                     <td colspan="3">
                                         <hr class="section-divider">

                                         @php
                                             $id = Crypt::encrypt($row->id_permohonan_izin);
                                         @endphp

                                         <div class="text-center">
                                             <a href="{{ route('laporan.cetakSuratRekomendasiKepala', $id) }}"
                                                 class="btn btn-secondary btn-cetak" target="_blank">

                                                 <i class="fa fa-print mr-1"></i>
                                                 CETAK

                                             </a>
                                         </div>
                                     </td>
                                 </tr>
                             @endif

                         @endif

                     </tbody>

                 </table>

             </div>
         </div>

     </div>

 </div>
