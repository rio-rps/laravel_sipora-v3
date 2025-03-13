 <div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="myModalLabel5"><b>{{ $title_form }}</b></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <table style="vertical-align: top;" class="table-striped table-responsive">

                     <body>
                         <tr>
                             <td>Tanggal Kirim Permohonan</td>
                             <td>:</td>
                             <td>{{ cek_date_ddmmyyyy_his_v1($row->tgl_kirim_permohonan) }}</td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                 <hr>
                             </td>
                         </tr>
                         <tr>
                             <td>Badan Usaha</td>
                             <td width="1%">:</td>
                             <td style="vertical-align: top;">{{ $row->BadanUsaha->nm_badan_usaha }}</td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top;">Nama Perusahaan / Personal</td>
                             <td width="1%" style="vertical-align: top;">:</td>
                             <td style="vertical-align: top;">{{ $row->nm_perusahaan_personal }}</td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top;">Nama Pimpinan / Pemilik</td>
                             <td width="1%" style="vertical-align: top;">:</td>
                             <td style="vertical-align: top;">{{ $row->nm_pimpinan_pemilik }}</td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top;">Alamat</td>
                             <td style="vertical-align: top;">:</td>
                             <td style="vertical-align: top;">{{ $row->alamat_biodata }}</td>
                         </tr>
                         <tr>
                             <td>Email</td>
                             <td>:</td>
                             <td>{{ $row->email }}</td>
                         </tr>
                         <tr>
                             <td>No Hp</td>
                             <td>:</td>
                             <td>{{ $row->no_telp }}</td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                 <hr>
                             </td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top;">Jenis Permohonan</td>
                             <td width="1%" style="vertical-align: top;">:</td>
                             <td>{{ $row->JjenisPermohonan->nm_jenis_permohonan }}</td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top;">Permohonan</td>
                             <td width="1%" style="vertical-align: top;">:</td>
                             <td>{{ $row->JPermohonan->nm_par_permohonan }}</td>
                         </tr>
                         <tr>
                             <td style="vertical-align: top;">Trayek</td>
                             <td width="1%" style="vertical-align: top;">:</td>
                             <td>{{ $row->id_trayek == 0 ? '-' : $row->Jtrayek->nm_trayek }}</td>
                         </tr>
                         <tr>
                             <td>Jenis Angkutan</td>
                             <td width="1%">:</td>
                             <td>{{ $row->JjenisAngkutan->nm_jenis_angkutan }}</td>
                         </tr>
                         <tr>
                             <td>Mengangkut</td>
                             <td width="1%">:</td>
                             <td>{{ $row->jmengangkut->nm_mengangkut }}</td>
                         </tr>
                         <tr>
                             <td colspan="3">
                                 <hr>
                             </td>
                         </tr>
                         <tr>
                             <td>Merek / Type kendaraan</td>
                             <td width="1%">:</td>
                             <td>{{ $row->JkendaraanMerek->nm_merek_kendaraan . ' / ' . $row->JkendaraanType->nm_type_kendaraan }}
                             </td>
                         </tr>
                         <tr>
                             <td>Nama kendaraan</td>
                             <td width="1%">:</td>
                             <td>{{ $row->nm_kendaraan }}</td>
                         </tr>
                         <tr>
                             <td>Plat No. Kendaraan</td>
                             <td width="1%">:</td>
                             <td>{{ $row->plat_no_kendaraan }}</td>
                         </tr>
                         <tr>
                             <td>Daya Angkut Orang</td>
                             <td width="1%">:</td>
                             <td>{{ $row->daya_angkut_orang }}</td>
                         </tr>
                         <tr>
                             <td>Daya Angkut Barang</td>
                             <td width="1%">:</td>
                             <td>{{ $row->daya_angkut_barang }}</td>
                         </tr>
                         <tr>
                             <td>Tahun Pembuatan</td>
                             <td width="1%">:</td>
                             <td>{{ $row->thn_pembuatan }}</td>
                         </tr>
                         <tr>
                             <td>Nomor Rangka</td>
                             <td width="1%">:</td>
                             <td>{{ $row->no_rangka }}</td>
                         </tr>
                         <tr>
                             <td>Nomor Mesin</td>
                             <td width="1%">:</td>
                             <td>{{ $row->no_mesin }}</td>
                         </tr>
                     </body>
                 </table>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>
             </div>
         </div>
     </div>
 </div>
