<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Berkas - PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #b8d4e7 0%, #f0eff4 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            max-width: 950px;
            width: 100%;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }
        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px 30px;
            color: white;
            text-align: center;
        }
        .form-header h1 {
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 4px 0;
        }
        .form-header p {
            font-size: 13px;
            margin: 0;
            opacity: 0.9;
        }
        .form-body {
            padding: 20px 25px;
        }
        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #1a202c;
            margin: 10px 0 15px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #667eea;
            display: flex;
            align-items: center;
        }
        .section-title i {
            margin-right: 8px;
            color: #667eea;
            font-size: 18px;
        }
        .section-title span {
            margin-left: auto;
            font-size: 11px;
            background: #fee2e2;
            color: #e53e3e;
            padding: 3px 8px;
            border-radius: 20px;
            font-weight: 500;
        }
        .alert {
            padding: 10px 14px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 13px;
            border: none;
        }
        .alert-info {
            background: #e6f0ff;
            color: #1e4b8c;
            border-left: 4px solid #667eea;
        }
        .alert-info i {
            color: #667eea;
        }
        .progress-container {
            background: #f7fafc;
            padding: 15px 20px;
            border-radius: 14px;
            margin-bottom: 18px;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        }
        .progress-bar {
            height: 6px;
            background: #e2e8f0;
            border-radius: 100px;
            overflow: hidden;
            margin-bottom: 12px;
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 100px;
            width: 75%;
            position: relative;
            animation: shimmer 2s infinite;
        }
        @keyframes shimmer {
            0% { opacity: 1; }
            50% { opacity: 0.8; }
            100% { opacity: 1; }
        }
        .step-indicator {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            font-weight: 500;
        }
        .step-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .step-dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #e2e8f0;
            color: #718096;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .step-dot.completed {
            background: #48bb78;
            color: white;
        }
        .step-dot.active {
            background: #667eea;
            color: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }
        .row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 5px;
        }
        .card {
            border: 1px solid #edf2f7;
            border-radius: 16px;
            transition: all 0.3s ease;
            height: 100%;
            background: white;
            overflow: hidden;
        }
        .card:hover {
            box-shadow: 0 10px 20px -8px rgba(102, 126, 234, 0.15);
            border-color: #667eea;
            transform: translateY(-2px);
        }
        .card-body {
            padding: 16px;
        }
        .file-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #e2e8f0;
        }
        .file-icon {
            width: 45px;
            height: 45px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .file-icon i {
            font-size: 22px;
        }
        .file-info {
            flex: 1;
        }
        .file-title {
            font-weight: 700;
            font-size: 15px;
            margin-bottom: 2px;
            color: #1a202c;
        }
        .file-desc {
            font-size: 11px;
            color: #718096;
            margin-bottom: 2px;
        }
        .file-badge {
            display: inline-block;
            padding: 3px 8px;
            background: #f0f4ff;
            border-radius: 30px;
            font-size: 9px;
            font-weight: 600;
            color: #667eea;
            letter-spacing: 0.3px;
        }
        .upload-area {
            border: 2px dashed #e2e8f0;
            border-radius: 12px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #fafbfc;
        }
        .upload-area:hover {
            border-color: #667eea;
            background: #f0f4ff;
        }
        .upload-area i {
            font-size: 26px;
            color: #667eea;
            margin-bottom: 6px;
        }
        .file-name {
            font-size: 12px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 3px;
            word-break: break-all;
        }
        .file-hint {
            font-size: 10px;
            color: #718096;
        }
        .small.text-muted {
            font-size: 11px;
            margin-top: 4px;
        }
        .info-note {
            background: #f7fafc;
            border-radius: 14px;
            padding: 14px 18px;
            margin: 15px 0 15px;
            color: #4a5568;
            font-size: 13px;
            border-left: 4px solid #667eea;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .info-note i {
            color: #667eea;
            font-size: 18px;
        }
        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid #edf2f7;
        }
        .btn-reset {
            background: white;
            border: 2px solid #e2e8f0;
            color: #4a5568;
            padding: 10px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-reset:hover {
            background: #f7fafc;
            border-color: #cbd5e0;
        }
        .btn-submit {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            padding: 10px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 18px rgba(102, 126, 234, 0.35);
        }
        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        .badge-optional {
            background: #edf2f7;
            color: #4a5568;
            font-size: 9px;
            padding: 2px 8px;
            border-radius: 30px;
            font-weight: 600;
            letter-spacing: 0.3px;
            margin-left: 6px;
        }
        .text-danger.small {
            font-size: 11px;
            margin-top: 4px;
        }
        @media (max-width: 768px) {
            .form-body { padding: 16px; }
            .form-header { padding: 18px; }
            .row { grid-template-columns: 1fr; gap: 12px; }
            .form-actions { flex-direction: column; }
            .form-actions button { width: 100%; justify-content: center; }
            .file-header { flex-wrap: wrap; }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1>📄 Upload Berkas Pendaftaran</h1>
            <p>Lengkapi persyaratan dokumen untuk menyelesaikan pendaftaran</p>
        </div>

        <div class="form-body">
            <!-- Progress Steps -->
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 100%"></div>
                </div>
                <div class="step-indicator">
                    <div class="step-item">
                        <span class="step-dot completed">✓</span>
                        <span class="text-success fw-medium">Data Pribadi</span>
                    </div>
                    <div class="step-item">
                        <span class="step-dot completed">✓</span>
                        <span class="text-success fw-medium">Data Orang Tua</span>
                    </div>
                    <div class="step-item">
                        <span class="step-dot active">3</span>
                        <span class="text-primary fw-bold">Upload Berkas</span>
                    </div>
                </div>
            </div>

            <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($error); ?><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo e(session('success')); ?>

            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('siswa.berkas.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <!-- Upload Berkas -->
                <div class="section-title">
                    <i class="fas fa-cloud-upload-alt"></i> Upload Berkas Persyaratan
                    <span>Wajib diisi</span>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Format file:</strong> JPG, JPEG, PNG, PDF (Maksimal 2MB)
                </div>

                <div class="row">
                    <!-- Kartu Keluarga (KK) -->
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="file-header">
                                    <div class="file-icon" style="background: rgba(102, 126, 234, 0.1);">
                                        <i class="fas fa-users" style="color: #667eea;"></i>
                                    </div>
                                    <div class="file-info">
                                        <h5 class="file-title">Kartu Keluarga</h5>
                                        <p class="file-desc">JPG, PNG, PDF (Max 2MB)</p>
                                        <span class="file-badge">Wajib</span>
                                    </div>
                                </div>
                                
                                <div class="upload-area" onclick="document.getElementById('file_kk').click()">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <div class="file-name" id="file_kk_name">Pilih file</div>
                                    <div class="file-hint" id="file_kk_hint">Belum ada file</div>
                                    <input type="file" name="file_kk" id="file_kk" class="d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                                </div>
                                <?php $__errorArgs = ['file_kk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Nilai Rapot SD -->
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="file-header">
                                    <div class="file-icon" style="background: rgba(237, 137, 54, 0.1);">
                                        <i class="fas fa-book-open" style="color: #ed8936;"></i>
                                    </div>
                                    <div class="file-info">
                                        <h5 class="file-title">Ijazah SD</h5>
                                        <p class="file-desc">JPG, PNG, PDF (Max 2MB)</p>
                                        <span class="file-badge">Wajib</span>
                                    </div>
                                </div>
                                <div class="small text-muted mb-1"><i class="fas fa-info-circle me-1"></i> Semester 1-5 (1 file)</div>
                                
                                <div class="upload-area" onclick="document.getElementById('file_rapor').click()">
                                    <i class="fas fa-cloud-upload-alt" style="color: #ed8936;"></i>
                                    <div class="file-name" id="file_rapor_name">Pilih file</div>
                                    <div class="file-hint" id="file_rapor_hint">Belum ada file</div>
                                    <input type="file" name="file_rapor" id="file_rapor" class="d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                                </div>
                                <?php $__errorArgs = ['file_rapor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Ijazah SMP -->
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="file-header">
                                    <div class="file-icon" style="background: rgba(72, 187, 120, 0.1);">
                                        <i class="fas fa-graduation-cap" style="color: #48bb78;"></i>
                                    </div>
                                    <div class="file-info">
                                        <h5 class="file-title">Ijazah SMP</h5>
                                        <p class="file-desc">JPG, PNG, PDF (Max 2MB)</p>
                                        <span class="file-badge">Wajib</span>
                                    </div>
                                </div>
                                
                                <div class="upload-area" onclick="document.getElementById('file_ijazah').click()">
                                    <i class="fas fa-cloud-upload-alt" style="color: #48bb78;"></i>
                                    <div class="file-name" id="file_ijazah_name">Pilih file</div>
                                    <div class="file-hint" id="file_ijazah_hint">Belum ada file</div>
                                    <input type="file" name="file_ijazah" id="file_ijazah" class="d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                                </div>
                                <?php $__errorArgs = ['file_ijazah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Akta Kelahiran (Opsional) -->
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="file-header">
                                    <div class="file-icon" style="background: rgba(66, 153, 225, 0.1);">
                                        <i class="fas fa-baby" style="color: #4299e1;"></i>
                                    </div>
                                    <div class="file-info">
                                        <h5 class="file-title">Akta Kelahiran</h5>
                                        <p class="file-desc">JPG, PNG, PDF (Max 2MB)</p>
                                        <span class="badge-optional">Opsional</span>
                                    </div>
                                </div>
                                
                                <div class="upload-area" onclick="document.getElementById('file_akte').click()">
                                    <i class="fas fa-cloud-upload-alt" style="color: #4299e1;"></i>
                                    <div class="file-name" id="file_akte_name">Pilih file</div>
                                    <div class="file-hint" id="file_akte_hint">Belum ada file</div>
                                    <input type="file" name="file_akte" id="file_akte" class="d-none" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                                <?php $__errorArgs = ['file_akte'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Kolektif Peserta Ujian -->
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="file-header">
                                    <div class="file-icon" style="background: rgba(237, 100, 166, 0.1);">
                                        <i class="fas fa-list-alt" style="color: #ed64a6;"></i>
                                    </div>
                                    <div class="file-info">
                                        <h5 class="file-title">Daftar Kolektif Peserta Ujian</h5>
                                        <p class="file-desc">JPG, PNG, PDF (Max 2MB)</p>
                                        <span class="file-badge">Wajib</span>
                                    </div>
                                </div>
                                
                                <div class="upload-area" onclick="document.getElementById('file_daftar_kolektif').click()">
                                    <i class="fas fa-cloud-upload-alt" style="color: #ed64a6;"></i>
                                    <div class="file-name" id="file_daftar_kolektif_name">Pilih file</div>
                                    <div class="file-hint" id="file_daftar_kolektif_hint">Belum ada file</div>
                                    <input type="file" name="file_daftar_kolektif" id="file_daftar_kolektif" class="d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                                </div>
                                <?php $__errorArgs = ['file_daftar_kolektif'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Surat Rekomendasi Lulusan -->
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="file-header">
                                    <div class="file-icon" style="background: rgba(159, 122, 234, 0.1);">
                                        <i class="fas fa-recommendation" style="color: #9f7aea;"></i>
                                    </div>
                                    <div class="file-info">
                                        <h5 class="file-title">Surat Rekomendasi Lulusan</h5>
                                        <p class="file-desc">JPG, PNG, PDF (Max 2MB)</p>
                                        <span class="file-badge">Wajib</span>
                                    </div>
                                </div>
                                
                                <div class="upload-area" onclick="document.getElementById('file_surat_rekomendasi').click()">
                                    <i class="fas fa-cloud-upload-alt" style="color: #9f7aea;"></i>
                                    <div class="file-name" id="file_surat_rekomendasi_name">Pilih file</div>
                                    <div class="file-hint" id="file_surat_rekomendasi_hint">Belum ada file</div>
                                    <input type="file" name="file_surat_rekomendasi" id="file_surat_rekomendasi" class="d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                                </div>
                                <?php $__errorArgs = ['file_surat_rekomendasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Surat Keterangan Berkelakuan Baik -->
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="file-header">
                                    <div class="file-icon" style="background: rgba(245, 101, 101, 0.1);">
                                        <i class="fas fa-certificate" style="color: #f56565;"></i>
                                    </div>
                                    <div class="file-info">
                                        <h5 class="file-title">Surat Keterangan Berkelakuan Baik</h5>
                                        <p class="file-desc">JPG, PNG, PDF (Max 2MB)</p>
                                        <span class="file-badge">Wajib</span>
                                    </div>
                                </div>
                                
                                <div class="upload-area" onclick="document.getElementById('file_surat_keterangan').click()">
                                    <i class="fas fa-cloud-upload-alt" style="color: #f56565;"></i>
                                    <div class="file-name" id="file_surat_keterangan_name">Pilih file</div>
                                    <div class="file-hint" id="file_surat_keterangan_hint">Belum ada file</div>
                                    <input type="file" name="file_surat_keterangan" id="file_surat_keterangan" class="d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                                </div>
                                <?php $__errorArgs = ['file_surat_keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="info-note">
                    <i class="fas fa-shield-alt"></i>
                    <span>Pastikan file jelas dan mudah dibaca untuk verifikasi.</span>
                </div>

                <!-- Tombol Submit -->
                <!-- Tombol Submit -->
           <div class="form-actions">
         <button type="button" class="btn-submit" onclick="history.back()">
        <i class="fas fa-arrow-left me-2"></i>Kembali
      </button>
     <button type="submit" class="btn-submit">
     <i class="fas fa-save me-2"></i>Simpan Data
    </button>
    </div>
     </form>
     </div>
    </div>

    <!-- Script untuk menampilkan nama file yang dipilih -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function handleFileUpload(inputId, nameId, hintId) {
            const input = document.getElementById(inputId);
            const fileName = document.getElementById(nameId);
            const fileHint = document.getElementById(hintId);
            
            if (input) {
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        fileName.textContent = file.name.length > 25 ? file.name.substring(0, 22) + '...' : file.name;
                        fileHint.textContent = (file.size / 1024).toFixed(2) + ' KB';
                        fileHint.style.color = '#48bb78';
                        fileName.style.color = '#48bb78';
                    } else {
                        fileName.textContent = 'Pilih file';
                        fileHint.textContent = 'Belum ada file';
                        fileHint.style.color = '#718096';
                        fileName.style.color = '#2d3748';
                    }
                });
            }
        }

        handleFileUpload('file_kk', 'file_kk_name', 'file_kk_hint');
        handleFileUpload('file_ijazah', 'file_ijazah_name', 'file_ijazah_hint');
        handleFileUpload('file_rapor', 'file_rapor_name', 'file_rapor_hint');
        handleFileUpload('file_akte', 'file_akte_name', 'file_akte_hint');
        handleFileUpload('file_daftar_kolektif', 'file_daftar_kolektif_name', 'file_daftar_kolektif_hint');
        handleFileUpload('file_surat_rekomendasi', 'file_surat_rekomendasi_name', 'file_surat_rekomendasi_hint');
        handleFileUpload('file_surat_keterangan', 'file_surat_keterangan_name', 'file_surat_keterangan_hint');

        const form = document.querySelector('form');
        const submitBtn = document.getElementById('submitBtn');
        
        if (form) {
            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Upload...';
            });
        }
    });
    </script>
</body>
</html><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/siswa/data-pribadi/berkas.blade.php ENDPATH**/ ?>