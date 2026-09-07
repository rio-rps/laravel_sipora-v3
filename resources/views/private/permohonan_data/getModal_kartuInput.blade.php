<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel5"><b>{{ $title_form }}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('datapermohonan.storeInputKartu', $id) }}" class="formData" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id_par_permohonan" value="{{ $row->JPermohonan->id_par_permohonan }}">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border-secondary">
                                    <div class="card-header text-white bg-info">
                                        PENERBITAN TANDA NOMOR KENDARAAN
                                    </div>
                                    <div class="card-body" style="margin-top: -15px;">
                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label  border-bottom">
                                                    Nomor Kartu Pengawas
                                                    @if ($row->JPermohonan->id_par_permohonan != 7)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="no_kartu_pengawas"
                                                        value="{{ $row->no_kartu_pengawas }}" maxlength="34">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label  border-bottom">
                                                    Tanggal SK
                                                    @if ($row->JPermohonan->id_par_permohonan != 7)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="input-group date" id="datepicker1">
                                                        <input type="text"
                                                            class="form-control border-1 shadow-xs bg-white"
                                                            autocomplete="off" readonly style="cursor: pointer;"
                                                            name="tgl_sk"
                                                            value="{{ $row->tgl_sk ? \Carbon\Carbon::parse($row->tgl_sk)->format('d-m-Y') : '' }}">
                                                        <span class="input-group-append input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label  border-bottom">
                                                    Nomor SK
                                                    @if ($row->JPermohonan->id_par_permohonan != 7)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control " name="no_sk"
                                                        value="{{ $row->no_sk }}" maxlength="50">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label  border-bottom">
                                                    Tanggal Awal
                                                    @if ($row->JPermohonan->id_par_permohonan != 7)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="input-group date" id="datepicker_awal">
                                                        <input type="text"
                                                            class="form-control border-1 shadow-xs bg-white"
                                                            autocomplete="off" readonly style="cursor: pointer;"
                                                            name="tgl_awal"
                                                            value="{{ $row->tgl_awal ? \Carbon\Carbon::parse($row->tgl_awal)->format('d-m-Y') : '' }}">
                                                        <span class="input-group-append input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label  border-bottom">
                                                    Tanggal Akhir
                                                    @if ($row->JPermohonan->id_par_permohonan != 7)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="input-group date" id="datepicker_akhir">
                                                        <input type="text"
                                                            class="form-control border-1 shadow-xs bg-white"
                                                            autocomplete="off" readonly style="cursor: pointer;"
                                                            name="tgl_akhir"
                                                            value="{{ $row->tgl_akhir ? \Carbon\Carbon::parse($row->tgl_akhir)->format('d-m-Y') : '' }}">
                                                        <span class="input-group-append input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($row->JPermohonan->id_par_permohonan == 7)
                                            <div class="card border-success">
                                                <div class="card-body">
                                                    <h4 class="card-title">Optional (Boleh diisi/ Tidak)</h4>
                                                    <p class="card-text">
                                                        <span class="badge badge-pill badge-primary">Nomor Kartu
                                                            Pengawas</span>
                                                        <span class="badge badge-pill badge-primary">Tanggal SK</span>
                                                        <span class="badge badge-pill badge-primary">Tanggal
                                                            Awal</span>
                                                        <span class="badge badge-pill badge-primary">Tanggal
                                                            Akhir</span>
                                                    </p>
                                                    <p>
                                                        <span class="badge badge-pill badge-danger">
                                                            Nomor Kartu Pengawas diisi -
                                                        </span>
                                                        <span class="badge badge-pill badge-danger">
                                                            Nomor SK diisi -
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!--  TAMBAHAN  -->
                                <div id="accordionWrap1" role="tablist" aria-multiselectable="true"
                                    style="margin-bottom:-16px;">
                                    <div class="card accordion collapse-icon accordion-icon-rotate">
                                        <div id="heading11" class="  collapsed font-weight-bold text-white px-1 py-1"
                                            data-toggle="collapse" href="#accordion11" aria-expanded="false"
                                            aria-controls="accordion11"
                                            style="background-color:#8b8d91; border-radius: 10px 10px 0px 0px; cursor: pointer;">
                                            INFORMASI TAMBAHAN DATA KENDARAAN
                                        </div>

                                        <div id="accordion11" role="tabpanel" data-parent="#accordionWrap1"
                                            aria-labelledby="heading11" class="collapsed border-secondary ">


                                            <div class="card ">
                                                <div class="card-body" style="margin-top: -15px;">
                                                    <div class="form-body">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label  border-bottom">
                                                                Nomor Uji Kendaraan
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control"
                                                                    name="nomor_uji"
                                                                    value="{{ $row->JPermohonan->nomor_uji }}"
                                                                    maxlength="255">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-body">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label  border-bottom">
                                                                Kombinasi yang diperbolehkan
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control"
                                                                    name="kombinasi_yg_diperoleh"
                                                                    value="{{ $row->JPermohonan->kombinasi_yg_diperoleh }}"
                                                                    maxlength="255">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-body">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label  border-bottom">
                                                                SK Register Uji Type
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control"
                                                                    name="sk_reg_uji_type"
                                                                    value="{{ $row->JPermohonan->sk_reg_uji_type }}"
                                                                    maxlength="255">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-body">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label  border-bottom">
                                                                Keterangan Lain-lain
                                                            </label>
                                                            <div class="col-md-8">
                                                                <textarea name="ket_lain" class="form-control">{{ $row->JPermohonan->ket_lain }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="card border-secondary">
                                    <div class="card-header text-white bg-info">
                                        UJI KENDARAAN BERMOTOR (KIR)
                                        <span class="badge badge-pill badge-warning">6
                                            Bulan</span>
                                    </div>

                                    <div class="card-body" style="margin-top: -15px;">

                                        <!-- TANGGAL AWAL -->
                                        <div class="form-body">
                                            <div class="form-group row">

                                                <label class="col-sm-3 col-form-label border-bottom">
                                                    Tanggal Awal
                                                </label>

                                                <div class="col-md-5">
                                                    <div class="input-group date" id="datepicker_kir_awal">

                                                        <input type="text"
                                                            class="form-control border-1 shadow-xs bg-white"
                                                            autocomplete="off" readonly style="cursor: pointer;"
                                                            name="tgl_kir_awal" id="kir_tgl_awal"
                                                            value="{{ !empty($rowPermohonan->tgl_kir_awal)
                                                                ? \Carbon\Carbon::parse($rowPermohonan->tgl_kir_awal)->format('d-m-Y')
                                                                : '' }}">

                                                        <span class="input-group-append input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>

                                                    </div>
                                                </div>

                                                <label class="col-sm-4 col-form-label border-bottom">

                                                    <input type="checkbox" name="ck_tgl_kir_awal_clear"
                                                        id="ck_kir_awal_clear" value="1"
                                                        {{ empty($rowPermohonan->tgl_kir_awal) ? 'checked' : '' }}
                                                        onchange="handleClearDate('kir', 'awal')">

                                                    Clear Date

                                                </label>

                                            </div>
                                        </div>


                                        <!-- TANGGAL AKHIR -->
                                        <div class="form-body">
                                            <div class="form-group row">

                                                <label class="col-sm-3 col-form-label border-bottom">
                                                    Tanggal Akhir
                                                </label>

                                                <div class="col-md-5">
                                                    <div class="input-group date" id="datepicker_kir_akhir">

                                                        <input type="text"
                                                            class="form-control border-1 shadow-xs bg-white"
                                                            autocomplete="off" readonly style="cursor: pointer;"
                                                            name="tgl_kir_akhir" id="kir_tgl_akhir"
                                                            value="{{ !empty($rowPermohonan->tgl_kir_akhir)
                                                                ? \Carbon\Carbon::parse($rowPermohonan->tgl_kir_akhir)->format('d-m-Y')
                                                                : '' }}">

                                                        <span class="input-group-append input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>

                                                    </div>
                                                </div>

                                                <label class="col-sm-4 col-form-label border-bottom">

                                                    <input type="checkbox" name="ck_tgl_kir_akhir_clear"
                                                        id="ck_kir_akhir_clear" value="1"
                                                        {{ empty($rowPermohonan->tgl_kir_akhir) ? 'checked' : '' }}
                                                        onchange="handleClearDate('kir', 'akhir')">

                                                    Clear Date

                                                </label>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card border-secondary mt-3">
                                    <div class="card-header text-white bg-success">
                                        PAJAK KENDARAAN BERMOTOR (PKB)
                                        <span class="badge badge-pill badge-warning">1 Tahun</span>
                                    </div>

                                    <div class="card-body" style="margin-top: -15px;">

                                        <!-- TANGGAL AWAL -->
                                        <div class="form-body">
                                            <div class="form-group row">

                                                <label class="col-sm-3 col-form-label border-bottom">
                                                    Tanggal Awal
                                                </label>

                                                <div class="col-md-5">

                                                    <div class="input-group date" id="datepicker_pkb_awal">

                                                        <input type="text"
                                                            class="form-control border-1 shadow-xs bg-white"
                                                            autocomplete="off" readonly style="cursor: pointer;"
                                                            name="tgl_pkb_awal" id="pkb_tgl_awal"
                                                            value="{{ !empty($rowPermohonan->tgl_pkb_awal)
                                                                ? \Carbon\Carbon::parse($rowPermohonan->tgl_pkb_awal)->format('d-m-Y')
                                                                : '' }}">

                                                        <span class="input-group-append input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>

                                                    </div>

                                                </div>

                                                <label class="col-sm-4 col-form-label border-bottom">

                                                    <input type="checkbox" name="ck_tgl_pkb_awal_clear"
                                                        id="ck_pkb_awal_clear" value="1"
                                                        {{ empty($rowPermohonan->tgl_pkb_awal) ? 'checked' : '' }}
                                                        onchange="handleClearDate('pkb', 'awal')">

                                                    Clear Date

                                                </label>

                                            </div>
                                        </div>


                                        <!-- TANGGAL AKHIR -->
                                        <div class="form-body">
                                            <div class="form-group row">

                                                <label class="col-sm-3 col-form-label border-bottom">
                                                    Tanggal Akhir
                                                </label>

                                                <div class="col-md-5">

                                                    <div class="input-group date" id="datepicker_pkb_akhir">

                                                        <input type="text"
                                                            class="form-control border-1 shadow-xs bg-white"
                                                            autocomplete="off" readonly style="cursor: pointer;"
                                                            name="tgl_pkb_akhir" id="pkb_tgl_akhir"
                                                            value="{{ !empty($rowPermohonan->tgl_pkb_akhir)
                                                                ? \Carbon\Carbon::parse($rowPermohonan->tgl_pkb_akhir)->format('d-m-Y')
                                                                : '' }}">

                                                        <span class="input-group-append input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>

                                                    </div>

                                                </div>

                                                <label class="col-sm-4 col-form-label border-bottom">

                                                    <input type="checkbox" name="ck_tgl_pkb_akhir_clear"
                                                        id="ck_pkb_akhir_clear" value="1"
                                                        {{ empty($rowPermohonan->tgl_pkb_akhir) ? 'checked' : '' }}
                                                        onchange="handleClearDate('pkb', 'akhir')">

                                                    Clear Date

                                                </label>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card border-secondary mt-3">
                                    <div class="card-header text-white bg-warning">
                                        IURAN WAJIB KENDARAAN BERMOTOR UMUM (IWKBU)
                                        <span class="badge badge-pill badge-danger">1 Tahun</span>

                                    </div>

                                    <div class="card-body" style="margin-top: -15px;">

                                        <!-- TANGGAL AWAL -->
                                        <div class="form-body">
                                            <div class="form-group row">

                                                <label class="col-sm-3 col-form-label border-bottom">
                                                    Tanggal Awal
                                                </label>

                                                <div class="col-md-5">

                                                    <div class="input-group date" id="datepicker_iwkbu_awal">

                                                        <input type="text"
                                                            class="form-control border-1 shadow-xs bg-white"
                                                            autocomplete="off" readonly style="cursor: pointer;"
                                                            name="tgl_iwkbu_awal" id="iwkbu_tgl_awal"
                                                            value="{{ !empty($rowPermohonan->tgl_iwkbu_awal)
                                                                ? \Carbon\Carbon::parse($rowPermohonan->tgl_iwkbu_awal)->format('d-m-Y')
                                                                : '' }}">

                                                        <span class="input-group-append input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>

                                                    </div>

                                                </div>

                                                <label class="col-sm-4 col-form-label border-bottom">

                                                    <input type="checkbox" name="ck_tgl_iwkbu_awal_clear"
                                                        id="ck_iwkbu_awal_clear" value="1"
                                                        {{ empty($rowPermohonan->tgl_iwkbu_awal) ? 'checked' : '' }}
                                                        onchange="handleClearDate('iwkbu', 'awal')">

                                                    Clear Date

                                                </label>

                                            </div>
                                        </div>


                                        <!-- TANGGAL AKHIR -->
                                        <div class="form-body">
                                            <div class="form-group row">

                                                <label class="col-sm-3 col-form-label border-bottom">
                                                    Tanggal Akhir
                                                </label>

                                                <div class="col-md-5">

                                                    <div class="input-group date" id="datepicker_iwkbu_akhir">

                                                        <input type="text"
                                                            class="form-control border-1 shadow-xs bg-white"
                                                            autocomplete="off" readonly style="cursor: pointer;"
                                                            name="tgl_iwkbu_akhir" id="iwkbu_tgl_akhir"
                                                            value="{{ !empty($rowPermohonan->tgl_iwkbu_akhir)
                                                                ? \Carbon\Carbon::parse($rowPermohonan->tgl_iwkbu_akhir)->format('d-m-Y')
                                                                : '' }}">

                                                        <span class="input-group-append input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>

                                                    </div>

                                                </div>

                                                <label class="col-sm-4 col-form-label border-bottom">

                                                    <input type="checkbox" name="ck_tgl_iwkbu_akhir_clear"
                                                        id="ck_iwkbu_akhir_clear" value="1"
                                                        {{ empty($rowPermohonan->tgl_iwkbu_akhir) ? 'checked' : '' }}
                                                        onchange="handleClearDate('iwkbu', 'akhir')">

                                                    Clear Date

                                                </label>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="reset" class="btn btn-secondary">
                        <i class='feather icon-x mr-25'></i>
                        <span class="d-sm-inline">RESET</span>
                    </button>
                    <button type="submit" class="btn-send btn btn-primary btn-glow" id="tombolSave">
                        <i class='feather icon-play mr-25'></i> <span class="d-sm-inline">SIMPAN</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<script src="{{ asset('private/js/myscriptpost.js') }}"></script>
