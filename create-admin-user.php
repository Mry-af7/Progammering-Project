<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\AdminSetting;
use Illuminate\Support\Facades\Hash;

echo "Creating admin user...\n";

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

// Create admin settings
try {
    AdminSetting::create([
        'key' => 'site_name',
        'value' => 'Career Jump Platform'
    ]);
    
    AdminSetting::create([
        'key' => 'maintenance_mode',
        'value' => 'off'
    ]);
    
    echo "Admin settings created successfully!\n";
} catch (Exception $e) {
    echo "Warning: Could not create admin settings: " . $e->getMessage() . "\n";
}

echo "\nYou can now login at: /login\n";
echo "Admin dashboard: /admin/dashboard\n"; 