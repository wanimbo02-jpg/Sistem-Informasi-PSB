@extends('admin.layouts.app')

@section('title', 'Kontak User')

@push('styles')
<style>
    /* Messenger Style Animations - Hanya untuk halaman kontak */
    .main-content {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }
    
    /* Animated Background - Hanya di main content */
    .main-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.03), transparent);
        animation: shimmerBackground 20s infinite linear;
        pointer-events: none;
        z-index: 0;
    }
    
    @keyframes shimmerBackground {
        0% { transform: translateX(-100%) translateY(-100%); }
        100% { transform: translateX(100%) translateY(100%); }
    }
    
    /* Floating Bubbles - Hanya di main content */
    .floating-bubble {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 8s ease-in-out infinite;
        pointer-events: none;
        z-index: 1;
    }
    
    .bubble-1 { width: 60px; height: 60px; top: 10%; left: 5%; animation-delay: 0s; }
    .bubble-2 { width: 40px; height: 40px; top: 20%; left: 85%; animation-delay: 1s; }
    .bubble-3 { width: 80px; height: 80px; top: 60%; left: 10%; animation-delay: 2s; }
    .bubble-4 { width: 50px; height: 50px; top: 80%; left: 80%; animation-delay: 3s; }
    .bubble-5 { width: 70px; height: 70px; top: 40%; left: 50%; animation-delay: 4s; }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-30px) rotate(180deg); }
    }
    
    /* Header Card Animation */
    .card:first-child {
        animation: slideInDown 0.8s ease-out;
        position: relative;
        z-index: 10;
    }
    
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Header Shimmer Effect */
    .card:first-child::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        animation: headerShimmer 3s infinite;
        border-radius: inherit;
    }
    
    @keyframes headerShimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    /* Chat Container Animation */
    .card:nth-child(2) {
        animation: slideInUp 0.8s ease-out 0.3s both;
        position: relative;
        z-index: 5;
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Chat Thread Animations */
    .chat-thread {
        animation: fadeInScale 0.5s ease-out;
        animation-fill-mode: both;
        transition: all 0.3s ease;
    }
    
    .chat-thread:nth-child(1) { animation-delay: 0.5s; }
    .chat-thread:nth-child(2) { animation-delay: 0.6s; }
    .chat-thread:nth-child(3) { animation-delay: 0.7s; }
    .chat-thread:nth-child(4) { animation-delay: 0.8s; }
    .chat-thread:nth-child(5) { animation-delay: 0.9s; }
    .chat-thread:nth-child(6) { animation-delay: 1.0s; }
    
    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    /* Chat Thread Hover Effects */
    .chat-thread:hover {
        background: rgba(0, 132, 255, 0.02);
        transform: translateX(5px);
        box-shadow: 0 5px 20px rgba(0, 132, 255, 0.1);
    }
    
    /* Contact Header Avatar Animation */
    .contact-header .rounded-circle {
        animation: rotateIn 0.8s ease-out;
        transition: all 0.3s ease;
    }
    
    @keyframes rotateIn {
        from {
            opacity: 0;
            transform: rotate(-180deg) scale(0.5);
        }
        to {
            opacity: 1;
            transform: rotate(0deg) scale(1);
        }
    }
    
    .contact-header:hover .rounded-circle {
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(0, 132, 255, 0.3);
    }
    
    /* Message Bubble Animations */
    .message-bubble-user {
        animation: slideInLeft 0.5s ease-out;
    }
    
    .message-bubble-admin {
        animation: slideInRight 0.5s ease-out;
    }
    
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    /* Message Bubble Hover Effects */
    .message-bubble-user .bg-white:hover,
    .message-bubble-admin .bg-primary:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    /* Reply Input Animation */
    .reply-input-area {
        animation: fadeInUp 0.5s ease-out 0.3s both;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Reply Input Focus Effects */
    .reply-form .form-control:focus {
        background: rgba(0, 132, 255, 0.05);
        border-color: #0084ff;
        box-shadow: 0 0 0 3px rgba(0, 132, 255, 0.1);
        transform: scale(1.02);
        transition: all 0.3s ease;
    }
    
    /* Send Button Animation */
    .reply-form .btn-success {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .reply-form .btn-success::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .reply-form .btn-success:hover::before {
        left: 100%;
    }
    
    .reply-form .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(37, 211, 102, 0.4);
    }
    
    /* Detail Button Animation */
    .btn-outline-primary.rounded-circle {
        animation: rotateIn 0.8s ease-out 1s both;
        transition: all 0.3s ease;
    }
    
    .btn-outline-primary.rounded-circle:hover {
        transform: scale(1.1) rotate(15deg);
        background: #0084ff;
        border-color: #0084ff;
        color: white;
        box-shadow: 0 5px 15px rgba(0, 132, 255, 0.3);
    }
    
    /* Dropdown Animation */
    .dropdown-menu {
        animation: dropdownSlide 0.3s ease-out;
        transform-origin: top right;
    }
    
    @keyframes dropdownSlide {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(-10px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    
    /* Badge Animation */
    .badge {
        animation: badgePulse 2s ease-in-out infinite;
    }
    
    @keyframes badgePulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    /* Empty State Animation */
    .fa-comments.fa-4x {
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
    
    /* Modal Animation */
    .modal-content {
        animation: modalSlideIn 0.3s ease-out;
    }
    
    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    
    /* Pagination Animation */
    .pagination {
        animation: fadeIn 0.5s ease-out 1.2s both;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .floating-bubble { display: none; }
        .chat-thread:hover { transform: none; }
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <!-- Animated Background Bubbles -->
    <div class="floating-bubble bubble-1"></div>
    <div class="floating-bubble bubble-2"></div>
    <div class="floating-bubble bubble-3"></div>
    <div class="floating-bubble bubble-4"></div>
    <div class="floating-bubble bubble-5"></div>

    <div class="container-fluid py-4" style="position: relative; z-index: 2;">
        <div class="row">
            <div class="col-12">
            <!-- Messenger Style Header -->
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #0084ff 0%, #0051cc 100%);">
                <div class="card-body text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1">
                                <i class="fas fa-comments me-2"></i>
                                <strong>Pesan Masuk</strong>
                                @if($unreadCount > 0)
                                    <span class="badge bg-warning text-dark ms-2">{{ $unreadCount }} Baru</span>
                                @endif
                            </h4>
                            <small class="opacity-75">Chat dengan pengunjung website</small>
                        </div>
                        <div class="d-flex gap-2">
                            <form method="POST" action="{{ route('admin.contacts.mark-read') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="contact_ids" id="selectedContacts">
                                <button type="submit" class="btn btn-light btn-sm" onclick="submitSelected()">
                                    <i class="fas fa-envelope-open me-1"></i>Tandai Dibaca
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.contacts.delete-multiple') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="contact_ids" id="deleteContacts">
                                <button type="submit" class="btn btn-outline-light btn-sm" onclick="deleteSelected()">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Messenger Style Chat Container -->
            <div class="card border-0 shadow-sm mt-3" style="height: 600px;">
                <div class="card-body p-0" style="height: 100%; overflow: hidden;">
                    @if($contacts->isEmpty())
                        <div class="text-center py-5" style="background: #f0f2f5; height: 100%;">
                            <div class="mb-4">
                                <i class="fas fa-comments fa-4x text-muted opacity-50"></i>
                            </div>
                            <h5 class="text-muted">Belum ada pesan masuk</h5>
                            <p class="text-muted mb-0">Chat dari pengunjung akan ditampilkan di sini</p>
                        </div>
                    @else
                        <!-- Chat List -->
                        <div class="chat-container" style="height: 100%; overflow-y: auto; background: #f0f2f5;">
                            @foreach($contacts as $contact)
                                <div class="chat-thread border-bottom" id="chat-{{ $contact->id }}">
                                    <!-- Contact Header -->
                                    <div class="contact-header d-flex align-items-center p-3 bg-white border-bottom">
                                        <div class="me-3">
                                            <input type="checkbox" class="contact-checkbox" value="{{ $contact->id }}">
                                        </div>
                                        <div class="me-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width: 45px; height: 45px; background: {{ $contact->status === 'unread' ? '#0084ff' : '#6c757d' }}; color: white;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <div class="d-flex align-items-center">
                                                        <strong class="me-2">{{ $contact->name }}</strong>
                                                        {!! $contact->status_badge !!}
                                                    </div>
                                                    <div class="text-muted small">{{ $contact->email }}</div>
                                                    @if($contact->company)
                                                        <div class="text-muted small">{{ $contact->company }}</div>
                                                    @endif
                                                </div>
                                                <div class="text-end">
                                                    <div class="text-muted small">{{ $contact->created_at->format('H:i') }}</div>
                                                    <div class="text-muted small">{{ $contact->created_at->format('d M') }}</div>
                                                    <div class="dropdown mt-1">
                                                        <button class="btn btn-sm btn-link text-muted p-0" type="button" data-bs-toggle="dropdown">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <button type="button" class="dropdown-item" onclick="showChatDetail({{ $contact->id }})">
                                                                    <i class="fas fa-info-circle me-2"></i>Detail Lengkap
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <a href="mailto:{{ $contact->email }}" class="dropdown-item">
                                                                    <i class="fas fa-envelope me-2"></i>Email Langsung
                                                                </a>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" style="margin: 0;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Hapus pesan ini?')">
                                                                        <i class="fas fa-trash me-2"></i>Hapus
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Detail Button di Sudut -->
                                        <div class="ms-2">
                                            <button type="button" class="btn btn-sm btn-outline-primary rounded-circle" 
                                                    onclick="showChatDetail({{ $contact->id }})"
                                                    title="Lihat Detail Lengkap"
                                                    style="width: 32px; height: 32px; padding: 0;">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Chat Messages -->
                                    <div class="chat-messages p-3">
                                        <!-- User Message -->
                                        <div class="d-flex justify-content-start mb-3">
                                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" 
                                                 style="width: 35px; height: 35px; color: white; flex-shrink: 0;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="message-bubble-user" style="max-width: 70%;">
                                                <div class="bg-white rounded-3 p-3 shadow-sm">
                                                    <div class="text-dark">{{ $contact->message }}</div>
                                                    <div class="text-muted small mt-1">
                                                        {{ $contact->created_at->format('H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Admin Reply (if exists) -->
                                        @if($contact->admin_reply)
                                            <div class="d-flex justify-content-end mb-3">
                                                <div class="message-bubble-admin" style="max-width: 70%;">
                                                    <div class="bg-primary text-white rounded-3 p-3 shadow-sm">
                                                        <div>{{ $contact->admin_reply }}</div>
                                                        <div class="text-white-50 small mt-1">
                                                            Admin • {{ $contact->replied_at->format('H:i') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="rounded-circle bg-success d-flex align-items-center justify-content-center ms-2" 
                                                     style="width: 35px; height: 35px; color: white; flex-shrink: 0;">
                                                    <i class="fas fa-user-tie"></i>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <!-- Reply Input -->
                                        <div class="reply-input-area">
                                            <div class="d-flex align-items-end">
                                                <div class="rounded-circle bg-success d-flex align-items-center justify-content-center me-2" 
                                                     style="width: 35px; height: 35px; color: white; flex-shrink: 0;">
                                                    <i class="fas fa-user-tie"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <form method="POST" action="{{ route('admin.contacts.reply', $contact) }}" class="reply-form">
                                                        @csrf
                                                        <div class="input-group">
                                                            <input type="text" name="reply" class="form-control" 
                                                                   placeholder="Ketik balasan..." required>
                                                            <button type="submit" class="btn btn-success" 
                                                                    style="background: #25d366; border-color: #25d366;">
                                                                <i class="fas fa-paper-plane me-1"></i>Kirim
                                                            </button>
                                                        </div>
                                                        <div class="form-text text-muted small mt-1">
                                                            <i class="fas fa-envelope me-1"></i>
                                                            Balasan akan dikirim ke email {{ $contact->email }}
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="p-3 border-top bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted small">
                                    Menampilkan {{ $contacts->firstItem() }} - {{ $contacts->lastItem() }} dari {{ $contacts->total() }} pesan
                                </div>
                                <div>
                                    {{ $contacts->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Chat Detail Modal -->
<div class="modal fade" id="chatDetailModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 15px; overflow: hidden;">
            <!-- Modal Header -->
            <div class="modal-header py-3 px-4" style="background: linear-gradient(135deg, #0084ff 0%, #0051cc 100%); border: none;">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="rounded-circle bg-white bg-opacity-25 p-2">
                            <i class="fas fa-comments text-white"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="modal-title mb-0 text-white">Detail Chat</h6>
                        <small class="text-white-50">Informasi lengkap percakapan</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body p-0" style="background: #f0f2f5; max-height: 500px; overflow-y: auto;">
                <div id="chatDetailContent">
                    <!-- Content will be loaded via JavaScript -->
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer py-3 px-4" style="background: white; border: none;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Tutup
                </button>
                <button type="button" class="btn btn-primary" onclick="exportChatDetail()">
                    <i class="fas fa-download me-2"></i>Export
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.contact-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
}

function getSelectedIds() {
    const checkboxes = document.querySelectorAll('.contact-checkbox:checked');
    return Array.from(checkboxes).map(cb => cb.value);
}

function submitSelected() {
    const ids = getSelectedIds();
    if (ids.length === 0) {
        alert('Pilih pesan yang akan ditandai sebagai dibaca');
        return false;
    }
    document.getElementById('selectedContacts').value = ids.join(',');
    return true;
}

function deleteSelected() {
    const ids = getSelectedIds();
    if (ids.length === 0) {
        alert('Pilih pesan yang akan dihapus');
        return false;
    }
    
    if (!confirm(`Hapus ${ids.length} pesan yang dipilih?`)) {
        return false;
    }
    
    document.getElementById('deleteContacts').value = ids.join(',');
    return true;
}

function showChatDetail(contactId) {
    // Find the contact data from the page
    const contactElement = document.getElementById(`chat-${contactId}`);
    if (!contactElement) {
        alert('Data chat tidak ditemukan');
        return;
    }
    
    // Get contact information from the page
    const name = contactElement.querySelector('strong').textContent;
    const email = contactElement.querySelector('.text-muted.small').textContent;
    const message = contactElement.querySelector('.message-bubble-user .text-dark').textContent;
    const time = contactElement.querySelector('.message-bubble-user .text-muted.small').textContent;
    
    // Check for admin reply
    const adminReplyElement = contactElement.querySelector('.message-bubble-admin .text-dark');
    const adminReply = adminReplyElement ? adminReplyElement.textContent : '';
    const adminReplyTime = adminReplyElement ? 
        contactElement.querySelector('.message-bubble-admin .text-white-50.small').textContent : '';
    
    // Get status from badge
    const statusBadge = contactElement.querySelector('.badge');
    let status = 'Sudah Dibaca';
    let statusClass = 'bg-warning';
    if (statusBadge.textContent.includes('Belum')) {
        status = 'Belum Dibaca';
        statusClass = 'bg-danger';
    } else if (statusBadge.textContent.includes('Dibalas')) {
        status = 'Dibalas';
        statusClass = 'bg-success';
    }
    
    // Create content
    const content = `
        <!-- Contact Info -->
        <div class="bg-white p-4 border-bottom">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" 
                     style="width: 50px; height: 50px; color: white;">
                    <i class="fas fa-user"></i>
                </div>
                <div class="flex-grow-1">
                    <h5 class="mb-1">${name}</h5>
                    <div class="text-muted small">
                        <i class="fas fa-envelope me-1"></i>${email}
                        <br><i class="fas fa-clock me-1"></i>${time}
                    </div>
                </div>
                <div class="text-end">
                    <span class="badge ${statusClass}">
                        ${status}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Chat Messages -->
        <div class="p-4">
            <div class="d-flex justify-content-start mb-3">
                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" 
                     style="width: 35px; height: 35px; color: white; flex-shrink: 0;">
                    <i class="fas fa-user"></i>
                </div>
                <div style="max-width: 70%;">
                    <div class="bg-white rounded-3 p-3 shadow-sm">
                        <div class="text-dark">${message}</div>
                        <div class="text-muted small mt-1">
                            ${time}
                        </div>
                    </div>
                </div>
            </div>
            
            ${adminReply ? `
                <div class="d-flex justify-content-end mb-3">
                    <div style="max-width: 70%;">
                        <div class="bg-primary text-white rounded-3 p-3 shadow-sm">
                            <div>${adminReply}</div>
                            <div class="text-white-50 small mt-1">
                                ${adminReplyTime}
                            </div>
                        </div>
                    </div>
                    <div class="rounded-circle bg-success d-flex align-items-center justify-content-center ms-2" 
                         style="width: 35px; height: 35px; color: white; flex-shrink: 0;">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
            ` : '<div class="text-center text-muted my-4"><i class="fas fa-reply me-2"></i>Belum ada balasan dari admin</div>'}
        </div>
        
        <!-- Meta Info -->
        <div class="bg-white p-4 border-top">
            <div class="row text-center">
                <div class="col-4">
                    <div class="fw-bold text-primary">${time.split(' ')[0]}</div>
                    <small class="text-muted">Tanggal Kirim</small>
                </div>
                <div class="col-4">
                    <div class="fw-bold text-info">${time.split(' ')[1]}</div>
                    <small class="text-muted">Waktu Kirim</small>
                </div>
                <div class="col-4">
                    <div class="fw-bold text-success">${status}</div>
                    <small class="text-muted">Status</small>
                </div>
            </div>
        </div>
    `;
    
    // Set content and show modal
    document.getElementById('chatDetailContent').innerHTML = content;
    
    const modal = new bootstrap.Modal(document.getElementById('chatDetailModal'));
    modal.show();
}

function exportChatDetail() {
    // Export functionality can be implemented here
    alert('Fitur export akan segera tersedia');
}

// Enhanced Messenger Interactions
document.addEventListener('DOMContentLoaded', function() {
    // Auto-focus on reply input when clicking on chat
    document.querySelectorAll('.reply-form input').forEach(input => {
        input.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        
        // Add typing animation
        input.addEventListener('input', function() {
            if (this.value.length > 0) {
                this.style.background = 'rgba(37, 211, 102, 0.05)';
            } else {
                this.style.background = '';
            }
        });
    });
    
    // Chat thread hover effects
    document.querySelectorAll('.chat-thread').forEach(thread => {
        thread.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
        });
        
        thread.addEventListener('mouseleave', function() {
            this.style.transition = 'all 0.3s ease';
        });
    });
    
    // Avatar click animation
    document.querySelectorAll('.contact-header .rounded-circle').forEach(avatar => {
        avatar.addEventListener('click', function() {
            this.style.transform = 'scale(1.2) rotate(360deg)';
            setTimeout(() => {
                this.style.transform = '';
            }, 300);
        });
    });
    
    // Message bubble click effects
    document.querySelectorAll('.message-bubble-user .bg-white, .message-bubble-admin .bg-primary').forEach(bubble => {
        bubble.addEventListener('click', function() {
            this.style.transform = 'scale(1.05)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
        });
    });
    
    // Button ripple effects
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255, 255, 255, 0.5)';
            ripple.style.width = ripple.style.height = '20px';
            ripple.style.top = (e.clientY - this.offsetTop - 10) + 'px';
            ripple.style.left = (e.clientX - this.offsetLeft - 10) + 'px';
            ripple.style.animation = 'ripple 0.6s ease-out';
            ripple.style.pointerEvents = 'none';
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Add ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
    
    // Parallax effect for bubbles on scroll
    const bubbles = document.querySelectorAll('.floating-bubble');
    
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        
        bubbles.forEach((bubble, index) => {
            const speed = 0.2 + (index * 0.1);
            bubble.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.05}deg)`;
        });
    });
    
    // Chat container scroll animation
    const chatContainer = document.querySelector('.chat-container');
    if (chatContainer) {
        chatContainer.addEventListener('scroll', function() {
            const threads = this.querySelectorAll('.chat-thread');
            threads.forEach(thread => {
                const rect = thread.getBoundingClientRect();
                const containerRect = this.getBoundingClientRect();
                
                if (rect.top >= containerRect.top && rect.bottom <= containerRect.bottom) {
                    thread.style.opacity = '1';
                } else {
                    thread.style.opacity = '0.7';
                }
            });
        });
    }
    
    // Typing indicator simulation
    document.querySelectorAll('.reply-form input').forEach(input => {
        let typingTimeout;
        
        input.addEventListener('input', function() {
            clearTimeout(typingTimeout);
            
            // Show typing indicator
            const chatThread = this.closest('.chat-thread');
            if (chatThread) {
                const typingIndicator = chatThread.querySelector('.typing-indicator');
                if (!typingIndicator) {
                    const indicator = document.createElement('div');
                    indicator.className = 'typing-indicator';
                    indicator.innerHTML = `
                        <div class="d-flex justify-content-end mb-2">
                            <div class="typing-dots">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    `;
                    indicator.style.cssText = `
                        animation: fadeIn 0.3s ease-out;
                    `;
                    
                    const dotsStyle = document.createElement('style');
                    dotsStyle.textContent = `
                        .typing-dots span {
                            display: inline-block;
                            width: 8px;
                            height: 8px;
                            border-radius: 50%;
                            background: #0084ff;
                            margin: 0 2px;
                            animation: typingDot 1.4s infinite;
                        }
                        .typing-dots span:nth-child(2) { animation-delay: 0.2s; }
                        .typing-dots span:nth-child(3) { animation-delay: 0.4s; }
                        @keyframes typingDot {
                            0%, 60%, 100% { transform: translateY(0); }
                            30% { transform: translateY(-10px); }
                        }
                    `;
                    document.head.appendChild(dotsStyle);
                    
                    const replyArea = chatThread.querySelector('.reply-input-area');
                    if (replyArea) {
                        replyArea.parentNode.insertBefore(indicator, replyArea);
                    }
                }
            }
            
            // Hide typing indicator after 2 seconds of no typing
            typingTimeout = setTimeout(() => {
                const indicator = chatThread.querySelector('.typing-indicator');
                if (indicator) {
                    indicator.style.animation = 'fadeOut 0.3s ease-out';
                    setTimeout(() => {
                        indicator.remove();
                    }, 300);
                }
            }, 2000);
        });
    });
    
    // Add fadeOut animation
    const fadeOutStyle = document.createElement('style');
    fadeOutStyle.textContent = `
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
    `;
    document.head.appendChild(fadeOutStyle);
    
    // Checkbox animation
    document.querySelectorAll('.contact-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const thread = this.closest('.chat-thread');
            if (thread) {
                if (this.checked) {
                    thread.style.background = 'rgba(0, 132, 255, 0.05)';
                    thread.style.borderLeft = '4px solid #0084ff';
                } else {
                    thread.style.background = '';
                    thread.style.borderLeft = '';
                }
            }
        });
    });
    
    // Success message animation
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach((node) => {
                    if (node.classList && node.classList.contains('alert-success')) {
                        node.style.animation = 'slideInRight 0.5s ease-out';
                    }
                });
            }
        });
    });
    
    document.querySelectorAll('.alert').forEach(alert => {
        observer.observe(alert.parentNode, { childList: true });
    });
});
</script>
@endsection
