<?php

// File untuk setup konfigurasi email
// Jalankan file ini dari browser: http://localhost/sistem_informasi_psb/setup-email.php

echo "<h1>Setup Konfigurasi Email</h1>";

// Baca file .env
$envFile = '.env';
$envContent = file_get_contents($envFile);

// Ganti konfigurasi email
$replacements = [
    'MAIL_MAILER=log' => 'MAIL_MAILER=smtp',
    'MAIL_HOST=127.0.0.1' => 'MAIL_HOST=smtp.gmail.com',
    'MAIL_PORT=2525' => 'MAIL_PORT=587',
    'MAIL_USERNAME=null' => 'MAIL_USERNAME=your-email@gmail.com',
    'MAIL_PASSWORD=null' => 'MAIL_PASSWORD=your-app-password',
    'MAIL_FROM_ADDRESS="hello@example.com"' => 'MAIL_FROM_ADDRESS=noreply@smanegerikarubaga.sch.id',
    'MAIL_FROM_NAME="${APP_NAME}"' => 'MAIL_FROM_NAME="SMA Negeri Karubaga"',
];

$newContent = $envContent;
foreach ($replacements as $old => $new) {
    $newContent = str_replace($old, $new, $newContent);
}

// Tambahkan encryption jika belum ada
if (strpos($newContent, 'MAIL_ENCRYPTION=') === false) {
    $newContent .= "\nMAIL_ENCRYPTION=tls\n";
}

// Tulis kembali file .env
file_put_contents($envFile, $newContent);

echo "<h2>Konfigurasi email telah diperbarui!</h2>";
echo "<h3>Langkah selanjutnya:</h3>";
echo "<ol>";
echo "<li>Ganti 'your-email@gmail.com' dengan email Gmail Anda</li>";
echo "<li>Ganti 'your-app-password' dengan App Password Gmail</li>";
echo "<li>Enable 2-factor authentication di Gmail</li>";
echo "<li>Buat App Password di Google Account settings</li>";
echo "<li>Clear cache: php artisan config:clear</li>";
echo "</ol>";

echo "<h2>Cara Membuat App Password Gmail:</h2>";
echo "<ol>";
echo "<li>Buka Google Account settings</li>";
echo "<li>Security → 2-Step Verification → App Passwords</li>";
echo "<li>Pilih 'Mail' dan device 'Other'</li>";
echo "<li>Copy 16-digit password</li>";
echo "<li>Gunakan password tersebut di MAIL_PASSWORD</li>";
echo "</ol>";

echo "<p><strong>Setelah setup, jalankan:</strong></p>";
echo "<code>php artisan config:clear</code><br>";
echo "<code>php artisan cache:clear</code>";

?>
