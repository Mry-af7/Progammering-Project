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
        $admin = User::create([
            'firstname' => 'Admin',
            'lastname' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('Admin123!@#'),
            'role' => 'admin',
            'user_type' => 'admin',
            'is_active' => true,
            'profile_completed' => true
        ]);

        AdminSetting::create([
            'key' => 'site_name',
            'value' => 'Career Jump Platform'
        ]);
        AdminSetting::create([
            'key' => 'maintenance_mode',
            'value' => 'off'
        ]);
    }
} 