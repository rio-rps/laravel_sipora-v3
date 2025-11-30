@extends('private.layout.main')
@section('isi')
    <style>
        /* Container kartu (ukuran fisik ATM/KTP: 85.6mm x 53.98mm) */
        .kotak_depan,
        .kotak_belakang {
            width: 85.6mm;
            height: 53.98mm;
            border: 0px solid #000;
            border-radius: 2px;
            overflow: hidden;
            box-sizing: border-box;
            //font-family: Arial, Helvetica, sans-serif;
            padding: 2mm;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            position: relative;
            /* untuk background absolute */
            background-color: transparent;
        }

        /* Gambar background sebagai elemen <img> (supaya html2canvas bisa deteksi crossOrigin) */
        .bg-img {
            position: absolute;
            inset: 0;
            /* top:0;right:0;bottom:0;left:0; */
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            pointer-events: none;
        }

        /* Konten di atas background */
        .kartu-content {
            position: relative;
            z-index: 1;
            color: #000;
        }

        table {
            font-size: 9px;
            width: 100%;
            border-collapse: collapse;
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

        /* Perbaikan comment CSS: gunakan /* ... *\/ bukan // */
        .kotak_belakang {
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            padding: 2mm;
            background-blend-mode: overlay;
        }

        .text-center {
            text-align: center;
        }

        /* styling tambahan untuk layout QR dan teks */
        .qr-cell {
            width: 20px;
            text-align: center;
            vertical-align: top;
        }

        /* kecilkan font pada beberapa teks */
        .small-note {
            font-size: 8px;
            display: block;
        }

        /* agar tombol tidak terlalu menempel */
        .download-row {
            margin-top: 12px;
            margin-bottom: 24px;
        }
    </style>


    <style>
        .stiker-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            max-width: 450px;
            margin: 20px auto;
        }

        .stiker-container svg {}

        .button-group {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-png {
            background: #007BFF;
            color: white;
        }

        .btn-jpg {
            background: #28A745;
            color: white;
        }

        .btn-print {
            background: #6C757D;
            color: white;
        }
    </style>

    <!-- Load html2canvas dari CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">CETAK KARTU PENGAWAS ELEKTRONIK</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <ul class="nav nav-tabs nav-top-border no-hover-bg" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="baseIcon-tab11" data-toggle="tab" aria-controls="tabIcon11"
                            href="#tabIcon11" role="tab" aria-selected="true"><i class="fa fa-id-card"></i>
                            Kartu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="baseIcon-tab13" data-toggle="tab" aria-controls="tabIcon13"
                            href="#tabIcon13" role="tab" aria-selected="false"><i class="fa fa-sticky-note-o"></i>
                            Stiker
                        </a>
                    </li>

                </ul>
                <div class="tab-content px-1 pt-1">
                    <div class="tab-pane active" id="tabIcon11" role="tabpanel" aria-labelledby="baseIcon-tab11">
                        <p>


                        <div class="row">
                            <div class="col-md-6">
                                <div id="kartuDepan" class="kotak_depan">
                                    <img src="{{ asset("images/kartu/{$bgCard}/depan.png") }}" class="bg-img"
                                        crossorigin="anonymous" alt="bg-depan">
                                    <div class="kartu-content">
                                        <table>
                                            <tr>
                                                <td colspan="4" align="center">
                                                    <table class="logos">
                                                        <tr>
                                                            <td>
                                                                <img src="{{ asset('images/kartu/logo_dishub.png') }}"
                                                                    width="40" crossorigin="anonymous"
                                                                    alt="logo_dishub">
                                                            </td>
                                                            <td width="100%" align="center" class="title"
                                                                style="font-size: 13px; color:  #000">
                                                                DINAS PERHUBUNGAN <br> PROVINSI SUMATERA SELATAN
                                                            </td>
                                                            <td>
                                                                <img src="{{ asset('images/kartu/logo_provsumsel.png') }}"
                                                                    width="40" crossorigin="anonymous"
                                                                    alt="logo_report">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <hr style="border: 2px solid #000; margin-top: -2px;">
                                                </td>
                                            </tr>
                                        </table>

                                        <div class="text-center title"
                                            style="margin-top:-12px;margin-bottom:12px; color: #000; ">
                                            KARTU PENGAWASAN ELEKTRONIK
                                        </div>

                                        @if ($row->JPermohonan->id_trayek != 0)
                                            <table style="margin-top: -10px;font-size: 9px;color: #000;">
                                            @else
                                                <table style="margin-top: -10px;font-size: 10px;color: #000;">
                                        @endif

                                        <tr class="desk">
                                            @if ($row->JPermohonan->id_trayek != 0)
                                                <td rowspan="5" class="qr-cell">
                                                @else
                                                <td rowspan="4" class="qr-cell">
                                            @endif
                                            {{-- QRCode: package biasanya menghasilkan SVG atau IMG --}}
                                            <div style="padding-top:5px;">
                                                {!! QrCode::size(50)->generate($QRcode) !!}
                                            </div>
                                            </td>
                                            <td style="vertical-align: top;">NOMOR</td>
                                            <td style="vertical-align: top;">:</td>
                                            <td style="vertical-align: top;">
                                                {{ \Illuminate\Support\Str::limit(strtoupper($row->no_kartu_pengawas), 34) }}
                                            </td>
                                        </tr>

                                        <tr class="desk">
                                            <td>NO. TNKB</td>
                                            <td>:</td>
                                            <td>{{ strtoupper($row->JPermohonan->plat_no_kendaraan) }}</td>
                                        </tr>

                                        <tr class="desk">
                                            <td>NAMA PERUSAHAAN</td>
                                            <td style="vertical-align: top;">:</td>
                                            <td style="vertical-align: top;">
                                                {{ \Illuminate\Support\Str::limit(strtoupper($row->JPermohonan->nm_perusahaan_personal), 50) }}
                                            </td>
                                        </tr>

                                        @if ($row->JPermohonan->id_trayek != 0)
                                            <tr class="desk">
                                                <td style="vertical-align: top;">TRAYEK</td>
                                                <td style="vertical-align: top;">:</td>
                                                <td>
                                                    {{ \Illuminate\Support\Str::limit(strtoupper($row->JPermohonan->Jtrayek->nm_trayek), 53) }}
                                                </td>
                                            </tr>
                                        @endif

                                        <tr class="desk">
                                            <td>MASA BERLAKU</td>
                                            <td style="vertical-align: top;">:</td>
                                            <td>S.D {{ cek_ddmmyy_v4($row->tgl_akhir) }}</td>
                                        </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="download-row">
                                    <button onclick="downloadImage('depan','png')" class="btn btn-success">🖼️ Download
                                        PNG</button>
                                    <button onclick="downloadImage('depan','jpg')" class="btn btn-primary">🖼️ Download
                                        JPG</button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div id="kartuBelakang" class="kotak_belakang">
                                    <img src="{{ asset("images/kartu/{$bgCard}/belakang.png") }}" class="bg-img"
                                        crossorigin="anonymous" alt="bg-belakang">
                                    <div class="kartu-content">
                                        <div class="text-center title" style="margin-bottom:12px; color: #000; ">
                                            5 CITRA MANUSIA PERHUBUNGAN
                                            <hr style="border: 2px solid #000; margin-top: -1px;">
                                        </div>

                                        <table class="small-note"
                                            style="font-weight:600;font-size: 9px;  font-family: 'Signika', Arial, sans-serif;    ">
                                            <tr>
                                                <td width="1%" style="vertical-align: top; padding-right: 5px;">1.
                                                </td>
                                                <td style="padding-left: 5px;">
                                                    Taqwa&nbsp;terhadap&nbsp;Tuhan&nbsp;Yang&nbsp;Maha&nbsp;Esa.</td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: top; padding-right: 5px;">2.</td>
                                                <td style="padding-left: 5px;">Tanggap terhadap kebutuhan masyarakat akan
                                                    pelayanan jasa yang
                                                    tertib,
                                                    teratur, tepat waktu, bersih, dan nyaman.</td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: top; padding-right: 5px;">3.</td>
                                                <td style="padding-left: 5px;">Tangguh menghadapi tantangan.</td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: top; padding-right: 5px;">4.</td>
                                                <td style="padding-left: 5px;">Terampil dan berperilaku jujur, gesit,
                                                    ramah, sopan, serta lugas.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: top; padding-right: 5px;">5.</td>
                                                <td style="padding-left: 5px;">Tanggung jawab terhadap keselamatan dan
                                                    keamanan jasa perhubungan.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="center"
                                                    style="padding-top: 10px; font-style: italic; font-size: 9px;">
                                                    <span class="small-note">
                                                        "Apabila kartu ini tercecer, harap dikembalikan kepada<br>
                                                        Dinas Perhubungan Provinsi Sumatera Selatan."
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="download-row">
                                    <button onclick="downloadImage('belakang','png')" class="btn btn-success">🖼️ Download
                                        PNG</button>
                                    <button onclick="downloadImage('belakang','jpg')" class="btn btn-primary">🖼️ Download
                                        JPG</button>

                                </div>
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="tab-pane" id="tabIcon13" role="tabpanel" aria-labelledby="baseIcon-tab3">
                        <p>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

                            @php
                                $imagePath = public_path("images/kartu/{$bgCard}/STICKER.png");
                                $imageData = file_get_contents($imagePath);
                                $base64Image = 'data:image/png;base64,' . base64_encode($imageData);
                            @endphp

                        <form>
                            <div class="form-group">
                                <label for="">Jenis Permohonan</label>
                                <input type="text" name="txt_permohonan" id="txt_permohonan" class="form-control"
                                    value="{{ strtoupper($row->JPermohonan->JPermohonan->alias) }}" maxlength="29">
                                <small class="text-danger">Maksimal 29 karakter</small>
                            </div>
                            <div class="form-group">
                                <label for="">Perusahaan</label>
                                <input type="text" name="txt_perusahaan" id="txt_perusahaan" class="form-control"
                                    value="{{ strtoupper($row->JPermohonan->nm_perusahaan_personal) }}" maxlength="32">
                                <small class="text-danger">Maksimal 32 karakter</small>
                            </div>
                        </form>

                        <div class="stiker-container">
                            <!-- Area yang bisa diunduh -->
                            <div id="capture" style="background:white; padding:10px;">
                                <svg width="400" height="400" viewBox="0 0 400 400"
                                    xmlns="http://www.w3.org/2000/svg">

                                    <!-- Gambar latar -->
                                    <image href="{{ $base64Image }}" width="400" height="400" />

                                    <!-- Path untuk teks melengkung -->
                                    <path id="title" d="M 50 190 A 150 150 0 0 1 350 190" fill="none" />
                                    <path id="title2" d="M 70 200 A 115 115 0 0 1 333 200" fill="none" />

                                    <!-- Teks melengkung 1 -->
                                    <text id="permohonanText" font-family="'Trebuchet MS', sans-serif" font-weight="bold"
                                        font-size="25" fill="#000" text-anchor="middle">
                                        <textPath href="#title" startOffset="50%">

                                            {{ strtoupper($row->JPermohonan->JPermohonan->alias) }}
                                        </textPath>
                                    </text>

                                    <!-- Teks melengkung 2 -->
                                    <text id="perusahaanText" font-family="'Trebuchet MS', sans-serif" font-weight="bold"
                                        font-size="18" fill="#000" text-anchor="middle">
                                        <textPath href="#title2" startOffset="50%">
                                            {{ strtoupper($row->JPermohonan->nm_perusahaan_personal) }}
                                        </textPath>
                                    </text>

                                    <!-- QR dan TNKB -->
                                    <g transform="translate(24, 170)">
                                        {!! QrCode::size(90)->generate($QRcode) !!}
                                    </g>

                                    <text x="283" y="205" font-family="'Trebuchet MS', sans-serif" font-weight="bold"
                                        font-size="19" fill="#000">
                                        {{ strtoupper($row->JPermohonan->plat_no_kendaraan) }}
                                    </text>
                                </svg>
                            </div>

                            <!-- Tombol -->
                            <div class="button-group">
                                <button onclick="downloadAsImage('png')" class="btn btn-png">🖼️ Download PNG</button>
                                <button onclick="downloadAsImage('jpg')" class="btn btn-jpg">🖼️ Download JPG</button>
                            </div>
                        </div>
                        </p>
                    </div>

                    <script>
                        // Fungsi untuk update teks di SVG saat user mengetik
                        document.getElementById('txt_permohonan').addEventListener('input', function() {
                            const value = this.value.substring(0, 29).toUpperCase(); // maksimal 29 huruf
                            document.querySelector('#permohonanText textPath').textContent = value || '';
                        });

                        document.getElementById('txt_perusahaan').addEventListener('input', function() {
                            const value = this.value.substring(0, 32).toUpperCase(); // maksimal 32 huruf
                            document.querySelector('#perusahaanText textPath').textContent = value || '';
                        });

                        // Fungsi download hasil sebagai gambar
                        async function downloadAsImage(type) {
                            const svgElement = document.getElementById('capture');
                            const canvas = await html2canvas(svgElement, {
                                backgroundColor: 'white',
                                scale: 2
                            });

                            const link = document.createElement('a');
                            link.download = `stiker.${type}`;
                            link.href = canvas.toDataURL(`image/${type}`);
                            link.click();
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Utility: tunggu semua gambar di dalam elemen selesai dimuat
        function waitForImages(container) {
            const imgs = Array.from(container.querySelectorAll('img'));
            const promises = imgs.map(img => {
                return new Promise(resolve => {
                    if (img.complete && img.naturalWidth !== 0) return resolve();
                    img.addEventListener('load', () => resolve());
                    img.addEventListener('error', () => resolve()); // tetap resolve agar tidak menggantung
                });
            });
            return Promise.all(promises);
        }

        // Utility: download blob
        function downloadBlob(blob, filename) {
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            setTimeout(() => {
                URL.revokeObjectURL(link.href);
                link.remove();
            }, 100);
        }

        async function downloadImage(pos, type) {
            const el = pos === 'depan' ? document.getElementById('kartuDepan') : document.getElementById(
                'kartuBelakang');

            // tunggu semua gambar di kartu selesai load
            await waitForImages(el);

            // scale agar hasil tajam di layar high-DPI
            const baseScale = Math.max(1, window.devicePixelRatio || 1);
            const scale = baseScale * 2; // *2 untuk kualitas lebih tajam. Sesuaikan bila file terlalu besar.

            html2canvas(el, {
                scale: scale,
                useCORS: true, // coba gunakan CORS untuk gambar
                allowTaint: false, // jangan izinkan taint jika gambar cross-origin
                logging: false,
                imageTimeout: 15000
            }).then(async (canvas) => {
                if (type === 'jpg') {
                    // gunakan toBlob untuk kualitas dan memori lebih baik
                    canvas.toBlob(function(blob) {
                        downloadBlob(blob, `kartu_pengawasan_${pos}.jpg`);
                    }, 'image/jpeg', 0.95);
                } else {
                    canvas.toBlob(function(blob) {
                        downloadBlob(blob, `kartu_pengawasan_${pos}.png`);
                    }, 'image/png');
                }
            }).catch(err => {
                console.error('Gagal membuat gambar:', err);
                alert('Gagal membuat gambar. Cek console untuk detail.');
            });
        }
    </script>
@endsection
