@extends('admin.layouts.app')

@section('title', 'Struktur Organisasi - Admin')

@section('content')
<div class="container-fluid px-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">
                <i class="bi bi-diagram-3 text-primary me-2"></i>Struktur Organisasi
            </h4>
            <p class="text-muted mb-0 small">Kelola data struktur organisasi sekolah</p>
        </div>
        <a href="{{ route('admin.struktur-organisasi.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle me-2"></i>Tambah Anggota
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($strukturs->isEmpty())
        {{-- Empty State --}}
        <div class="card border-0 shadow-sm text-center py-5" style="border-radius: 14px;">
            <div class="card-body">
                <i class="bi bi-diagram-3 fs-1 text-muted mb-3 d-block"></i>
                <h5 class="text-muted fw-semibold">Belum Ada Data Struktur Organisasi</h5>
                <p class="text-muted small mb-4">Tambahkan anggota struktur organisasi sekolah</p>
                <a href="{{ route('admin.struktur-organisasi.create') }}" class="btn btn-primary px-4">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Sekarang
                </a>
            </div>
        </div>
    @else
        {{-- Preview Tampilan Publik --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; overflow: hidden;">
            <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                <div class="d-flex align-items-center gap-2 text-white">
                    <i class="bi bi-eye-fill fs-5"></i>
                    <span class="fw-bold">Preview Tampilan Publik</span>
                </div>
            </div>
            <div class="card-body p-4 bg-light">
                {{-- Kepala (urutan 0) --}}
                @php $kepala = $strukturs->where('urutan', 0)->first(); @endphp
                @if($kepala)
                <div class="text-center mb-3">
                    <div class="d-inline-block">
                        <div class="bg-white rounded-3 p-3 shadow-sm" style="min-width: 200px;">
                            <div style="width:80px;height:80px;margin:0 auto 0.6rem;border-radius:50%;overflow:hidden;border:3px solid #2c5282;background:#e2e8f0;">
                                @if($kepala->foto)
                                    <img src="{{ asset('storage/'.$kepala->foto) }}" style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 text-secondary">
                                        <i class="bi bi-person fs-3"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="fw-bold small text-secondary">{{ $kepala->jabatan }}</div>
                            <div class="fw-bold" style="font-size:0.95rem;">{{ $kepala->nama }}</div>
                        </div>
                    </div>
                    <div style="width:2px;height:25px;background:#cbd5e0;margin:0 auto;"></div>
                </div>
                @endif

                {{-- Anggota lainnya --}}
                @php $anggota = $strukturs->where('urutan', '>', 0)->sortBy('urutan'); @endphp
                @if($anggota->isNotEmpty())
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    @foreach($anggota as $item)
                    <div class="bg-white rounded-3 p-3 shadow-sm text-center" style="min-width:160px;max-width:200px;">
                        <div style="width:70px;height:70px;margin:0 auto 0.5rem;border-radius:50%;overflow:hidden;border:3px solid #2c5282;background:#e2e8f0;">
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 text-secondary">
                                    <i class="bi bi-person fs-4"></i>
                                </div>
                            @endif
                        </div>
                        <div class="fw-bold small text-secondary">{{ $item->jabatan }}</div>
                        <div class="fw-semibold" style="font-size:0.85rem;">{{ $item->nama }}</div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        {{-- Tabel Data --}}
        <div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
            <div class="card-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #198754, #146c43);">
                <div class="d-flex align-items-center gap-2 text-white">
                    <i class="bi bi-table fs-5"></i>
                    <span class="fw-bold">Daftar Anggota Struktur Organisasi</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">No</th>
                                <th>Foto</th>
                                <th>Jabatan</th>
                                <th>Nama</th>
                                <th>Urutan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($strukturs as $i => $item)
                            <tr>
                                <td class="px-4">{{ $i + 1 }}</td>
                                <td>
                                    <div style="width:50px;height:50px;border-radius:50%;overflow:hidden;border:2px solid #2c5282;background:#e2e8f0;">
                                        @if($item->foto)
                                            <img src="{{ asset('storage/'.$item->foto) }}" style="width:100%;height:100%;object-fit:cover;">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center h-100 text-secondary">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td><span class="badge bg-primary bg-opacity-10 text-primary fw-semibold px-3 py-2">{{ $item->jabatan }}</span></td>
                                <td class="fw-semibold">{{ $item->nama }}</td>
                                <td>
                                    @if($item->urutan == 0)
                                        <span class="badge bg-warning text-dark">Kepala (0)</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $item->urutan }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Tombol Detail --}}
                                        <button type="button"
                                                class="btn btn-sm btn-info text-white px-3"
                                                onclick="showDetail(
                                                    '{{ addslashes($item->jabatan) }}',
                                                    '{{ addslashes($item->nama) }}',
                                                    '{{ $item->urutan }}',
                                                    '{{ $item->foto ? asset('storage/'.$item->foto) : '' }}',
                                                    '{{ $item->created_at->format('d/m/Y H:i') }}'
                                                )">
                                            <i class="bi bi-eye-fill me-1"></i>Detail
                                        </button>
                                        <a href="{{ route('admin.struktur-organisasi.edit', $item->id) }}"
                                           class="btn btn-sm btn-warning text-white px-3">
                                            <i class="bi bi-pencil-fill me-1"></i>Edit
                                        </a>
                                        <form action="{{ route('admin.struktur-organisasi.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus {{ $item->nama }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger px-3">
                                                <i class="bi bi-trash-fill me-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

