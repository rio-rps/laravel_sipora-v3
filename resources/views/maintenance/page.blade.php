<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/logo_dishub.jpg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/logo_dishub.jpg') }}">
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
                linear-gradient(135deg,
                    #071c33 0%,
                    #0d3558 50%,
                    #0b5a78 100%);
        }

        /* ================================
           JALAN
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

            display: grid;
            grid-template-columns: 1fr 1.2fr;

            overflow: hidden;

            border-radius: 24px;

            background: rgba(255, 255, 255, 0.97);

            box-shadow:
                0 30px 80px rgba(0, 0, 0, .35);
        }

        /* ================================
           LEFT - SIPORA
        ================================= */

        .maintenance-left {
            padding: 50px 40px;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            text-align: center;

            color: #ffffff;

            background:
                linear-gradient(160deg,
                    #071c33 0%,
                    #0b3558 50%,
                    #075985 100%);

            position: relative;
            overflow: hidden;
        }

        .maintenance-left::before {
            content: "";

            position: absolute;

            width: 300px;
            height: 300px;

            top: -120px;
            left: -100px;

            border-radius: 50%;

            background: rgba(255, 255, 255, .08);
        }

        .maintenance-left::after {
            content: "";

            position: absolute;

            width: 250px;
            height: 250px;

            right: -100px;
            bottom: -100px;

            border-radius: 50%;

            border: 40px solid rgba(255, 255, 255, .04);
        }

        .sipora-logo-area {
            position: relative;
            z-index: 2;
        }

        .sipora-logo {
            width: 180px;
            max-width: 80%;
            height: auto;

            display: block;

            margin: 0 auto 25px;
        }

        .sipora-name {
            font-size: 30px;
            font-weight: 800;
            letter-spacing: 2px;

            margin-bottom: 8px;
        }

        .sipora-description {
            font-size: 12px;
            line-height: 1.6;

            color: rgba(255, 255, 255, .78);
        }

        .system-status {
            position: relative;
            z-index: 2;

            margin-top: 45px;

            font-size: 12px;

            color: rgba(255, 255, 255, .75);
        }

        .status-dot {
            display: inline-block;

            width: 8px;
            height: 8px;

            margin-right: 7px;

            border-radius: 50%;

            background: #facc15;

            box-shadow:
                0 0 0 5px rgba(250, 204, 21, .15);
        }

        /* ================================
           RIGHT - CONTENT
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

            margin-bottom: 25px;

            border-radius: 30px;

            background: #fff7ed;
            color: #ea580c;

            font-size: 12px;
            font-weight: 700;
            letter-spacing: .5px;
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

            display: flex;
            align-items: flex-start;

            border-radius: 15px;

            background: #f8fafc;

            border: 1px solid #e2e8f0;
        }

        .info-icon {
            width: 42px;
            height: 42px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-right: 15px;

            border-radius: 12px;

            background: #e0f2fe;
            color: #0284c7;
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
            padding-top: 20px;

            color: #94a3b8;

            font-size: 12px;

            border-top: 1px solid #e2e8f0;
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

            .sipora-logo {
                width: 140px;
                margin-bottom: 20px;
            }

            .sipora-name {
                font-size: 25px;
            }

            .system-status {
                margin-top: 25px;
            }

            .maintenance-right {
                padding: 40px 30px;
            }

            h1 {
                font-size: 25px;
            }
        }
    </style>
    <style>
        .status-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            margin-right: 7px;
            border-radius: 50%;
            background: #facc15;

            animation: statusPulse 1.8s infinite;
        }

        @keyframes statusPulse {
            0% {
                box-shadow: 0 0 0 0 rgba(250, 204, 21, .6);
            }

            70% {
                box-shadow: 0 0 0 8px rgba(250, 204, 21, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(250, 204, 21, 0);
            }
        }
    </style>

    <style>
        .info-box {
            animation: infoFloat 3s ease-in-out infinite;
        }

        .info-icon i {
            animation: infoPulse 2s ease-in-out infinite;
        }

        @keyframes infoFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        @keyframes infoPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.12);
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

                <div class="sipora-logo-area">

                    <img src="{{ asset('images/logo/logo_prov1.png') }}" alt="Pemerintah Provinsi Sumatera Selatan"
                        class="sipora-logo">

                    <div class="sipora-name">
                        SIPORA
                    </div>

                    <div class="sipora-description">
                        Sistem Informasi Pengawasan Angkutan Orang dan Barang
                        <br>
                        Provinsi Sumatera Selatan
                    </div>

                </div>

                <div class="system-status">
                    <span class="status-dot"></span>
                    Sedang dilakukan pemeliharaan sistem
                </div>

            </div>


            {{-- ===================================
                 BAGIAN KANAN
            ==================================== --}}

            <div class="maintenance-right">

                {{--  <div class="maintenance-badge">
                    <i class="fas fa-tools"></i>
                    Pemberitahuan
                </div>  --}}

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

                    <div class="info-content ">

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

                    <strong>
                        © 2024 - {{ date('Y') }}
                        SIPORA</strong><br>
                    Dikelola Oleh Dinas Perhubungan Provinsi Sumatera Selatan

                </div>

            </div>

        </div>

    </div>

</body>

</html>
