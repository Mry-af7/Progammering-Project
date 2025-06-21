<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Check if admin users exist
echo "Checking for admin users...\n";
$adminUsers = User::where('role', 'admin')->get();

if ($adminUsers->count() > 0) {
    echo "Found " . $adminUsers->count() . " admin user(s):\n";
    foreach ($adminUsers as $admin) {
        echo "- ID: " . $admin->id . ", Email: " . $admin->email . ", Role: " . $admin->role . "\n";
    }
} else {
    echo "No admin users found. Creating one...\n";
    
    // Create admin user
    $admin = User::create([
        'firstname' => 'Admin',
        'lastname' => 'User',
        'email' => 'admin@example.com',
        'password' => Hash::make('Admin123!@#'),
        'role' => 'admin',
        'user_type' => 'student',
        'is_active' => true,
        'profile_completed' => true
    ]);
    
    echo "Admin user created successfully!\n";
    echo "Email: admin@example.com\n";
    echo "Password: Admin123!@#\n";
}

// Test authentication
echo "\nTesting authentication...\n";
$testEmail = 'admin@example.com';
$testPassword = 'Admin123!@#';

$user = User::where('email', $testEmail)->first();
if ($user && Hash::check($testPassword, $user->password)) {
    echo "Authentication successful!\n";
    echo "User role: " . $user->role . "\n";
    echo "User is admin: " . ($user->isAdmin() ? 'Yes' : 'No') . "\n";
} else {
    echo "Authentication failed!\n";
}

echo "\nTest completed.\n"; 