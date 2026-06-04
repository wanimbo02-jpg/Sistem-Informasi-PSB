<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== TEST DASHBOARD SETELAH PERBAIKAN ===\n\n";

// Query yang sama dengan DashboardController
$total = \App\Models\Pendaftaran::count();
$pending = \App\Models\Pendaftaran::where('status', 'pending')->count();
$verifikasi = \App\Models\Pendaftaran::where('status', 'verifikasi')->count();
$accepted = \App\Models\Pendaftaran::whereIn('status', ['diterima', 'accepted', 'Anda_diterima_seleksi_administrasi'])->count();
$rejected = \App\Models\Pendaftaran::whereIn('status', ['ditolak', 'rejected', 'Anda_tidak_diterima_seleksi_administrasi'])->count();

echo "Dashboard akan menampilkan:\n";
echo "- Total: $total\n";
echo "- Pending: $pending\n";
echo "- Verifikasi: $verifikasi\n";
echo "- Accepted: $accepted (sudah termasuk Anda_diterima_seleksi_administrasi)\n";
echo "- Rejected: $rejected (sudah termasuk Anda_tidak_diterima_seleksi_administrasi)\n";

echo "\n=== BREAKDOWN ACCEPTED ===\n";
$diterima = \App\Models\Pendaftaran::where('status', 'diterima')->count();
$accepted2 = \App\Models\Pendaftaran::where('status', 'accepted')->count();
$seleksiAdmin = \App\Models\Pendaftaran::where('status', 'Anda_diterima_seleksi_administrasi')->count();

echo "- diterima: $diterima\n";
echo "- accepted: $accepted2\n";
echo "- Anda_diterima_seleksi_administrasi: $seleksiAdmin\n";
echo "- Total accepted: $diterima + $accepted2 + $seleksiAdmin = $accepted\n";

echo "\n=== VERIFIKASI DATA ===\n";
$pendaftarans = \App\Models\Pendaftaran::whereIn('status', ['diterima', 'accepted', 'Anda_diterima_seleksi_administrasi'])->get(['id', 'nama_lengkap', 'status']);
foreach ($pendaftarans as $p) {
    echo "ID: {$p->id}, Nama: {$p->nama_lengkap}, Status: {$p->status}\n";
}
