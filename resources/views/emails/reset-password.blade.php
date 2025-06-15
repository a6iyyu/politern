<!DOCTYPE html>
<html>
<head>
    <title>Reset Password - POLITERN</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        .content {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #5955b2;
            color: white !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('shared/logo.png') }}" alt="POLITERN" class="logo">
        </div>
        
        <div class="content">
            <h2>Reset Password</h2>
            <p>Halo {{ $pengguna->nama_pengguna }},</p>
            
            <p>Kami menerima permintaan untuk mereset password akun Anda. Jika Anda tidak melakukan permintaan ini, Anda dapat mengabaikan email ini.</p>
            
            <p>Untuk melanjutkan proses reset password, silakan klik tombol di bawah ini:</p>
            
            <p style="text-align: center;">
                <a href="{{ url('/reset-password/' . $token) }}" class="button">Reset Password</a>
            </p>
            
            <p>Atau salin dan tempel link berikut ke browser Anda:</p>
            <p style="word-break: break-all; color: #5955b2;">{{ url('/reset-password/' . $token) }}</p>
            
            <p>Link ini akan kedaluwarsa dalam 60 menit.</p>
            
            <p>Terima kasih,<br>Tim POLITERN</p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} POLITERN. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>