@extends('private.layout.main')
@section('isi')
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }}</b></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a href="#" class="btn btn-warning" onclick="refresh()"><i
                                    class="feather icon-refresh-cw"></i></a></li>
                        <li>
                            <a class="btn btn-primary form-data" data-url="{{ route('dataUserPetugas.create') }}"
                                id="tombolModalForm">
                                <i class="feather icon-plus-square"></i> Tambah Data
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped  table-hover" style="width:100%;  ">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th width="1%"><i class="fa fa-hashtag"></i> No</th>
                                <th><i class="fa fa-id-card"></i> Nama</th>
                                <th><i class="fa fa-envelope"></i> Email</th>
                                <th><i class="fa fa-toggle-on"></i> Status User</th>
                                <th><i class="fa fa-university"></i> Kab/Kota</th>
                                <th width="10%" align="center"><i class="fa fa-cogs"></i> Action</th>
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
                ajax: "{{ url('dataUserPetugas/show') }}",
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        className: 'text-center',
                        data: 'stts',
                        name: 'stts'
                    },
                    {
                        data: 'kabkota',
                        name: 'kabkota'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ]
            });
        });

        function refresh() {
            myTable.ajax.reload();
        }
    </script>
@endsection
