<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $maintenance->judul ?? 'SIPORA - Sistem Dalam Pemeliharaan' }}
    </title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Arial, sans-serif;
            overflow-x: hidden;

            background:
                radial-gradient(circle at top left,
                    rgba(30, 136, 229, 0.18),
                    transparent 40%),
                linear-gradient(135deg, #071c33 0%, #0d3558 50%, #0b5a78 100%);
        }

        /* ================================
          BACKGROUND DECORATION
       ================================= */

        .road-line {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 120px;

            background: #202b36;
            z-index: 1;
            overflow: hidden;
        }

        .road-line::before {
            content: "";
            position: absolute;
            top: 55px;
            left: 0;
            width: 100%;
            height: 7px;

            background:
                repeating-linear-gradient(90deg,
                    #ffffff 0,
                    #ffffff 70px,
                    transparent 70px,
                    transparent 130px);

            opacity: .9;
        }

        /* ================================
          MAIN WRAPPER
       ================================= */

        .maintenance-wrapper {
            min-height: calc(100vh - 120px);

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 40px 20px;

            position: relative;
            z-index: 2;
        }

        /* ================================
          CARD
       ================================= */

        .maintenance-card {

            width: 100%;
            max-width: 950px;

            border-radius: 24px;

            background: rgba(255, 255, 255, 0.97);

            box-shadow:
                0 30px 80px rgba(0, 0, 0, .35);

            overflow: hidden;

            display: grid;
            grid-template-columns: 1fr 1.2fr;
        }

        /* ================================
          LEFT
       ================================= */

        .maintenance-left {

            padding: 60px 45px;

            color: #ffffff;

            background:
                linear-gradient(160deg,
                    #075985,
                    #0f766e);

            position: relative;

            overflow: hidden;
        }

        .maintenance-left::before {

            content: "";

            position: absolute;

            width: 300px;
            height: 300px;

            border-radius: 50%;

            background: rgba(255, 255, 255, .08);

            top: -120px;
            left: -100px;
        }

        .maintenance-left::after {

            content: "";

            position: absolute;

            width: 250px;
            height: 250px;

            border-radius: 50%;

            border: 40px solid rgba(255, 255, 255, .04);

            bottom: -100px;
            right: -100px;
        }

        .logo-area {

            position: relative;

            z-index: 2;

            display: flex;
            align-items: center;

            margin-bottom: 55px;
        }

        .logo-icon {

            width: 58px;
            height: 58px;

            display: flex;

            align-items: center;
            justify-content: center;

            background: rgba(255, 255, 255, .15);

            border: 1px solid rgba(255, 255, 255, .25);

            border-radius: 16px;

            font-size: 26px;

            margin-right: 15px;
        }

        .brand-name {

            font-size: 25px;

            font-weight: 800;

            letter-spacing: 1px;
        }

        .brand-description {

            font-size: 12px;

            opacity: .75;

            margin-top: 3px;

            line-height: 1.5;
        }

        .vehicle-area {

            position: relative;

            z-index: 2;

            text-align: center;

            margin-top: 30px;
        }

        .vehicle-icon {

            font-size: 120px;

            color: rgba(255, 255, 255, .95);

            animation: floatTruck 3s ease-in-out infinite;
        }

        @keyframes floatTruck {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .system-status {

            margin-top: 35px;

            text-align: center;

            font-size: 13px;

            color: rgba(255, 255, 255, .8);
        }

        .status-dot {

            display: inline-block;

            width: 8px;
            height: 8px;

            border-radius: 50%;

            background: #facc15;

            margin-right: 7px;

            box-shadow:
                0 0 0 5px rgba(250, 204, 21, .15);
        }

        /* ================================
          RIGHT
       ================================= */

        .maintenance-right {

            padding: 65px 60px;

            display: flex;

            flex-direction: column;

            justify-content: center;
        }

        .maintenance-badge {

            display: inline-flex;

            align-items: center;

            width: fit-content;

            padding: 8px 14px;

            border-radius: 30px;

            background: #fff7ed;

            color: #ea580c;

            font-size: 12px;

            font-weight: 700;

            letter-spacing: .5px;

            margin-bottom: 25px;
        }

        .maintenance-badge i {

            margin-right: 8px;
        }

        h1 {

            margin: 0;

            color: #16324f;

            font-size: 32px;

            line-height: 1.3;

            font-weight: 800;
        }

        .maintenance-text {

            margin-top: 22px;

            color: #64748b;

            font-size: 15px;

            line-height: 1.8;
        }

        /* ================================
          INFO BOX
       ================================= */

        .info-box {

            margin-top: 30px;

            padding: 20px;

            border-radius: 15px;

            background: #f8fafc;

            border: 1px solid #e2e8f0;

            display: flex;

            align-items: flex-start;
        }

        .info-icon {

            width: 42px;
            height: 42px;

            flex-shrink: 0;

            border-radius: 12px;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #e0f2fe;

            color: #0284c7;

            margin-right: 15px;
        }

        .info-content h5 {

            margin: 0 0 5px;

            color: #334155;

            font-size: 14px;
        }

        .info-content p {

            margin: 0;

            color: #64748b;

            font-size: 12px;

            line-height: 1.6;
        }

        /* ================================
          FOOTER
       ================================= */

        .footer-text {

            margin-top: 35px;

            font-size: 12px;

            color: #94a3b8;

            border-top: 1px solid #e2e8f0;

            padding-top: 20px;
        }

        .footer-text strong {

            color: #475569;
        }

        /* ================================
          RESPONSIVE
       ================================= */

        @media (max-width: 768px) {

            .road-line {
                height: 70px;
            }

            .maintenance-wrapper {

                min-height: calc(100vh - 70px);

                padding: 25px 15px;
            }

            .maintenance-card {

                grid-template-columns: 1fr;
            }

            .maintenance-left {

                padding: 35px 30px;
            }

            .logo-area {

                margin-bottom: 25px;
            }

            .vehicle-icon {

                font-size: 75px;
            }

            .vehicle-area {

                margin-top: 10px;
            }

            .system-status {

                margin-top: 20px;
            }

            .maintenance-right {

                padding: 40px 30px;
            }

            h1 {

                font-size: 25px;
            }
        }
    </style>

</head>

<body>


    {{-- JALAN --}}
    <div class="road-line"></div>


    <div class="maintenance-wrapper">

        <div class="maintenance-card">


            {{-- ===================================
                BAGIAN KIRI
           ==================================== --}}

            <div class="maintenance-left">


                <div class="logo-area">

                    <div class="logo-icon">
                        <i class="fas fa-truck"></i>
                    </div>


                    <div>

                        <div class="brand-name">
                            SIPORA
                        </div>

                        <div class="brand-description">

                            Sistem Informasi Pengawasan<br>
                            Angkutan Orang dan Barang

                        </div>

                    </div>

                </div>


                <div class="vehicle-area">

                    <div class="vehicle-icon">

                        <i class="fas fa-truck-moving"></i>

                    </div>


                    <div class="system-status">

                        <span class="status-dot"></span>

                        Sedang dilakukan pemeliharaan sistem

                    </div>

                </div>


            </div>


            {{-- ===================================
                BAGIAN KANAN
           ==================================== --}}

            <div class="maintenance-right">


                <div class="maintenance-badge">

                    <i class="fas fa-tools"></i>

                    SYSTEM MAINTENANCE

                </div>


                <h1>

                    {{ $maintenance->judul ?? 'Sistem Sedang Dalam Pemeliharaan' }}

                </h1>


                <div class="maintenance-text">

                    {{ $maintenance->pesan ??
                        'Kami sedang melakukan pemeliharaan dan peningkatan layanan SIPORA agar sistem dapat memberikan pelayanan yang lebih baik.' }}

                </div>


                <div class="info-box">

                    <div class="info-icon">

                        <i class="fas fa-info-circle"></i>

                    </div>


                    <div class="info-content">

                        <h5>
                            Mohon Menunggu
                        </h5>

                        <p>

                            Sistem sedang dalam proses pembaruan.
                            Silakan kembali dan coba beberapa saat lagi.

                        </p>

                    </div>

                </div>


                <div class="footer-text">

                    <strong>SIPORA</strong>

                    &nbsp;•&nbsp;

                    Sistem Informasi Pengawasan Angkutan Orang dan Barang

                    <br><br>

                    © {{ date('Y') }}
                    Pemerintah Provinsi Sumatera Selatan

                </div>


            </div>

        </div>

    </div>


</body>

</html>
