@extends('private.layout.main')
@section('isi')
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }}</b></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a href="javascript:void(0)" class="btn btn-primary" id="tombolModalForm"
                                data-url="{{ route('datakendaraan.create') }}"><i class="feather icon-plus-square"></i>
                                Tambah Data</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered zero-configuration"
                        style="width:100%; font-size:10px;">
                        <thead>
                            <tr>
                                <th width=" 1%">No</th>
                                <th>Nama Merek/ Type </th>
                                <th>Nama Kendaraan </th>
                                <th>Plat Nomor </th>
                                <th>Daya Angkut Orang</th>
                                <th>Daya Angkut Barang</th>
                                <th>Tahun</th>
                                <th>Nomor Rangka</th>
                                <th>Nomor Mesin</th>
                                <th>Status</th>
                                <th width="20%" align="center">Action</th>
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

            myTable = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('datakendaraan/show') }}",
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
                        data: 'merekType',
                        name: 'merekType'
                    },
                    {
                        data: 'nm_kendaraan',
                        name: 'nm_kendaraan'
                    },
                    {
                        className: 'text-center',
                        data: 'plat_no_kendaraan',
                        name: 'plat_no_kendaraan'
                    },
                    {
                        className: 'text-center',
                        data: 'angkut_orang',
                        name: 'angkut_orang'
                    },
                    {
                        className: 'text-center',
                        data: 'angkut_barang',
                        name: 'angkut_barang'
                    },
                    {
                        className: 'text-center',
                        data: 'thn_pembuatan',
                        name: 'thn_pembuatan'
                    },
                    {
                        data: 'no_rangka',
                        name: 'no_rangka'
                    },
                    {
                        data: 'no_mesin',
                        name: 'no_mesin'
                    },
                    {
                        className: 'text-center',
                        data: 'status',
                        name: 'status',
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
