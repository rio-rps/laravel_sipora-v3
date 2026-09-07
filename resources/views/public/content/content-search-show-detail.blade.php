<style>
    /* ================================
       MODAL INFORMASI
    ================================= */
    #getModalForm .modal-content {
        border: 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(0, 0, 0, .15);
    }

    #getModalForm .modal-header {
        padding: 12px 18px;
        background: #fff;
        border-bottom: 1px solid #e9ecef;
    }

    #getModalForm .modal-title {
        font-size: 14px;
        color: #343a40;
        letter-spacing: .2px;
    }

    #getModalForm .modal-body {
        padding: 14px;
        background: #f6f8fa;
    }

    /* ================================
       SECTION
    ================================= */
    .info-section {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        margin-bottom: 10px;
        overflow: hidden;
    }

    .info-section:last-child {
        margin-bottom: 0;
    }

    .info-section-title {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 8px 12px;
        background: #f8fafc;
        border-bottom: 1px solid #e9ecef;
        font-size: 11px;
        font-weight: 700;
        color: #495057;
        text-transform: uppercase;
    }

    .info-section-title i {
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        background: #0d6efd;
        color: #fff;
        font-size: 11px;
    }

    /* ================================
       ROW
    ================================= */
    .info-row {
        display: grid;
        grid-template-columns: 32% 2% 66%;
        padding: 6px 12px;
        border-bottom: 1px solid #f0f1f3;
        font-size: 11px;
        line-height: 1.35;
    }

    .info-row:last-child {
        border-bottom: 0;
    }

    .info-label {
        color: #6c757d;
        font-weight: 500;
    }

    .info-separator {
        color: #adb5bd;
        text-align: center;
    }

    .info-value {
        color: #212529;
        font-weight: 600;
        word-break: break-word;
    }

    /* ================================
       STATUS
    ================================= */
    .info-value .badge {
        font-size: 9px;
        padding: 4px 7px;
        border-radius: 5px;
        font-weight: 600;
    }

    /* ================================
       PLAT KENDARAAN
    ================================= */
    .plat-number {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 5px;
        background: #212529;
        color: #fff;
        font-size: 11px;
        letter-spacing: .5px;
    }

    /* ================================
       MODAL FOOTER
    ================================= */
    #getModalForm .modal-footer {
        padding: 9px 14px;
        border-top: 1px solid #e9ecef;
        background: #fff;
    }

    #getModalForm .modal-footer .btn {
        font-size: 11px;
        padding: 6px 14px;
        border-radius: 6px;
    }

    /* ================================
       MOBILE
    ================================= */
    @media (max-width: 576px) {
        #getModalForm .modal-body {
            padding: 8px;
        }

        .info-row {
            grid-template-columns: 38% 3% 59%;
            padding: 6px 9px;
            font-size: 10px;
        }

        .info-section-title {
            font-size: 10px;
            padding: 7px 9px;
        }
    }
</style>

