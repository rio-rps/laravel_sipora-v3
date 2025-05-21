<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #printArea,
        #printArea * {
            visibility: visible;
        }

        #printArea {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        /* Optional: Hide page breaks if needed */
        .no-print {
            display: none !important;
        }
    }


    .table-custom {
        width: 100%;
        border-collapse: collapse;
        font-size: 11px;
        background-color: #ffffff;
    }

    .table-custom thead {
        background-color: #f2f2f2;
        color: #333;
        text-align: center;
    }

    .table-custom th,
    .table-custom td {
        padding: 8px 10px;
        border: 1px solid #ddd;
        vertical-align: top;
    }

    .table-custom tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table-custom tbody tr:hover {
        background-color: #e8f4ff;
        transition: 0.2s ease;
    }

    .table-custom .text-center {
        text-align: center;
    }

    .single-line {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }
</style>

<div class="form-group">


    <div id="accordionWrap1" role="tablist" aria-multiselectable="true">
        <div class="card accordion collapse-icon accordion-icon-rotate">
            <div id="heading11" class="  collapsed font-weight-bold text-white px-1 py-1" data-toggle="collapse"
                href="#accordion11" aria-expanded="false" aria-controls="accordion11"
                style="background-color:#8b8d91; border-radius: 10px 10px 0px 0px; cursor: pointer;">
                Pengaturan Kertas PDF
            </div>

            <div id="accordion11" role="tabpanel" data-parent="#accordionWrap1" aria-labelledby="heading11"
                class="collapse">
                <div class="card-content card border-secondary ">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Ukuran Font</label>
                                <input type="number" class="form-control" name="font_size" id="font_size"
                                    value="12">
                            </div>
                            <div class="col-md-4">
                                <label>Font</label>
                                <select class="form-control" name="font_family" id="font_family">
                                    <option value="Inter, Sans-Serif" selected>Inter, Sans-Serif</option>
                                    <option value="Arial">Arial</option>
                                    <option value="Times New Roman">Times New Roman</option>
                                    <option value="Calibri">Calibri</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">

        <button onclick="openPrintFromURL()" class="btn btn-outline-success">
            <i class="fa fa-file-pdf-o"></i> CETAK DOKUMEN
        </button>
        <a target="_blank"
            href="{{ route('laporan.exportPermohonanFilter', ['jenisPermohonan' => $ket['jenisPermohonanFilter'], 'sttsPermohonan' => $ket['sttsPermohonanFilter'], 'id_kabkotaFilter' => $ket['id_kabkotaFilter'], 'tglFilter' => $ket['dateFilter']]) }}"
            class="btn btn-outline-primary"><i class="fa fa-file-excel-o"></i>
            EXCEL
        </a>
    </div>
</div>
<div class="form-group font-weight-bold">
    <div class="table-responsive">
        <table class="table table-light" style="font-size:10px;">
            {{--  light  --}}
            <tbody>
                <tr>
                    <td width='20%'>Jenis Permohonan</td>
                    <td width='1%'>:</td>
                    <td>{{ $ket['jenisPermohonan'] }}</td>
                </tr>
                <tr>
                    <td>Status Permohonan</td>
                    <td>:</td>
                    <td>{{ $ket['sttsPermohonan'] }}</td>
                </tr>
                <tr>
                    <td>Provinsi/Kab/Kota</td>
                    <td>:</td>
                    <td>{{ $ket['kabkota'] }}</td>
                </tr>
                <tr>
                    <td>Tanggal Filter</td>
                    <td>:</td>
                    <td>{{ $ket['datePeriode'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="table-responsive">
    <table class="table-custom" style="width:100%; font-size:10px;">
        <thead>
            <tr>
                <th width=" 1%">No</th>
                <th>Tgl Permohonan</th>
                @if ($status_permohonan == 5)
                    <th>Tgl Validasi</th>
                    <th>Nomor Kartu Pengawas</th>
                    <th>Tanggal SK<br>Nomor SK</th>
                    <th>Tgl Mulai SK<br> Tgl Akhir SK</th>
                    <th>Tgl KIR Awal<br> Tgl KIR Akhir</th>
                @endif
                <th>Perusahaan</th>
                <th>Pimpinan</th>
                <th>Nama Kendaraan </th>
                <th>No Rangka<br>No Mesin </th>
                <th>Jenis Permohonan </th>
                <th>Permohonan </th>
                <th>Jenis Angkutan </th>
                <th>Trayek</th>
                <th>Mengangkut</th>
                <th>
                    Daya Angkut Org<br>
                    Daya Angkut Brg
                </th>
                <th>No Plat</th>
                <th>KabKota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resultPermohonan as $resultPermohonanAll)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ cek_date_ddmmyyyy_his_v2($resultPermohonanAll->tgl_kirim_permohonan) }}</td>
                    @if ($status_permohonan == 5)
                        <td>{{ cek_date_ddmmyyyy_his_v2($resultPermohonanAll->tgl_validasi_proses) }}</td>
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
                    <td>{{ $resultPermohonanAll->jmengangkut->nm_mengangkut }}</td>
                    <td>
                        {{ $resultPermohonanAll->daya_angkut_orang }} Org<br>
                        {{ $resultPermohonanAll->daya_angkut_barang }} Kg

                    </td>
                    <td class="single-line">{{ $resultPermohonanAll->plat_no_kendaraan }}</td>
                    <td>{{ $resultPermohonanAll->nm_kabkota }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<iframe id="printFrame" style="display:none;"></iframe>
<script>
    async function openPrintFromURL() {
        // Ambil nilai font
        const fontSize = document.getElementById('font_size').value;
        const fontFamily = document.getElementById('font_family').value;

        const params = new URLSearchParams({
            jenisPermohonan: "{{ $ket['jenisPermohonanFilter'] }}",
            sttsPermohonan: "{{ $ket['sttsPermohonanFilter'] }}",
            id_kabkotaFilter: "{{ $ket['id_kabkotaFilter'] }}",
            tglFilter: "{{ $ket['dateFilter'] }}"
        });

        const url = "{{ url('/laporan/cetakPermohonanFilter') }}?" + params.toString();

        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error("Gagal memuat data cetak");

            const html = await response.text();

            const printFrame = document.getElementById("printFrame");
            const doc = printFrame.contentWindow.document;

            // Injeksi CSS font
            const style = `
                <style>
                    body {
                        font-size: ${fontSize}px !important;
                        font-family: '${fontFamily}' !important;
                    }
                </style>
            `;

            doc.open();
            doc.write(style + html); // Tambahkan CSS sebelum HTML
            doc.close();

            printFrame.onload = function() {
                printFrame.contentWindow.focus();
                printFrame.contentWindow.print();
            };
        } catch (err) {
            alert("Gagal mencetak: " + err.message);
        }
    }
</script>
