@extends('private.layout.main')
@section('isi')
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }}</b></h4>
                <hr class="border-secondary">
            </div>
            <div class="card-body" style="margin-top: -45px;">
                <div class="row">

                    <div class="col-md-6">
                        <div class="card box-shadow-0 border-blue box-sm">
                            <div class="card-header card-head-inverse bg-secondary">
                                <h4 class="card-title"><i class="fa fa-id-card"></i> Data Permohonan</h4>
                            </div>

                            <div class="card-content  ">
                                <div class="card-body">
                                    <table style="vertical-align: top;" class="table-striped table-responsive">

                                        <body>
                                            <tr>
                                                <td>Tanggal Kirim Permohonan</td>
                                                <td>:</td>
                                                <td>{{ cek_date_ddmmyyyy_his_v1($row->tgl_kirim_permohonan) }}</td>
                                            </tr>
                                            <tr>
                                                <td>PIC Kab/Kota</td>
                                                <td>:</td>
                                                <td>{{ $row->nm_kabkota }}</td>
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
                                                <td>Nomor Rangka</td>
                                                <td width="1%">:</td>
                                                <td>{{ $row->no_rangka }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Mesin</td>
                                                <td width="1%">:</td>
                                                <td>{{ $row->no_mesin }}</td>
                                            </tr>
                                            <tr>
                                                <td>Warna TNKB</td>
                                                <td width="1%">:</td>
                                                <td>
                                                    {{ $row->warna_tnkb ? $row->warna_tnkb : '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bahan Bakar</td>
                                                <td width="1%">:</td>
                                                <td>
                                                    {{ $row->bahan_bakar ? $row->bahan_bakar : '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Daya Angkut Orang</td>
                                                <td width="1%">:</td>
                                                <td>{{ format_rupiah($row->daya_angkut_orang) }} Orang</td>
                                            </tr>
                                            <tr>
                                                <td>Daya Angkut Barang</td>
                                                <td width="1%">:</td>
                                                <td>{{ format_rupiah($row->daya_angkut_barang) }} Kg</td>
                                            </tr>
                                            <tr>
                                                <td>Tahun Pembuatan</td>
                                                <td width="1%">:</td>
                                                <td>{{ $row->thn_pembuatan }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Faktur Jual Beli</td>
                                                <td width="1%">:</td>
                                                <td>
                                                    {{ $row->nmr_faktur_jual_beli ? $row->nmr_faktur_jual_beli : '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Faktur</td>
                                                <td width="1%">:</td>
                                                <td>{{ $row->tgl_faktur_jual_beli ? cek_date_ddmmyyyy_his_v2($row->tgl_faktur_jual_beli) : '-' }}
                                                </td>
                                            </tr>
                                        </body>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="card box-shadow-0 border-blue">
                            <div class="card-header card-head-inverse bg-secondary">
                                <div id="cekAksiKartuPengawas"></div>
                                <h4 class="card-title"><i class="fa fa-edit"></i> KARTU PENGAWAS</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div id="dataKartuPengawas"></div>
                                </div>
                            </div>
                        </div>

                        <div class="card box-shadow-0 border-blue box-sm">
                            <div class="card-header card-head-inverse bg-secondary">
                                <h4 class="card-title"><i class="fa fa-download"></i> Download Dokumen Upload</h4>
                            </div>
                            <div class="card-content  ">
                                <div class="card-body">
                                    <table style="vertical-align: top;" class="table-striped table-responsive">

                                        <body>
                                            <tr>
                                                <th colspan="4"><i class="fa fa-file"></i> Dokumen Perusahaan</th>
                                            </tr>
                                            <tr>
                                                <th width="35%">NIB</th>
                                                <td width="1%">:</td>
                                                <td>
                                                    @if (isset($dok1->file_dokumen))
                                                        <a target="_blank"
                                                            href="{{ asset('upload/copy_file_permohonan/file_biodata/' . $dok1->file_dokumen) }}"
                                                            class="btn btn-outline-primary btn-sm">
                                                            <i class="fa fa-download"></i> Download
                                                        </a>
                                                    @else
                                                        <span class="badge bg-danger">Kosong</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>KTP</th>
                                                <td>:</td>
                                                <td>
                                                    @if (isset($dok2->file_dokumen))
                                                        <a target="_blank"
                                                            href="{{ asset('upload/copy_file_permohonan/file_biodata/' . $dok2->file_dokumen) }}"
                                                            class="btn btn-outline-primary btn-sm">
                                                            <i class="fa fa-download"></i> Download
                                                        </a>
                                                    @else
                                                        <span class="badge bg-danger">Kosong</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>AKTE PENDIRIAN</th>
                                                <td>:</td>
                                                <td>
                                                    @if (isset($dok3->file_dokumen))
                                                        <a target="_blank"
                                                            href="{{ asset('upload/copy_file_permohonan/file_biodata/' . $dok3->file_dokumen) }}"
                                                            class="btn btn-outline-primary btn-sm">
                                                            <i class="fa fa-download"></i> Download
                                                        </a>
                                                    @else
                                                        <span class="badge bg-danger">Kosong</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>NPWP</th>
                                                <td>:</td>
                                                <td>
                                                    @if (isset($dok4->file_dokumen))
                                                        <a target="_blank"
                                                            href="{{ asset('upload/copy_file_permohonan/file_biodata/' . $dok4->file_dokumen) }}"
                                                            class="btn btn-outline-primary btn-sm">
                                                            <i class="fa fa-download"></i> Download
                                                        </a>
                                                    @else
                                                        <span class="badge bg-danger">Kosong</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </body>
                                    </table>
                                    <hr>
                                    <table style="vertical-align: top;" class="table-striped table-responsive">
                                        <tr>
                                            <th colspan="3"><i class="fa fa-car"></i> Dokumen Kendaraan</th>
                                        </tr>
                                        <tr>
                                            <th width="35%">KIR</th>
                                            <td width="1%">:</td>
                                            <td>
                                                @if (isset($kendaraan->file_kir))
                                                    <a target="_blank"
                                                        href="{{ asset('upload/copy_file_permohonan/file_kendaraan/' . $kendaraan->file_kir) }}"
                                                        class="btn btn-outline-success btn-sm">
                                                        <i class="fa fa-download"></i> Download
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">Kosong</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>STNK</th>
                                            <td>:</td>
                                            <td>
                                                @if (isset($kendaraan->file_stnk))
                                                    <a target="_blank"
                                                        href="{{ asset('upload/copy_file_permohonan/file_kendaraan/' . $kendaraan->file_stnk) }}"
                                                        class="btn btn-outline-success btn-sm">
                                                        <i class="fa fa-download"></i> Download
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">Kosong</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="viewModal" style="display:none;"></div>
    <script src="{{ asset('add-plugins/jquery-3.6.0.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            ShowDataKartuPengawas();
            cekAksiKartuPengawas();
        });

        function ShowDataKartuPengawas() {
            $.ajax({
                type: 'GET',
                url: "{{ route('datapermohonan.showDataKartuPengawas', $row->id_permohonan_izin) }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#loading-spinner').removeClass('d-none');
                },
                complete: function() {
                    $('#loading-spinner').addClass('d-none');
                },
                success: function(response) {
                    $('#dataKartuPengawas').html(response).show();
                },
                error: function(xhr, ajaxOptons, throwError) {
                    alert(xhr.status + '\n' + throwError);
                }
            });
        }

        function cekAksiKartuPengawas() {
            $.ajax({
                type: 'GET',
                url: "{{ route('datapermohonan.cekAksiKartuPengawas', $row->id_permohonan_izin) }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#loading-spinner').removeClass('d-none');
                },
                complete: function() {
                    $('#loading-spinner').addClass('d-none');
                },
                success: function(response) {
                    $('#cekAksiKartuPengawas').html(response).show();
                },
                error: function(xhr, ajaxOptons, throwError) {
                    alert(xhr.status + '\n' + throwError);
                }
            });
        }
    </script>
@endsection