<div class="modal fade" id="getModalForm" tabindex="-1" aria-labelledby="myModalLabel5" aria-hidden="true">

    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel5">
                    <i class="fa fa-info-circle text-primary me-1"></i>
                    <b>{{ $title_form }}</b>
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">

                {{-- =====================================================
                    INFORMASI PROSES
                ====================================================== --}}
                <div class="info-section">

                    <div class="info-section-title">
                        <i class="fa fa-info-circle"></i>
                        Informasi Proses
                    </div>

                    <div class="info-row">
                        <div class="info-label">Tanggal Kirim Permohonan</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->tgl_kirim_permohonan ? cek_date_ddmmyyyy_his_v1($row->tgl_kirim_permohonan) : '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Tanggal Proses</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ isset($row->JPermohonanValidasi->tgl_validasi_proses)
                                ? cek_date_ddmmyyyy_his_v1($row->JPermohonanValidasi->tgl_validasi_proses)
                                : '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Tanggal Disetujui</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ isset($row->JPermohonanValidasi->tgl_validasi_selesai)
                                ? cek_ddmmyy_v1($row->JPermohonanValidasi->tgl_validasi_selesai)
                                : '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">PIC Validasi Data</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->nm_kabkota ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Status</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            @if (isset($row->JPermohonanValidasi->status_validasi))
                                {!! status_permohonan_vb5($row->JPermohonanValidasi->status_validasi) !!}
                            @else
                                {!! status_permohonan_vb5($row->status_permohonan) !!}
                            @endif
                        </div>
                    </div>

                </div>


                {{-- =====================================================
                    BADAN USAHA
                ====================================================== --}}
                <div class="info-section">

                    <div class="info-section-title">
                        <i class="fa fa-building-o"></i>
                        Badan Usaha
                    </div>

                    <div class="info-row">
                        <div class="info-label">Badan Usaha</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ optional($row->BadanUsaha)->nm_badan_usaha ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Nama Perusahaan / Personal</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->nm_perusahaan_personal ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Nama Pimpinan / Pemilik</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->nm_pimpinan_pemilik ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Alamat</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->alamat_biodata ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Email</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->email ? preg_replace('/(?<=.{2}).(?=[^@]*?@)/', '*', $row->email) : '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">No. HP</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->no_telp ? preg_replace('/\d(?=\d{3})/', '*', $row->no_telp) : '-' }}
                        </div>
                    </div>

                </div>


                {{-- =====================================================
                    JENIS PERMOHONAN
                ====================================================== --}}
                <div class="info-section">

                    <div class="info-section-title">
                        <i class="fa fa-file-text-o"></i>
                        Jenis Permohonan
                    </div>

                    <div class="info-row">
                        <div class="info-label">Jenis Permohonan</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ optional($row->JjenisPermohonan)->nm_jenis_permohonan ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Permohonan</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ optional($row->JPermohonan)->nm_par_permohonan ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Trayek</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->id_trayek == 0 ? '-' : optional($row->Jtrayek)->nm_trayek ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Jenis Angkutan</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ optional($row->JjenisAngkutan)->nm_jenis_angkutan ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Mengangkut</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ optional($row->jmengangkut)->nm_mengangkut ?? '-' }}
                        </div>
                    </div>

                </div>


                {{-- =====================================================
                    DATA KENDARAAN
                ====================================================== --}}
                <div class="info-section">

                    <div class="info-section-title">
                        <i class="fa fa-car"></i>
                        Data Kendaraan
                    </div>

                    <div class="info-row">
                        <div class="info-label">Merek / Type Kendaraan</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ optional($row->JkendaraanMerek)->nm_merek_kendaraan ?? '-' }}
                            /
                            {{ optional($row->JkendaraanType)->nm_type_kendaraan ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Nama Kendaraan</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->nm_kendaraan ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Plat No. Kendaraan</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            <span class="plat-number">
                                {{ $row->plat_no_kendaraan ?? '-' }}
                            </span>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Daya Angkut Orang</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ format_rupiah($row->daya_angkut_orang ?? 0) }} Org
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Daya Angkut Barang</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ format_rupiah($row->daya_angkut_barang ?? 0) }} Kg
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Tahun Pembuatan</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->thn_pembuatan ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Nomor Rangka</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->no_rangka ? Str::mask($row->no_rangka, '*', 4, -4) : '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Nomor Mesin</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->no_mesin ? Str::mask($row->no_mesin, '*', 4, -4) : '-' }}
                        </div>
                    </div>

                </div>


                {{-- =====================================================
                    DOKUMEN JUAL BELI
                ====================================================== --}}
                <div class="info-section">

                    <div class="info-section-title">
                        <i class="fa fa-file-text"></i>
                        Dokumen Jual Beli
                    </div>

                    <div class="info-row">
                        <div class="info-label">Nomor Faktur Jual Beli</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->nmr_faktur_jual_beli ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Tanggal Faktur</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->tgl_faktur_jual_beli ? cek_ddmmyy_v1($row->tgl_faktur_jual_beli) : '-' }}
                        </div>
                    </div>

                </div>


                {{-- =====================================================
                    KARTU PENGAWAS
                ====================================================== --}}
                <div class="info-section">

                    <div class="info-section-title">
                        <i class="fa fa-id-card"></i>
                        Kartu Pengawas
                    </div>

                    <div class="info-row">
                        <div class="info-label">Nomor Kartu Pengawas</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->JPermohonanValidasi->no_kartu_pengawas ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Tanggal SK</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ isset($row->JPermohonanValidasi->tgl_sk) ? cek_ddmmyy_v1($row->JPermohonanValidasi->tgl_sk) : '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Nomor SK</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->JPermohonanValidasi->no_sk ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Tanggal Awal</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ isset($row->JPermohonanValidasi->tgl_awal) ? cek_ddmmyy_v1($row->JPermohonanValidasi->tgl_awal) : '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Masa Berlaku s/d</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ isset($row->JPermohonanValidasi->tgl_akhir) ? cek_ddmmyy_v1($row->JPermohonanValidasi->tgl_akhir) : '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Status Kartu Pengawas</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">

                            @if (!empty($row->JPermohonanValidasi->tgl_akhir))

                                @php
                                    $tglAkhirPngws = \Carbon\Carbon::parse($row->JPermohonanValidasi->tgl_akhir);
                                @endphp

                                @if ($tglAkhirPngws->lt(\Carbon\Carbon::today()))
                                    <span class="badge bg-danger">
                                        <i class="fa fa-exclamation-circle"></i>
                                        Masa Berlaku Habis
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        <i class="fa fa-check-circle"></i> Masih Berlaku
                                    </span>
                                @endif
                            @else
                                -
                            @endif

                        </div>
                    </div>

                </div>


                {{-- =====================================================
                    INFORMASI TAMBAHAN
                ====================================================== --}}
                <div class="info-section">

                    <div class="info-section-title">
                        <i class="fa fa-certificate"></i>
                        Informasi Tambahan Data Kendaraan
                    </div>

                    <div class="info-row">
                        <div class="info-label">Nomor Uji</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->nomor_uji ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Kombinasi yang Diperoleh</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->kombinasi_yg_diperoleh ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">SK Register Uji</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->sk_reg_uji_type ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Keterangan Lain</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ $row->ket_lain ?? '-' }}
                        </div>
                    </div>

                </div>


                {{--  <div class="info-section">

                    <div class="info-section-title">
                        <i class="fa fa-check-square-o"></i>
                        Uji Kendaraan Bermotor (KIR)
                    </div>

                    <div class="info-row">
                        <div class="info-label">Tanggal Awal</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ isset($row->tgl_kir_awal) ? cek_ddmmyy_v1($row->tgl_kir_awal) : '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Masa Berlaku s/d</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ isset($row->tgl_kir_akhir) ? cek_ddmmyy_v1($row->tgl_kir_akhir) : '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Status KIR</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">

                            @if (!empty($row->tgl_kir_akhir))

                                @php
                                    $tglAkhirKir = \Carbon\Carbon::parse($row->tgl_kir_akhir);
                                @endphp

                                @if ($tglAkhirKir->lt(\Carbon\Carbon::today()))
                                    <span class="badge bg-danger">
                                        <i class="fa fa-exclamation-circle"></i>
                                        Masa Berlaku Habis
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        <i class="fa fa-check-circle"></i> Masih Berlaku
                                    </span>
                                @endif
                            @else
                                -
                            @endif

                        </div>
                    </div>

                </div>  --}}


                {{--  <div class="info-section">

                    <div class="info-section-title">
                        <i class="fa fa-money"></i>
                        Pajak Kendaraan Bermotor (PKB)
                    </div>

                    <div class="info-row">
                        <div class="info-label">Tanggal Awal</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ isset($row->tgl_pkb_awal) ? cek_ddmmyy_v1($row->tgl_pkb_awal) : '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Masa Berlaku s/d</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ isset($row->tgl_pkb_akhir) ? cek_ddmmyy_v1($row->tgl_pkb_akhir) : '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Status PKB</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">

                            @if (!empty($row->tgl_pkb_akhir))

                                @php
                                    $tglAkhirPkb = \Carbon\Carbon::parse($row->tgl_pkb_akhir);
                                @endphp

                                @if ($tglAkhirPkb->lt(\Carbon\Carbon::today()))
                                    <span class="badge bg-danger">
                                        <i class="fa fa-exclamation-circle"></i>
                                        Masa Berlaku Habis
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        <i class="fa fa-check-circle"></i> Masih Berlaku
                                    </span>
                                @endif
                            @else
                                -
                            @endif

                        </div>
                    </div>

                </div>  --}}

                {{--  <div class="info-section">

                    <div class="info-section-title">
                        <i class="fa fa-credit-card"></i>
                        Iuran Wajib Kendaraan Bermotor (IWKBU)
                    </div>

                    <div class="info-row">
                        <div class="info-label">Tanggal Awal</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ isset($row->tgl_iwkbu_awal) ? cek_ddmmyy_v1($row->tgl_iwkbu_awal) : '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Masa Berlaku s/d</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ isset($row->tgl_iwkbu_akhir) ? cek_ddmmyy_v1($row->tgl_iwkbu_akhir) : '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Status IWKBU</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">

                            @if (!empty($row->tgl_iwkbu_akhir))

                                @php
                                    $tglAkhirIwkbu = \Carbon\Carbon::parse($row->tgl_iwkbu_akhir);
                                @endphp

                                @if ($tglAkhirIwkbu->lt(\Carbon\Carbon::today()))
                                    <span class="badge bg-danger">
                                        <i class="fa fa-exclamation-circle"></i>
                                        Masa Berlaku Habis
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        <i class="fa fa-check-circle"></i> Masih Berlaku
                                    </span>
                                @endif
                            @else
                                -
                            @endif

                        </div>
                    </div>

                </div>  --}}

                <div class="info-section">

                    <div class="info-section-title">
                        <i class="fa fa-calendar"></i>
                        Masa Berlaku Dokumen
                    </div>


                    {{-- KIR --}}
                    <div class="info-row">

                        <div class="info-label">
                            Uji Kendaraan Bermotor (KIR)
                        </div>

                        <div class="info-separator">
                            :
                        </div>

                        <div class="info-value">

                            @if (!empty($row->tgl_kir_awal) || !empty($row->tgl_kir_akhir))

                                {{ !empty($row->tgl_kir_awal) ? cek_ddmmyy_v1($row->tgl_kir_awal) : '-' }}

                                s/d

                                {{ !empty($row->tgl_kir_akhir) ? cek_ddmmyy_v1($row->tgl_kir_akhir) : '-' }}

                                @if (!empty($row->tgl_kir_akhir))

                                    @php
                                        $tglAkhirKir = \Carbon\Carbon::parse($row->tgl_kir_akhir);
                                    @endphp

                                    @if ($tglAkhirKir->lt(\Carbon\Carbon::today()))
                                        <span class="badge bg-danger ms-2">
                                            <i class="fa fa-exclamation-circle"></i>
                                            Masa Berlaku Habis
                                        </span>
                                    @else
                                        <span class="badge bg-success ms-2">
                                            <i class="fa fa-check-circle"></i>
                                            Masih Berlaku
                                        </span>
                                    @endif

                                @endif
                            @else
                                -
                            @endif

                        </div>

                    </div>


                    {{-- PKB --}}
                    <div class="info-row">

                        <div class="info-label">
                            Pajak Kendaraan Bermotor (PKB)
                        </div>

                        <div class="info-separator">
                            :
                        </div>

                        <div class="info-value">

                            @if (!empty($row->tgl_pkb_awal) || !empty($row->tgl_pkb_akhir))

                                {{ !empty($row->tgl_pkb_awal) ? cek_ddmmyy_v1($row->tgl_pkb_awal) : '-' }}

                                s/d

                                {{ !empty($row->tgl_pkb_akhir) ? cek_ddmmyy_v1($row->tgl_pkb_akhir) : '-' }}

                                @if (!empty($row->tgl_pkb_akhir))

                                    @php
                                        $tglAkhirPkb = \Carbon\Carbon::parse($row->tgl_pkb_akhir);
                                    @endphp

                                    @if ($tglAkhirPkb->lt(\Carbon\Carbon::today()))
                                        <span class="badge bg-danger ms-2">
                                            <i class="fa fa-exclamation-circle"></i>
                                            Masa Berlaku Habis
                                        </span>
                                    @else
                                        <span class="badge bg-success ms-2">
                                            <i class="fa fa-check-circle"></i>
                                            Masih Berlaku
                                        </span>
                                    @endif

                                @endif
                            @else
                                -
                            @endif

                        </div>

                    </div>


                    {{-- IWKBU --}}
                    <div class="info-row">

                        <div class="info-label">
                            Iuran Wajib Kendaraan Bermotor Umum (IWKBU)
                        </div>

                        <div class="info-separator">
                            :
                        </div>

                        <div class="info-value">

                            @if (!empty($row->tgl_iwkbu_awal) || !empty($row->tgl_iwkbu_akhir))

                                {{ !empty($row->tgl_iwkbu_awal) ? cek_ddmmyy_v1($row->tgl_iwkbu_awal) : '-' }}

                                s/d

                                {{ !empty($row->tgl_iwkbu_akhir) ? cek_ddmmyy_v1($row->tgl_iwkbu_akhir) : '-' }}

                                @if (!empty($row->tgl_iwkbu_akhir))

                                    @php
                                        $tglAkhirIwkbu = \Carbon\Carbon::parse($row->tgl_iwkbu_akhir);
                                    @endphp

                                    @if ($tglAkhirIwkbu->lt(\Carbon\Carbon::today()))
                                        <span class="badge bg-danger ms-2">
                                            <i class="fa fa-exclamation-circle"></i>
                                            Masa Berlaku Habis
                                        </span>
                                    @else
                                        <span class="badge bg-success ms-2">
                                            <i class="fa fa-check-circle"></i>
                                            Masih Berlaku
                                        </span>
                                    @endif

                                @endif
                            @else
                                -
                            @endif

                        </div>

                    </div>

                </div>
            </div>

            {{-- FOOTER --}}
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times me-1"></i>
                    TUTUP
                </button>

            </div>

        </div>
    </div>
</div>
<script>
    $('#getModalForm').on('hidden.bs.modal', function() {
        $('body').css('padding-right', '0');
    });
</script>
