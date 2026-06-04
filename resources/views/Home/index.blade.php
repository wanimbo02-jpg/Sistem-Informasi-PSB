{{-- resources/views/home/index.blade.php --}}
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
        .navbar a, .navbar a:hover, .navbar a:active, .navbar a:focus, .navbar a:visited {
        color: white !important;
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
    transform: translateX(5px);
}
        
        .dropdown-item:focus,
        .dropdown-item:active {
            background: transparent !important;
            outline: none !important;
            box-shadow: none !important;
        }
        
        /* Navbar */
      .navbar {
      background: #1f5368; /*code ini untuk ubah warnah navbar home page*/
      backdrop-filter: blur(10px);
      box-shadow: 0 2px 20px rgba(243, 242, 242, 0.1);
      padding: 1.5rem 0; /* Tambahkan ini untuk memperbesar navbar */
       transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            padding: 0.5rem 0;
        }
        
        .navbar-brand {
    font-weight: 700;
    font-size: 1.5rem;
    color: white;  /* Ubah ke putih */
}
        
      .nav-link {
    font-weight: 500;
    color: white;  /* Ubah ke putih */
    margin: 0 0.5rem;
    transition: color 0.3s ease;
    }
        
        .nav-link:hover {
            color: var(--primary-color);
        }
        
        .nav-link.active {
            color: white !important;
            font-weight: 600;
            background: transparent !important;
        }
        
        /*code ini untuk mengubah warnah pada botton login di homepage navbar*/
        .btn-login { 
             background: #0d6efd;  /* Biru solid */
             border: 2px solid #0d6efd;
             color: white;  /* Teks putih */
             padding: 0.5rem 1.5rem;
             border-radius: 50px;
             font-weight: 600;
             transition: all 0.3s ease;
             margin-right: 0.5rem;
        }

           .btn-login:hover {
            background: #0a58ca;  /* Biru lebih gelap saat hover */
            border-color: #0a58ca;
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
            box-shadow: 0 5px 15px rgba(13, 173, 253, 0.4);
        }
        
        /* Hero Section */
       /* Overlay gelap untuk hero section */
     .hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.55); /* Atur kegelapan di sini */
    z-index: 1;
}

   /* Pastikan konten di dalam hero-section berada di atas overlay */
   .hero-section .container {
    position: relative;
    z-index: 2;
}

   /* Pastikan tombol panah dan dot juga di atas overlay */
   .hero-section .slider-arrow,
   .hero-section .slide-dots {
    z-index: 20;
}
        
        
        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            padding: 2rem;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
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
        
        .hero-image {
            position: relative;
            z-index: 2;
            animation: float 6s ease-in-out infinite;
        }
        
        .hero-image img {
            max-width: 100%;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        /* Wave Divider */
        /* .wave-divider {
            position: relative;
            bottom: -1px;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        } */
        
        /* .wave-divider svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 150px;
        } */
        
        /* .wave-divider .shape-fill {
            fill: #FFFFFF;
        } */
        
        /* Features Section */
        .features-section {
            padding: 100px 0;
            background: #f8f9fa;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1rem;
        }
        
        .section-title p {
            color: #666;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(13,110,253,0.1);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1835b8 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
        }
        
        .feature-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
        }
        
        .feature-card p {
            color: #666;
            line-height: 1.6;
        }
        
        /* Statistics Section */
        .statistics-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .stat-item {
            text-align: center;
            padding: 2rem;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        /* CTA Section */
        .cta-section {
            padding: 100px 0;
            background: #f8f9fa;
        }
        
        .cta-card {
            background: linear-gradient(135deg, #66cdea 0%, #764ba2 100%);
            padding: 4rem;
            border-radius: 30px;
            color: white;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .cta-card h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .cta-card p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        .cta-button {
            background: white;
            color: var(--primary-color);
            border: none;
            padding: 1rem 3rem;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255,255,255,0.3);
        }
        
        /* Footer */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 60px 0 20px;
        }
        
        .footer h5 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #fff;
        }
        
        .footer p {
            color: #999;
            line-height: 1.8;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
        }
        
        .footer-links li {
            margin-bottom: 0.8rem;
        }
        
        .footer-links a {
            color: #999;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
        }
        
        .social-links a {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }
        
        .copyright {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #999;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .hero-buttons .btn {
                display: block;
                width: 100%;
                margin-bottom: 1rem;
            }
            
            .cta-card {
                padding: 2rem;
            }
            
            .cta-card h2 {
                font-size: 1.8rem;
            }
        }
    </style>
    <style>
    .footer {
        background: linear-gradient(135deg, #2c3e50, #1a2634);
        color: rgba(255,255,255,0.8);
        padding: 60px 0 20px;
    }
    
    .footer h5 {
        color: white;
        font-weight: 600;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }
    
    .footer h5::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background: linear-gradient(135deg, #667eea, #764ba2);
    }
    
    .footer-links {
        list-style: none;
        padding: 0;
    }
    
    .footer-links li {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }
    
    .footer-links a {
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .footer-links a:hover {
        color: white;
        transform: translateX(5px);
    }
    
    .social-links {
        display: flex;
        gap: 10px;
    }
    
    .social-links a {
        width: 36px;
        height: 36px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .social-links a:hover {
        background: linear-gradient(135deg, #667eea, #764ba2);
        transform: translateY(-3px);
    }
    
    .btn-outline-light:hover {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-color: transparent;
    }
    
    .copyright {
        text-align: center;
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid rgba(255,255,255,0.1);
        color: rgba(255,255,255,0.5);
        font-size: 0.9rem;
    }
    
    .map-container {
        transition: all 0.3s;
    }
    
    .map-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }

    /* code ini baru di tambah unutk ero*/
    /* CSS untuk tombol panah dan slider - TAMBAHKAN INI */
.hero-section {
    transition: background-image 0.6s ease-in-out;
}

.slider-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.6);
    color: white;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 20;
    font-size: 28px;
    font-weight: bold;
    transition: all 0.3s ease;
    font-family: monospace;
    user-select: none;
}

.slider-arrow:hover {
    background: #0d6efd;
    transform: translateY(-50%) scale(1.1);
}

.arrow-left {
    left: 30px;
}

.arrow-right {
    right: 30px;
}

.slide-dots {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 12px;
    z-index: 20;
}

.dot {
    width: 12px;
    height: 12px;
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
}

.dot.active {
    background-color: #0d6efd;
    transform: scale(1.3);
    box-shadow: 0 0 10px #0d6efd;
}

/* Responsive untuk tombol di HP */
@media (max-width: 768px) {
    .slider-arrow {
        width: 36px;
        height: 36px;
        font-size: 20px;
    }
    .arrow-left {
        left: 10px;
    }
    .arrow-right {
        right: 10px;
    }
    .slide-dots {
        bottom: 15px;
        gap: 8px;
    }
    .dot {
        width: 8px;
        height: 8px;
    }
}
    /*selesai disini*/
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-mortarboard-fill me-2"></i>
            SMA Negeri Karubaga
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#beranda">Beranda</a>
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
        <li>
            <a class="dropdown-item fw-semibold" href="{{ route('about.struktur') }}">
                Struktur Organisasi
            </a>
              </li>
               </ul>
            </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{ route('info') }}">Informasi</a>
                </li>
                <li class="nav-item dropdown">
         <a class="nav-link fw-bold dropdown-toggle" href="#" id="beritaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Berita
    </a>
   <ul class="dropdown-menu" aria-labelledby="beritaDropdown">
    <li>
        <a class="dropdown-item fw-semibold" href="{{ route('fasilitas.publik') }}">Fasilitas Sekolah</a>
    </li>
    <li>
        <a class="dropdown-item fw-semibold" href="{{ route('gallery') }}">Gallery</a>
       </li>
        </ul>
           </li>
                <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle fw-bold" href="#" id="pengumumanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class=""></i> Pengumuman
       </a>
       <ul class="dropdown-menu" aria-labelledby="pengumumanDropdown">
       
       <li>
     <a class="dropdown-item fw-semibold" href="{{ route('hasil-seleksi') }}">
         Hasil Seleksi
       </a>
         </li>
          </ul>
             </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{ route('contact') }}">Kontak</a>
                </li>
            </ul>
            <div class="ms-lg-3">
                <a href="{{ route('login') }}" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </a>
                <!-- <a href="{{ route('register') }}" class="btn-register">
                    <i class="bi bi-pencil-square me-2"></i>Daftar
                </a> -->
            </div>
        </div>
    </div>
