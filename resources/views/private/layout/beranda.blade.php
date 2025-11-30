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
    <script src="https://code.highcharts.com/highcharts.js"></script>

    @if (getLevel() == 1)
        <div class="card">
            <div class="card-header" style="margin-bottom:-20px;">
                <div class="row  align-items-center">
                    <!-- Kolom kiri -->
                    <div class="col-md-9 col-12">
                        <h4 class="card-title fw-bold mb-0"><i class="fa fa-folder"></i> GRAFIK TAHUNAN PERMOHONAN SELESAI
                            PROSES
                            (PROV/KAB/KOTA)
                        </h4>
                    </div>
                </div>
            </div>
            <hr>
            <div class="viewDataGrafiktahunan" style="display:none;"></div>
        </div>
    @endif

    <div class="card">
        <div class="card-header" style="margin-bottom:-20px;">
            <div class="row  align-items-center">
                <!-- Kolom kiri -->
                <div class="col-md-9 col-12">
                    <h4 class="card-title fw-bold mb-0"><i class="fa fa-folder"></i> MONITORING PERMOHONAN KAB/KOTA TAHUN
                        <span id="tahunFilter"></span>
                    </h4>
                </div>

                <!-- Kolom kanan -->
                <div class="col-md-3 col-12 text-md-right mt-2 mt-md-0">
                    <div class="input-group input-group-sm justify-content-md-end">
                        <select id="tahun" class="form-control form-control-sm w-auto mr-1">
                            <option value="" selected>--Pilih--</option>
                            @for ($tahun = 2023; $tahun <= date('Y'); $tahun++)
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endfor
                        </select>
                        <div class="input-group-append">
                            <button id="btn-tampilkan1" class="btn btn-primary btn-sm">Tampilkan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="viewData" style="display:none;"></div>
    </div>


    <div class="viewModal" style="display:none;width:100%"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            getDataGrafiktahunan();
            const tahun = new Date().getFullYear();
            var akses = "{{ getLevel() }}";

            if (akses == 1 || akses == 4) {
                var countKabkota = "{{ $countKabkota }}";
                getFilter(tahun);
                getFilterPermohonan(tahun);
            } else if (akses == 2) {
                var countKabkota = "{{ $countKabkota }}";
                var id_kabkota = "{{ $aksesKabkotaFirst }}";
                //alert(id_kabkota);
                if (countKabkota == 18) {
                    getFilter(tahun);
                } else {
                    getFilter(tahun);
                }
            }
        });


        $('#btn-tampilkan1').on('click', function() {
            var tahun = $('#tahun').val();
            if (tahun == '') {
                Swal.fire('Gagal', 'Silakan Pilih Tahun !', 'warning');
            } else {
                getFilter(tahun);
            }
        });


        function getFilter(tahun = null) {

            $.ajax({
                url: "{{ route('panel.show_jenis_permohonan') }}",
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    tahun: tahun,
                },
                success: function(response) {
                    $('.viewData').html(response).show();
                    $('#tahunFilter').html(tahun);

                    //alert(response);
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan: " + error);
                }
            });
        }




        function getDataGrafiktahunan() {

            $.ajax({
                url: "{{ route('panel.show_grafik_tahunan') }}",
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('.viewDataGrafiktahunan').html(response).show();
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan: " + error);
                }
            });
        }
    </script>
@endsection
