@extends('layouts.app')

@section('title', 'Fasilitas Sekolah')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h3 class="mb-4"><strong>Fasilitas SMA Negeri Karubaga</strong></h3>
            <p class="lead">SMA Negeri Karubaga dilengkapi dengan berbagai fasilitas modern untuk mendukung proses belajar mengajar yang nyaman dan berkualitas.</p>
        </div>
    </div>

    <!-- Fasilitas dari Database (Admin) -->
    @if(isset($fasilitas) && $fasilitas->count() > 0)
    <div class="row">
        @foreach($fasilitas as $item)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('storage/' . $item->gambar) }}"
                     class="card-img-top"
                     alt="{{ $item->nama }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $item->nama }}</h5>
                    <p class="card-text flex-grow-1">{{ Str::limit($item->deskripsi, 100) }}</p>
                    <div class="mt-auto">
                        <a href="{{ route('fasilitas.publik.detail', $item->id) }}" class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @else
    <!-- Fallback: Data statis jika belum ada data dari admin -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/komputer.jpg') }}" class="card-img-top" alt="Lab Komputer">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Laboratorium Komputer</h5>
                    <p class="card-text flex-grow-1">Laboratorium komputer modern dengan 40 unit PC, akses internet cepat, dan software pembelajaran terkini untuk mendukung pembelajaran teknologi informasi atau untuk melakukan ujian.</p>
                    <div class="mt-auto">
                        <button class="btn btn-primary btn-sm w-100" onclick="showDetail('Laboratorium Komputer', 'Laboratorium komputer modern dengan 40 unit PC, akses internet cepat, dan software pembelajaran terkini untuk mendukung pembelajaran teknologi informasi atau untuk melakukan ujian.', 'komputer.jpg')">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/Laboratorium IPA.jpg') }}" class="card-img-top" alt="Lab IPA">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Laboratorium IPA</h5>
                    <p class="card-text flex-grow-1">Laboratorium fisika, kimia, dan biologi lengkap dengan alat-alat praktikum modern untuk mendukung pembelajaran sains, atau praktek langsung di ruang laboratorium dengan menggunakan alat-alat.</p>
                    <div class="mt-auto">
                        <button class="btn btn-primary btn-sm w-100" onclick="showDetail('Laboratorium IPA', 'Laboratorium fisika, kimia, dan biologi lengkap dengan alat-alat praktikum modern untuk mendukung pembelajaran sains, atau praktek langsung di ruang laboratorium dengan menggunakan alat-alat.', 'Laboratorium IPA.jpg')">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/perpus.jpg') }}" class="card-img-top" alt="Perpustakaan">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Perpustakaan Digital</h5>
                    <p class="card-text flex-grow-1">Perpustakaan dengan koleksi ribuan buku fisik dan digital, area baca nyaman, serta akses ke jurnal ilmiah nasional dan internasional serta jaringan koneksi dalam perpustakaan otomatis terjamin.</p>
                    <div class="mt-auto">
                        <button class="btn btn-primary btn-sm w-100" onclick="showDetail('Perpustakaan Digital', 'Perpustakaan dengan koleksi ribuan buku fisik dan digital, area baca nyaman, serta akses ke jurnal ilmiah nasional dan internasional serta jaringan koneksi dalam perpustakaan otomatis terjamin.', 'perpus.jpg')">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/olahraga.jpeg') }}" class="card-img-top" alt="Lapangan Olahraga">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Lapangan Olahraga</h5>
                    <p class="card-text flex-grow-1">Lapangan sepak bola, basket, voli, dan futsal dengan fasilitas yang memadai untuk mendukung kegiatan ekstrakurikuler olahraga.</p>
                    <div class="mt-auto">
                        <button class="btn btn-primary btn-sm w-100" onclick="showDetail('Lapangan Olahraga', 'Lapangan sepak bola, basket, voli, dan futsal dengan fasilitas yang memadai untuk mendukung kegiatan ekstrakurikuler olahraga.', 'olahraga.jpeg')">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/Aula.jpg') }}" class="card-img-top" alt="Aula">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Aula Serbaguna</h5>
                    <p class="card-text flex-grow-1">Aula berkapasitas 500 orang dengan sistem audio visual lengkap, cocok untuk berbagai kegiatan sekolah dan pertemuan.</p>
                    <div class="mt-auto">
                        <button class="btn btn-primary btn-sm w-100" onclick="showDetail('Aula Serbaguna', 'Aula berkapasitas 500 orang dengan sistem audio visual lengkap, cocok untuk berbagai kegiatan sekolah dan pertemuan.', 'Aula.jpg')">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/kantorguru.jpeg') }}" class="card-img-top" alt="Kantor Guru">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Kantor Guru</h5>
                    <p class="card-text flex-grow-1">Ruang kantor guru merupakan salah satu fasilitas utama di sekolah yang digunakan sebagai tempat bekerja bagi para guru. Di SMAN Karubaga, ruang ini berfungsi sebagai pusat kegiatan administratif dan akademik guru dalam menjalankan tugasnya sebagai pendidik.</p>
                    <div class="mt-auto">
                        <button class="btn btn-primary btn-sm w-100" onclick="showDetail('Kantor Guru', 'Ruang kantor guru merupakan salah satu fasilitas utama di sekolah yang digunakan sebagai tempat bekerja bagi para guru. Di SMAN Karubaga, ruang ini berfungsi sebagai pusat kegiatan administratif dan akademik guru dalam menjalankan tugasnya sebagai pendidik.', 'kantorguru.jpeg')">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>

