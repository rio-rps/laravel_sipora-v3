<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>500 | Terjadi Kesalahan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .error-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .error-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .1);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            font-size: 72px;
            color: #dc3545;
            margin-bottom: 10px;
        }

        h2 {
            margin-bottom: 15px;
            color: #343a40;
        }

        p {
            color: #6c757d;
            margin-bottom: 25px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background: #0d6efd;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background: #0b5ed7;
        }
    </style>
</head>

<body>

    <div class="error-container">
        <div class="error-box">
            <h1>500</h1>
            <h2>Terjadi Kesalahan Sistem</h2>
            <p>
                Maaf, saat ini sistem sedang mengalami gangguan atau data tidak dapat ditemukan.<br>
                Silakan coba beberapa saat lagi atau hubungi administrator.
            </p>
            <a href="{{ url('/') }}">Kembali ke Beranda</a>
        </div>
    </div>

</body>

</html>
