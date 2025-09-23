<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email</title>
</head>
<body style="font-family:Arial, sans-serif; background-color:#f4f4f7; margin:0; padding:0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f7; padding:40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:10px; padding:40px; box-shadow:0 4px 12px rgba(0,0,0,0.1);">
                    <tr>
                        <td style="text-align:center;">
                            <h2 style="color:#333333; font-size:24px; margin-bottom:20px;">Verifikasi Email Anda</h2>
                            <p style="color:#555555; font-size:16px; line-height:1.5; margin-bottom:30px;">
                                Halo {{ $nama }},<br>
                                Gunakan kode berikut untuk memverifikasi email Anda:
                            </p>
                            <div style="display:inline-block; background-color:#1a73e8; color:white; padding:15px 25px; font-size:24px; font-weight:bold; border-radius:8px; margin-bottom:30px;">
                                {{ $code }}
                            </div>
                            <p style="color:#888888; font-size:14px; line-height:1.5;">
                                Jika Anda tidak mendaftar, abaikan email ini.
                            </p>
                        </td>
                    </tr>
                </table>

                <p style="color:#aaaaaa; font-size:12px; margin-top:20px;">
                    © {{ date('Y') }} NamaAplikasi. Semua hak dilindungi.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
