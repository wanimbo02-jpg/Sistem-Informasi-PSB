<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Siswa Pendaftar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 10px 8px 10px 8px; /* margin kiri dan kanan sama */
            overflow-x: auto;
            min-width: 210mm; /* A4 width */
            max-width: 210mm; /* A4 width */
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #333;
            margin: 0;
            font-size: 20px;
        }
        .header p {
            color: #666;
            margin: 5px 0;
        }
        table {
            width: 100%;
            max-width: 185mm; /* Sesuai A4 dengan margin 8mm kiri+kanan */
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: auto;
            font-size: 10px; /* Smaller font for fit */
        }
        th, td {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: left;
            font-size: 9px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        td:nth-child(1), td:nth-child(3), td:nth-child(4), td:nth-child(8) {
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA SISWA LULUS SELEKSI ADMINISTRASI</h1>
        <p>SMA Negeri Karubaga</p>
        <p>Tanggal: {{ date('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NISN</th>
                <th>Jenis Kelamin</th>
                <th>Asal Sekolah</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Status</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendaftarans as $index => $pendaftaran)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pendaftaran->nama_lengkap ?? '-' }}</td>
                <td>{{ $pendaftaran->nisn ?? '-' }}</td>
                <td>{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td>{{ $pendaftaran->asal_sekolah ?? '-' }}</td>
                <td>{{ $pendaftaran->user->email ?? '-' }}</td>
                <td>{{ $pendaftaran->handphone ?? '-' }}</td>
                <td>{{ 
                    $pendaftaran->status == 'pending' ? 'Pending' : 
                    ($pendaftaran->status == 'verifikasi' ? 'Verifikasi' : 
                    ($pendaftaran->status == 'Anda_diterima_seleksi_administrasi' ? 'Lulus Seleksi' : 
                    ($pendaftaran->status == 'Anda_tidak_diterima_seleksi_administrasi' ? 'Ditolak Admin' : 
                    ($pendaftaran->status == 'diterima' ? 'Diterima' : 
                    ($pendaftaran->status == 'ditolak' ? 'Ditolak' : $pendaftaran->status))))) 
                }}</td>
                <td>{{ isset($pendaftaran->created_at) ? $pendaftaran->created_at->format('d/m/Y H:i') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align: center;">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total Data: {{ $pendaftarans->count() }} siswa</p>
        <p>lulus administrasi SMAN Karubaga</p>
    </div>
</body>
</html>
