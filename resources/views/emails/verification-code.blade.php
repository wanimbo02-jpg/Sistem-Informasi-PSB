<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi - SMA Negeri Karubaga</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #007a8c;
            margin-bottom: 10px;
        }
        .code-box {
            background-color: #f8f9fa;
            border: 2px dashed #007a8c;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
            border-radius: 8px;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            color: #007a8c;
            letter-spacing: 5px;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #007a8c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">SMA Negeri Karubaga</div>
            <h2>Kode Verifikasi Email</h2>
        </div>
        
        <p>Halo,</p>
        <p>Terima kasih telah mendaftar di sistem pendaftaran SMA Negeri Karubaga. Untuk melanjutkan proses pendaftaran, silakan masukkan kode verifikasi berikut:</p>
        
        <div class="code-box">
            <p>Kode Verifikasi Anda:</p>
            <div class="code">{{ $code }}</div>
        </div>
        
        <p><strong>Catatan:</strong></p>
        <ul>
            <li>Kode ini akan kadaluarsa dalam 15 menit</li>
            <li>Jangan bagikan kode ini kepada siapa pun</li>
            <li>Jika Anda tidak mendaftar, abaikan email ini</li>
        </ul>
        
        <p>Jika Anda mengalami kesulitan, silakan hubungi admin sekolah.</p>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} SMA Negeri Karubaga. Semua hak dilindungi.</p>
            <p>Email ini dikirim secara otomatis, jangan balas email ini.</p>
        </div>
    </div>
</body>
</html>
