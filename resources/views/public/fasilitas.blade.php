@extends('layouts.app')

@section('title', 'Fasilitas Sekolah - SMA Negeri Karubaga')

@section('content')
<div class="container py-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold display-5 mb-3">Fasilitas SMA Negeri Karubaga</h2>
        <p class="lead text-muted">SMA Negeri Karubaga dilengkapi dengan berbagai fasilitas modern untuk mendukung proses belajar mengajar yang nyaman dan berkualitas.</p>
    </div>

    @if($fasilitas->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-building fs-1 text-muted d-block mb-3"></i>
            <p class="text-muted fs-5">Belum ada data fasilitas yang tersedia.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($fasilitas as $item)
            <div class="col-md-4 col-sm-6">
                <div class="card border-0 shadow-sm h-100 fasilitas-card">
                    <div style="overflow: hidden; height: 220px;">
                        <img src="{{ asset('storage/' . $item->gambar) }}"
                             alt="{{ $item->nama }}"
                             class="fasilitas-img w-100 h-100"
                             style="object-fit: cover; transition: transform 0.4s ease;">
                    </div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-2">{{ $item->nama }}</h5>
                        <p class="text-muted mb-0" style="font-size: 0.93rem; line-height: 1.6;">
                            {{ $item->deskripsi }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

</div>
@endsection

@section('styles')
<style>
    .fasilitas-card {
        border-radius: 12px;
        overflow: hidden;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    .fasilitas-card:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.12) !important;
        transform: translateY(-4px);
    }
    .fasilitas-card:hover .fasilitas-img {
        transform: scale(1.05);
    }
</style>
@endsection
