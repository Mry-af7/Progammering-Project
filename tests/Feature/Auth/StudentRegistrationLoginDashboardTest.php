<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class StudentRegistrationLoginDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_registration_login_and_dashboard_flow()
    {
        // Test data voor student registratie
        $studentData = [
            'firstname' => 'Jan',
            'lastname' => 'Teststudent',
            'email' => 'jan.test@student.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // Test registratie
        $response = $this->post('/register', $studentData);

        $response->assertRedirect('/profile-onboarding');
        $this->assertAuthenticated();

        // Controleer of de gebruiker correct is aangemaakt
        $user = User::where('email', $studentData['email'])->first();
        $this->assertNotNull($user);
        $this->assertEquals('student', $user->user_type);
        $this->assertEquals('student', $user->role);
        $this->assertEquals($studentData['firstname'], $user->firstname);
        $this->assertEquals($studentData['lastname'], $user->lastname);

        // Test logout
        $this->post('/logout');
        $this->assertGuest();

        // Test login - voor bestaande gebruikers redirect naar dashboard
        $loginResponse = $this->post('/login', [
            'email' => $studentData['email'],
            'password' => $studentData['password'],
        ]);

        $loginResponse->assertRedirect('/dashboard');
        $this->assertAuthenticated();

        // Test dashboard toegang (moet redirecten naar onboarding omdat profile_completed = false)
        $dashboardResponse = $this->get('/dashboard');
        $dashboardResponse->assertRedirect('/profile-onboarding');
    }

    public function test_student_registration_form_can_be_rendered()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_student_login_form_can_be_rendered()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
} 