</div>

{{-- Modal Detail --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">

            <div class="modal-header border-0"
                 style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                <div class="d-flex align-items-center gap-3 w-100">
                    <div class="rounded-circle bg-white bg-opacity-25 p-2">
                        <i class="bi bi-person-badge fs-4 text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title text-white mb-0">Detail Anggota</h5>
                        <small class="text-white-50">Informasi lengkap struktur organisasi</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
            </div>

            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div style="width:110px;height:110px;border-radius:50%;overflow:hidden;border:4px solid #2c5282;background:#e2e8f0;margin:0 auto 1rem;">
                        <img id="detailFoto" src="" alt="Foto"
                             style="width:100%;height:100%;object-fit:cover;display:none;">
                        <div id="detailFotoPlaceholder"
                             class="d-flex align-items-center justify-content-center"
                             style="width:100%;height:100%;color:#94a3b8;">
                            <i class="bi bi-person" style="font-size:3rem;"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-1" id="detailNama">-</h5>
                    <span class="badge bg-primary px-3 py-2" id="detailJabatanBadge">-</span>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="bi bi-info-circle me-2"></i>Informasi Jabatan
                        </h6>
                        <div class="row mb-2">
                            <div class="col-5 text-muted">Jabatan</div>
                            <div class="col-7 fw-semibold" id="detailJabatan">-</div>
                        </div>
                        <hr class="my-2">
                        <div class="row mb-2">
                            <div class="col-5 text-muted">Nama Lengkap</div>
                            <div class="col-7 fw-semibold" id="detailNamaLengkap">-</div>
                        </div>
                        <hr class="my-2">
                        <div class="row mb-2">
                            <div class="col-5 text-muted">Urutan</div>
                            <div class="col-7">
                                <span class="badge" id="detailUrutan">-</span>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-5 text-muted">Ditambahkan</div>
                            <div class="col-7 fw-semibold" id="detailTanggal">-</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0"
                 style="background-color:#f8f9fa; border-top:1px solid #dee2e6 !important;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Tutup
                </button>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function showDetail(jabatan, nama, urutan, fotoUrl, tanggal) {
    document.getElementById('detailNama').textContent         = nama;
    document.getElementById('detailJabatanBadge').textContent = jabatan;
    document.getElementById('detailJabatan').textContent      = jabatan;
    document.getElementById('detailNamaLengkap').textContent  = nama;
    document.getElementById('detailTanggal').textContent      = tanggal;

    const urutanEl = document.getElementById('detailUrutan');
    if (urutan == 0) {
        urutanEl.className   = 'badge bg-warning text-dark';
        urutanEl.textContent = 'Kepala (0)';
    } else {
        urutanEl.className   = 'badge bg-secondary';
        urutanEl.textContent = urutan;
    }

    const img         = document.getElementById('detailFoto');
    const placeholder = document.getElementById('detailFotoPlaceholder');
    if (fotoUrl && fotoUrl.trim() !== '') {
        img.src                   = fotoUrl;
        img.style.display         = 'block';
        placeholder.style.display = 'none';
    } else {
        img.style.display         = 'none';
        placeholder.style.display = 'flex';
    }

    new bootstrap.Modal(document.getElementById('detailModal')).show();
}
</script>
@endpush
