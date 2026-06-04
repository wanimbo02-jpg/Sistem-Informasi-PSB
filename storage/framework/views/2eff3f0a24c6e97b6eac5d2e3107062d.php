<?php $__env->startSection('title', 'Tambah Informasi - PPDB'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark">Tambah Informasi PPDB</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.informasi.index')); ?>" class="text-decoration-none">Informasi</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="<?php echo e(route('admin.informasi.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
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
                            <input type="text" class="form-control" id="judul_utama" name="judul_utama" value="<?php echo e(old('judul_utama', 'INFORMASI PPDB')); ?>" required>
                            <small class="text-muted">Contoh: INFORMASI PPDB SMA NEGERI KARUBAGA</small>
                        </div>
                        <div class="mb-3">
                            <label for="sub_judul" class="form-label">Sub Judul</label>
                            <input type="text" class="form-control" id="sub_judul" name="sub_judul" value="<?php echo e(old('sub_judul', 'SMA NEGERI KARUBAGA')); ?>" required>
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
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[0][kegiatan]" value="PENDAFTARAN ONLINE" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[0][tanggal]" value="1 Maret - 30 Juni 2024" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[0][keterangan]" value="Pendaftaran dibuka melalui website resmi PPDB" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger hapusJadwal"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[1][kegiatan]" value="SELEKSI" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[1][tanggal]" value="1 Juli - 15 Juli 2024" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[1][keterangan]" value="Seleksi berdasarkan hasil nilai jawaban yang terbaik" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger hapusJadwal"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[2][kegiatan]" value="UJIAN AKAN DILAKSANAKAN PADA" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[2][tanggal]" value="20 Juli 2024" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[2][keterangan]" value="Ujian akan dilaksanakan bertempat SMAN Karubaga" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger hapusJadwal"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[3][kegiatan]" value="PENGUMUMAN" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[3][tanggal]" value="20 Juli 2024" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="jadwal[3][keterangan]" value="Pengumuman akan diumumkan melalui website dan sekolah" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger hapusJadwal"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
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
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <input type="text" class="form-control" name="persyaratan[0][nama]" value="Ijazah/SKL (Asli & Fotokopi)" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger hapusBaris"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <input type="text" class="form-control" name="persyaratan[1][nama]" value="Kartu Keluarga (Fotokopi)" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger hapusBaris"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            <input type="text" class="form-control" name="persyaratan[2][nama]" value="Akta Kelahiran (Fotokopi)" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger hapusBaris"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>
                                            <input type="text" class="form-control" name="persyaratan[3][nama]" value="Pas Foto 3x4 (4 lembar)" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger hapusBaris"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>
                                            <input type="text" class="form-control" name="persyaratan[4][nama]" value="NSN dan NIK" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger hapusBaris"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
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
                                    <tr>
                                        <td>
                                            <select class="form-select" name="kontak[0][tipe]">
                                                <option value="telepon">Telepon</option>
                                                <option value="email">Email</option>
                                                <option value="whatsapp">WhatsApp</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="kontak[0][nilai]" value="(0961) 123456" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger hapusKontak"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-select" name="kontak[1][tipe]">
                                                <option value="telepon">Telepon</option>
                                                <option value="email" selected>Email</option>
                                                <option value="whatsapp">WhatsApp</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="kontak[1][nilai]" value="ppdb@smankarubaga.sch.id" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger hapusKontak"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
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
                        <h5 class="card-title mb-0">👤 Foto Siswa Diterima</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo e(old('nama_siswa')); ?>" placeholder="Masukkan nama siswa yang diterima">
                                <small class="text-muted">Nama lengkap siswa yang telah diterima</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="keterangan_siswa" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan_siswa" name="keterangan_siswa" value="<?php echo e(old('keterangan_siswa')); ?>" placeholder="Contoh: Selamat atas diterimanya">
                                <small class="text-muted">Keterangan singkat tentang siswa</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="foto_siswa" class="form-label">Foto Siswa</label>
                                <input type="file" class="form-control" id="foto_siswa" name="foto_siswa" accept="image/jpeg,image/jpg,image/png">
                                <small class="text-muted">Format: JPEG, JPG, PNG. Maksimal: 2MB</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Preview Foto</label>
                                <div id="fotoPreview" class="border rounded d-flex align-items-center justify-content-center bg-light" style="width: 150px; height: 150px;">
                                    <i class="bi bi-person-circle fs-1 text-muted"></i>
                                </div>
                                <small class="text-muted">Preview akan muncul setelah memilih foto</small>
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
                                    <option value="aktif" <?php echo e(old('status') == 'aktif' ? 'selected' : ''); ?>>Aktif - Tampilkan ke User</option>
                                    <option value="nonaktif" <?php echo e(old('status') == 'nonaktif' ? 'selected' : ''); ?>>Nonaktif - Sembunyikan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tampilkan_di" class="form-label">Tampilkan Di</label>
                                <select class="form-select" id="tampilkan_di" name="tampilkan_di">
                                    <option value="semua">Semua Halaman</option>
                                    <option value="beranda">Beranda Utama</option>
                                    <option value="informasi">Halaman Informasi</option>
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
                <i class="bi bi-check-circle"></i> Simpan Informasi
            </button>
        </div>
    </form>
</div>

<!-- JavaScript untuk Dinamis Menambah/Menghapus Baris -->
<?php $__env->startPush('scripts'); ?>
<script>
    // Tambah baris jadwal
    let jadwalIndex = 4;
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

    // Tambah persyaratan
    let persyaratanIndex = 5;
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

    // Tambah kontak
    let kontakIndex = 2;
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
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/admin/informasi/create.blade.php ENDPATH**/ ?>