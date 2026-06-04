<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - PPDB SMA Negeri Karubaga</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .reset-card {
            max-width: 460px;
            width: 100%;
            background: white;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        /* Header biru sama seperti login */
        .card-header-custom {
            background: linear-gradient(135deg, #1e3a8a, #2563eb, #1e40af);
            text-align: center;
            padding: 32px 20px 28px;
        }

        .header-icon {
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .header-icon i {
            font-size: 2rem;
            color: white;
        }

        .card-header-custom h1 {
            font-size: 1.6rem;
            font-weight: 800;
            color: white;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .card-header-custom p {
            color: rgba(255,255,255,0.85);
            font-size: 0.9rem;
        }

        /* Body */
        .card-body-custom {
            padding: 32px 28px;
        }

        /* Input group */
        .input-group-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #5b6e8c;
            z-index: 2;
            font-size: 1rem;
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
            box-shadow: 0 0 0 4px rgba(37,99,235,0.1);
            background: white;
        }

        .form-control-custom.is-invalid {
            border-color: #dc3545;
        }

        /* Label */
        .field-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
            display: block;
        }

        /* Tombol submit */
        .btn-reset-custom {
            width: 100%;
            padding: 14px;
            font-size: 1.05rem;
            font-weight: 700;
            border: none;
            border-radius: 40px;
            background: linear-gradient(90deg, #1e3a8a, #3b82f6);
            color: white;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 5px 12px rgba(0,0,0,0.1);
            cursor: pointer;
        }

        .btn-reset-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(37,99,235,0.3);
            background: linear-gradient(90deg, #172554, #2563eb);
        }

        .btn-reset-custom:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        /* Back link */
        .back-link {
            display: block;
            text-align: center;
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 8px;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .back-link:hover {
            background: #eff6ff;
            color: #1e3a8a;
        }

        /* Alert */
        .alert-custom {
            border-radius: 14px;
            font-size: 0.88rem;
            margin-bottom: 20px;
            padding: 12px 16px;
        }

        /* Password strength indicator */
        .password-strength {
            height: 4px;
            border-radius: 2px;
            margin-top: 6px;
            transition: all 0.3s;
            background: #e2e8f0;
        }

        .strength-weak   { background: #ef4444; width: 33%; }
        .strength-medium { background: #f59e0b; width: 66%; }
        .strength-strong { background: #10b981; width: 100%; }

        .strength-text {
            font-size: 0.75rem;
            margin-top: 4px;
        }

        @media (max-width: 480px) {
            .card-body-custom { padding: 24px 18px; }
            .card-header-custom h1 { font-size: 1.3rem; }
        }
    </style>
</head>
<body>

<div class="reset-card">

    {{-- Header --}}
    <div class="card-header-custom">
        <div class="header-icon">
            <i class="fas fa-key"></i>
        </div>
        <h1>SMAN KARUBAGA</h1>
        <p>✧ Atur Ulang Kata Sandi ✧</p>
    </div>

    {{-- Body --}}
    <div class="card-body-custom">

        {{-- Error --}}
        @if ($errors->any())
        <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- Success --}}
        @if (session('status'))
        <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" id="resetForm" autocomplete="off">
            @csrf

            {{-- Token tersembunyi --}}
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Email (readonly, sudah terisi dari link) --}}
            <div class="input-group-custom">
                <label class="field-label">Email</label>
                <i class="fas fa-envelope input-icon" style="top: calc(50% + 12px);"></i>
                <input type="email"
                       name="email"
                       class="form-control-custom @error('email') is-invalid @enderror"
                       value="{{ $email ?? old('email') }}"
                       placeholder="Email Anda"
                       readonly
                       style="background: #f1f5f9; color: #64748b;">
                @error('email')
                    <div class="invalid-feedback d-block" style="font-size:0.8rem; color:#dc3545; margin-top:4px;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Password Baru --}}
            <div class="input-group-custom">
                <label class="field-label">Password Baru</label>
                <i class="fas fa-lock input-icon" style="top: calc(50% + 12px);"></i>
                <input type="password"
                       name="password"
                       id="passwordField"
                       class="form-control-custom @error('password') is-invalid @enderror"
                       placeholder="Masukkan password baru (min. 8 karakter)"
                       required
                       autocomplete="new-password"
                       oninput="checkStrength(this.value)">
                <div class="password-strength" id="strengthBar"></div>
                <div class="strength-text text-muted" id="strengthText"></div>
                @error('password')
                    <div class="invalid-feedback d-block" style="font-size:0.8rem; color:#dc3545; margin-top:4px;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="input-group-custom">
                <label class="field-label">Konfirmasi Password Baru</label>
                <i class="fas fa-lock input-icon" style="top: calc(50% + 12px);"></i>
                <input type="password"
                       name="password_confirmation"
                       id="confirmField"
                       class="form-control-custom"
                       placeholder="Ulangi password baru"
                       required
                       autocomplete="new-password">
                <div class="strength-text" id="matchText"></div>
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="btn-reset-custom" id="submitBtn">
                <i class="fas fa-save"></i> Simpan Password Baru
            </button>

            {{-- Kembali ke Login --}}
            <a href="{{ route('login') }}" class="back-link">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Login
            </a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Indikator kekuatan password
function checkStrength(val) {
    const bar  = document.getElementById('strengthBar');
    const text = document.getElementById('strengthText');
    bar.className = 'password-strength';
    if (val.length === 0) { text.textContent = ''; return; }
    if (val.length < 6) {
        bar.classList.add('strength-weak');
        text.textContent = 'Lemah'; text.style.color = '#ef4444';
    } else if (val.length < 10) {
        bar.classList.add('strength-medium');
        text.textContent = 'Sedang'; text.style.color = '#f59e0b';
    } else {
        bar.classList.add('strength-strong');
        text.textContent = 'Kuat'; text.style.color = '#10b981';
    }
    checkMatch();
}

// Cek kecocokan password
function checkMatch() {
    const pw   = document.getElementById('passwordField').value;
    const conf = document.getElementById('confirmField').value;
    const txt  = document.getElementById('matchText');
    if (conf.length === 0) { txt.textContent = ''; return; }
    if (pw === conf) {
        txt.textContent = '✓ Password cocok'; txt.style.color = '#10b981';
    } else {
        txt.textContent = '✗ Password tidak cocok'; txt.style.color = '#ef4444';
    }
}

document.getElementById('confirmField')?.addEventListener('input', checkMatch);

// Loading saat submit
document.getElementById('resetForm')?.addEventListener('submit', function(e) {
    const pw   = document.getElementById('passwordField').value;
    const conf = document.getElementById('confirmField').value;
    if (pw !== conf) {
        e.preventDefault();
        document.getElementById('matchText').textContent = '✗ Password tidak cocok';
        document.getElementById('matchText').style.color = '#ef4444';
        return;
    }
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
});
</script>

</body>
</html>
