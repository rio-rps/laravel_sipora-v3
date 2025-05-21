@extends('private.layout.main')
@section('isi')
    <style>
        .kabkota-container {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .kabkota-image {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }

        .kabkota-details {
            flex-grow: 1;
            /* Membuat elemen ini mengambil ruang yang tersedia */
        }

        .kabkota-name {
            font-size: 16px;
            font-weight: bold;
        }
    </style>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }}</b></h4>
            </div>
            <div class="col-md-12">
                <div class="card-content card border-teal border-lighten-2 mr-1 ml-1">
                    <div class="card-body ">

                        <div class="row">
                            <div class="col-md-3">
                                <label for="basic-url">Jenis Permohonan</label>
                                <div class="input-group mb-3">
                                    <select class="custom-select" id="id_jenis_permohonan">
                                        <option selected value="">Pilih</option>
                                        <option value="All">Semua Permohonan</option>
                                        @foreach ($resultPermohonan as $resultPermohonanAll)
                                            <option value="{{ $resultPermohonanAll->id_jenis_permohonan }}">
                                                {{ $resultPermohonanAll->nm_jenis_permohonan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url">Status Permohonan</label>
                                <div class="input-group mb-3">
                                    <select class="custom-select" id="status_permohonan">
                                        <option selected value="">Pilih</option>
                                        <option value="2">Masuk</option>
                                        <option value="4">Proses</option>
                                        <option value="5">Selesai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="kabkota-container">
                            <img src ="{{ asset('images/img/instansi.webp') }}" alt="Logo kabkota" class ="kabkota-image">
                            <div class="kabkota-details">
                                <div class="kabkota-name"> Nama Kab/Kota</div>
                                <input type="hidden" id="id_kabkota">
                            </div>
                            <button class="btn btn-sm btn-secondary" id="tombolModalForm2"
                                data-url="{{ route('vmodal.show_kabkota', ['act' => 'lap_permohonan']) }}"> <i
                                    class="fa fa-search"></i>
                                Pilih KAB/KOTA </button>
                        </div>
                        <div class="form-group mt-3">
                            <label for="basic-url">Periode Permohonan</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="datesFilter" id="datesFilter"
                                    data-date-format='yyyy-mm-dd' />
                            </div>
                        </div>


                        <div>
                            <button type="button" class="btn  btn-primary" id="tombolProses" onclick="tombolProses()">
                                <i class='bx bx-save mr-25'></i> Tampilkan
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card-content card border-teal border-lighten-2 mr-1 ml-1">
                    <div class="card-body ">
                        <div class="views" style="display:none;width:100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="viewModal2" style="display:none;width:100%"></div>
    <script>
        $('input[name="datesFilter"]').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD' // Format as yyyy-mm-dd
            }
        });

        function tombolProses() {
            var id_jenis_permohonan = $('#id_jenis_permohonan').val();
            var status_permohonan = $('#status_permohonan').val();
            var id_kabkota = $('#id_kabkota').val();
            var datesFilter = $('#datesFilter').val();
            if (id_jenis_permohonan == '') {
                Swal.fire('Informasi', 'Silakan di pilih Jenis Permohonan !', 'warning');
            } else if (status_permohonan == '') {
                Swal.fire('Informasi', 'Silakan di pilih Status Permohonan !', 'warning');
            } else if (id_kabkota == '') {
                Swal.fire('Informasi', 'Silakan di pilih Kab/Kota !', 'warning');
            } else if (datesFilter == '') {
                Swal.fire('Informasi', 'Silakan di pilih Tanggal Filter !', 'warning');
            } else {

                myTable = $.ajax({
                    type: 'GET',
                    url: "{{ url('laporan/getLapPermohonan') }}",
                    data: {
                        id_jenis_permohonan: id_jenis_permohonan,
                        status_permohonan: status_permohonan,
                        id_kabkota: id_kabkota,
                        datesFilter: datesFilter,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('#loading-spinner').removeClass('d-none');
                    },
                    complete: function() {
                        $('#loading-spinner').addClass('d-none');
                    },
                    success: function(response) {
                        $('.views').html(response).show();
                    },
                    error: function(xhr, ajaxOptons, throwError) {
                        alert(xhr.status + '\n' + throwError);
                    }
                });
            }
        }
    </script>
@endsection
