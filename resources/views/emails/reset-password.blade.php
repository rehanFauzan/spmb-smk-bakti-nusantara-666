<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - SPMB SMK Bakti Nusantara 666</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #3F72AF; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 8px 8px; }
        .button { display: inline-block; background: #3F72AF; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Reset Password</h1>
            <p>SPMB SMK Bakti Nusantara 666</p>
        </div>
        
        <div class="content">
            <p>Halo <strong>{{ $name }}</strong>,</p>
            
            <p>Kami menerima permintaan untuk mereset password akun SPMB Anda. Klik tombol di bawah ini untuk membuat password baru:</p>
            
            <div style="text-align: center;">
                <a href="{{ $resetUrl }}" class="button">Reset Password</a>
            </div>
            
            <p>Atau salin dan tempel link berikut di browser Anda:</p>
            <p style="word-break: break-all; background: #eee; padding: 10px; border-radius: 4px;">{{ $resetUrl }}</p>
            
            <p><strong>Catatan Penting:</strong></p>
            <ul>
                <li>Link ini hanya berlaku selama 24 jam</li>
                <li>Jika Anda tidak meminta reset password, abaikan email ini</li>
                <li>Jangan bagikan link ini kepada siapa pun</li>
            </ul>
            
            <p>Jika Anda mengalami kesulitan, hubungi kami di:</p>
            <p>📞 (022) 8765-4321<br>📧 info@smkbn666.sch.id</p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} SMK Bakti Nusantara 666. All rights reserved.</p>
            <p>Jl. Percobaan, Cileunyi, Bandung, Jawa Barat 40393</p>
        </div>
    </div>
</body>
</html>