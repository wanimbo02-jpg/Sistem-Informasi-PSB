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
    @yield('styles')
</head>
<body>
    <style>
        .navbar-brand {
            color: #333 !important;
            font-weight: bold;
        }
        .navbar-light .navbar-nav .nav-link {
            color: #333 !important;
        }
        .navbar-light .navbar-nav .nav-link:hover {
            color: #007bff !important;
        }
        .navbar-light .navbar-nav .nav-link.active {
            color: #007bff !important;
            font-weight: 600;
        }
    </style>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-mortarboard-fill"></i> PPDB SMAN Karubaga
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('about') || request()->routeIs('about.sejarah') || request()->routeIs('about.visi-misi') || request()->routeIs('about.struktur') ? 'active' : '' }}" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tentang Kami
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                            <li><a class="dropdown-item {{ request()->routeIs('about.sejarah') ? 'active' : '' }}" href="{{ route('about.sejarah') }}">Sejarah</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('about.visi-misi') ? 'active' : '' }}" href="{{ route('about.visi-misi') }}">Visi Misi</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('about.struktur') ? 'active' : '' }}" href="{{ route('about.struktur') }}">Struktur Organisasi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('informasi-pendaftaran.index') ? 'active' : '' }}" href="{{ route('informasi-pendaftaran.index') }}">Informasi</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('berita') || request()->routeIs('fasilitas.publik') || request()->routeIs('gallery') ? 'active' : '' }}" href="#" id="beritaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Berita
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="beritaDropdown">
                            <li><a class="dropdown-item {{ request()->routeIs('fasilitas.publik') ? 'active' : '' }}" href="{{ route('fasilitas.publik') }}">Fasilitas Sekolah</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('pengumuman.index') || request()->routeIs('hasil-seleksi') ? 'active' : '' }}" href="#" id="pengumumanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pengumuman
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="pengumumanDropdown">
                            <li><a class="dropdown-item {{ request()->routeIs('hasil-seleksi') ? 'active' : '' }}" href="{{ route('hasil-seleksi') }}">Hasil Seleksi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white ms-2" href="{{ route('login') }}">Login</a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a></li>
                        </ul>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @endguest
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
        </div>
    </footer>

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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
