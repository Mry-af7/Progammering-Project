#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Create admin user
$admin = User::updateOrCreate(
    ['email' => 'admin@example.be'],
    [
        'firstname' => 'Admin',
        'lastname' => 'User',
        'password' => Hash::make('admin123'),
        'role' => 'admin',
        'is_active' => true,
        'profile_completed' => true,
        'email_verified_at' => now()
    ]
);

echo "Admin user created/updated successfully!\n";
echo "Email: admin@example.be\n";
echo "Password: admin123\n"; 