@extends('admin.layouts.app')

@section('title', 'Hak Akses')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold text-dark mb-1">
                        <i class="bi bi-shield-lock text-primary me-2"></i>Pengelolaan Hak Akses
                    </h2>
                    <p class="text-muted mb-0">Kelola hak akses untuk User (Siswa) dan Guru</p>
                </div>
                <div class="text-end">
                    <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-shield-check text-primary fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dynamic Notification - Outside Page -->
    <div id="dynamicNotification" class="position-fixed top-0 start-0 w-100" style="display: none; z-index: 99999;">
        <div class="container-fluid">
            <div class="row justify-content-center mt-3">
                <div class="col-md-6">
                    <div id="notificationBox" class="alert alert-dismissible fade show border-0 shadow-lg" role="alert" style="border-radius: 15px; border-left: 4px solid;">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle p-3 me-3">
                                <i id="dynamicNotificationIcon" class="bi fs-3"></i>
                            </div>
                            <div class="flex-grow-1">
                                <strong id="dynamicNotificationTitle" class="mb-1"></strong>
                                <div id="dynamicNotificationMessage" class="small"></div>
                            </div>
                            <button type="button" class="btn-close" onclick="hideDynamicNotification()"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="bi bi-check-circle text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <strong class="text-success">Berhasil!</strong>
                            <div class="text-success small">{{ session('success') }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Info Cards di Luar Tabel -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm bg-info bg-opacity-10">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="bg-info bg-opacity-20 rounded-2 p-3 me-3">
                            <i class="bi bi-info-circle text-info fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-info mb-3">Informasi Hak Akses</h6>
                            <ul class="mb-0 small text-muted">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    <strong>User Aktif:</strong> Siswa dapat melakukan login dan register
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-x-circle text-danger me-2"></i>
                                    <strong>User Nonaktif:</strong> Siswa tidak dapat login atau register
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    <strong>Guru Aktif:</strong> Guru dapat mengakses Dashboard Guru
                                </li>
                                <li class="mb-0">
                                    <i class="bi bi-x-circle text-danger me-2"></i>
                                    <strong>Guru Nonaktif:</strong> Guru tidak dapat mengakses Dashboard Guru
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm bg-warning bg-opacity-10">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="bg-warning bg-opacity-20 rounded-2 p-3 me-3">
                            <i class="bi bi-exclamation-triangle text-warning fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-warning mb-3">Penting!</h6>
                            <p class="mb-0 small text-muted">
                                <i class="bi bi-shield-exclamation me-2"></i>
                                Pastikan untuk memberikan hak akses sebelum membiarkan user atau guru mengakses sistem. 
                                Hak akses yang nonaktif akan mencegah akses ke modul terkait.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 text-uppercase fw-bold text-muted" style="width: 50px;">
                                        <span class="badge bg-secondary rounded-pill">No</span>
                                    </th>
                                    <th class="border-0 text-uppercase fw-bold text-muted">Modul</th>
                                    <th class="border-0 text-uppercase fw-bold text-muted">Status</th>
                                    <th class="border-0 text-uppercase fw-bold text-muted">Keterangan</th>
                                    <th class="border-0 text-uppercase fw-bold text-muted text-center" style="width: 200px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hakAkses as $index => $item)
                                <tr class="border-bottom">
                                    <td class="py-4">
                                        <span class="badge bg-light text-dark rounded-circle fw-bold">{{ $index + 1 }}</span>
                                    </td>
                                    <td class="py-4">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-wrapper me-3">
                                                @if($item->nama_modul == 'user')
                                                    <div class="icon-box bg-primary bg-opacity-10">
                                                        <i class="bi bi-people-fill text-primary"></i>
                                                    </div>
                                                @elseif($item->nama_modul == 'guru')
                                                    <div class="icon-box bg-success bg-opacity-10">
                                                        <i class="bi bi-person-badge-fill text-success"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-1 fw-bold text-uppercase">{{ $item->nama_modul }}</h6>
                                                <small class="text-muted">
                                                    @if($item->nama_modul == 'user')
                                                        <i class="bi bi-box-arrow-in-right me-1"></i>Login & Register Siswa
                                                    @elseif($item->nama_modul == 'guru')
                                                        <i class="bi bi-speedometer2 me-1"></i>Dashboard Guru
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        @if($item->status == 'aktif')
                                            <div class="d-flex align-items-center">
                                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-2">
                                                    <i class="bi bi-check-circle text-success"></i>
                                                </div>
                                                <div>
                                                    <span class="badge bg-success rounded-pill px-3 py-2">Aktif</span>
                                                    <div class="text-success small mt-1">Modul aktif</div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-flex align-items-center">
                                                <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-2">
                                                    <i class="bi bi-x-circle text-danger"></i>
                                                </div>
                                                <div>
                                                    <span class="badge bg-danger rounded-pill px-3 py-2">Nonaktif</span>
                                                    <div class="text-danger small mt-1">Modul nonaktif</div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-4">
                                        <span class="text-muted fw-medium">{{ $item->keterangan }}</span>
                                    </td>
                                    <td class="py-4 text-center">
                                        <button type="button" 
                                                class="btn {{ $item->status == 'aktif' ? 'btn-warning' : 'btn-success' }} btn-sm px-4 py-2 rounded-pill shadow-sm"
                                                onclick="showConfirmModal({{ $item->id }}, '{{ $item->nama_modul }}', '{{ $item->status }}')"
                                                title="{{ $item->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }} hak akses">
                                            <i class="bi bi-{{ $item->status == 'aktif' ? 'pause-fill' : 'play-fill' }} me-1"></i>
                                            {{ $item->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-xxl" style="border-radius: 24px; overflow: hidden; backdrop-filter: blur(10px);">
            <!-- Modal Header -->
            <div class="modal-header border-0 text-center py-4 position-relative" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 24px 24px 0 0;">
                                
                <div class="mb-3 position-relative z-1">
                    <i id="modalIcon" class="bi bi-question-circle text-white fs-2"></i>
                </div>
                <h5 class="modal-title text-white mb-0 fw-bold position-relative z-1" id="confirmModalLabel">Konfirmasi Aksi</h5>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body p-4 text-center" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                <!-- Status Icon with Animation -->
                <div class="mb-4">
                    <div id="statusIcon" class="rounded-circle p-4 d-inline-block mb-3 shadow-lg position-relative" style="animation: bounceIn 0.6s ease-out;">
                        <i class="bi bi-exclamation-triangle fs-1 position-relative z-1"></i>
                    </div>
                    
                    <!-- Title with Gradient -->
                    <h6 class="fw-bold mb-3 position-relative" id="modalTitle" style="background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        Apakah Anda Yakin?
                    </h6>
                    
                    <!-- Message with Better Typography -->
                    <p class="text-muted mb-0 fs-5 lh-base" id="modalMessage" style="max-width: 400px; margin: 0 auto;">
                        Anda akan mengubah status hak akses untuk modul ini.
                    </p>
                </div>
                
                <!-- Action Buttons with Enhanced Styling -->
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <button type="button" class="btn btn-outline-secondary px-5 py-3 rounded-pill shadow-sm hover-lift" data-bs-dismiss="modal" style="border-width: 2px; font-weight: 500; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                        <i class="bi bi-x-circle me-2"></i>
                        <span>Batal</span>
                    </button>
                    <form id="confirmForm" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary px-5 py-3 rounded-pill shadow-sm hover-lift" id="confirmButton" style="border-width: 2px; font-weight: 500; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                            <i class="bi bi-check-circle me-2"></i>
                            <span id="confirmButtonText">Ya, Lanjutkan</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.icon-wrapper {
    position: relative;
}

.icon-box {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.icon-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.icon-box i {
    font-size: 1.5rem;
}

.table td {
    vertical-align: middle;
    border-bottom: 1px solid #f8f9fa;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.badge {
    font-weight: 500;
    letter-spacing: 0.5px;
}

.btn {
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.alert {
    border-left: 4px solid;
}

/* Enhanced Modal Styles */
.modal-content {
    border: none;
    box-shadow: 0 25px 50px rgba(0,0,0,0.15), 0 0 0 1px rgba(0,0,0,0.05);
    backdrop-filter: blur(20px);
    transform: scale(0.95);
    opacity: 0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.modal.show .modal-content {
    transform: scale(1);
    opacity: 1;
}

.modal-header {
    border-bottom: none;
    position: relative;
    overflow: hidden;
}

.modal-body {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    position: relative;
}

.modal-backdrop {
    background: rgba(0,0,0,0.5);
    backdrop-filter: blur(8px);
}

#statusIcon.aktif {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
    border: 2px solid #28a745;
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.25);
}

#statusIcon.nonaktif {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
    border: 2px solid #dc3545;
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.25);
}

.modal-dialog-centered {
    display: flex;
    align-items: center;
    min-height: calc(100vh - 1rem);
}

/* Button Hover Effects */
.hover-lift {
    position: relative;
    transform: translateY(0);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.hover-lift:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.hover-lift:active {
    transform: translateY(-1px);
}


@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.05); opacity: 0.8; }
}

