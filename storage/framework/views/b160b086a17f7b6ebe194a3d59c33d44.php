<?php $__env->startSection('title', 'Dashboard Guru - PPDB'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    /* Dashboard Styles - Scoped to prevent affecting sidebar */
    .dashboard-wrapper .stat-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        border: none;
        position: relative;
        z-index: 1;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    .dashboard-wrapper .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
        z-index: -1;
    }
    .dashboard-wrapper .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }
    .dashboard-wrapper .stat-icon {
        font-size: 3.5rem;
        opacity: 0.2;
        position: absolute;
        bottom: 10px;
        right: 10px;
        transition: all 0.3s;
    }
    .dashboard-wrapper .stat-card:hover .stat-icon {
        opacity: 0.3;
        transform: scale(1.1);
    }

    /* Gradient Backgrounds */
    .dashboard-wrapper .bg-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .dashboard-wrapper .bg-gradient-success { background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%); }
    .dashboard-wrapper .bg-gradient-info { background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%); }
    .dashboard-wrapper .bg-gradient-warning { background: linear-gradient(135deg, #fad0c4 0%, #ffd1ff 100%); }
    .dashboard-wrapper .bg-gradient-danger { background: linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%); }
    .dashboard-wrapper .bg-gradient-secondary { background: linear-gradient(135deg, #868e96 0%, #adb5bd 100%); }

    /* Border Left Cards */
    .dashboard-wrapper .border-left-card {
        border-left: 4px solid;
        border-radius: 12px;
        transition: all 0.3s;
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }
    .dashboard-wrapper .border-left-card:hover {
        transform: translateX(5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .dashboard-wrapper .border-left-primary { border-left-color: #667eea; }
    .dashboard-wrapper .border-left-success { border-left-color: #84fab0; }
    .dashboard-wrapper .border-left-info { border-left-color: #a1c4fd; }
    .dashboard-wrapper .border-left-warning { border-left-color: #fad0c4; }
    .dashboard-wrapper .border-left-danger { border-left-color: #fbc2eb; }
    .dashboard-wrapper .border-left-secondary { border-left-color: #868e96; }

    /* Status Badges */
    .status-badge {
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-verifikasi { background: #cff4fc; color: #055160; }
    .status-diterima { background: #d4edda; color: #155724; }
    .status-ditolak { background: #f8d7da; color: #721c24; }

    /* Progress Bars */
    .progress {
        height: 8px;
        border-radius: 4px;
        background-color: #e9ecef;
    }
    .progress-bar { border-radius: 4px; }

    /* Recent Student Table */
    .table-responsive {
        overflow-x: auto;
    }
    .recent-student-table {
        border: 1px solid #dee2e6;
    }
    .recent-student-table th {
        background: #f8f9fa;
        color: #333;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #dee2e6;
        padding: 0.75rem;
    }
    .recent-student-table td {
        vertical-align: middle;
        padding: 0.75rem;
        border-bottom: 1px solid #dee2e6;
    }
    .recent-student-table tr:hover {
        background: #f8f9fa;
    }
    .recent-student-table tr:last-child td {
        border-bottom: 1px solid #dee2e6;
    }
    .student-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
    }

    /* Chart Container */
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }

    /* Card Header */
    .card-header {
        background: white;
        border-bottom: 1px solid #e9ecef;
        padding: 1rem 1.5rem;
    }

    /* Text Colors */
    .text-primary-gradient { background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-wrapper">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Dashboard Guru</h1>
            <p class="text-muted">
                <i class="bi bi-calendar2-week me-2"></i>
                <?php echo e(\Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY')); ?>

            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="#" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exportModal">
                <i class="bi bi-download me-2"></i>Export Data
            </a>
        </div>
    </div>

    <!-- MAIN STATISTICS CARDS - 4 UTAMA -->
    <div class="row g-4 mb-4">
        <!-- TOTAL PENDAFTAR -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small text-white-50 text-uppercase fw-bold">TOTAL PENDAFTAR</div>
                            <div class="h2 mb-0 fw-bold"><?php echo e(number_format($total ?? 0)); ?></div>
                            <small class="text-white-50">
                                <i class="bi bi-arrow-up"></i> Total seluruh pendaftar
                            </small>
                        </div>
                        <div class="ms-3">
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-people-fill fs-2"></i>
                            </div>
                        </div>
                    </div>
                    <i class="bi bi-people stat-icon"></i>
                </div>
            </div>
        </div>

        <!-- SISWA TERDAFTAR (Diterima) -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card bg-gradient-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small text-white-50 text-uppercase fw-bold">SELEKSI ADMINISTRASI</div>
                            <div class="h2 mb-0 fw-bold"><?php echo e(number_format($seleksiAdministrasi ?? 0)); ?></div>
                            <small class="text-white-50">
                                <i class="bi bi-check-circle"></i> Diseleksi
                            </small>
                        </div>
                        <div class="ms-3">
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-person-check-fill fs-2"></i>
                            </div>
                        </div>
                    </div>
                    <i class="bi bi-person-check stat-icon"></i>
                </div>
            </div>
        </div>

        <!-- VERIFIKASI PENDING -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card bg-gradient-warning text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small text-white-50 text-uppercase fw-bold">VERIFIKASI PENDING</div>
                            <div class="h2 mb-0 fw-bold">
                                <?php echo e(number_format(\App\Models\Pendaftaran::where('status', 'pending')->count())); ?>

                            </div>
                            <small class="text-white-50">
                                <i class="bi bi-clock"></i> Menunggu verifikasi
                            </small>
                        </div>
                        <div class="ms-3">
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-clock-history fs-2"></i>
                            </div>
                        </div>
                    </div>
                    <i class="bi bi-hourglass-split stat-icon"></i>
                </div>
            </div>
        </div>

        <!-- DITERIMA -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card bg-gradient-info text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small text-white-50 text-uppercase fw-bold">SISWA DITERIMA</div>
                            <div class="h2 mb-0 fw-bold"><?php echo e(number_format($diterimaAkhir ?? 0)); ?></div>
                            <small class="text-white-50">
                                <i class="bi bi-trophy"></i> Siap daftar ulang
                            </small>
                        </div>
                        <div class="ms-3">
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-trophy-fill fs-2"></i>
                            </div>
                        </div>
                    </div>
                    <i class="bi bi-trophy stat-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- DETAIL STATISTICS CARDS - 6 Card (Semua Terisi) -->
    <div class="row g-4 mb-4">
        <!-- TOTAL JUMLAH -->
        <div class="col-xl-2 col-lg-4">
            <div class="card border-left-card border-left-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="text-uppercase text-primary fw-bold small">Total Jumlah</span>
                            <h3 class="mb-0"><?php echo e(number_format($total ?? 0)); ?></h3>
                            <small class="text-muted">Keseluruhan</small>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-people text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SISWA DITERIMA -->
        <div class="col-xl-2 col-lg-4">
            <div class="card border-left-card border-left-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="text-uppercase text-success fw-bold small">Siswa Diterima</span>
                            <h3 class="mb-0"><?php echo e(number_format($diterimaAkhir ?? 0)); ?></h3>
                            <small class="text-muted">Diterima Akhir</small>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-check-circle text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BELUM DITERIMA -->
        <div class="col-xl-2 col-lg-4">
            <div class="card border-left-card border-left-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="text-uppercase text-warning fw-bold small">Belum Diterima Pending tolak</span>
                            <?php
                                // Query langsung dari database untuk pending dan rejected
                                $pendingCount = \App\Models\Pendaftaran::where('status', 'pending')->count();
                                $rejectedCount = \App\Models\Pendaftaran::whereIn('status', ['ditolak', 'rejected', 'Tidak lulus seleksi administrasi'])->count();
                                $totalPendingRejected = $pendingCount + $rejectedCount;
                            ?>
                            <h3 class="mb-0"><?php echo e(number_format($totalPendingRejected)); ?></h3>
                            <small class="text-muted">Pending + Ditolak</small>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-x-circle text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- LAKI-LAKI -->
        <div class="col-xl-2 col-lg-4">
            <div class="card border-left-card border-left-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="text-uppercase text-info fw-bold small">Laki-laki</span>
                            <h3 class="mb-0"><?php echo e(number_format($lakiCount ?? 0)); ?></h3>
                            <small class="text-muted"><?php echo e($total > 0 ? round(($lakiCount / $total) * 100) : 0); ?>%</small>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-gender-male text-info fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PEREMPUAN -->
        <div class="col-xl-2 col-lg-4">
            <div class="card border-left-card border-left-danger h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="text-uppercase text-danger fw-bold small">Perempuan</span>
                            <h3 class="mb-0"><?php echo e(number_format($perempuanCount ?? 0)); ?></h3>
                            <small class="text-muted"><?php echo e($total > 0 ? round(($perempuanCount / $total) * 100) : 0); ?>%</small>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-gender-female text-danger fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KELAS DIAMPU -->
        <div class="col-xl-2 col-lg-4">
            <div class="card border-left-card border-left-secondary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="text-uppercase text-secondary fw-bold small">Kelas Diampu</span>
                            <h3 class="mb-0"><?php echo e($kelasCount ?? 5); ?></h3>
                            <small class="text-muted">Total kelas</small>
                        </div>
                        <div class="bg-secondary bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-building text-secondary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TIME STATISTICS CARDS - Hari Ini, Bulan Ini, dll -->
    <div class="row g-4 mb-4">
        <!-- HARI INI -->
        <div class="col-xl-3 col-lg-6">
            <div class="card border-0 bg-light h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-primary rounded-circle p-3">
                                <i class="bi bi-calendar-day text-white fs-3"></i>
                            </div>
                        </div>
                        <div>
                            <span class="text-muted text-uppercase small fw-bold">Hari Ini</span>
                            <h2 class="mb-0"><?php echo e(number_format($hariIniCount ?? 0)); ?></h2>
                            <small class="text-muted">Pendaftar baru hari ini</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BULAN INI -->
        <div class="col-xl-3 col-lg-6">
            <div class="card border-0 bg-light h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-success rounded-circle p-3">
                                <i class="bi bi-calendar-month text-white fs-3"></i>
                            </div>
                        </div>
                        <div>
                            <span class="text-muted text-uppercase small fw-bold">Bulan Ini</span>
                            <h2 class="mb-0"><?php echo e(number_format($bulanIniCount ?? 0)); ?></h2>
                            <small class="text-muted"><?php echo e(\Carbon\Carbon::now()->locale('id')->isoFormat('MMMM YYYY')); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MATA PELAJARAN -->
        <div class="col-xl-3 col-lg-6">
            <div class="card border-0 bg-light h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-info rounded-circle p-3">
                                <i class="bi bi-book text-white fs-3"></i>
                            </div>
                        </div>
                        <div>
                            <span class="text-muted text-uppercase small fw-bold">Mata Pelajaran</span>
                            <h2 class="mb-0"><?php echo e($mapelCount ?? 4); ?></h2>
                            <small class="text-muted">Yang diampu</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JADWAL HARI INI -->
        <div class="col-xl-3 col-lg-6">
            <div class="card border-0 bg-light h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-warning rounded-circle p-3">
                                <i class="bi bi-calendar-check text-white fs-3"></i>
                            </div>
                        </div>
                        <div>
                            <span class="text-muted text-uppercase small fw-bold">Jadwal Hari Ini</span>
                            <h2 class="mb-0"><?php echo e($jadwalCount ?? 3); ?></h2>
                            <small class="text-muted">Jadwal mengajar</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Progress Section -->
    <div class="row g-4 mb-4">
        <!-- Grafik Pendaftaran -->
        <div class="col-12">
            <div class="card shadow h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary">Grafik Pendaftaran <?php echo e(date('Y')); ?></h6>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Bulan Ini
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="updateChart('minggu')">Minggu Ini</a></li>
                            <li><a class="dropdown-item" href="#" onclick="updateChart('bulan')">Bulan Ini</a></li>
                            <li><a class="dropdown-item" href="#" onclick="updateChart('tahun')">Tahun Ini</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="pendaftaranChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Export -->
<div class="modal fade" id="exportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Export Data Pendaftar</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Pilih format export:</p>
                <div class="d-grid gap-2">
                    <a href="#" class="btn btn-outline-primary">
                        <i class="bi bi-file-excel me-2"></i>Export ke Excel
                    </a>
                    <a href="#" class="btn btn-outline-primary">
                        <i class="bi bi-file-pdf me-2"></i>Export ke PDF
                    </a>
                    <a href="#" class="btn btn-outline-primary">
                        <i class="bi bi-printer me-2"></i>Cetak
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari database
    const grafikData = {
        tahunan: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            data: <?php echo json_encode($grafikTahunan ?? []); ?>

        },
        mingguan: {
            labels: ['Minggu 4', 'Minggu 3', 'Minggu 2', 'Minggu 1'],
            data: <?php echo json_encode($grafikMingguan ?? []); ?>

        },
        tahun5: {
            labels: ['<?php echo e(date("Y")-4); ?>', '<?php echo e(date("Y")-3); ?>', '<?php echo e(date("Y")-2); ?>', '<?php echo e(date("Y")-1); ?>', '<?php echo e(date("Y")); ?>'],
            data: <?php echo json_encode($grafik5Tahun ?? []); ?>

        }
    };

    // Chart.js
    const ctx = document.getElementById('pendaftaranChart').getContext('2d');
    let pendaftaranChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: grafikData.tahunan.labels,
            datasets: [{
                label: 'Jumlah Pendaftar',
                data: grafikData.tahunan.data,
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Grafik Pendaftaran Tahun <?php echo e(date("Y")); ?>'
                }
            }
        }
    });

    // Fungsi untuk update grafik
    function updateChart(type) {
        let newData;
        let title;
        
        switch(type) {
            case 'minggu':
                newData = grafikData.mingguan;
                title = 'Grafik Pendaftaran 4 Minggu Terakhir';
                break;
            case 'bulan':
                newData = grafikData.tahunan;
                title = 'Grafik Pendaftaran Tahun <?php echo e(date("Y")); ?>';
                break;
            case 'tahun':
                newData = grafikData.tahun5;
                title = 'Grafik Pendaftaran 5 Tahun Terakhir';
                break;
            default:
                newData = grafikData.tahunan;
                title = 'Grafik Pendaftaran Tahun <?php echo e(date("Y")); ?>';
        }
        
        pendaftaranChart.data.labels = newData.labels;
        pendaftaranChart.data.datasets[0].data = newData.data;
        pendaftaranChart.options.plugins.title.text = title;
        pendaftaranChart.update();
        
        // Update button text
        document.querySelector('.dropdown-toggle').textContent = 
            type === 'minggu' ? 'Minggu Ini' : 
            type === 'tahun' ? 'Tahun Ini' : 'Bulan Ini';
    }

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });

    // Status filter
    document.getElementById('statusFilter').addEventListener('change', function() {
        const statusValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            if (statusValue === '') {
                row.style.display = '';
            } else {
                const statusCell = row.querySelector('td:nth-child(8) .status-badge');
                if (statusCell) {
                    const status = statusCell.textContent.toLowerCase().trim();
                    row.style.display = status.includes(statusValue) ? '' : 'none';
                }
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guru.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\PA3\sistem_informasi_psb\sistem_informasi_psb\resources\views/guru/dashboard.blade.php ENDPATH**/ ?>