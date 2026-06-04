

<?php $__env->startSection('title', 'Sejarah SMA Negeri Karubaga'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .navbar-brand {
        color: white !important;
    }
    .navbar-nav .nav-link {
        color: white !important;
    }
    .navbar-nav .nav-link:hover {
        color: rgba(255,255,255,0.8) !important;
    }
    .dropdown-item {
        color: #333 !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="py-5">
    <div class="container">
        <!-- Judul -->
        <h2 class="text-center mb-4">Sejarah SMA Negeri Karubaga</h2>
        
        <!-- Konten Sejarah -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="row g-0">
                            <!-- Bagian Kiri: Teks Sejarah -->
                            <div class="col-lg-7 p-3">
                                <h5 class="text-primary mb-3 fw-bold">Awal Berdiri</h5>
                                <p class="text-muted lh-lg">SMA Negeri Karubaga didirikan pada tahun <strong>1985</strong> sebagai upaya pemerintah daerah untuk meningkatkan akses pendidikan menengah di wilayah Karubaga dan sekitarnya. Berawal dari gedung sederhana dengan beberapa ruang kelas, sekolah ini terus berkembang seiring dengan semangat masyarakat yang ingin memberikan pendidikan terbaik bagi generasi penerus.</p>
                                
                                <h5 class="text-primary mb-3 mt-4 fw-bold">Perkembangan Sekolah</h5>
                                <p class="text-muted lh-lg">Sejak awal berdirinya, SMA Negeri Karubaga telah berkomitmen untuk memberikan pendidikan berkualitas bagi masyarakat Karubaga dan sekitarnya. Berbagai pembangunan infrastruktur terus dilakukan, mulai dari penambahan ruang kelas, laboratorium, perpustakaan, hingga fasilitas olahraga.</p>
                                
                                <h5 class="text-primary mb-3 mt-4 fw-bold">Prestasi dan Kontribusi</h5>
                                <p class="text-muted lh-lg">Selama perjalanannya, SMA Negeri Karubaga telah melahirkan ribuan alumni yang berkontribusi di berbagai bidang, baik di tingkat lokal maupun nasional. Sekolah ini juga aktif dalam berbagai kompetisi akademik dan non-akademik, serta terus berinovasi dalam meningkatkan kualitas pembelajaran.</p>
                                
                                <h5 class="text-primary mb-3 mt-4 fw-bold">Masa Depan</h5>
                                <p class="text-muted lh-lg">Dengan semangat "Selangkah Lebih Depan", SMA Negeri Karubaga terus berkomitmen untuk menjadi lembaga pendidikan unggulan yang mencetak generasi berkarakter, berprestasi, dan siap menghadapi tantangan global.</p>
                            </div>
                            
                            <!-- Bagian Kanan: Foto Sekolah -->
                            <div class="col-lg-5 bg-light">
                                <div class="h-100 d-flex flex-column justify-content-between p-4">
                                    <img src="<?php echo e(asset('images/SMAN Karubaga.jpg')); ?>" alt="Gedung SMA Negeri Karubaga" class="img-fluid rounded-3 shadow-sm mb-4">
                                    <img src="<?php echo e(asset('images/komputer.jpeg')); ?>" alt="Suasana Belajar" class="img-fluid rounded-3 shadow-sm mb-4">
                                    <img src="<?php echo e(asset('images/baris.jpg')); ?>" alt="Suasana Belajar" class="img-fluid rounded-3 shadow-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .lh-lg {
        line-height: 1.8;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    img {
        transition: transform 0.3s ease;
    }
    
    img:hover {
        transform: scale(1.02);
    }
    
    /* Navbar styling sama dengan home page */
    .navbar {
        background: rgba(241, 234, 241, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        padding: 1.5rem 0;
        transition: all 0.3s ease;
    }
    
    .navbar.scrolled {
        padding: 0.5rem 0;
    }
    
    .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        color: #efe3e3;
    }
    
    .nav-link {
        font-weight: 500;
        color: #fef3f3fb;
        margin: 0 0.5rem;
        transition: color 0.3s ease;
    }
    
    .nav-link:hover {
        color: #0d6efd;
    }
    
    .nav-link.active {
        color: white !important;
        font-weight: 600;
        background: transparent !important;
    }
    
    @media (max-width: 768px) {
        .col-lg-7.p-3 {
            padding: 2rem !important;
        }
            order: -1;
        }
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/home/tentang/sejarah.blade.php ENDPATH**/ ?>