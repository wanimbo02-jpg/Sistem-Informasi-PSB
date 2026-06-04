@extends('layouts.public-home')

@section('title', 'Informasi Pendaftaran - PPDB')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark">Informasi Pendaftaran</h2>
                <p class="text-muted">Dapatkan informasi terbaru seputar pendaftaran siswa baru</p>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse($informasis as $informasi)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    @php
                        $dataInformasi = json_decode($informasi->konten, true);
                        $judul = $dataInformasi['judul'] ?? $informasi->judul;
                        $subJudul = $dataInformasi['sub_judul'] ?? '';
                    @endphp
                    <h5 class="card-title text-primary">{{ $judul }}</h5>
                    @if($subJudul)
                        <h6 class="text-muted mb-3">{{ $subJudul }}</h6>
                    @endif
                    <div class="card-text text-muted">
                        @if($dataInformasi && isset($dataInformasi['konten']))
                            {!! Str::limit(strip_tags($dataInformasi['konten']), 200) !!}
                        @else
                            {{ Str::limit($informasi->konten, 150) }}
                        @endif
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="bi bi-calendar3"></i> {{ $informasi->created_at->format('d M Y') }}
                        </small>
                        <a href="{{ route('informasi-pendaftaran.show', $informasi->id) }}" class="btn btn-sm btn-outline-primary">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                <h5 class="text-muted">Belum Ada Informasi</h5>
                <p class="text-muted">Belum ada informasi pendaftaran yang tersedia saat ini.</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($informasis->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $informasis->links() }}
    </div>
    @endif
</div>
@endsection
