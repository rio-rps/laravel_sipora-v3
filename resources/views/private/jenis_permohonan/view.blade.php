@extends('private.layout.main')
@section('isi')
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }}</b></h4>
            </div>
            <hr>

            <div class="card-body">


                <div class="row">
                    @foreach ($result as $dt)
                        <div class="col-md-6 col-sm-12">
                            <div class="card  border-primary">
                                <div class="card-header card-head-inverse bg-primary">
                                    <h4 class="card-title">{{ $dt->nm_jenis_permohonan }}</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                            <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($dt->RelasiPermohonan as $item)
                                                <li class="list-group-item">{{ $item->nm_par_permohonan }}

                                                    <span class="float-right">
                                                        <a id="tombolModalForm"
                                                            data-url="{{ route('vmodal.bgCard', $item->id_par_permohonan) }}"
                                                            title="Lihat Background Kartu"
                                                            class="btn btn-primary btn-sm text-white">
                                                            <i class="fa fa-picture-o"></i> Lihat
                                                        </a>
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                {{--  <div class="tab-pane " role="tabpanel">
                    <ul class="nav nav-tabs nav-top-border" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link tab-link btn-next-tab1 active" data-toggle="tab" data-target="#tab1"
                                href="#tab1"><i class="fa fa-play"></i> Jenis Permohonan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tab-link" data-toggle="tab" data-target="#tab2" href="#tab2"><i
                                    class="fa fa-play"></i> Permohonan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tab-link" data-toggle="tab" href="#tab3"><i class="fa fa-play"></i>
                                Data</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                    </div>
                    <div class="tab-pane border-info" id="tab2">
                        <div class="table-responsive bg-light-alt">
                            <table class="table table-borderless table-hover" id="table-info-program" width="100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm btn-round btn-next-tab1"
                                                onclick="activateTab('#tab1')"><i class="fa fa-angle-left"></i>
                                                kembali</button>
                                        </td>
                                        <td>Jenis Permohonan</td>
                                        <td width="1%">:</td>
                                        <td>07 Tahun 2022</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <div class="tab-pane border-info" id="tab2">
                            <div class="table-responsive bg-light-alt">
                                <table class="table table-borderless table-hover" id="table-info-program" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm btn-round"
                                                    onclick="activateTab('#tab1')"><i class="fa fa-angle-left"></i>
                                                    kembali</button>
                                            </td>
                                            <td>Jenis Permohonan</td>
                                            <td width="1%">:</td>
                                            <td>07 Tahun 2022</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm btn-round"
                                                    onclick="activateTab('#tab2')"><i class="fa fa-angle-left"></i>
                                                    kembali</button>
                                            </td>
                                            <td>Permohonan</td>
                                            <td width="1%">:</td>
                                            <td>07 Tahun 2022</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="border-primary">
                <table id="myTable" class="table table-striped table-bordered zero-configuration" style="width:100%">
                    <thead>
                    </thead>
                    <tbody></tbody>
                </table>  --}}

            </div>

        </div>
    </div>
    <div class="viewModal" style="display:none;"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {


            var tableTab1 = [{
                    title: 'No',
                    data: null
                },
                {
                    title: 'Jenis Permohonan',
                    data: 'nm_jenis_permohonan'
                },
                {
                    title: 'Action',
                    data: 'action',
                    orderable: false,
                    searchable: false
                },
            ];

            var tableTab2 = [{
                    title: 'No',
                    data: null
                },
                {
                    title: 'Permohonan',
                    data: 'nm_par_permohonan'
                },
                {
                    title: 'Action',
                    data: 'action',
                    orderable: false,
                    searchable: false
                },
            ];



            var myTable = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('cparJenisPermohonan.data-tab1') }}",
                columns: tableTab1,
                autoWidth: true,
                columnDefs: [{
                        width: '1%',
                        targets: 0,
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        targets: 1,
                    },
                    {
                        width: '1%',
                        targets: 2,
                        className: 'text-center'
                    },
                ]
            });


            $('.btn-next-tab1').click(function(e) {
                e.preventDefault();
                myTable.ajax.reload();
            });

            $('#myTable').on('click', '.btn-next-tab2', function() {
                var id = $(this).data('id');
                var targetTab = $(this).data('target');
                //$('#tab2').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Loading Data...</div>');
                activateTab(targetTab)
                var myTable = $('#myTable').DataTable().destroy();
                var myTable = $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('cparJenisPermohonan.data-tab2') }}",
                        data: {
                            id: id,
                        }
                    },
                    columns: tableTab2,
                    autoWidth: true,
                    columnDefs: [{
                            width: '1%',
                            targets: 0,
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            targets: 1,
                        },
                        {
                            width: '1%',
                            targets: 2,
                            className: 'text-center'
                        },
                    ]
                });


            });
        })

        function activateTab(targetTab) {
            $('.nav-link').removeClass('active');
            $(`[data-target="${targetTab}"]`).addClass('active');
            $('.tab-pane').removeClass('show active');
            $(targetTab).addClass('show active');
        }
    </script>
@endsection
