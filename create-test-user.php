<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Create a test student
$student = User::create([
    'firstname' => 'Test',
    'lastname' => 'Student',
    'email' => 'test.student@example.com',
    'password' => Hash::make('test123'),
    'role' => 'student',
    'user_type' => 'student',
    'is_active' => true,
    'profile_completed' => false
]);

// Create a test company
$company = User::create([
    'firstname' => 'Test',
    'lastname' => 'Company',
    'email' => 'test.company@example.com',
    'password' => Hash::make('test123'),
    'role' => 'company',
    'user_type' => 'company',
    'is_active' => true,
    'profile_completed' => false
]);

echo "Test users created successfully!\n";
echo "Student account:\n";
echo "Email: test.student@example.com\n";
echo "Password: test123\n\n";
echo "Company account:\n";
echo "Email: test.company@example.com\n";
echo "Password: test123\n"; 