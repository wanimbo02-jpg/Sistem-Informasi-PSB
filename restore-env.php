<?php

echo "<h1>Memulihkan File .env</h1>";

// Baca file .env.example yang bersih
$content = file_get_contents('.env.example');

// Update dengan konfigurasi yang benar
$content = str_replace('DB_CONNECTION=sqlite', 'DB_CONNECTION=mysql', $content);
$content = str_replace('# DB_HOST=127.0.0.1', 'DB_HOST=127.0.0.1', $content);
$content = str_replace('# DB_PORT=3306', 'DB_PORT=3306', $content);
$content = str_replace('# DB_DATABASE=laravel', 'DB_DATABASE=sistem_informasi_psb', $content);
$content = str_replace('# DB_USERNAME=root', 'DB_USERNAME=root', $content);
$content = str_replace('# DB_PASSWORD=', 'DB_PASSWORD=', $content);
$content = str_replace('APP_KEY=', 'APP_KEY=base64:7r0rnwcg69G/XMG1RAxMdNR9wZDQBy5ebiDxfc7LPOE=', $content);
$content = str_replace('APP_URL=http://localhost', 'APP_URL=http://127.0.0.1:8000', $content);

// Simpan ke .env
file_put_contents('.env', $content);

echo "<h2>✅ File .env telah dipulihkan!</h2>";
echo "<h3>Konfigurasi yang dipulihkan:</h3>";
echo "<ul>";
echo "<li>✅ Database: MySQL (sistem_informasi_psb)</li>";
echo "<li>✅ APP_KEY: Dikembalikan</li>";
echo "<li>✅ APP_URL: http://127.0.0.1:8000</li>";
echo "<li>✅ Email Configuration: Log (default)</li>";
echo "</ul>";

echo "<h3>Langkah selanjutnya:</h3>";
echo "<ol>";
echo "<li>Clear cache: php artisan config:clear</li>";
echo "<li>Start server: php artisan serve</li>";
echo "<li>Project sudah bisa dijalankan normal</li>";
echo "</ol>";

echo "<p><strong>Project akan berjalan seperti semula!</strong></p>";

?>
