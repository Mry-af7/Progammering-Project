<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Maryam Affalah's account
        $maryam = User::create([
            'firstname' => 'Maryam',
            'lastname' => 'Affalah',
            'email' => 'maryam.affalah@example.com',
            'password' => Hash::make('password123'),
            'role' => 'student',
            'is_active' => true,
            'profile_completed' => true
        ]);

        // Create her student profile
        StudentProfile::create([
            'user_id' => $maryam->id,
            'study_field_id' => 1, // Toegepaste Informatica
            'bio' => 'Ambitieuze student Toegepaste Informatica met passie voor web development en AI. Op zoek naar uitdagende stage- en werkervaringen om mijn vaardigheden verder te ontwikkelen.',
            'technical_skills' => [
                'PHP', 'Laravel', 'Vue.js', 'JavaScript', 'HTML/CSS',
                'MySQL', 'Git', 'Docker', 'RESTful APIs', 'Agile Methodologies'
            ],
            'soft_skills' => [
                'Teamwork', 'Problem Solving', 'Communication',
                'Time Management', 'Adaptability'
            ],
            'languages' => [
                ['name' => 'Nederlands', 'level' => 'Moedertaal'],
                ['name' => 'Engels', 'level' => 'Vloeiend'],
                ['name' => 'Frans', 'level' => 'Gemiddeld']
            ],
            'linkedin_url' => 'https://www.linkedin.com/in/maryam-affalah',
            'github_url' => 'https://github.com/maryamaffalah',
            'cv_url' => '/storage/cvs/maryam-affalah-cv.pdf',
            'graduation_year' => 2025,
            'current_education_level' => 'Bachelor',
            'preferred_job_types' => ['Stage', 'Vast', 'Freelance'],
            'preferred_work_location' => ['Antwerpen', 'Brussel', 'Gent'],
            'preferred_company_size' => ['Midden', 'Groot'],
            'preferred_industries' => ['IT', 'Fintech', 'E-commerce'],
            'availability_status' => 'Beschikbaar voor stage'
        ]);

        // Student
        User::create([
            'firstname' => 'Test',
            'lastname' => 'Student',
            'email' => 'test.student@example.com',
            'password' => Hash::make('test123'),
            'role' => 'student',
            'is_active' => true,
            'profile_completed' => true
        ]);

        // Voeg Maryam toe als favoriet aan de eerste testgebruiker
        $testUser = User::where('email', 'test.student@example.com')->first();
        if ($testUser && $maryam) {
            \App\Models\Favorite::create([
                'user_id' => $testUser->id,
                'favoritable_id' => $maryam->id,
                'favoritable_type' => User::class,
                'notes' => 'Interessant profiel',
                'tags' => json_encode(['stage', 'webdev'])
            ]);
        }

        // Company
        User::create([
            'firstname' => 'Test',
            'lastname' => 'Company',
            'email' => 'test.company@example.com',
            'password' => Hash::make('test123'),
            'role' => 'company',
            'is_active' => true,
            'profile_completed' => true
        ]);
    }
} 