</nav>



<!-- Hero Section -->
<!-- Hero Section with Slider -->
<section class="hero-section" id="beranda" style="position: relative;">
    <!-- Tombol panah segitiga kiri -->
    <div class="slider-arrow arrow-left" id="prevSlideBtn">
        &#10094;
    </div>
    
    <!-- Tombol panah segitiga kanan -->
    <div class="slider-arrow arrow-right" id="nextSlideBtn">
        &#10095;
    </div>
    
    <div class="container" style="position: relative; z-index: 2;">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="hero-content">
                    <h1 class="hero-title">
                        <span style="font-size: 2rem; display: block; font-weight: 600;">Selamat Datang di</span>
                        SMA Negeri Karubaga
                    </h1>
                    <h2 class="hero-subtitle" style="font-weight: bold; font-size: 1.8rem;">
                    Penerimaan Peserta Didik Baru {{ $tahun_ajaran }}
                    </h2>
                    <p class="hero-description" style="font-size: 2rem; display: block; font-weight: 600;">
                    Bergabunglah bersama kami untuk mewujudkan masa depan gemilang 
                    dengan pendidikan berkualitas dan lingkungan belajar yang kondusif.
                   </p>
                    <div class="hero-buttons">
                        <a href="{{ route('register') }}" class="btn btn-hero-primary">
                            <i class="bi bi-pencil-square me-2"></i>Daftar Sekarang
                        </a>
                        <a href="{{ route('info') }}" class="btn btn-hero-secondary">
                            <i class="bi bi-info-circle me-2"></i>Informasi PPDB
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="hero-image text-center">
                    <img src="{{ asset('images/logo-sekolah.jpg') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Indikator dot -->
    <div class="slide-dots" id="slideDots"></div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Mengapa Memilih Kami?</h2>
            <p>Kami berkomitmen untuk memberikan pendidikan terbaik bagi generasi penerus bangsa Indonesia terlebih khususnya dikabupaten Tolikara.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <h3>Pendidikan Berkualitas</h3>
                    <p>Kurikulum terpadu dengan tenaga pengajar profesional dan berpengalaman terbaik bagi masa depan yang proaktif,adaktif dan unggul.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <h3>Fasilitas Lengkap</h3>
                    <p>Lab komputer, perpustakaan, lapangan olahraga, dan ruang laboratorum dengan Fasilitas yang lengkap dan memberikan peluang belajar kepada siswa/siswa SMAN Karubaga.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-trophy"></i>
                    </div>
                    <h3>Prestasi Gemilang</h3>
                    <p>Berbagai prestasi akademik dan non-akademik di tingkat daerah, dan kabupaten.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="statistics-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6" data-aos="zoom-in">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Siswa Aktif</div>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Tenaga Pengajar</div>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="stat-item">
                    <div class="stat-number">20+</div>
                    <div class="stat-label">Ekstrakurikuler</div>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="300">
                <div class="stat-item">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Lulusan Terserap</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Informasi PPDB Section -->
