<?php $__env->startSection('title', 'Edit Informasi - PPDB'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark">Edit Informasi PPDB</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.informasi.index')); ?>" class="text-decoration-none">Informasi</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="<?php echo e(route('admin.informasi.update', $informasi->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <!-- Judul Utama -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0">Informasi Umum</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="judul_utama" class="form-label">Judul Halaman</label>
                            <input type="text" class="form-control" id="judul_utama" name="judul_utama" value="<?php echo e(old('judul_utama', $dataInformasi['judul'] ?? $informasi->judul)); ?>" required>
                            <small class="text-muted">Contoh: INFORMASI PPDB SMA NEGERI KARUBAGA</small>
                        </div>
                        <div class="mb-3">
                            <label for="sub_judul" class="form-label">Sub Judul</label>
                            <input type="text" class="form-control" id="sub_judul" name="sub_judul" value="<?php echo e(old('sub_judul', $dataInformasi['sub_judul'] ?? '')); ?>" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Jadwal Pendaftaran -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0">📅 Jadwal Pendaftaran & Seleksi</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tabelJadwal">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 30%">Kegiatan</th>
                                        <th style="width: 30%">Tanggal</th>
                                        <th style="width: 30%">Keterangan</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $jadwalData = is_array($informasi->jadwal) ? $informasi->jadwal : json_decode($informasi->jadwal, true) ?? []; ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $jadwalData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[<?php echo e($index); ?>][kegiatan]" value="<?php echo e($jadwal['kegiatan'] ?? ''); ?>" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[<?php echo e($index); ?>][tanggal]" value="<?php echo e($jadwal['tanggal'] ?? ''); ?>" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[<?php echo e($index); ?>][keterangan]" value="<?php echo e($jadwal['keterangan'] ?? ''); ?>" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger hapusJadwal"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td><input type="text" class="form-control" name="jadwal[0][kegiatan]" required></td>
                                        <td><input type="text" class="form-control" name="jadwal[0][tanggal]" required></td>
                                        <td><input type="text" class="form-control" name="jadwal[0][keterangan]" required></td>
                                        <td class="text-center"><button type="button" class="btn btn-sm btn-danger hapusJadwal"><i class="bi bi-trash"></i></button></td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="tambahJadwal">
                            <i class="bi bi-plus-circle"></i> Tambah Baris Jadwal
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Persyaratan -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0">📋 Persyaratan Pendaftaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tabelPersyaratan">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 10%">No</th>
                                        <th style="width: 80%">Persyaratan</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $persyaratanData = is_array($informasi->persyaratan) ? $informasi->persyaratan : json_decode($informasi->persyaratan, true) ?? []; ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $persyaratanData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $persyaratan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td>
                                            <input type="text" class="form-control" name="persyaratan[<?php echo e($index); ?>][nama]" value="<?php echo e($persyaratan['nama'] ?? ''); ?>" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger hapusBaris"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" name="persyaratan[0][nama]" required></td>
                                        <td class="text-center"><button type="button" class="btn btn-sm btn-danger hapusBaris"><i class="bi bi-trash"></i></button></td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="tambahPersyaratan">
                            <i class="bi bi-plus-circle"></i> Tambah Persyaratan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Kontak Panitia -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0">📞 Kontak Panitia</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tabelKontak">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 20%">Tipe</th>
                                        <th style="width: 70%">Kontak</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $kontakData = is_array($informasi->kontak) ? $informasi->kontak : json_decode($informasi->kontak, true) ?? []; ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $kontakData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kontak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <select class="form-select" name="kontak[<?php echo e($index); ?>][tipe]">
                                                <option value="telepon" <?php echo e(($kontak['tipe'] ?? '') == 'telepon' ? 'selected' : ''); ?>>Telepon</option>
                                                <option value="email" <?php echo e(($kontak['tipe'] ?? '') == 'email' ? 'selected' : ''); ?>>Email</option>
                                                <option value="whatsapp" <?php echo e(($kontak['tipe'] ?? '') == 'whatsapp' ? 'selected' : ''); ?>>WhatsApp</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="kontak[<?php echo e($index); ?>][nilai]" value="<?php echo e($kontak['nilai'] ?? ''); ?>" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger hapusKontak"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td>
                                            <select class="form-select" name="kontak[0][tipe]">
                                                <option value="telepon">Telepon</option>
                                                <option value="email">Email</option>
                                                <option value="whatsapp">WhatsApp</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" name="kontak[0][nilai]" required></td>
                                        <td class="text-center"><button type="button" class="btn btn-sm btn-danger hapusKontak"><i class="bi bi-trash"></i></button></td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="tambahKontak">
                            <i class="bi bi-plus-circle"></i> Tambah Kontak
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Foto Siswa Diterima -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0">👤 Foto Pendaftaran yang di Update</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_siswa" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo e(old('nama_siswa', $dataInformasi['nama_siswa'] ?? '')); ?>" placeholder="judul pendaftaran">
                                <small class="text-muted">Judul pendaftaran</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="keterangan_siswa" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan_siswa" name="keterangan_siswa" value="<?php echo e(old('keterangan_siswa', $dataInformasi['keterangan_siswa'] ?? '')); ?>" placeholder="">
                                <small class="text-muted">Keterangan singkat Deskripsi</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="foto_siswa" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto_siswa" name="foto_siswa" accept="image/jpeg,image/jpg,image/png">
                                <small class="text-muted">Format: JPEG, JPG, PNG. Maksimal: 2MB. Kosongkan jika tidak ingin mengubah foto.</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Preview Foto</label>
                                <div id="fotoPreview" class="border rounded d-flex align-items-center justify-content-center bg-light" style="width: 150px; height: 150px;">
                                    <?php if($dataInformasi['foto_siswa'] ?? null): ?>
                                        <img src="<?php echo e(asset('storage/' . $dataInformasi['foto_siswa'])); ?>" class="img-fluid rounded" style="width: 150px; height: 150px; object-fit: cover;" alt="Current Foto">
                                    <?php else: ?>
                                        <i class="bi bi-person-circle fs-1 text-muted"></i>
                                    <?php endif; ?>
                                </div>
                                <small class="text-muted">Foto saat ini. Pilih foto baru untuk mengubah.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Informasi -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0">Pengaturan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status Informasi</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="aktif" <?php echo e(old('status', $informasi->status) == 'aktif' ? 'selected' : ''); ?>>Aktif - Tampilkan ke User</option>
                                    <option value="nonaktif" <?php echo e(old('status', $informasi->status) == 'nonaktif' ? 'selected' : ''); ?>>Nonaktif - Sembunyikan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tampilkan_di" class="form-label">Tampilkan Di</label>
                                <select class="form-select" id="tampilkan_di" name="tampilkan_di">
                                    <option value="semua" <?php echo e(old('tampilkan_di', $informasi->tampilkan_di ?? 'semua') == 'semua' ? 'selected' : ''); ?>>Semua Halaman</option>
                                    <option value="beranda" <?php echo e(old('tampilkan_di', $informasi->tampilkan_di ?? '') == 'beranda' ? 'selected' : ''); ?>>Beranda Utama</option>
                                    <option value="informasi" <?php echo e(old('tampilkan_di', $informasi->tampilkan_di ?? '') == 'informasi' ? 'selected' : ''); ?>>Halaman Informasi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="d-flex justify-content-between mb-4">
            <a href="<?php echo e(route('admin.informasi.index')); ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Update Informasi
            </button>
        </div>
    </form>
</div>

<!-- JavaScript untuk Dinamis Menambah/Menghapus Baris -->
<?php $__env->startPush('scripts'); ?>
<script>
    // Hitung index awal untuk jadwal
    let jadwalIndex = <?php echo e(count($jadwalData ?? [])); ?>;
    
    // Tambah baris jadwal
    $('#tambahJadwal').click(function() {
        let newRow = `
            <tr>
                <td><input type="text" class="form-control" name="jadwal[${jadwalIndex}][kegiatan]" required></td>
                <td><input type="text" class="form-control" name="jadwal[${jadwalIndex}][tanggal]" required></td>
                <td><input type="text" class="form-control" name="jadwal[${jadwalIndex}][keterangan]" required></td>
                <td class="text-center"><button type="button" class="btn btn-sm btn-danger hapusJadwal"><i class="bi bi-trash"></i></button></td>
            </tr>
        `;
        $('#tabelJadwal tbody').append(newRow);
        jadwalIndex++;
    });

    // Hapus baris jadwal
    $(document).on('click', '.hapusJadwal', function() {
        $(this).closest('tr').remove();
    });

    // Hitung index awal untuk persyaratan
    let persyaratanIndex = <?php echo e(count($persyaratanData ?? [])); ?>;
    
    // Tambah persyaratan
    $('#tambahPersyaratan').click(function() {
        let no = $('#tabelPersyaratan tbody tr').length + 1;
        let newRow = `
            <tr>
                <td>${no}</td>
                <td><input type="text" class="form-control" name="persyaratan[${persyaratanIndex}][nama]" required></td>
                <td class="text-center"><button type="button" class="btn btn-sm btn-danger hapusBaris"><i class="bi bi-trash"></i></button></td>
            </tr>
        `;
        $('#tabelPersyaratan tbody').append(newRow);
        persyaratanIndex++;
        updateNomorPersyaratan();
    });

    // Hapus baris persyaratan
    $(document).on('click', '.hapusBaris', function() {
        $(this).closest('tr').remove();
        updateNomorPersyaratan();
    });

    function updateNomorPersyaratan() {
        $('#tabelPersyaratan tbody tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
    }

    // Hitung index awal untuk kontak
    let kontakIndex = <?php echo e(count($kontakData ?? [])); ?>;
    
    // Tambah kontak
    $('#tambahKontak').click(function() {
        let newRow = `
            <tr>
                <td>
                    <select class="form-select" name="kontak[${kontakIndex}][tipe]">
                        <option value="telepon">Telepon</option>
                        <option value="email">Email</option>
                        <option value="whatsapp">WhatsApp</option>
                    </select>
                </td>
                <td><input type="text" class="form-control" name="kontak[${kontakIndex}][nilai]" required></td>
                <td class="text-center"><button type="button" class="btn btn-sm btn-danger hapusKontak"><i class="bi bi-trash"></i></button></td>
            </tr>
        `;
        $('#tabelKontak tbody').append(newRow);
        kontakIndex++;
    });

    // Hapus kontak
    $(document).on('click', '.hapusKontak', function() {
        $(this).closest('tr').remove();
    });

    // Preview foto siswa
    $('#foto_siswa').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#fotoPreview').html(`<img src="${e.target.result}" class="img-fluid rounded" style="width: 150px; height: 150px; object-fit: cover;" alt="Preview">`);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/admin/informasi/edit.blade.php ENDPATH**/ ?>