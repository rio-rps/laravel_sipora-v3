@extends('private.layout.main')
@section('isi')
    <div class="content-body">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">
                    <i class="fa fa-car mr-2 text-primary"></i><strong>{{ $title }}</strong>
                </h4>
                <button class="btn btn-sm btn-primary" id="tombolModalForm" data-url="{{ route('datakendaraan.create') }}">
                    <i class="fa fa-plus mr-1"></i> Tambah Data
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped  table-hover" style="width:100%; font-size: 8px;">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th><i class="fa fa-hashtag"></i> No</th>
                                <th><i class="fa fa-industry"></i> Merek / Tipe</th>
                                <th><i class="fa fa-car"></i> Nama Kendaraan</th>
                                <th><i class="fa fa-id-card"></i> Plat Nomor</th>
                                <th><i class="fa fa-users"></i> Daya Angkut Orang</th>
                                <th><i class="fa fa-th"></i> Daya Angkut Barang</th>
                                <th><i class="fa fa-calendar"></i> Tahun</th>
                                <th><i class="fa fa-cogs"></i> Nomor Rangka</th>
                                <th><i class="fa fa-cog"></i> Nomor Mesin</th>
                                <th><i class="fa fa-toggle-on"></i> Status</th>
                                <th><i class="fa fa-cogs"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="viewModal" style="display:none;"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            myTable = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('datakendaraan/show') }}",
                columns: [{
                        data: 'no',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
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
                        data: 'plat_no_kendaraan',
                        name: 'plat_no_kendaraan',
                        className: 'text-center'
                    },
                    {
                        data: 'angkut_orang',
                        name: 'angkut_orang',
                        className: 'text-center'
                    },
                    {
                        data: 'angkut_barang',
                        name: 'angkut_barang',
                        className: 'text-center'
                    },
                    {
                        data: 'thn_pembuatan',
                        name: 'thn_pembuatan',
                        className: 'text-center'
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
                        data: 'status',
                        name: 'status',
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center'
                    }
                ]
            });
        });
    </script>
@endsection
