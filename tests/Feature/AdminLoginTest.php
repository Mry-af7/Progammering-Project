<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_login_with_valid_credentials()
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

        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'Admin123!@#'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_cannot_login_with_invalid_credentials()
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

        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'wrongpassword'
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    public function test_deactivated_admin_cannot_login()
    {
        // Create deactivated admin user
        $admin = User::create([
            'firstname' => 'Admin',
            'lastname' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('Admin123!@#'),
            'role' => 'admin',
            'user_type' => 'student',
            'is_active' => false,
            'profile_completed' => true
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'Admin123!@#'
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    public function test_non_admin_user_cannot_access_admin_dashboard()
    {
        // Create regular user
        $user = User::create([
            'firstname' => 'Regular',
            'lastname' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'user_type' => 'student',
            'is_active' => true,
            'profile_completed' => true
        ]);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_admin_user_can_access_admin_dashboard()
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

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_admin_login_creates_admin_log()
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

        $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'Admin123!@#'
        ]);

        $this->assertDatabaseHas('admin_logs', [
            'admin_id' => $admin->id,
            'action' => 'admin_login'
        ]);
    }

    public function test_admin_logout_creates_admin_log()
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

        $this->actingAs($admin)->post('/logout');

        $this->assertDatabaseHas('admin_logs', [
            'admin_id' => $admin->id,
            'action' => 'admin_logout'
        ]);
    }
} 