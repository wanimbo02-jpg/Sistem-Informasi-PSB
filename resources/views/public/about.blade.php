@extends('layouts.public-home')

@section('title', 'Tentang')

@section('content')
<div class="container-fluid py-0">
    <div class="row g-0">
        <div class="col-md-4 p-0">
            <img src="{{ asset('images/hero-background.jpg') }}" alt="SMA Negeri Karubaga" class="img-fluid h-100" style="object-fit: cover; min-height: 100vh;">
        </div>
        <div class="col-md-8 p-5">
            <h1 class="mb-4">Tentang SMA Negeri Karubaga</h1>
            
            <div class="row">
                <div class="col-12">
                    <h3>Sejarah Sekolah</h3>
                    <p>SMA Negeri Karubaga didirikan pada tahun 1985 sebagai salah satu sekolah menengah atas negeri di Kabupaten Karubaga. Sejak berdirinya, sekolah ini telah berkomitmen untuk memberikan pendidikan berkualitas bagi masyarakat Karubaga dan sekitarnya.</p>
                    
                    <h3>Visi</h3>
                    <p>Menjadi lembaga selangkah lebih depan dalam pengembangan talenta manusia yang memberikan kontribusi berarti pada inovasi teknologi dan keberlanjutan sosial.</p>
                    
                    <h3>Misi</h3>
                    <ul>
                        <li>Menyelenggarakan pendidikan berkualitas yang berorientasi pada pengembangan potensi peserta didik</li>
                        <li>Mengembangkan kurikulum yang adaptif terhadap perkembangan zaman dan kebutuhan industri</li>
                        <li>Membangun karakter peserta didik yang berintegritas dan bertanggung jawab</li>
                        <li>Meningkatkan kesejahteraan masyarakat melalui pendidikan berkualitas</li>
                    </ul>
                    
                    <h3>Fasilitas</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li>Ruang kelas ber-AC</li>
                                <li>Laboratorium IPA dan Komputer</li>
                                <li>Perpustakaan lengkap</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>Lapangan olahraga</li>
                                <li>Masjid</li>
                                <li>Kantin sehat</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Navbar styling sama dengan home page */
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
        color: #1a1a1a;
    }
    
    .nav-link {
        font-weight: 500;
        color: #1a1a1a;
        margin: 0 0.5rem;
        transition: color 0.3s ease;
    }
    
    .nav-link:hover {
        color: #19aed7;
    }
    
    .nav-link.active {
        color: white !important;
        font-weight: 600;
    }
</style>
@endsection