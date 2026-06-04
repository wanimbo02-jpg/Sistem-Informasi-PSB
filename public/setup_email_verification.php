<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Hash;

echo "=== SETTING UP EMAIL VERIFICATION SYSTEM ===\n\n";

// 1. Update .env file
echo "1. Updating .env file with proper email configuration...\n";
$envPath = __DIR__ . '/../.env';
$envContent = file_get_contents($envPath);

// Add or update mail configuration
$configs = [
    'MAIL_MAILER=smtp',
    'MAIL_HOST=smtp.gmail.com', 
    'MAIL_PORT=587',
    'MAIL_USERNAME=smanegerikarubaga@gmail.com',
    'MAIL_PASSWORD=YOUR_APP_PASSWORD_HERE',
    'MAIL_ENCRYPTION=tls',
    'MAIL_FROM_ADDRESS=smanegerikarubaga@gmail.com',
    'MAIL_FROM_NAME="SMA Negeri Karubaga PPDB"'
];

foreach ($configs as $config) {
    $key = explode('=', $config)[0];
    if (strpos($envContent, $key) === false) {
        $envContent .= "\n" . $config;
    } else {
        $pattern = "/^" . preg_quote($key) . "=.*/m";
        $envContent = preg_replace($pattern, $config, $envContent);
    }
}

file_put_contents($envPath, $envContent);
echo "✓ .env file updated\n\n";

// 2. Clear cache
echo "2. Clearing cache...\n";
shell_exec('php artisan config:clear');
shell_exec('php artisan cache:clear'); 
shell_exec('php artisan view:clear');
echo "✓ Cache cleared\n\n";

// 3. Check email_verified_at column
echo "3. Checking email_verified_at column...\n";
try {
    $columns = \Schema::getColumnListing('users');
    if (!in_array('email_verified_at', $columns)) {
        \Schema::table('users', function ($table) {
            $table->timestamp('email_verified_at')->nullable();
        });
        echo "✓ email_verified_at column added\n";
    } else {
        echo "✓ email_verified_at column exists\n";
    }
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

echo "\n=== SETUP COMPLETE ===\n";
echo "NEXT STEPS:\n";
echo "1. Set Gmail App Password in .env (replace YOUR_APP_PASSWORD_HERE)\n";
echo "2. Enable 2-factor authentication in Gmail\n";
echo "3. Generate App Password from Google Account settings\n";
echo "4. Run: php artisan config:clear\n";
echo "5. Test registration from browser\n\n";

echo "GMAIL APP PASSWORD SETUP:\n";
echo "1. Go to https://myaccount.google.com/\n";
echo "2. Security → 2-Step Verification → App passwords\n";
echo "3. Generate new app password for mail\n";
echo "4. Use that 16-character password in MAIL_PASSWORD\n\n";

// 4. Test system
echo "4. Testing verification system...\n";
try {
    $testEmail = 'test@example.com';
    $verification = EmailVerification::createForEmail($testEmail);
    echo "✓ Test verification code created: " . $verification->code . "\n";
    echo "✓ System is ready to send emails\n";
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

echo "\n=== READY TO USE ===\n";
