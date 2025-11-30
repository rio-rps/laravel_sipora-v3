@extends('private.layout.main')
@section('isi')
    <style>
        /* Gaya khusus untuk tabel dengan ID rencanaBayar */
        #tableCustom {
            border-collapse: collapse;
            /* Menggabungkan border agar tidak double */
            width: 100%;
            font-size: 12px;
        }

        #tableCustom th,
        #tableCustom td {
            // border: 1px solid #000;
            /* Border untuk setiap sel tabel */
            padding: 8px;
            /* Padding dalam sel tabel */
            // text-align: left;
            /* Mengatur teks rata kiri */
        }

        /* Border untuk bagian header tabel */
        #tableCustom th {
            background-color: #f2f2f2;
            /* Warna background untuk header tabel */
            color: #000;
            /* Warna teks untuk header tabel */
        }



        .tableCustomHoverA tbody tr:hover {
            background-color: #edf0f4 !important;
            /* Warna latar belakang saat hover */
            color: rgb(3, 0, 0) !important;
            /* Warna teks saat hover */
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        }
    </style>

    <div class="card">
        <div class="card-header" style="margin-bottom:-10px;">

            <h4 class="card-title fw-bold mb-0"><i class="fa fa-folder"></i> MONITORING JENIS PERMOHONAN</h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <div class="input-group">
                        <select id="id_kabkota" class="form-control form-control-sm w-auto mr-1">
                            <option value="" selected>--Pilih--</option>
                            @if (getLevel() == 1)
                                <option value="All">Tampilkan Semua Data</option>
                            @elseif (getLevel() == 2)
                                @if (count($resultKabKota) == 18)
                                    <option value="All">Tampilkan Semua Data</option>
                                @endif
                            @endif
                            @foreach ($resultKabKota as $resultKabKotaAll)
                                <option value="{{ $resultKabKotaAll->id_kabkota }}">{{ $resultKabKotaAll->nm_kabkota }}
                                </option>
                            @endforeach
                        </select>
                        <select id="status_permohonan" class="form-control form-control-sm w-auto mr-1">
                            <option value="" selected>--Pilih--</option>
                            <option value="2">Masuk</option>
                            <option value="4">Proses</option>
                            <option value="5">Selesai</option>
                        </select>
                        <select id="tahun" class="form-control form-control-sm w-auto mr-1">
                            <option value="" selected>--Pilih--</option>
                            @for ($tahun = 2023; $tahun <= date('Y'); $tahun++)
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endfor
                        </select>
                        <button id="btn-tampilkan1" class="btn btn-primary btn-sm">Tampilkan</button>
                    </div>

                </ul>
            </div>
        </div>
        <hr>
        <div class="viewData" style="display:none;"></div>
    </div>


    <div class="card ">

        <div class="viewDataPermohonan" style="display:none;"></div>


    </div>
    <div class="viewModal" style="display:none;width:100%"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tahun = new Date().getFullYear();
            //getFilter('All', 5, tahun);
            // getFilterPermohonan(tahun); 

            var akses = "{{ getLevel() }}";

            if (akses == 1 || akses == 4) {
                var countKabkota = "{{ $countKabkota }}";
                getFilter('All', 5, tahun);
                getFilterPermohonan(tahun);
            } else if (akses == 2) {
                var countKabkota = "{{ $countKabkota }}";
                var id_kabkota = "{{ $aksesKabkotaFirst }}";
                //alert(id_kabkota);
                if (countKabkota == 18) {
                    getFilter('All', 5, tahun);
                } else {
                    getFilter(id_kabkota, 5, tahun);
                }
                getFilterPermohonan(tahun);
            }
        });


        $('#btn-tampilkan1').on('click', function() {
            var id_kabkota = $('#id_kabkota').val();
            var status_permohonan = $('#status_permohonan').val();
            var tahun = $('#tahun').val();
            if (id_kabkota == '') {
                Swal.fire('Gagal', 'Silakan Pilih Kab/kota !', 'warning');
            } else if (status_permohonan == '') {
                Swal.fire('Gagal', 'Silakan Pilih Status Permohonan !', 'warning');
            } else if (tahun == '') {
                Swal.fire('Gagal', 'Silakan Pilih Tahun !', 'warning');
            } else {
                getFilter(id_kabkota, status_permohonan, tahun);
            }
        });


        function getFilter(id_kabkota = null, status_permohonan = null, tahun = null) {

            $.ajax({
                url: "{{ route('panel.show_jenis_permohonan') }}",
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id_kabkota: id_kabkota,
                    status: status_permohonan,
                    tahun: tahun,
                },
                success: function(response) {
                    $('.viewData').html(response).show();
                    //alert(response);
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan: " + error);
                }
            });
        }

        function getFilterPermohonan(tahun = null) {

            $.ajax({
                url: "{{ route('panel.show_permohonan') }}",
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    tahun: tahun,
                },
                success: function(response) {
                    $('.viewDataPermohonan').html(response).show();
                    //alert(response);
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan: " + error);
                }
            });
        }


        /*
        
        $('.nama-trayek').on('click', function() {
            var angkutan = $(this).data('id');
            var collapseRows = $('[id^="collapseAngkutan-' + angkutan + '-"]');
        });
        $('.nama-jenis').on('click', function() {
            var Jenis = $(this).data('id');
            var collapseRowJenis = $('#collapseJenis-' + Jenis);
            collapseRowJenis.toggle();

        });
        */
    </script>
@endsection
