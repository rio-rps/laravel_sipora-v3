 <div class="modal fade" id="getModalForm" tabindex="-1" aria-labelledby="myModalLabel5" aria-hidden="true">

     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">

             {{-- HEADER --}}
             <div class="modal-header">
                 <h5 class="modal-title" id="myModalLabel5">
                     <b>{{ $title_form }}</b>
                 </h5>

                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>

             {{-- BODY --}}
             <div class="modal-body">

                 <div class="table-responsive">
                     <table class="table table-striped table-bordered table-sm mb-0" style="font-size:11px;">

                         <tbody>

                             {{-- =====================================================
                                INFORMASI PERMOHONAN
                            ====================================================== --}}
                             <tr>
                                 <td colspan="3" class="bg-primary text-white fw-bold">
                                     <i class="fa fa-info-circle"></i>
                                     INFORMASI PROSES
                                 </td>
                             </tr>

                             <tr>
                                 <td width="32%">Tanggal Kirim Permohonan</td>
                                 <td width="2%">:</td>
                                 <td>
                                     {{ $row->tgl_kirim_permohonan ? cek_date_ddmmyyyy_his_v1($row->tgl_kirim_permohonan) : '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Tanggal Proses</td>
                                 <td>:</td>
                                 <td>
                                     {{ isset($row->JPermohonanValidasi->tgl_validasi_proses)
                                         ? cek_date_ddmmyyyy_his_v1($row->JPermohonanValidasi->tgl_validasi_proses)
                                         : '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Tanggal Disetujui</td>
                                 <td>:</td>
                                 <td>
                                     {{ isset($row->JPermohonanValidasi->tgl_validasi_selesai)
                                         ? cek_ddmmyy_v1($row->JPermohonanValidasi->tgl_validasi_selesai)
                                         : '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>PIC Validasi Data</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->nm_kabkota ?? '-' }}
                                 </td>
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


                             {{-- =====================================================
                                BADAN USAHA / PEMOHON
                            ====================================================== --}}
                             <tr>
                                 <td colspan="3" class="bg-primary text-white fw-bold">
                                     <i class="fa fa-building-o"></i>
                                     BADAN USAHA
                                 </td>
                             </tr>

                             <tr>
                                 <td>Badan Usaha</td>
                                 <td>:</td>
                                 <td>
                                     {{ optional($row->BadanUsaha)->nm_badan_usaha ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Nama Perusahaan / Personal</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->nm_perusahaan_personal ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Nama Pimpinan / Pemilik</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->nm_pimpinan_pemilik ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Alamat</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->alamat_biodata ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Email</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->email ? preg_replace('/(?<=.{2}).(?=[^@]*?@)/', '*', $row->email) : '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>No. HP</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->no_telp ? preg_replace('/\d(?=\d{3})/', '*', $row->no_telp) : '-' }}
                                 </td>
                             </tr>


                             {{-- =====================================================
                                JENIS PERMOHONAN
                            ====================================================== --}}
                             <tr>
                                 <td colspan="3" class="bg-primary text-white fw-bold">
                                     <i class="fa fa-file-text-o"></i>
                                     JENIS PERMOHONAN
                                 </td>
                             </tr>

                             <tr>
                                 <td>Jenis Permohonan</td>
                                 <td>:</td>
                                 <td>
                                     {{ optional($row->JjenisPermohonan)->nm_jenis_permohonan ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Permohonan</td>
                                 <td>:</td>
                                 <td>
                                     {{ optional($row->JPermohonan)->nm_par_permohonan ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Trayek</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->id_trayek == 0 ? '-' : optional($row->Jtrayek)->nm_trayek ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Jenis Angkutan</td>
                                 <td>:</td>
                                 <td>
                                     {{ optional($row->JjenisAngkutan)->nm_jenis_angkutan ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Mengangkut</td>
                                 <td>:</td>
                                 <td>
                                     {{ optional($row->jmengangkut)->nm_mengangkut ?? '-' }}
                                 </td>
                             </tr>


                             {{-- =====================================================
                                DATA KENDARAAN
                            ====================================================== --}}
                             <tr>
                                 <td colspan="3" class="bg-primary text-white fw-bold">
                                     <i class="fa fa-car"></i>
                                     DATA KENDARAAN
                                 </td>
                             </tr>

                             <tr>
                                 <td>Merek / Type Kendaraan</td>
                                 <td>:</td>
                                 <td>
                                     {{ optional($row->JkendaraanMerek)->nm_merek_kendaraan ?? '-' }}
                                     /
                                     {{ optional($row->JkendaraanType)->nm_type_kendaraan ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Nama Kendaraan</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->nm_kendaraan ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Plat No. Kendaraan</td>
                                 <td>:</td>
                                 <td>
                                     <strong>
                                         {{ $row->plat_no_kendaraan ?? '-' }}
                                     </strong>
                                 </td>
                             </tr>

                             <tr>
                                 <td>Daya Angkut Orang</td>
                                 <td>:</td>
                                 <td>
                                     {{ format_rupiah($row->daya_angkut_orang ?? 0) }} Org
                                 </td>
                             </tr>

                             <tr>
                                 <td>Daya Angkut Barang</td>
                                 <td>:</td>
                                 <td>
                                     {{ format_rupiah($row->daya_angkut_barang ?? 0) }} Kg
                                 </td>
                             </tr>

                             <tr>
                                 <td>Tahun Pembuatan</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->thn_pembuatan ?? '-' }}
                                 </td>
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


                             {{-- =====================================================
                                DOKUMEN JUAL BELI
                            ====================================================== --}}
                             <tr>
                                 <td colspan="3" class="bg-primary text-white fw-bold">
                                     <i class="fa fa-file-text"></i>
                                     DOKUMEN JUAL BELI
                                 </td>
                             </tr>

                             <tr>
                                 <td>Nomor Faktur Jual Beli</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->nmr_faktur_jual_beli ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Tanggal Faktur</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->tgl_faktur_jual_beli ? cek_ddmmyy_v1($row->tgl_faktur_jual_beli) : '-' }}
                                 </td>
                             </tr>




                             {{-- =====================================================
                                KARTU PENGAWAS
                            ====================================================== --}}
                             <tr>
                                 <td colspan="3" class="bg-primary text-white fw-bold">
                                     <i class="fa fa-id-card"></i>
                                     KARTU PENGAWAS
                                 </td>
                             </tr>

                             <tr>
                                 <td>Nomor Kartu Pengawas</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->JPermohonanValidasi->no_kartu_pengawas ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Tanggal SK</td>
                                 <td>:</td>
                                 <td>
                                     {{ isset($row->JPermohonanValidasi->tgl_sk) ? cek_ddmmyy_v1($row->JPermohonanValidasi->tgl_sk) : '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Nomor SK</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->JPermohonanValidasi->no_sk ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Tanggal Awal</td>
                                 <td>:</td>
                                 <td>
                                     {{ isset($row->JPermohonanValidasi->tgl_awal) ? cek_ddmmyy_v1($row->JPermohonanValidasi->tgl_awal) : '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Masa Berlaku s/d</td>
                                 <td>:</td>
                                 <td>
                                     {{ isset($row->JPermohonanValidasi->tgl_akhir) ? cek_ddmmyy_v1($row->JPermohonanValidasi->tgl_akhir) : '-' }}
                                 </td>
                             </tr>
                             <tr>
                                 <td>Status Kartu Pengawas</td>
                                 <td>:</td>
                                 <td>
                                     @if (!empty($row->JPermohonanValidasi->tgl_akhir))

                                         @php
                                             $tglAkhirPngws = \Carbon\Carbon::parse(
                                                 $row->JPermohonanValidasi->tgl_akhir,
                                             );
                                         @endphp

                                         @if ($tglAkhirPngws->lt(\Carbon\Carbon::today()))
                                             <span class="badge bg-danger">
                                                 Masa Berlaku Habis
                                             </span>
                                         @else
                                             <span class="badge bg-success">
                                                 Masih Berlaku
                                             </span>
                                         @endif
                                     @else
                                         -
                                     @endif
                                 </td>
                             </tr>
                             {{-- =====================================================
                               INFORMASI TAMBAHAN DATA KENDARAAN
                            ====================================================== --}}
                             <tr>
                                 <td colspan="3" class="bg-primary text-white fw-bold">
                                     <i class="fa fa-certificate"></i>
                                     INFORMASI TAMBAHAN DATA KENDARAAN
                                 </td>
                             </tr>

                             <tr>
                                 <td>Nomor Uji</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->nomor_uji ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Kombinasi yang Diperoleh</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->kombinasi_yg_diperoleh ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>SK Register Uji</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->sk_reg_uji_type ?? '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Keterangan Lain</td>
                                 <td>:</td>
                                 <td>
                                     {{ $row->ket_lain ?? '-' }}
                                 </td>
                             </tr>


                             {{-- =====================================================
                                KIR
                            ====================================================== --}}
                             <tr>
                                 <td colspan="3" class="bg-primary text-white fw-bold">
                                     <i class="fa fa-check-square-o"></i>
                                     UJI KENDARAAN BERMOTOR (KIR)
                                 </td>
                             </tr>

                             <tr>
                                 <td>Tanggal Awal</td>
                                 <td>:</td>
                                 <td>
                                     {{ isset($row->tgl_kir_awal) ? cek_ddmmyy_v1($row->tgl_kir_awal) : '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Masa Berlaku s/d</td>
                                 <td>:</td>
                                 <td>
                                     {{ isset($row->tgl_kir_akhir) ? cek_ddmmyy_v1($row->tgl_kir_akhir) : '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Status KIR</td>
                                 <td>:</td>
                                 <td>
                                     @if (!empty($row->tgl_kir_akhir))

                                         @php
                                             $tglAkhirKir = \Carbon\Carbon::parse($row->tgl_kir_akhir);
                                         @endphp

                                         @if ($tglAkhirKir->lt(\Carbon\Carbon::today()))
                                             <span class="badge bg-danger">
                                                 Masa Berlaku Habis
                                             </span>
                                         @else
                                             <span class="badge bg-success">
                                                 Masih Berlaku
                                             </span>
                                         @endif
                                     @else
                                         -
                                     @endif
                                 </td>
                             </tr>


                             {{-- =====================================================
                                PKB
                            ====================================================== --}}
                             <tr>
                                 <td colspan="3" class="bg-primary text-white fw-bold">
                                     <i class="fa fa-money"></i>
                                     PAJAK KENDARAAN BERMOTOR (PKB)
                                 </td>
                             </tr>

                             <tr>
                                 <td>Tanggal Awal</td>
                                 <td>:</td>
                                 <td>
                                     {{ isset($row->tgl_pkb_awal) ? cek_ddmmyy_v1($row->tgl_pkb_awal) : '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Masa Berlaku s/d</td>
                                 <td>:</td>
                                 <td>
                                     {{ isset($row->tgl_pkb_akhir) ? cek_ddmmyy_v1($row->tgl_pkb_akhir) : '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Status PKB</td>
                                 <td>:</td>
                                 <td>
                                     @if (!empty($row->tgl_pkb_akhir))

                                         @php
                                             $tglAkhirPkb = \Carbon\Carbon::parse($row->tgl_pkb_akhir);
                                         @endphp

                                         @if ($tglAkhirPkb->lt(\Carbon\Carbon::today()))
                                             <span class="badge bg-danger">
                                                 Masa Berlaku Habis
                                             </span>
                                         @else
                                             <span class="badge bg-success">
                                                 Masih Berlaku
                                             </span>
                                         @endif
                                     @else
                                         -
                                     @endif
                                 </td>
                             </tr>


                             {{-- =====================================================
                                IWKBU
                            ====================================================== --}}
                             <tr>
                                 <td colspan="3" class="bg-primary text-white fw-bold">
                                     <i class="fa fa-credit-card"></i>
                                     IURAN WAJIB KENDARAAN BERMOTOR (IWKBU)
                                 </td>
                             </tr>

                             <tr>
                                 <td>Tanggal Awal</td>
                                 <td>:</td>
                                 <td>
                                     {{ isset($row->tgl_iwkbu_awal) ? cek_ddmmyy_v1($row->tgl_iwkbu_awal) : '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Masa Berlaku s/d</td>
                                 <td>:</td>
                                 <td>
                                     {{ isset($row->tgl_iwkbu_akhir) ? cek_ddmmyy_v1($row->tgl_iwkbu_akhir) : '-' }}
                                 </td>
                             </tr>

                             <tr>
                                 <td>Status IWKBU</td>
                                 <td>:</td>
                                 <td>
                                     @if (!empty($row->tgl_iwkbu_akhir))

                                         @php
                                             $tglAkhirIwkbu = \Carbon\Carbon::parse($row->tgl_iwkbu_akhir);
                                         @endphp

                                         @if ($tglAkhirIwkbu->lt(\Carbon\Carbon::today()))
                                             <span class="badge bg-danger">
                                                 Masa Berlaku Habis
                                             </span>
                                         @else
                                             <span class="badge bg-success">
                                                 Masih Berlaku
                                             </span>
                                         @endif
                                     @else
                                         -
                                     @endif
                                 </td>
                             </tr>

                         </tbody>
                     </table>
                 </div>

             </div>

             {{-- FOOTER --}}
             @php
                 $id = Hashids::encode($row->id_permohonan_izin);
             @endphp

             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                     TUTUP
                 </button>
             </div>

         </div>
     </div>
 </div>

 <script>
     $('#getModalForm').on('hidden.bs.modal', function() {
         $('body').css('padding-right', '0');
     });
 </script>
