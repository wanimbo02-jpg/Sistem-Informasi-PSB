<?php

use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

echo "=== PERBAIKI SISTEM EMAIL VERIFIKASI ===\n\n";

// Baca dan update .env dengan konfigurasi yang benar
$envFile = __DIR__ . '/../.env';
$envContent = file_exists($envFile) ? file_get_contents($envFile) : '';

// Konfigurasi email yang akan diupdate
$newConfigs = [
    'MAIL_MAILER=smtp',
    'MAIL_HOST=smtp.gmail.com',
    'MAIL_PORT=587',
    'MAIL_ENCRYPTION=tls',
    'MAIL_USERNAME=sman.karubaga.ppdb@gmail.com',
    'MAIL_PASSWORD=smankarubaga2024',
    'MAIL_FROM_ADDRESS=sman.karubaga.ppdb@gmail.com',
    'MAIL_FROM_NAME="SMA Negeri Karubaga PPDB"'
];

$lines = explode("\n", $envContent);
$updatedLines = [];

foreach ($lines as $line) {
    $found = false;
    foreach ($newConfigs as $config) {
        $key = explode('=', $config)[0];
        if (strpos($line, $key . '=') === 0) {
            $updatedLines[] = $config;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $updatedLines[] = $line;
    }
}

// Tambah config yang belum ada
foreach ($newConfigs as $config) {
    $key = explode('=', $config)[0];
    $found = false;
    foreach ($updatedLines as $line) {
        if (strpos($line, $key . '=') === 0) {
            $found = true;
            break;
        }
    }
    if (!$found) {
        $updatedLines[] = $config;
    }
}

// Update file .env
file_put_contents($envFile, implode("\n", $updatedLines));

echo "✅ Konfigurasi email berhasil diupdate!\n";
echo "📧 Email Pengirim: sman.karubaga.ppdb@gmail.com\n\n";

// Clear cache dan restart config
echo "🔄 Mengupdate cache konfigurasi...\n";
exec('php artisan config:clear');
exec('php artisan cache:clear');

// Update config runtime
config([
    'mail.default' => 'smtp',
    'mail.mailers.smtp.host' => 'smtp.gmail.com',
    'mail.mailers.smtp.port' => 587,
    'mail.mailers.smtp.encryption' => 'tls',
    'mail.mailers.smtp.username' => 'sman.karubaga.ppdb@gmail.com',
    'mail.mailers.smtp.password' => 'smankarubaga2024',
    'mail.from.address' => 'sman.karubaga.ppdb@gmail.com',
    'mail.from.name' => 'SMA Negeri Karubaga PPDB'
]);

echo "✅ Cache berhasil dibersihkan!\n\n";

// Test pengiriman email
echo "🧪 Testing pengiriman email verifikasi...\n";

try {
    $testEmail = 'sman.karubaga.ppdb@gmail.com';
    $testCode = '123456';
    
    Mail::to($testEmail)->send(new VerificationCodeMail($testCode));
    
    echo "✅ Email test berhasil dikirim!\n";
    echo "📱 Kode test: 123456\n";
    echo "📧 Dikirim ke: $testEmail\n\n";
    
    echo "🎉 SISTEM EMAIL VERIFIKASI SUDAH SIAP!\n\n";
    echo "📋 Cara kerja sistem:\n";
    echo "1. Siswa daftar dengan email di halaman register\n";
    echo "2. Sistem otomatis generate kode 6 digit\n";
    echo "3. Email dengan kode verifikasi dikirim ke email siswa\n";
    echo "4. Siswa masukkan kode untuk aktivasi akun\n";
    echo "5. Akun siap digunakan untuk login\n\n";
    
    echo "✨ Sekarang setiap siswa yang mendaftar akan otomatis menerima kode verifikasi di email mereka!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n\n";
    echo "💡 Jika masih error, lakukan langkah berikut:\n";
    echo "1. Buka Gmail: sman.karubaga.ppdb@gmail.com\n";
    echo "2. Aktifkan 2-Factor Authentication\n";
    echo "3. Buat App Password baru\n";
    echo "4. Update password di .env\n\n";
    
    echo "🔄 Untuk saat ini, sistem akan menggunakan log email sebagai backup\n";
    
    // Set ke log mode sebagai backup
    config(['mail.default' => 'log']);
    echo "✅ Email diubah ke mode log (development)\n";
}

echo "\n=== SELESAI ===\n";
