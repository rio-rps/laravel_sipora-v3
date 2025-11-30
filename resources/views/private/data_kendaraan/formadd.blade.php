<link rel="stylesheet" type="text/css" href="{{ asset('add-plugins/select2/css/select2.min.css') }}">
<script src="{{ asset('add-plugins/autoNumeric.js') }}"></script>
<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="getModalFormLabel"><b>{{ $title_form }}</b></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('datakendaraan.store') }}" class="formData" method="POST">
                @csrf
                <input type="hidden" class="form-control" name="id_biodata" value="{{ $id_biodata }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-secondary">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Merek
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select name="id_merek_kendaraan" id="id_merek_kendaraan"
                                                    class="form-control select2" onchange="getMerek(this.value)">
                                                    <option value="" selected>-- Pilih --</option>
                                                    @foreach ($resultMerek as $merek)
                                                        <option value="{{ $merek->id_merek_kendaraan }}">
                                                            {{ $merek->nm_merek_kendaraan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Type
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select name="id_type_kendaraan" id="id_type_kendaraan"
                                                    class="form-control select2">
                                                    <option value="" selected>-- Pilih --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Nama Jenis
                                                Kendaraan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="nm_kendaraan"
                                                    maxlength="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">No Plat
                                                Kendaraan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="plat_no_kendaraan"
                                                    maxlength="11">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Nomor Rangka
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="no_rangka"
                                                    maxlength="50">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Nomor Mesin
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="no_mesin"
                                                    maxlength="50">
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
                                                    maxlength="255">
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
                                                        name="tgl_faktur_jual_beli">
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
                                                        maxlength="255">
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
                                                        maxlength="255">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label border-bottom">Daya Angkut
                                                Orang
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        name="daya_angkut_orang" maxlength="4"
                                                        id="daya_angkut_orang" data-m-dec="0" data-a-dec=","
                                                        data-a-sep=".">
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
                                                Barang
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        name="daya_angkut_barang" maxlength="7"
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
                                                Pembuatan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-5">
                                                <select name="thn_pembuatan" class="form-control select2">
                                                    <option value="" selected>-- Pilih --</option>
                                                    @for ($i = date('Y'); $i >= 1990; $i--)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
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
                    <span class="text-left"></span>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        <i class="fa fa-times mr-1"></i> TUTUP
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="fa fa-undo mr-25"></i>
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

    function getMerek(id) {
        $.ajax({
            url: "{{ route('datakendaraan.getTypeKendaraan') }}",
            data: {
                id_merek_kendaraan: id,
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
                $("#id_type_kendaraan").empty();
                for (var i = 0; i < len; i++) {
                    var id = response[i]['id_type_kendaraan'];
                    var name = response[i]['nm_type_kendaraan'];
                    $("#id_type_kendaraan").append("<option value='" + id + "'>" + name + "</option>");
                }
                //console.log(response);
            }
        });
    };
</script>
