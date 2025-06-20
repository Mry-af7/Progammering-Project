<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function student_can_register_with_valid_data()
    {
        $studentData = [
            'firstname' => 'Jan',
            'lastname' => 'Teststudent',
            'email' => 'jan.test@student.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $studentData);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();

        // Controleer of de gebruiker correct is aangemaakt in de database
        $user = User::where('email', $studentData['email'])->first();
        $this->assertNotNull($user);
        $this->assertEquals('student', $user->user_type);
        $this->assertEquals('student', $user->role);
        $this->assertEquals($studentData['firstname'], $user->firstname);
        $this->assertEquals($studentData['lastname'], $user->lastname);
        $this->assertTrue(Hash::check($studentData['password'], $user->password));
        $this->assertEquals(0, $user->profile_completed); // SQLite slaat booleans op als 0/1
        $this->assertEquals(1, $user->is_active); // SQLite slaat booleans op als 0/1
    }

    /** @test */
    public function student_registration_requires_firstname()
    {
        $studentData = [
            'lastname' => 'Teststudent',
            'email' => 'jan.test@student.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $studentData);

        $response->assertSessionHasErrors(['firstname']);
        $this->assertGuest();
    }

    /** @test */
    public function student_registration_requires_lastname()
    {
        $studentData = [
            'firstname' => 'Jan',
            'email' => 'jan.test@student.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $studentData);

        $response->assertSessionHasErrors(['lastname']);
        $this->assertGuest();
    }

    /** @test */
    public function student_registration_requires_valid_email()
    {
        $studentData = [
            'firstname' => 'Jan',
            'lastname' => 'Teststudent',
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $studentData);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    /** @test */
    public function student_registration_requires_unique_email()
    {
        // Maak eerst een bestaande gebruiker
        User::create([
            'firstname' => 'Bestaande',
            'lastname' => 'Gebruiker',
            'email' => 'jan.test@student.test',
            'password' => Hash::make('password123'),
            'user_type' => 'student',
            'role' => 'student',
        ]);

        $studentData = [
            'firstname' => 'Jan',
            'lastname' => 'Teststudent',
            'email' => 'jan.test@student.test', // Zelfde email
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $studentData);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    /** @test */
    public function student_registration_requires_password_confirmation()
    {
        $studentData = [
            'firstname' => 'Jan',
            'lastname' => 'Teststudent',
            'email' => 'jan.test@student.test',
            'password' => 'password123',
            'password_confirmation' => 'differentpassword',
        ];

        $response = $this->post('/register', $studentData);

        $response->assertSessionHasErrors(['password']);
        $this->assertGuest();
    }

    /** @test */
    public function student_registration_requires_minimum_password_length()
    {
        $studentData = [
            'firstname' => 'Jan',
            'lastname' => 'Teststudent',
            'email' => 'jan.test@student.test',
            'password' => '123', // Te kort
            'password_confirmation' => '123',
        ];

        $response = $this->post('/register', $studentData);

        $response->assertSessionHasErrors(['password']);
        $this->assertGuest();
    }

    /** @test */
    public function student_registration_form_can_be_accessed()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('auth/Register'));
    }

    /** @test */
    public function authenticated_user_cannot_access_registration_form()
    {
        // Maak een gebruiker aan en log in
        $user = User::create([
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'user_type' => 'student',
            'role' => 'student',
        ]);

        $this->actingAs($user);

        $response = $this->get('/register');

        $response->assertRedirect('/dashboard');
    }

    /** @test */
    public function student_registration_creates_user_with_correct_defaults()
    {
        $studentData = [
            'firstname' => 'Jan',
            'lastname' => 'Teststudent',
            'email' => 'jan.test@student.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $this->post('/register', $studentData);

        $user = User::where('email', $studentData['email'])->first();
        
        // Controleer default waarden
        $this->assertEquals('student', $user->user_type);
        $this->assertEquals('student', $user->role);
        $this->assertEquals(0, $user->profile_completed); // SQLite slaat booleans op als 0/1
        $this->assertEquals(1, $user->is_active); // SQLite slaat booleans op als 0/1
        $this->assertNull($user->email_verified_at);
        $this->assertNull($user->last_login_at);
    }

    /** @test */
    public function student_registration_handles_special_characters_in_names()
    {
        $studentData = [
            'firstname' => 'José',
            'lastname' => 'van der Berg',
            'email' => 'jose.vanderberg@student.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $studentData);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();

        $user = User::where('email', $studentData['email'])->first();
        $this->assertEquals('José', $user->firstname);
        $this->assertEquals('van der Berg', $user->lastname);
    }

    /** @test */
    public function student_registration_handles_long_names()
    {
        $studentData = [
            'firstname' => str_repeat('A', 255), // Maximum lengte
            'lastname' => str_repeat('B', 255), // Maximum lengte
            'email' => 'longname@student.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $studentData);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();

        $user = User::where('email', $studentData['email'])->first();
        $this->assertEquals(str_repeat('A', 255), $user->firstname);
        $this->assertEquals(str_repeat('B', 255), $user->lastname);
    }

    /** @test */
    public function student_registration_handles_lowercase_email()
    {
        $studentData = [
            'firstname' => 'Jan',
            'lastname' => 'Teststudent',
            'email' => 'jan.test@student.test', // Lowercase email
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $studentData);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();

        $user = User::where('email', 'jan.test@student.test')->first();
        $this->assertNotNull($user);
        $this->assertEquals('jan.test@student.test', $user->email);
    }
} 