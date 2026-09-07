@extends('private.layout.main')
@section('isi')
    <style>
        /* =========================================
                                                                                                                                                                                                                                                                                                                                                                                       MODERN PENGAJUAN PERMOHONAN
                                                                                                                                                                                                                                                                                                                                                                                    ========================================= */

        .pengajuan-wrapper {
            max-width: 1400px;
            margin: auto;
        }


        /* =========================================
                                                                                                                                                                                                                                                                                                                                                                                       MAIN HEADER
                                                                                                                                                                                                                                                                                                                                                                                    ========================================= */

        .modern-page-header {
            background: linear-gradient(135deg, #0062cc, #004a99);
            border-radius: 18px;
            padding: 25px 30px;
            color: #ffffff;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 98, 204, 0.20);
        }

        .modern-page-header:before {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            right: -50px;
            top: -70px;
        }

        .modern-page-header h3 {
            margin: 0;
            font-weight: 700;
        }

        .modern-page-header p {
            margin: 5px 0 0;
            opacity: 0.85;
        }


        /* =========================================
                                                                                                                                                                                                                                                                                                                                                                                       MODERN CARD
                                                                                                                                                                                                                                                                                                                                                                                    ========================================= */

        .modern-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.07);
            margin-bottom: 25px;
            overflow: hidden;
            transition: 0.3s;
        }

        .modern-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.10);
        }

        .modern-card-header {
            padding: 18px 22px;
            background: #ffffff;
            border-bottom: 1px solid #edf0f5;
            display: flex;
            align-items: center;
        }

        .section-number {
            width: 38px;
            height: 38px;
            background: #007bff;
            color: #fff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-weight: bold;
        }

        .section-title {
            margin: 0;
            font-weight: 700;
            color: #343a40;
        }

        .section-subtitle {
            font-size: 12px;
            color: #888;
        }


        /* =========================================
                                                                                                                                                                                                                                                                                                                                                                                       COMPANY INFORMATION
                                                                                                                                                                                                                                                                                                                                                                                    ========================================= */

        .company-info {
            padding: 10px;
        }

        .company-info-item {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .company-info-item:last-child {
            border-bottom: none;
        }

        .company-label {
            color: #6c757d;
            font-size: 12px;
            font-weight: 600;
        }

        .company-value {
            color: #343a40;
            font-weight: 600;
        }


        /* =========================================
                                                                                                                                                                                                                                                                                                                                                                                       FORM
                                                                                                                                                                                                                                                                                                                                                                                    ========================================= */

        .modern-form .form-group {
            padding: 10px 0;
            margin-bottom: 8px;
        }

        .modern-form label {
            font-weight: 600;
            color: #495057;
        }

        .modern-form .form-control {
            border-radius: 8px;
            border: 1px solid #dfe3e8;
            height: 38px;
            transition: 0.2s;
        }

        .modern-form .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, .15);
        }

        .modern-form select.form-control {
            cursor: pointer;
        }


        /* =========================================
                                                                                                                                                                                                                                                                                                                                                                                       DOCUMENT CARDS
                                                                                                                                                                                                                                                                                                                                                                                    ========================================= */

        .document-card {
            border-radius: 14px;
            border: 1px solid #e9ecef;
            transition: 0.3s;
            overflow: hidden;
        }

        .document-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
        }



        /* =========================================
                                                                                                                                                                                                                                                                                                                                                                                       VEHICLE INFORMATION
                                                                                                                                                                                                                                                                                                                                                                                    ========================================= */

        .vehicle-card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #edf0f2;
            padding: 20px;
        }


        /* =========================================
                                                                                                                                                                                                                                                                                                                                                                                       DOCUMENT STATUS
                                                                                                                                                                                                                                                                                                                                                                                    ========================================= */

        .document-status {
            border-radius: 12px;
            padding: 12px 15px;
            background: #f8f9fa;
            margin-bottom: 10px;
        }

        .document-status i {
            font-size: 18px;
        }


        /* =========================================
                                                                                                                                                                                                                                                                                                                                                                                       BUTTON
                                                                                                                                                                                                                                                                                                                                                                                    ========================================= */

        .btn-modern {
            border-radius: 30px;
            padding: 11px 28px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
        }


        /* =========================================
                                                                                                                                                                                                                                                                                                                                                                                       INPUT GROUP
                                                                                                                                                                                                                                                                                                                                                                                    ========================================= */

        .input-group-text {
            border-radius: 0 8px 8px 0;
        }


        /* =========================================
                                                                                                                                                                                                                                                                                                                                                                                       MOBILE
                                                                                                                                                                                                                                                                                                                                                                                    ========================================= */

        @media(max-width:768px) {

            .modern-page-header {
                padding: 20px;
                border-radius: 12px;
            }

            .modern-card {
                border-radius: 12px;
            }

            .modern-form label {
                margin-bottom: 5px;
            }

        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="container-fluid pengajuan-wrapper">
        <!-- HEADER -->
        <div class="modern-page-header">

            <div class="position-relative">

                <h3>
                    <i class="fa fa-wpforms mr-2"></i>
                    {{ $title }}
                </h3>

                <p>
                    Lengkapi data permohonan kendaraan Anda dengan benar dan lengkap.
                </p>

            </div>

        </div>

        <form action="{{ route('pengajuanpermohonan.store') }}" class="formDataKirim" method="POST">
            @csrf

            <input type="hidden" class="form-control form-control-sm" name="file_kir" id="file_kir" readonly>
            <input type="hidden" class="form-control form-control-sm" name="file_stnk" id="file_stnk" readonly>
            <div class="modern-card">
                <div class="modern-card-header">

                    <div class="section-number">
                        <i class="fa fa-building"></i>
                    </div>

                    <div>

                        <h5 class="section-title">
                            Informasi Perusahaan
                        </h5>

                        <div class="section-subtitle">
                            Biodata perusahaan pemohon
                        </div>

                    </div>

                </div>
                <div class="card-body company-info">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="company-info-item">

                                <div class="company-label">
                                    BADAN USAHA
                                </div>

                                <div class="company-value">

                                    {{ $row->BadanUsaha->nm_badan_usaha }}

                                </div>

                            </div>


                            <div class="company-info-item">

                                <div class="company-label">
                                    NAMA PERUSAHAAN / PERSONAL
                                </div>

                                <div class="company-value">

                                    {{ $row->nm_perusahaan_personal }}

                                </div>

                            </div>


                            <div class="company-info-item">

                                <div class="company-label">
                                    PIMPINAN / PEMILIK
                                </div>

                                <div class="company-value">

                                    {{ $row->nm_pimpinan_pemilik }}

                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="company-info-item">

                                <div class="company-label">

                                    <i class="fa fa-map-marker text-danger"></i>
                                    ALAMAT

                                </div>

                                <div class="company-value">

                                    {{ $row->alamat_biodata }}

                                </div>

                            </div>


                            <div class="company-info-item">

                                <div class="company-label">

                                    <i class="fa fa-envelope text-primary"></i>
                                    EMAIL

                                </div>

                                <div class="company-value">

                                    {{ $row->email }}

                                </div>

                            </div>


                            <div class="company-info-item">

                                <div class="company-label">

                                    <i class="fa fa-phone text-success"></i>
                                    NO HP

                                </div>

                                <div class="company-value">

                                    {{ $row->no_telp }}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <div class="modern-card">

                <div class="modern-card-header">

                    <div class="section-number">
                        1
                    </div>

                    <div>

                        <h5 class="section-title">
                            Informasi Permohonan
                        </h5>

                        <div class="section-subtitle">
                            Pilih jenis permohonan yang akan diajukan
                        </div>

                    </div>

                </div>


                <div class="card-body modern-form">
                    <div class="col-md-12">

                        <style>
                            /* Styling ekstra super rapat */
                            .form-super-rapat .form-group {
                                margin-bottom: 2px !important;
                                /* Jarak antar baris hanya 2px */
                            }

                            .form-super-rapat .col-form-label {
                                padding-top: 0px !important;
                                padding-bottom: 0px !important;
                                margin-bottom: 0px !important;
                                line-height: 1.1;
                            }

                            .form-super-rapat .form-control-sm {
                                height: 28px !important;
                                /* Ketinggian input diperkecil */
                                padding: 2px 6px !important;
                                font-size: 12px !important;
                            }

                            .form-super-rapat .btn-sm,
                            .form-super-rapat .input-group-text {
                                padding: 2px 8px !important;
                                height: 28px !important;
                            }
                        </style>

                        <div class="form-body form-super-rapat">
                            <!-- Kab/Kota -->
                            <div class="form-group row align-items-center">
                                <label class="col-sm-3 col-form-label border-bottom form-control-sm">
                                    Kab/Kota <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input type="hidden" name="id_kabkota" id="id_kabkota">

                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control border-secondary" id="kabkota-name"
                                            readonly>

                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" id="tombolModalForm2"
                                                data-url="{{ route('vmodal.show_kabkota', ['act' => 'pengajuan_permohonan']) }}"
                                                title="Cari Data">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>

                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-secondary" id="tombolModalForm"
                                                data-url="{{ route('vmodal.show_pic', ['act' => 'pengajuan_permohonan']) }}"
                                                title="Info PIC">
                                                <i class="fa fa-info"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small class="text-danger d-block m-0 p-0" style="font-size: 10px; line-height: 1;">
                                        *Pilih PIC untuk memeriksa berkas Anda
                                    </small>
                                </div>
                            </div>

                            <!-- Jenis Permohonan -->
                            <div class="form-group row align-items-center">
                                <label class="col-sm-3 col-form-label border-bottom form-control-sm">
                                    Jenis Permohonan <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select name="id_jenis_permohonan" id="id_jenis_permohonan"
                                        class="form-control form-control-sm " onchange="getJenisPermohonan(this.value)">
                                        <option value="" selected>-- Pilih --</option>
                                        @foreach ($ResultJenisPermohonan as $JenisPermohonan)
                                            <option value="{{ $JenisPermohonan->id_jenis_permohonan }}">
                                                {{ $JenisPermohonan->nm_jenis_permohonan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Permohonan -->
                            <div class="form-group row align-items-center">
                                <label class="col-sm-3 col-form-label border-bottom form-control-sm">
                                    Permohonan <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select name="id_par_permohonan" id="id_par_permohonan"
                                        class="form-control form-control-sm">
                                        <option value="" selected>-- Pilih --</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Trayek -->
                            <div class="form-group row align-items-center trayek" style="display:none;">
                                <label class="col-sm-3 col-form-label border-bottom form-control-sm">
                                    Trayek <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select name="id_trayek" id="id_trayek" class="form-control form-control-sm">
                                        <option value="" selected>-- Pilih --</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Jenis Angkutan -->
                            <div class="form-group row align-items-center jenisAngkutan">
                                <label class="col-sm-3 col-form-label border-bottom form-control-sm">
                                    Jenis Angkutan <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select name="id_jenis_angkutan" id="id_jenis_angkutan"
                                        class="form-control form-control-sm">
                                        <option value="" selected>-- Pilih --</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Mengangkut -->
                            <div class="form-group row align-items-center mengangkut">
                                <label class="col-sm-3 col-form-label border-bottom form-control-sm">
                                    Mengangkut <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select name="id_mengangkut" id="id_mengangkut" class="form-control form-control-sm">
                                        <option value="" selected>-- Pilih --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-berlaku" style="display: none;">
                            <div class="row">
                                <!-- 1. UJI KIR -->
                                <div class="col-md-4 ">
                                    <div class="card h-44 border-0 shadow-sm rounded-lg overflow-hidden">
                                        <div class="bg-info" style="height: 3px;"></div>
                                        <div class="card-body p-2 bg-light">
                                            <div class="d-flex align-items-center pb-1 border-bottom">
                                                <i class="fa fa-bus text-secondary mr-1" style="font-size: 0.8rem;"></i>
                                                <strong class="text-dark mr-1" style="font-size: 0.85rem;">Uji
                                                    KIR</strong>
                                                <i class="fa fa-info-circle text-info cursor-pointer"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Uji Kendaraan Bermotor untuk memastikan laik jalan (Berlaku 6 Bulan)."
                                                    style="font-size: 0.75rem; cursor: pointer;"></i>
                                                <small class="text-muted ml-auto font-weight-bold"
                                                    style="font-size: 0.75rem;">6
                                                    Bulan</small>
                                            </div>

                                            <div class="form-group ">
                                                <label for="kir_tgl_awal"
                                                    class="col-form-label-sm font-weight-bold text-secondary mb-0 py-0"
                                                    style="font-size: 0.75rem;">
                                                    Tgl Awal KIR <span class="text-danger">*</span>
                                                </label>
                                                <div class="input-group date datepicker-input" id="datepicker_kir">
                                                    <input type="text"
                                                        class="form-control form-control-sm border-0 shadow-xs bg-white"
                                                        name="kir_tgl_awal" id="kir_tgl_awal" placeholder="dd-mm-yyyy"
                                                        autocomplete="off" readonly style="cursor: pointer;" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-white border-0 shadow-xs"><i
                                                                class="fa fa-calendar"
                                                                style="font-size: 0.75rem;"></i></span>
                                                    </div>
                                                </div>
                                                <label for="kir_tgl_akhir"
                                                    class="col-form-label-sm font-weight-bold text-secondary mt-1  py-0"
                                                    style="font-size: 0.75rem;">
                                                    Masa Berlaku KIR s/d <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                    class="form-control form-control-sm bg-white border-0 shadow-xs text-muted"
                                                    name="kir_tgl_akhir" id="kir_tgl_akhir" placeholder="dd-mm-yyyy"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2. PKB -->
                                <div class="col-md-4 ">
                                    <div class="card h-44 border-0 shadow-sm rounded-lg overflow-hidden">
                                        <div class="bg-success" style="height: 3px;"></div>
                                        <div class="card-body p-2 bg-light">
                                            <div class="d-flex align-items-center pb-1 border-bottom">
                                                <i class="fa fa-id-card text-secondary mr-1"
                                                    style="font-size: 0.8rem;"></i>
                                                <strong class="text-dark mr-1" style="font-size: 0.85rem;">PKB</strong>
                                                <i class="fa fa-info-circle text-success cursor-pointer"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Pajak Kendaraan Bermotor sesuai STNK (Berlaku 1 Tahun)."
                                                    style="font-size: 0.75rem; cursor: pointer;"></i>
                                                <small class="text-muted ml-auto font-weight-bold"
                                                    style="font-size: 0.75rem;">1
                                                    Tahun</small>
                                            </div>

                                            <div class="form-group  ">
                                                <label for="pkb_tgl_awal"
                                                    class="col-form-label-sm font-weight-bold text-secondary mb-0 py-0"
                                                    style="font-size: 0.75rem;">
                                                    Tgl Awal PKB <span class="text-danger">*</span>
                                                </label>
                                                <div class="input-group date datepicker-input" id="datepicker_pkb">
                                                    <input type="text"
                                                        class="form-control form-control-sm border-0 shadow-xs bg-white"
                                                        name="pkb_tgl_awal" id="pkb_tgl_awal" placeholder="dd-mm-yyyy"
                                                        autocomplete="off" readonly style="cursor: pointer;" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-white border-0 shadow-xs"><i
                                                                class="fa fa-calendar"
                                                                style="font-size: 0.75rem;"></i></span>
                                                    </div>
                                                </div>
                                                <label for="pkb_tgl_akhir"
                                                    class="col-form-label-sm font-weight-bold text-secondary mt-1   py-0"
                                                    style="font-size: 0.75rem;">
                                                    Masa Berlaku PKB s/d <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                    class="form-control form-control-sm bg-white border-0 shadow-xs text-muted"
                                                    name="pkb_tgl_akhir" id="pkb_tgl_akhir" placeholder="dd-mm-yyyy"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 3. IWKBU -->
                                <div class="col-md-4  ">
                                    <div class="card h-44 border-0 shadow-sm rounded-lg overflow-hidden">
                                        <div class="bg-warning" style="height: 3px;"></div>
                                        <div class="card-body p-2 bg-light">
                                            <div class="d-flex align-items-center pb-1 border-bottom">
                                                <i class="fa fa-shield text-secondary mr-1"
                                                    style="font-size: 0.8rem;"></i>
                                                <strong class="text-dark mr-1" style="font-size: 0.85rem;">IWKBU</strong>
                                                <i class="fa fa-info-circle text-warning cursor-pointer"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Iuran Wajib Kendaraan Bermotor Umum Asuransi Jasa Raharja."
                                                    style="font-size: 0.75rem; cursor: pointer;"></i>
                                                <small class="text-danger ml-auto font-weight-bold"
                                                    style="font-size: 0.72rem;">
                                                    Pilih Masa Berlaku
                                                </small>
                                            </div>

                                            <div class="form-group ">
                                                <label for="iwkbu_tgl_awal"
                                                    class="col-form-label-sm font-weight-bold text-secondary mb-0 py-0"
                                                    style="font-size: 0.75rem;">
                                                    Tgl Awal IWKBU <span class="text-danger">*</span>
                                                </label>
                                                <div class="input-group date datepicker-input" id="datepicker_iwkbu">
                                                    <input type="text"
                                                        class="form-control form-control-sm border-0 shadow-xs bg-white"
                                                        name="iwkbu_tgl_awal" id="iwkbu_tgl_awal"
                                                        placeholder="dd-mm-yyyy" autocomplete="off" readonly
                                                        style="cursor: pointer;" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-white border-0 shadow-xs"><i
                                                                class="fa fa-calendar"
                                                                style="font-size: 0.75rem;"></i></span>
                                                    </div>
                                                </div>
                                                <label for="iwkbu_tgl_akhir"
                                                    class="col-form-label-sm font-weight-bold text-secondary mt-1 py-0"
                                                    style="font-size: 0.75rem;">
                                                    Masa Berlaku IWKBU s/d
                                                    <span class="text-danger">* (Klik Kolom)</span>
                                                </label>
                                                <div class="input-group date datepicker-input" id="datepicker_iwkbu">
                                                    <input type="text"
                                                        class="form-control form-control-sm border-0 shadow-xs bg-white"
                                                        name="iwkbu_tgl_akhir" id="iwkbu_tgl_akhir"
                                                        placeholder="dd-mm-yyyy" autocomplete="off" readonly
                                                        style="cursor: pointer;" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-white border-0 shadow-xs"><i
                                                                class="fa fa-calendar"
                                                                style="font-size: 0.75rem;"></i></span>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modern-card">

                <div class="modern-card-header">

                    <div class="section-number">
                        2
                    </div>

                    <div>

                        <h5 class="section-title">
                            Informasi Data kendaraan
                        </h5>

                        <div class="section-subtitle">
                            Pilih data kendaraan yang akan diajukan permohonan
                        </div>

                    </div>

                </div>

                <div class="card-body  py-4">
                    <div class="col-md-12">
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label border-bottom form-control-sm">Merek
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm border-secondary"
                                            name="nm_merek_kendaraan" id="nm_merek_kendaraan" readonly>
                                        <div class="input-group-append">
                                            <span class="btn input-group-text form-control-sm btn-primary"
                                                id="tombolModalForm" data-url="{{ route('pengajuanpermohonan.create') }}"
                                                title="Cari Data"><i class="fa fa-search"></i></span>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control form-control-sm col-6"
                                        name="id_merek_kendaraan" id="id_merek_kendaraan">

                                    <input type="hidden" class="form-control form-control-sm col-6"
                                        name="id_kendaraan_history" id="id_kendaraan">
                                </div>
                            </div>
                        </div>
                        <div class="form-body ">
                            <div class="form-group row ">
                                <label class="col-sm-3 col-form-label form-control-sm border-bottom">Type
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 ">
                                    <input type="text" class="form-control form-control-sm border-secondary"
                                        name="nm_type_kendaraan" id="nm_type_kendaraan" maxlength="100" readonly>
                                    <input type="hidden" class="form-control form-control-sm col-6 "
                                        name="id_type_kendaraan" id="id_type_kendaraan">
                                </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label form-control-sm border-bottom">Nama Jenis
                                    Kendaraan
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm border-secondary"
                                        name="nm_kendaraan" id="nm_kendaraan" maxlength="100" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label form-control-sm border-bottom">No Plat
                                    Kendaraan
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm border-secondary"
                                        name="plat_no_kendaraan" id="plat_no_kendaraan" maxlength="9" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label border-bottom form-control-sm">Nomor
                                    Rangka
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm border-secondary"
                                        name="no_rangka" id="no_rangka" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label border-bottom form-control-sm">Nomor
                                    Mesin
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm border-secondary"
                                        name="no_mesin" id="no_mesin" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label form-control-sm border-bottom">Warna TNKB
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm border-secondary"
                                        name="warna_tnkb" id="warna_tnkb" maxlength="255" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label form-control-sm border-bottom">Bahan
                                    Bakar
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm border-secondary"
                                        name="bahan_bakar" id="bahan_bakar" maxlength="255" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label border-bottom form-control-sm">Daya Angkut
                                    Orang
                                    <span class="text-danger">*</span>
                                </label>
                                <div class=" col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm border-secondary"
                                            name="daya_angkut_orang" maxlength="4" id="daya_angkut_orang" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text form-control-sm">Orang</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label form-control-sm border-bottom">Daya Angkut
                                    Barang
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm border-secondary"
                                            name="daya_angkut_barang" maxlength="7" id="daya_angkut_barang" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text form-control-sm">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label border-bottom form-control-sm">Tahun
                                    Pembuatan
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm border-secondary"
                                        name="thn_pembuatan" id="thn_pembuatan" maxlength="4" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label border-bottom form-control-sm">Nomor Faktur Jual
                                    Beli
                                </label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm border-secondary"
                                        name="nmr_faktur_jual_beli" id="nmr_faktur_jual_beli" maxlength="4" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label border-bottom form-control-sm">Tanggal Faktur
                                </label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm border-secondary"
                                        name="tgl_faktur_jual_beli" id="tgl_faktur_jual_beli" maxlength="4" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modern-card">

                <div class="modern-card-header">

                    <div class="section-number">
                        3
                    </div>

                    <div>

                        <h5 class="section-title">
                            Kelengkapan Dokumen Perusahaan
                        </h5>

                        <div class="section-subtitle">
                            Silakan diupload dokumen perusahaan apabila masih kosong
                        </div>

                    </div>

                </div>


                <div class="card-body">

                    <div class="card {{ $countUpload == 4 ? 'border-primary' : 'border-danger' }}  shadow-sm">
                        <div class="card-header  {{ $countUpload == 4 ? 'bg-primary' : 'bg-danger' }} text-white py-2">
                            <strong>
                                <i class="fa fa-exclamation-triangle mr-1"></i> KELENGKAPAN DOKUMEN
                                PERUSAHAAN
                            </strong>
                        </div>

                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table-sm">
                                    <tbody>
                                        <tr>
                                            <td width="30%">NIB</td>
                                            <td width="1%">:</td>
                                            <td>
                                                @if (isset($row1->file_dokumen))
                                                    <a target="_blank"
                                                        href="{{ asset('upload/file_biodata/' . $row1->file_dokumen) }}">
                                                        [Download]
                                                    </a>
                                                @else
                                                    <span class="text-danger">Kosong</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>KTP</td>
                                            <td>:</td>
                                            <td>
                                                @if (isset($row2->file_dokumen))
                                                    <a target="_blank"
                                                        href="{{ asset('upload/file_biodata/' . $row2->file_dokumen) }}">
                                                        [Download]
                                                    </a>
                                                @else
                                                    <span class="text-danger">Kosong</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>AKTE PENDIRIAN</td>
                                            <td>:</td>
                                            <td>
                                                @if (isset($row3->file_dokumen))
                                                    <a target="_blank"
                                                        href="{{ asset('upload/file_biodata/' . $row3->file_dokumen) }}">
                                                        [Download]
                                                    </a>
                                                @else
                                                    <span class="text-danger">Kosong</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>NPWP</td>
                                            <td>:</td>
                                            <td>
                                                @if (isset($row4->file_dokumen))
                                                    <a target="_blank"
                                                        href="{{ asset('upload/file_biodata/' . $row4->file_dokumen) }}">
                                                        [Download]
                                                    </a>
                                                @else
                                                    <span class="text-danger">Kosong</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @if ($countUpload != 4)
                                            <tr>
                                                <td colspan="3" class="text-danger">
                                                    * Silakan dilengkapi dokumen perusahaan Anda pada menu Biodata
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="viewUploadDok" style="display:none;"></div>



                </div>
            </div>
            <div class="form-body">
                <div class="form-group row justify-content-center">
                    <div class="col-md-auto text-center">
                        <button type="reset" class="btn btn-danger btn-glow mr-2" id="tombolReset">
                            <i class='feather icon-x mr-25'></i> <span class="d-sm-inline">RESET</span>
                        </button>
                        <button type="submit" class="btn-send btn btn-primary  btn-glow" id="tombolSave">
                            <i class='feather icon-play mr-25'></i> <span class="d-sm-inline">KIRIM
                                PERMOHONAN</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    </div>
    </div>
    <div class="viewModal" style="display:none;"></div>
    <div class="viewModal2" style="display:none;width:100%"></div>
    <script src="{{ asset('add-plugins/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('private/js/myscriptpost.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // $("#id_jenis_permohonan").empty().append("<option value='' selected>-- Pilih --</option>");
            $('#id_par_permohonan').change(function(e) {
                var id_par_permohonan = $("#id_par_permohonan").val();
                var id_jenis_permohonan = $("#id_jenis_permohonan").val();
                if (id_jenis_permohonan === '2') {
                    $.ajax({
                        url: "{{ route('pengajuanpermohonan.getTrayek') }}",
                        data: {
                            id_par_permohonan: id_par_permohonan,
                        },
                        type: 'get',
                        dataType: 'json',
                        beforeSend: function() {
                            $('#loading-spinner').removeClass('d-none');
                        },
                        complete: function() {
                            $('#loading-spinner').addClass('d-none');
                        },
                        success: function(response) {
                            var len = response.length;
                            $("#id_trayek").empty().append(
                                "<option value='' selected>-- Pilih --</option>");
                            for (var i = 0; i < len; i++) {
                                var id = response[i]['id_trayek'];
                                var name = response[i]['nm_trayek'];
                                $("#id_trayek").append("<option value='" + id + "'>" + name +
                                    "</option>");
                            }
                        }
                    });
                }
            });


            $('#id_jenis_permohonan').change(function(e) {
                var id_jenis_permohonan = $("#id_jenis_permohonan").val();

                if (id_jenis_permohonan == "") {
                    $(".trayek").hide();
                }
                $(".form-berlaku").hide(); // Sesuaikan class ini dengan wrapper form berlaku Anda

                if (id_jenis_permohonan != 2) {
                    // Kosongkan nilai tanggal jika opsi kembali ke kosong
                    $('#kir_tgl_awal, #kir_tgl_akhir, #pkb_tgl_awal, #pkb_tgl_akhir, #iwkbu_tgl_awal, #iwkbu_tgl_akhir')
                        .val('');
                } else if (id_jenis_permohonan == 2) {
                    // Tampilkan form masa berlaku jika id_jenis_permohonan bernilai 2
                    $(".form-berlaku").show(); // Atau gunakan .fadeIn() / .slideDown() agar lebih halus
                }

                $.ajax({
                    url: "{{ route('pengajuanpermohonan.getJenisAngkutan') }}",
                    data: {
                        id_jenis_permohonan: id_jenis_permohonan,
                    },
                    type: 'get',
                    dataType: 'json',
                    beforeSend: function() {
                        $('#loading-spinner').removeClass('d-none');
                    },
                    complete: function() {
                        $('#loading-spinner').addClass('d-none');
                    },
                    success: function(response) {
                        var len = response.length;
                        $("#id_jenis_angkutan").empty().append(
                            "<option value='' selected>-- Pilih --</option>");
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id_jenis_angkutan'];
                            var name = response[i]['nm_jenis_angkutan'];
                            $("#id_jenis_angkutan").append("<option value='" + id + "'>" +
                                name + "</option>");
                        }
                    }
                });
            });


            $('#id_jenis_angkutan').change(function(e) {
                e.preventDefault();
                var id_jenis_angkutan = $("#id_jenis_angkutan").val();

                $.ajax({
                    url: "{{ route('pengajuanpermohonan.getMengangkut') }}",
                    data: {
                        id_jenis_angkutan: id_jenis_angkutan,
                    },
                    type: 'get',
                    dataType: 'json',
                    beforeSend: function() {
                        $('#loading-spinner').removeClass('d-none');
                    },
                    complete: function() {
                        $('#loading-spinner').addClass('d-none');
                    },
                    success: function(response) {
                        var len = response.length;
                        $("#id_mengangkut").empty().append(
                            "<option value='' selected>-- Pilih --</option>");
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id_mengangkut'];
                            var name = response[i]['nm_mengangkut'];
                            $("#id_mengangkut").append("<option value='" + id + "'>" + name +
                                "</option>");
                        }
                    }
                });

            });

            const tombolReset = document.getElementById('tombolReset');
            tombolReset.addEventListener('click', function(e) {
                e.preventDefault(); // mencegah reset bawaan langsung
                tombolReset.disabled = true;
                tombolReset.innerHTML = "<i class='fa fa-spin fa-spinner'></i>";

                // Simulasi proses reset 1 detik
                setTimeout(() => {
                    document.querySelector('.formDataKirim').reset(); // reset form secara manual
                    tombolReset.disabled = false;
                    tombolReset.innerHTML =
                        "<i class='feather icon-x mr-25'></i> <span class='d-sm-inline'>RESET</span>";
                }, 1000);
            });


        });

        function getJenisPermohonan(id) {
            $("#id_trayek").empty().append("<option value='' selected>-- Pilih --</option>");
            if (id === '2') {
                $(".trayek").show();
            } else {
                $(".trayek").hide();
            }


            $.ajax({
                url: "{{ route('pengajuanpermohonan.getPermohonan') }}",
                data: {
                    id_jenis_permohonan: id,
                },
                type: 'get',
                dataType: 'json',
                beforeSend: function() {
                    $('#loading-spinner').removeClass('d-none');
                },
                complete: function() {
                    $('#loading-spinner').addClass('d-none');
                },
                success: function(response) {
                    var len = response.length;
                    $("#id_par_permohonan").empty().append("<option value='' selected>-- Pilih --</option>");
                    $("#id_mengangkut").empty().append("<option value='' selected>-- Pilih --</option>");
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id_par_permohonan'];
                        var name = response[i]['nm_par_permohonan'];
                        $("#id_par_permohonan").append("<option value='" + id + "'>" + name + "</option>");
                    }
                }
            });
        }

        function getDataKendaraanUpload(id_kendaraan) {
            let url = "{{ route('pengajuanpermohonan.showUploadDokumenBiodata', ':id') }}";
            url = url.replace(':id', id_kendaraan);

            $.ajax({
                type: 'GET',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#loading-spinner').removeClass('d-none');
                },
                complete: function() {
                    $('#loading-spinner').addClass('d-none');
                },
                success: function(response) {
                    $('.viewUploadDok').html(response).show();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            // Aktifkan tooltip Bootstrap
            $('[data-toggle="tooltip"]').tooltip();

            // Inisialisasi Datepicker
            $('.datepicker-input').datepicker({
                format: 'dd-mm-yyyy',
                todayBtn: 'linked',
                clearBtn: true,
                autoclose: true,
                todayHighlight: true,
                container: 'body',
                language: 'id'
            }).on('changeDate', function(e) {
                var inputId = $(this).find('input').attr('id');
                var jenis = inputId.split('_')[0]; // Mendapatkan 'kir', 'pkb', atau 'iwkbu'

                if (e.date) {
                    hitungMasaBerlaku(jenis, e.date);
                } else {
                    $('#' + jenis + '_tgl_akhir').val('');
                }
            });

            // Fungsi Hitung Masa Berlaku Otomatis
            function hitungMasaBerlaku(jenis, dateObj) {
                var tglAwal = new Date(dateObj.getTime());

                if (jenis === 'kir') {
                    // Tambahkan 6 Bulan untuk Uji KIR
                    tglAwal.setMonth(tglAwal.getMonth() + 6);
                } else if (jenis === 'pkb' || jenis === 'iwkbu') {
                    // Tambahkan 1 Tahun untuk PKB & IWKBU
                    tglAwal.setFullYear(tglAwal.getFullYear() + 1);
                }

                // Format ke dd-mm-yyyy
                var day = ("0" + tglAwal.getDate()).slice(-2);
                var month = ("0" + (tglAwal.getMonth() + 1)).slice(-2);
                var year = tglAwal.getFullYear();

                var formattedDate = day + '-' + month + '-' + year;
                $('#' + jenis + '_tgl_akhir').val(formattedDate);
            }
        });
    </script>
@endsection
