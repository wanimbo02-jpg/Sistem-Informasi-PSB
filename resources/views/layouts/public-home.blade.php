<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PPDB')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #6c5ce7;
            --secondary-color: #a29bfe;
            --accent-color: #fd79a8;
            --text-dark: #2d3436;
            --text-light: #636e72;
            --bg-light: #f8f9fa;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
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
            color: white !important;
            text-decoration: none;
        }
        
        .navbar-brand:hover {
            color: #0d6efd;
        }
        
        .navbar-nav .nav-link {
            color: #333;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover {
            color: #0d6efd;
        }
        
        .navbar-nav .nav-link.active {
            color: white !important;
            font-weight: 600;
            background: transparent !important;
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
            font-weight: 700 !important;
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
        
        .social-links a {
            color: white;
            font-size: 1.2rem;
            margin-right: 1rem;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            color: var(--accent-color);
            transform: translateY(-3px);
        }
        
        .copyright {
            border-top: 1px solid #333;
            margin-top: 2rem;
            padding-top: 2rem;
            text-align: center;
            color: #999;
        }
        
        @yield('styles')
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
                    <a class="nav-link" href="#beranda">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tentang Kami
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                        <li><a class="dropdown-item fw-bold" href="{{ route('about.sejarah') }}" style="font-weight: 700 !important;">Sejarah</a></li>
                        <li><a class="dropdown-item fw-bold" href="{{ route('about.visi-misi') }}" style="font-weight: 700 !important;">Visi Misi</a></li>
                        <li><a class="dropdown-item fw-bold" href="{{ route('about.struktur') }}" style="font-weight: 700 !important;">Struktur Organisasi</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('informasi-pendaftaran.index') }}">Informasi</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link fw-bold dropdown-toggle" href="#" id="beritaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Berita
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="beritaDropdown">
                        <li>
                            <a class="dropdown-item fw-bold" href="{{ route('fasilitas.publik') }}" style="font-weight: 700 !important;">Fasilitas Sekolah</a>
                        </li>
                        <li>
                            <a class="dropdown-item fw-bold" href="{{ route('gallery') }}" style="font-weight: 700 !important;">Gallery</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link fw-bold dropdown-toggle" href="#" id="pengumumanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pengumuman
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="pengumumanDropdown">
                        <li><a class="dropdown-item fw-bold" href="{{ route('hasil-seleksi') }}" style="font-weight: 700 !important;">Hasil Seleksi</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main style="padding-top: 100px;">
    @yield('content')
</main>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5>SMA Negeri Karubaga</h5>
                <p>Menjadi lembaga selangkah lebih depan dalam pengembangan talenta manusia yang memberikan kontribusi berarti pada inovasi teknologi dan keberlanjutan sosial</p>
                <div class="social-links">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-4">
                <h5>Menu</h5>
                <ul class="footer-links">
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="{{ route('about') }}">Tentang</a></li>
                    <li><a href="{{ route('informasi-pendaftaran.index') }}">Informasi</a></li>
                    <li><a href="{{ route('contact') }}">Kontak</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Link Penting</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('login') }}">Login Siswa</a></li>
                    <li><a href="{{ route('register') }}">Pendaftaran</a></li>
                    <li><a href="#">Pengumuman</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-3 mb-4">
                <h5>Kontak Kami</h5>
                <ul class="footer-links">
                    <li><i class="bi bi-geo-alt me-2"></i>Jl. Raya Karubaga No. 1, Karubaga</li>
                    <li><i class="bi bi-telephone me-2"></i>(0961) 123456</li>
                    <li><i class="bi bi-envelope me-2"></i>info@smankarubaga.sch.id</li>
                </ul>
            </div>
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
        </div>
        <div class="copyright">
            <p>&copy; {{ date('Y') }} SMA Negeri Karubaga. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

    @yield('scripts')
</script>

<style>
.footer {
    background: linear-gradient(135deg, #2c3e50, #1a2634);
    color: rgba(255,255,255,0.8);
    padding: 60px 0 20px;
    margin-top: 3rem;
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
    width: 50px;
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

.social-links a {
    color: rgba(255,255,255,0.6);
    font-size: 1.2rem;
    margin-right: 1rem;
    transition: all 0.3s ease;
}

.social-links a:hover {
    color: white;
    transform: translateY(-3px);
}

.copyright {
    border-top: 1px solid rgba(255,255,255,0.1);
    margin-top: 2rem;
    padding-top: 2rem;
    text-align: center;
    color: rgba(255,255,255,0.6);
}
</style>
</body>
</html>
