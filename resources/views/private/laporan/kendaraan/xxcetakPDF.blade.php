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
<div class="card border-secondary">
    <div class="card-body">
        <h5 class="card-title font-weight-bold">DAFTAR LIST KENDARAAN </h5>
        <p class="card-text">

        <div class="table-responsive">
            <table class="table-custom font-custom " style="width:100%; font-size:8px;">
                <thead class="thead-dark text-center">
                    <tr>
                        <th><i class="fa fa-hashtag"></i> No</th>
                        <th><i class="fa fa-industry"></i> Nama Perusahaan</th>
                        <th><i class="fa fa-industry"></i> Badan Usaha</th>
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
                                {{ $kendaraan->JBiodata->nm_perusahaan_personal }}
                            </td>
                            <td>
                                ({{ $kendaraan->JBiodata->BadanUsaha->nm_badan_usaha }})
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
