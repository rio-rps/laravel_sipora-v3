<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="getModalFormLabel">
                    <strong>
                        <i class="fa fa-wpforms"></i>
                        {{ $title_form }}
                    </strong>
                </h5>

                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table table-sm table-striped mb-0">
                        <tbody>

                            {{-- INFORMASI PERMOHONAN --}}
                            <tr class="bg-light">
                                <th colspan="3">
                                    <i class="fa fa-info-circle text-info"></i>
                                    INFORMASI PERMOHONAN
                                </th>
                            </tr>

                            <tr>
                                <td width="35%">Tanggal Kirim Permohonan</td>
                                <td width="2%">:</td>
                                <td>
                                    {{ cek_date_ddmmyyyy_his_v1($row->tgl_kirim_permohonan) }}
                                </td>
                            </tr>

                            <tr>
                                <td>Kirim ke PIC</td>
                                <td>:</td>
                                <td>{{ $kabkota }}</td>
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


                            {{-- BADAN USAHA --}}
                            <tr class="bg-light">
                                <th colspan="3">
                                    <i class="fa fa-building text-info"></i>
                                    DATA BADAN USAHA / PEMOHON
                                </th>
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
                                <td>{{ $row->nm_perusahaan_personal ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td>Nama Pimpinan / Pemilik</td>
                                <td>:</td>
                                <td>{{ $row->nm_pimpinan_pemilik ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $row->alamat_biodata ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $row->email ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td>No. HP</td>
                                <td>:</td>
                                <td>{{ $row->no_telp ?? '-' }}</td>
                            </tr>


                            {{-- DATA KENDARAAN --}}
                            <tr class="bg-light">
                                <th colspan="3">
                                    <i class="fa fa-car text-info"></i>
                                    DATA KENDARAAN
                                </th>
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
                                <td>{{ $row->nm_kendaraan ?? '-' }}</td>
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
                                <td>Nomor Rangka</td>
                                <td>:</td>
                                <td>{{ $row->no_rangka ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td>Nomor Mesin</td>
                                <td>:</td>
                                <td>{{ $row->no_mesin ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td>Warna TNKB</td>
                                <td>:</td>
                                <td>{{ $row->warna_tnkb ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td>Bahan Bakar</td>
                                <td>:</td>
                                <td>{{ $row->bahan_bakar ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td>Daya Angkut Orang</td>
                                <td>:</td>
                                <td>
                                    {{ $row->daya_angkut_orang ?? 0 }} Orang
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
                                <td>{{ $row->thn_pembuatan ?? '-' }}</td>
                            </tr>


                            {{-- DOKUMEN JUAL BELI --}}
                            <tr class="bg-light">
                                <th colspan="3">
                                    <i class="fa fa-file-text-o text-info"></i>
                                    DOKUMEN JUAL BELI
                                </th>
                            </tr>

                            <tr>
                                <td>Nomor Faktur Jual Beli</td>
                                <td>:</td>
                                <td>
                                    {{ $row->nmr_faktur_jual_beli ?: '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td>Tanggal Faktur</td>
                                <td>:</td>
                                <td>
                                    {{ $row->tgl_faktur_jual_beli ? cek_date_ddmmyyyy_his_v2($row->tgl_faktur_jual_beli) : '-' }}
                                </td>
                            </tr>


                            {{-- DATA UJI --}}
                            <tr class="bg-light">
                                <th colspan="3">
                                    <i class="fa fa-check-square-o text-info"></i>
                                    INFORMASI TAMBAHAN DATA KENDARAAN
                                </th>
                            </tr>

                            <tr>
                                <td>Nomor Uji</td>
                                <td>:</td>
                                <td>
                                    {{ $row->nomor_uji ?: '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td>Kombinasi yang Diperoleh</td>
                                <td>:</td>
                                <td>
                                    {{ $row->kombinasi_yg_diperoleh ?: '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td>SK Register Uji</td>
                                <td>:</td>
                                <td>
                                    {{ $row->sk_reg_uji_type ?: '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td>Keterangan Lain</td>
                                <td>:</td>
                                <td>
                                    {{ $row->ket_lain ?: '-' }}
                                </td>
                            </tr>


                            {{-- MASA BERLAKU --}}
                            <tr class="bg-light">
                                <th colspan="3">
                                    <i class="fa fa-calendar text-info"></i>
                                    MASA BERLAKU DOKUMEN
                                </th>
                            </tr>

                            {{-- KIR --}}
                            <tr>
                                <td>KIR</td>
                                <td>:</td>
                                <td>
                                    @if ($row->tgl_kir_awal || $row->tgl_kir_akhir)
                                        {{ $row->tgl_kir_awal ? cek_date_ddmmyyyy_his_v2($row->tgl_kir_awal) : '-' }}

                                        s/d

                                        {{ $row->tgl_kir_akhir ? cek_date_ddmmyyyy_his_v2($row->tgl_kir_akhir) : '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>

                            {{-- PKB --}}
                            <tr>
                                <td>PKB</td>
                                <td>:</td>
                                <td>
                                    @if ($row->tgl_pkb_awal || $row->tgl_pkb_akhir)
                                        {{ $row->tgl_pkb_awal ? cek_date_ddmmyyyy_his_v2($row->tgl_pkb_awal) : '-' }}

                                        s/d

                                        {{ $row->tgl_pkb_akhir ? cek_date_ddmmyyyy_his_v2($row->tgl_pkb_akhir) : '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>

                            {{-- IWKBU --}}
                            <tr>
                                <td>IWKBU</td>
                                <td>:</td>
                                <td>
                                    @if ($row->tgl_iwkbu_awal || $row->tgl_iwkbu_akhir)
                                        {{ $row->tgl_iwkbu_awal ? cek_date_ddmmyyyy_his_v2($row->tgl_iwkbu_awal) : '-' }}

                                        s/d

                                        {{ $row->tgl_iwkbu_akhir ? cek_date_ddmmyyyy_his_v2($row->tgl_iwkbu_akhir) : '-' }}
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
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                    TUTUP
                </button>
            </div>

        </div>
    </div>
</div>
