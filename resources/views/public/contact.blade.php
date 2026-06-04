@extends('layouts.app')

@section('title', 'Kontak SMA Negeri Karubaga')

@section('styles')
<style>
    main.py-4 { padding: 0 !important; }

    

    .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        color: #f3eeee !important;  /* Teks brand hitam */
    }

    .nav-link {
        font-weight: 500;
        color: #f1f1f1 !important;  /* Menu navbar hitam */
        margin: 0 0.5rem;
        transition: color 0.3s ease;
    }

    .nav-link:hover {
        color: #0d6efd !important;  /* Hover jadi biru */
    }

    .dropdown-item {
        background: transparent !important;
        color: #000000 !important;  /* Dropdown item hitam */
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background: #f0f0f0 !important;
        color: #000000 !important;
    }

    .btn-login {
        background: #0d6efd;
        border: 2px solid #0d6efd;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-right: 0.5rem;
    }

    .btn-login:hover {
        background: #0a58ca;
        border-color: #0a58ca;
        color: white;
    }
    /* ========== END NAVBAR STYLE ========== */

    /* Messenger Style Background */
    .contact-section {
        background: linear-gradient(135deg, #fcfdff 0%, #dfdfdf 100%);
        padding: 60px 0 70px;
        position: relative;
    }

    /* Judul halaman */
    .contact-title {
        text-align: center;
        color: white;
        margin-bottom: 40px;
        position: relative;
        z-index: 10;
    }

    .contact-title h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: #000000;  /* HITAM */
        text-shadow: 0 2px 10px rgba(78, 60, 146, 0.2);
    }

    .contact-title p {
        font-size: 1rem;
        color: rgba(25, 21, 21, 0.9);
        margin: 0;
    }

    /* Split Card dengan Glass Morphism */
    .split-card {
        display: flex;
        width: 100%;
        max-width: 1050px;
        margin: 0 auto 50px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 25px 60px rgba(0,0,0,0.3);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        z-index: 10;
    }

    /* Sisi Kiri — Messenger Blue Gradient */
    .left-teal-panel {
        flex: 1;
        background: linear-gradient(135deg, #0084ff 0%, #0051cc 100%);
        color: white;
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .left-teal-panel h2 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 28px;
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .about-image {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        margin-bottom: 30px;
        position: relative;
        z-index: 2;
    }

    .inner-transparent-box {
        width: 100%;
        height: 260px;
        background-color: rgba(255,255,255,0.15);
        border-radius: 15px;
        border: 1px solid rgba(255,255,255,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 25px;
        backdrop-filter: blur(5px);
        position: relative;
        z-index: 2;
    }

    .about-content {
        text-align: center;
        color: white;
        position: relative;
        z-index: 2;
    }

    .about-text {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 15px;
        color: rgba(255,255,255,0.95);
    }

    /* Sisi Kanan — Form */
    .right-form-panel {
        flex: 1.5;
        padding: 50px 50px 45px;
        background: rgba(68, 102, 107, 0.98);
        backdrop-filter: blur(5px);
    }

    .right-form-panel h2 {
        color: #ffffff;
        font-weight: 800;
        font-size: 2rem;
        text-align: center;
        margin-bottom: 35px;
        position: relative;
    }

    /* Tabel input */
    .table-wrapper {
        display: flex;
        flex-direction: column;
        gap: 15px;
        background: transparent;
    }

    .form-row {
        border: 2px solid #000000;
        border-radius: 15px;
        overflow: hidden;
        background: #f8fafc;
        transition: all 0.3s ease;
    }

    .form-row:hover {
        border-color: #0084ff;
        box-shadow: 0 5px 15px rgba(0, 132, 255, 0.1);
    }

    .form-row .form-control {
        width: 100%;
        background-color: #f8fafc !important;
        border: none !important;
        border-radius: 0 !important;
        padding: 20px 25px !important;
        font-size: 1rem;
        color: #334155;
        min-height: 65px;
        box-shadow: none !important;
    }

    .form-row .form-control::placeholder { 
        color: #06080a; 
    }

    .form-row .form-control:focus {
        background-color: #ffffff !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 132, 255, 0.1) !important;
    }

    .form-row textarea.form-control {
        height: 120px;
        resize: vertical;
    }

    /* Tombol KIRIM */
    .btn-kirim-custom {
        display: block;
        margin: 30px auto 0;
        background: linear-gradient(135deg, #0084ff 0%, #0051cc 100%);
        color: white;
        border: none;
        padding: 16px 80px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        cursor: pointer;
        box-shadow: 0 8px 25px rgba(0, 132, 255, 0.4);
        transition: all 0.3s ease;
        position: relative;
    }

    .btn-kirim-custom:hover {
        background: linear-gradient(135deg, #0051cc 0%, #003d99 100%);
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(0, 132, 255, 0.5);
        color: white;
    }

    .btn-kirim-custom:active {
        transform: translateY(-1px);
    }

    /* Alert Messages */
    .alert {
        border-radius: 15px;
        border: none;
        margin-bottom: 20px;
        position: relative;
        z-index: 20;
    }

    .alert-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .alert-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }

    /* Responsive */
    @media (max-width: 860px) {
        .split-card { flex-direction: column; }
        .left-teal-panel { padding: 35px 20px; }
        .inner-transparent-box { height: 150px; }
        .right-form-panel { padding: 28px 20px; }
        .btn-kirim-custom { padding: 12px 45px; }
        .contact-title h1 { font-size: 2rem; }
    }
</style>
@endsection

@section('content')
<section class="contact-section">
    <div class="container">

        <!-- Judul -->
        <div class="contact-title">
            <h1>{{ $title }}</h1>
            <p>Hubungi kami untuk informasi lebih lanjut tentang SMA Negeri Karubaga</p>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Split Card: Tentang Kami + Form -->
        <div class="split-card">

            <!-- Kiri: Tentang Kami -->
            <div class="left-teal-panel">
                <img src="{{ asset('images/habelogo.jpg') }}" alt="SMA Negeri Karubaga" class="about-image mb-4">
                <h2>Tentang Kami</h2>
                <div class="inner-transparent-box">
                    <div class="about-content">
                        <p class="about-text">
                            SMA Negeri Karubaga adalah lembaga pendidikan unggulan yang berkomitmen untuk menghasilkan lulusan berkualitas dan berkarakter.
                        </p>
                        <p class="about-text">
                            Kami menyediakan fasilitas lengkap dan pengajar profesional untuk mendukung prestasi siswa.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Kanan: Hubungi Kami -->
            <div class="right-form-panel">
                <h2>Hubungi Kami</h2>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="table-wrapper">
                        <div class="form-row">
                            <input type="text" class="form-control" name="name" placeholder="Nama" required>
                        </div>
                        <div class="form-row">
                            <input type="email" class="form-control" name="email" placeholder="Alamat Email" required>
                        </div>
                        <div class="form-row">
                            <input type="text" class="form-control" name="company" placeholder="Perusahaan">
                        </div>
                        <div class="form-row">
                            <input type="text" class="form-control" name="phone" placeholder="Telepon">
                        </div>
                        <div class="form-row">
                            <textarea class="form-control" name="message" placeholder="Pesan" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn-kirim-custom">KIRIM</button>
                </form>
            </div>

        </div>

    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation animation only (minimal)
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const inputs = form.querySelectorAll('input[required], textarea[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.parentElement.style.borderColor = '#dc3545';
                    
                    setTimeout(() => {
                        input.parentElement.style.borderColor = '#e8f0fe';
                    }, 500);
                }
            });
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    }
    
    // Smooth scroll for any anchor links (kept for functionality)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endsection