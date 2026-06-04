<?php $__env->startSection('title', 'Hasil Seleksi - PPDB'); ?>

<?php $__env->startSection('styles'); ?>
<style>
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
        color: #0d6efd;
    }
    
    .nav-link {
        font-weight: 500;
        color: #fffdfd;
        margin: 0 0.5rem;
        transition: color 0.3s ease;
    }
    
    .nav-link:hover {
        color: #0d6efd;
    }
    
    .hasil-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .tabel-hasil {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .tabel-hasil .table {
        margin: 0;
    }
    
    .tabel-hasil .table th {
        background: #f8f9fa;
        border-bottom: 2px solid #667eea;
        color: #333;;
        font-weight: 600;
    }
    
    .tabel-hasil .table td {
        vertical-align: middle;
        padding: 1rem;
    }
    
    .download-section {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header Hasil Seleksi -->
            <!-- <div class="hasil-card text-center mb-4">
                <i class="bi bi-trophy-fill fs-1 mb-3"></i>
                <h1 class="mb-3">Hasil Seleksi PPDB</h1>
                <p class="lead">Tahun Ajaran <?php echo e(date('Y')); ?>/<?php echo e(date('Y') + 1); ?></p>
            </div> -->

            
            <div class="row g-4 mb-4">
                
                <?php if($pengumumanSeleksi && $pengumumanSeleksi->aktif): ?>
                <div class="col-md-6">
                    <div style="padding:2rem;background:linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);border-radius:16px;box-shadow:0 8px 20px rgba(13,110,253,0.3);">
                        <div style="text-align:center;">
                            <div style="display:inline-flex;align-items:center;gap:2px;margin-bottom:1rem;">
                                <i class="bi bi-funnel-fill" style="color:#ffd700;font-size:1.5rem;"></i>
                            </div>
                            <h3 style="color:white;font-weight:bold;margin-bottom:0.5rem;font-size:1.5rem;"><?php echo e($pengumumanSeleksi->judul); ?></h3>
                            <?php if($pengumumanSeleksi->sub_judul): ?>
                            <p style="color:rgba(255,255,255,0.9);font-size:1rem;margin-bottom:1rem;"><?php echo e($pengumumanSeleksi->sub_judul); ?></p>
                            <?php endif; ?>
                            <?php if($pengumumanSeleksi->tahun_ajaran): ?>
                            <p style="color:rgba(255,255,255,0.8);font-size:0.9rem;margin-bottom:1.5rem;"><strong>Tahun Ajaran:</strong> <?php echo e($pengumumanSeleksi->tahun_ajaran); ?></p>
                            <?php endif; ?>
                            <?php if($pengumumanSeleksi->file): ?>
                            <a href="<?php echo e(asset('storage/'.$pengumumanSeleksi->file)); ?>" target="_blank" style="display:inline-block;padding:0.75rem 2rem;background:#ffd700;color:#1a202c;text-decoration:none;border-radius:30px;font-weight:600;transition:all 0.3s ease;">
                                <i class="bi bi-download me-2"></i>Download File
                            </a>
                            <?php endif; ?>
                            <?php if($pengumumanSeleksi->isi): ?>
                            <div style="margin-top:1.5rem;padding:1rem;background:rgba(255,255,255,0.1);border-radius:10px;">
                                <p style="color:white;margin:0;line-height:1.6;font-size:0.95rem;"><?php echo e($pengumumanSeleksi->isi); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                
                <?php if($pengumumanFinal && $pengumumanFinal->aktif): ?>
                <div class="col-md-6">
                    <div style="padding:2rem;background:linear-gradient(135deg, #667eea 0%, #764ba2 100%);border-radius:16px;box-shadow:0 8px 20px rgba(102,126,234,0.3);">
                        <div style="text-align:center;">
                            <div style="display:inline-flex;align-items:center;gap:2px;margin-bottom:1rem;">
                                <i class="bi bi-trophy-fill" style="color:#ffd700;font-size:1.5rem;"></i>
                            </div>
                            <h3 style="color:white;font-weight:bold;margin-bottom:0.5rem;font-size:1.5rem;"><?php echo e($pengumumanFinal->judul); ?></h3>
                            <?php if($pengumumanFinal->sub_judul): ?>
                            <p style="color:rgba(255,255,255,0.9);font-size:1rem;margin-bottom:1rem;"><?php echo e($pengumumanFinal->sub_judul); ?></p>
                            <?php endif; ?>
                            <?php if($pengumumanFinal->tahun_ajaran): ?>
                            <p style="color:rgba(255,255,255,0.8);font-size:0.9rem;margin-bottom:1.5rem;"><strong>Tahun Ajaran:</strong> <?php echo e($pengumumanFinal->tahun_ajaran); ?></p>
                            <?php endif; ?>
                            <?php if($pengumumanFinal->file): ?>
                            <a href="<?php echo e(asset('storage/'.$pengumumanFinal->file)); ?>" target="_blank" style="display:inline-block;padding:0.75rem 2rem;background:#ffd700;color:#1a202c;text-decoration:none;border-radius:30px;font-weight:600;transition:all 0.3s ease;">
                                <i class="bi bi-download me-2"></i>Download File
                            </a>
                            <?php endif; ?>
                            <?php if($pengumumanFinal->isi): ?>
                            <div style="margin-top:1.5rem;padding:1rem;background:rgba(255,255,255,0.1);border-radius:10px;">
                                <p style="color:white;margin:0;line-height:1.6;font-size:0.95rem;"><?php echo e($pengumumanFinal->isi); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <?php if(!$pengumumanSeleksi && !$pengumumanFinal): ?>
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>Belum ada pengumuman yang aktif.
            </div>
            <?php endif; ?>

            <!-- Tabel Hasil
            <div class="tabel-hasil mb-4">
                <div class="p-3">
                    <h4 class="mb-3">
                        <i class="bi bi-list-check"></i> Daftar Siswa Diterima
                    </h4>
                    
                    <?php if(count($hasilSeleksi) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIK</th>
                                    <th>NISN</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Asal Sekolah</th>
                                    <th>Tanggal Diterima</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $hasilSeleksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($siswa['nama_lengkap']); ?></td>
                                    <td><?php echo e($siswa['nik']); ?></td>
                                    <td><?php echo e($siswa['nisn']); ?></td>
                                    <td><?php echo e($siswa['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'); ?></td>
                                    <td><?php echo e($siswa['asal_sekolah']); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($siswa['tanggal_diterima'])->format('d/m/Y')); ?></td>
                                    <td>
                                        <span class="badge bg-success text-white">
                                            <?php echo e(ucfirst($siswa['status_seleksi'])); ?>

                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                        <h5 class="text-muted">Belum ada hasil seleksi</h5>
                        <p class="text-muted">Hasil seleksi akan ditampilkan setelah guru melakukan proses seleksi.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div> -->
            
            <!-- Download Section -->
            <?php if(count($hasilSeleksi) > 0): ?>
            <div class="download-section">
                <h4 class="mb-3">
                    <i class="bi bi-download"></i> Download Hasil Seleksi
                </h4>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <a href="<?php echo e(route('hasil-seleksi.pdf')); ?>" class="btn btn-danger w-100">
                            <i class="bi bi-file-earmark-pdf"></i> Download PDF
                        </a>
                    </div>
                    <div class="col-md-4 mb-2">
                        <a href="<?php echo e(route('hasil-seleksi.word')); ?>" class="btn btn-primary w-100">
                            <i class="bi bi-file-earmark-word"></i> Download Word
                        </a>
                    </div>
                    <div class="col-md-4 mb-2">
                        <a href="<?php echo e(route('hasil-seleksi.excel')); ?>" class="btn btn-success w-100">
                            <i class="bi bi-file-earmark-excel"></i> Download Excel
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Informasi -->
            <!-- <div class="alert alert-info">
                <i class="bi bi-info-circle"></i>
                <strong>Informasi:</strong> Hasil seleksi dapat diunduh dalam format Word, atau Excel. 
                Pastikan data yang tertera sudah benar.
            </div> -->
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/pengumuman/hasil-seleksi.blade.php ENDPATH**/ ?>