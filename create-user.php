<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

$user = User::create([
    'firstname' => 'Test',
    'lastname' => 'User',
    'email' => 'test@test.com',
    'password' => password_hash('test123', PASSWORD_BCRYPT),
    'role' => 'student',
    'user_type' => 'student',
    'is_active' => true,
    'profile_completed' => false
]);

echo "User created successfully!\n";
echo "Email: test@test.com\n";
echo "Password: test123\n"; 