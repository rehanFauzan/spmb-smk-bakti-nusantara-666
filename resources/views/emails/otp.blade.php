<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kode OTP - SMK BAKTI NUSANTARA 666</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2563eb; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f8f9fa; padding: 30px; border-radius: 0 0 8px 8px; }
        .otp-box { background: white; border: 2px solid #2563eb; padding: 20px; text-align: center; margin: 20px 0; border-radius: 8px; }
        .otp-code { font-size: 32px; font-weight: bold; color: #2563eb; letter-spacing: 5px; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SMK BAKTI NUSANTARA 666</h1>
            <p>Sistem Penerimaan Peserta Didik Baru</p>
        </div>
        
        <div class="content">
            <h2>Halo, {{ $nama }}!</h2>
            
            <p>Terima kasih telah mendaftar di SMK BAKTI NUSANTARA 666. Untuk melanjutkan proses pendaftaran, silakan gunakan kode OTP berikut:</p>
            
            <div class="otp-box">
                <div class="otp-code">{{ $otp }}</div>
                <p><strong>Kode OTP berlaku selama 5 menit</strong></p>
            </div>
            
            <p><strong>Penting:</strong></p>
            <ul>
                <li>Jangan berikan kode OTP ini kepada siapapun</li>
                <li>Kode OTP hanya berlaku selama 5 menit</li>
                <li>Jika tidak melakukan pendaftaran, abaikan email ini</li>
            </ul>
            
            <p>Jika Anda mengalami kesulitan, silakan hubungi kami di:</p>
            <p>📞 (022) 8765-4321<br>
            📧 info@smkbn666.sch.id</p>
        </div>
        
        <div class="footer">
            <p>© 2025 SMK BAKTI NUSANTARA 666. Semua hak dilindungi.</p>
            <p>Jl. Percobaan, Cileunyi, Bandung, Jawa Barat 40393</p>
        </div>
    </div>
</body>
</html>