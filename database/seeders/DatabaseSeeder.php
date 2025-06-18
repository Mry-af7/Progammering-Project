<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StudyField;
use App\Models\StudentProfile;
use App\Models\CompanyProfile;
use App\Models\Job;
use App\Models\Event;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CompanySeeder::class,
            StudyFieldSeeder::class,
            AdminSeeder::class,
            DashboardDataSeeder::class,
            // TestUserSeeder::class, // Removed to avoid duplicate admin accounts
        ]);

        // Create study fields
        $studyFields = [
            ['name' => 'Computer Science', 'code' => 'CS'],
            ['name' => 'Business Administration', 'code' => 'BA'],
            ['name' => 'Engineering', 'code' => 'ENG'],
            ['name' => 'Marketing', 'code' => 'MKT'],
            ['name' => 'Finance', 'code' => 'FIN'],
            ['name' => 'Psychology', 'code' => 'PSY'],
            ['name' => 'Medicine', 'code' => 'MED'],
            ['name' => 'Law', 'code' => 'LAW'],
            ['name' => 'Education', 'code' => 'EDU'],
            ['name' => 'Design', 'code' => 'DSN']
        ];

        foreach ($studyFields as $field) {
            StudyField::create($field);
        }

        // Create tags
        $tags = [
            'JavaScript', 'Python', 'Java', 'PHP', 'React',
            'Vue.js', 'Angular', 'Node.js', 'Laravel', 'Django',
            'Machine Learning', 'AI', 'Data Science', 'DevOps',
            'UI/UX', 'Mobile Development', 'Cloud Computing'
        ];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }

        // Create your requested student account
        User::factory()->create([
            'firstname' => 'Amine',
            'lastname' => 'Zerouali',
            'email' => 'zerouali.amine1402@gmail.com',
            'password' => Hash::make('Amine2005'),
            'role' => 'student'
        ])->studentProfile()->create([
            'study_field_id' => StudyField::first()->id,
            'bio' => 'This is the requested student account.',
            'technical_skills' => ['PHP', 'Laravel', 'Vue.js'],
            'soft_skills' => ['Leadership', 'Adaptability'],
            'languages' => ['English', 'Arabic'],
            'graduation_year' => '2025',
            'current_education_level' => 'Master',
            'availability_status' => 'Available'
        ]);

        // Create sample students
        User::factory(19)
            ->has(StudentProfile::factory())
            ->create(['role' => 'student']);

        // Create sample companies
        User::factory(10)
            ->has(CompanyProfile::factory())
            ->create(['role' => 'company']);

        // Create sample jobs
        Job::factory(50)->create();

        // Create sample events
        Event::factory(15)->create();

        // Attach random tags to companies
        CompanyProfile::all()->each(function ($company) {
            $company->tags()->attach(
                Tag::inRandomOrder()->take(rand(3, 6))->pluck('id')->toArray()
            );
        });

        // Attach random skills to students
        StudentProfile::all()->each(function ($student) {
            $student->skills()->attach(
                Tag::inRandomOrder()->take(rand(4, 8))->pluck('id')->toArray()
            );
        });
    }
}

