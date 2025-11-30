@extends('private.layout.main')
@section('isi')
    <style>
        .kotak_depan {
            width: 85.6mm;
            height: 53.98mm;
            background-image: url("{{ asset('images/kartu/bg-depan-hijau.jpeg') }}");
            background-size: cover;
            background-repeat: no-repeat;

            border: 1px solid #000;
            border-radius: 2px;
            overflow: hidden;
            /* sudut tidak putih */
            box-sizing: border-box;

            font-family: Arial, Helvetica, sans-serif;
            padding: 2mm;

            /* Efek bayangan biar mirip kartu fisik */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
        }



        table {
            font-size: 9px;
            width: 100%;
        }

        .title {
            text-align: center;
            font-weight: bold;
        }

        .desk {
            font-weight: bold;
        }

        .logos {
            width: 100%;
        }

        .kotak_belakang {
            width: 85.6mm;
            height: 53.98mm;

            background-size: contain;
            //opacity: 0.5;
            /* gambar tetap proporsional */
            background-repeat: no-repeat;
            background-position: center;
            /* ditengah */

            background-color: #45f36e;
            //  opacity: 10%;
            border: 1px solid #000;
            border-radius: 2px;
            overflow: hidden;
            box-sizing: border-box;
            padding: 2mm;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            //padding: 10px 0 10px 0;
            /* atas-bawah 5mm, kiri-kanan 3mm */
            background-blend-mode: overlay;
        }

        .bg_belakang {
            background-image: url("{{ asset('images/kartu/logo_dishub-kartu.png') }}");
        }
    </style>

    <div id="kartuDepan" class="kotak_depan ">
        <table>
            <tr>
                <td colspan="4" align="center">
                    <table class="logos">
                        <tr>
                            <td><img src="{{ asset('images/kartu/logo_dishub.png') }}" width="40px"></td>
                            <td width="100%" align="center" class="title" style="font-size: 13px; color:  #000">
                                DINAS PERHUBUNGAN <br> PROVINSI SUMATERA SELATAN
                            </td>
                            <td><img src="{{ asset('images/kartu/logo_report.png') }}" width="50px"></td>
                        </tr>
                    </table>
                    <hr style="border: 2px solid #000; margin-top: -2px;">
                </td>
            </tr>
        </table>
        <div class="text-center title" style="margin-top:-12px;margin-bottom:12px; color: #000; ">
            KARTU PENGAWASAN ELEKTRONIK
        </div>
        @if ($row->JPermohonan->id_trayek != 0)
            <table style="margin-top: -10px;font-size: 9px;color: #000;">
            @else
                <table style="margin-top: -10px;font-size: 10px;color: #000;">
        @endif


        <tr class="desk">
            @if ($row->JPermohonan->id_trayek != 0)
                <td rowspan="5" width="20px" align="center">
                @else
                <td rowspan="4" width="20px" align="center">
            @endif


            {!! QrCode::size(50)->generate($QRcode) !!}
            </td>
            <td>NOMOR</td>
            <td>:</td>
            <td>
                {{ \Illuminate\Support\Str::limit(strtoupper($row->no_kartu_pengawas), 32) }}
            </td>
        </tr>
        <tr class="desk">
            <td>NO. TNKB</td>
            <td>:</td>
            <td>{{ strtoupper($row->JPermohonan->plat_no_kendaraan) }}</td>
        </tr>

        <tr class="desk">
            <td>NAMA PERUSAHAAN</td>
            <td>:</td>
            <td>
                {{ \Illuminate\Support\Str::limit(strtoupper($row->JPermohonan->nm_perusahaan_personal), 50) }}
            </td>
        </tr>
        @if ($row->JPermohonan->id_trayek != 0)
            <tr class="desk">
                <td>TRAYEK</td>
                <td>:</td>
                <td>
                    {{ \Illuminate\Support\Str::limit(strtoupper($row->JPermohonan->Jtrayek->nm_trayek), 53) }}

                </td>
            </tr>
        @endif

        <tr class="desk">
            <td>MASA BERLAKU</td>
            <td>:</td>
            <td>S.D {{ cek_ddmmyy_v4($row->tgl_akhir) }}</td>
        </tr>
        </table>
    </div>

    <div style="margin-top:15px;">
        <button onclick="downloadImage('png')">Download PNG</button>
        <button onclick="downloadImage('jpg')">Download JPG</button>
    </div>



    <br><br><br>
    <div id="kartuBelakang" class="kotak_belakang bg_belakang">
        <div class="text-center title" style="margin-bottom:12px; color: #000; ">
            5 CITRA MANUSIA PERHUBUNGAN
            <hr style="border: 2px solid #000; margin-top: -1px;">
        </div>

        <table class="desk" style="margin-top: -10px;font-size: 10px;color: #000;margin-right: 55px">
            <tr>
                <td width="1%">1.</td>
                <td>Taqwa terhadap Tuhan yang maha Esa.</td>
            </tr>
            <tr>
                <td style="vertical-align: top;">2.</td>
                <td style="vertical-align: top;">Tanggap terhadap kebutuhan masyarakat akan pelayanan jasa yang tertib,
                    teratur, tepat waktu, bersih dan nyaman.</td>
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
                <td colspan="2" align="center">
                    <span class="font-weight:bold;font-size: 8px;">
                        "Apabila Kartu ini tercecer harap dikembalikan kepada<br>
                        Dinas Perhubungan Provinsi Sumatera Selatan"
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <div style="margin-top:15px;">
        <button onclick="downloadImageBelakang('png')">Download PNG</button>
        <button onclick="downloadImageBelakang('jpg')">Download JPG</button>
    </div>
    <!-- html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function downloadImage(type) {
            const kartuDepan = document.getElementById("kartuDepan");
            html2canvas(kartuDepan, {
                scale: 3
            }).then(canvas => {
                let link = document.createElement("a");
                if (type === "jpg") {
                    link.href = canvas.toDataURL("image/jpeg", 1.0);
                    link.download = "kartu_pengawasan_depan.jpg";
                } else {
                    link.href = canvas.toDataURL("image/png");
                    link.download = "kartu_pengawasan_depan.png";
                }
                link.click();
            });
        }

        function downloadImageBelakang(type) {
            const kartuBelakang = document.getElementById("kartuBelakang");
            html2canvas(kartuBelakang, {
                scale: 3
            }).then(canvas => {
                let link = document.createElement("a");
                if (type === "jpg") {
                    link.href = canvas.toDataURL("image/jpeg", 1.0);
                    link.download = "kartu_pengawasan_belakang.jpg";
                } else {
                    link.href = canvas.toDataURL("image/png");
                    link.download = "kartu_pengawasan_belakang.png";
                }
                link.click();
            });
        }
    </script>
@endsection
