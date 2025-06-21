<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
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

        // Create additional admin user for testing
        User::create([
            'firstname' => 'Amine',
            'lastname' => 'Zerouali',
            'email' => 'zerouali.amine2005@gmail.com',
            'password' => Hash::make('Maissae123/'),
            'role' => 'admin',
            'user_type' => 'student',
            'is_active' => true,
            'profile_completed' => true
        ]);

        // Note: AdminSetting will be created later when the admin_settings table exists
        // We'll handle this in a separate seeder or in the main DatabaseSeeder
    }
} 