<script>
    $(function() {
        $('#datepicker1').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: 'linked',
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
            container: 'body',
            language: 'id'
        });
        $('#datepicker_awal').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: 'linked',
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
            container: 'body',
            language: 'id'
        });
        $('#datepicker_akhir').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: 'linked',
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
            container: 'body',
            language: 'id'
        });

        // =========================
        // DATEPICKER KIR
        // =========================
        $('#datepicker_kir_awal, #datepicker_kir_akhir').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: 'linked',
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
            container: 'body',
            language: 'id'
        });


        // =========================
        // DATEPICKER PKB
        // =========================
        $('#datepicker_pkb_awal, #datepicker_pkb_akhir').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: 'linked',
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
            container: 'body',
            language: 'id'
        });


        // =========================
        // DATEPICKER IWKBU
        // =========================
        $('#datepicker_iwkbu_awal, #datepicker_iwkbu_akhir').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: 'linked',
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
            container: 'body',
            language: 'id'
        });

    });
</script>
<script>
    $(document).ready(function() {

        // =====================================================
        // DATA TANGGAL DARI DATABASE
        // =====================================================
        const dataTanggalDatabase = {
            kir: {
                awal: @json(!empty($rowPermohonan->tgl_kir_awal) ? \Carbon\Carbon::parse($rowPermohonan->tgl_kir_awal)->format('d-m-Y') : null),
                akhir: @json(
                    !empty($rowPermohonan->tgl_kir_akhir)
                        ? \Carbon\Carbon::parse($rowPermohonan->tgl_kir_akhir)->format('d-m-Y')
                        : null)
            },

            pkb: {
                awal: @json(!empty($rowPermohonan->tgl_pkb_awal) ? \Carbon\Carbon::parse($rowPermohonan->tgl_pkb_awal)->format('d-m-Y') : null),
                akhir: @json(
                    !empty($rowPermohonan->tgl_pkb_akhir)
                        ? \Carbon\Carbon::parse($rowPermohonan->tgl_pkb_akhir)->format('d-m-Y')
                        : null)
            },

            iwkbu: {
                awal: @json(
                    !empty($rowPermohonan->tgl_iwkbu_awal)
                        ? \Carbon\Carbon::parse($rowPermohonan->tgl_iwkbu_awal)->format('d-m-Y')
                        : null),
                akhir: @json(
                    !empty($rowPermohonan->tgl_iwkbu_akhir)
                        ? \Carbon\Carbon::parse($rowPermohonan->tgl_iwkbu_akhir)->format('d-m-Y')
                        : null)
            }
        };


        // =====================================================
        // PARSE TANGGAL dd-mm-yyyy
        // =====================================================
        function parseTanggal(tanggal) {

            if (!tanggal) {
                return null;
            }

            const parts = tanggal.split('-');

            if (parts.length !== 3) {
                return null;
            }

            const hari = parseInt(parts[0], 10);
            const bulan = parseInt(parts[1], 10) - 1;
            const tahun = parseInt(parts[2], 10);

            const date = new Date(tahun, bulan, hari);

            // Validasi tanggal
            if (
                date.getFullYear() !== tahun ||
                date.getMonth() !== bulan ||
                date.getDate() !== hari
            ) {
                return null;
            }

            return date;
        }


        // =====================================================
        // HITUNG MASA BERLAKU
        // KIR  = + 6 BULAN
        // PKB  = + 1 TAHUN
        // IWKBU = + 1 TAHUN
        // =====================================================
        function hitungMasaBerlaku(jenis) {

            const inputAwal = document.getElementById(
                jenis + '_tgl_awal'
            );

            const inputAkhir = document.getElementById(
                jenis + '_tgl_akhir'
            );

            if (!inputAwal || !inputAkhir) {
                console.log('Input tidak ditemukan:', jenis);
                return;
            }

            // Jika tanggal awal kosong
            const tanggalAwal = parseTanggal(inputAwal.value);

            if (!tanggalAwal) {
                inputAkhir.value = '';
                return;
            }

            // Jika tanggal akhir sedang di-Clear,
            // jangan dihitung otomatis
            const checkboxClearAkhir = document.getElementById(
                'ck_' + jenis + '_akhir_clear'
            );

            if (
                checkboxClearAkhir &&
                checkboxClearAkhir.checked
            ) {
                return;
            }

            let tanggal = tanggalAwal.getDate();
            let bulan = tanggalAwal.getMonth();
            let tahun = tanggalAwal.getFullYear();


            // =================================================
            // KIR = TAMBAH 6 BULAN
            // =================================================
            if (jenis === 'kir') {

                bulan += 6;

                if (bulan >= 12) {
                    tahun += Math.floor(bulan / 12);
                    bulan = bulan % 12;
                }
            }


            // =================================================
            // PKB / IWKBU = TAMBAH 1 TAHUN
            // =================================================
            else if (
                jenis === 'pkb' ||
                jenis === 'iwkbu'
            ) {

                tahun += 1;
            }


            // =================================================
            // CARI TANGGAL TERAKHIR BULAN TUJUAN
            // Supaya 31-08 + 6 bulan tidak menjadi tanggal aneh
            // =================================================
            const hariTerakhir = new Date(
                tahun,
                bulan + 1,
                0
            ).getDate();

            tanggal = Math.min(
                tanggal,
                hariTerakhir
            );


            // =================================================
            // BUAT TANGGAL AKHIR
            // =================================================
            const tanggalAkhir = new Date(
                tahun,
                bulan,
                tanggal
            );


            // =================================================
            // FORMAT dd-mm-yyyy
            // =================================================
            const dd = String(
                tanggalAkhir.getDate()
            ).padStart(2, '0');

            const mm = String(
                tanggalAkhir.getMonth() + 1
            ).padStart(2, '0');

            const yyyy = tanggalAkhir.getFullYear();


            inputAkhir.value =
                dd + '-' + mm + '-' + yyyy;
        }


        // =====================================================
        // CLEAR DATE
        // Jika dicentang:
        // - tanggal dikosongkan
        // - input disabled
        //
        // Jika dilepas:
        // - input aktif
        // - tampilkan kembali tanggal database
        // =====================================================
        function handleClearDate(jenis, posisi) {

            const checkbox = document.getElementById(
                'ck_' + jenis + '_' + posisi + '_clear'
            );

            const inputTanggal = document.getElementById(
                jenis + '_tgl_' + posisi
            );

            if (!checkbox || !inputTanggal) {
                console.log(
                    'Element tidak ditemukan:',
                    jenis,
                    posisi
                );
                return;
            }


            // =================================================
            // CLEAR
            // =================================================
            if (checkbox.checked) {

                inputTanggal.value = '';
                inputTanggal.disabled = true;

            }

            // =================================================
            // RESTORE
            // =================================================
            else {

                inputTanggal.disabled = false;

                // Ambil kembali tanggal dari database
                if (
                    dataTanggalDatabase[jenis] &&
                    dataTanggalDatabase[jenis][posisi]
                ) {

                    inputTanggal.value =
                        dataTanggalDatabase[jenis][posisi];
                }
            }
        }


        // =====================================================
        // EVENT CHECKBOX CLEAR
        // =====================================================

        $('#ck_kir_awal_clear').on('change', function() {
            handleClearDate('kir', 'awal');
        });

        $('#ck_kir_akhir_clear').on('change', function() {
            handleClearDate('kir', 'akhir');
        });


        $('#ck_pkb_awal_clear').on('change', function() {
            handleClearDate('pkb', 'awal');
        });

        $('#ck_pkb_akhir_clear').on('change', function() {
            handleClearDate('pkb', 'akhir');
        });


        $('#ck_iwkbu_awal_clear').on('change', function() {
            handleClearDate('iwkbu', 'awal');
        });

        $('#ck_iwkbu_akhir_clear').on('change', function() {
            handleClearDate('iwkbu', 'akhir');
        });


        // =====================================================
        // EVENT TANGGAL AWAL
        //
        // Gunakan changeDate karena memakai Bootstrap Datepicker
        // =====================================================

        $('#datepicker_kir_awal').on('changeDate', function() {
            hitungMasaBerlaku('kir');
        });

        $('#datepicker_pkb_awal').on('changeDate', function() {
            hitungMasaBerlaku('pkb');
        });

        $('#datepicker_iwkbu_awal').on('changeDate', function() {
            hitungMasaBerlaku('iwkbu');
        });


        // =====================================================
        // JIKA INPUT TANGGAL DIUBAH MANUAL
        // =====================================================

        $('#kir_tgl_awal').on('change', function() {

            const checkbox = document.getElementById(
                'ck_kir_awal_clear'
            );

            if (!checkbox || !checkbox.checked) {
                hitungMasaBerlaku('kir');
            }
        });


        $('#pkb_tgl_awal').on('change', function() {

            const checkbox = document.getElementById(
                'ck_pkb_awal_clear'
            );

            if (!checkbox || !checkbox.checked) {
                hitungMasaBerlaku('pkb');
            }
        });


        $('#iwkbu_tgl_awal').on('change', function() {

            const checkbox = document.getElementById(
                'ck_iwkbu_awal_clear'
            );

            if (!checkbox || !checkbox.checked) {
                hitungMasaBerlaku('iwkbu');
            }
        });


        // =====================================================
        // KONDISI AWAL SAAT HALAMAN DIBUKA
        // =====================================================

        handleClearDate('kir', 'awal');
        handleClearDate('kir', 'akhir');

        handleClearDate('pkb', 'awal');
        handleClearDate('pkb', 'akhir');

        handleClearDate('iwkbu', 'awal');
        handleClearDate('iwkbu', 'akhir');


    });
</script>
