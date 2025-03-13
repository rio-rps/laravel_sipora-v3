@extends('private.layout.main')
@section('isi')
    <style>

    </style>
    @if (auth()->check() && in_array(getLevel(), [1, 2]))
        <script type="text/javascript">
            window.location = "/";
        </script>
    @endif

    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }} </b></h4>
                <hr class="border-secondary">
            </div>

            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered zero-configuration two-columns"
                        style="width:100%; font-size:12px;">
                        <thead>
                            <tr>
                                <th width=" 1%">No</th>
                                <th>Tgl Kirim </th>
                                <th>Nama Kendaraan </th>
                                <th>Jenis Permohonan </th>
                                <th>Jenis Angkutan </th>
                                <th>Trayek</th>
                                <th>Mengangkut</th>
                                <th>No Kendaraan</th>
                                <th>Status</th>
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
            var act = "{{ $act }}";
            myTable = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('datapermohonan.show') }}",
                    data: {
                        act: act
                    },
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
                        data: 'tglProses',
                        name: 'tglProses'
                    },
                    {
                        data: null,
                        name: 'merekType',
                        render: function(data, type, row) {
                            return '<div class="two-columns">' + data.merekType + '</div>';
                        }
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
