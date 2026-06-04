<?php $__env->startSection('title', 'Informasi PPDB SMA Negeri Karubaga'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .jadwal-item {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        border-left: 4px solid #1e3c72;
        transition: transform 0.3s;
    }
    .jadwal-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(30,60,114,0.2);
    }
    .jadwal-label {
        font-size: 14px;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }
    .jadwal-value {
        font-size: 20px;
        font-weight: 600;
        color: #333;
    }
    .nav-link {
        font-weight: 500;
        color: #ffffff;
        margin: 0 0.5rem;
        transition: color 0.3s ease;
    }
</style>
<div class="py-5">
    <div class="container">
        
        <!-- Judul -->
        <?php if($dataInformasi && isset($dataInformasi['judul'])): ?>
            <h2 style="text-align: center; color: #1e3c72; margin-bottom: 0.5rem; font-weight: bold;"><?php echo e($dataInformasi['judul']); ?></h2>
        <?php else: ?>
            <h2 style="text-align: center; color: #1e3c72; margin-bottom: 0.5rem; font-weight: bold;">INFORMASI PPDB</h2>
        <?php endif; ?>
        
        <?php if($dataInformasi && isset($dataInformasi['sub_judul'])): ?>
            <h4 style="text-align: center; color: #2c5282; margin-bottom: 3rem;"><?php echo e($dataInformasi['sub_judul']); ?></h4>
        <?php else: ?>
            <h4 style="text-align: center; color: #2c5282; margin-bottom: 3rem;">SMA NEGERI KARUBAGA</h4>
        <?php endif; ?>

        <!-- Layout Kiri-Kanan -->
        <div class="row align-items-start">
            <!-- Kiri: Foto Siswa Besar (Tanpa Card) -->
            <div class="col-md-5">
                <div class="text-start">
                    <?php if($dataInformasi && isset($dataInformasi['foto_siswa']) && !empty($dataInformasi['foto_siswa'])): ?>
                        <img src="<?php echo e(asset('storage/' . $dataInformasi['foto_siswa'])); ?>" 
                             class="img-fluid rounded mb-3" 
                             style="width: 300%; height: 600px; object-fit: cover; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-left: -75px; display: block;"
                             alt="Foto Siswa">
                        <div style="margin-top: 15px; margin-left: -75px;">
                            <h3 class="text-primary mb-2 text-center"><?php echo e($dataInformasi['nama_siswa'] ?? 'Siswa Telah Diterima'); ?></h3>
                            <p class="text-muted fs-5 text-start"><?php echo e($dataInformasi['keterangan_siswa'] ?? 'Selamat kepada siswa yang telah diterima'); ?></p>
                        </div>
                    <?php else: ?>
                        <i class="bi bi-person-circle text-muted mb-3 d-block" style="font-size: 550px; margin-left: -75px;"></i>
                        <div style="margin-top: 15px; margin-left: -75px;">
                            <h3 class="text-muted mb-2 text-center">Belum Ada Siswa Diterima</h3>
                            <p class="text-muted fs-5 text-start">Foto siswa yang telah diterima akan ditampilkan di sini</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Kanan: Informasi Pendaftaran (Dalam Card) -->
            <div class="col-md-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <p class="lead mb-4 text-center">Informasi lengkap mengenai jadwal dan ketentuan Penerimaan Peserta Didik Baru (PPDB) SMA Negeri Karubaga Tahun Ajaran 2024/2025.</p>
                        
                        <!-- Layout 2 Column untuk Info -->
                        <div class="row">
                            <!-- Kiri: Jadwal -->
                            <div class="col-md-6">
                                <h4 class="mb-4"><i class="bi bi-calendar-alt me-2 text-primary"></i> Jadwal Pendaftaran</h4>
                                
                                <?php if($dataInformasi && isset($dataInformasi['jadwal']) && is_array($dataInformasi['jadwal'])): ?>
                                    <?php $__currentLoopData = $dataInformasi['jadwal']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($item['kegiatan'])): ?>
                                        <div class="jadwal-item">
                                            <div class="jadwal-label"><?php echo e($item['kegiatan']); ?></div>
                                            <div class="jadwal-value"><?php echo e($item['tanggal']); ?></div>
                                            <small class="text-muted"><?php echo e($item['keterangan'] ?? ''); ?></small>
                                        </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <!-- Fallback ke default jika tidak ada data -->
                                    <div class="jadwal-item">
                                        <div class="jadwal-label">Pendaftaran Online</div>
                                        <div class="jadwal-value"><?php echo e($jadwal['pendaftaran_online'] ?? '1 Juni - 15 Juli 2024'); ?></div>
                                        <small class="text-muted">Pendaftaran dibuka melalui website resmi PPDB</small>
                                    </div>

                                    <div class="jadwal-item">
                                        <div class="jadwal-label">Ujian akan dilaksanakan pada</div>
                                        <div class="jadwal-value"><?php echo e($jadwal['ujian_akan_dilaksanakan_pada'] ?? '20 Juli 2024'); ?></div>
                                        <small class="text-muted">Ujian akan dilaksanakan bertempat SMAN Karubaga</small>
                                    </div>
                                    
                                    <div class="jadwal-item">
                                        <div class="jadwal-label">Seleksi</div>
                                        <div class="jadwal-value"><?php echo e($jadwal['seleksi'] ?? '21 Juli - 25 Juli 2024'); ?></div>
                                        <small class="text-muted">Seleksi berdasarkan hasil nilai jawaban yang terbaik</small>
                                    </div>
                                    
                                    <div class="jadwal-item">
                                        <div class="jadwal-label">Pengumuman</div>
                                        <div class="jadwal-value"><?php echo e($jadwal['pengumuman'] ?? '1 Agustus 2024'); ?></div>
                                        <small class="text-muted">Pengumuman akan diumumkan melalui website dan sekolah</small>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Kanan: Persyaratan dan Kontak -->
                            <div class="col-md-6">
                                <h4 class="mb-4"><i class="bi bi-file-text me-2 text-primary"></i> Persyaratan</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <?php if($dataInformasi && isset($dataInformasi['persyaratan']) && is_array($dataInformasi['persyaratan'])): ?>
                                            <ul class="list-unstyled">
                                                <?php $__currentLoopData = $dataInformasi['persyaratan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(!empty($item['nama'])): ?>
                                                    <li class="mb-3">
                                                        <i class="bi bi-check-circle text-success me-2"></i>
                                                        <?php echo e($item['nama']); ?>

                                                    </li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php else: ?>
                                            <!-- Fallback ke default jika tidak ada data -->
                                            <ul class="list-unstyled">
                                                <li class="mb-3">
                                                    <i class="bi bi-check-circle text-success me-2"></i>
                                                    Ijazah/SKL (Asli & Fotokopi)
                                                </li>
                                                <li class="mb-3">
                                                    <i class="bi bi-check-circle text-success me-2"></i>
                                                    Kartu Keluarga (Fotokopi)
                                                </li>
                                                <li class="mb-3">
                                                    <i class="bi bi-check-circle text-success me-2"></i>
                                                    Akta Kelahiran (Fotokopi)
                                                </li>
                                                <li class="mb-3">
                                                    <i class="bi bi-check-circle text-success me-2"></i>
                                                    Pas Foto 3x4 (4 lembar)
                                                </li>
                                                <li class="mb-3">
                                                    <i class="bi bi-check-circle text-success me-2"></i>
                                                    NISN dan NIK
                                                </li>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <h4 class="mb-3 mt-4"><i class="bi bi-telephone me-2 text-primary"></i> Kontak Panitia</h4>
                                <?php if($dataInformasi && isset($dataInformasi['kontak']) && is_array($dataInformasi['kontak'])): ?>
                                    <?php $__currentLoopData = $dataInformasi['kontak']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($item['nilai'])): ?>
                                            <p>
                                                <i class="bi bi-<?php echo e($item['tipe'] == 'email' ? 'envelope' : ($item['tipe'] == 'whatsapp' ? 'whatsapp' : 'telephone')); ?> me-2"></i>
                                                <?php echo e($item['nilai']); ?>

                                            </p>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <!-- Fallback ke default jika tidak ada data -->
                                    <p><i class="bi bi-telephone me-2"></i> (0961) 123456</p>
                                    <p><i class="bi bi-envelope me-2"></i> ppdb@smankarubaga.sch.id</p>
                                <?php endif; ?>
        </div>

        <div class="text-center mt-5">
            <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">
                <i class="bi bi-house me-2"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/Home/info.blade.php ENDPATH**/ ?>