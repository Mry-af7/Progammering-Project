<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\Hash;
use App\Models\User;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    echo "Creating admin user...\n";
    
    // Check if admin already exists
    $existingAdmin = User::where('email', 'admin@erasmus.be')->first();
    
    if ($existingAdmin) {
        echo "Admin user already exists. Updating...\n";
        $existingAdmin->update([
            'is_admin' => true,
            'password' => Hash::make('admin123')
        ]);
        echo "Admin user updated successfully!\n";
    } else {
        // Create the admin user
        $admin = User::create([
            'firstname' => 'Admin',
            'lastname' => 'Erasmus',
            'email' => 'admin@erasmus.be',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'is_active' => true,
            'profile_completed' => true,
            'email_verified_at' => now()
        ]);
        
        echo "Admin user created successfully!\n";
    }
    
    echo "Admin login credentials:\n";
    echo "Email: admin@erasmus.be\n";
    echo "Password: admin123\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
} 