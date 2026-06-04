@extends('layouts.app')

@section('title', 'Pengumuman - PPDB')

@section('styles')
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
        color: #0d6efd;
    }
    
    .nav-link {
        font-weight: 500;
        color: #333;
        margin: 0 0.5rem;
        transition: color 0.3s ease;
    }
    
    .nav-link:hover {
        color: #0d6efd;
    }
    
    .pengumuman-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .hasil-seleksi {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        margin-bottom: 1rem;
    }
    
    .download-btn {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }
    
    .download-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Pengumuman Utama -->
            <div class="pengumuman-card text-center">
                <i class="bi bi-megaphone-fill fs-1 mb-3"></i>
                <h1 class="mb-3">Pengumuman Hasil Seleksi</h1>
                <p class="lead mb-4">Berikut adalah hasil seleksi pendaftaran siswa baru tahun ajaran {{ date('Y') }}</p>
            </div>
            
            <!-- Dropdown Hasil Seleksi -->
            <div class="hasil-seleksi">
                <h4 class="mb-3">
                    <i class="bi bi-list-check"></i> Hasil Seleksi
                </h4>
                
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle w-100" type="button" id="hasilSeleksiDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-download"></i> Download Hasil Seleksi
                    </button>
                    <ul class="dropdown-menu w-100" aria-labelledby="hasilSeleksiDropdown">
                        <li>
                            <a class="dropdown-item" href="#" onclick="downloadPDF()">
                                <i class="bi bi-file-earmark-pdf text-danger"></i> Download PDF
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="downloadWord()">
                                <i class="bi bi-file-earmark-word text-primary"></i> Download Word
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="downloadExcel()">
                                <i class="bi bi-file-earmark-excel text-success"></i> Download Excel
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Tombol Download Alternatif -->
                <div class="mt-3 text-center">
                    <a href="#" onclick="downloadPDF()" class="download-btn">
                        <i class="bi bi-file-earmark-pdf"></i> Download PDF
                    </a>
                    <a href="#" onclick="downloadWord()" class="download-btn">
                        <i class="bi bi-file-earmark-word"></i> Download Word
                    </a>
                </div>
            </div>
            
            <!-- Informasi Tambahan -->
            <div class="alert alert-info mt-4">
                <i class="bi bi-info-circle"></i>
                <strong>Informasi:</strong> Hasil seleksi dapat diunduh dalam format PDF, Word, atau Excel. 
                Pastikan untuk memeriksa kembali data yang tertera.
            </div>
        </div>
    </div>
</div>

<script>
function downloadPDF() {
    // Logika download PDF
    window.open('/hasil-seleksi/pdf', '_blank');
}

function downloadWord() {
    // Logika download Word
    window.open('/hasil-seleksi/word', '_blank');
}

function downloadExcel() {
    // Logika download Excel
    window.open('/hasil-seleksi/excel', '_blank');
}
</script>
@endsection
