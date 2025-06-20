<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateTestUser extends Command
{
    protected $signature = 'user:create-test';
    protected $description = 'Create a test user for login';

    public function handle()
    {
        $user = User::create([
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'test@test.com',
            'password' => Hash::make('test123')
        ]);

        $this->info('Test user created successfully!');
        $this->info('Email: test@test.com');
        $this->info('Password: test123');
    }
} 