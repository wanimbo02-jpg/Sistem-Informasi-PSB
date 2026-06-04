<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Selesai - PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #c0c2d3 0%, #a5bcc2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
        }
        .success-card {
            background: white;
            border-radius: 20px;
            padding: 50px;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        .success-icon {
            font-size: 100px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .success-icon i {
            font-size: 100px;
        }
        h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #333;
        }
        p {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            border-radius: 8px;
            margin: 25px 0;
            text-align: left;
        }
        .btn-logout {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 12px 40px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="success-icon">
            <i class="fas fa-check-circle text-success"></i>
        </div>
        <h2>Pendaftaran Berhasil!</h2>
        <p>Terima kasih telah menyelesaikan pendaftaran PPDB Online.</p>
        
        <div class="info-box">
            <p class="mb-2"><strong>Informasi Penting:</strong></p>
            <ul class="mb-0">
                <li>Data Anda telah berhasil terkirim</li>
                <li>Sistem akan memverfikasi berkas berkas anda</li>
                <li>Anda diminta untuk agar mengecek informasih</li>
                <li>melalui Dashboard siswa yang sudah anda mendaftar</li>
                <li>Pengumuman akan diinformasikan melalui</li>
                <li>Dashboard siswa maupun web kami PPDB SMAN Karubaga</li>
            </ul>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt me-2"></i>Logout & Selesai
            </button>
        </form>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
</body>
</html>