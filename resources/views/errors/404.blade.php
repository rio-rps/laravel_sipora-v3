<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 | Halaman Tidak Ditemukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .error-code {
            font-size: 120px;
            font-weight: 700;
            color: #dc3545;
        }

        .error-message {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .btn-home {
            padding: 10px 20px;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="text-center">
        <div class="error-code">404</div>
        <div class="error-message">Halaman yang Anda cari tidak ditemukan</div>
        <a href="{{ url('/') }}" class="btn btn-primary btn-home">Kembali ke Beranda</a>
    </div>
</body>

</html>
