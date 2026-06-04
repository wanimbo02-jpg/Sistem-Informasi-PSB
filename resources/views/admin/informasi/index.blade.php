@extends('admin.layouts.app')

@section('title', 'Kelola Informasi PPDB - PPDB')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark">Kelola Informasi PPDB</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active">Informasi PPDB</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.informasi.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Informasi
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Daftar Informasi PPDB</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Utama</th>
                                    <th>Sub Judul</th>
                                    <th>Jadwal</th>
                                    <th>Persyaratan</th>
                                    <th>Kontak</th>
                                    <th>Status</th>
                                    <th>Tampilkan Di</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($informasis as $index => $informasi)
                                @php
                                    // Parse JSON data dari konten
                                    $dataInformasi = json_decode($informasi->konten, true);
                                    $judulUtama = $dataInformasi['judul'] ?? $informasi->judul;
                                    $subJudul = $dataInformasi['sub_judul'] ?? '';
                                    $jadwal = $dataInformasi['jadwal'] ?? [];
                                    $persyaratan = $dataInformasi['persyaratan'] ?? [];
                                    $kontak = $dataInformasi['kontak'] ?? [];
                                    $status = $dataInformasi['status'] ?? $informasi->status;
                                    $tampilkanDi = $dataInformasi['tampilkan_di'] ?? 'semua';
                                    
                                    // Hitung jumlah data
                                    $jadwalCount = is_array($jadwal) ? count(array_filter($jadwal, fn($item) => !empty($item['kegiatan']))) : 0;
                                    $persyaratanCount = is_array($persyaratan) ? count(array_filter($persyaratan, fn($item) => !empty($item['nama']))) : 0;
                                    $kontakCount = is_array($kontak) ? count(array_filter($kontak, fn($item) => !empty($item['nilai']))) : 0;
                                @endphp
                                <tr>
                                    <td>{{ ($informasis->currentPage() - 1) * $informasis->perPage() + $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $judulUtama }}</strong>
                                        <br>
                                        <small class="text-muted">{{ Str::limit($judulUtama, 50) }}</small>
                                    </td>
                                    <td>{{ $subJudul ?: '-' }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $jadwalCount }} Jadwal</span>
                                        @if($jadwalCount > 0 && $jadwal)
                                            <div class="mt-1">
                                                @foreach(array_slice($jadwal, 0, 2) as $item)
                                                    @if(!empty($item['kegiatan']))
                                                        <small class="d-block text-muted">{{ $item['kegiatan'] }}: {{ $item['tanggal'] }}</small>
                                                    @endif
                                                @endforeach
                                                @if($jadwalCount > 2)
                                                    <small class="text-muted">... dan {{ $jadwalCount - 2 }} lainnya</small>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">{{ $persyaratanCount }} Persyaratan</span>
                                        @if($persyaratanCount > 0 && $persyaratan)
                                            <div class="mt-1">
                                                @foreach(array_slice($persyaratan, 0, 2) as $item)
                                                    @if(!empty($item['nama']))
                                                        <small class="d-block text-muted">{{ $item['nama'] }}</small>
                                                    @endif
                                                @endforeach
                                                @if($persyaratanCount > 2)
                                                    <small class="text-muted">... dan {{ $persyaratanCount - 2 }} lainnya</small>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-success">{{ $kontakCount }} Kontak</span>
                                        @if($kontakCount > 0 && $kontak)
                                            <div class="mt-1">
                                                @foreach(array_slice($kontak, 0, 2) as $item)
                                                    @if(!empty($item['nilai']))
                                                        <small class="d-block text-muted">{{ ucfirst($item['tipe']) }}: {{ $item['nilai'] }}</small>
                                                    @endif
                                                @endforeach
                                                @if($kontakCount > 2)
                                                    <small class="text-muted">... dan {{ $kontakCount - 2 }} lainnya</small>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $status == 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $status == 'aktif' ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $tampilkanDi == 'semua' ? 'bg-primary' : ($tampilkanDi == 'beranda' ? 'bg-info' : 'bg-secondary') }}">
                                            {{ ucfirst($tampilkanDi) }}
                                        </span>
                                    </td>
                                    <td>{{ $informasi->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.informasi.edit', $informasi->id) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="{{ route('admin.informasi.show', $informasi->id) }}" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.informasi.destroy', $informasi->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger text-white" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus informasi PPDB ini? Semua data jadwal, persyaratan, dan kontak akan ikut terhapus.')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                        <p class="text-muted">Belum ada informasi PPDB</p>
                                        <p class="text-muted small">Klik tombol "Tambah Informasi" untuk membuat informasi PPDB baru dengan jadwal, persyaratan, dan kontak.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($informasis->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $informasis->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection