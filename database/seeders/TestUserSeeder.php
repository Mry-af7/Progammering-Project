<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create a test student
        User::create([
            'name' => 'Test Student',
            'email' => 'student@test.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // Create a test company
        User::create([
            'name' => 'Test Company',
            'email' => 'company@test.com',
            'password' => Hash::make('password'),
            'role' => 'company',
        ]);

        // Create a test admin
        User::create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
} 