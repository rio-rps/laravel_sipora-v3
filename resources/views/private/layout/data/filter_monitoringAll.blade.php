<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h4 class="modal-title " id="myModalLabel5">
                    <b><i class="fa fa-university"></i> {{ $title_form }}</b>
                </h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="table-responsive">
                    <table id="tableCustom" class="table table-hover tableCustomHoverA fw-bold" style="font-size:10px;">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>JENIS PERMOHONAN</th>
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
                                $no1 = 1;
                            @endphp
                            @foreach ($resultPermohonan as $jenis)
                                <tr>
                                    <td align="center">{{ $no1++ }}.</td>
                                    <td>
                                        {{ $jenis->JjenisPermohonan->nm_jenis_permohonan }}
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

                                {{-- //permohonan  --}}
                                @php
                                    $Permohonan = App\Models\PengajuanPermohonanModel::selectRaw(
                                        'id_par_permohonan,
                                            COUNT(CASE WHEN status_permohonan = 2 THEN 1 END) as jmlh_masuk,
                                            COUNT(CASE WHEN status_permohonan = 4 THEN 1 END) as jmlh_diproses,
                                            COUNT(CASE WHEN status_permohonan = 5 THEN 1 END) as jmlh_selesai',
                                    )
                                        ->where('kode_provinsi', $kode_provinsi)
                                        ->where('kode_kabkota', $kode_kabkota)
                                        ->where('id_jenis_permohonan', $jenis->id_jenis_permohonan)
                                        ->whereYear('tgl_kirim_permohonan', $tahunFilter)
                                        ->groupBy('id_par_permohonan')
                                        ->orderBy('id_par_permohonan', 'ASC')
                                        ->get();
                                @endphp
                                @foreach ($Permohonan as $permohonan)
                                    <tr>
                                        <td></td>
                                        <td>
                                            <img src="{{ asset('images/logo/bg-tree-red.png') }}" width="8em;">
                                            {{ $permohonan->JPermohonan->nm_par_permohonan }}
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

                                    {{-- //Trayek  --}}
                                    @php
                                        $Trayek = App\Models\PengajuanPermohonanModel::selectRaw(
                                            'id_trayek,
                                                COUNT(CASE WHEN status_permohonan = 2 THEN 1 END) as jmlh_masuk,
                                                COUNT(CASE WHEN status_permohonan = 4 THEN 1 END) as jmlh_diproses,
                                                COUNT(CASE WHEN status_permohonan = 5 THEN 1 END) as jmlh_selesai',
                                        )
                                            ->where('kode_provinsi', $kode_provinsi)
                                            ->where('kode_kabkota', $kode_kabkota)
                                            ->where('id_jenis_permohonan', $jenis->id_jenis_permohonan)
                                            ->where('id_par_permohonan', $permohonan->id_par_permohonan)
                                            ->whereYear('tgl_kirim_permohonan', $tahunFilter)
                                            ->groupBy('id_trayek')
                                            ->orderBy('id_trayek', 'ASC')
                                            ->get();
                                    @endphp
                                    @foreach ($Trayek as $trayek)
                                        @php
                                            $kdTrayek = $trayek->id_trayek ?? 0;
                                        @endphp
                                        @if ($trayek->id_trayek != 0)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp; <img
                                                        src="{{ asset('images/logo/bg-tree-green.png') }}"
                                                        width="8em;">
                                                    {{ $trayek->Jtrayek->nm_trayek }}
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

                                        {{--  //jenis angkutan tanpa trayek --}}
                                        @php
                                            $AngkutanTanpaTrayek = App\Models\PengajuanPermohonanModel::selectRaw(
                                                'id_jenis_angkutan,
                                                COUNT(CASE WHEN status_permohonan = 2 THEN 1 END) as jmlh_masuk,
                                                COUNT(CASE WHEN status_permohonan = 4 THEN 1 END) as jmlh_diproses,
                                                COUNT(CASE WHEN status_permohonan = 5 THEN 1 END) as jmlh_selesai',
                                            )
                                                ->where('kode_provinsi', $kode_provinsi)
                                                ->where('kode_kabkota', $kode_kabkota)
                                                ->where('id_jenis_permohonan', $jenis->id_jenis_permohonan)
                                                ->where('id_par_permohonan', $permohonan->id_par_permohonan)
                                                ->where('id_trayek', $kdTrayek)
                                                ->whereYear('tgl_kirim_permohonan', $tahunFilter)
                                                ->groupBy('id_jenis_angkutan')
                                                ->orderBy('id_jenis_angkutan', 'ASC')
                                                ->get();
                                        @endphp
                                        @foreach ($AngkutanTanpaTrayek as $angkutantanpatrayek)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp; <img
                                                        src="{{ asset('images/logo/bg-tree-yellow.png') }}"
                                                        width="8em;">
                                                    {{ $angkutantanpatrayek->JjenisAngkutan->nm_jenis_angkutan }}

                                                </td>
                                                <td align="center">
                                                    {{ format_rupiah($angkutantanpatrayek->jmlh_masuk) }}
                                                </td>
                                                <td align="center">
                                                    {{ format_rupiah($angkutantanpatrayek->jmlh_diproses) }}
                                                </td>
                                                <td align="center">
                                                    {{ format_rupiah($angkutantanpatrayek->jmlh_selesai) }}
                                                </td>
                                            </tr>

                                            {{--  //Mengangkut --}}
                                            @php
                                                $Mengangkut = App\Models\PengajuanPermohonanModel::selectRaw(
                                                    'id_mengangkut,
                                                        COUNT(CASE WHEN status_permohonan = 2 THEN 1 END) as jmlh_masuk,
                                                        COUNT(CASE WHEN status_permohonan = 4 THEN 1 END) as jmlh_diproses,
                                                        COUNT(CASE WHEN status_permohonan = 5 THEN 1 END) as jmlh_selesai',
                                                )
                                                    ->where('kode_provinsi', $kode_provinsi)
                                                    ->where('kode_kabkota', $kode_kabkota)
                                                    ->where('id_jenis_permohonan', $jenis->id_jenis_permohonan)
                                                    ->where('id_par_permohonan', $permohonan->id_par_permohonan)
                                                    ->where('id_trayek', $kdTrayek)
                                                    ->where(
                                                        'id_jenis_angkutan',
                                                        $angkutantanpatrayek->id_jenis_angkutan,
                                                    )
                                                    ->whereYear('tgl_kirim_permohonan', $tahunFilter)
                                                    ->groupBy('id_mengangkut')
                                                    ->orderBy('id_mengangkut', 'ASC')
                                                    ->get();
                                            @endphp
                                            @foreach ($Mengangkut as $mengangkut)
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp; <img
                                                            src="{{ asset('images/logo/bg-tree-purple.png') }}"
                                                            width="8em;">
                                                        {{ $mengangkut->jmengangkut->nm_mengangkut }}
                                                    </td>
                                                    <td align="center">
                                                        {{ format_rupiah($mengangkut->jmlh_masuk) }}
                                                    </td>
                                                    <td align="center">
                                                        {{ format_rupiah($mengangkut->jmlh_diproses) }}
                                                    </td>
                                                    <td align="center">
                                                        {{ format_rupiah($mengangkut->jmlh_selesai) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>

                </div>
            </div>
        </div>
    </div>
