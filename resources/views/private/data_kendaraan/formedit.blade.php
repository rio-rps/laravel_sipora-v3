<link rel="stylesheet" type="text/css" href="{{ asset('add-plugins/select2/css/select2.min.css') }}">
<script src="{{ asset('add-plugins/autoNumeric.js') }}"></script>
<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel5"><b>{{ $title_form }}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('datakendaraan.update', $id) }}" class="formData" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-secondary">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Merek</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $row->JkendaraanMerek->nm_merek_kendaraan }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Type</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $row->JkendaraanType->nm_type_kendaraan }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Nama Jenis
                                                Kendaraan</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="nm_kendaraan"
                                                    value="{{ $row->nm_kendaraan }}" maxlength="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">No Plat
                                                Kendaraan</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="plat_no_kendaraan"
                                                    value="{{ $row->plat_no_kendaraan }}" maxlength="11">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Nomor Rangka</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="no_rangka"
                                                    value="{{ $row->no_rangka }}" maxlength="50">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Nomor Mesin</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="no_mesin"
                                                    value="{{ $row->no_mesin }}" maxlength="50">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  faktur  -->
                            <div class="card border-secondary">
                                <div class="card-body">

                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Nomor Faktur Jual Beli
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="nmr_faktur_jual_beli"
                                                    maxlength="255" value="{{ $row->nmr_faktur_jual_beli }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Tanggal Faktur
                                            </label>

                                            <div class="col-md-5">
                                                <div class="input-group date" id="datepicker1">
                                                    <input type="text" class="form-control" autocomplete="off"
                                                        name="tgl_faktur_jual_beli"
                                                        value="{{ $row->tgl_faktur_jual_beli ? \Carbon\Carbon::parse($row->tgl_faktur_jual_beli)->format('d-m-Y') : '' }}">
                                                    <span class="input-group-append input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-secondary">
                                <div class="card-body">


                                    <div class="form-body">

                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label border-bottom">Warna TNKB
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="warna_tnkb"
                                                        maxlength="255" value="{{ $row->warna_tnkb }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label border-bottom">Bahan Bakar
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="bahan_bakar"
                                                        maxlength="255" value="{{ $row->bahan_bakar }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Daya Angkut
                                                Orang</label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        name="daya_angkut_orang" maxlength="4"
                                                        id="daya_angkut_orang"
                                                        value="{{ format_rupiah($row->daya_angkut_orang) }}"
                                                        data-m-dec="0" data-a-dec="," data-a-sep=".">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Orang</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Daya Angkut
                                                Barang</label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        name="daya_angkut_barang" maxlength="7"
                                                        value="{{ format_rupiah($row->daya_angkut_barang) }}"
                                                        id="data_angkut_barang" data-m-dec="0" data-a-dec=","
                                                        data-a-sep=".">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Kg</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Tahun
                                                Pembuatan</label>
                                            <div class="col-md-5">
                                                <select name="thn_pembuatan" class="form-control select2">
                                                    <option value="" selected>-- Pilih --</option>
                                                    @for ($i = date('Y'); $i >= 1990; $i--)
                                                        <option value="{{ $i }}"
                                                            {{ $row->thn_pembuatan == $i ? 'selected' : '' }}>
                                                            {{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-body">
                                        <div class="form-group">
                                            <div
                                                class="bs-callout-danger callout-border-left callout-bordered mt-1 p-1">
                                                <h4 class="danger">Informasi !</h4>
                                                <p>
                                                    Harap mengisi data secara benar dan lengkap, karena data yang
                                                    Anda masukkan akan menjadi
                                                    dasar informasi pada cetakan di aplikasi.
                                                </p>
                                                <p>
                                                    Apabila No Plat Kendaraan/ Nomor Rangka/ Nomor Mesin terdapat
                                                    pesan sudah dipakai/ sudah ada, silakan hubungi admin untuk di cek
                                                    data
                                                    tersebut.
                                                </p>
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
<script src="{{ asset('add-plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('add-plugins/select2/js/form-select2.js') }}"></script>
<script src="{{ asset('private/js/myscriptpost.js') }}"></script>
<script>
    $('#daya_angkut_orang').autoNumeric('init');
    $('#data_angkut_barang').autoNumeric('init');


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
    });
</script>
