<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ComprehensiveStudentRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_student_registration_flow()
    {
        // Test data voor een succesvolle registratie
        $studentData = [
            'firstname' => 'Anna',
            'lastname' => 'Jansen',
            'email' => 'anna.jansen@student.test',
            'password' => 'SecurePassword123!',
            'password_confirmation' => 'SecurePassword123!',
        ];

        // Test registratie
        $response = $this->post('/register', $studentData);

        // Controleer response
        $response->assertRedirect('/profile-onboarding');
        $response->assertSessionHasNoErrors();
        $this->assertAuthenticated();

        // Controleer database opslag
        $user = User::where('email', $studentData['email'])->first();
        $this->assertNotNull($user);
        $this->assertEquals('student', $user->user_type);
        $this->assertEquals('student', $user->role);
        $this->assertEquals($studentData['firstname'], $user->firstname);
        $this->assertEquals($studentData['lastname'], $user->lastname);
        $this->assertTrue(Hash::check($studentData['password'], $user->password));
        $this->assertEquals(0, $user->profile_completed);
        $this->assertEquals(1, $user->is_active);
        $this->assertNull($user->email_verified_at);
        $this->assertNull($user->last_login_at);

        // Controleer dat er geen andere gebruikers zijn aangemaakt
        $this->assertEquals(1, User::count());
    }

    public function test_student_registration_with_dutch_names()
    {
        $studentData = [
            'firstname' => 'Pieter-Jan',
            'lastname' => 'van der Berg',
            'email' => 'pieter.van.der.berg@student.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $studentData);

        $response->assertRedirect('/profile-onboarding');
        $this->assertAuthenticated();

        $user = User::where('email', $studentData['email'])->first();
        $this->assertEquals('Pieter-Jan', $user->firstname);
        $this->assertEquals('van der Berg', $user->lastname);
    }

    public function test_student_registration_with_international_names()
    {
        $studentData = [
            'firstname' => 'José María',
            'lastname' => 'García-López',
            'email' => 'jose.garcia@student.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $studentData);

        $response->assertRedirect('/profile-onboarding');
        $this->assertAuthenticated();

        $user = User::where('email', $studentData['email'])->first();
        $this->assertEquals('José María', $user->firstname);
        $this->assertEquals('García-López', $user->lastname);
    }

    public function test_student_registration_validation_errors()
    {
        // Test zonder voornaam
        $response = $this->post('/register', [
            'lastname' => 'Test',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['firstname']);

        // Test zonder achternaam
        $response = $this->post('/register', [
            'firstname' => 'Test',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['lastname']);

        // Test zonder email
        $response = $this->post('/register', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['email']);

        // Test zonder wachtwoord
        $response = $this->post('/register', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'test@example.com',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['password']);

        // Test zonder wachtwoord bevestiging
        $response = $this->post('/register', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);
        $response->assertSessionHasErrors(['password']);

        // Controleer dat er geen gebruikers zijn aangemaakt
        $this->assertEquals(0, User::count());
    }

    public function test_student_registration_email_validation()
    {
        // Test ongeldig email formaat
        $response = $this->post('/register', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['email']);

        // Test email zonder @
        $response = $this->post('/register', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'testexample.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['email']);

        // Test email zonder domein
        $response = $this->post('/register', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'test@',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['email']);

        // Test lege email
        $response = $this->post('/register', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => '',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['email']);
    }

    public function test_student_registration_password_validation()
    {
        // Test te kort wachtwoord
        $response = $this->post('/register', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'test@example.com',
            'password' => '123',
            'password_confirmation' => '123',
        ]);
        $response->assertSessionHasErrors(['password']);

        // Test wachtwoord zonder bevestiging
        $response = $this->post('/register', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'differentpassword',
        ]);
        $response->assertSessionHasErrors(['password']);

        // Test leeg wachtwoord
        $response = $this->post('/register', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'test@example.com',
            'password' => '',
            'password_confirmation' => '',
        ]);
        $response->assertSessionHasErrors(['password']);
    }

    public function test_student_registration_duplicate_email()
    {
        // Maak eerst een bestaande gebruiker
        User::create([
            'firstname' => 'Bestaande',
            'lastname' => 'Gebruiker',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'user_type' => 'student',
            'role' => 'student',
        ]);

        // Probeer te registreren met hetzelfde email
        $response = $this->post('/register', [
            'firstname' => 'Nieuwe',
            'lastname' => 'Gebruiker',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();

        // Controleer dat er nog steeds maar 1 gebruiker is
        $this->assertEquals(1, User::count());
    }

    public function test_student_registration_case_insensitive_email()
    {
        // Maak eerst een gebruiker met lowercase email
        User::create([
            'firstname' => 'Bestaande',
            'lastname' => 'Gebruiker',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'user_type' => 'student',
            'role' => 'student',
        ]);

        // Probeer te registreren met uppercase email
        $response = $this->post('/register', [
            'firstname' => 'Nieuwe',
            'lastname' => 'Gebruiker',
            'email' => 'TEST@EXAMPLE.COM',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    public function test_student_registration_form_accessibility()
    {
        // Test dat gasten het registratie formulier kunnen bekijken
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('auth/Register'));

        // Test dat ingelogde gebruikers worden doorgestuurd
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/register');
        $response->assertRedirect('/dashboard');
    }

    public function test_student_registration_database_integrity()
    {
        $studentData = [
            'firstname' => 'Database',
            'lastname' => 'Test',
            'email' => 'database.test@student.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $this->post('/register', $studentData);

        // Controleer database integriteit
        $user = User::where('email', $studentData['email'])->first();
        
        // Controleer alle velden
        $this->assertNotNull($user->id);
        $this->assertEquals($studentData['firstname'], $user->firstname);
        $this->assertEquals($studentData['lastname'], $user->lastname);
        $this->assertEquals($studentData['email'], $user->email);
        $this->assertEquals('student', $user->user_type);
        $this->assertEquals('student', $user->role);
        $this->assertEquals(0, $user->profile_completed);
        $this->assertEquals(1, $user->is_active);
        $this->assertNull($user->email_verified_at);
        $this->assertNull($user->last_login_at);
        $this->assertNotNull($user->created_at);
        $this->assertNotNull($user->updated_at);

        // Controleer dat wachtwoord correct is gehashed
        $this->assertTrue(Hash::check($studentData['password'], $user->password));
        $this->assertNotEquals($studentData['password'], $user->password);
    }

    public function test_student_registration_multiple_users()
    {
        $users = [
            [
                'firstname' => 'User1',
                'lastname' => 'Test1',
                'email' => 'user1@test.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ],
            [
                'firstname' => 'User2',
                'lastname' => 'Test2',
                'email' => 'user2@test.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ],
            [
                'firstname' => 'User3',
                'lastname' => 'Test3',
                'email' => 'user3@test.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ],
        ];

        foreach ($users as $userData) {
            $response = $this->post('/register', $userData);
            $response->assertRedirect('/profile-onboarding');
            $this->assertAuthenticated();
            
            // Log uit voor volgende test
            $this->post('/logout');
            $this->assertGuest();
        }

        // Controleer dat alle gebruikers zijn aangemaakt
        $this->assertEquals(3, User::count());
    }

    public function test_student_registration_edge_cases()
    {
        // Test met minimale geldige gegevens
        $response = $this->post('/register', [
            'firstname' => 'A',
            'lastname' => 'B',
            'email' => 'a@b.c',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertRedirect('/profile-onboarding');
        $this->assertAuthenticated();

        // Log uit voor volgende test
        $this->post('/logout');
        $this->assertGuest();

        // Test met zeer lange namen (255 karakters)
        $longName = str_repeat('A', 255);
        $response = $this->post('/register', [
            'firstname' => $longName,
            'lastname' => $longName,
            'email' => 'longname@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertRedirect('/profile-onboarding');
        $this->assertAuthenticated();

        // Log uit voor volgende test
        $this->post('/logout');
        $this->assertGuest();

        // Test met speciale karakters in email
        $response = $this->post('/register', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'test+tag@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertRedirect('/profile-onboarding');
        $this->assertAuthenticated();
    }

    public function test_student_registration_session_handling()
    {
        $studentData = [
            'firstname' => 'Session',
            'lastname' => 'Test',
            'email' => 'session.test@student.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $studentData);

        // Controleer dat gebruiker is ingelogd
        $this->assertAuthenticated();
        
        // Controleer dat sessie correct is ingesteld
        $this->assertNotNull(auth()->user());
        $this->assertEquals($studentData['email'], auth()->user()->email);

        // Test dat gebruiker dashboard kan bezoeken
        $dashboardResponse = $this->get('/dashboard');
        $dashboardResponse->assertStatus(302); // Redirect naar onboarding omdat profile_completed = 0
    }

    public function test_student_registration_csrf_protection()
    {
        // Test zonder CSRF token (moet falen)
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        
        $studentData = [
            'firstname' => 'CSRF',
            'lastname' => 'Test',
            'email' => 'csrf.test@student.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $studentData);
        
        // Zonder CSRF middleware zou dit moeten werken
        $response->assertRedirect('/profile-onboarding');
        $this->assertAuthenticated();
    }
} 