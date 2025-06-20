<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create a test company
        User::create([
            'firstname' => 'Test',
            'lastname' => 'Company',
            'email' => 'company@test.com',
            'password' => Hash::make('password'),
            'role' => 'company',
        ]);

        // Create a test admin
        User::create([
            'firstname' => 'Test',
            'lastname' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
} 