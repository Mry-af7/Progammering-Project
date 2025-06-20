<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_users_can_visit_the_dashboard()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);
        $this->actingAs($user);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }

    public function test_users_with_incomplete_profile_are_redirected_to_onboarding()
    {
        $user = User::factory()->create([
            'profile_completed' => false,
        ]);
        $this->actingAs($user);

        $response = $this->get('/dashboard');
        $response->assertRedirect('/profile-onboarding');
    }
}
