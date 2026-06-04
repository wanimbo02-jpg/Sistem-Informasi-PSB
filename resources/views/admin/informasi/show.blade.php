@extends('admin.layouts.app')

@section('title', 'Detail Informasi - PPDB')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark">Detail Informasi PPDB</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.informasi.index') }}" class="text-decoration-none">Informasi</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.informasi.edit', $informasi->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="{{ route('admin.informasi.index') }}" class="btn btn-secondary ms-2">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Detail Informasi</h5>
                        <span class="badge {{ $informasi->status == 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                            {{ $informasi->status == 'aktif' ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Informasi Umum -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Informasi Umum</h6>
                        <table class="table table-sm">
                            <tr>
                                <td width="150"><strong>Judul:</strong></td>
                                <td>{{ $judul }}</td>
                            </tr>
                            <tr>
                                <td><strong>Sub Judul:</strong></td>
                                <td>{{ $subJudul ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tampilkan Di:</strong></td>
                                <td>{{ ucfirst($tampilkanDi) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Dibuat:</strong></td>
                                <td>{{ $informasi->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Diperbarui:</strong></td>
                                <td>{{ $informasi->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Preview Konten -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Preview Konten</h6>
                        <div class="border rounded p-3 bg-light">
                            @if($kontenHtml)
                                {!! $kontenHtml !!}
                            @else
                                <p class="text-muted">Format data tidak valid</p>
                            @endif
                        </div>
                    </div>

                    <!-- Foto Siswa -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Foto Siswa Diterima</h6>
                        <div class="row">
                            <div class="col-md-4">
                                @if($fotoSiswa)
                                    <img src="{{ asset('storage/' . $fotoSiswa) }}" 
                                         class="img-fluid rounded border" 
                                         style="max-width: 200px; max-height: 200px; object-fit: cover;"
                                         alt="Foto Siswa">
                                @else
                                    <div class="border rounded d-flex align-items-center justify-content-center bg-light" 
                                         style="width: 200px; height: 200px;">
                                        <i class="bi bi-person-circle fs-1 text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <table class="table table-sm">
                                    <tr>
                                        <td width="150"><strong>Nama Siswa:</strong></td>
                                        <td>{{ $namaSiswa ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Keterangan:</strong></td>
                                        <td>{{ $keteranganSiswa ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status Foto:</strong></td>
                                        <td>
                                            <span class="badge {{ $fotoSiswa ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $fotoSiswa ? 'Ada' : 'Tidak Ada' }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Data Detail -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <h6 class="text-muted mb-3">Jadwal ({{ count($jadwal) }})</h6>
                            @if($jadwal && count($jadwal) > 0)
                                @foreach($jadwal as $item)
                                    @if(!empty($item['kegiatan']))
                                    <div class="border rounded p-2 mb-2">
                                        <small class="d-block fw-bold">{{ $item['kegiatan'] }}</small>
                                        <small class="text-muted">{{ $item['tanggal'] }}</small>
                                        @if(!empty($item['keterangan']))
                                            <small class="d-block text-muted">{{ $item['keterangan'] }}</small>
                                        @endif
                                    </div>
                                    @endif
                                @endforeach
                            @else
                                <p class="text-muted">Tidak ada jadwal</p>
                            @endif
                        </div>
                        
                        <div class="col-md-4">
                            <h6 class="text-muted mb-3">Persyaratan ({{ count($persyaratan) }})</h6>
                            @if($persyaratan && count($persyaratan) > 0)
                                @foreach($persyaratan as $index => $item)
                                    @if(!empty($item['nama']))
                                    <div class="border rounded p-2 mb-2">
                                        <small class="d-block">{{ $index + 1 }}. {{ $item['nama'] }}</small>
                                    </div>
                                    @endif
                                @endforeach
                            @else
                                <p class="text-muted">Tidak ada persyaratan</p>
                            @endif
                        </div>
                        
                        <div class="col-md-4">
                            <h6 class="text-muted mb-3">Kontak ({{ count($kontak) }})</h6>
                            @if($kontak && count($kontak) > 0)
                                @foreach($kontak as $item)
                                    @if(!empty($item['nilai']))
                                    <div class="border rounded p-2 mb-2">
                                        <small class="d-block fw-bold">{{ ucfirst($item['tipe']) }}</small>
                                        <small class="text-muted">{{ $item['nilai'] }}</small>
                                    </div>
                                    @endif
                                @endforeach
                            @else
                                <p class="text-muted">Tidak ada kontak</p>
                            @endif
                        </div>
                    </div>

                    <!-- Data Summary -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Ringkasan Data</h6>
                        <div class="border rounded p-3 bg-light">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Judul:</strong> {{ $judul }}<br>
                                    <strong>Sub Judul:</strong> {{ $subJudul ?: '-' }}<br>
                                    <strong>Status:</strong> {{ $status }}<br>
                                    <strong>Tampilkan Di:</strong> {{ $tampilkanDi }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Jumlah Jadwal:</strong> {{ count($jadwal) }}<br>
                                    <strong>Jumlah Persyaratan:</strong> {{ count($persyaratan) }}<br>
                                    <strong>Jumlah Kontak:</strong> {{ count($kontak) }}<br>
                                    <strong>Panjang Konten:</strong> {{ strlen($kontenHtml) }} karakter
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
