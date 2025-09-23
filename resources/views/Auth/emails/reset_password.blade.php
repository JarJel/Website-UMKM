<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body style="font-family:Arial, sans-serif; background-color:#f4f4f7; margin:0; padding:0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f7; padding:40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:10px; padding:40px; box-shadow:0 4px 12px rgba(0,0,0,0.1);">
                    <tr>
                        <td style="text-align:center;">
                            <h2 style="color:#333333; font-size:24px; margin-bottom:20px;">Reset Password Anda</h2>
                            <p style="color:#555555; font-size:16px; line-height:1.5; margin-bottom:30px;">
                                Halo, klik tombol di bawah untuk membuat password baru:
                            </p>
                            <a href="{{ $url }}" 
                               style="display:inline-block; background-color:#1a73e8; color:white; padding:12px 25px; text-decoration:none; border-radius:6px; font-weight:bold; font-size:16px;">
                                Reset Password
                            </a>
                            <p style="color:#888888; font-size:14px; line-height:1.5; margin-top:30px;">
                                Jika Anda tidak meminta reset password, abaikan email ini.
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