@keyframes bounceIn {
    0% { transform: scale(0.3); opacity: 0; }
    50% { transform: scale(1.05); }
    70% { transform: scale(0.9); }
    100% { transform: scale(1); opacity: 1; }
}


/* Enhanced Typography */
.fs-1 { font-size: 2.5rem; }
.fs-2 { font-size: 3rem; }
.lh-base { line-height: 1.6; }

/* Shadow Classes */
.shadow-xxl {
    box-shadow: 0 30px 60px rgba(0,0,0,0.15), 0 0 0 1px rgba(0,0,0,0.05) !important;
}

/* Modal Content Enhancements */
.modal-content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.03) 50%, transparent 70%);
    pointer-events: none;
    z-index: 0;
}

/* Button Enhancements */
.btn {
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn:hover::before {
    width: 300px;
    height: 300px;
}

/* Notification Styles */
#notificationContainer {
    opacity: 0;
    transform: translateY(-100%);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

#notificationContainer.show {
    opacity: 1;
    transform: translateY(0);
}

#notificationBox.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border-left: 4px solid #28a745;
}

#notificationBox.alert-warning {
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
    border-left: 4px solid #ffc107;
}

#notificationIcon.success {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

#notificationIcon.warning {
    background: rgba(255, 193, 7, 0.1);
    color: #856404;
}

