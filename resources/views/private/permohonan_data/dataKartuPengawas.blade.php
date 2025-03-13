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
    </body>
</table>
