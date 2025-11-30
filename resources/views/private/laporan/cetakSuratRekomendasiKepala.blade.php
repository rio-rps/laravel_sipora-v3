<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SURAT REKOMENDASI KEPALA DINAS PERHUBUNGAN</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            color: #000;
            line-height: 1.5;
        }

        /* Kop Surat */
        .kop-surat {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }

        .kop-surat table {
            width: 100%;
            border-collapse: collapse;
        }

        .kop-logo {
            width: 120px;
            text-align: center;
        }

        .kop-logo img {
            width: 100px;
        }

        .kop-text {
            text-align: center;
            line-height: 1.3;
        }

        .kop-text .prov {
            font-size: 18px;
            font-weight: bold;
        }

        .kop-text .dinas {
            font-size: 30px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 2px 0px 2px 0px;
        }

        .kop-text .alamat {
            font-size: 13px;
        }

        .fontSize {
            font-size: 14px;
        }

        .single-line {
            white-space: nowrap;
        }

        /* Isi Surat */
        .container {
            // width: 90%;
            //margin: 0 auto;
            padding: 0px 30px 0px 30px;
        }

        .rangka_surat {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            //margin: 5px 0;
        }

        td {
            vertical-align: top;
            //padding: 2px 5px;
        }

        .center-tdd {
            padding-top: 120x;
            position: absolute;
            right: 210px;
            width: 250px;
        }

        .right-tdd {
            position: absolute;
            right: 10px;
            width: 250px;
            // border: 2px solid #000;
        }
    </style>
</head>

