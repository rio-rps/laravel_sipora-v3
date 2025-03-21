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
        <div class="card-header">

            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <select name="ambilData" id="ambilData" onclick="ambilData(this)">
                        <option value="" selected>--Pilih--</option>
                        <option value="All">Tampilkan Semua Data</option>
                        @foreach ($resultKabKota as $resultKabKotaAll)
                            <option value="{{ $resultKabKotaAll->id_kabkota }}">{{ $resultKabKotaAll->nm_kabkota }}
                            </option>
                        @endforeach
                    </select>
                    <select name="ambilData" id="ambilData" onclick="ambilData(this)">
                        <option value="" selected>--Pilih--</option>
                        <option value="2">Masuk</option>
                        <option value="4">Proses</option>
                        <option value="5">Selesai</option>
                    </select>
                </ul>
            </div>
        </div>
        <div class="viewData" style="display:none;"></div>
    </div>



    <div class="card">
        <div class="card-header">
            <h4 class="card-title fw-bold">DATA PERMOHONAN</h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content mr-1 ml-1">
            <div class="table-responsive">
                <table id="tableCustom" class="table table-hover tableCustomHoverA fw-bold" style="font-size:10px;">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th>Kab/kota</th>
                            <th width="1%">
                                <center>Masuk</center>
                            </th>
                            <th width="1%">
                                <center>Proses</center>
                            </th>
                            <th width="1%">
                                <center>Selesai</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalJumlahMasuk = 0;
                            $totalJumlahdiProses = 0;
                            $totalJumlahSelesai = 0;
                        @endphp
                        @foreach ($resultPermohonan as $dtresultPermohonan)
                            <tr>
                                <td align="center">{{ $loop->iteration }}</td>
                                <td>
                                    <a href="javascript:void(0);" class="nama-kabkota"
                                        data-id="{{ $dtresultPermohonan->id_kabkota }}">
                                        {{ $dtresultPermohonan->nm_kabkota }}
                                    </a>
                                </td>
                                <td align="center">
                                    {{ format_rupiah($dtresultPermohonan->jmlh_masuk) }}
                                </td>
                                <td align="center">
                                    {{ format_rupiah($dtresultPermohonan->jmlh_diproses) }}
                                </td>
                                <td align="center">
                                    {{ format_rupiah($dtresultPermohonan->jmlh_selesai) }}
                                </td>
                            </tr>

                            {{--  //jenis  --}}
                            @php
                                $jenisPermohonan = App\Models\PengajuanPermohonanModel::selectRaw(
                                    'id_jenis_permohonan,
                                     COUNT(CASE WHEN status_permohonan = 2 THEN 1 END) as jmlh_masuk,
                                     COUNT(CASE WHEN status_permohonan = 4 THEN 1 END) as jmlh_diproses,
                                     COUNT(CASE WHEN status_permohonan = 5 THEN 1 END) as jmlh_selesai',
                                )
                                    ->where('kode_provinsi', $dtresultPermohonan->kode_provinsi)
                                    ->where('kode_kabkota', $dtresultPermohonan->kode_kabkota)
                                    ->groupBy('id_jenis_permohonan')
                                    ->orderBy('id_jenis_permohonan', 'ASC')
                                    ->get();
                            @endphp



                            @foreach ($jenisPermohonan as $jenis)
                                <tr id="collapseJenis-{{ $dtresultPermohonan->id_kabkota }}-{{ $jenis->id_jenis_permohonan }}"
                                    class="collapse-rowJenis-{{ $dtresultPermohonan->id_kabkota }}" style="display:none;">
                                    <td></td>
                                    <td>
                                        <a href="javascript:void(0);" class="nama-jenis"
                                            data-id="{{ $dtresultPermohonan->id_kabkota }}-{{ $jenis->id_jenis_permohonan }}">
                                            <img src="{{ asset('images/logo/bg-tree-blue.png') }}" width="8em;">
                                            {{ $jenis->JjenisPermohonan->nm_jenis_permohonan }}
                                        </a>
                                    </td>
                                    <td align="center">
                                        {{ format_rupiah($jenis->jmlh_masuk) }}
                                    </td>
                                    <td align="center">
                                        {{ format_rupiah($jenis->jmlh_diproses) }}
                                    </td>
                                    <td align="center">
                                        {{ format_rupiah($jenis->jmlh_selesai) }}
                                    </td>
                                </tr>



                                {{--  //permohonan  --}}
                                @php
                                    $Permohonan = App\Models\PengajuanPermohonanModel::selectRaw(
                                        'id_par_permohonan,
                             COUNT(CASE WHEN status_permohonan = 2 THEN 1 END) as jmlh_masuk,
                             COUNT(CASE WHEN status_permohonan = 4 THEN 1 END) as jmlh_diproses,
                             COUNT(CASE WHEN status_permohonan = 5 THEN 1 END) as jmlh_selesai',
                                    )
                                        ->where('kode_provinsi', $dtresultPermohonan->kode_provinsi)
                                        ->where('kode_kabkota', $dtresultPermohonan->kode_kabkota)
                                        ->where('id_jenis_permohonan', $jenis->id_jenis_permohonan)
                                        ->groupBy('id_par_permohonan')
                                        ->orderBy('id_par_permohonan', 'ASC')
                                        ->get();
                                @endphp
                                @foreach ($Permohonan as $permohonan)
                                    <tr id="collapsePermohonan-{{ $dtresultPermohonan->id_kabkota }}-{{ $jenis->id_jenis_permohonan }}-{{ $permohonan->id_par_permohonan }}"
                                        class="collapse-rowPermohonan2-{{ $dtresultPermohonan->id_kabkota }}"
                                        style="display:none;">
                                        <td></td>
                                        <td>
                                            <a href="javascript:void(0);" class="nama-permohonan"
                                                data-id="{{ $dtresultPermohonan->id_kabkota }}-{{ $jenis->id_jenis_permohonan }}-{{ $permohonan->id_par_permohonan }}">
                                                &nbsp;&nbsp;&nbsp;&nbsp; <img
                                                    src="{{ asset('images/logo/bg-tree-red.png') }}" width="8em;">
                                                {{ $permohonan->JPermohonan->nm_par_permohonan }}
                                            </a>
                                        </td>
                                        <td align="center">
                                            {{ format_rupiah($permohonan->jmlh_masuk) }}
                                        </td>
                                        <td align="center">
                                            {{ format_rupiah($permohonan->jmlh_diproses) }}
                                        </td>
                                        <td align="center">
                                            {{ format_rupiah($permohonan->jmlh_selesai) }}
                                        </td>
                                    </tr>

                                    {{--  //Trayek  --}}
                                    @php
                                        $Trayek = App\Models\PengajuanPermohonanModel::selectRaw(
                                            'id_trayek,
                         COUNT(CASE WHEN status_permohonan = 2 THEN 1 END) as jmlh_masuk,
                         COUNT(CASE WHEN status_permohonan = 4 THEN 1 END) as jmlh_diproses,
                         COUNT(CASE WHEN status_permohonan = 5 THEN 1 END) as jmlh_selesai',
                                        )
                                            ->where('kode_provinsi', $dtresultPermohonan->kode_provinsi)
                                            ->where('kode_kabkota', $dtresultPermohonan->kode_kabkota)
                                            ->where('id_jenis_permohonan', $jenis->id_jenis_permohonan)
                                            ->where('id_par_permohonan', $permohonan->id_par_permohonan)
                                            ->groupBy('id_trayek')
                                            ->orderBy('id_trayek', 'ASC')
                                            ->get();
                                    @endphp
                                    @foreach ($Trayek as $trayek)
                                        @php
                                            $kdTrayek = $trayek->id_trayek ?? 0;
                                        @endphp
                                        @if ($trayek->id_trayek != 0)
                                            <tr id="collapseTrayek-{{ $dtresultPermohonan->id_kabkota }}-{{ $jenis->id_jenis_permohonan }}-{{ $permohonan->id_par_permohonan }}-{{ $kdTrayek }}"
                                                class="collapse-rowTrayek-{{ $dtresultPermohonan->id_kabkota }}"
                                                style="display:none;">
                                                <td></td>
                                                <td>
                                                    <a href="javascript:void(0);" class="nama-trayek"
                                                        data-id="{{ $dtresultPermohonan->id_kabkota }}-{{ $jenis->id_jenis_permohonan }}-{{ $permohonan->id_par_permohonan }}-{{ $kdTrayek }}">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp; <img
                                                            src="{{ asset('images/logo/bg-tree-green.png') }}"
                                                            width="8em;">
                                                        {{ $trayek->Jtrayek->nm_trayek }}
                                                    </a>
                                                </td>
                                                <td align="center">
                                                    {{ format_rupiah($trayek->jmlh_masuk) }}
                                                </td>
                                                <td align="center">
                                                    {{ format_rupiah($trayek->jmlh_diproses) }}
                                                </td>
                                                <td align="center">
                                                    {{ format_rupiah($trayek->jmlh_selesai) }}
                                                </td>
                                            </tr>
                                        @else
                                        @endif
                                        @include('private.layout.data.jenis-mengangkut-tanpa-trayek')
                                    @endforeach
                                @endforeach
                            @endforeach







                            @php
                                $totalJumlahMasuk += $dtresultPermohonan->jmlh_masuk;
                                $totalJumlahdiProses += $dtresultPermohonan->jmlh_diproses;
                                $totalJumlahSelesai += $dtresultPermohonan->jmlh_selesai;
                            @endphp
                        @endforeach
                    </tbody>
                    <tr align="center">
                        <td></td>
                        <td>TOTAL</td>
                        <td>{{ format_rupiah($totalJumlahMasuk) }}</td>
                        <td>{{ format_rupiah($totalJumlahdiProses) }}</td>
                        <td>{{ format_rupiah($totalJumlahSelesai) }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="viewModal" style="display:none;width:100%"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ambilData(5);
        });

        $('.nama-kabkota').on('click', function() {
            var kabkota = $(this).data('id');
            var collapseRows = $('[id^="collapseJenis-' + kabkota + '-"]');
            collapseRows.toggle();

            $('.collapse-rowMenangkut-' + kabkota).not(collapseRows).hide();
            $('.collapse-rowAngkutanTanpaTrayek-' + kabkota).not(collapseRows).hide();
            $('.collapse-rowTrayek-' + kabkota).not(collapseRows).hide();
            $('.collapse-rowJenis-' + kabkota).not(collapseRows).hide();
            $('.collapse-rowPermohonan2-' + kabkota).not(collapseRows).hide();
        });

        $('.nama-jenis').on('click', function() {
            var jenis = $(this).data('id');
            var collapseRows = $('[id^="collapsePermohonan-' + jenis + '-"]');
            collapseRows.toggle();

            $('.collapse-rowMenangkut').not(collapseRows).hide();
            $('.collapse-rowAngkutanTanpaTrayek').not(collapseRows).hide();
            $('.collapse-rowTrayek').not(collapseRows).hide();
        });

        $('.nama-permohonan').on('click', function() {
            var permohonan = $(this).data('id');
            var collapseRows = $('[id^="collapseTrayek-' + permohonan + '-"]');
            collapseRows.toggle();

        });



        $('.nama-permohonan').on('click', function() {
            var angkutan = $(this).data('id');
            var collapseRows = $('[id^="collapseAngkutanTanpaTrayek-' + angkutan + '-"]');
            collapseRows.toggle();
            $('.collapse-rowMenangkut').not(collapseRows).hide();
        });

        $('.nama-trayek').on('click', function() {
            var angkutan = $(this).data('id');
            var collapseRows = $('[id^="collapseAngkutanTanpaTrayek-' + angkutan + '-"]');
            collapseRows.toggle();
            $('.collapse-rowAngkutanTanpaTrayek').not(collapseRows).hide();



        });

        $('.nama-AngkutanTanpaTrayek').on('click', function() {
            var angkutan = $(this).data('id');
            var collapseRows = $('[id^="collapseMengangkut-' + angkutan + '-"]');
            collapseRows.toggle();
        });
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

        function ambilData(selectElement) {
            var selectedValue = selectElement;
            if (selectedValue) {
                $.ajax({
                    url: "{{ route('panel.show_jenis_permohonan') }}",
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        status: selectedValue
                    },
                    success: function(response) {
                        $('.viewData').html(response).show();
                        //alert(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Terjadi kesalahan: " + error);
                    }
                });
            } else {
                console.log("Silakan pilih opsi.");
            }
        }
    </script>
@endsection
