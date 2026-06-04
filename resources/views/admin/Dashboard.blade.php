{{-- resources/views/admin/dashboard.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
        <!-- <a href="#" class="btn btn-sm btn-primary shadow-sm">
            <i class="bi bi-download"></i> Generate Laporan
        </a> -->
    </div>

    <!-- Content Row - Statistics -->
    <div class="row">
        <!-- Total Pendaftar -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats bg-primary text-white h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                Total Pendaftar
                            </div>
                            <div class="h5 mb-0 font-weight-bold">{{ number_format($totalPendaftar) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Siswa Terdaftar -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats bg-success text-white h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                Siswa Terdaftar
                            </div>
                            <div class="h5 mb-0 font-weight-bold">{{ number_format($siswaTerdaftar) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-person-check fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Verifikasi Pending -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats bg-warning text-white h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                Verifikasi Pending
                            </div>
                            <div class="h5 mb-0 font-weight-bold">{{ number_format($verifikasiPending) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clock-history fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Diterima -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats bg-info text-white h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                Diterima
                            </div>
                            <div class="h5 mb-0 font-weight-bold">{{ number_format($diterima) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-trophy fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row - Charts -->
    <div class="row">
        <!-- Grafik Pendaftar Per Bulan (Dinamis) -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Pendaftaran Siswa Baru</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 400px;">
                        <canvas id="pendaftaranChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Jurusan -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Per Jurusan</h6>
                </div>
                <div class="card-body">
                    <!-- Pie Chart untuk Statistik Jurusan -->
                    <div class="chart-container" style="position: relative; height: 250px; margin-bottom: 20px;">
                        <canvas id="jurusanChart"></canvas>
                    </div>
                    
                    <!-- Progress Bar Detail -->
                    @php
                        $total = max($ipaCount + $ipsCount, 1);
                        $ipaPercent = round(($ipaCount / $total) * 100);
                        $ipsPercent = round(($ipsCount / $total) * 100);
                    @endphp
                    
                    <!-- IPA Classes -->
                    <div class="mb-3">
                        <h6 class="text-primary font-weight-bold mb-2">IPA</h6>
                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <span>X IPA 1</span>
                                <span>{{ number_format($kelasData['X IPA 1'] ?? 0) }} Siswa</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-primary" style="width: {{ min(100, ($kelasData['X IPA 1'] ?? 0) * 10) }}%"></div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <span>XI IPA 2</span>
                                <span>{{ number_format($kelasData['XI IPA 2'] ?? 0) }} Siswa</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-info" style="width: {{ min(100, ($kelasData['XI IPA 2'] ?? 0) * 10) }}%"></div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <span>XII IPA 3</span>
                                <span>{{ number_format($kelasData['XII IPA 3'] ?? 0) }} Siswa</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-secondary" style="width: {{ min(100, ($kelasData['XII IPA 3'] ?? 0) * 10) }}%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- IPS Classes -->
                    <div class="mb-3">
                        <h6 class="text-success font-weight-bold mb-2">IPS</h6>
                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <span>X IPS 1</span>
                                <span>{{ number_format($kelasData['X IPS 1'] ?? 0) }} Siswa</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: {{ min(100, ($kelasData['X IPS 1'] ?? 0) * 10) }}%"></div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <span>XI IPS 2</span>
                                <span>{{ number_format($kelasData['XI IPS 2'] ?? 0) }} Siswa</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-warning" style="width: {{ min(100, ($kelasData['XI IPS 2'] ?? 0) * 10) }}%"></div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <span>XII IPS 3</span>
                                <span>{{ number_format($kelasData['XII IPS 3'] ?? 0) }} Siswa</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-danger" style="width: {{ min(100, ($kelasData['XII IPS 3'] ?? 0) * 10) }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .opacity-50 {
        opacity: 0.5;
    }
    .card-stats {
        transition: all 0.2s;
        border: none;
    }
    .card-stats:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }
    .chart-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .dropdown-item {
        cursor: pointer;
    }
</style>
@endpush

@push('scripts')
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('pendaftaranChart');
    if (!ctx) return;

    // Data grafik pendaftaran siswa per bulan dari database
    const labels = @json($months);
    const data = {
        labels: labels,
        datasets: [{
            label: 'Jumlah Siswa Mendaftar',
            data: @json($monthlyData),
            backgroundColor: 'rgba(54, 162, 235, 0.8)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2,
            borderRadius: 8,
            barPercentage: 0.7
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        font: {
                            size: 14,
                            weight: 'bold'
                        },
                        padding: 20
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleFont: {
                        size: 14
                    },
                    bodyFont: {
                        size: 13
                    },
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            return 'Siswa: ' + context.parsed.y + ' orang';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Siswa',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            size: 12
                        },
                        stepSize: 1
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Bulan',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    };

    new Chart(ctx, config);
    
    // Pie Chart untuk Statistik Jurusan
    const jurusanCtx = document.getElementById('jurusanChart');
    if (jurusanCtx) {
        const jurusanData = {
            labels: ['IPA', 'IPS'],
            datasets: [{
                data: [{{ $ipaCount }}, {{ $ipsCount }}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 2
            }]
        };

        const jurusanConfig = {
            type: 'pie',
            data: jurusanData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            padding: 15
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: {
                            size: 14
                        },
                        bodyFont: {
                            size: 13
                        },
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return label + ': ' + value + ' siswa (' + percentage + '%)';
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true,
                    duration: 1000,
                    easing: 'easeInOutQuart'
                }
            }
        };

        new Chart(jurusanCtx, jurusanConfig);
    }
});
</script>
@endpush