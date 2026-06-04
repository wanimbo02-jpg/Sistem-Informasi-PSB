@extends('orangtua.layouts.app')

@section('title', 'Dashboard Orang Tua')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Orang Tua/Wali</h1>
        <a href="#" class="btn btn-sm btn-warning shadow-sm">
            <i class="bi bi-telephone"></i> Hubungi Sekolah
        </a>
    </div>

    <!-- Welcome Message -->
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-info-circle"></i> Selamat datang, Bapak/Ibu. Pantau terus perkembangan pendaftaran putra/putri Anda.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <!-- Data Anak -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h5 class="mb-3">Data Anak yang Mendaftar</h5>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card child-card border-left-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                            <span class="fs-4">A</span>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">Ahmad Fauzi</h5>
                            <p class="text-muted mb-1">No. Pendaftaran: PPDB-2024-001</p>
                            <span class="badge bg-warning text-dark">Proses Verifikasi</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-6">
                            <small class="text-muted">Jurusan</small>
                            <p class="mb-0 fw-bold">IPA</p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Status</small>
                            <p class="mb-0 fw-bold text-warning">Pending</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card child-card border-left-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                            <span class="fs-4">S</span>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">Siti Nurhaliza</h5>
                            <p class="text-muted mb-1">No. Pendaftaran: PPDB-2024-002</p>
                            <span class="badge bg-success">Diterima</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-6">
                            <small class="text-muted">Jurusan</small>
                            <p class="mb-0 fw-bold">IPS</p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Status</small>
                            <p class="mb-0 fw-bold text-success">Lulus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Anak Mendaftar
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fs-2 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Diterima
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check-circle fs-2 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Dalam Proses
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-hourglass fs-2 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jadwal Ujian
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">20 Jan</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar fs-2 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Penting -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Jadwal Penting</h6>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Ujian Masuk</h6>
                                <small class="text-primary">20 Jan 2024</small>
                            </div>
                            <small class="text-muted">09:00 - 12:00 WIB</small>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Pengumuman Hasil</h6>
                                <small class="text-primary">25 Jan 2024</small>
                            </div>
                            <small class="text-muted">Diumumkan secara online</small>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Daftar Ulang</h6>
                                <small class="text-primary">27-31 Jan 2024</small>
                            </div>
                            <small class="text-muted">Bagi yang diterima</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Informasi dari Sekolah</h6>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Persiapan Ujian Masuk</h6>
                                <small>3 hari lalu</small>
                            </div>
                            <small class="text-muted">Informasi materi ujian dan tata tertib...</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Pengumpulan Berkas</h6>
                                <small>5 hari lalu</small>
                            </div>
                            <small class="text-muted">Batas akhir pengumpulan berkas...</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline Pendaftaran -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-warning">Timeline Pendaftaran Anak</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center mb-3">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 50px; height: 50px;">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <h6>Daftar</h6>
                    <small class="text-muted">1 Jan 2024</small>
                </div>
                <div class="col-md-3 text-center mb-3">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 50px; height: 50px;">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <h6>Verifikasi</h6>
                    <small class="text-muted">5 Jan 2024</small>
                </div>
                <div class="col-md-3 text-center mb-3">
                    <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 50px; height: 50px;">
                        <i class="bi bi-hourglass"></i>
                    </div>
                    <h6>Ujian</h6>
                    <small class="text-muted">20 Jan 2024</small>
                </div>
                <div class="col-md-3 text-center mb-3">
                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 50px; height: 50px;">
                        <i class="bi bi-question-lg"></i>
                    </div>
                    <h6>Pengumuman</h6>
                    <small class="text-muted">25 Jan 2024</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Kontak Sekolah -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-warning">Kontak Sekolah</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-geo-alt fs-4 text-warning me-3"></i>
                        <div>
                            <h6 class="mb-0">Alamat</h6>
                            <small class="text-muted">Jl. Pendidikan No. 1, Karubaga</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-telephone fs-4 text-warning me-3"></i>
                        <div>
                            <h6 class="mb-0">Telepon</h6>
                            <small class="text-muted">(0123) 456789</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-envelope fs-4 text-warning me-3"></i>
                        <div>
                            <h6 class="mb-0">Email</h6>
                            <small class="text-muted">ppdb@smakarubaga.sch.id</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