<!-- Modal Detail Fasilitas -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-building me-2"></i><span id="modalTitle">Detail Fasilitas</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img id="modalImage" src="" class="img-fluid rounded" alt="Fasilitas">
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">Deskripsi Fasilitas</h6>
                        <p id="modalDescription" class="text-muted"></p>
                        
                        <div class="mt-4">
                            <h6 class="text-primary mb-2">Informasi Tambahan</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check-circle text-success me-2"></i>Fasilitas Modern</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Standar Nasional</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Tersedia untuk Siswa</li>
                            </ul>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.3s ease;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow: hidden;
    }
    .card:hover { transform: translateY(-5px); }
    .card-img-top { height: 220px; object-fit: cover; }
    .card-title { font-weight: 600; margin-bottom: 1rem; }
    .card-text { color: #666; line-height: 1.6; }
    .lead { font-size: 1.1rem; color: #555; max-width: 800px; margin: 0 auto; }
    
    .modal-header {
        border-radius: 0.375rem 0.375rem 0 0;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    }
    .nav-link {
        font-weight: 500;
        color: #f1f1f1 !important;  /* Menu navbar hitam */
        margin: 0 0.5rem;
        transition: color 0.3s ease;
    }
</style>

<script>
function showDetail(title, description, image) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalDescription').textContent = description;
    
    // Build full image path
    var imagePath = '{{ asset("images/") }}' + image;
    document.getElementById('modalImage').src = imagePath;
    
    // Debug: Log image path
    console.log('Loading image:', imagePath);
    
    // Handle image loading errors
    document.getElementById('modalImage').onerror = function() {
        console.log('Image failed to load, trying fallback...');
        // Try common image names
        if (image.includes('komputer')) {
            this.src = '{{ asset("images/komputer.jpg") }}';
        } else if (image.includes('Laboratorium')) {
            this.src = '{{ asset("images/Laboratorium IPA.jpg") }}';
        } else if (image.includes('perpus')) {
            this.src = '{{ asset("images/perpus.jpg") }}';
        } else if (image.includes('olahraga')) {
            this.src = '{{ asset("images/olahraga.jpeg") }}';
        } else if (image.includes('Aula')) {
            this.src = '{{ asset("images/Aula.jpg") }}';
        } else if (image.includes('kantorguru')) {
            this.src = '{{ asset("images/kantorguru.jpeg") }}';
        } else {
            // Default fallback
            this.src = '{{ asset("images/SMAN Karubaga.jpg") }}';
        }
    };
    
    var modal = new bootstrap.Modal(document.getElementById('detailModal'));
    modal.show();
}
</script>
@endsection
