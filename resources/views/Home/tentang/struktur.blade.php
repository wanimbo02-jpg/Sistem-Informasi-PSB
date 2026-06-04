@extends('layouts.app')

@section('title', 'Struktur Organisasi SMA Negeri Karubaga')

@section('content')
<div class="py-5">
    <div class="container">

        {{-- Judul --}}
        @php
            $firstStruktur = $strukturs->first();
            $judulUtama = $firstStruktur ? $firstStruktur->judul_utama : 'STRUKTUR ORGANISASI';
            $subJudul = $firstStruktur ? $firstStruktur->sub_judul : 'SMA NEGERI KARUBAGA';
            $kepala = $strukturs->where('urutan', 0)->first();
            $teksDeskripsi = $strukturs->whereNotNull('teks_bawah_foto')->where('teks_bawah_foto', '!=', '')->first();
        @endphp
        <h2 style="text-align:center;color:#1e3c72;margin-bottom:0.5rem;font-weight:bold;">{{ $judulUtama }}</h2>
        <h4 style="text-align:center;color:#2c5282;margin-bottom:3rem;">{{ $subJudul }}</h4>

        @if($strukturs->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-diagram-3" style="font-size:4rem;color:#ccc;"></i>
                <p class="text-muted mt-3">Belum ada data struktur organisasi.</p>
            </div>
        @else

            {{-- Kepala Sekolah (urutan 0) --}}
            @if($kepala)
            <div style="text-align:center;margin-bottom:2rem;">
                <div style="display:inline-block;padding:1.5rem;min-width:280px;">
                    <div style="background:white;border-radius:12px;padding:1.2rem;box-shadow:0 4px 12px rgba(0,0,0,0.1);">
                        <div style="width:100px;height:100px;margin:0 auto 1rem;border-radius:50%;overflow:hidden;border:3px solid #2c5282;background:#e2e8f0;">
                            @if($kepala->foto)
                                <img src="{{ asset('storage/'.$kepala->foto) }}"
                                     alt="{{ $kepala->jabatan }}"
                                     style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#94a3b8;">
                                    <i class="bi bi-person" style="font-size:2.5rem;"></i>
                                </div>
                            @endif
                        </div>
                        <div style="font-weight:bold;font-size:1rem;color:#2d3748;">{{ $kepala->jabatan }}</div>
                        <div style="font-size:1.2rem;font-weight:bold;color:#1a202c;margin:0.5rem 0;">{{ $kepala->nama }}</div>
                    </div>
                </div>
            </div>

            {{-- Garis Penghubung --}}
            @php $anggota = $strukturs->where('urutan', '>', 0)->sortBy('urutan'); @endphp
            @if($anggota->isNotEmpty())
            <div style="text-align:center;margin-bottom:2rem;">
                <div style="width:2px;height:30px;background:#cbd5e0;margin:0 auto;"></div>
            </div>
            @endif
            @endif

            {{-- Anggota Lainnya --}}
            @php $anggota = $strukturs->where('urutan', '>', 0)->sortBy('urutan'); @endphp
            @if($anggota->isNotEmpty())
            <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:2rem;">
                @foreach($anggota as $item)
                <div style="flex:1;min-width:220px;max-width:260px;text-align:center;">
                    <div style="background:white;border-radius:12px;padding:1.2rem;box-shadow:0 4px 12px rgba(0,0,0,0.1);">
                        <div style="width:100px;height:100px;margin:0 auto 0.8rem;border-radius:50%;overflow:hidden;border:3px solid #2c5282;background:#e2e8f0;">
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}"
                                     alt="{{ $item->jabatan }}"
                                     style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#94a3b8;">
                                    <i class="bi bi-person" style="font-size:2.5rem;"></i>
                                </div>
                            @endif
                        </div>
                        <div style="font-weight:bold;font-size:1rem;color:#2d3748;">{{ $item->jabatan }}</div>
                        <div style="font-size:1rem;font-weight:600;color:#1a202c;margin:0.5rem 0;">{{ $item->nama }}</div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Teks Deskripsi (dari record pertama yang memiliki teks) --}}
            @if($teksDeskripsi && $teksDeskripsi->teks_bawah_foto)
            <div style="margin-top:3rem;padding:2rem;background:#f8f9fa;border-radius:12px;">
                <div style="text-align:justify;max-width:900px;margin:0 auto;">
                    <p style="font-size:1rem;color:#4a5568;line-height:1.8;">{{ $teksDeskripsi->teks_bawah_foto }}</p>
                </div>
            </div>
            @endif

        @endif

    </div>
</div>

<style>
.navbar {
    background: rgba(241,234,241,0.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 20px rgba(0,0,0,0.1);
    padding: 1.5rem 0;
    transition: all 0.3s ease;
}
.navbar-brand { font-weight:700; font-size:1.5rem; color:#1a1a1a; }
.nav-link { font-weight:500; color:#ffffff; margin:0 0.5rem; transition:color 0.3s ease; }
.nav-link:hover { color:#0d6efd; }
.nav-link.active { color:white !important; font-weight:600; }
</style>
@endsection
