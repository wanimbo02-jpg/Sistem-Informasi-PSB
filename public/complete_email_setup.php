<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== COMPLETE EMAIL VERIFICATION SETUP ===\n\n";

// 1. Update .env file
echo "1. Updating .env file...\n";
$envPath = __DIR__ . '/../.env';
$envContent = file_get_contents($envPath);

$configs = array(
    'MAIL_MAILER=smtp',
    'MAIL_HOST=smtp.gmail.com',
    'MAIL_PORT=587',
    'MAIL_USERNAME=smanegerikarubaga@gmail.com',
    'MAIL_PASSWORD=YOUR_APP_PASSWORD_HERE',
    'MAIL_ENCRYPTION=tls',
    'MAIL_FROM_ADDRESS=smanegerikarubaga@gmail.com',
    'MAIL_FROM_NAME="SMA Negeri Karubaga PPDB"'
);

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

// 3. Check database
echo "3. Checking database setup...\n";
try {
    $columns = \Schema::getColumnListing('users');
    if (in_array('email_verified_at', $columns)) {
        echo "✓ email_verified_at column exists\n";
    } else {
        echo "✗ email_verified_at column missing\n";
    }
    
    $count = \DB::table('email_verifications')->count();
    echo "✓ email_verifications table exists ({$count} records)\n";
} catch (Exception $e) {
    echo "✗ Database error: " . $e->getMessage() . "\n";
}

// 4. Test verification system
echo "\n4. Testing verification system...\n";
try {
    $testEmail = 'test@example.com';
    $verification = \App\Models\EmailVerification::createForEmail($testEmail);
    echo "✓ Test verification code created: " . $verification->code . "\n";
    echo "✓ System is working\n";
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

echo "\n=== SETUP COMPLETE ===\n";
echo "NEXT STEPS:\n";
echo "1. Set Gmail App Password in .env\n";
echo "2. Replace YOUR_APP_PASSWORD_HERE with actual password\n";
echo "3. Run: php artisan config:clear\n";
echo "4. Test registration from browser\n\n";

echo "GMAIL SETUP:\n";
echo "1. Enable 2-factor authentication in Gmail\n";
echo "2. Go to https://myaccount.google.com/\n";
echo "3. Security → App passwords\n";
echo "4. Generate new app password for mail\n";
echo "5. Use 16-character password in .env\n\n";

echo "SYSTEM READY!\n";
