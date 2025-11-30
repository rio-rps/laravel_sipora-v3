@extends('private.layout.main')
@section('isi')
    <style>

    </style>
    @if (auth()->check() && in_array(getLevel(), [3]))
        <script type="text/javascript">
            window.location = "/";
        </script>
    @endif
    <!-- {{ url('/datapermohonan/viewProses/Masuk') }}-->
    <!--  {{ request()->url() }}  -->

    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }}</b></h4>
                <hr class="border-secondary">
            </div>

            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped  table-hover" style="width:100%; font-size: 8px;">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th width="1%">#No</th>
                                <th><i class="fa fa-calendar"></i> Tgl {{ $label }}</th>
                                <th><i class="fa fa-building"></i> No Kartu Pengawas </th>
                                <th><i class="fa fa-building"></i> Perusahaan</th>
                                <th><i class="fa fa-user-tie"></i> Pimpinan</th>

                                <th><i class="fa fa-clipboard-list"></i> Jenis Permohonan</th>
                                <th><i class="fa fa-bus"></i> Jenis Angkutan</th>
                                <th><i class="fa fa-road"></i> Trayek</th>
                                <th><i class="fa fa-box"></i> Mengangkut</th>

                                <th><i class="fa fa-calendar-plus"></i> Tgl Mulai</th>
                                <th><i class="fa fa-calendar-minus"></i> Tgl Akhir</th>
                                <th><i class="fa fa-industry"></i> Merek / Tipe</th>
                                <th><i class="fa fa-truck"></i> Nama Kendaraan</th>

                                <th><i class="fa fa-car"></i> No Plat</th>
                                <th><i class="fa fa-car"></i> No Rangka</th>
                                <th><i class="fa fa-car"></i> No Mesin</th>
                                <th><i class="fa fa-map-marker-alt"></i> KabKota</th>
                                <th width="1%" align="center"><i class="fa fa-cog"></i> Action</th>
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
                        data: 'no_kartu_pengawas',
                        name: 'no_kartu_pengawas',
                        render: function(data, type, row, meta) {
                            return (row.statusText != 4) ? myTable.column(meta.col).visible(false) :
                                row.no_kartu_pengawas;
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
                        data: 'nm_kendaraan',
                        name: 'nm_kendaraan',
                    },

                    {
                        className: 'text-center',
                        data: 'plat_no_kendaraan',
                        name: 'plat_no_kendaraan'
                    },
                    {
                        className: 'text-center',
                        data: 'no_rangka',
                        name: 'no_rangka'
                    },
                    {
                        className: 'text-center',
                        data: 'no_mesin',
                        name: 'no_mesin'
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
