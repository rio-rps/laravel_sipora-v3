 <style>
     .font-custom {
         font-size: 12px;
     }

     .table-custom {
         width: 100%;
         border-collapse: collapse;
         /* Menyatukan border antar sel */

         background-color: #ffffff;
         border: 1px solid #000;
         /* Border luar tabel */
     }

     .table-custom thead {
         background-color: #f2f2f2;
         color: #333;
         text-align: center;
     }

     .table-custom th,
     .table-custom td {
         border: 1px solid #000;
         /* Border antar sel */
         padding: 2px;
         /* Opsional, agar teks tidak terlalu mepet */
     }

     .single-line {
         white-space: nowrap;
         overflow: hidden;
         text-overflow: ellipsis;
         max-width: 150px;
     }

     .bg-ccolor {
         background-color: #dedbdb;
     }
 </style>
 <style>
     .dropdown-menu-left {
         right: 0 !important;
         left: auto !important;
     }
 </style>
 <div class="table-responsive">
     <table class="table-custom font-custom " style="width:100%; font-size:8px;">
         <thead>
             <tr>
                 <th width="1%">NO</th>
                 <th>TANGGAL VALIDASI</th>
                 <th>NOMOR KARTU PENGAWAS</th>
                 <th>Nomor SK<br>Tanggal SK</th>
                 <th><span class="single-line">Tgl Mulai SK</span><br><span class="single-line">Tgl Akhir SK</span></th>
                 <th><span class="single-line">Tgl KIR Awal</span><br><span class="single-line">Tgl KIR Akhir</span></th>
                 <th><span class="single-line">Tgl PKB Awal</span><br><span class="single-line">Tgl PKB Akhir</span></th>
                 <th><span class="single-line">Tgl IWKBU Awal</span><br><span class="single-line">Tgl IWKBU Akhir</span>
                 </th>
                 <th>PERUSAHAAN</th>
                 <th>PIMPINAN</th>
                 <th>NAMA KENDARAAN</th>
                 <th>JENIS PERMOHONAN</th>
                 <th>JENIS ANGKUTAN</th>
                 <th>TRAYEK</th>
                 <th>MENGANGKUT</th>
                 <th>NO PLAT</th>
                 <th>NO RANGKA</th>
                 <th>NO MESIN</th>
                 <th>KABKOTA</th>
                 <th width="1%" align="center">AKSI</th>
             </tr>
         </thead>
         <tbody>
             @foreach ($resultPermohonan as $resultPermohonanAll)
                 <tr>
                     <td class="text-center" align="center">{{ $loop->iteration }}</td>
                     <td class="single-line">
                         {{ $resultPermohonanAll->tgl_validasi_selesai ? cek_date_ddmmyyyy_his_v2($resultPermohonanAll->tgl_validasi_selesai) : '-' }}
                     </td>
                     <td>
                         {{ $resultPermohonanAll->no_kartu_pengawas }}
                     </td>
                     <td>
                         {{ $resultPermohonanAll->no_sk }}<br>
                         {{ cek_ddmmyy_v1($resultPermohonanAll->tgl_sk) }}
                     </td>
                     <td>
                         {{ $resultPermohonanAll->tgl_awal ? cek_ddmmyy_v1($resultPermohonanAll->tgl_awal) : '-' }}
                         <br>
                         {{ $resultPermohonanAll->tgl_akhir ? cek_ddmmyy_v1($resultPermohonanAll->tgl_akhir) : '-' }}
                     </td>
                     <td>
                         {{ $resultPermohonanAll->tgl_kir_awal ? cek_ddmmyy_v1($resultPermohonanAll->tgl_kir_awal) : '-' }}
                         <br>
                         {{ $resultPermohonanAll->tgl_kir_akhir ? cek_ddmmyy_v1($resultPermohonanAll->tgl_kir_akhir) : '-' }}
                     </td>
                     <td>
                         {{ $resultPermohonanAll->tgl_pkb_awal ? cek_ddmmyy_v1($resultPermohonanAll->tgl_pkb_awal) : '-' }}
                         <br>
                         {{ $resultPermohonanAll->tgl_pkb_akhir ? cek_ddmmyy_v1($resultPermohonanAll->tgl_pkb_akhir) : '-' }}
                     </td>
                     <td>
                         {{ $resultPermohonanAll->tgl_iwkbu_awal ? cek_ddmmyy_v1($resultPermohonanAll->tgl_iwkbu_awal) : '-' }}
                         <br>
                         {{ $resultPermohonanAll->tgl_iwkbu_akhir ? cek_ddmmyy_v1($resultPermohonanAll->tgl_iwkbu_akhir) : '-' }}
                     </td>
                     <td>
                         {{ $resultPermohonanAll->nm_perusahaan_personal }}
                         ({{ $resultPermohonanAll->nm_badan_usaha }})
                     </td>
                     <td>{{ $resultPermohonanAll->nm_pimpinan_pemilik }}</td>
                     <td>
                         {{ $resultPermohonanAll->JkendaraanMerek->nm_merek_kendaraan . ' / ' . $resultPermohonanAll->JkendaraanType->nm_type_kendaraan . ' / ' . $resultPermohonanAll->nm_kendaraan . ' (' . $resultPermohonanAll->thn_pembuatan . ') ' }}
                     </td>
                     <td>
                         {{ $resultPermohonanAll->JjenisPermohonan->nm_jenis_permohonan }}/
                         {{ $resultPermohonanAll->JPermohonan->nm_par_permohonan }}
                     </td>
                     <td align="center"> {{ $resultPermohonanAll->JjenisAngkutan->nm_jenis_angkutan }}</td>
                     <td>
                         @php
                             if ($resultPermohonanAll->id_trayek == 0) {
                                 $trayek = '-';
                             } else {
                                 $trayek = $resultPermohonanAll->Jtrayek->nm_trayek;
                             }
                             echo $trayek;
                         @endphp
                     </td>
                     <td align="center">{{ $resultPermohonanAll->jmengangkut->nm_mengangkut }}</td>
                     <td class="single-line">{{ $resultPermohonanAll->plat_no_kendaraan }}</td>
                     <td>{{ $resultPermohonanAll->no_rangka }}</td>
                     <td>{{ $resultPermohonanAll->no_mesin }}</td>
                     <td>{{ $resultPermohonanAll->nm_kabkota }}</td>
                     <td>
                         <center>
                             <div class="btn-icon-list btn-list">

                                 <div class="form-group">
                                     <div class="btn-group" role="group"
                                         aria-label="Button group with nested dropdown">
                                         <div class="btn-group" role="group">
                                             <button id="btnGroupDrop2" type="button"
                                                 class="btn btn-sm btn-outline-info dropdown-toggle"
                                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                             </button>
                                             <div class="dropdown-menu" aria-labelledby="btnGroupDrop2"
                                                 x-placement="bottom-start" style="font-size:8px;">
                                                 <a class="dropdown-item" title="Dokumen Upload" id="tombolModalForm"
                                                     data-url="{{ route('datapermohonan.dokumenUpload', $resultPermohonanAll->id_permohonan_izin) }}"><i
                                                         class="fa fa-desktop"></i> Dokumen Upload</a>

                                                 <a class="dropdown-item" title="Lihit Detail Data"
                                                     href="{{ route('datapermohonan.kartuInput', Crypt::encrypt($resultPermohonanAll->id_permohonan_izin)) }}"><i
                                                         class="fa fa-desktop"></i> Lihat Detail Data</a>

                                                 <a class="dropdown-item" title="Lihat Permohonan" id="tombolModalForm"
                                                     data-url="{{ route('datapermohonan.detailView', $resultPermohonanAll->id_permohonan_izin) }}"><i
                                                         class="fa fa-eye"></i> Lihat Kartu Pengawas</a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </center>

                     </td>
                 </tr>
             @endforeach
         </tbody>
     </table>
 </div>
