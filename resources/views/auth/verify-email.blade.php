@extends('layouts.app')

@section('title', 'Verifikasi Email')

@section('content')
<div class="container-fluid" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 2rem 0;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                <div class="card-header text-center border-0 py-4" style="background: linear-gradient(135deg, #0084ff 0%, #0051cc 100%);">
                    <div class="mb-3">
                        <div class="rounded-circle bg-white bg-opacity-25 p-3 d-inline-block">
                            <i class="fas fa-envelope fa-2x text-white"></i>
                        </div>
                    </div>
                    <h4 class="mb-0 text-white">
                        <strong>Verifikasi Email</strong>
                    </h4>
                    <small class="text-white-50">Masukkan kode yang kami kirim</small>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 15px; border: none; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white;">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-4 d-inline-block">
                                <i class="fas fa-envelope-open-text fa-3x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="text-dark">Verifikasi Alamat Email</h5>
                        <p class="text-muted">Kami telah mengirim kode verifikasi ke:</p>
                        <div class="bg-primary bg-opacity-10 rounded-3 p-3 mb-3">
                            <p class="fw-bold text-primary mb-0 fs-5">{{ $email ?: session('verification_email') }}</p>
                        </div>
                        <p class="text-muted small">
                            <i class="fas fa-info-circle me-1"></i>
                            Silakan cek inbox atau folder spam email Anda, lalu masukkan kode 6 digit di bawah.
                        </p>
                    </div>

                    <?php $showCodeForm = $email || session('verification_email') || session('success'); ?>

                    @if($showCodeForm)
                        <form action="{{ route('verify.code') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="code" class="form-label fw-bold text-dark">
                                    <i class="fas fa-key me-2 text-primary"></i>Masukkan Kode Verifikasi
                                </label>
                                <div class="d-flex justify-content-center gap-2 mb-2">
                                    @for($i = 0; $i < 6; $i++)
                                        <input type="text" 
                                               class="form-control form-control-lg text-center code-input" 
                                               style="width: 50px; height: 60px; font-size: 24px; font-weight: bold; border-radius: 15px; border: 2px solid #e9ecef; transition: all 0.3s ease;"
                                               maxlength="1"
                                               pattern="[0-9]"
                                               required>
                                    @endfor
                                </div>
                                <input type="hidden" id="code" name="code" required>
                                <small class="text-muted">Masukkan 6 digit kode yang dikirim ke email Anda</small>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #0084ff 0%, #0051cc 100%); border: none; border-radius: 15px; padding: 15px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-check me-2"></i>Verifikasi Email
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <p class="text-muted mb-2">Tidak menerima kode?</p>
                            <form action="{{ route('verify.resend') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm" style="border-radius: 20px; padding: 8px 20px; transition: all 0.3s ease;">
                                    <i class="fas fa-redo me-2"></i>Kirim Ulang Kode
                                </button>
                            </form>
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-muted text-decoration-none" style="transition: all 0.3s ease;">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        animation: slideInUp 0.6s ease-out;
        backdrop-filter: blur(10px);
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .card-header {
        border-radius: 20px 20px 0 0 !important;
        border: none;
        position: relative;
        overflow: hidden;
    }
    
    .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .code-input {
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
        animation: fadeInScale 0.5s ease-out;
    }
    
    .code-input:focus {
        border-color: #0084ff;
        box-shadow: 0 0 0 0.2rem rgba(0, 132, 255, 0.25);
        transform: scale(1.05);
    }
    
    .code-input.filled {
        background: linear-gradient(135deg, #0084ff 0%, #0051cc 100%);
        color: white;
        border-color: #0084ff;
        animation: pulse 0.5s ease;
    }
    
    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    .btn {
        border-radius: 15px;
        padding: 15px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 132, 255, 0.3);
    }
    
    .btn:active {
        transform: translateY(-1px);
    }
    
    .fa-3x {
        font-size: 3rem;
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
    
    .alert {
        animation: slideInRight 0.5s ease-out;
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .rounded-circle {
        animation: rotateIn 0.8s ease-out;
    }
    
    @keyframes rotateIn {
        from {
            opacity: 0;
            transform: rotate(-180deg);
        }
        to {
            opacity: 1;
            transform: rotate(0deg);
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // 6-digit code input handling
    const codeInputs = document.querySelectorAll('.code-input');
    const hiddenCodeInput = document.getElementById('code');
    
    codeInputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            const value = e.target.value;
            
            // Only allow numbers
            if (value && !/^[0-9]$/.test(value)) {
                e.target.value = '';
                return;
            }
            
            // Update hidden input
            updateHiddenCode();
            
            // Add filled class for animation
            if (value) {
                e.target.classList.add('filled');
                // Move to next input
                if (index < codeInputs.length - 1) {
                    codeInputs[index + 1].focus();
                }
            } else {
                e.target.classList.remove('filled');
            }
            
            // Auto-submit when all digits are entered
            if (hiddenCodeInput.value.length === 6) {
                setTimeout(() => {
                    e.target.form.submit();
                }, 500);
            }
        });
        
        input.addEventListener('keydown', function(e) {
            // Handle backspace
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                codeInputs[index - 1].focus();
                codeInputs[index - 1].value = '';
                codeInputs[index - 1].classList.remove('filled');
                updateHiddenCode();
            }
            
            // Handle arrow keys
            if (e.key === 'ArrowLeft' && index > 0) {
                codeInputs[index - 1].focus();
            }
            if (e.key === 'ArrowRight' && index < codeInputs.length - 1) {
                codeInputs[index + 1].focus();
            }
        });
        
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').slice(0, 6);
            const digits = pastedData.replace(/[^0-9]/g, '');
            
            digits.split('').forEach((digit, i) => {
                if (i < codeInputs.length) {
                    codeInputs[i].value = digit;
                    codeInputs[i].classList.add('filled');
                }
            });
            
            updateHiddenCode();
            
            // Focus on next empty input or last input if all filled
            const nextEmptyIndex = Array.from(codeInputs).findIndex(input => !input.value);
            if (nextEmptyIndex !== -1) {
                codeInputs[nextEmptyIndex].focus();
            } else {
                codeInputs[codeInputs.length - 1].focus();
            }
        });
    });
    
    function updateHiddenCode() {
        const code = Array.from(codeInputs).map(input => input.value).join('');
        hiddenCodeInput.value = code;
    }
    
    // Focus first input on load
    if (codeInputs.length > 0) {
        codeInputs[0].focus();
    }
    
    // Clear alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
    
    // Add hover effects to buttons
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
        });
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
</script>
@endpush
