<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Reset Password - SIPORA</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0"
        style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <tr>
            <td style="text-align: center;">
                <h2 style="color: #2c3e50;">Permintaan Reset Password</h2>
                <p style="color: #555;">Kami menerima permintaan untuk mereset password di aplikasi SIPORA -
                    Dinas Perhubungan Prov. Sumsel.<br>
                    Email: {{ $email }}
                </p>
                <p style="margin: 30px 0;">
                    <a href="{{ $url }}"
                        style="background-color: #28a745; color: #fff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                        Reset Password Sekarang
                    </a>
                </p>
                <p style="color: #777;">Jika Anda tidak meminta reset password, abaikan email ini.
                    <br>Password Anda tetap aman.
                </p>
                <hr style="margin: 30px 0;">
                <p style="font-size: 14px; color: #999;">
                    Salam hormat,<br>
                    <strong>Tim SIPORA</strong><br>
                    Dinas Perhubungan Provinsi Sumatera Selatan<br>
                    Telp: (0711) 352005 / 363125
                </p>
            </td>
        </tr>
    </table>
</body>

</html>
