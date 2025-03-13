<style>
    .kotak_depan {
        float: left;
        background-image: url("{{ public_path('images/kartu/bg-depan-hijau.jpeg') }}");
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        padding: 0;
        margin: 7px;
        width: 350px;
        height: 200px;
        /* border: 2px solid #000; */

        font-family: Arial, Helvetica, sans-serif;
    }

    .lingkaran {
        margin-top: 0;
        margin-right: auto;
        margin-bottom: 0;
        margin-left: auto;
        background-image: url("{{ public_path('images/kartu/lingkaran.png') }}");
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        margin-top: 450px;
        width: 500px;
        height: 500px;
        /* border: 2px solid #000; */

        font-family: Arial, Helvetica, sans-serif;
    }

    .inset-text {
        font-size: 36px;
        text-shadow: -1px -1px 0 #fff, 1px 1px 0 #000;
    }


    /* .logo_disub_depan {
        padding: 10px 10px 0 0;
        width: 80px;
        height: 20px;
        border: 2px solid #000;
    }

    .tulisan_disub_depan {
        padding: 10px 10px 0 0;
        width: 220px;
        height: 20px;
        border: 2px solid #000;
        font-size: 12px;
        font-weight: bold;
        margin-left: 17px;
    } */

    /* .kotak_belakang {
        float: left;
        background-image: url("{{ public_path('images/kartu/bg-belakang-hijau.jpeg') }}");
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        padding: 0;
        margin: 0;
        width: 300px;
        height: 200px;
        border: 2px solid #000;

        font-family: Arial, Helvetica, sans-serif;
    } */
</style>
<div class="kotak_depan">

    <table style="font-size:9px; width:350px;">
        <tr>
            <td colspan="4" align="center">
                <table style="width:350px;padding-right:10px;font-size:12px;">
                    <tr>
                        <td><img src="{{ public_path('images/kartu/logo_dishub.png') }}" width="40px;"></td>
                        <td width="100%" align="center" style="font-weight: bold;">DINAS PERHUBUNGAN<br>PROVINSI SUMATERA SELATAN</td>
                        <td><img src="{{ public_path('images/kartu/logo_report.png') }}" class="pull-right" width="50px;"></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="4" align="center">
                <hr class="border-secondary">
            </td>
        </tr>
        <tr>
            <td colspan="4" align="center"><b>KARTU PENGAWASAN ELEKTRONIK</b></td>
        </tr>
        <tr>
            <td rowspan="4" width="10px;" align="center"><img src="data:image/png;base64, {!! base64_encode(QrCode::size(400)->generate($QRcode)) !!} " style="width: 50px;"></td>
            <td style="vertical-align: top;">NOMOR</td>
            <td width="1px" style="vertical-align: top;">:</td>
            <td style="vertical-align: top;">{{ $row->no_kartu_pengawas }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top;">NO. TNKB</td>
            <td style="vertical-align: top;">:</td>
            <td style="vertical-align: top;">{{ strtoupper($row->JPermohonan->plat_no_kendaraan) }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top;">NAMA PERUSAHAAN</td>
            <td style="vertical-align: top;">:</td>
            <td style="vertical-align: top;">{{ strtoupper($row->JPermohonan->nm_perusahaan_personal) }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top;">MASA BERLAKU</td>
            <td style="vertical-align: top;">:</td>
            <td style="vertical-align: top;">S.D {{ cek_ddmmyy_v4($row->tgl_akhir) }}</td>
        </tr>
    </table>
</div>
<div class="kotak_depan">
    <table style="font-size:10px; width:350px; padding-left:5px; padding-top:5px;">
        <tr>
            <td colspan="2" align="center" style="font-weight:bold; font-size:13px;">5 CITRA MANUSIA PERHUBUNGAN</td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <hr class="border-secondary">
            </td>
        </tr>
        <tr>
            <td width="1%">1.</td>
            <td>Taqwa terhadap Tuhan yang maha Esa.</td>
        </tr>
        <tr>
            <td style="vertical-align: top;">2.</td>
            <td style="vertical-align: top;">Tanggap terhadap kebutuhan masyarakat akan pelayanan jasa yang tertib, teratur, tepat waktu, bersih dan nyaman.</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Tangguh menghadapi tantangan.</td>
        </tr>
        <tr>
            <td>4.</td>
            <td>Terampil dan berprilaku jujur, gesit, ramah, sopan serta lugas.</td>
        </tr>
        <tr>
            <td style="vertical-align: top;">5.</td>
            <td style="vertical-align: top;">Tanggung Jawab terhadap keselamatan dan keamanan jasa perhubungan.</td>
        </tr>
        <tr>
            <td colspan="2" align="center" style="font-weight:bold;">
                "Apabila Kartu ini tercecer harap dikembalikan kepada<br>
                Dinas Perhubungan Provinsi Sumatera Selatan"
            </td>
        </tr>
    </table>
</div>

<div class="lingkaran">



</div>


<!-- <div class="kotak_belakang"></div> -->
<!-- <img src="{{ public_path('images/kartu/bg-depan-hijau.jpeg') }}" width="300px;">
<img src="{{ public_path('images/kartu/bg-belakang-hijau.jpeg') }}" width="300px;"> -->