<section class="features-section">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Informasi PPDB {{ $tahun_ajaran }}</h2>
            <p>Persiapkan diri Anda untuk bergabung bersama kami</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h3>Jadwal Pendaftaran</h3>
                    <p>1 Maret - 30 Juni 2024</p>
                    <p class="text-muted">Senin - Jumat, 08.00 - 15.00 WIT</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <i class="bi bi-file-text"></i>
                    </div>
                    <h3>Persyaratan</h3>
                    <p>• Ijazah/SKL<br>• KK & Akta Kelahiran<br>• Pas Foto 3x4</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3>Jalur Pendaftaran</h3>
                    <p>• Umum<br>• Prestasi<br>• Afirmasi<br>• Pindah Tugas</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-card" data-aos="zoom-in">
            <h2>Siap Bergabung Bersama Kami?</h2>
            <p>Daftarkan diri Anda sekarang juga dan raih masa depan cerah bersama SMA Negeri Karubaga</p>
            <a href="{{ route('register') }}" class="cta-button">
                <i class="bi bi-pencil-square me-2"></i>Daftar Sekarang
            </a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Profil Sekolah -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>SMA Negeri Karubaga</h5>
                <p>Menjadi lembaga selangkah lebih depan dalam pengembangan talenta manusia yang memberikan kontribusi berarti pada inovasi teknologi dan keberlanjutan sosial</p>
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
            <!-- Google Maps (Lebih Besar) -->
