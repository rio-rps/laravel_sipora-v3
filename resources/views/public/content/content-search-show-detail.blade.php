 <div class="modal fade" id="getModalForm" tabindex="-1" aria-labelledby="myModalLabel5" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document"> <!-- tambah modal-lg jika mau besar -->
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="myModalLabel5"><b>{{ $title_form }}</b></h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>

             <div class="modal-body">
                 <table class="table table-striped table-bordered" style="font-size:11px;">
                     <tbody>
                         <tr>
                             <td>Tanggal Kirim Permohonan</td>
                             <td>:</td>
                             <td>{{ cek_date_ddmmyyyy_his_v1($row->tgl_kirim_permohonan) }}</td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top;">Tanggal Proses</td>
                             <td width="1%" style="vertical-align: top;">:</td>
                             <td style="vertical-align: top;">
                                 {{ isset($row->JPermohonanValidasi->tgl_validasi_proses) ? cek_date_ddmmyyyy_his_v1($row->JPermohonanValidasi->tgl_validasi_proses) : '-' }}
                             </td>
                         </tr>
                         <tr>
                             <td>Tanggal Disetujui</td>
                             <td>:</td>
                             <td>{{ isset($row->JPermohonanValidasi->tgl_validasi_selesai) ? cek_ddmmyy_v1($row->JPermohonanValidasi->tgl_validasi_selesai) : '-' }}
                             </td>
                         </tr>
                         <tr>
                             <td>PIC Validasi Data</td>
                             <td>:</td>
                             <td>{{ $row->nm_kabkota }}</td>
                         </tr>
                         <tr>
                             <td>Status</td>
                             <td>:</td>
                             <td>
                                 @if (isset($row->JPermohonanValidasi->status_validasi))
                                     {!! status_permohonan_vb5($row->JPermohonanValidasi->status_validasi) !!}
                                 @else
                                     {!! status_permohonan_vb5($row->status_permohonan) !!}
                                 @endif

                             </td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                 <hr>
                             </td>
                         </tr>
                         <tr>
                             <td>Badan Usaha</td>
                             <td>:</td>
                             <td>{{ $row->BadanUsaha->nm_badan_usaha }}</td>
                         </tr>
                         <tr>
                             <td>Nama Perusahaan / Personal</td>
                             <td>:</td>
                             <td>{{ $row->nm_perusahaan_personal }}</td>
                         </tr>
                         <tr>
                             <td>Nama Pimpinan / Pemilik</td>
                             <td>:</td>
                             <td>{{ $row->nm_pimpinan_pemilik }}</td>
                         </tr>
                         <tr>
                             <td>Alamat</td>
                             <td>:</td>
                             <td>{{ $row->alamat_biodata }}</td>
                         </tr>
                         <tr>
                             <td>Email</td>
                             <td>:</td>
                             <td>
                                 {{ $row->email ? preg_replace('/(?<=.{2}).(?=[^@]*?@)/', '*', $row->email) : null }}
                             </td>
                         </tr>
                         <tr>
                             <td>No Hp</td>
                             <td>:</td>
                             <td>
                                 {{ $row->no_telp ? preg_replace('/\d(?=\d{3})/', '*', $row->no_telp) : null }}
                             </td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                 <hr>
                             </td>
                         </tr>
                         <tr>
                             <td>Jenis Permohonan</td>
                             <td>:</td>
                             <td>{{ $row->JjenisPermohonan->nm_jenis_permohonan }}</td>
                         </tr>
                         <tr>
                             <td>Permohonan</td>
                             <td>:</td>
                             <td>{{ $row->JPermohonan->nm_par_permohonan }}</td>
                         </tr>
                         <tr>
                             <td>Trayek</td>
                             <td>:</td>
                             <td>{{ $row->id_trayek == 0 ? '-' : $row->Jtrayek->nm_trayek }}</td>
                         </tr>
                         <tr>
                             <td>Jenis Angkutan</td>
                             <td>:</td>
                             <td>{{ $row->JjenisAngkutan->nm_jenis_angkutan }}</td>
                         </tr>
                         <tr>
                             <td>Mengangkut</td>
                             <td>:</td>
                             <td>{{ $row->jmengangkut->nm_mengangkut }}</td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                 <hr>
                             </td>
                         </tr>
                         <tr>
                             <td>Merek / Type kendaraan</td>
                             <td>:</td>
                             <td>{{ $row->JkendaraanMerek->nm_merek_kendaraan . ' / ' . $row->JkendaraanType->nm_type_kendaraan }}
                             </td>
                         </tr>
                         <tr>
                             <td>Nama kendaraan</td>
                             <td>:</td>
                             <td>{{ $row->nm_kendaraan }}</td>
                         </tr>
                         <tr>
                             <td>Plat No. Kendaraan</td>
                             <td>:</td>
                             <td>{{ $row->plat_no_kendaraan }}</td>
                         </tr>
                         <tr>
                             <td>Daya Angkut Orang</td>
                             <td>:</td>
                             <td>{{ format_rupiah($row->daya_angkut_orang) }} Org</td>
                         </tr>
                         <tr>
                             <td>Daya Angkut Barang</td>
                             <td>:</td>
                             <td>{{ format_rupiah($row->daya_angkut_barang) }} Kg</td>
                         </tr>
                         <tr>
                             <td>Tahun Pembuatan</td>
                             <td>:</td>
                             <td>{{ $row->thn_pembuatan }}</td>
                         </tr>
                         <tr>
                             <td>Nomor Rangka</td>
                             <td>:</td>
                             <td>
                                 {{ $row->no_rangka ? Str::mask($row->no_rangka, '*', 4, -4) : '-' }}
                             </td>
                         </tr>
                         <tr>
                             <td>Nomor Mesin</td>
                             <td>:</td>
                             <td>
                                 {{ $row->no_mesin ? Str::mask($row->no_mesin, '*', 4, -4) : '-' }}
                             </td>
                         </tr>
                         <tr>
                             <td colspan="3" class="bg-primary text-white fw-bold">
                                 <i class="fa fa-edit"></i>
                                 KARTU PENGAWAS
                             </td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top;">Nomor Kartu Pengawas</td>
                             <td width="1%" style="vertical-align: top;">:</td>
                             <td style="vertical-align: top;">{{ $row->JPermohonanValidasi->no_kartu_pengawas ?? '-' }}
                             </td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top;">Tanggal SK</td>
                             <td width="1%" style="vertical-align: top;">:</td>
                             <td>{{ isset($row->JPermohonanValidasi->tgl_sk) ? cek_ddmmyy_v1($row->JPermohonanValidasi->tgl_sk) : '-' }}
                             </td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top;">Nomor SK</td>
                             <td width="1%" style="vertical-align: top;">:</td>
                             <td style="vertical-align: top;">{{ $row->JPermohonanValidasi->no_sk ?? '' }}</td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top;">Tanggal Awal</td>
                             <td style="vertical-align: top;">:</td>
                             <td>{{ isset($row->JPermohonanValidasi->tgl_awal) ? cek_ddmmyy_v1($row->JPermohonanValidasi->tgl_awal) : '-' }}
                             </td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top;">Tanggal Akhir</td>
                             <td style="vertical-align: top;">:</td>
                             <td>{{ isset($row->JPermohonanValidasi->tgl_akhir) ? cek_ddmmyy_v1($row->JPermohonanValidasi->tgl_akhir) : '-' }}
                             </td>
                         </tr>
                         @php
                             use Carbon\Carbon;
                         @endphp



                         <tr>
                             <td style="vertical-align: top;">Status</td>
                             <td style="vertical-align: top;">:</td>
                             <td>
                                 @if (!empty($row->JPermohonanValidasi->tgl_akhir))
                                     @php
                                         $tglAkhir = Carbon::parse($row->JPermohonanValidasi->tgl_akhir);
                                     @endphp

                                     @if ($tglAkhir->isPast())
                                         <span style="color: red; font-weight: bold;">
                                             Masa KIR Habis, hubungi admin
                                         </span>
                                     @else
                                         <span style="color: green;">
                                             Masih Berlaku
                                         </span>
                                     @endif
                                 @else
                                     -
                                 @endif
                             </td>
                         </tr>
                         {{--  <tr>
                             <td style="vertical-align: top;">Status Kartu Pegawas</td>
                             <td style="vertical-align: top;">:</td>
                             <td>
                                 @php
                                     $now = \Carbon\Carbon::now();
                                     $isExpired = \Carbon\Carbon::parse($row->JPermohonanValidasi->tgl_akhir)->lt($now);
                                 @endphp

                                 @if (isset($row->JPermohonanValidasi->tgl_akhir))
                                     {!! $isExpired
                                         ? '<span class="badge rounded-pill bg-danger">Expired</span>'
                                         : '<span class="badge rounded-pill bg-success">Aktif</span>' !!}
                                 @else
                                     -
                                 @endif
                             </td>
                         </tr>  --}}
                         <td colspan="3" class="bg-primary text-white fw-bold">
                             <i class="fa fa-edit"></i>
                             KIR
                         </td>

                         <tr>
                             <td style="vertical-align: top;">Tanggal Awal</td>
                             <td style="vertical-align: top;">:</td>
                             <td>{{ isset($row->JPermohonanValidasi->tgl_kir_awal) ? cek_ddmmyy_v1($row->JPermohonanValidasi->tgl_kir_awal) : '-' }}
                             </td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top;">Tanggal Akhir</td>
                             <td style="vertical-align: top;">:</td>
                             <td>{{ isset($row->JPermohonanValidasi->tgl_kir_akhir) ? cek_ddmmyy_v1($row->JPermohonanValidasi->tgl_kir_akhir) : '-' }}
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </div>

             @php
                 $id = Hashids::encode($row->id_permohonan_izin);
             @endphp
             <div class="modal-footer">
                 {{--  <a href="{{ route('kartucek.QRcode', $id) }}" class="btn btn-warning" target="_blank"><i
                         class="fa fa-print"></i>  --}}
                 </a>
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
             </div>
         </div>
     </div>
 </div>

 <script>
     $('#getModalForm').on('hidden.bs.modal', function() {
         $('body').css('padding-right', '0');
     });
 </script>
