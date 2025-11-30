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
<div class="card">
    <div class="card-body">
        <p class="card-text">
            @if ($result->isNotEmpty())
                <div class="alert alert-success" role="alert">
                    Data ditemukan berjumlah {{ count($result) }} Data ({{ cek_status_permohonan($status_permohonan) }})
                </div>

                <div class="table-responsive">
                    <table class="table-custom font-custom " style="width:100%; font-size:8px;">
                        <thead class="thead-dark text-center">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th align="center" width="4%" class="single-line ">Tgl Permohonan</th>
                                    @if ($status_permohonan == 5)
                                        <th class="single-line ">Tgl Validasi</th>
                                        <th>Nomor Kartu Pengawas</th>
                                        <th>Tanggal SK<br>Nomor SK</th>
                                        <th><span class="single-line">Tgl Mulai SK</span><br><span
                                                class="single-line">Tgl Akhir
                                                SK</span>
                                        </th>
                                        <th><span class="single-line">Tgl KIR Awal</span><br><span
                                                class="single-line">Tgl KIR
                                                Akhir</span>
                                        </th>
                                    @endif
                                    <th>Perusahaan</th>
                                    <th>Pimpinan</th>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach ($result as $resultPermohonanAll)
                                <tr>
                                    <td class="text-center" align="center">{{ $loop->iteration }}</td>
                                    <td align="center">
                                        {{ cek_date_ddmmyyyy_his_v2($resultPermohonanAll->tgl_kirim_permohonan) }}
                                    </td>
                                    @if ($status_permohonan == 5)
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
                                    @endif
                                    <td>{{ $resultPermohonanAll->nm_perusahaan_personal }}
                                        ({{ $resultPermohonanAll->nm_badan_usaha }})
                                    </td>
                                    <td>{{ $resultPermohonanAll->nm_pimpinan_pemilik }}</td>
                                    <td>{{ $resultPermohonanAll->JkendaraanMerek->nm_merek_kendaraan . ' / ' . $resultPermohonanAll->JkendaraanType->nm_type_kendaraan . ' / ' . $resultPermohonanAll->nm_kendaraan . ' (' . $resultPermohonanAll->thn_pembuatan . ') ' }}
                                    </td>
                                    <td>
                                        <div class="single-line">{{ $resultPermohonanAll->no_rangka }}</div>
                                        <div class="single-line">{{ $resultPermohonanAll->no_mesin }}</div>
                                    </td>
                                    <td>{{ $resultPermohonanAll->JjenisPermohonan->nm_jenis_permohonan }}</td>
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
                                    <td align="center">{{ $resultPermohonanAll->jmengangkut->nm_mengangkut }}</td>
                                    <td align="center">
                                        {{ format_rupiah($resultPermohonanAll->daya_angkut_orang) }} Org<br>
                                        {{ format_rupiah($resultPermohonanAll->daya_angkut_barang) }} Kg

                                    </td>
                                    <td class="single-line">{{ $resultPermohonanAll->plat_no_kendaraan }}</td>
                                    <td>{{ $resultPermohonanAll->nm_kabkota }}</td>
                                    <td>
                                        <div class="dropdownx">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button class="dropdown-item" type="button" title="Lihat Permohonan"
                                                    id="tombolModalForm"
                                                    data-url="{{ route('datapermohonan.detailView', $resultPermohonanAll->id_permhn) }}">
                                                    <i class="fa fa-eye"></i> Lihat Permohonan
                                                </button>
                                                @if ($resultPermohonanAll->status_permohonan == 5)
                                                    <a class="dropdown-item" title="Lihit Detail Data" target="_blank"
                                                        href="{{ route('datapermohonan.kartuInput', Crypt::encrypt($resultPermohonanAll->id_permohonan_izin)) }}"><i
                                                            class="fa fa-desktop"></i> Lihat Detail Data</a>
                                                @endif
                                                <button class="dropdown-item" type="button" title="Lihat Permohonan"
                                                    id="tombolModalForm"
                                                    data-url="{{ route('mutasiPIC.edit', $resultPermohonanAll->id_permhn) }}">
                                                    <i class="fa fa-edit"></i> Mutasi PIC
                                                </button>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="list-group">
                    <a class="list-group-item flex-column align-items-start">
                        Data Tidak ditemukan ...
                    </a>
                </div>
            @endif

        </p>
    </div>
</div>
