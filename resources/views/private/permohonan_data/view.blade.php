@extends('private.layout.main')
@section('isi')
    <style>
        .text-nowrap {
            white-space: nowrap;
        }
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
                    <table id="myTable" class="table table-striped  table-hover" style="width:100%; font-size: 8px;">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th width=" 1%">#No</th>
                                <th>Tgl Kirim </th>
                                <th><i class="fa fa-industry"></i> Merek / Tipe</th>
                                <th><i class="fa fa-car"></i> Nama Kendaraan</th>
                                <th><i class="fa fa-wpforms"></i> Jenis Permohonan </th>
                                <th><i class="fa fa-wpforms"></i> Jenis Angkutan </th>
                                <th><i class="fa fa-wpforms"></i> Trayek</th>
                                <th><i class="fa fa-wpforms"></i> Mengangkut</th>
                                <th><i class="fa fa-id-card"></i> No Plat</th>
                                <th><i class="fa fa-id-card"></i> No Rangka</th>
                                <th><i class="fa fa-id-card"></i> No Mesin</th>
                                <th><i class="fa fa-university"></i>Prov/Kab/Kota</th>
                                <th><i class="fa fa-toggle-on"></i> Status</th>
                                <th width="1%" align="center"><i class="fa fa-cogs"></i> Action</th>
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
                        data: null,
                        name: 'nmKendaraan',
                        render: function(data, type, row) {
                            return '<div class="two-columns">' + data.nmKendaraan + '</div>';
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
                        className: 'text-center text-nowrap',
                        data: 'plat_no_kendaraan',
                        name: 'plat_no_kendaraan'
                    },
                    {
                        className: 'text-center text-nowrap',
                        data: 'no_rangka',
                        name: 'no_rangka'
                    },
                    {
                        className: 'text-center text-nowrap',
                        data: 'no_mesin',
                        name: 'no_mesin'
                    },
                    {
                        className: 'text-nowrap',
                        data: 'kabkota',
                        name: 'kabkota',
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