<body>
    <!-- Kop Surat -->
    <table>
        <tr>
            <td class="kop-logo">
                <img src="{{ public_path('images/logo/logo_report.png') }}" alt="Logo">
            </td>
            <td class="kop-text">
                <div class="prov">PEMERINTAH PROVINSI SUMATERA SELATAN</div>
                <div class="dinas">DINAS PERHUBUNGAN</div>
                <div class="alamat single-line ">
                    Jl. Kapten A. Rivai No. 51 Palembang Kotak Pos 1132
                    Telepon (0711) 352005 - 363125 Kode Pos 30129 <br>
                    Website: <u>dishub.sumselprov.go.id</u>, e-mail: <u>dishub@sumselprov.go.id</u>
                </div>
            </td>
            <td class="kop-logo"></td>
        </tr>
    </table>

    <div class="container" style="text-align: center">
        <hr style="border: 2px solid ;">
        <!-- Judul Surat -->
        <div class="rangka_surat fontSize">
            REKOMENDASI KEPALA DINAS PERHUBUNGAN<br>
            PROVINSI SUMATERA SELATAN<br>
            TENTANG<br>
            PENERBITAN TANDA NOMOR KENDARAAN BERMOTOR UMUM<br>
            NOMOR : {{ $row->no_kartu_pengawas }}
        </div>

        <!-- Isi Surat -->
        <div style="text-align:justify" class="fontSize">
            <p>Pada hari ini <b>{{ cek_hariIndo($row->tgl_sk) }}</b> tanggal <b>{{ cek_ddmmyy_v2($row->tgl_sk) }}</b>
                telah diperiksa persyaratan
                administrasi serta
                peruntukan kendaraan seperti tersebut di bawah ini :</p>

            <table class="fontSize">
                <tr>
                    <td width="5%">1.</td>
                    <td width="40%">Nomor Kendaraan</td>
                    <td width="1%">:</td>
                    <td>{{ $permohonan->plat_no_kendaraan }}</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Nomor Uji</td>
                    <td>:</td>
                    <td>{{ $permohonan->nomor_uji }}</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Nomor Chasis / Landasan</td>
                    <td>:</td>
                    <td>{{ $permohonan->no_rangka }}</td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Nomor Mesin</td>
                    <td>:</td>
                    <td>{{ $permohonan->no_mesin }}</td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>Merek / Tahun Pembuatan</td>
                    <td>:</td>
                    <td>{{ $permohonan->JkendaraanMerek->nm_merek_kendaraan }} / {{ $permohonan->thn_pembuatan }}</td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td>Type/ Jenis</td>
                    <td>:</td>
                    <td>{{ $permohonan->JkendaraanType->nm_type_kendaraan }} / {{ $permohonan->nm_kendaraan }}</td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td>Warna TNKB</td>
                    <td>:</td>
                    <td>{{ $permohonan->warna_tnkb }}</td>
                </tr>
                <tr>
                    <td>8.</td>
                    <td>Bahan Bakar</td>
                    <td>:</td>
                    <td>{{ $permohonan->bahan_bakar }}</td>
                </tr>
                <tr>
                    <td>9.</td>
                    <td>JBB/JBKB</td>
                    <td>:</td>
                    <td>{{ format_rupiah($permohonan->daya_angkut_barang) }} Kg</td>
                </tr>
                <tr>
                    <td>10.</td>
                    <td>Kombinasi yang diperbolehkan</td>
                    <td>:</td>
                    <td>{{ $permohonan->kombinasi_yg_diperoleh }}</td>
                </tr>
                <tr>
                    <td>11.</td>
                    <td>SK Registrasi Uji Type</td>
                    <td>:</td>
                    <td>{{ $permohonan->sk_reg_uji_type }}</td>
                </tr>
                <tr>
                    <td>12.</td>
                    <td>Nomor Faktur Jual Beli</td>
                    <td>:</td>
                    <td>{{ $permohonan->nmr_faktur_jual_beli }}</td>
                </tr>
                <tr>
                    <td>13.</td>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{ $permohonan->tgl_faktur_jual_beli }}</td>
                </tr>
                <tr>
                    <td>14.</td>
                    <td>Nama Pemilik</td>
                    <td>:</td>
                    <td>{{ $permohonan->nm_perusahaan_personal }} ({{ $permohonan->BadanUsaha->nm_badan_usaha }})</td>
                </tr>
                <tr>
                    <td>15.</td>
                    <td>Alamat Pemilik</td>
                    <td>:</td>
                    <td>{{ $permohonan->alamat_biodata }}</td>
                </tr>
                <tr>
                    <td>16.</td>
                    <td>Keterangan Lain-Lain</td>
                    <td>:</td>
                    <td>{{ $permohonan->ket_lain }}</td>
                </tr>
            </table>

            <p style="text-align:justify;" class="fontSize">
                Berdasarkan <b>Undang-Undang Nomor 22 Tahun 2009</b> Jo <b>Peraturan Pemerintah Nomor 74 Tahun 2014</b>
                dan
                <b>Peraturan Pemerintah Nomor 55 Tahun 2012</b> Jo <b>Keputusan Menteri Nomor 133 Tahun 2015</b> tentang
                Pengujian Berkala Kendaraan Bermotor, sesuai dengan persyaratan administrasi serta peruntukannya, bahwa
                kendaraan bermotor dimaksud memenuhi persyaratan untuk menjadi
                <b>{{ $permohonan->nm_kendaraan }} ({{ $permohonan->JPermohonan->nm_par_permohonan }})</b>.
            </p>


            <br><br>
            <div class="center-tdd">
                <br><br><br><br>
                <div style="text-align: center;">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::size(350)->generate($QRcode)) !!} " style="width: 150px;">
                    <!-- <img src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->generate('http://google.com')) !!} " style="width: 100px;"> -->
                </div>
            </div>

            <div class="right-tdd">
                <div style="padding-left:20px"> Palembang, {{ cek_ddmmyy_v2($row->tgl_sk) }}<br>
                </div>
                <div style="text-align: center;">
                    {{ $ttd->jabatan_ttd }}<br>
                    PROVINSI SUMATERA SELATAN
                    <br><br><br><br><br><br><br>
                    <span style="font-weight:bold;">
                        {{ $ttd->nm_ttd }}
                    </span><br>
                    {{ $ttd->pangkat_gol }}<br>
                    NIP. {{ $ttd->nip_ttd }}<br>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
