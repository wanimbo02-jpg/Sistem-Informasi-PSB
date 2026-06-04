<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - SMA Negeri Karubaga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #c7cad7 0%, #a5d1d8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .verification-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 450px;
            width: 100%;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .verification-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .verification-icon {
            width: 90px;
            height: 90px;
            border-radius: 10px;  
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            background: white;
        }
        
           .verification-icon img {
           width: 100%;
           height: 100%;
           object-fit: contain;    /* contain biar gambar utuh, atau cover biar penuh */
           border-radius: 0px;     /* HAPUS BULAT - ganti 0px */
           display: block;
         }
        
        .verification-icon i {
            color: white;
            font-size: 36px;
        }
        
        .email-display {
            background: #f8f9fa;
            border: 2px dashed #6c63ff;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            margin: 20px 0;
        }
        
        .code-input-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin: 25px 0;
        }
        
        .code-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .code-input:focus {
            border-color: #6c63ff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.1);
            transform: translateY(-2px);
        }
        
        .btn-verify {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }
        
        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .btn-resend {
            background: transparent;
            border: 2px solid #6c63ff;
            color: #6c63ff;
            padding: 10px 25px;
            border-radius: 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-resend:hover {
            background: #6c63ff;
            color: white;
            transform: translateY(-2px);
        }
        
        .back-to-login {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }
        
        .back-to-login a {
            color: #6c63ff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .back-to-login a:hover {
            color: #764ba2;
        }
        
        .alert-custom {
            border-radius: 15px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
        }
        
        .alert-success-custom {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        .info-text {
            color: #6c757d;
            font-size: 14px;
            text-align: center;
            margin: 15px 0;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>
    <div class="verification-container">
        <!-- Success Alert -->
        @if(session('success'))
            <div class="alert alert-success alert-custom alert-success-custom alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <!-- Error Alert -->
        @if(session('error'))
            <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <!-- Warning Alert -->
        @if(session('warning'))
            <div class="alert alert-warning alert-custom alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>{{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <div class="verification-header">
       <div class="logo-wrapper">
    <img src="{{ asset('images/habelogo.jpg') }}" alt="Logo SMA Negeri Karubaga" class="logo-img"style="width: 120px; height: auto;"></div>
      <h3 class="mb-3">Verifikasi Email SMAN Karubaga</h3>
        <p class="text-muted">Masukkan kode 6 digit yang telah dikirim ke email Anda</p>
          </div>
        <!-- Email Display -->
        <div class="email-display">
            <p class="mb-1 text-muted small">Kode verifikasi dikirim ke:</p>
            <p class="mb-0 fw-bold text-primary">
                <i class="fas fa-envelope me-2"></i>{{ $email ?: session('verification_email') ?: 'your-email@example.com' }}
            </p>
        </div>
        <!-- Verification Form -->
           <form action="{{ route('verify.code') }}" method="POST" class="verification-form">
             @csrf
              <div class="code-input-group">
                <input type="text" name="code[]" class="code-input" maxlength="1" pattern="[0-9]" required>
                <input type="text" name="code[]" class="code-input" maxlength="1" pattern="[0-9]" required>
                <input type="text" name="code[]" class="code-input" maxlength="1" pattern="[0-9]" required>
                <input type="text" name="code[]" class="code-input" maxlength="1" pattern="[0-9]" required>
                <input type="text" name="code[]" class="code-input" maxlength="1" pattern="[0-9]" required>
                <input type="text" name="code[]" class="code-input" maxlength="1" pattern="[0-9]" required>
                <input type="hidden" name="code" id="full-code" required>
            </div>
            <button type="submit" class="btn btn-verify">
                <i class="fas fa-check-circle me-2"></i>Kirim
            </button>
         </form>
        <div class="info-text">
            <i class="fas fa-info-circle me-1"></i>
            Tidak menerima kode? <a href="#" onclick="resendCode()" class="text-primary fw-bold">Kirim Ulang Kode</a>
        </div>
        <div class="back-to-login">
            <a href="{{ route('register') }}">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Halaman register
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-focus next input
        document.querySelectorAll('.code-input').forEach((input, index) => {
            input.addEventListener('input', function() {
                if (this.value.length === 1) {
                    if (index < 5) {
                        document.querySelectorAll('.code-input')[index + 1].focus();
                    }
                }
                updateFullCode();
            });
            
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && this.value === '' && index > 0) {
                    document.querySelectorAll('.code-input')[index - 1].focus();
                }
            });
            
            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text').slice(0, 6);
                const digits = pastedData.split('');
                digits.forEach((digit, i) => {
                    if (i < 6 && /^\d$/.test(digit)) {
                        document.querySelectorAll('.code-input')[i].value = digit;
                    }
                });
                updateFullCode();
                if (digits.length >= 6) {
                    document.querySelector('.btn-verify').focus();
                }
            });
        });
        
        function updateFullCode() {
            const codeInputs = document.querySelectorAll('.code-input');
            const fullCode = Array.from(codeInputs).map(input => input.value).join('');
            document.getElementById('full-code').value = fullCode;
        }
        
        function resendCode() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('verify.resend') }}';
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);
            
            document.body.appendChild(form);
            form.submit();
        }
        
        // Focus first input on load
        window.addEventListener('load', () => {
            document.querySelector('.code-input').focus();
        });
    </script>
</body>
</html>
