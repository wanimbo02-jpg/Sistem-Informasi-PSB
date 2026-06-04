<?php

use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

echo "=== SETUP KONFIGURASI EMAIL GMAIL ===\n\n";

// Baca file .env
$envFile = __DIR__ . '/../.env';
$envContent = file_exists($envFile) ? file_get_contents($envFile) : '';

echo "Email yang akan digunakan untuk pengiriman verifikasi:\n";
echo "1. Gmail Address (alamat Gmail lengkap): ";
$gmailAddress = trim(fgets(STDIN));

echo "2. App Password Gmail (16 karakter dari https://myaccount.google.com/apppasswords): ";
$appPassword = trim(fgets(STDIN));

// Update konfigurasi di .env
$lines = explode("\n", $envContent);
$newLines = [];

$configs = [
    'MAIL_MAILER=smtp',
    'MAIL_HOST=smtp.gmail.com',
    'MAIL_PORT=587',
    'MAIL_ENCRYPTION=tls',
    'MAIL_USERNAME=' . $gmailAddress,
    'MAIL_PASSWORD=' . $appPassword,
    'MAIL_FROM_ADDRESS=' . $gmailAddress,
    'MAIL_FROM_NAME="SMA Negeri Karubaga PPDB"'
];

$updated = false;
foreach ($lines as $line) {
    $found = false;
    foreach ($configs as $config) {
        $key = explode('=', $config)[0];
        if (strpos($line, $key . '=') === 0) {
            $newLines[] = $config;
            $found = true;
            $updated = true;
            break;
        }
    }
    if (!$found) {
        $newLines[] = $line;
    }
}

// Tambahkan config yang belum ada
foreach ($configs as $config) {
    $key = explode('=', $config)[0];
    $found = false;
    foreach ($newLines as $line) {
        if (strpos($line, $key . '=') === 0) {
            $found = true;
            break;
        }
    }
    if (!$found) {
        $newLines[] = $config;
    }
}

// Tulis kembali file .env
file_put_contents($envFile, implode("\n", $newLines));

echo "\n✅ Konfigurasi email berhasil diupdate!\n";
echo "📧 Email Pengirim: $gmailAddress\n";
echo "🔐 Password: " . str_repeat('*', strlen($appPassword)) . "\n\n";

// Test konfigurasi
try {
    config(['mail.mailers.smtp.username' => $gmailAddress]);
    config(['mail.mailers.smtp.password' => $appPassword]);
    config(['mail.from.address' => $gmailAddress]);
    
    echo "🔄 Testing konfigurasi email...\n";
    
    // Test kirim email ke alamat yang sama
    
    $testCode = '123456';
    Mail::to($gmailAddress)->send(new VerificationCodeMail($testCode));
    
    echo "✅ Email test berhasil dikirim ke $gmailAddress\n";
    echo "📱 Silakan cek inbox/spam email Anda untuk kode test: 123456\n\n";
    
    echo "🎉 Sistem verifikasi email sudah siap digunakan!\n";
    echo "📝 Setiap siswa yang mendaftar akan otomatis menerima kode verifikasi\n";
    
} catch (Exception $e) {
    echo "❌ Error testing email: " . $e->getMessage() . "\n";
    echo "\n💡 Solusi:\n";
    echo "1. Pastikan 2-Factor Authentication aktif di Gmail\n";
    echo "2. Buat App Password: https://myaccount.google.com/apppasswords\n";
    echo "3. Gunakan App Password 16 karakter (bukan password Gmail biasa)\n";
    echo "4. Pastikan 'Less secure app access' diizinkan jika menggunakan password biasa\n";
}

echo "\n=== SELESAI ===\n";
