@extends('private.layout.main')
@section('isi')
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }}</b></h4>
                <hr class="border-secondary">
            </div>

            <div class="col-md-12">
                <div id="accordionWrap1" role="tablist" aria-multiselectable="true">
                    <div class="card accordion collapse-icon accordion-icon-rotate">
                        <div id="heading11" class="card-header primary collapsed" data-toggle="collapse" href="#accordion11"
                            aria-expanded="false" aria-controls="accordion11">
                            <a class="card-title lead" href="#">FILTER</a>
                        </div>
                        <div id="accordion11" role="tabpanel" data-parent="#accordionWrap1" aria-labelledby="heading11"
                            class="collapse" style="">
                            <div class="card-content card border-teal border-lighten-2 mr-1 ml-1">
                                <div class="card-body ">
                                    <div class="modal-body">
                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label border-bottom">Jenis
                                                    Permohonan</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="name"
                                                        maxlength="225">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label border-bottom">Permohonan</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="email"
                                                        maxlength="225">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label border-bottom">Trayek</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="email"
                                                        maxlength="225">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label border-bottom">Jenis Angkutan</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="email"
                                                        maxlength="225">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label border-bottom">Mengangkut</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="email"
                                                        maxlength="225">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label border-bottom">Kab/Kota</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="email"
                                                        maxlength="225">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn-send btn btn-primary btn-glow"
                                                        id="tombolSave">
                                                        <i class='feather icon-play mr-25'></i> <span
                                                            class="d-sm-inline">Cari</span>
                                                    </button>
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

            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered zero-configuration two-columns"
                        style="width:100%; font-size:12px;">
                        <thead>
                            <tr>
                                <th width=" 1%">No</th>
                                <th>Tgl </th>
                                <th>Nomor</th>
                                <th>Perusahaan</th>
                                <th>Pimpinan</th>
                                <th>Tgl Mulai</th>
                                <th>Tgl Akhir</th>
                                <th>Nama Kendaraan </th>
                                <th>Jenis Permohonan </th>
                                <th>Jenis Angkutan </th>
                                <th>Trayek</th>
                                <th>Mengangkut</th>
                                <th>No Kendaraan</th>
                                <th>KabKota</th>
                                <th width="1%" align="center">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="viewModal" style="display:none;"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var status = '{{ $status }}';
            myTable = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('datapermohonan/showProses') }}",
                    data: {
                        status: status
                    }
                },
                // "data": null,
                // "class": "align-top",
                // "orderable": false,
                // "searchable": false,
                columns: [{
                        // "class": "align-top",
                        "orderable": false,
                        "searchable": false,
                        "data": "no",
                        className: 'text-center',
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'tgl',
                        name: 'tgl'
                    },
                    {
                        data: 'nomor',
                        name: 'nomor',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return (row.statusText != 5) ? myTable.column(meta.col).visible(false) :
                                row.nomor;
                        },
                    },
                    {
                        data: 'perusahaan',
                        name: 'perusahaan'
                    },
                    {
                        data: 'pimpinan',
                        name: 'pimpinan'
                    },
                    {
                        data: 'tglMulai',
                        name: 'tglMulai',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return (row.statusText != 5) ? myTable.column(meta.col).visible(false) :
                                row.tglMulai;
                        },
                    },
                    {
                        data: 'tglAkhir',
                        name: 'tglAkhir',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return (row.statusText != 5) ? myTable.column(meta.col).visible(false) :
                                row.tglAkhir;
                        },
                    },

                    {
                        data: 'merekType',
                        name: 'merekType',
                    },
                    {
                        data: 'jenisPermohonan',
                        name: 'jenisPermohonan'
                    },
                    {
                        data: 'jenisAngkutan',
                        name: 'jenisAngkutan'
                    },
                    {
                        data: 'trayek',
                        name: 'trayek'
                    },
                    {
                        className: 'text-center',
                        data: 'mengangkut',
                        name: 'mengangkut'
                    },
                    {
                        className: 'text-center',
                        data: 'plat_no_kendaraan',
                        name: 'plat_no_kendaraan'
                    },
                    {
                        className: 'text-center',
                        data: 'KabKota',
                        name: 'KabKota'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ]
            });
        });
    </script>
@endsection
