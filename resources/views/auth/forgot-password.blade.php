<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - PPDB SMA Negeri Karubaga</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #e2e2e2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            font-family: system-ui, -apple-system, sans-serif;
        }

        .card {
            max-width: 420px;
            width: 100%;
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }

        .card-header {
            background: white;
            text-align: center;
            padding: 30px 20px 20px;
            border-bottom: 1px solid #eee;
        }

        .card-header h2 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .card-header p {
            margin: 8px 0 0;
            color: #7f8c8d;
            font-size: 0.95rem;
        }

        .card-body {
            padding: 30px 24px;
            background: white;
        }

        .info-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 1.5rem;
            text-align: center;
            border-left: 4px solid #667eea;
        }

        .info-box i {
            font-size: 2.2rem;
            color: #667eea;
            margin-bottom: 12px;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-group i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            z-index: 2;
        }

        .form-control {
            padding-left: 48px !important;
            height: 52px;
            border-radius: 10px;
            border: 1px solid #ced4da;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102,126,234,0.15);
        }

        .btn-reset {
            height: 52px;
            font-weight: 600;
            border-radius: 10px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border: none;
            transition: all 0.25s;
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102,126,234,0.3);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .card-body { padding: 24px 18px; }
            .card-header { padding: 24px 18px 18px; }
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h2>SMA Negeri Karubaga</h2>
        <p>PPDB Online - Reset Password</p>
    </div>

    <div class="card-body">

        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="info-box">
            <i class="fas fa-envelope-open-text"></i>
            <p class="mb-1">Masukkan email terdaftar Anda</p>
            <small class="text-muted">Kami akan mengirimkan tautan reset password</small>
        </div>

        <form method="POST" action="{{ route('password.email') }}" id="forgotForm">
            @csrf

            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       placeholder="Email Anda" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-reset text-white w-100" id="submitBtn">
                <i class="fas fa-paper-plane me-2"></i> Kirim Tautan Reset
            </button>

            <a href="{{ route('login') }}" class="back-link">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Login
            </a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Simple loading feedback saat submit
document.getElementById('forgotForm')?.addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mengirim...';
});
</script>

</body>
</html>
