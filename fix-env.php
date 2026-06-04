<?php

echo "<h1>Memperbaiki File .env</h1>";

// Copy dari .env.example yang bersih
$exampleContent = file_get_contents('.env.example');

// Update dengan konfigurasi database yang benar
$replacements = [
    'DB_CONNECTION=sqlite' => 'DB_CONNECTION=mysql',
    '# DB_HOST=127.0.0.1' => 'DB_HOST=127.0.0.1',
    '# DB_PORT=3306' => 'DB_PORT=3306',
    '# DB_DATABASE=laravel' => 'DB_DATABASE=sistem_informasi_psb',
    '# DB_USERNAME=root' => 'DB_USERNAME=root',
    '# DB_PASSWORD=' => 'DB_PASSWORD=',
    'APP_KEY=' => 'APP_KEY=base64:7r0rnwcg69G/XMG1RAxMdNR9wZDQBy5ebiDxfc7LPOE=',
    'APP_URL=http://localhost' => 'APP_URL=http://127.0.0.1:8000',
    'MAIL_MAILER=log' => 'MAIL_MAILER=smtp',
    'MAIL_HOST=127.0.0.1' => 'MAIL_HOST=smtp.gmail.com',
    'MAIL_PORT=2525' => 'MAIL_PORT=587',
    'MAIL_USERNAME=null' => 'MAIL_USERNAME=your-email@gmail.com',
    'MAIL_PASSWORD=null' => 'MAIL_PASSWORD=your-app-password',
    'MAIL_ENCRYPTION=null' => 'MAIL_ENCRYPTION=tls',
    'MAIL_FROM_ADDRESS="hello@example.com"' => 'MAIL_FROM_ADDRESS=noreply@smanegerikarubaga.sch.id',
    'MAIL_FROM_NAME="${APP_NAME}"' => 'MAIL_FROM_NAME="SMA Negeri Karubaga"',
];

$newContent = $exampleContent;
foreach ($replacements as $old => $new) {
    $newContent = str_replace($old, $new, $newContent);
}

// Tambah baris yang hilang
if (strpos($newContent, 'APP_KEY=base64:') === false) {
    $newContent = str_replace('APP_KEY=', 'APP_KEY=base64:7r0rnwcg69G/XMG1RAxMdNR9wZDQBy5ebiDxfc7LPOE=', $newContent);
}

// Tulis ke .env baru
file_put_contents('.env', $newContent);

echo "<h2>File .env telah diperbaiki!</h2>";
echo "<h3>Langkah selanjutnya:</h3>";
echo "<ol>";
echo "<li>Edit file .env dan ganti 'your-email@gmail.com' dengan email Gmail Anda</li>";
echo "<li>Edit file .env dan ganti 'your-app-password' dengan App Password Gmail</li>";
echo "<li>Enable 2-factor authentication di Gmail</li>";
echo "<li>Buat App Password di Google Account settings</li>";
echo "<li>Jalankan: php artisan config:clear</li>";
echo "</ol>";

echo "<h2>Cara Membuat App Password Gmail:</h2>";
echo "<ol>";
echo "<li>Buka Google Account settings</li>";
echo "<li>Security → 2-Step Verification → App Passwords</li>";
echo "<li>Pilih 'Mail' dan device 'Other'</li>";
echo "<li>Copy 16-digit password</li>";
echo "<li>Gunakan password tersebut di MAIL_PASSWORD</li>";
echo "</ol>";

echo "<p><strong>Untuk testing tanpa email:</strong></p>";
echo "<p>Sistem akan menampilkan kode verifikasi di browser jika email gagal dikirim.</p>";

?>