#notificationTitle.text-success {
    color: #155724;
}

#notificationTitle.text-warning {
    color: #856404;
}

#notificationMessage.text-success {
    color: #155724;
}

#notificationMessage.text-warning {
    color: #856404;
}
</style>

<script>
function showNotification(type, title, message) {
    const notification = document.getElementById('dynamicNotification');
    const notificationBox = document.getElementById('notificationBox');
    const iconContainer = document.getElementById('notificationIconContainer');
    const icon = document.getElementById('dynamicNotificationIcon');
    const titleEl = document.getElementById('dynamicNotificationTitle');
    const messageEl = document.getElementById('dynamicNotificationMessage');
    
    // Debug: Log the values
    console.log('showNotification called with:', { type, title, message });
    
    // Set notification content with delay to ensure DOM is ready
    setTimeout(() => {
        titleEl.textContent = title;
        messageEl.textContent = message;
        
        console.log('Content set:', { title: titleEl.textContent, message: messageEl.textContent });
        
        // Set styling based on type
        if (type === 'success') {
            // Success styling - hijau
            notificationBox.style.background = 'linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%)';
            notificationBox.style.borderLeftColor = '#28a745';
            icon.parentElement.style.background = 'rgba(40, 167, 69, 0.1)';
            icon.className = 'bi bi-check-circle text-success fs-3';
            titleEl.className = 'text-success mb-1';
            messageEl.className = 'text-success small';
        } else if (type === 'error') {
            // Error styling - merah
            notificationBox.style.background = 'linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%)';
            notificationBox.style.borderLeftColor = '#dc3545';
            icon.parentElement.style.background = 'rgba(220, 53, 69, 0.1)';
            icon.className = 'bi bi-x-circle text-danger fs-3';
            titleEl.className = 'text-danger mb-1';
            messageEl.className = 'text-danger small';
        } else if (type === 'warning') {
            // Warning styling - orange
            notificationBox.style.background = 'linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%)';
            notificationBox.style.borderLeftColor = '#ffc107';
            icon.parentElement.style.background = 'rgba(255, 193, 7, 0.1)';
            icon.className = 'bi bi-exclamation-triangle text-warning fs-3';
            titleEl.className = 'text-warning mb-1';
            messageEl.className = 'text-warning small';
        }
        
        // Show notification with animation
        notification.style.display = 'block';
        notification.style.pointerEvents = 'auto';
        notificationBox.style.opacity = '0';
        notificationBox.style.transform = 'translateY(-100%)';
        
        // Trigger animation
        setTimeout(() => {
            notificationBox.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
            notificationBox.style.opacity = '1';
            notificationBox.style.transform = 'translateY(0)';
        }, 100);
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            hideNotification();
        }, 5000);
    }, 50);
}

function hideNotification() {
    const notification = document.getElementById('dynamicNotification');
    const notificationBox = document.getElementById('notificationBox');
    
    // Hide with animation
    notificationBox.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
    notificationBox.style.opacity = '0';
    notificationBox.style.transform = 'translateY(-100%)';
    
    // Hide after animation
    setTimeout(() => {
        notification.style.display = 'none';
        notification.style.pointerEvents = 'none';
    }, 500);
}

function hideDynamicNotification() {
    hideNotification();
}

