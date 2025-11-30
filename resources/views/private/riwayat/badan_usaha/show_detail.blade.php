<style>
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
</style>
<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h4 class="modal-title" id="myModalLabel5"><b><i class="fa fa-file"></i> {{ $title }}</b></h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-responsive">
                        <tbody>
                            <tr>
                                <td width="30%"><i class="fa fa-building text-primary"></i> <strong>Badan
                                        Usaha</strong></td>
                                <td width="1%">:</td>
                                <td>{{ $row->BadanUsaha->nm_badan_usaha }}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-address-card text-success"></i> <strong>Nama Perusahaan /
                                        Personal</strong></td>
                                <td>:</td>
                                <td>{{ $row->nm_perusahaan_personal }}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-user text-info"></i> <strong>Nama Pimpinan / Pemilik</strong></td>
                                <td>:</td>
                                <td>{{ $row->nm_pimpinan_pemilik }}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-envelope text-warning"></i> <strong>Email</strong></td>
                                <td>:</td>
                                <td>{{ $row->email }}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-phone text-danger"></i> <strong>No HP</strong></td>
                                <td>:</td>
                                <td>{{ $row->no_telp }}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-map-marker text-secondary"></i> <strong>Alamat</strong></td>
                                <td>:</td>
                                <td>{{ $row->alamat_biodata }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card border-secondary">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">DAFTAR LIST KENDARAAN </h5>
                        <p class="card-text">

                        <div class="table-responsive">
                            <table class="table-custom font-custom " style="width:100%; font-size:8px;">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th><i class="fa fa-hashtag"></i> No</th>
                                        <th><i class="fa fa-industry"></i> Merek / Tipe</th>
                                        <th><i class="fa fa-car"></i> Nama Kendaraan</th>
                                        <th><i class="fa fa-id-card"></i> Plat Nomor kendaraan</th>
                                        <th><i class="fa fa-cogs"></i> Nomor Rangka</th>
                                        <th><i class="fa fa-cog"></i> Nomor Mesin</th>
                                        <th><i class="fa fa-users"></i> Daya Angkut Orang</th>
                                        <th><i class="fa fa-th"></i> Daya Angkut Barang</th>
                                        <th><i class="fa fa-calendar"></i> Tahun Pembuatan</th>
                                        <th><i class="fa fa-toggle-on"></i> Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resultKendaraan as $kendaraan)
                                        <tr>
                                            <td class="text-center" align="center">{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $kendaraan->JkendaraanMerek->nm_merek_kendaraan . ' / ' . $kendaraan->JkendaraanType->nm_type_kendaraan }}
                                            </td>
                                            <td>
                                                {{ $kendaraan->nm_kendaraan }}
                                            </td>
                                            <td class="single-line" align="center">
                                                {{ $kendaraan->plat_no_kendaraan }}
                                            </td>
                                            <td align="center">
                                                <div class="single-line">{{ $kendaraan->no_rangka }}
                                                </div>
                                            </td>
                                            <td align="center">
                                                <div class="single-line">{{ $kendaraan->no_mesin }}</div>
                                            </td>
                                            <td align="center">
                                                {{ format_rupiah($kendaraan->daya_angkut_orang) }} Org
                                            </td>
                                            <td align="center">
                                                {{ format_rupiah($kendaraan->daya_angkut_barang) }} Kg
                                            </td>
                                            <td align="center">
                                                {{ $kendaraan->thn_pembuatan }}
                                            </td>
                                            <td align="center">
                                                {{ status_actived($kendaraan->status_actived) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            </p>
                        </div>
                    </div>
                </div>

                <!--  MASUK  -->
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Riwayat Pengajuan Permohonan (Masuk)</h5>
                        <p class="card-text">
                        <div class="table-responsive">
                            <table class="table-custom font-custom " style="width:100%; font-size:8px;">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th align="center" width="4%" class="single-line ">Tgl Permohonan</th>
                                        <th>Nama Kendaraan </th>
                                        <th>No Rangka<br>No Mesin </th>
                                        <th class="single-line">Jenis Permohonan </th>
                                        <th>Permohonan </th>
                                        <th class="single-line">Jenis Angkutan </th>
                                        <th>Trayek</th>
                                        <th width="4%">Mengangkut</th>
                                        <th width="4%">
                                            <span class="single-line">Daya Angkut Org</span><br>
                                            Daya Angkut Brg
                                        </th>
                                        <th width="4%">No Plat</th>
                                        <th>KabKota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resultPermohonanMasuk as $resultPermohonanAll)
                                        <tr>
                                            <td class="text-center" align="center">{{ $loop->iteration }}</td>
                                            <td align="center">
                                                {{ cek_date_ddmmyyyy_his_v1($resultPermohonanAll->tgl_kirim_permohonan) }}
                                            </td>

                                            <td>{{ $resultPermohonanAll->JkendaraanMerek->nm_merek_kendaraan . ' / ' . $resultPermohonanAll->JkendaraanType->nm_type_kendaraan . ' / ' . $resultPermohonanAll->nm_kendaraan . ' (' . $resultPermohonanAll->thn_pembuatan . ') ' }}
                                            </td>
                                            <td>
                                                <div class="single-line">{{ $resultPermohonanAll->no_rangka }}
                                                </div>
                                                <div class="single-line">{{ $resultPermohonanAll->no_mesin }}</div>
                                            </td>
                                            <td>{{ $resultPermohonanAll->JjenisPermohonan->nm_jenis_permohonan }}
                                            </td>
                                            <td>{{ $resultPermohonanAll->JPermohonan->nm_par_permohonan }}</td>
                                            <td>{{ $resultPermohonanAll->JjenisAngkutan->nm_jenis_angkutan }}</td>
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
                                            <td align="center">
                                                {{ $resultPermohonanAll->jmengangkut->nm_mengangkut }}
                                            </td>
                                            <td align="center">
                                                {{ format_rupiah($resultPermohonanAll->daya_angkut_orang) }}
                                                Org<br>
                                                {{ format_rupiah($resultPermohonanAll->daya_angkut_barang) }} Kg

                                            </td>
                                            <td class="single-line">{{ $resultPermohonanAll->plat_no_kendaraan }}
                                            </td>
                                            <td>{{ $resultPermohonanAll->nm_kabkota }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </p>
                    </div>
                </div>

                <!--  PROSES  -->
                <div class="card border-warning">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Riwayat Pengajuan Permohonan (Proses)</h5>
                        <p class="card-text">
                        <div class="table-responsive">
                            <table class="table-custom font-custom " style="width:100%; font-size:8px;">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th align="center" width="4%" class="single-line ">Tgl Permohonan</th>
                                        <th align="center" width="4%" class="single-line ">Tgl Proses</th>
                                        <th>Nama Kendaraan </th>
                                        <th>No Rangka<br>No Mesin </th>
                                        <th class="single-line">Jenis Permohonan </th>
                                        <th>Permohonan </th>
                                        <th class="single-line">Jenis Angkutan </th>
                                        <th>Trayek</th>
                                        <th width="4%">Mengangkut</th>
                                        <th width="4%">
                                            <span class="single-line">Daya Angkut Org</span><br>
                                            Daya Angkut Brg
                                        </th>
                                        <th width="4%">No Plat</th>
                                        <th>KabKota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resultPermohonanProses as $resultPermohonanAll)
                                        <tr>
                                            <td class="text-center" align="center">{{ $loop->iteration }}</td>
                                            <td align="center">
                                                {{ cek_date_ddmmyyyy_his_v1($resultPermohonanAll->tgl_kirim_permohonan) }}
                                            </td>
                                            <td align="center">
                                                {{ cek_date_ddmmyyyy_his_v1($resultPermohonanAll->tgl_validasi_proses) }}
                                            </td>
                                            <td>{{ $resultPermohonanAll->JkendaraanMerek->nm_merek_kendaraan . ' / ' . $resultPermohonanAll->JkendaraanType->nm_type_kendaraan . ' / ' . $resultPermohonanAll->nm_kendaraan . ' (' . $resultPermohonanAll->thn_pembuatan . ') ' }}
                                            </td>
                                            <td>
                                                <div class="single-line">{{ $resultPermohonanAll->no_rangka }}
                                                </div>
                                                <div class="single-line">{{ $resultPermohonanAll->no_mesin }}</div>
                                            </td>
                                            <td>{{ $resultPermohonanAll->JjenisPermohonan->nm_jenis_permohonan }}
                                            </td>
                                            <td>{{ $resultPermohonanAll->JPermohonan->nm_par_permohonan }}</td>
                                            <td>{{ $resultPermohonanAll->JjenisAngkutan->nm_jenis_angkutan }}</td>
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
                                            <td align="center">
                                                {{ $resultPermohonanAll->jmengangkut->nm_mengangkut }}
                                            </td>
                                            <td align="center">
                                                {{ format_rupiah($resultPermohonanAll->daya_angkut_orang) }}
                                                Org<br>
                                                {{ format_rupiah($resultPermohonanAll->daya_angkut_barang) }} Kg

                                            </td>
                                            <td class="single-line">{{ $resultPermohonanAll->plat_no_kendaraan }}
                                            </td>
                                            <td>{{ $resultPermohonanAll->nm_kabkota }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </p>
                    </div>
                </div>

                <!--  SELESAI / FINAL  -->
                <div class="card border-success">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Riwayat Pengajuan Permohonan (Selesai/ Final)</h5>
                        <p class="card-text">
                        <div class="table-responsive">
                            <table class="table-custom font-custom " style="width:100%; font-size:8px;">
                                <thead>
                                    <tr>
                                        <th width="1%">NO</th>
                                        <th>TANGGAL VALIDASI</th>
                                        <th>NOMOR KARTU PENGAWAS</th>
                                        <th>Tanggal SK<br>Nomor SK</th>
                                        <th><span class="single-line">Tgl Mulai SK</span><br><span
                                                class="single-line">Tgl Akhir SK</span>
                                        </th>
                                        <th><span class="single-line">Tgl KIR Awal</span><br><span
                                                class="single-line">Tgl KIR Akhir</span>
                                        </th>
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
                                    @foreach ($resultPermohonanSelesai as $resultPermohonanAll)
                                        <tr>
                                            <td class="text-center" align="center">{{ $loop->iteration }}</td>
                                            <td class="single-line">
                                                {{ $resultPermohonanAll->tgl_validasi_selesai ? cek_date_ddmmyyyy_his_v2($resultPermohonanAll->tgl_validasi_selesai) : '-' }}
                                            </td>
                                            <td>
                                                {{ $resultPermohonanAll->no_kartu_pengawas }}
                                            </td>
                                            <td>
                                                {{ cek_ddmmyy_v1($resultPermohonanAll->tgl_sk) }}<br>
                                                {{ $resultPermohonanAll->no_sk }}
                                            </td>
                                            <td>
                                                {{ $resultPermohonanAll->tgl_awal ? cek_ddmmyy_v1($resultPermohonanAll->tgl_awal) : '-' }}
                                                <br>
                                                {{ $resultPermohonanAll->tgl_akhir ? cek_ddmmyy_v1($resultPermohonanAll->tgl_akhir) : '-' }}
                                            </td>
                                            <td>
                                                {{ $resultPermohonanAll->tgl_kir_awal ? cek_ddmmyy_v1($resultPermohonanAll->tgl_kir_awal) : '-' }}
                                                <br>
                                                {{ $resultPermohonanAll->tgl_Kir_akhir ? cek_ddmmyy_v1($resultPermohonanAll->tgl_Kir_akhir) : '-' }}
                                            </td>
                                            <td>
                                                {{ $resultPermohonanAll->JkendaraanMerek->nm_merek_kendaraan . ' / ' . $resultPermohonanAll->JkendaraanType->nm_type_kendaraan . ' / ' . $resultPermohonanAll->nm_kendaraan . ' (' . $resultPermohonanAll->thn_pembuatan . ') ' }}
                                            </td>
                                            <td>
                                                {{ $resultPermohonanAll->JjenisPermohonan->nm_jenis_permohonan }}/
                                                {{ $resultPermohonanAll->JPermohonan->nm_par_permohonan }}
                                            </td>
                                            <td align="center">
                                                {{ $resultPermohonanAll->JjenisAngkutan->nm_jenis_angkutan }}</td>
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
                                            <td align="center">
                                                {{ $resultPermohonanAll->jmengangkut->nm_mengangkut }}
                                            </td>
                                            <td class="single-line">{{ $resultPermohonanAll->plat_no_kendaraan }}
                                            </td>
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
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">

                                                                    </button>
                                                                    <div class="dropdown-menu"
                                                                        aria-labelledby="btnGroupDrop2"
                                                                        x-placement="bottom-start"
                                                                        style="font-size:8px;">


                                                                        <a class="dropdown-item"
                                                                            title="Lihit Detail Data" target="_blank"
                                                                            href="{{ route('datapermohonan.kartuInput', Crypt::encrypt($resultPermohonanAll->id_permohonan_izin)) }}"><i
                                                                                class="fa fa-desktop"></i> Lihat
                                                                            Detail
                                                                            Data</a>
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
                            </p>
                        </div>
                    </div>
                </div>

                <!--  DITOLAK  -->
                <div class="card border-danger">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Riwayat Pengajuan Permohonan (DITOLAK)</h5>
                        <p class="card-text">
                        <div class="table-responsive">
                            <table class="table-custom font-custom " style="width:100%; font-size:8px;">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th align="center" width="4%" class="single-line ">Tgl Permohonan
                                        </th>
                                        <th align="center" width="4%" class="single-line ">Tgl ditolak</th>
                                        <th>Nama Kendaraan </th>
                                        <th>No Rangka<br>No Mesin </th>
                                        <th class="single-line">Jenis Permohonan </th>
                                        <th>Permohonan </th>
                                        <th class="single-line">Jenis Angkutan </th>
                                        <th>Trayek</th>
                                        <th width="4%">Mengangkut</th>
                                        <th width="4%">
                                            <span class="single-line">Daya Angkut Org</span><br>
                                            Daya Angkut Brg
                                        </th>
                                        <th width="4%">No Plat</th>
                                        <th>KabKota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resultPermohonanTolak as $resultPermohonanAll)
                                        <tr>
                                            <td class="text-center" align="center">{{ $loop->iteration }}</td>
                                            <td align="center">
                                                {{ cek_date_ddmmyyyy_his_v1($resultPermohonanAll->tgl_kirim_permohonan) }}
                                            </td>
                                            <td align="center">
                                                {{ cek_date_ddmmyyyy_his_v1($resultPermohonanAll->histori_created_at) }}
                                            </td>
                                            <td>{{ $resultPermohonanAll->JkendaraanMerek->nm_merek_kendaraan . ' / ' . $resultPermohonanAll->JkendaraanType->nm_type_kendaraan . ' / ' . $resultPermohonanAll->nm_kendaraan . ' (' . $resultPermohonanAll->thn_pembuatan . ') ' }}
                                            </td>
                                            <td>
                                                <div class="single-line">{{ $resultPermohonanAll->no_rangka }}
                                                </div>
                                                <div class="single-line">{{ $resultPermohonanAll->no_mesin }}
                                                </div>
                                            </td>
                                            <td>{{ $resultPermohonanAll->JjenisPermohonan->nm_jenis_permohonan }}
                                            </td>
                                            <td>{{ $resultPermohonanAll->JPermohonan->nm_par_permohonan }}</td>
                                            <td>{{ $resultPermohonanAll->JjenisAngkutan->nm_jenis_angkutan }}</td>
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
                                            <td align="center">
                                                {{ $resultPermohonanAll->jmengangkut->nm_mengangkut }}
                                            </td>
                                            <td align="center">
                                                {{ format_rupiah($resultPermohonanAll->daya_angkut_orang) }}
                                                Org<br>
                                                {{ format_rupiah($resultPermohonanAll->daya_angkut_barang) }} Kg
                                            </td>
                                            <td class="single-line">{{ $resultPermohonanAll->plat_no_kendaraan }}
                                            </td>
                                            <td>{{ $resultPermohonanAll->nm_kabkota }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="14" style="font-style: italic; color: red;">
                                                Keterangan Ditolak: {{ $resultPermohonanAll->keterangan_histori }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        </p>
                    </div>
                </div>
                <!--  //  -->
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>
