<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PPDB SMAN Karubaga (Admin/Guru/Siswa)</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

    body {
        min-height: 100vh;
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/Home/Barisan.jpg') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        font-family: 'Segoe UI', 'Poppins', system-ui, -apple-system, sans-serif;
         }

        /* Card Utama */
        .login-card {
            max-width: 460px;
            width: 100%;
            background: white;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-4px);
        }

        /* Header dengan warna seragam biru */
        .card-header-custom {
            background: linear-gradient(135deg, #1e3a8a, #2563eb, #1e40af);
            text-align: center;
            padding: 28px 20px 24px;
            border-bottom: none;
        }

        /* Logo tampil biasa (TANPA border bulat, TANPA background icon) */
        .logo-wrapper {
            margin-bottom: 16px;
        }

        .logo-img {
            width: 140px;
            height: auto;
            object-fit: contain;
            display: block;
            margin: 0 auto;
            /* Tidak ada border-radius, tidak ada border, tidak ada padding */
        }

        /* Tulisan SMAN KARUBAGA yang UNIK & MENARIK */
        .school-name {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff, #f0f9ff);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: 1.5px;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.15);
            margin: 12px 0 5px;
            word-break: keep-all;
        }

        .school-tagline {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.85rem;
            font-weight: 500;
            margin-top: 6px;
            letter-spacing: 0.5px;
        }

        /* Body Form */
        .card-body-custom {
            padding: 32px 28px;
            background: white;
        }

        /* Input group dengan ikon */
        .input-group-custom {
            position: relative;
            margin-bottom: 22px;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #5b6e8c;
            z-index: 2;
            font-size: 1.1rem;
        }

        .form-control-custom {
            width: 100%;
            padding: 14px 16px 14px 48px;
            font-size: 1rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            background: white;
        }

        /* Checkbox Lihat Password (Kotak Centang Biru) */
        .checkbox-show-password {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 26px;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-show-password input {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #1e3a8a;
            margin: 0;
        }

        .checkbox-show-password label {
            margin: 0;
            font-size: 0.9rem;
            color: #1e293b;
            cursor: pointer;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-show-password label i {
            color: #3b82f6;
            font-size: 0.9rem;
        }

        /* Tombol Login */
        .btn-login-custom {
            width: 100%;
            padding: 14px;
            font-size: 1.05rem;
            font-weight: 700;
            border: none;
            border-radius: 40px;
            background: linear-gradient(90deg, #1e3a8a, #3b82f6);
            color: white;
            transition: all 0.3s ease;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-login-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(37, 99, 235, 0.3);
            background: linear-gradient(90deg, #172554, #2563eb);
        }

        /* Footer Link: Buat Akun & Lupa Password (BESAR & MENONJOL) */
        .login-footer-custom {
            text-align: center;
            border-top: 1px solid #e2e8f0;
            padding-top: 24px;
            margin-top: 8px;
            display: flex;
            justify-content: center;
            gap: 28px;
            flex-wrap: wrap;
        }

        .footer-link {
            font-size: 1rem;
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 40px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .footer-link-register {
            background: #eff6ff;
            color: #1e3a8a;
            border: 1px solid #bfdbfe;
        }

        .footer-link-register:hover {
            background: #dbeafe;
            color: #0f2b6d;
            transform: translateY(-2px);
        }

        .footer-link-forgot {
            background: #f8fafc;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .footer-link-forgot:hover {
            background: #f1f5f9;
            color: #1e3a8a;
            transform: translateY(-2px);
        }

        /* Alert styling */
        .alert-custom {
            border-radius: 18px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            padding: 12px 18px;
        }

        @media (max-width: 480px) {
            .card-body-custom { padding: 24px 20px; }
            .school-name { font-size: 1.65rem; }
            .logo-img { width: 100px; }
            .footer-link { font-size: 0.85rem; padding: 6px 12px; }
            .login-footer-custom { gap: 16px; }
        }
    </style>
</head>
<body>

<div class="login-card">
    <!-- HEADER BIRU SERAGAM DENGAN LOGO TAMPIL BIASA (TIDAK DALAM ICON/BULAT) -->
    <div class="card-header-custom">
        <div class="logo-wrapper">
            <img src="{{ asset('images/habelogo.jpg') }}" alt="Logo SMA Negeri Karubaga" class="logo-img">
        </div>
        <h1 class="school-name">SMAN KARUBAGA</h1>
        <p class="school-tagline">✧Masukkan NISN Anda✧</p>
    </div>

    <!-- BODY FORM -->
    <div class="card-body-custom">

        @if ($errors->any())
        <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            @if ($errors->has('verifikasi'))
                {{ $errors->first('verifikasi') }}
                <br><a href="{{ route('verify.before.login') }}" class="fw-bold text-danger">
                    <i class="fas fa-envelope me-1"></i> Klik di sini untuk verifikasi sekarang
                </a>
            @else
                {{ $errors->first() }}
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if (session('status'))
        <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm" autocomplete="off">
            @csrf

            <!-- Field NIK / NISN -->
            <div class="input-group-custom">
                <i class="fas fa-id-card input-icon"></i>
                <input type="text" name="nik" class="form-control-custom @error('nik') is-invalid @enderror"
                       placeholder="Masukkan NISN Anda" 
                       value="" maxlength="20" pattern="\d*" required autofocus autocomplete="off">
                @error('nik')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Field Password -->
            <div class="input-group-custom">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password" id="passwordField" 
                       class="form-control-custom @error('password') is-invalid @enderror"
                       placeholder="Masukkan Password" required autocomplete="new-password">
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- KOTAK CENTANG LIHAT PASSWORD (BIRU) -->
            <div class="checkbox-show-password">
                <input type="checkbox" id="showPasswordCheckbox">
                <label for="showPasswordCheckbox">
                    <!-- <i class="fas fa-eye"></i> Lihat Password -->
                </label>
            </div>

            <!-- Tombol Login -->
            <button type="submit" class="btn-login-custom" id="submitBtn">
                <i class="fas fa-sign-in-alt"></i> MASUK
            </button>

            <!-- Link Buat Akun & Lupa Password (BESAR, TIDAK KECIL) -->
            <div class="login-footer-custom">
                <a href="{{ route('register') }}" class="footer-link footer-link-register">
                    <i class="fas fa-user-plus"></i> Daftar Siswa Baru
                </a>
                <a href="{{ route('password.request') }}" class="footer-link footer-link-forgot">
                    <i class="fas fa-key"></i> Reset Password
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Loading saat submit form
    document.getElementById('loginForm')?.addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
    });

    // Hanya angka untuk NIK
    document.querySelector('input[name="nik"]')?.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // FITUR LIHAT PASSWORD dengan KOTAK CENTANG
    const showPasswordCheck = document.getElementById('showPasswordCheckbox');
    const passwordInput = document.getElementById('passwordField');

    if (showPasswordCheck && passwordInput) {
        showPasswordCheck.addEventListener('change', function() {
            passwordInput.type = this.checked ? 'text' : 'password';
        });
    }
</script>

</body>
</html>