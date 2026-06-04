@extends('layouts.public-home')

@section('title', $informasi->judul . ' - PPDB')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('informasi-pendaftaran.index') }}" class="text-decoration-none">Informasi Pendaftaran</a></li>
                    <li class="breadcrumb-item active">{{ $informasi->judul }}</li>
                </ol>
            </nav>

            <!-- Content dari Database -->
            <article class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @php
                        $dataInformasi = json_decode($informasi->konten, true);
                        if ($dataInformasi && isset($dataInformasi['konten'])) {
                            echo $dataInformasi['konten'];
                        } else {
                            // Fallback jika format lama
                            echo '<p class="fs-5">' . nl2br(e($informasi->konten)) . '</p>';
                        }
                    @endphp
                </div>
            </article>

            <!-- Back Button -->
            <div class="text-center mt-4">
                <a href="{{ route('informasi-pendaftaran.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Informasi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
