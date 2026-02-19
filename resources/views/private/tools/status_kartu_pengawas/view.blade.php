@extends('private.layout.main')
@section('isi')
    {{--  @if (auth()->check() && in_array(getLevel(), [3]))
        <script type="text/javascript">
            window.location = "/";
        </script>
    @endif  --}}

    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }} </b></h4>
                <hr class="border-secondary">
            </div>

            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered zero-configuration" style="width:100%">
                        <thead>
                            <tr>
                                <th width=" 1%">No</th>
                                <th>Kartu Pengawas</th>
                                <th>Nama Perusahaan</th>
                                <th>Nama Pimpinan</th>

                                <th>Tgl diproses</th>
                                <th>Tgl disetujui</th>
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

            myTable = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('tools/showKartuPengawas') }}",
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
                        data: 'no_kartu_pengawas',
                        name: 'no_kartu_pengawas',
                        // className: 'text-center',
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
                        className: 'text-center',
                        data: 'tgl_proses',
                        name: 'tgl_proses'
                    },
                    {
                        className: 'text-center',
                        data: 'tgl_disetujui',
                        name: 'tgl_disetujui'
                    },
                    {
                        className: 'text-center',
                        data: 'status',
                        name: 'status'
                    },

                    {
                        className: 'text-center',
                        data: 'action',
                        name: 'action',
                    }
                ]
            });
        });
    </script>
@endsection
