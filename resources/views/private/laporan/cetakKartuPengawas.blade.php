<head>
    <meta charset="UTF-8">
    <title>Kartu Pengawas</title>
    <style type="text/css">
        /* .fontds {
            font-size: 12px
        } */

        .rangka_surat {
            width: 100%;
            margin: 0 auto;
            background-color: #fff;
            /*height: 500px;*/
            padding: 5px;
            color: #000000;
        }

        /* .ttd_bawah {
            width: 980px;
            margin: 0 auto;
            background-color: #fff; */
        /*height: 500px;*/
        /* padding: 5px; */
        /* } */


        .right {
            position: absolute;
            right: 10px;
            width: 350px;
            /* height: 350px; */
            /* border: 2px solid #000; */
        }

        .centere {
            text-align: center;
            /* line-height: 13px; */
        }

        /* .borderless tr td {
            border: none !important;
            padding: 0px !important;
        }
  */

        body {
            color: #000000;
            font-family: sans-serif;
        }

        .justify {
            text-align: justify;
        }

        /*table {
      border-bottom: 8px solid #000; padding:2px; 
      }*/
    </style>
</head>

<body>
    <div class="rangka_surat">
        @if($row->status_validasi !=5)
        <div class="bordererd" style="width: 100px;text-align:center;right:0px;top:-15px;position: absolute;  border: 2px solid #000;">DRAFT</div>
        @endif
        <table width="100%" style="color:#000000;">
            <tr>
                <td><img src="{{ public_path('images/logo/logo_report.png') }}" width="100px;"></td>
                <td class="centere">
                    <div style="font-size:20px; font-weight: bold;">PEMERINTAH PROVINSI SUMATERA SELATAN</div>
                    <div style="font-size:22px; font-weight: bold; padding-top:2px;">DINAS PERHUBUNGAN</div>
                    <div style="font-size:12px; font-weight: bold; padding-top:2px;">Jl. Kapt. A. Rivai No. 51 Palembang Kotak Pos No. 1132 Telp. 352005 / 363125</div>
                    <div style="font-size:12px; font-weight: bold; padding-top:2px;">Kode Pos : 30129</div>
                </td>
                <td><img src="{{ public_path('images/logo/logo_dishub.png') }}" width="70px;"></td>
            </tr>
            <tr>
                <td colspan="3" style="padding-top: 1px;">
                    <div style="border-bottom: 2px solid #000; padding:1px;"></div>
                </td>
            </tr>
        </table>
    </div>
    <div class="rangka_surat centere ">
        Kartu Pengawasan No. {{ $row->no_kartu_pengawas }}<br>
        Untuk Mengangkut Penumpang dengan Mobil Penumpang
    </div>
    <div class="rangka_surat justify">
        Berdasarkan SK Gubernur Sumatera Selatan tanggal {{ cek_ddmmyy_v2($row->tgl_sk) }} Nomor : {{$row->no_sk}} oleh Kepala Dinas Perhubungan Provinsi Sumatera Selatan diberikan Kartu
        Pengawasan kepada {{ $row->JPermohonan->nm_perusahaan_personal }} yang dipimpin oleh {{ $row->JPermohonan->nm_pimpinan_pemilik }}
        dari tanggal {{ cek_ddmmyy_v2($row->tgl_awal) }} sampai dengan tanggal {{ cek_ddmmyy_v2($row->tgl_akhir) }} dengan menggunakan Mobil
        Penumpang untuk mengangkut penumpang pada trayek :
        <br>
        {{($row->JPermohonan->id_trayek==0)?'-':$trayek->nm_trayek}}
    </div>
    <div class="rangka_surat justify">
        Diberikan di Palembang Tanggal Awal {{ cek_ddmmyy_v2($row->tgl_awal) }}
    </div>
    <!-- <div class="left">
        
    </div>
    <div class="left">
        KEPALA DINAS PERHUBUNGAN
        PROVINSI SUMATERA SELATAN -->
    </div>
    <div class="right">
        <div style="text-align: center;">
            <img src="data:image/png;base64, {!! base64_encode(QrCode::size(350)->generate($QRcode)) !!} " style="width: 150px;">
            <!-- <img src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->generate('http://google.com')) !!} " style="width: 100px;"> -->
        </div><br>
        <div style="text-align: center;">
            {{ $ttd->jabatan_ttd }}<br>
            PROVINSI SUMATERA SELATAN
            <br><br><br><br><br>
            <u style="font-weight:bold;">
                {{ $ttd->nm_ttd }}
            </u><br>
            {{ $ttd->pangkat_gol }}<br>
            NIP. {{ $ttd->nip_ttd }}<br>

        </div>
    </div>




</body>