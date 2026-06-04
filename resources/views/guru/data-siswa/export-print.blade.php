@extends('guru.layouts.app')

@section('title', 'Cetak Data Siswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Cetak Data Siswa Pendaftar</h5>
                    <div>
                        <button onclick="window.print()" class="btn btn-primary">
                            <i class="bi bi-printer me-2"></i>Cetak
                        </button>
                        <a href="{{ route('guru.data-siswa.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <h4>LAPORAN DATA SISWA LULUS SELEKSI ADMINISTRASI</h4>
                        <h5>SMA Negeri Karubaga</h5>
                        <p class="text-muted">Tanggal: {{ date('d/m/Y H:i') }}</p>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Lengkap</th>
                                    <th class="text-center">NISN</th>
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th>Asal Sekolah</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Tanggal Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pendaftarans as $index => $pendaftaran)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $pendaftaran->nama_lengkap ?? '-' }}</td>
                                    <td class="text-center">{{ $pendaftaran->nisn ?? '-' }}</td>
                                    <td class="text-center">{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $pendaftaran->asal_sekolah ?? '-' }}</td>
                                    <td>{{ $pendaftaran->user->email ?? '-' }}</td>
                                    <td>{{ $pendaftaran->handphone ?? '-' }}</td>
                                    <td class="text-center">
                                        @php
                                        $statusClass = 'secondary';
                                        $statusText = $pendaftaran->status;
                                        switch($pendaftaran->status) {
                                            case 'pending': 
                                                $statusClass = 'warning'; 
                                                $statusText = 'Pending'; 
                                                break;
                                            case 'verifikasi': 
                                                $statusClass = 'info'; 
                                                $statusText = 'Verifikasi'; 
                                                break;
                                            case 'Anda_diterima_seleksi_administrasi': 
                                                $statusClass = 'success'; 
                                                $statusText = 'Lulus Seleksi'; 
                                                break;
                                            case 'Anda_tidak_diterima_seleksi_administrasi': 
                                                $statusClass = 'danger'; 
                                                $statusText = 'Ditolak Admin'; 
                                                break;
                                            case 'diterima': 
                                                $statusClass = 'success'; 
                                                $statusText = 'Diterima'; 
                                                break;
                                            case 'ditolak': 
                                                $statusClass = 'danger'; 
                                                $statusText = 'Ditolak'; 
                                                break;
                                        }
                                        @endphp
                                        <span class="badge bg-{{ $statusClass }}">
                                            {{ $statusText }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $pendaftaran->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer -->
                    <div class="text-end mt-4">
                        <p class="text-muted">Total Data: <strong>{{ $pendaftarans->count() }}</strong> siswa</p>
                        <p class="text-muted">lulus administrasi SMAN Karubaga</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
        }
        .table {
            width: 100%;
            max-width: 100%;
            table-layout: auto;
        }
        @media print {
            /* Hide absolutely everything except the card */
            body * {
                display: none !important;
                visibility: hidden !important;
                width: 0 !important;
                height: 0 !important;
                overflow: hidden !important;
            }
            /* Show only the card and its content */
            .card {
                display: block !important;
                visibility: visible !important;
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 100vw !important;
                height: auto !important;
                margin: 0 !important;
                padding: 10px !important;
                border: none !important;
                box-shadow: none !important;
                z-index: 9999 !important;
                background: white !important;
                overflow: visible !important;
            }
            /* Show all card content */
            .card * {
                display: block !important;
                visibility: visible !important;
                width: auto !important;
                height: auto !important;
            }
            /* Hide card header and title */
            .card-header,
            .card-title,
            h4,
            h5,
            h6 {
                display: none !important;
                visibility: hidden !important;
            }
            /* Ensure table elements display correctly */
            .table,
            .table tbody,
            .table tr,
            .table th,
            .table td,
            .table-responsive,
            .card-body,
            p,
            div {
                display: block !important;
                visibility: visible !important;
                width: auto !important;
                height: auto !important;
            }
            .table {
                display: table !important;
                visibility: visible !important;
                font-size: 9px !important;
                width: 100% !important;
                table-layout: auto !important;
                border-collapse: collapse !important;
                margin: 0 !important;
            }
            .table thead {
                display: table-header-group !important;
                visibility: visible !important;
            }
            .table tbody {
                display: table-row-group !important;
                visibility: visible !important;
            }
            .table tr {
                display: table-row !important;
                visibility: visible !important;
            }
            .table th {
                display: table-cell !important;
                visibility: visible !important;
                padding: 5px 8px !important;
                font-size: 10px !important;
                font-weight: bold !important;
                text-align: center !important;
                background-color: #e9ecef !important;
                color: #000 !important;
                border: 1px solid #000 !important;
                white-space: nowrap !important;
                vertical-align: middle !important;
            }
            .table td {
                display: table-cell !important;
                visibility: visible !important;
                padding: 5px 8px !important;
                font-size: 9px !important;
                text-align: left !important;
                color: #000 !important;
                border: 1px solid #000 !important;
                white-space: nowrap !important;
                vertical-align: middle !important;
            }
            .table-responsive {
                overflow-x: visible !important;
                width: 100% !important;
            }
            /* Show table properly */
            .table-responsive {
                display: block !important;
                visibility: visible !important;
                width: 100% !important;
            }
            .table {
                display: table !important;
                visibility: visible !important;
                width: 100% !important;
            }
            .table th, .table td {
                display: table-cell !important;
                visibility: visible !important;
            }
            /* Remove sidebar space and make content full width */
            .content-wrapper {
                margin-left: 0 !important;
                padding-left: 0 !important;
            }
            .container-fluid {
                padding: 0 !important;
                width: 100% !important;
            }
            .row {
                margin: 0 !important;
                width: 100% !important;
            }
            .col-md-9,
            .col-lg-9,
            .col-xl-9,
            .container-fluid > .row > .col-md-9,
            .container-fluid > .row > .col-lg-9,
            .container-fluid > .row > .col-xl-9 {
                width: 100% !important;
                max-width: 100% !important;
                flex: 0 0 100% !important;
                margin-left: 0 !important;
                padding-left: 0 !important;
            }
            /* Make sure content is visible */
            .card {
                display: block !important;
                visibility: visible !important;
                border: none !important;
                box-shadow: none !important;
                margin: 0 !important;
                width: 100% !important;
            }
            .card-body {
                display: block !important;
                visibility: visible !important;
                padding: 10px !important;
            }
            .table-responsive {
                display: block !important;
                visibility: visible !important;
                overflow: visible !important;
                width: 100% !important;
            }
            .table {
                display: table !important;
                visibility: visible !important;
                width: 100% !important;
            }
            .table th, .table td {
                display: table-cell !important;
                visibility: visible !important;
            }
            /* Card styling */
            .card {
                display: block !important;
                border: none !important;
                box-shadow: none !important;
                margin: 0 !important;
                width: 100% !important;
            }
            .card-body {
                padding: 10px !important;
            }
            /* Table styling */
            .table-responsive {
                overflow: visible !important;
                width: 100% !important;
            }
            .table {
                width: 100% !important;
                font-size: 10px !important;
            }
            .table th, .table td {
                padding: 6px !important;
                font-size: 10px !important;
                white-space: nowrap !important;
            }
            /* Page setup */
            body {
                font-size: 10px !important;
                margin: 5mm !important;
                background: white !important;
            }
            @page {
                size: A4 landscape;
                margin: 5mm;
            }
        }
            /* Card styling */
            .card {
                display: block !important;
                border: none !important;
                box-shadow: none !important;
                margin: 0 !important;
                width: 100% !important;
            }
            .card-body {
                padding: 10px !important;
            }
            /* Table styling */
            .table-responsive {
                overflow: visible !important;
                width: 100% !important;
            }
            .table {
                width: 100% !important;
                font-size: 10px !important;
            }
            .table th, .table td {
                padding: 6px !important;
                font-size: 10px !important;
                white-space: nowrap !important;
            }
            /* Page setup */
            body {
                font-size: 10px !important;
                margin: 5mm !important;
                background: white !important;
            }
            @page {
                size: A4 landscape;
                margin: 5mm;
            }
        }
            .card {
                border: none !important;
                box-shadow: none !important;
                display: block !important;
                margin: 0 !important;
            }
            .table-responsive {
                overflow: visible !important;
                max-width: 100% !important;
                width: 100% !important;
            }
            .table {
                width: 100% !important;
                max-width: 100% !important;
                table-layout: auto !important;
                font-size: 10px !important;
            }
            .table th, .table td {
                padding: 6px !important;
                font-size: 10px !important;
                white-space: nowrap !important;
            }
            body {
                font-size: 10px !important;
                overflow-x: visible;
                margin: 5mm !important;
                padding: 0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                background: white !important;
            }
            .container-fluid {
                padding: 0 !important;
            }
            .row {
                margin: 0 !important;
            }
            .card {
                width: 100% !important;
                max-width: 100% !important;
            }
            .text-muted {
                color: #666 !important;
            }
            @page {
                size: A4 landscape !important;
                margin: 5mm !important;
            }
        }
        </style>
@endsection
