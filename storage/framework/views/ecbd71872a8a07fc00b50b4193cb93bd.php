<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Daftar Siswa Baru - PPDB SMAN Karubaga</title>
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
        
        .register-container {
            max-width: 650px;
            width: 100%;
            margin: 0 auto;
        }
        
        .register-card {
            background: white;
            border-radius: 28px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .register-card:hover {
            transform: translateY(-4px);
        }
        
        /* Header dengan warna seragam biru (sama dengan login) */
        .register-header {
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
            width: 130px;
            height: auto;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }
        
        .register-header h1 {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff, #f0f9ff);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: 1.5px;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.15);
            margin: 12px 0 5px;
        }
        
        .register-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            font-weight: 500;
            margin-top: 6px;
            letter-spacing: 0.5px;
        }
        
        /* Body Form */
        .register-body {
            padding: 32px 28px;
            background: white;
        }
        
        /* Grid 2 kolom */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 15px;
        }
        
        .form-group {
            position: relative;
            margin-bottom: 8px;
        }
        
        .form-group i {
            position: absolute;
            left: 16px;
            top: 42px;
            transform: translateY(-50%);
            color: #5b6e8c;
            font-size: 1rem;
            z-index: 1;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #1e293b;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 16px 12px 45px;
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            font-size: 0.95rem;
            transition: all 0.3s;
            background: #f9fafb;
        }
        
        .form-control:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            outline: none;
        }
        
        .form-control.is-invalid {
            border-color: #dc3545;
        }
        
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.75rem;
            margin-top: 5px;
            padding-left: 5px;
        }
        
        /* Tombol Register */
        .btn-register {
            width: 100%;
            padding: 14px;
            background: linear-gradient(90deg, #1e3a8a, #3b82f6);
            border: none;
            border-radius: 40px;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            margin: 20px 0 20px;
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(37, 99, 235, 0.3);
            background: linear-gradient(90deg, #172554, #2563eb);
        }
        
        .btn-register:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }
        
        /* Link Login (sama seperti login footer) */
        .login-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            color: #475569;
            font-size: 0.95rem;
            font-weight: 500;
        }
        
        .login-link a {
            color: #1e3a8a;
            text-decoration: none;
            font-weight: 700;
            margin-left: 8px;
            padding: 6px 14px;
            border-radius: 40px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .login-link a:hover {
            background: #dbeafe;
            color: #0f2b6d;
            transform: translateY(-2px);
            text-decoration: none;
        }
        
        /* Alert styling */
        .alert-custom {
            border-radius: 18px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            padding: 12px 18px;
        }
        
        .alert-danger-custom {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }
        
        .alert-success-custom {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }
        
        /* Untuk menghilangkan spinner di input number */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        input[type=number] {
            -moz-appearance: textfield;
        }
        
        /* Checkbox Lihat Password untuk register */
        .checkbox-show-password {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0 5px;
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
            font-size: 0.85rem;
            color: #1e293b;
            cursor: pointer;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .checkbox-show-password label i {
            color: #3b82f6;
            font-size: 0.85rem;
        }
        
        @media (max-width: 640px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .register-body {
                padding: 24px 20px;
            }
            
            .register-header h1 {
                font-size: 1.65rem;
            }
            
            .logo-img {
                width: 100px;
            }
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="register-card">
        <!-- HEADER BIRU SERAGAM DENGAN LOGO TAMPIL BIASA        -->
        <div class="register-header">
            <div class="logo-wrapper">
                <img src="<?php echo e(asset('images/habelogo.jpg')); ?>" alt="Logo SMA Negeri Karubaga" class="logo-img">
            </div>
            <h1>SMAN KARUBAGA</h1>
            <p>✧Buat Akun Baru✧</p>
        </div>

        <!-- BODY FORM -->
        <div class="register-body">

            <?php if($errors->any()): ?>
            <div class="alert alert-custom alert-danger-custom alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                silahkan masukkan nisn anda dengan benar
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <?php if(session('status')): ?>
            <div class="alert alert-custom alert-success-custom alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo e(session('status')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('register')); ?>" id="registerForm">
                <?php echo csrf_field(); ?>

                <!-- BARIS PERTAMA: NIK/NISN dan NAMA -->
                <div class="form-row">
                    <!-- NIK/NISN -->
                    <div class="form-group">
                        <label class="form-label">NISN</label>
                        <i class="fas fa-id-card"></i>
                        <input type="text" 
                               name="username" 
                               class="form-control"
                               placeholder="Masukkan NISN 10 digit" 
                               value="<?php echo e(old('username')); ?>" 
                               maxlength="10" 
                               pattern="\d*" 
                               inputmode="numeric"
                               required>
                    </div>

                    <!-- Nama -->
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <i class="fas fa-user"></i>
                        <input type="text" 
                               name="name" 
                               class="form-control"
                               placeholder="" 
                               value="<?php echo e(old('name')); ?>" 
                               required>
                    </div>
                </div>

                <!-- BARIS KEDUA: PASSWORD dan EMAIL -->
                <div class="form-row">
                    <!-- Password -->
                    <div class="form-group">
                        <label class="form-label">Password <small class="text-muted"></small></label>
                        <i class="fas fa-lock"></i>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control"
                               placeholder="" 
                               autocomplete="new-password"
                               required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <i class="fas fa-envelope"></i>
                        <input type="email" 
                               name="email" 
                               class="form-control"
                               placeholder="" 
                               value="<?php echo e(old('email')); ?>" 
                               autocomplete="off"
                               required>
                    </div>
                </div>

                <!-- BARIS KETIGA: KONFIRMASI PASSWORD -->
                <div class="form-row">
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label">Konfirmasi Password</label>
                        <i class="fas fa-lock"></i>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation"
                               class="form-control"
                               placeholder="" 
                               autocomplete="new-password"
                               required>
                    </div>
                </div>

                <!-- KOTAK CENTANG LIHAT PASSWORD (sama seperti halaman login) -->
                <div class="checkbox-show-password">
                    <input type="checkbox" id="showPasswordCheckbox">
                    <label for="showPasswordCheckbox">
                        <!-- <i class="fas fa-eye"></i> Lihat Password -->
                    </label>
                </div>

                <button type="submit" class="btn-register" id="submitBtn">
                    <i class="fas fa-user-plus"></i> Buat Akun
                </button>

                <div class="login-link">
                    Sudah Punya Akun?
                    <a href="<?php echo e(route('login')); ?>">
                        <i class="fas fa-sign-in-alt"></i> Masuk
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Kosongkan semua field saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const usernameField = document.querySelector('input[name="username"]');
    const nameField = document.querySelector('input[name="name"]');
    const emailField = document.querySelector('input[name="email"]');
    const passwordField = document.querySelector('input[name="password"]');
    const confirmPasswordField = document.querySelector('input[name="password_confirmation"]');
    
    if (usernameField && !usernameField.value) usernameField.value = '';
    if (nameField && !nameField.value) nameField.value = '';
    if (emailField && !emailField.value) emailField.value = '';
    if (passwordField && !passwordField.value) passwordField.value = '';
    if (confirmPasswordField && !confirmPasswordField.value) confirmPasswordField.value = '';
});

// Loading saat submit form
document.getElementById('registerForm')?.addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memproses...';
});

// Validasi NIK/NISN hanya angka
document.querySelector('input[name="username"]')?.addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
    
    const value = this.value;
    const length = value.length;
    
    if (length > 0 && length < 10) {
        this.setCustomValidity('NISN harus 10 digit untuk siswa atau 16 digit untuk admin/guru');
    } else if (length === 10) {
        this.setCustomValidity('');
    } else if (length === 16) {
        this.setCustomValidity('');
    } else if (length > 16) {
        this.value = value.slice(0, 16);
        this.setCustomValidity('Maksimal 16 digit');
    } else {
        this.setCustomValidity('');
    }
});

// FITUR LIHAT PASSWORD dengan KOTAK CENTANG (sama seperti login)
const showPasswordCheck = document.getElementById('showPasswordCheckbox');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('password_confirmation');

if (showPasswordCheck && passwordInput) {
    showPasswordCheck.addEventListener('change', function() {
        const type = this.checked ? 'text' : 'password';
        passwordInput.type = type;
        if (confirmPasswordInput) {
            confirmPasswordInput.type = type;
        }
    });
}
</script>

</body>
</html><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/auth/register.blade.php ENDPATH**/ ?>