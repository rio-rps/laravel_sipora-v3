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
                                                        <input type="text" class="form-control" autocomplete="off"
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
                                                        <input type="text" class="form-control" autocomplete="off"
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
                                                        <input type="text" class="form-control" autocomplete="off"
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
                            </div>
                            <div class="col-md-6">
                                <div class="card border-secondary">
                                    <div class="card-header text-white bg-info">
                                        KIR (UJI KENDARAAN BERMOTOR)
                                    </div>
                                    <div class="card-body" style="margin-top: -15px;">
                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label  border-bottom">Tanggal
                                                    Awal</label>
                                                <div class="col-md-5">
                                                    <div class="input-group date" id="datepicker_kir_awal">
                                                        <input type="text" class="form-control" autocomplete="off"
                                                            name="tgl_kir_awal" id="tgl_kir_awal"
                                                            {{ $row->ck_tgl_kir_awal_clear == '0' ? 'disabled' : '' }}
                                                            value="{{ !empty($row->tgl_kir_awal) ? \Carbon\Carbon::parse($row->tgl_kir_awal)->format('d-m-Y') : '0' }}">
                                                        <span class="input-group-append input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>


                                                </div>
                                                <label class="col-sm-4 col-form-label  border-bottom">
                                                    <input type="checkbox" name="ck_tgl_kir_awal_clear"
                                                        id="ck_tgl_kir_awal_clear" value="0"
                                                        {{ $row->ck_tgl_kir_awal_clear == '0' ? 'checked' : '' }}
                                                        onchange="handleCheckboxChangeAwal()">
                                                    Clear Date = 0
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label  border-bottom">Tanggal
                                                    Akhir</label>
                                                <div class="col-md-5">
                                                    <div class="input-group date" id="datepicker_kir_akhir">
                                                        <input type="text" class="form-control" autocomplete="off"
                                                            name="tgl_kir_akhir" id="tgl_kir_akhir"
                                                            {{ $row->ck_tgl_kir_akhir_clear == '0' ? 'disabled' : '' }}
                                                            value="{{ !empty($row->tgl_kir_akhir) ? \Carbon\Carbon::parse($row->tgl_kir_akhir)->format('d-m-Y') : '0' }}">
                                                        <span class="input-group-append input-group-text">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <label class="col-sm-4 col-form-label  border-bottom">
                                                    <input type="checkbox" name="ck_tgl_kir_akhir_clear"
                                                        id="ck_tgl_kir_akhir_clear" value="0"
                                                        {{ $row->ck_tgl_kir_akhir_clear == '0' ? 'checked' : '' }}
                                                        onchange="handleCheckboxChangeAkhir()"> Clear Date = 0
                                                </label>
                                            </div>
                                        </div>
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
                                            aria-labelledby="heading11" class="collapse border-secondary">


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
    function handleCheckboxChangeAwal() {
        var checkbox = document.getElementById("ck_tgl_kir_awal_clear");
        var dateInput = document.getElementById("tgl_kir_awal");
        var nilai = checkbox.checked ? "0" : "1";
        if (nilai === '0') {
            dateInput.value = "00-00-0000";
            dateInput.disabled = true;
            dateInput.value = nilai;
        } else {
            dateInput.value = "{{ \Carbon\Carbon::parse($row->tgl_kir_awal)->format('d-m-Y') }}";
            dateInput.disabled = false;
        }
    }

    function handleCheckboxChangeAkhir() {
        var checkbox = document.getElementById("ck_tgl_kir_akhir_clear");
        var dateInput = document.getElementById("tgl_kir_akhir");
        var nilai = checkbox.checked ? "0" : "1";
        if (nilai === '0') {
            dateInput.value = "00-00-0000";
            dateInput.disabled = true;
            dateInput.value = nilai;
        } else {
            dateInput.value = "{{ \Carbon\Carbon::parse($row->tgl_kir_akhir)->format('d-m-Y') }}";
            dateInput.disabled = false;
        }
    }

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
        $('#datepicker_kir_awal').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: 'linked',
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
            container: 'body',
            language: 'id'
        });
        $('#datepicker_kir_akhir').datepicker({
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
