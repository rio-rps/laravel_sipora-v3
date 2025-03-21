@php
    $Angkutan = App\Models\PengajuanPermohonanModel::selectRaw(
        'id_jenis_angkutan,
COUNT(CASE WHEN status_permohonan = 2 THEN 1 END) as jmlh_masuk,
COUNT(CASE WHEN status_permohonan = 4 THEN 1 END) as jmlh_diproses,
COUNT(CASE WHEN status_permohonan = 5 THEN 1 END) as jmlh_selesai',
    )
        ->where('kode_provinsi', $dtresultPermohonan->kode_provinsi)
        ->where('kode_kabkota', $dtresultPermohonan->kode_kabkota)
        ->where('id_jenis_permohonan', $jenis->id_jenis_permohonan)
        ->where('id_par_permohonan', $permohonan->id_par_permohonan)
        ->where('id_trayek', $kdTrayek)
        ->groupBy('id_jenis_angkutan')
        ->orderBy('id_jenis_angkutan', 'ASC')
        ->get();
@endphp
@foreach ($Angkutan as $angkutan)
    <tr id="collapseAngkutan-{{ $dtresultPermohonan->id_kabkota }}-{{ $jenis->id_jenis_permohonan }}-{{ $permohonan->id_par_permohonan }}-{{ $kdTrayek }}-{{ $angkutan->id_angkutan }}"
        class="collapse-row" style="display:none;">
        <td></td>
        <td>
            <a href="javascript:void(0);" class="nama-x" data-id="">
                &nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp; <img src="{{ asset('images/logo/bg-tree-yellow.png') }}" width="8em;">
                {{ $angkutan->JjenisAngkutan->nm_jenis_angkutan }}
            </a>
        </td>
        <td align="center">
            {{ format_rupiah($angkutan->jmlh_masuk) }}
        </td>
        <td align="center">
            {{ format_rupiah($angkutan->jmlh_diproses) }}
        </td>
        <td align="center">
            {{ format_rupiah($angkutan->jmlh_selesai) }}
        </td>
    </tr>
@endforeach
