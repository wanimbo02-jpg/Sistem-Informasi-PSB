<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Orang Tua - PPDB</title>
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
            max-width: 1000px;
            width: 100%;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }
        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 25px 30px;
            color: white;
            text-align: center;
        }
        .form-header h1 {
            font-size: 24px;
            font-weight: 600;
            margin: 0 0 5px 0;
        }
        .form-header p {
            font-size: 14px;
            margin: 0;
            opacity: 0.9;
        }
        .form-body {
            padding: 30px;
        }
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #1a202c;
            margin: 25px 0 20px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #667eea;
        }
        .section-title:first-of-type {
            margin-top: 0;
        }
        .form-label {
            font-weight: 500;
            color: #2d3748;
            margin-bottom: 5px;
            font-size: 14px;
        }
        .form-control, .form-select {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 14px;
            transition: all 0.2s;
            width: 100%;
            background: white;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }
        .required::after {
            content: " *";
            color: #e53e3e;
            font-weight: 600;
        }
        .text-muted {
            color: #718096;
            font-size: 12px;
            margin-top: 5px;
        }
        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 15px;
        }
        .full-width {
            grid-column: 1 / -1;
        }
        .info-note {
            background: #f0f4ff;
            border-radius: 8px;
            padding: 12px 16px;
            margin: 20px 0 10px;
            color: #4a5568;
            font-size: 13px;
            border-left: 4px solid #667eea;
        }
        .info-note i {
            color: #667eea;
            margin-right: 8px;
        }
        .footer-note {
            text-align: left;
            margin: 20px 0 30px;
            color: #718096;
            font-size: 13px;
            font-style: italic;
        }
        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        .btn-reset {
            background: white;
            border: 1.5px solid #e2e8f0;
            color: #4a5568;
            padding: 12px 35px;
            border-radius: 10px;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.2s;
            cursor: pointer;
        }
        .btn-reset:hover {
            background: #f7fafc;
            border-color: #cbd5e0;
        }
        .btn-submit {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            padding: 12px 35px;
            border-radius: 10px;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.2s;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(102, 126, 234, 0.2);
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }
        .alert-danger {
            background: #fff5f5;
            color: #c53030;
            border: 1px solid #feb2b2;
        }
        .phone-input {
            display: flex;
            align-items: center;
        }
        .phone-prefix {
            background: #edf2f7;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            padding: 10px 15px;
            font-size: 14px;
            color: #4a5568;
            font-weight: 500;
            min-width: 60px;
        }
        .phone-number {
            border-radius: 0 10px 10px 0;
            flex: 1;
        }
        @media (max-width: 768px) {
            .form-body { padding: 20px; }
            .row { grid-template-columns: 1fr; }
            .form-actions { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1>Tambah Data Orang Tua</h1>
            <p>Silakan lengkap data orang tua dengan benar</p>
        </div>

        <div class="form-body">
            <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($error); ?><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('siswa.data-ortu.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <!-- Data Ayah -->
                <div class="section-title">
                    <i class="fas fa-male me-2"></i>Data Ayah
                </div>
                
                <div class="row">
                    <div>
                        <label class="form-label required">Nama Ayah Kandung</label>
                        <input type="text" name="nama_ayah" class="form-control" value="<?php echo e(old('nama_ayah', $pendaftaran->nama_ayah ?? '')); ?>" required>
                    </div>
                    <div>
                        <label class="form-label required">NIK Ayah</label>
                        <input type="text" name="nik_ayah" class="form-control" value="<?php echo e(old('nik_ayah', $pendaftaran->nik_ayah ?? '')); ?>" maxlength="16" pattern="\d*" required>
                    </div>
                </div>

                <div class="row">
                    <div>
                        <label class="form-label required">Tanggal Lahir Ayah</label>
                        <input type="date" name="tanggal_lahir_ayah" class="form-control" value="<?php echo e(old('tanggal_lahir_ayah', $pendaftaran->tanggal_lahir_ayah ?? '')); ?>" required>
                    </div>
                    <div>
                        <label class="form-label required">Pendidikan Terakhir Ayah</label>
                        <select name="pendidikan_ayah" class="form-select" required>
                            <option value="">-- Pilih Pendidikan --</option>
                            <option value="Tidak Sekolah" <?php echo e(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'Tidak Sekolah' ? 'selected' : ''); ?>>Tidak Sekolah</option>
                            <option value="SD" <?php echo e(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'SD' ? 'selected' : ''); ?>>SD</option>
                            <option value="SMP" <?php echo e(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'SMP' ? 'selected' : ''); ?>>SMP</option>
                            <option value="SMA" <?php echo e(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'SMA' ? 'selected' : ''); ?>>SMA</option>
                            <option value="D1" <?php echo e(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'D1' ? 'selected' : ''); ?>>D1</option>
                            <option value="D2" <?php echo e(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'D2' ? 'selected' : ''); ?>>D2</option>
                            <option value="D3" <?php echo e(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'D3' ? 'selected' : ''); ?>>D3</option>
                            <option value="D4" <?php echo e(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'D4' ? 'selected' : ''); ?>>D4</option>
                            <option value="S1" <?php echo e(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'S1' ? 'selected' : ''); ?>>S1</option>
                            <option value="S2" <?php echo e(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'S2' ? 'selected' : ''); ?>>S2</option>
                            <option value="S3" <?php echo e(old('pendidikan_ayah', $pendaftaran->pendidikan_ayah ?? '') == 'S3' ? 'selected' : ''); ?>>S3</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div>
                        <label class="form-label required">Pekerjaan Ayah</label>
                        <select name="pekerjaan_ayah" class="form-select" required>
                            <option value="">-- Pilih Pekerjaan --</option>
                            <option value="Petani" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Petani' ? 'selected' : ''); ?>>Petani</option>
                            <option value="Nelayan" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Nelayan' ? 'selected' : ''); ?>>Nelayan</option>
                            <option value="Pedagang" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Pedagang' ? 'selected' : ''); ?>>Pedagang</option>
                            <option value="PNS" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'PNS' ? 'selected' : ''); ?>>PNS</option>
                            <option value="TNI" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'TNI' ? 'selected' : ''); ?>>TNI</option>
                            <option value="POLRI" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'POLRI' ? 'selected' : ''); ?>>POLRI</option>
                            <option value="Karyawan Swasta" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Karyawan Swasta' ? 'selected' : ''); ?>>Karyawan Swasta</option>
                            <option value="Wiraswasta" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Wiraswasta' ? 'selected' : ''); ?>>Wiraswasta</option>
                            <option value="Buruh" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Buruh' ? 'selected' : ''); ?>>Buruh</option>
                            <option value="Sopir" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Sopir' ? 'selected' : ''); ?>>Sopir</option>
                            <option value="Tukang" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Tukang' ? 'selected' : ''); ?>>Tukang</option>
                            <option value="Guru" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Guru' ? 'selected' : ''); ?>>Guru</option>
                            <option value="Dosen" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Dosen' ? 'selected' : ''); ?>>Dosen</option>
                            <option value="Dokter" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Dokter' ? 'selected' : ''); ?>>Dokter</option>
                            <option value="Perawat" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Perawat' ? 'selected' : ''); ?>>Perawat</option>
                            <option value="Lainnya" <?php echo e(old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') == 'Lainnya' ? 'selected' : ''); ?>>Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label required">Penghasilan Ayah</label>
                        <select name="penghasilan_ayah" class="form-select" required>
                            <option value="">-- Pilih Penghasilan --</option>
                            <option value="lainnya" <?php echo e(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'lainnya' ? 'selected' : ''); ?>>lainnya</option>
                            <option value=" Rp 1.000.000" <?php echo e(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == '< Rp 1.000.000' ? 'selected' : ''); ?>>> Rp 1.000.000</option>
                            <option value="Rp 1.000.000 - 2.000.000" <?php echo e(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp 1.000.000 - 2.000.000' ? 'selected' : ''); ?>>Rp 1.000.000 - 2.000.000</option>
                            <option value="Rp 2.000.000 - 3.000.000" <?php echo e(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp 2.000.000 - 3.000.000' ? 'selected' : ''); ?>>Rp 2.000.000 - 3.000.000</option>
                            <option value="Rp 3.000.000 - 4.000.000" <?php echo e(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp 3.000.000 - 4.000.000' ? 'selected' : ''); ?>>Rp 3.000.000 - 4.000.000</option>
                            <option value="Rp 4.000.000 - 5.000.000" <?php echo e(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp 4.000.000 - 5.000.000' ? 'selected' : ''); ?>>Rp 4.000.000 - 5.000.000</option>
                            <option value="Rp 5.000.000 - 6.000.000" <?php echo e(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp 5.000.000 - 6.000.000' ? 'selected' : ''); ?>>Rp 5.000.000 - 6.000.000</option>
                            <option value="Rp 6.000.000 - 7.000.000" <?php echo e(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp 6.000.000 - 7.000.000' ? 'selected' : ''); ?>>Rp 6.000.000 - 7.000.000</option>
                            <option value="Rp 7.000.000 - 8.000.000" <?php echo e(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp 7.000.000 - 8.000.000' ? 'selected' : ''); ?>>Rp 7.000.000 - 8.000.000</option>
                            <option value="Rp 8.000.000 - 9.000.000" <?php echo e(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp 8.000.000 - 9.000.000' ? 'selected' : ''); ?>>Rp 8.000.000 - 9.000.000</option>
                            <option value="Rp 9.000.000 - 10.000.000" <?php echo e(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp 9.000.000 - 10.000.000' ? 'selected' : ''); ?>>Rp 9.000.000 - 10.000.000</option>
                            <option value="> Rp 10.000.000" <?php echo e(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == '> Rp 10.000.000' ? 'selected' : ''); ?>>> Rp 10.000.000</option>
                        </select>
                    </div>
                </div>

                <!-- Data Ibu -->
                <div class="section-title">
                    <i class="fas fa-female me-2"></i>Data Ibu
                </div>
                
                <div class="row">
                    <div>
                        <label class="form-label required">Nama Ibu Kandung</label>
                        <input type="text" name="nama_ibu" class="form-control" value="<?php echo e(old('nama_ibu', $pendaftaran->nama_ibu ?? '')); ?>" required>
                    </div>
                    <div>
                        <label class="form-label required">NIK Ibu</label>
                        <input type="text" name="nik_ibu" class="form-control" value="<?php echo e(old('nik_ibu', $pendaftaran->nik_ibu ?? '')); ?>" maxlength="16" pattern="\d*" required>
                    </div>
                </div>

                <div class="row">
                    <div>
                        <label class="form-label required">Tanggal Lahir Ibu</label>
                        <input type="date" name="tanggal_lahir_ibu" class="form-control" value="<?php echo e(old('tanggal_lahir_ibu', $pendaftaran->tanggal_lahir_ibu ?? '')); ?>" required>
                    </div>
                    <div>
                        <label class="form-label required">Pendidikan Terakhir Ibu</label>
                        <select name="pendidikan_ibu" class="form-select" required>
                            <option value="">-- Pilih Pendidikan --</option>
                            <option value="Tidak Sekolah" <?php echo e(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'Tidak Sekolah' ? 'selected' : ''); ?>>Tidak Sekolah</option>
                            <option value="SD" <?php echo e(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'SD' ? 'selected' : ''); ?>>SD</option>
                            <option value="SMP" <?php echo e(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'SMP' ? 'selected' : ''); ?>>SMP</option>
                            <option value="SMA" <?php echo e(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'SMA' ? 'selected' : ''); ?>>SMA</option>
                            <option value="D1" <?php echo e(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'D1' ? 'selected' : ''); ?>>D1</option>
                            <option value="D2" <?php echo e(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'D2' ? 'selected' : ''); ?>>D2</option>
                            <option value="D3" <?php echo e(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'D3' ? 'selected' : ''); ?>>D3</option>
                            <option value="D4" <?php echo e(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'D4' ? 'selected' : ''); ?>>D4</option>
                            <option value="S1" <?php echo e(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'S1' ? 'selected' : ''); ?>>S1</option>
                            <option value="S2" <?php echo e(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'S2' ? 'selected' : ''); ?>>S2</option>
                            <option value="S3" <?php echo e(old('pendidikan_ibu', $pendaftaran->pendidikan_ibu ?? '') == 'S3' ? 'selected' : ''); ?>>S3</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div>
                        <label class="form-label required">Pekerjaan Ibu</label>
                        <select name="pekerjaan_ibu" class="form-select" required>
                            <option value="">-- Pilih Pekerjaan --</option>
                            <option value="Ibu Rumah Tangga" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Ibu Rumah Tangga' ? 'selected' : ''); ?>>Ibu Rumah Tangga</option>
                            <option value="Petani" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Petani' ? 'selected' : ''); ?>>Petani</option>
                            <option value="Nelayan" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Nelayan' ? 'selected' : ''); ?>>Nelayan</option>
                            <option value="Pedagang" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Pedagang' ? 'selected' : ''); ?>>Pedagang</option>
                            <option value="PNS" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'PNS' ? 'selected' : ''); ?>>PNS</option>
                            <option value="TNI" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'TNI' ? 'selected' : ''); ?>>TNI</option>
                            <option value="POLRI" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'POLRI' ? 'selected' : ''); ?>>POLRI</option>
                            <option value="Karyawan Swasta" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Karyawan Swasta' ? 'selected' : ''); ?>>Karyawan Swasta</option>
                            <option value="Wiraswasta" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Wiraswasta' ? 'selected' : ''); ?>>Wiraswasta</option>
                            <option value="Buruh" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Buruh' ? 'selected' : ''); ?>>Buruh</option>
                            <option value="Guru" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Guru' ? 'selected' : ''); ?>>Guru</option>
                            <option value="Dosen" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Dosen' ? 'selected' : ''); ?>>Dosen</option>
                            <option value="Dokter" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Dokter' ? 'selected' : ''); ?>>Dokter</option>
                            <option value="Perawat" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Perawat' ? 'selected' : ''); ?>>Perawat</option>
                            <option value="Lainnya" <?php echo e(old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') == 'Lainnya' ? 'selected' : ''); ?>>Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label required">Penghasilan Ibu</label>
                        <select name="penghasilan_ibu" class="form-select" required>
                            <option value="">-- Pilih Penghasilan --</option>
                            <option value="lainnya" <?php echo e(old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'lainnya' ? 'selected' : ''); ?>>lainnya</option>
                            <option value="< Rp 1.000.000" <?php echo e(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == '< Rp 1.000.000' ? 'selected' : ''); ?>>< Rp 1.000.000</option>
                            <option value="Rp 1.000.000 - 2.000.000" <?php echo e(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp 1.000.000 - 2.000.000' ? 'selected' : ''); ?>>Rp 1.000.000 - 2.000.000</option>
                            <option value="Rp 2.000.000 - 3.000.000" <?php echo e(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp 2.000.000 - 3.000.000' ? 'selected' : ''); ?>>Rp 2.000.000 - 3.000.000</option>
                            <option value="Rp 3.000.000 - 4.000.000" <?php echo e(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp 3.000.000 - 4.000.000' ? 'selected' : ''); ?>>Rp 3.000.000 - 4.000.000</option>
                            <option value="Rp 4.000.000 - 5.000.000" <?php echo e(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp 4.000.000 - 5.000.000' ? 'selected' : ''); ?>>Rp 4.000.000 - 5.000.000</option>
                            <option value="Rp 5.000.000 - 6.000.000" <?php echo e(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp 5.000.000 - 6.000.000' ? 'selected' : ''); ?>>Rp 5.000.000 - 6.000.000</option>
                            <option value="Rp 6.000.000 - 7.000.000" <?php echo e(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp 6.000.000 - 7.000.000' ? 'selected' : ''); ?>>Rp 6.000.000 - 7.000.000</option>
                            <option value="Rp 7.000.000 - 8.000.000" <?php echo e(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp 7.000.000 - 8.000.000' ? 'selected' : ''); ?>>Rp 7.000.000 - 8.000.000</option>
                            <option value="Rp 8.000.000 - 9.000.000" <?php echo e(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp 8.000.000 - 9.000.000' ? 'selected' : ''); ?>>Rp 8.000.000 - 9.000.000</option>
                            <option value="Rp 9.000.000 - 10.000.000" <?php echo e(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp 9.000.000 - 10.000.000' ? 'selected' : ''); ?>>Rp 9.000.000 - 10.000.000</option>
                            <option value="> Rp 10.000.000" <?php echo e(old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == '> Rp 10.000.000' ? 'selected' : ''); ?>>> Rp 10.000.000</option>
                        </select>
                    </div>
                </div>

                <!-- Kontak dan Alamat -->
                <div class="section-title">
                    <i class="fas fa-address-book me-2"></i>Kontak dan Alamat
                </div>
                
                <div class="row">
                    <div class="full-width">
                        <label class="form-label required">Alamat Lengkap</label>
                        <textarea name="alamat_ortu" class="form-control" rows="3" required><?php echo e(old('alamat_ortu', $pendaftaran->alamat_ortu ?? '')); ?></textarea>
                    </div>
                </div>

                <div class="row">
                    <div>
                        <label class="form-label required">Provinsi</label>
                        <select name="provinsi_ortu" id="provinsi_ortu" class="form-select" required>
                            <option value="">-- Pilih Provinsi --</option>
                            <option value="Aceh">Aceh</option>
                            <option value="Sumatera Utara">Sumatera Utara</option>
                            <option value="Sumatera Barat">Sumatera Barat</option>
                            <option value="Riau">Riau</option>
                            <option value="Kepulauan Riau">Kepulauan Riau</option>
                            <option value="Jambi">Jambi</option>
                            <option value="Bengkulu">Bengkulu</option>
                            <option value="Sumatera Selatan">Sumatera Selatan</option>
                            <option value="Bangka Belitung">Bangka Belitung</option>
                            <option value="Lampung">Lampung</option>
                            <option value="Banten">Banten</option>
                            <option value="DKI Jakarta">DKI Jakarta</option>
                            <option value="Jawa Barat">Jawa Barat</option>
                            <option value="Jawa Tengah">Jawa Tengah</option>
                            <option value="DI Yogyakarta">DI Yogyakarta</option>
                            <option value="Jawa Timur">Jawa Timur</option>
                            <option value="Bali">Bali</option>
                            <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                            <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                            <option value="Kalimantan Barat">Kalimantan Barat</option>
                            <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                            <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                            <option value="Kalimantan Timur">Kalimantan Timur</option>
                            <option value="Kalimantan Utara">Kalimantan Utara</option>
                            <option value="Sulawesi Utara">Sulawesi Utara</option>
                            <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                            <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                            <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                            <option value="Gorontalo">Gorontalo</option>
                            <option value="Sulawesi Barat">Sulawesi Barat</option>
                            <option value="Maluku">Maluku</option>
                            <option value="Maluku Utara">Maluku Utara</option>
                            <option value="Papua Barat">Papua Barat</option>
                            <option value="Papua Barat Daya">Papua Barat Daya</option>
                            <option value="Papua">Papua</option>
                            <option value="Papua Tengah">Papua Tengah</option>
                            <option value="Papua Pegunungan">Papua Pegunungan</option>
                            <option value="Papua Selatan">Papua Selatan</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label required">Kabupaten/Kota</label>
                        <select name="kabupaten_ortu" id="kabupaten_ortu" class="form-select" required>
                            <option value="">-- Pilih Kabupaten/Kota --</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div>
                        <label class="form-label required">Kecamatan</label>
                        <select name="kecamatan_ortu" id="kecamatan_ortu" class="form-select" required>
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label required">Kode Pos</label>
                        <input type="text" name="kode_pos_ortu" class="form-control" value="<?php echo e(old('kode_pos_ortu', $pendaftaran->kode_pos_ortu ?? '')); ?>" maxlength="5" pattern="\d*" required>
                    </div>
                </div>

                <div class="row">
                    <div class="full-width">
                        <label class="form-label required">No. HP Orang Tua</label>
                        <div class="phone-input">
                            <span class="phone-prefix">+62</span>
                            <input type="text" name="no_hp_ortu" class="form-control phone-number" value="<?php echo e(old('no_hp_ortu', $pendaftaran->no_hp_ortu ?? '')); ?>" placeholder="" required>
                        </div>
                        <div class="text-muted">Format:(12 digit)</div>
                    </div>
                </div>

                <div class="footer-note">
                    <i class="fas fa-asterisk text-danger me-1" style="font-size: 8px;"></i> Wajib diisi
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

    <script>
    // Data kabupaten per provinsi
    const kabupatenData = {
        'Papua': ['Jayapura', 'Biak Numfor', 'Nabire', 'Mimika', 'Merauke', 'Jayawijaya', 'Lanny Jaya', 'Nduga', 'Boven Digoel', 'Mappi', 'Asmat', 'Yahukimo', 'Pegunungan Bintang', 'Tolikara', 'Sarmi', 'Keerom', 'Waropen', 'Supiori', 'Mamberamo Raya', 'Intan Jaya', 'Deiyai', 'Puncak', 'Puncak Jaya', 'Dogiyai', 'Mamberamo Tengah', 'Yalimo', 'Kota Jayapura'],
        'Papua Barat': ['Manokwari', 'Fakfak', 'Sorong', 'Raja Ampat', 'Kaimana', 'Teluk Wondama', 'Teluk Bintuni', 'Sorong Selatan', 'Tambrauw', 'Maybrat', 'Pegunungan Arfak', 'Kota Sorong'],
        'Papua Barat Daya': ['Sorong', 'Raja Ampat', 'Tambrauw', 'Maybrat', 'Kota Sorong'],
        'Papua Tengah': ['Nabire', 'Mimika', 'Paniai', 'Puncak Jaya', 'Dogiyai', 'Intan Jaya', 'Deiyai'],
        'Papua Pegunungan': ['Jayawijaya', 'Lanny Jaya', 'Nduga', 'Pegunungan Bintang', 'Tolikara', 'Yahukimo', 'Yalimo', 'Mamberamo Tengah'],
        'Papua Selatan': ['Merauke', 'Boven Digoel', 'Mappi', 'Asmat'],
        'Aceh': ['Aceh Besar', 'Aceh Barat', 'Aceh Timur', 'Aceh Utara', 'Aceh Tengah', 'Aceh Selatan', 'Aceh Tenggara', 'Aceh Tamiang', 'Aceh Jaya', 'Aceh Singkil', 'Bener Meriah', 'Bireuen', 'Gayo Lues', 'Nagan Raya', 'Pidie', 'Pidie Jaya', 'Simeulue', 'Subulussalam', 'Langsa', 'Lhokseumawe', 'Sabang', 'Kota Banda Aceh'],
        'Sumatera Utara': ['Medan', 'Binjai', 'Tebing Tinggi', 'Pematang Siantar', 'Tanjung Balai', 'Sibolga', 'Padang Sidempuan', 'Gunungsitoli', 'Deli Serdang', 'Karo', 'Simalungun', 'Asahan', 'Labuhanbatu', 'Labuhanbatu Utara', 'Labuhanbatu Selatan', 'Toba Samosir', 'Tapanuli Utara', 'Tapanuli Tengah', 'Tapanuli Selatan', 'Mandailing Natal', 'Padang Lawas', 'Padang Lawas Utara', 'Serdang Bedagai', 'Batu Bara', 'Samosir', 'Humbang Hasundutan', 'Pakpak Bharat', 'Nias', 'Nias Barat', 'Nias Utara', 'Nias Selatan', 'Kota Gunungsitoli'],
        'Sumatera Barat': ['Padang', 'Bukittinggi', 'Payakumbuh', 'Solok', 'Sawahlunto', 'Padang Panjang', 'Pariaman', 'Agam', 'Tanah Datar', 'Padang Pariaman', 'Solok Selatan', 'Sijunjung', 'Dharmasraya', 'Pasaman', 'Pasaman Barat', 'Lima Puluh Kota', 'Pesisir Selatan', 'Kepulauan Mentawai'],
        'Riau': ['Pekanbaru', 'Dumai', 'Kampar', 'Rokan Hulu', 'Rokan Hilir', 'Siak', 'Bengkalis', 'Kepulauan Meranti', 'Pelalawan', 'Kuantan Singingi', 'Indragiri Hulu', 'Indragiri Hilir'],
        'Kepulauan Riau': ['Tanjungpinang', 'Batam', 'Bintan', 'Karimun', 'Lingga', 'Natuna', 'Kepulauan Anambas'],
        'Jambi': ['Jambi', 'Sungai Penuh', 'Batanghari', 'Bungo', 'Kerinci', 'Merangin', 'Muaro Jambi', 'Sarolangun', 'Tanjung Jabung Barat', 'Tanjung Jabung Timur', 'Tebo'],
        'Bengkulu': ['Bengkulu', 'Bengkulu Selatan', 'Bengkulu Tengah', 'Bengkulu Utara', 'Kaur', 'Kepahiang', 'Lebong', 'Muko Muko', 'Rejang Lebong', 'Seluma'],
        'Sumatera Selatan': ['Palembang', 'Pagar Alam', 'Lubuklinggau', 'Prabumulih', 'Banyuasin', 'Empat Lawang', 'Lahat', 'Muara Enim', 'Musi Banyuasin', 'Musi Rawas', 'Musi Rawas Utara', 'Ogan Ilir', 'Ogan Komering Ilir', 'Ogan Komering Ulu', 'Ogan Komering Ulu Selatan', 'Ogan Komering Ulu Timur', 'Penukal Abab Lematang Ilir'],
        'Bangka Belitung': ['Pangkalpinang', 'Bangka', 'Bangka Barat', 'Bangka Selatan', 'Bangka Tengah', 'Belitung', 'Belitung Timur'],
        'Lampung': ['Bandar Lampung', 'Metro', 'Lampung Barat', 'Lampung Selatan', 'Lampung Tengah', 'Lampung Timur', 'Lampung Utara', 'Mesuji', 'Pesawaran', 'Pesisir Barat', 'Pringsewu', 'Tanggamus', 'Tulang Bawang', 'Tulang Bawang Barat', 'Way Kanan'],
        'Banten': ['Cilegon', 'Serang', 'Tangerang', 'Tangerang Selatan', 'Lebak', 'Pandeglang', 'Kota Tangerang', 'Kota Serang', 'Kota Cilegon'],
        'DKI Jakarta': ['Jakarta Pusat', 'Jakarta Utara', 'Jakarta Barat', 'Jakarta Selatan', 'Jakarta Timur', 'Kepulauan Seribu'],
        'Jawa Barat': ['Bandung', 'Bekasi', 'Bogor', 'Cimahi', 'Cirebon', 'Depok', 'Sukabumi', 'Tasikmalaya', 'Banjar', 'Bandung Barat', 'Indramayu', 'Karawang', 'Kuningan', 'Majalengka', 'Pangandaran', 'Purwakarta', 'Subang', 'Sumedang', 'Garut', 'Ciamis', 'Kota Bandung', 'Kota Bekasi', 'Kota Bogor', 'Kota Cimahi', 'Kota Cirebon', 'Kota Depok', 'Kota Sukabumi', 'Kota Tasikmalaya', 'Kota Banjar'],
        'Jawa Tengah': ['Semarang', 'Magelang', 'Pekalongan', 'Tegal', 'Salatiga', 'Surakarta', 'Banjarnegara', 'Banyumas', 'Batang', 'Blora', 'Boyolali', 'Brebes', 'Cilacap', 'Demak', 'Grobogan', 'Jepara', 'Karanganyar', 'Kebumen', 'Kendal', 'Klaten', 'Kudus', 'Magelang', 'Pati', 'Pekalongan', 'Pemalang', 'Purbalingga', 'Purworejo', 'Rembang', 'Semarang', 'Sragen', 'Sukoharjo', 'Tegal', 'Temanggung', 'Wonogiri', 'Wonosobo', 'Kota Semarang', 'Kota Magelang', 'Kota Pekalongan', 'Kota Tegal', 'Kota Salatiga', 'Kota Surakarta'],
        'DI Yogyakarta': ['Yogyakarta', 'Bantul', 'Gunung Kidul', 'Kulon Progo', 'Sleman'],
        'Jawa Timur': ['Surabaya', 'Malang', 'Madiun', 'Kediri', 'Blitar', 'Pasuruan', 'Probolinggo', 'Mojokerto', 'Jombang', 'Banyuwangi', 'Bangkalan', 'Bojonegoro', 'Bondowoso', 'Gresik', 'Jember', 'Lamongan', 'Lumajang', 'Magetan', 'Nganjuk', 'Ngawi', 'Pacitan', 'Pamekasan', 'Ponorogo', 'Sampang', 'Sidoarjo', 'Situbondo', 'Sumenep', 'Trenggalek', 'Tuban', 'Tulungagung', 'Kota Batu', 'Kota Blitar', 'Kota Kediri', 'Kota Madiun', 'Kota Malang', 'Kota Mojokerto', 'Kota Pasuruan', 'Kota Probolinggo', 'Kota Surabaya'],
        'Bali': ['Denpasar', 'Badung', 'Bangli', 'Buleleng', 'Gianyar', 'Jembrana', 'Karangasem', 'Klungkung', 'Tabanan'],
        'Nusa Tenggara Barat': ['Mataram', 'Bima', 'Lombok Barat', 'Lombok Tengah', 'Lombok Timur', 'Lombok Utara', 'Sumbawa', 'Sumbawa Barat', 'Dompu', 'Bima', 'Kota Bima', 'Kota Mataram'],
        'Nusa Tenggara Timur': ['Kupang', 'Alor', 'Belu', 'Ende', 'Flores Timur', 'Lembata', 'Manggarai', 'Manggarai Barat', 'Manggarai Timur', 'Nagekeo', 'Ngada', 'Rote Ndao', 'Sabu Raijua', 'Sikka', 'Sumba Barat', 'Sumba Barat Daya', 'Sumba Tengah', 'Sumba Timur', 'Timor Tengah Selatan', 'Timor Tengah Utara', 'Kota Kupang'],
        'Kalimantan Barat': ['Pontianak', 'Singkawang', 'Bengkayang', 'Kapuas Hulu', 'Kayong Utara', 'Ketapang', 'Kubu Raya', 'Landak', 'Melawi', 'Mempawah', 'Sambas', 'Sanggau', 'Sekadau', 'Sintang', 'Kota Pontianak', 'Kota Singkawang'],
        'Kalimantan Tengah': ['Palangka Raya', 'Barito Selatan', 'Barito Timur', 'Barito Utara', 'Gunung Mas', 'Kapuas', 'Katingan', 'Kotawaringin Barat', 'Kotawaringin Timur', 'Lamandau', 'Murung Raya', 'Pulang Pisau', 'Sukamara', 'Seruyan'],
        'Kalimantan Selatan': ['Banjarmasin', 'Banjarbaru', 'Balangan', 'Banjar', 'Barito Kuala', 'Hulu Sungai Selatan', 'Hulu Sungai Tengah', 'Hulu Sungai Utara', 'Kotabaru', 'Tabalong', 'Tanah Bumbu', 'Tanah Laut', 'Tapin', 'Kota Banjarmasin', 'Kota Banjarbaru'],
        'Kalimantan Timur': ['Samarinda', 'Balikpapan', 'Bontang', 'Berau', 'Kutai Barat', 'Kutai Kartanegara', 'Kutai Timur', 'Mahakam Ulu', 'Paser', 'Penajam Paser Utara', 'Kota Samarinda', 'Kota Balikpapan', 'Kota Bontang'],
        'Kalimantan Utara': ['Tarakan', 'Bulungan', 'Malinau', 'Nunukan', 'Tana Tidung', 'Kota Tarakan'],
        'Sulawesi Utara': ['Manado', 'Bitung', 'Tomohon', 'Kotamobagu', 'Bolaang Mongondow', 'Bolaang Mongondow Selatan', 'Bolaang Mongondow Timur', 'Bolaang Mongondow Utara', 'Kepulauan Sangihe', 'Kepulauan Siau Tagulandang Biaro', 'Kepulauan Talaud', 'Minahasa', 'Minahasa Selatan', 'Minahasa Tenggara', 'Minahasa Utara', 'Kota Manado', 'Kota Bitung', 'Kota Tomohon', 'Kota Kotamobagu'],
        'Sulawesi Tengah': ['Palu', 'Banggai', 'Banggai Kepulauan', 'Banggai Laut', 'Buol', 'Donggala', 'Morowali', 'Morowali Utara', 'Parigi Moutong', 'Poso', 'Sigi', 'Tojo Una Una', 'Tolitoli', 'Kota Palu'],
        'Sulawesi Selatan': ['Makassar', 'Parepare', 'Palopo', 'Bantaeng', 'Barru', 'Bone', 'Bulukumba', 'Enrekang', 'Gowa', 'Jeneponto', 'Kepulauan Selayar', 'Luwu', 'Luwu Timur', 'Luwu Utara', 'Maros', 'Pangkajene Kepulauan', 'Pinrang', 'Sidenreng Rappang', 'Sinjai', 'Soppeng', 'Takalar', 'Tana Toraja', 'Toraja Utara', 'Wajo', 'Kota Makassar', 'Kota Parepare', 'Kota Palopo'],
        'Sulawesi Tenggara': ['Kendari', 'Baubau', 'Bombana', 'Buton', 'Buton Selatan', 'Buton Tengah', 'Buton Utara', 'Kolaka', 'Kolaka Timur', 'Kolaka Utara', 'Konawe', 'Konawe Kepulauan', 'Konawe Selatan', 'Konawe Utara', 'Muna', 'Muna Barat', 'Wakatobi', 'Kota Kendari', 'Kota Baubau'],
        'Gorontalo': ['Gorontalo', 'Boalemo', 'Bone Bolango', 'Gorontalo Utara', 'Pohuwato', 'Kota Gorontalo'],
        'Sulawesi Barat': ['Mamuju', 'Majene', 'Mamasa', 'Mamuju Tengah', 'Pasangkayu', 'Polewali Mandar'],
        'Maluku': ['Ambon', 'Tual', 'Buru', 'Buru Selatan', 'Kepulauan Aru', 'Maluku Barat Daya', 'Maluku Tengah', 'Maluku Tenggara', 'Maluku Tenggara Barat', 'Seram Bagian Barat', 'Seram Bagian Timur', 'Kota Ambon', 'Kota Tual'],
        'Maluku Utara': ['Ternate', 'Tidore Kepulauan', 'Halmahera Barat', 'Halmahera Tengah', 'Halmahera Timur', 'Halmahera Selatan', 'Halmahera Utara', 'Kepulauan Sula', 'Pulau Morotai', 'Pulau Taliabu', 'Kota Ternate', 'Kota Tidore Kepulauan']
    };

    // Data kecamatan per kabupaten (contoh untuk Tolikara dan lainnya)
    const kecamatanData = {
        // Kabupaten di Papua
        'Tolikara': ['Air Garam', 'Bewani', 'Bokondini', 'Bokoneri', 'Dorman', 'Dow', 'Dundu', 'Egiam', 'Geya', 'Gilubandu', 'Goyage', 'Gundagi', 'Kamboneri', 'Kanggime', 'Kembu', 'Kondaga', 'Kuari', 'Kubu', 'Liro', 'Mam', 'Mapia', 'Nabunage', 'Nelawi', 'Numba', 'Nunggawi', 'Panaga', 'Poganeri', 'Tagime', 'Tagineri', 'Telenggeme', 'Timori', 'Umagi', 'Wakuo', 'Wari', 'Wina', 'Wonoki', 'Wugimu', 'Yako'],
        'Jayapura': ['Abepura', 'Heram', 'Jayapura Selatan', 'Jayapura Utara', 'Muara Tami'],
        'Biak Numfor': ['Biak Barat', 'Biak Kota', 'Biak Timur', 'Biak Utara', 'Numfor Barat', 'Numfor Timur', 'Padaido', 'Samofa', 'Warsa', 'Yendidori'],
        'Nabire': ['Nabire', 'Nabire Barat', 'Napan', 'Siriwo', 'Teluk Kimi', 'Uwapa', 'Wanggar', 'Wapoga', 'Wonawa', 'Yaro'],
        'Mimika': ['Mimika Barat', 'Mimika Barat Jauh', 'Mimika Barat Tengah', 'Mimika Baru', 'Mimika Timur', 'Mimika Timur Jauh', 'Mimika Timur Tengah', 'Tembagapura'],
        'Merauke': ['Merauke', 'Jagebob', 'Kimaam', 'Kurik', 'Naukenjerai', 'Okaba', 'Semangga', 'Sota', 'Tanah Miring', 'Ulilin'],
        'Jayawijaya': ['Asologaima', 'Bolakme', 'Hubikosi', 'Kelila', 'Kurulu', 'Libarek', 'Maki', 'Pelebaga', 'Sogokmo', 'Tagime', 'Tagineri', 'Trikora', 'Wollo', 'Wouma', 'Yalengga'],
        'Lanny Jaya': ['Balingga', 'Dimba', 'Gamelia', 'Kuyawage', 'Makki', 'Melagineri', 'Pirime', 'Poga', 'Tiom', 'Tiomneri', 'Wano Barat', 'Wereka', 'Yiginua'],
        'Nduga': ['Gearek', 'Geselma', 'Kegayem', 'Kenyam', 'Kilmid', 'Mebarok', 'Moba', 'Mugi', 'Nenggeagin', 'Nirkuri', 'Paro', 'Pasir Putih', 'Pija', 'Wosak', 'Wusi', 'Yal'],
        'Boven Digoel': ['Ambatkwi', 'Arimop', 'Bomakia', 'Firiwage', 'Fofi', 'Iniyandit', 'Jair', 'Kawagit', 'Ki', 'Kombay', 'Kouh', 'Mandobo', 'Manggelum', 'Mindiptana', 'Ninati', 'Sesnuk', 'Subur', 'Waropko', 'Yaniruma'],
        'Mappi': ['Assue', 'Bamgi', 'Citakmitak', 'Edera', 'Haju', 'Kaibar', 'Minyamur', 'Nambioman Bapai', 'Obaa', 'Passue', 'Passue Bawah', 'Syahcame', 'Ti Zain', 'Venaha', 'Yakomi'],
        'Asmat': ['Agats', 'Akats', 'Atsy', 'Ayip', 'Betcbamu', 'Der Koumur', 'Fayit', 'Jetsy', 'Joerat', 'Kolf Braza', 'Kopay', 'Pantai Kasuari', 'Pulau Tiga', 'Safan', 'Sawa Erma', 'Sirets', 'Suator', 'Suru-suru', 'Unir Sirau'],
        'Yahukimo': ['Amuma', 'Anggruk', 'Bomela', 'Dekai', 'Dirwemna', 'Duram', 'Endomen', 'Hereapini', 'Hilipuk', 'Hogio', 'Holuon', 'Kabianggama', 'Kayo', 'Kona', 'Korupun', 'Kosarek', 'Kurima', 'Kwelemdua', 'Kwikma', 'Langda', 'Lolat', 'Mugi', 'Musaik', 'Nalca', 'Ninia', 'Nipsan', 'Obio', 'Panggema', 'Pasema', 'Pronggoli', 'Puldama', 'Samenage', 'Sela', 'Seredela', 'Silimo', 'Soba', 'Sobaham', 'Soloikma', 'Sumo', 'Suntamon', 'Suru Suru', 'Talambo', 'Tangma', 'Ubahak', 'Ubalihi', 'Ukha', 'Walma', 'Werima', 'Wusuma', 'Yahuliambut', 'Yogosem'],
        'Pegunungan Bintang': ['Aboy', 'Alemsom', 'Awinbon', 'Batani', 'Batom', 'Bime', 'Borme', 'Eipumek', 'Iwur', 'Jetfa', 'Kalomdol', 'Kawor', 'Kiwirok', 'Kiwirok Timur', 'Mofinop', 'Murkim', 'Nongme', 'Ok Aom', 'Okbab', 'Okbape', 'Okbemtau', 'Okbibab', 'Okhika', 'Oklip', 'Oksamol', 'Oksebang', 'Oksibil', 'Oksop', 'Pamek', 'Pepera', 'Serambakon', 'Tarup', 'Teiraplu', 'Weime'],
        'Sarmi': ['Apawer Hulu', 'Bonggo', 'Bonggo Timur', 'Pantai Barat', 'Pantai Timur', 'Pantai Timur Bagian Barat', 'Sarmi', 'Tor Atas'],
        'Keerom': ['Arso', 'Arso Barat', 'Arso Timur', 'Senggi', 'Skanto', 'Towe', 'Waris', 'Web', 'Yaffi'],
        'Waropen': ['Demba', 'Inggerus', 'Kirihi', 'Masirei', 'Oudate', 'Risei Sayati', 'Soyoi Mambai', 'Urei Faisei', 'Wapoga', 'Waropen Bawah', 'Waropen Kiri'],
        'Supiori': ['Kepulauan Aruri', 'Supiori Barat', 'Supiori Selatan', 'Supiori Timur', 'Supiori Utara'],
        'Mamberamo Raya': ['Benuki', 'Mamberamo Hilir', 'Mamberamo Hulu', 'Mamberamo Tengah', 'Mamberamo Tengah Timur', 'Rufaer', 'Sawai', 'Waropen Atas'],
        'Intan Jaya': ['Agisiga', 'Biandoga', 'Hitadipa', 'Homeyo', 'Sugapa', 'Tomosiga', 'Ugimba', 'Wandai'],
        'Deiyai': ['Bowobado', 'Kapiraya', 'Tigi', 'Tigi Barat', 'Tigi Timur'],
        'Puncak': ['Agandugume', 'Amungkalpia', 'Beoga', 'Beoga Barat', 'Beoga Timur', 'Bina', 'Dervos', 'Doufo', 'Erelmakawia', 'Gome', 'Gome Utara', 'Ilaga', 'Ilaga Utara', 'Kembru', 'Lambewi', 'Mabugi', 'Mageabume', 'Ogamanim', 'Omukia', 'Oneri', 'Pogoma', 'Sinak', 'Sinak Barat', 'Wangbe', 'Yugumuak'],
        'Puncak Jaya': ['Dagai', 'Dokome', 'Fawi', 'Gubume', 'Gurage', 'Ilamburawi', 'Ilu', 'Irimuli', 'Kalome', 'Kiyage', 'Lumo', 'Mewoluk', 'Molanikime', 'Muara', 'Mulia', 'Nioga', 'Nume', 'Paganamba', 'Silokarn Doga', 'Taganombak', 'Tingginambut', 'Torere', 'Waegi', 'Wanwi', 'Yambi', 'Yamo', 'Yamoneri'],
        'Dogiyai': ['Dogiyai', 'Kamu', 'Kamu Selatan', 'Kamu Timur', 'Kamu Utara', 'Mapia', 'Mapia Barat', 'Mapia Tengah', 'Piyaiye', 'Sukikai Selatan'],
        'Mamberamo Tengah': ['Eragayam', 'Ilugwa', 'Kelila', 'Kobakma', 'Megabilis', 'Moba', 'Wari'],
        'Yalimo': ['Abenaho', 'Apalapsili', 'Benawa', 'Elelim', 'Welarek'],
        'Kota Jayapura': ['Abepura', 'Heram', 'Jayapura Selatan', 'Jayapura Utara', 'Muara Tami'],
        
        // Tambahkan data untuk kabupaten lain di sini
        'Manokwari': ['Manokwari Barat', 'Manokwari Timur', 'Manokwari Utara', 'Manokwari Selatan', 'Masni', 'Prafi', 'Sidey', 'Tanah Rubuh', 'Warmare'],
        'Fakfak': ['Fakfak', 'Fakfak Barat', 'Fakfak Tengah', 'Fakfak Timur', 'Fakfak Timur Tengah', 'Fakfak Utara', 'Karas', 'Kokas', 'Kramongmongga', 'Teluk Patipi'],
        'Sorong': ['Aimas', 'Beraur', 'Klabot', 'Klamono', 'Klaso', 'Klawak', 'Klayili', 'Makbon', 'Mariat', 'Maudus', 'Mayamuk', 'Moisegen', 'Salawati', 'Salawati Selatan', 'Salawati Tengah', 'Sayosa', 'Sayosa Timur', 'Seget', 'Segun', 'Sorong'],
        'Raja Ampat': ['Ayau', 'Batanta Selatan', 'Batanta Utara', 'Kepulauan Ayau', 'Kepulauan Sembilan', 'Kofiau', 'Kota Waisai', 'Meos Mansar', 'Misool', 'Misool Barat', 'Misool Selatan', 'Misool Timur', 'Salawati Barat', 'Salawati Tengah', 'Salawati Utara', 'Supnin', 'Teluk Mayalibit', 'Tiplol Mayalibit', 'Waigeo Barat', 'Waigeo Barat Kepulauan', 'Waigeo Selatan', 'Waigeo Timur', 'Waigeo Utara', 'Warwabomi'],
        'Kaimana': ['Buruway', 'Kaimana', 'Kambraw', 'Teluk Arguni', 'Teluk Arguni Atas', 'Teluk Etna', 'Yamor'],
        'Teluk Wondama': ['Naikere', 'Rasei', 'Rendani', 'Roon', 'Roswar', 'Rumberpon', 'Soug Jaya', 'Teluk Duairi', 'Wamesa', 'Wasior', 'Wasior Barat', 'Wasior Selatan', 'Wasior Timur', 'Wasior Utara', 'Windesi', 'Wondiboy'],
        'Teluk Bintuni': ['Aranday', 'Babo', 'Bintuni', 'Biscoop', 'Fafuwar', 'Idoor', 'Kaitaro', 'Kamundan', 'Kuri', 'Manimeri', 'Masyeta', 'Meyado', 'Merdey', 'Moskona Barat', 'Moskona Selatan', 'Moskona Timur', 'Moskona Utara', 'Simuri', 'Tembuni', 'Tomu', 'Tuhiba', 'Wamesa', 'Weriagar'],
        'Sorong Selatan': ['Fokour', 'Inanwatan', 'Kais', 'Kais Darat', 'Kokoda', 'Kokoda Utara', 'Konda', 'Matemani', 'Moskona Selatan', 'Saifi', 'Sawiat', 'Seremuk', 'Teminabuan', 'Wayer'],
        'Tambrauw': ['Abun', 'Amberbaken', 'Amberbaken Barat', 'Ases', 'Bamusbama', 'Bikar', 'Fef', 'Ireres', 'Kasi', 'Kebar', 'Kebar Selatan', 'Kebar Timur', 'Kwesefo', 'Kwoor', 'Manekar', 'Mawabuan', 'Miyah', 'Miyah Selatan', 'Moraid', 'Mpur', 'Mubrani', 'Sausapor', 'Selemkai', 'Senopi', 'Syujak', 'Tinggouw', 'Tobouw', 'Wilhem Roumbouts', 'Yembun'],
        'Maybrat': ['Aifat', 'Aifat Selatan', 'Aifat Timur', 'Aifat Timur Jauh', 'Aifat Timur Selatan', 'Aifat Timur Tengah', 'Aifat Utara', 'Aitinyo', 'Aitinyo Barat', 'Aitinyo Raya', 'Aitinyo Tengah', 'Aitinyo Utara', 'Ayamaru', 'Ayamaru Barat', 'Ayamaru Jaya', 'Ayamaru Selatan', 'Ayamaru Selatan Jaya', 'Ayamaru Tengah', 'Ayamaru Timur', 'Ayamaru Timur Selatan', 'Ayamaru Utara', 'Ayamaru Utara Timur', 'Mare', 'Mare Selatan'],
        'Pegunungan Arfak': ['Anggi', 'Anggi Gida', 'Catubouw', 'Didohu', 'Hingk', 'Membey', 'Menyambouw', 'Minamba', 'Neney', 'Sururey', 'Taige', 'Testega'],
        'Kota Sorong': ['Klaurung', 'Maladum Mes', 'Malaimsimsa', 'Sorong Barat', 'Sorong Kepulauan', 'Sorong Manoi', 'Sorong Timur', 'Sorong Utara']
    };

    // Fungsi untuk mengisi dropdown kabupaten berdasarkan provinsi
    function updateKabupatenOrtu() {
        const provinsiSelect = document.getElementById('provinsi_ortu');
        const kabupatenSelect = document.getElementById('kabupaten_ortu');
        const kecamatanSelect = document.getElementById('kecamatan_ortu');
        const selectedProvinsi = provinsiSelect.value;
        
        // Reset kabupaten dan kecamatan
        kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
        kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        
        // Jika provinsi dipilih dan ada datanya
        if (selectedProvinsi && kabupatenData[selectedProvinsi]) {
            const kabupatenList = kabupatenData[selectedProvinsi].sort();
            
            kabupatenList.forEach(kabupaten => {
                const option = document.createElement('option');
                option.value = kabupaten;
                option.textContent = kabupaten;
                kabupatenSelect.appendChild(option);
            });
        }
    }

    // Fungsi untuk mengisi dropdown kecamatan berdasarkan kabupaten
    function updateKecamatanOrtu() {
        const kabupatenSelect = document.getElementById('kabupaten_ortu');
        const kecamatanSelect = document.getElementById('kecamatan_ortu');
        const selectedKabupaten = kabupatenSelect.value;
        
        // Reset kecamatan
        kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        
        // Jika kabupaten dipilih dan ada datanya
        if (selectedKabupaten && kecamatanData[selectedKabupaten]) {
            const kecamatanList = kecamatanData[selectedKabupaten].sort();
            
            kecamatanList.forEach(kecamatan => {
                const option = document.createElement('option');
                option.value = kecamatan;
                option.textContent = kecamatan;
                kecamatanSelect.appendChild(option);
            });
        }
    }

    // Event listener
    document.addEventListener('DOMContentLoaded', function() {
        const provinsiSelect = document.getElementById('provinsi_ortu');
        const kabupatenSelect = document.getElementById('kabupaten_ortu');
        
        if (provinsiSelect) {
            provinsiSelect.addEventListener('change', updateKabupatenOrtu);
        }
        
        if (kabupatenSelect) {
            kabupatenSelect.addEventListener('change', updateKecamatanOrtu);
        }
        
        // Validasi NIK hanya angka dan 16 digit
    document.querySelector('input[name="nik_ayah"]')?.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16);
        // Trim whitespace
        this.value = this.value.trim();
    });
    
    document.querySelector('input[name="nik_ibu"]')?.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16);
        // Trim whitespace
        this.value = this.value.trim();
    });
    
    // Trim saat blur (kursor keluar field)
    document.querySelector('input[name="nik_ayah"]')?.addEventListener('blur', function(e) {
        this.value = this.value.trim();
    });
    
    document.querySelector('input[name="nik_ibu"]')?.addEventListener('blur', function(e) {
        this.value = this.value.trim();
    });
    
    // Jalankan saat halaman dimuat untuk mengisi jika ada nilai lama
        updateKabupatenOrtu();
    });
    </script>
</body>
</html><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/siswa/data-pribadi/data-ortu.blade.php ENDPATH**/ ?>