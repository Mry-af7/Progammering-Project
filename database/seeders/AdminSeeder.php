<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AdminSetting;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Check if admin already exists
        $existingAdmin = User::where('email', 'admin@example.com')->first();
        
        if (!$existingAdmin) {
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
        }

        // Create admin settings if they don't exist
        if (!AdminSetting::where('key', 'site_name')->exists()) {
            AdminSetting::create([
                'key' => 'site_name',
                'value' => 'Career Jump Platform'
            ]);
        }
        
        if (!AdminSetting::where('key', 'maintenance_mode')->exists()) {
            AdminSetting::create([
                'key' => 'maintenance_mode',
                'value' => 'off'
            ]);
        }
    }
} 