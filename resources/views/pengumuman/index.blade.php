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
        border-left: 4px solid #667eea;
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        transition: all 0.3s;
    }
    
    .pengumuman-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.12);
    }
    
    .pengumuman-date {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    .pengumuman-title {
        color: #333;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .pengumuman-content {
        color: #666;
        line-height: 1.6;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header -->
            <div class="text-center mb-5">
                <i class="bi bi-megaphone-fill fs-1 text-primary mb-3"></i>
                <h1 class="mb-3">Pengumuman PPDB</h1>
                <p class="lead text-muted">Informasi terkini seputar pendaftaran siswa baru</p>
            </div>
            
            <!-- Daftar Pengumuman -->
            @if(isset($pengumuman) && count($pengumuman) > 0)
            <div class="pengumuman-list">
                @foreach($pengumuman as $item)
                <div class="pengumuman-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="pengumuman-title">{{ $item->judul ?? 'Pengumuman PPDB' }}</h5>
                            <div class="pengumuman-date">
                                <i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </div>
                        </div>
                        <span class="badge bg-primary text-white">Baru</span>
                    </div>
                    <div class="pengumuman-content">
                        {!! $item->isi ?? 'Tidak ada konten pengumuman.' !!}
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $pengumuman->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <i class="bi bi-megaphone-x fs-1 text-muted d-block mb-3"></i>
                <h4 class="text-muted">Belum Ada Pengumuman</h4>
                <p class="text-muted">Belum ada pengumuman yang tersedia saat ini.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
