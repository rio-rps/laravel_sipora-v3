@extends('private.layout.main')
@section('isi')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Scan QR Code</title>
        <script src="https://unpkg.com/html5-qrcode"></script>
        <style>
            #reader {
                width: 100%;
                max-width: 400px;
                margin: 30px auto;
                border-radius: 10px;
                overflow: hidden;
            }

            .result-box {
                text-align: center;
                margin-top: 15px;
            }

            input {
                text-align: center;
                font-size: 1.1rem;
                font-weight: 500;
            }
        </style>
    </head>

    <body class="bg-light">

        <div class="container py-5">
            <h4 class="text-center mb-4">📷 Scan QR Code</h4>
            <div id="reader"></div>

            <div class="result-box">
                <label for="result" class="form-label mt-3 fw-bold">Hasil Scan:</label>
                <input type="text" id="result" class="form-control text-center" readonly
                    placeholder="Arahkan kamera ke QR Code...">
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const html5QrCode = new Html5Qrcode("reader");
                const config = {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                };

                // Ambil daftar kamera
                Html5Qrcode.getCameras().then(devices => {
                    if (devices && devices.length) {
                        // Pilih kamera belakang jika tersedia
                        const backCamera = devices.find(d => d.label.toLowerCase().includes('back'))?.id ||
                            devices[0].id;

                        html5QrCode.start(
                            backCamera,
                            config,
                            qrMessage => {
                                document.getElementById('result').value = qrMessage;
                                html5QrCode.stop(); // berhenti otomatis setelah scan
                            },
                            errorMessage => {
                                console.warn("QR tidak terbaca:", errorMessage);
                            }
                        ).catch(err => console.error("Gagal memulai kamera:", err));
                    } else {
                        alert("Kamera tidak terdeteksi. Pastikan browser mengizinkan akses kamera.");
                    }
                }).catch(err => console.error("Gagal akses kamera:", err));
            });
        </script>

    </body>

    </html>
@endsection
