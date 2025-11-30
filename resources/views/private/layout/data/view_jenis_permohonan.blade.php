 <div class="card-body ">
     {{--  <h5 class="card-title "><span class="font-weight-bold">{{ $title_form }}</span></h5>  --}}

     <div class="row">
         <div class="col-md-12 col-sm-12">
             <div class="card">
                 <div class="table-responsive">
                     <table class="table-bordered  table-sm text-nowrap small tableCustomHoverA">
                         <thead class="bg-secondary text-white">
                             <tr>
                                 <td></td>
                                 <td></td>
                                 @foreach ($jenisPermohonan as $jenisPermohonanAll)
                                     <td colspan="4" align="center">
                                         {{ $jenisPermohonanAll->nm_jenis_permohonan }}
                                     </td>
                                 @endforeach
                             </tr>
                         </thead>
                         <thead align="center" class="bg-secondary text-white">
                             <tr>
                                 <td width='1%'>NO</td>
                                 <td>Prov/Kab/Kota</td>
                                 @foreach ($jenisPermohonan as $jenisPermohonanAll)
                                     <td>Masuk</td>
                                     <td>Proses</td>
                                     <td>Selesai</td>
                                     <td>Jumlah</td>
                                 @endforeach
                             </tr>
                         </thead>
                         @php
                             // Siapkan array total untuk semua jenis permohonan
                             $grandTotal = [];
                             foreach ($jenisPermohonan as $jenisPermohonanAll) {
                                 $grandTotal[$jenisPermohonanAll->id_jenis_permohonan] = [
                                     'masuk' => 0,
                                     'proses' => 0,
                                     'selesai' => 0,
                                     'jumlah' => 0,
                                 ];
                             }
                         @endphp

                         <tbody align="right">
                             @foreach ($kabkotaAll as $kabkota)
                                 <tr>
                                     <td align="center">{{ $loop->iteration }}</td>
                                     <td align="left">
                                         <a href="javascript:void(0);" title="Klik Detail" id="tombolModalForm"
                                             data-url="{{ route('panel.filter_monitoringAll', ['id_kabkota' => $kabkota->id_kabkota, 'tahun' => $tahun]) }}">
                                             {{ $kabkota->nm_kabkota }}
                                         </a>
                                     </td>
                                     {{--  <td align="left">
                                         <a href="javascript:void(0);" title="Klik Detail" class="dropdown-toggle "
                                             type="button" data-toggle="dropdown">
                                             {{ $kabkota->nm_kabkota }}
                                         </a>
                                         <div class="dropdown-menu dropdown-menu-right">
                                             <button class="dropdown-item tombolModalForm" type="button"
                                                 id="tombolModalForm"
                                                 data-url="{{ route('panel.filter_monitoringAll', ['id_kabkota' => $kabkota->id_kabkota, 'tahun' => $tahun]) }}">
                                                 <i class="fa fa-arrow-circle-right me-1 text-success"></i>
                                                 Tampilkan
                                             </button>
                                             @foreach ($jenisPermohonan as $jenisPermohonanAll)
                                                 <button class="dropdown-item" type="button" id="tombolModalForm"
                                                     data-url=" ">
                                                     <i class="fa fa-arrow-circle-right me-1 text-success"></i>
                                                     {{ $jenisPermohonanAll->nm_jenis_permohonan }}
                                                 </button>
                                             @endforeach
                                         </div>
                                     </td>  --}}
                                     @foreach ($jenisPermohonan as $jenisPermohonanAll)
                                         @php
                                             $countJenisPermohonan = App\Models\PengajuanPermohonanModel::selectRaw(
                                                 "id_jenis_permohonan,
                                                COUNT(CASE WHEN status_permohonan = 2 THEN 1 END) as jmlh_masuk,
                                                COUNT(CASE WHEN status_permohonan = 4 THEN 1 END) as jmlh_diproses,
                                                COUNT(CASE WHEN status_permohonan = 5 THEN 1 END) as jmlh_selesai",
                                             )
                                                 ->where('kode_provinsi', $kabkota->kode_provinsi)
                                                 ->where('kode_kabkota', $kabkota->kode_kabkota)
                                                 ->where(
                                                     'id_jenis_permohonan',
                                                     $jenisPermohonanAll->id_jenis_permohonan,
                                                 )
                                                 ->whereYear('tgl_kirim_permohonan', $tahun)
                                                 ->groupBy('id_jenis_permohonan')
                                                 ->first();

                                             $masuk = $countJenisPermohonan->jmlh_masuk ?? 0;
                                             $proses = $countJenisPermohonan->jmlh_diproses ?? 0;
                                             $selesai = $countJenisPermohonan->jmlh_selesai ?? 0;
                                             $jumlah = $masuk + $proses + $selesai;

                                             // akumulasi total per jenis permohonan
                                             $grandTotal[$jenisPermohonanAll->id_jenis_permohonan]['masuk'] += $masuk;
                                             $grandTotal[$jenisPermohonanAll->id_jenis_permohonan]['proses'] += $proses;
                                             $grandTotal[$jenisPermohonanAll->id_jenis_permohonan][
                                                 'selesai'
                                             ] += $selesai;
                                             $grandTotal[$jenisPermohonanAll->id_jenis_permohonan]['jumlah'] += $jumlah;
                                         @endphp

                                         <td>{{ format_rupiah($masuk) }}</td>
                                         <td>{{ format_rupiah($proses) }}</td>
                                         <td>{{ format_rupiah($selesai) }}</td>
                                         <td>{{ format_rupiah($jumlah) }}</td>
                                     @endforeach
                                 </tr>
                             @endforeach
                         </tbody>

                         <tfoot align="right" class="font-weight-bold bg-light">
                             <tr>
                                 <td align="center"></td>
                                 <td align="center">Total</td>
                                 @foreach ($jenisPermohonan as $jenisPermohonanAll)
                                     <td>{{ format_rupiah($grandTotal[$jenisPermohonanAll->id_jenis_permohonan]['masuk']) }}
                                     </td>
                                     <td>{{ format_rupiah($grandTotal[$jenisPermohonanAll->id_jenis_permohonan]['proses']) }}
                                     </td>
                                     <td>{{ format_rupiah($grandTotal[$jenisPermohonanAll->id_jenis_permohonan]['selesai']) }}
                                     </td>
                                     <td>{{ format_rupiah($grandTotal[$jenisPermohonanAll->id_jenis_permohonan]['jumlah']) }}
                                     </td>
                                 @endforeach
                             </tr>
                             {{--  <tr align="center">
                                 <td colspan="2">-</td>
                                 <td colspan="4">
                                     <a href="#" class="btn btn-secondary btn-sm">Lihat Detail
                                         <i class="fa fa-desktop"></i>
                                     </a>
                                 </td>
                                 <td colspan="4">
                                     <a href="#" class="btn btn-primary btn-sm">Lihat Detail
                                         <i class="fa fa-desktop"></i>
                                     </a>
                                 </td>
                                 <td colspan="4">
                                     <a href="#" class="btn btn-primary btn-sm">Lihat Detail
                                         <i class="fa fa-desktop"></i>
                                     </a>
                                 </td>
                             </tr>  --}}
                         </tfoot>

                     </table>
                 </div>
             </div>
         </div>

     </div>

 </div>
