{{-- resources/views/home/about-layout.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Penerimaan Peserta Didik Baru</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --info-color: #0dcaf0;
            --dark-blue: #0a58ca;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        
        .dropdown-menu {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }
        
        .dropdown-divider {
            display: none !important;
        }
        
        .dropdown-item {
            background: transparent !important;
            color: inherit !important;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background: transparent !important;
            color: #333 !important;
            transform: translateX(5px);
        }
        
        .dropdown-item:focus,
        .dropdown-item:active {
            background: transparent !important;
            color: #333 !important;
            outline: none !important;
            box-shadow: none !important;
        }
        
        /* Navbar */
       .navbar {
         background: rgba(241, 234, 241, 0.95);
         backdrop-filter: blur(10px);
         box-shadow: 0 2px 20px rgba(0,0,0,0.1);
         padding: 1.5rem 0;
         transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            padding: 0.5rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
        }
        
        .nav-link {
            font-weight: 500;
            color: #333;
            margin: 0 0.5rem;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--primary-color);
        }
        
        .btn-login {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-right: 0.5rem;
        }
        
        .btn-login:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13,110,253,0.3);
        }
        
        .btn-register {
            background: var(--primary-color);
            border: 2px solid var(--primary-color);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-register:hover {
            background: var(--dark-blue);
            border-color: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13,110,253,0.4);
        }
        
        /* Hero Section */
        .hero-section {
        min-height: 60vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        overflow: hidden;
        padding: 100px 0 50px;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-repeat: no-repeat;
            background-position: bottom;
            background-size: cover;
            opacity: 0.1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            font-weight: 300;
        }
        
        .hero-description {
            font-size: 1.1rem;
            margin-bottom: 3rem;
            opacity: 0.8;
            max-width: 600px;
            margin: 0 auto 3rem;
        }
        
        .hero-buttons .btn {
            padding: 1rem 2.5rem;
            font-weight: 600;
            border-radius: 50px;
            margin-right: 1rem;
            transition: all 0.3s ease;
        }
        
        .btn-hero-primary {
            background: white;
            color: var(--primary-color);
            border: none;
        }
        
        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255,255,255,0.3);
        }
        
        .btn-hero-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }
        
        .btn-hero-secondary:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-3px);
        }
        
        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 0;
        }
        
        .footer h5 {
           
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .footer a {
           
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer a:hover {
            color: #3498db;
        }
        
        .social-icons a {
            font-size: 1.5rem;
            margin: 0 0.5rem;
            display: inline-block;
        }
        
        .copyright {
            border-top: 1px solid #34495e;
            margin-top: 2rem;
            padding-top: 1rem;
            text-align: center;
            color: #95a5a6;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-mortarboard-fill"></i> PPDB
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pengumumanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-megaphone me-1"></i> Pengumuman
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="pengumumanDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('pengumuman.index') }}">
                                    <i class="bi bi-list-ul me-2"></i> Semua Pengumuman
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('pengumuman.create') }}">
                                    <i class="bi bi-plus-circle me-2"></i> Buat Pengumuman
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" id="tentangDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tentang Kami
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="tentangDropdown">
                            <li>
                                <a class="dropdown-item fw-semibold" href="{{ route('about.sejarah') }}">
                                    Sejarah
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-semibold" href="{{ route('about.visi-misi') }}">
                                    Visi & Misi
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item fw-semibold" href="{{ route('about.struktur') }}">
                                    Struktur Organisasi
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn-login" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-register" href="{{ route('register') }}">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">
                SMA Negeri Karubaga
            </h1>
            <h2 class="hero-subtitle">
                {{ $title }}
            </h2>
            <p class="hero-description">
                Bergabunglah bersama kami untuk mewujudkan masa depan gemilang 
                dengan pendidikan berkualitas dan lingkungan belajar yang kondusif.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn btn-hero-primary">
                    <i class="bi bi-pencil-square me-2"></i>Daftar Sekarang
                </a>
                <a href="{{ route('info') }}" class="btn btn-hero-secondary">
                    <i class="bi bi-info-circle me-2"></i>Informasi PPDB
                </a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Profil Sekolah -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>SMA Negeri Karubaga</h5>
                    <p>Menjadi lembaga selangkah lebih depan dalam pengembangan talenta manusia yang memberikan kontribusi berarti pada inovasi teknologi dan keberlanjutan sosial.</p>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                
                <!-- Menu -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Menu</h5>
                    <ul class="footer-links">
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="{{ route('about') }}">Tentang</a></li>
                        <li><a href="{{ route('info') }}">Informasi</a></li>
                        <li><a href="{{ route('contact') }}">Kontak</a></li>
                    </ul>
                </div>
                
                <!-- Kontak Kami -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Kontak Kami</h5>
                    <ul class="footer-links">
                        <li><i class="bi bi-geo-alt me-2"></i>Jl. Raya Karubaga No. 1, Karubaga</li>
                        <li><i class="bi bi-telephone me-2"></i>(0961) 123456</li>
                        <li><i class="bi bi-envelope me-2"></i>info@smankarubaga.sch.id</li>
                    </ul>
                </div>
                
                <!-- Google Maps -->
                <div class="col-lg-4 col-md-4 mb-4">
                    <h5>Lokasi Kami</h5>
                    <div class="map-container" style="border-radius: 15px; overflow: hidden; border: 2px solid rgba(102, 126, 234, 0.2); box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.57954792122!2d138.47915430000003!3d-3.6827063!3m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x68161bcbc7594487%3A0xd66c5227c5c6fa12!2sSMA%20Negeri%20Karubaga!5e0!3m2!1sid!2sid!4v1773469651125!5m2!1sid!2sid" 
                            width="100%" 
                            height="250" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                    <div class="mt-3">
                        <a href="https://www.google.com/maps/place/SMA+Negeri+Karubaga/@-3.6827063,138.4791543,17z" 
                           target="_blank" 
                           class="btn btn-sm btn-outline-light w-100"
                           style="border-radius: 50px; padding: 0.6rem; font-weight: 500; letter-spacing: 0.5px;">
                            <i class="bi bi-google me-2"></i> Buka di Google Maps
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="copyright">
                <p>&copy; {{ date('Y') }} SMA Negeri Karubaga. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Active nav link
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link');
        
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
    </script>
</body>
</html>
