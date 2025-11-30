@extends('private.layout.main')
@section('isi')
    <div class="container-fluid">
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><b><i class="fa fa-wpforms"></i> {{ $title }}</b></h4>
                    <hr class="border-secondary">
                </div>
                <form action="{{ route('pengajuanpermohonan.store') }}" class="formDataKirim" method="POST">
                    @csrf
                    <div class="card-body" style="margin-top: -45px;">

                        <input type="hidden" class="form-control form-control-sm" name="file_kir" id="file_kir" readonly>
                        <input type="hidden" class="form-control form-control-sm" name="file_stnk" id="file_stnk" readonly>
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <td width="46%">Badan Usaha</td>
                                        <td width="1%">:</td>
                                        <td>{{ $row->BadanUsaha->nm_badan_usaha }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Perusahaan / Personal</td>
                                        <td>:</td>
                                        <td>{{ $row->nm_perusahaan_personal }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pimpinan / Pemilik</td>
                                        <td>:</td>
                                        <td>{{ $row->nm_pimpinan_pemilik }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{ $row->alamat_biodata }}</td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-body" style="margin-top: -45px;">
                        <hr class="border-secondary">
                        <div class="col-md-12">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label border-bottom form-control-sm">Jenis
                                        Permohonan
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-md-6">
                                        <select name="id_jenis_permohonan" id="id_jenis_permohonan"
                                            class="form-control form-control-sm" onchange="getJenisPermohonan(this.value)">
                                            <option value="" selected>-- Pilih --</option>
                                            @foreach ($ResultJenisPermohonan as $JenisPermohonan)
                                                <option value="{{ $JenisPermohonan->id_jenis_permohonan }}">
                                                    {{ $JenisPermohonan->nm_jenis_permohonan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label border-bottom form-control-sm">Permohonan
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <select name="id_par_permohonan" id="id_par_permohonan"
                                            class="form-control form-control-sm">
                                            <option value="" selected>-- Pilih --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body trayek" style="display:none;">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label border-bottom form-control-sm">Trayek
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <select name="id_trayek" id="id_trayek" class="form-control form-control-sm">
                                            <option value="" selected>-- Pilih --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body jenisAngkutan">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label border-bottom form-control-sm">Jenis
                                        Angkutan
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <select name="id_jenis_angkutan" id="id_jenis_angkutan"
                                            class="form-control form-control-sm">
                                            <option value="" selected>-- Pilih --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body mengangkut">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label border-bottom form-control-sm">Mengangkut
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <select name="id_mengangkut" id="id_mengangkut"
                                            class="form-control form-control-sm">
                                            <option value="" selected>-- Pilih --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label border-bottom form-control-sm">Kab/Kota
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">


                                        <input type="hidden" class="form-control form-control-sm " name="id_kabkota"
                                            id="id_kabkota">
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm " id="kabkota-name"
                                                readonly>
                                            <div class="input-group-append">
                                                <span class="btn input-group-text form-control-sm btn-primary"
                                                    id="tombolModalForm2"
                                                    data-url="{{ route('vmodal.show_kabkota', ['act' => 'pengajuan_permohonan']) }}"
                                                    title="Cari Data"><i class="fa fa-search"></i></span>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="btn input-group-text form-control-sm btn-secondary"
                                                    id="tombolModalForm"
                                                    data-url="{{ route('vmodal.show_pic', ['act' => 'pengajuan_permohonan']) }}"
                                                    title="Info PIC"><i class="fa fa-info"></i></span>
                                            </div>
                                        </div>



                                        <span class="text-danger">
                                            *Pilih PIC untuk memeriksa berkas Anda
                                        </span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-body" style="margin-top: -45px;">

                        <hr class="border-secondary">
                        <div class="col-md-12">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label border-bottom form-control-sm">Merek
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm"
                                                name="nm_merek_kendaraan" id="nm_merek_kendaraan" readonly>
                                            <div class="input-group-append">
                                                <span class="btn input-group-text form-control-sm btn-primary"
                                                    id="tombolModalForm"
                                                    data-url="{{ route('pengajuanpermohonan.create') }}"
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
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm"
                                            name="nm_type_kendaraan" id="nm_type_kendaraan" maxlength="100" readonly>
                                        <input type="hidden" class="form-control form-control-sm col-6"
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
                                        <input type="text" class="form-control form-control-sm" name="nm_kendaraan"
                                            id="nm_kendaraan" maxlength="100" readonly>
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
                                        <input type="text" class="form-control form-control-sm"
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
                                        <input type="text" class="form-control form-control-sm" name="no_rangka"
                                            id="no_rangka" maxlength="50" readonly>
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
                                        <input type="text" class="form-control form-control-sm" name="no_mesin"
                                            id="no_mesin" maxlength="50" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label form-control-sm border-bottom">Warna TNKB
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" name="warna_tnkb"
                                            id="warna_tnkb" maxlength="255" readonly>
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
                                        <input type="text" class="form-control form-control-sm" name="bahan_bakar"
                                            id="bahan_bakar" maxlength="255" readonly>
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
                                            <input type="text" class="form-control form-control-sm"
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
                                            <input type="text" class="form-control form-control-sm"
                                                name="daya_angkut_barang" maxlength="7" id="daya_angkut_barang"
                                                readonly>
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
                                        <input type="text" class="form-control form-control-sm" name="thn_pembuatan"
                                            id="thn_pembuatan" maxlength="4" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label border-bottom form-control-sm">Nomor Faktur Jual
                                        Beli
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control form-control-sm"
                                            name="nmr_faktur_jual_beli" id="nmr_faktur_jual_beli" maxlength="4"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label border-bottom form-control-sm">Tanggal Faktur
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control form-control-sm"
                                            name="tgl_faktur_jual_beli" id="tgl_faktur_jual_beli" maxlength="4"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" style="margin-top: -45px;">
                        <div class="card {{ $countUpload == 4 ? 'border-primary' : 'border-danger' }}  shadow-sm">
                            <div
                                class="card-header  {{ $countUpload == 4 ? 'bg-primary' : 'bg-danger' }} text-white py-2">
                                <strong>
                                    <i class="fa fa-exclamation-triangle mr-1"></i> KELENGKAPAN DOKUMEN
                                    PERUSAHAAN
                                </strong>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="form-body">
                                        <table class="   table-sm">
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
                                                            * Silakan dilengkapi dokumen perusahaan
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="viewUploadDok" style="display:none;"></div>
                    </div>

                    <div class="card-body" style="margin-top: -45px;">
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
@endsection
