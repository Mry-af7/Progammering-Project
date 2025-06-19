<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InitialUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'firstname' => 'Admin',
            'lastname' => 'User',
            'email' => 'admin@erasmus.be',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'is_active' => true,
            'profile_completed' => true,
            'email_verified_at' => now()
        ]);

        // Create test student
        User::create([
            'firstname' => 'Test',
            'lastname' => 'Student',
            'email' => 'test.student@erasmus.be',
            'password' => Hash::make('test123'),
            'role' => 'student',
            'is_active' => true,
            'profile_completed' => true,
            'email_verified_at' => now()
        ]);

        // Create test company
        User::create([
            'firstname' => 'Test',
            'lastname' => 'Company',
            'email' => 'test.company@erasmus.be',
            'password' => Hash::make('test123'),
            'role' => 'company',
            'is_active' => true,
            'profile_completed' => true,
            'email_verified_at' => now()
        ]);
    }
} 