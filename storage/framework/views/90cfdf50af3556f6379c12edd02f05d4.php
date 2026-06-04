

<?php $__env->startSection('title', 'Gallery - SMA Negeri Karubaga'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold display-5 mb-3">GALERY SMAN KARUBAGA</h2>
        <p class="lead text-muted">Dokumentasi kegiatan dan prestasi sekolah</p>
    </div>

    <?php if($galleries->isEmpty()): ?>
        <div class="text-center py-5">
            <i class="fas fa-images fa-4x text-muted mb-3"></i>
            <p class="text-muted fs-5">Belum ada foto gallery yang tersedia.</p>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 col-sm-6">
                    <div class="gallery-item card border-0 shadow-sm h-100">
                        <a href="<?php echo e(route('gallery.show', $gallery->slug)); ?>">
                            <img src="<?php echo e(asset('storage/' . $gallery->image)); ?>"
                                 class="card-img-top"
                                 alt="<?php echo e($gallery->title); ?>"
                                 style="height: 220px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <span class="badge bg-info mb-2"><?php echo e($gallery->event_category); ?></span>
                            <h6 class="card-title fw-bold"><?php echo e($gallery->title); ?></h6>
                            <p class="card-text text-muted small"><?php echo e(Str::limit($gallery->description, 80)); ?></p>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i><?php echo e($gallery->formatted_date); ?>

                                </small>
                                <small class="text-muted">
                                    <i class="fas fa-eye me-1"></i><?php echo e($gallery->views); ?>

                                </small>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 pb-3">
                            <a href="<?php echo e(route('gallery.show', $gallery->slug)); ?>" class="btn btn-primary btn-sm w-100">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="d-flex justify-content-center mt-5">
            <?php echo e($galleries->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
     .nav-link {
        font-weight: 500;
        color: #f1f1f1 !important;  /* Menu navbar hitam */
        margin: 0 0.5rem;
        transition: color 0.3s ease;
    }
    .gallery-item img {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .gallery-item:hover img {
        transform: scale(1.03);
    }
    .gallery-item {
        transition: box-shadow 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    .gallery-item:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/public/gallery/index.blade.php ENDPATH**/ ?>