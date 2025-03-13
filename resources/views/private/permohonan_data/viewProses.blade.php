@extends('private.layout.main')
@section('isi')
    <style>

    </style>
    @if (auth()->check() && in_array(getLevel(), [3]))
        <script type="text/javascript">
            window.location = "/";
        </script>
    @endif
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }}</b></h4>
                <hr class="border-secondary">
            </div>
            <!-- {{ url('/datapermohonan/viewProses/Masuk') }}<br>
                        {{ request()->url() }} -->

            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered zero-configuration two-columns"
                        style="width:100%; font-size:12px;">
                        <thead>
                            <tr>
                                <th width=" 1%">No</th>
                                <th>Tgl {{ $label }} </th>
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
                        data: 'action',
                        name: 'action',
                    }
                ]
            });
        });
    </script>
@endsection
