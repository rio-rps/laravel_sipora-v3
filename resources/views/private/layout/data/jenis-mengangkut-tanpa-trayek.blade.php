      {{--  //jenis angkutan tanpa trayek --}}
      @php
          $AngkutanTanpaTrayek = App\Models\PengajuanPermohonanModel::selectRaw(
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
              ->whereYear('tgl_kirim_permohonan', $tahunFilter)
              ->groupBy('id_jenis_angkutan')
              ->orderBy('id_jenis_angkutan', 'ASC')
              ->get();
      @endphp
      @foreach ($AngkutanTanpaTrayek as $angkutantanpatrayek)
          <tr id="collapseAngkutanTanpaTrayek-{{ $dtresultPermohonan->id_kabkota }}-{{ $jenis->id_jenis_permohonan }}-{{ $permohonan->id_par_permohonan }}-{{ $kdTrayek }}-{{ $angkutantanpatrayek->id_jenis_angkutan }}"
              class="collapse-rowAngkutanTanpaTrayek-{{ $dtresultPermohonan->id_kabkota }}" style="display:none;">
              <td></td>
              <td>
                  <a href="javascript:void(0);" class="nama-AngkutanTanpaTrayek"
                      data-id="{{ $dtresultPermohonan->id_kabkota }}-{{ $jenis->id_jenis_permohonan }}-{{ $permohonan->id_par_permohonan }}-{{ $kdTrayek }}-{{ $angkutantanpatrayek->id_jenis_angkutan }}">
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp; <img src="{{ asset('images/logo/bg-tree-yellow.png') }}" width="8em;">
                      {{ $angkutantanpatrayek->JjenisAngkutan->nm_jenis_angkutan }}
                  </a>
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
                  ->where('kode_provinsi', $dtresultPermohonan->kode_provinsi)
                  ->where('kode_kabkota', $dtresultPermohonan->kode_kabkota)
                  ->where('id_jenis_permohonan', $jenis->id_jenis_permohonan)
                  ->where('id_par_permohonan', $permohonan->id_par_permohonan)
                  ->where('id_trayek', $kdTrayek)
                  ->where('id_jenis_angkutan', $angkutantanpatrayek->id_jenis_angkutan)
                  ->whereYear('tgl_kirim_permohonan', $tahunFilter)
                  ->groupBy('id_mengangkut')
                  ->orderBy('id_mengangkut', 'ASC')
                  ->get();
          @endphp
          @foreach ($Mengangkut as $mengangkut)
              <tr id="collapseMengangkut-{{ $dtresultPermohonan->id_kabkota }}-{{ $jenis->id_jenis_permohonan }}-{{ $permohonan->id_par_permohonan }}-{{ $kdTrayek }}-{{ $angkutantanpatrayek->id_jenis_angkutan }}-{{ $mengangkut->id_mengangkut }}"
                  class="collapse-rowMenangkut-{{ $dtresultPermohonan->id_kabkota }}" style="display:none;">
                  <td></td>
                  <td>

                      &nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp; <img src="{{ asset('images/logo/bg-tree-purple.png') }}" width="8em;">
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
