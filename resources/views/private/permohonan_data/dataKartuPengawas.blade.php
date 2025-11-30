<table style="vertical-align: top;" class="table-striped table-responsive">

    <body>
        <tr>
            <td>Tanggal Proses</td>
            <td width="1%">:</td>
            <td>{{ isset($row->tgl_validasi_proses) ? cek_date_ddmmyyyy_his_v1($row->tgl_validasi_proses) : '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal DIsetujui</td>
            <td>:</td>
            <td>{{ isset($row->tgl_validasi_selesai) ? cek_ddmmyy_v1($row->tgl_validasi_selesai) : '-' }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>{!! status_permohonan($row->status_validasi) !!}</td>
        </tr>
        <tr>
            <td colspan="3">
                <hr>
            </td>
        </tr>
        <tr>
            <td>Nomor Kartu Pengawas</td>
            <td width="1%">:</td>
            <td style="vertical-align: top;">{{ $row->no_kartu_pengawas ?? '-' }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top;">Tanggal SK</td>
            <td width="1%" style="vertical-align: top;">:</td>
            <td>{{ isset($row->tgl_sk) ? cek_ddmmyy_v1($row->tgl_sk) : '-' }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top;">Nomor SK</td>
            <td width="1%" style="vertical-align: top;">:</td>
            <td style="vertical-align: top;">{{ $row->no_sk ?? '' }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top;">Tanggal Awal</td>
            <td style="vertical-align: top;">:</td>
            <td>{{ isset($row->tgl_awal) ? cek_ddmmyy_v1($row->tgl_awal) : '-' }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top;">Tanggal Akhir</td>
            <td style="vertical-align: top;">:</td>
            <td>{{ isset($row->tgl_akhir) ? cek_ddmmyy_v1($row->tgl_akhir) : '-' }}</td>
        </tr>
        <tr>
            <td colspan="3">
                <hr>
            </td>
        </tr>
        <tr class="alert alert-secondary">
            <td colspan="3">
                <span style="color:#FFFFFF;"> &nbsp;&nbsp; <i class=" fa fa-edit"></i> KIR</span>
            </td>
        </tr>

        <tr>
            <td style="vertical-align: top;">Tanggal Awal</td>
            <td style="vertical-align: top;">:</td>
            <td>{{ isset($row->tgl_kir_awal) ? cek_ddmmyy_v1($row->tgl_kir_awal) : '-' }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top;">Tanggal Akhir</td>
            <td style="vertical-align: top;">:</td>
            <td>{{ isset($row->tgl_kir_akhir) ? cek_ddmmyy_v1($row->tgl_kir_akhir) : '-' }}</td>
        </tr>
        <tr>
            <td colspan="3">
                <hr>
            </td>
        </tr>
        <tr class="alert alert-secondary">
            <td colspan="3">
                <span style="color:#FFFFFF;"> &nbsp;&nbsp; <i class=" fa fa-edit"></i>
                    INFORMASI TAMBAHAN DATA KENDARAAN</span>
            </td>
        </tr>

        <tr>
            <td style="vertical-align: top;">Nomor Uji Kendaraan
            </td>
            <td style="vertical-align: top;">:</td>
            <td>{{ $row->JPermohonan->nomor_uji ? $row->JPermohonan->nomor_uji : '-' }}</td>
        </tr>

        <tr>
            <td style="vertical-align: top;">Kombinasi yang diperbolehkan
            </td>
            <td style="vertical-align: top;">:</td>
            <td>{{ $row->JPermohonan->kombinasi_yg_diperoleh ? $row->JPermohonan->kombinasi_yg_diperoleh : '-' }}</td>
        </tr>

        <tr>
            <td style="vertical-align: top;">SK Register Uji Type

            </td>
            <td style="vertical-align: top;">:</td>
            <td>{{ $row->JPermohonan->sk_reg_uji_type ? $row->JPermohonan->sk_reg_uji_type : '-' }}</td>
        </tr>

        <tr>
            <td style="vertical-align: top;">Keterangan Lain-lain
            </td>
            <td style="vertical-align: top;">:</td>
            <td>{{ $row->JPermohonan->ket_lain ? $row->JPermohonan->ket_lain : '-' }}</td>
        </tr>
    </body>
</table>
