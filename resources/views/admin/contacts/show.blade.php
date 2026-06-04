@extends('admin.layouts.app')

@section('title', 'Detail Kontak - ' . $contact->name)

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-envelope me-2"></i>Detail Pesan
                        </h5>
                        <div>
                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h6 class="text-primary mb-3">Informasi Pengirim</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="150"><strong>Nama:</strong></td>
                                        <td>{{ $contact->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>
                                            <a href="mailto:{{ $contact->email }}" class="text-decoration-none">
                                                {{ $contact->email }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Telepon:</strong></td>
                                        <td>{{ $contact->phone ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Perusahaan:</strong></td>
                                        <td>{{ $contact->company ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td>{!! $contact->status_badge !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal:</strong></td>
                                        <td>{{ $contact->created_at->format('d F Y H:i') }}</td>
                                    </tr>
                                    @if($contact->replied_at)
                                        <tr>
                                            <td><strong>Dibalas:</strong></td>
                                            <td>{{ $contact->replied_at->format('d F Y H:i') }}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>

                            <div class="mb-4">
                                <h6 class="text-primary mb-3">Pesan</h6>
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <p class="mb-0">{{ $contact->message }}</p>
                                    </div>
                                </div>
                            </div>

                            @if($contact->admin_reply)
                                <div class="mb-4">
                                    <h6 class="text-success mb-3">Balasan Admin</h6>
                                    <div class="card bg-success bg-opacity-10">
                                        <div class="card-body">
                                            <p class="mb-0">{{ $contact->admin_reply }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Aksi Cepat</h6>
                                </div>
                                <div class="card-body">
                                    @if($contact->status !== 'replied')
                                        <button class="btn btn-success w-100 mb-2" 
                                                onclick="openReplyModal({{ $contact->id }})">
                                            <i class="fas fa-reply me-2"></i>Balas Pesan
                                        </button>
                                    @endif

                                    <a href="mailto:{{ $contact->email }}" class="btn btn-primary w-100 mb-2">
                                        <i class="fas fa-envelope me-2"></i>Email Langsung
                                    </a>

                                    @if($contact->phone)
                                        <a href="tel:{{ $contact->phone }}" class="btn btn-info w-100 mb-2">
                                            <i class="fas fa-phone me-2"></i>Telepon
                                        </a>
                                    @endif

                                    <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100" 
                                                onclick="return confirm('Hapus pesan ini?')">
                                            <i class="fas fa-trash me-2"></i>Hapus Pesan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Balas Pesan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.contacts.reply', $contact) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Ke:</label>
                        <input type="text" class="form-control" value="{{ $contact->email }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pesan Asli:</label>
                        <textarea class="form-control" rows="3" readonly>{{ $contact->message }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Balasan:</label>
                        <textarea name="reply" class="form-control" rows="5" required 
                                  placeholder="Tulis balasan Anda..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Balasan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openReplyModal(contactId) {
    const modal = new bootstrap.Modal(document.getElementById('replyModal'));
    modal.show();
}
</script>
@endsection