<div class="col-lg-4 col-md-4 mb-4">
    <h5>Lokasi Kami</h5>
    <div class="map-container" style="border-radius: 15px; overflow: hidden; border: 2px solid rgba(102, 126, 234, 0.2); box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.57954792122!2d138.47915430000003!3d-3.6827063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x68161bcbc7594487%3A0xd66c5227c5c6fa12!2sSMA%20Negeri%20Karubaga!5e0!3m2!1sid!2sid!4v1773469651125!5m2!1sid!2sid" 
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
        
        <!-- Copyright -->
        <div class="copyright">
            <p>&copy; {{ date('Y') }} SMA Negeri Karubaga. All rights reserved.</p>
        </div>
    </div>
</footer>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS
    AOS.init({
        duration: 1000,
        once: true
    });

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Smooth scroll untuk anchor links
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

    // ========== SLIDESHOW HERO SECTION ==========
(function() {
    // Daftar gambar background (GANTI DENGAN FILE GAMBAR ANDA)
    const backgroundImages = [
        "{{ asset('images/Home/baris.jpg') }}",
        "{{ asset('images/Home/Barisan.jpg') }}",   // Ganti dengan file gambar Anda
        "{{ asset('images/Home/SMAN.jpeg') }}",   // Ganti dengan file gambar Anda
        "{{ asset('images/Home/pemberian.jpg') }}"    // Ganti dengan file gambar Anda
    ];
    
    let currentIndex = 0;
    let autoSlideInterval;
    const heroSection = document.querySelector('.hero-section');
    const prevBtn = document.getElementById('prevSlideBtn');
    const nextBtn = document.getElementById('nextSlideBtn');
    const dotsContainer = document.getElementById('slideDots');
    
    // Fungsi mengubah background
    function changeBackground(index) {
        if (index < 0) {
            currentIndex = backgroundImages.length - 1;
        } else if (index >= backgroundImages.length) {
            currentIndex = 0;
        } else {
            currentIndex = index;
        }
        
        heroSection.style.backgroundImage = `url('${backgroundImages[currentIndex]}')`;
        heroSection.style.backgroundSize = 'cover';
        heroSection.style.backgroundPosition = 'center';
        heroSection.style.backgroundRepeat = 'no-repeat';
        
        updateDotsActive();
    }
    
    // Membuat indikator dot
    function createDots() {
        if (!dotsContainer) return;
        dotsContainer.innerHTML = '';
        backgroundImages.forEach((_, idx) => {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            if (idx === currentIndex) dot.classList.add('active');
            dot.addEventListener('click', () => {
                stopAutoSlide();
                changeBackground(idx);
                startAutoSlide();
            });
            dotsContainer.appendChild(dot);
        });
    }
    
    function updateDotsActive() {
        const dots = document.querySelectorAll('.dot');
        dots.forEach((dot, idx) => {
            if (idx === currentIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }
    
    function nextSlide() {
        changeBackground(currentIndex + 1);
    }
    
    function prevSlide() {
        changeBackground(currentIndex - 1);
    }
    
    function startAutoSlide() {
        if (autoSlideInterval) clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(() => {
            nextSlide();
        }, 5000); // Ganti gambar setiap 5 detik
    }
    
    function stopAutoSlide() {
        if (autoSlideInterval) {
            clearInterval(autoSlideInterval);
            autoSlideInterval = null;
        }
    }
    
    // Event listener tombol
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            stopAutoSlide();
            prevSlide();
            startAutoSlide();
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            stopAutoSlide();
            nextSlide();
            startAutoSlide();
        });
    }
    
    // Hover: pause auto slide
    if (heroSection) {
        heroSection.addEventListener('mouseenter', () => {
            stopAutoSlide();
        });
        
        heroSection.addEventListener('mouseleave', () => {
            startAutoSlide();
        });
    }
    
    // Inisialisasi
    if (heroSection && backgroundImages.length > 0) {
        // Pastikan background pertama tetap pakai gambar default
        heroSection.style.backgroundImage = `url('${backgroundImages[0]}')`;
        heroSection.style.backgroundSize = 'cover';
        heroSection.style.backgroundPosition = 'center';
        heroSection.style.backgroundRepeat = 'no-repeat';
        
        createDots();
        startAutoSlide();
    }
})();
</script>
</body>
</html>