<?php $__env->startSection('title', $gallery->title . ' - Gallery'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('home')); ?>">Beranda</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('gallery')); ?>">Gallery</a>
            </li>
            <li class="breadcrumb-item active"><?php echo e($gallery->title); ?></li>
        </ol>
    </nav>
    
    <!-- Gallery Detail - Sama seperti Modal Fasilitas -->
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-images me-2"></i>Detail Gallery - <?php echo e($gallery->title); ?>

            </h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo e(asset('storage/' . $gallery->image)); ?>" 
                         alt="<?php echo e($gallery->title); ?>" 
                         class="img-fluid rounded"
                         style="max-height: 500px; width: 100%; object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Deskripsi Kegiatan</h6>
                    <p class="text-muted"><?php echo e($gallery->description); ?></p>
                    
                    <div class="mt-4">
                        <h6 class="text-primary mb-2">Informasi Kegiatan</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="30%"><strong>Kategori:</strong></td>
                                <td><?php echo e($gallery->event_category); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal:</strong></td>
                                <td><?php echo e($gallery->formatted_date); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Lokasi:</strong></td>
                                <td><?php echo e($gallery->location ?? 'Tidak diset'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Dilihat:</strong></td>
                                <td><?php echo e($gallery->views); ?> kali</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        <h6 class="text-primary mb-2">Status Kegiatan</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle text-success me-2"></i>Dokumentasi Resmi</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Tersedia untuk Publik</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>High Quality Images</li>
                        </ul>
                    </div>
                    
                    <div class="mt-4">
                        <a href="<?php echo e(route('gallery')); ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Gallery
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Galleries - Item terkait lainnya tampil di bawah -->
    <?php if($relatedGalleries->isNotEmpty()): ?>
        <div class="mt-5">
            <h3 class="fw-bold mb-4">Gallery Terkait</h3>
            <div class="row g-4">
                <?php $__currentLoopData = $relatedGalleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3">
                        <div class="card h-100 shadow-sm">
                            <img src="<?php echo e(asset('storage/' . $related->image)); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo e($related->title); ?>"
                                 style="height: 150px; object-fit: cover;">
                            <div class="card-body p-3">
                                <h6 class="card-title small fw-bold"><?php echo e($related->title); ?></h6>
                                <small class="text-muted d-block">
                                    <i class="fas fa-calendar me-1"></i><?php echo e($related->formatted_date); ?>

                                </small>
                                <a href="<?php echo e(route('gallery.show', $related->slug)); ?>" 
                                   class="btn btn-primary btn-sm mt-2 w-100">
                                    Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .breadcrumb {
        background-color: transparent;
        padding: 0;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
        color: #6c757d;
    }
    
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .badge {
        font-size: 0.8rem;
    }
    
    /* Modal-like styling */
    .card-header {
        border-radius: 12px 12px 0 0 !important;
    }
    
    .table-sm td {
        padding: 0.5rem;
        vertical-align: middle;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/public/gallery/show.blade.php ENDPATH**/ ?>