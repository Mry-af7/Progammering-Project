<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\Hash;
use App\Models\User;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    echo "Cleaning up admin users...\n";
    
    // Delete all existing admin users
    $deletedCount = User::where('role', 'admin')->delete();
    echo "Deleted {$deletedCount} existing admin users.\n";
    
    // Create the single admin user
    $admin = User::create([
        'firstname' => 'Admin',
        'lastname' => 'User',
        'email' => 'admin@example.com',
        'password' => Hash::make('Admin123!@#'),
        'role' => 'admin',
        'user_type' => 'admin',
        'is_active' => true,
        'profile_completed' => true,
        'email_verified_at' => now()
    ]);

    echo "✅ Admin user created successfully!\n";
    echo "📧 Email: admin@example.com\n";
    echo "🔑 Password: Admin123!@#\n";
    echo "🎯 Role: admin\n";
    echo "✅ Email verified: Yes\n";
    echo "✅ Profile completed: Yes\n";
    echo "✅ Account active: Yes\n";
    
    // Verify the admin user was created
    $createdAdmin = User::where('email', 'admin@example.com')->first();
    if ($createdAdmin) {
        echo "\n✅ Verification: Admin user exists in database\n";
        echo "ID: {$createdAdmin->id}\n";
        echo "Name: {$createdAdmin->firstname} {$createdAdmin->lastname}\n";
    } else {
        echo "\n❌ Error: Admin user was not created properly\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
} 