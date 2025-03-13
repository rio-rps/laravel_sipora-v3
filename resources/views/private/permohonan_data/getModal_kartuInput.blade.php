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
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-body">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label  border-bottom">Nomor Kartu
                                            Pengawas</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="no_kartu_pengawas"
                                                value="{{ $row->no_kartu_pengawas }}" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label  border-bottom">Tanggal SK</label>
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" name="tgl_sk"
                                                value="{{ $row->tgl_sk }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label  border-bottom">Nomor SK</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control " name="no_sk"
                                                value="{{ $row->no_sk }}" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label  border-bottom">Tanggal Awal</label>
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" name="tgl_awal"
                                                value="{{ $row->tgl_awal }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label  border-bottom">Tanggal Akhir</label>
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" name="tgl_akhir"
                                                value="{{ $row->tgl_akhir }}">
                                        </div>
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
                                                    <input type="date" class="form-control" name="tgl_kir_awal"
                                                        id="tgl_kir_awal" value="{{ $row->tgl_kir_awal }}"
                                                        {{ $row->ck_tgl_kir_awal_clear == '0' ? 'disabled' : '' }}>
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
                                                    <input type="date" class="form-control" name="tgl_kir_akhir"
                                                        value="{{ $row->tgl_kir_akhir }}"
                                                        {{ $row->ck_tgl_kir_akhir_clear == '0' ? 'disabled' : '' }}
                                                        id="tgl_kir_akhir">
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
            dateInput.value = "{{ $row->tgl_kir_awal }}";
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
            dateInput.value = "{{ $row->tgl_kir_akhir }}";
            dateInput.disabled = false;
        }
    }
</script>