function showConfirmModal(id, modul, currentStatus) {
    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
    const form = document.getElementById('confirmForm');
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    const modalIcon = document.getElementById('modalIcon');
    const statusIcon = document.getElementById('statusIcon');
    const confirmButton = document.getElementById('confirmButton');
    const confirmButtonText = document.getElementById('confirmButtonText');
    
    // Set form action
    form.action = `/admin/hak-akses/toggle/${id}`;
    
    // Update modal content based on current status
    if (currentStatus === 'aktif') {
        // Will deactivate
        modalTitle.textContent = 'Nonaktifkan Hak Akses?';
        modalMessage.textContent = `Apakah Anda yakin ingin menonaktifkan hak akses untuk modul "${modul.toUpperCase()}"? Pengguna tidak akan dapat mengakses modul ini.`;
        modalIcon.className = 'bi bi-pause-circle text-white fs-1';
        statusIcon.className = 'rounded-circle p-3 d-inline-block mb-3 nonaktif';
        statusIcon.innerHTML = '<i class="bi bi-x-circle fs-1"></i>';
        confirmButton.className = 'btn btn-warning px-5 py-3 rounded-pill shadow-sm hover-lift';
        confirmButtonText.textContent = 'Ya, Nonaktifkan';
    } else {
        // Will activate
        modalTitle.textContent = 'Aktifkan Hak Akses?';
        modalMessage.textContent = `Apakah Anda yakin ingin mengaktifkan hak akses untuk modul "${modul.toUpperCase()}"? Pengguna akan dapat mengakses modul ini.`;
        modalIcon.className = 'bi bi-play-circle text-white fs-1';
        statusIcon.className = 'rounded-circle p-3 d-inline-block mb-3 aktif';
        statusIcon.innerHTML = '<i class="bi bi-check-circle fs-1"></i>';
        confirmButton.className = 'btn btn-success px-5 py-3 rounded-pill shadow-sm hover-lift';
        confirmButtonText.textContent = 'Ya, Aktifkan';
    }
    
    // Show modal
    modal.show();
    
    // Show success notification when modal closes
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                if (mutation.target.classList.contains('show') === false) {
                    // Modal is closing, show notification
                    if (currentStatus === 'aktif') {
                        showNotification('success', 'Berhasil Menonaktifkan!', `Hak akses untuk modul "${modul.toUpperCase()}" berhasil dinonaktifkan.`);
                    } else {
                        showNotification('success', 'Berhasil Mengaktifkan!', `Hak akses untuk modul "${modul.toUpperCase()}" berhasil diaktifkan.`);
                    }
                    observer.disconnect();
                }
            }
        });
    });
    
    observer.observe(document.getElementById('confirmModal'), {
        attributes: true,
        attributeFilter: ['class']
    });
}
</script>
</style>

<script>
function showConfirmModal(id, modul, currentStatus) {
    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
    const form = document.getElementById('confirmForm');
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    const modalIcon = document.getElementById('modalIcon');
    const statusIcon = document.getElementById('statusIcon');
    const confirmButton = document.getElementById('confirmButton');
    const confirmButtonText = document.getElementById('confirmButtonText');
    
    // Set form action
    form.action = `/admin/hak-akses/toggle/${id}`;
    
    // Update modal content based on current status
    if (currentStatus === 'aktif') {
        // Will deactivate
        modalTitle.textContent = 'Nonaktifkan Hak Akses?';
        modalMessage.textContent = `Apakah Anda yakin ingin menonaktifkan hak akses untuk modul "${modul.toUpperCase()}"? Pengguna tidak akan dapat mengakses modul ini.`;
        modalIcon.className = 'bi bi-pause-circle text-white fs-1';
        statusIcon.className = 'rounded-circle p-3 d-inline-block mb-3 nonaktif';
        statusIcon.innerHTML = '<i class="bi bi-x-circle fs-1"></i>';
        confirmButton.className = 'btn btn-warning px-5 py-3 rounded-pill shadow-sm hover-lift';
        confirmButtonText.textContent = 'Ya, Nonaktifkan';
    } else {
        // Will activate
        modalTitle.textContent = 'Aktifkan Hak Akses?';
        modalMessage.textContent = `Apakah Anda yakin ingin mengaktifkan hak akses untuk modul "${modul.toUpperCase()}"? Pengguna akan dapat mengakses modul ini.`;
        modalIcon.className = 'bi bi-play-circle text-white fs-1';
        statusIcon.className = 'rounded-circle p-3 d-inline-block mb-3 aktif';
        statusIcon.innerHTML = '<i class="bi bi-check-circle fs-1"></i>';
        confirmButton.className = 'btn btn-success px-5 py-3 rounded-pill shadow-sm hover-lift';
        confirmButtonText.textContent = 'Ya, Aktifkan';
    }
    
    // Show modal
    modal.show();
}
</script>
@endsection
