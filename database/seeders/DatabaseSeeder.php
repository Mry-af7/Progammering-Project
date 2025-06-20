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
use App\Models\Favorite;
use Carbon\Carbon;

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
            TestUserSeeder::class,
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

        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'firstname' => 'Admin',
            'lastname' => 'User',
            'email' => 'admin@erasmus.be',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'age' => 30,
            'gender' => 'anders',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create test bedrijf users
        $bedrijven = [
            [
                'name' => 'Microsoft Belgium',
                'firstname' => 'Jan',
                'lastname' => 'Janssen',
                'email' => 'jan@microsoft.be',
                'company_name' => 'Microsoft Belgium',
                'age' => 35,
                'gender' => 'man',
            ],
            [
                'name' => 'Proximus',
                'firstname' => 'Marie',
                'lastname' => 'Dubois',
                'email' => 'marie@proximus.be',
                'company_name' => 'Proximus',
                'age' => 28,
                'gender' => 'vrouw',
            ],
            [
                'name' => 'Deloitte Belgium',
                'firstname' => 'Peter',
                'lastname' => 'Van Der Berg',
                'email' => 'peter@deloitte.be',
                'company_name' => 'Deloitte Belgium',
                'age' => 42,
                'gender' => 'man',
            ],
            [
                'name' => 'KBC Bank',
                'firstname' => 'Sophie',
                'lastname' => 'Martens',
                'email' => 'sophie@kbc.be',
                'company_name' => 'KBC Bank',
                'age' => 38,
                'gender' => 'vrouw',
            ],
            [
                'name' => 'Accenture Belgium',
                'firstname' => 'David',
                'lastname' => 'Williams',
                'email' => 'david@accenture.be',
                'company_name' => 'Accenture Belgium',
                'age' => 33,
                'gender' => 'man',
            ],
            [
                'name' => 'BNP Paribas Fortis',
                'firstname' => 'Emma',
                'lastname' => 'Van Hoof',
                'email' => 'emma@bnpparibasfortis.be',
                'company_name' => 'BNP Paribas Fortis',
                'age' => 31,
                'gender' => 'vrouw',
            ],
            [
                'name' => 'Colruyt Group',
                'firstname' => 'Thomas',
                'lastname' => 'Mertens',
                'email' => 'thomas@colruyt.be',
                'company_name' => 'Colruyt Group',
                'age' => 36,
                'gender' => 'man',
            ],
            [
                'name' => 'Telenet',
                'firstname' => 'Laura',
                'lastname' => 'Claes',
                'email' => 'laura@telenet.be',
                'company_name' => 'Telenet',
                'age' => 29,
                'gender' => 'vrouw',
            ]
        ];

        $bedrijfUsers = [];
        foreach ($bedrijven as $bedrijf) {
            $bedrijfUsers[] = User::create([
                'name' => $bedrijf['name'],
                'firstname' => $bedrijf['firstname'],
                'lastname' => $bedrijf['lastname'],
                'email' => $bedrijf['email'],
                'password' => Hash::make('password123'),
                'role' => 'bedrijf',
                'company_name' => $bedrijf['company_name'],
                'age' => $bedrijf['age'],
                'gender' => $bedrijf['gender'],
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
        }

        // Create test student users
        $students = [
            [
                'firstname' => 'Tom',
                'lastname' => 'Hermans',
                'email' => 'tom.hermans@student.ehb.be',
                'field_of_study' => 'Toegepaste Informatica',
                'age' => 20,
                'gender' => 'man',
            ],
            [
                'firstname' => 'Lisa',
                'lastname' => 'Peeters',
                'email' => 'lisa.peeters@student.ehb.be',
                'field_of_study' => 'Grafische en Digitale Media',
                'age' => 19,
                'gender' => 'vrouw',
            ],
            [
                'firstname' => 'Kevin',
                'lastname' => 'De Smet',
                'email' => 'kevin.desmet@student.ehb.be',
                'field_of_study' => 'Business Management',
                'age' => 21,
                'gender' => 'man',
            ],
            [
                'firstname' => 'Sarah',
                'lastname' => 'Willems',
                'email' => 'sarah.willems@student.ehb.be',
                'field_of_study' => 'Marketing',
                'age' => 20,
                'gender' => 'vrouw',
            ],
            [
                'firstname' => 'Mohamed',
                'lastname' => 'El Amrani',
                'email' => 'mohamed.elamrani@student.ehb.be',
                'field_of_study' => 'Toegepaste Informatica',
                'age' => 22,
                'gender' => 'man',
            ],
            [
                'firstname' => 'Emma',
                'lastname' => 'Van Hoof',
                'email' => 'emma.vanhoof@student.ehb.be',
                'field_of_study' => 'Communicatiewetenschappen',
                'age' => 19,
                'gender' => 'vrouw',
            ],
            [
                'firstname' => 'Lucas',
                'lastname' => 'Janssen',
                'email' => 'lucas.janssen@student.ehb.be',
                'field_of_study' => 'Verpleegkunde',
                'age' => 21,
                'gender' => 'man',
            ],
            [
                'firstname' => 'Noor',
                'lastname' => 'Bakker',
                'email' => 'noor.bakker@student.ehb.be',
                'field_of_study' => 'Ergotherapie',
                'age' => 20,
                'gender' => 'vrouw',
            ],
            [
                'firstname' => 'Maxim',
                'lastname' => 'Vandenberghe',
                'email' => 'maxim.vandenberghe@student.ehb.be',
                'field_of_study' => 'Toegepaste Informatica',
                'age' => 23,
                'gender' => 'man',
            ],
            [
                'firstname' => 'Yasmin',
                'lastname' => 'Hassan',
                'email' => 'yasmin.hassan@student.ehb.be',
                'field_of_study' => 'Business Management',
                'age' => 19,
                'gender' => 'vrouw',
            ],
            [
                'firstname' => 'Bram',
                'lastname' => 'Verstraete',
                'email' => 'bram.verstraete@student.ehb.be',
                'field_of_study' => 'Grafische en Digitale Media',
                'age' => 22,
                'gender' => 'man',
            ],
            [
                'firstname' => 'Ines',
                'lastname' => 'Rodriguez',
                'email' => 'ines.rodriguez@student.ehb.be',
                'field_of_study' => 'Marketing',
                'age' => 20,
                'gender' => 'vrouw',
            ],
            [
                'firstname' => 'Jens',
                'lastname' => 'Maes',
                'email' => 'jens.maes@student.ehb.be',
                'field_of_study' => 'Communicatiewetenschappen',
                'age' => 21,
                'gender' => 'man',
            ],
            [
                'firstname' => 'Fatima',
                'lastname' => 'Benali',
                'email' => 'fatima.benali@student.ehb.be',
                'field_of_study' => 'Verpleegkunde',
                'age' => 22,
                'gender' => 'vrouw',
            ],
            [
                'firstname' => 'Robin',
                'lastname' => 'De Vries',
                'email' => 'robin.devries@student.ehb.be',
                'field_of_study' => 'Bedrijfskunde',
                'age' => 20,
                'gender' => 'man',
            ]
        ];

        $studentUsers = [];
        foreach ($students as $student) {
            $studentUsers[] = User::create([
                'name' => $student['firstname'] . ' ' . $student['lastname'],
                'firstname' => $student['firstname'],
                'lastname' => $student['lastname'],
                'email' => $student['email'],
                'password' => Hash::make('password123'),
                'role' => 'student',
                'field_of_study' => $student['field_of_study'],
                'age' => $student['age'],
                'gender' => $student['gender'],
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
        }

        // Create some favorites - bedrijven favorieten studenten
        foreach ($bedrijfUsers as $bedrijf) {
            // Elke bedrijf favorieteert 3-5 random studenten
            $randomStudents = collect($studentUsers)->random(rand(3, 5));
            
            foreach ($randomStudents as $student) {
                Favorite::create([
                    'user_id' => $bedrijf->id,
                    'favoritable_type' => User::class,
                    'favoritable_id' => $student->id,
                    'created_at' => Carbon::now()->subDays(rand(1, 30)),
                    'updated_at' => Carbon::now()->subDays(rand(1, 30)),
                ]);
            }
        }

        // En studenten favorieteren bedrijven
        foreach ($studentUsers as $student) {
            // Elke student favorieteert 1-3 random bedrijven
            $randomBedrijven = collect($bedrijfUsers)->random(rand(1, 3));
            
            foreach ($randomBedrijven as $bedrijf) {
                Favorite::create([
                    'user_id' => $student->id,
                    'favoritable_type' => User::class,
                    'favoritable_id' => $bedrijf->id,
                    'created_at' => Carbon::now()->subDays(rand(1, 20)),
                    'updated_at' => Carbon::now()->subDays(rand(1, 20)),
                ]);
            }
        }

        // Create some inactive users for testing
        User::create([
            'name' => 'Inactive Student',
            'firstname' => 'Inactive',
            'lastname' => 'Student',
            'email' => 'inactive@student.ehb.be',
            'password' => Hash::make('password123'),
            'role' => 'student',
            'field_of_study' => 'Test Studies',
            'age' => 21,
            'gender' => 'anders',
            'is_active' => false,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Inactive Company',
            'firstname' => 'Test',
            'lastname' => 'Company',
            'email' => 'inactive@company.be',
            'password' => Hash::make('password123'),
            'role' => 'bedrijf',
            'company_name' => 'Inactive Test Company',
            'age' => 35,
            'gender' => 'man',
            'is_active' => false,
            'email_verified_at' => now(),
        ]);

        $this->command->info('Database seeded successfully!');
        $this->command->info('');
        $this->command->info('=== LOGIN CREDENTIALS ===');
        $this->command->info('Admin: admin@erasmus.be / password123');
        $this->command->info('Bedrijf: jan@microsoft.be / password123');
        $this->command->info('Student: tom.hermans@student.ehb.be / password123');
        $this->command->info('');
        $this->command->info('=== STATISTICS ===');
        $this->command->info('Total Users: ' . User::count());
        $this->command->info('Students: ' . User::where('role', 'student')->count());
        $this->command->info('Bedrijven: ' . User::where('role', 'bedrijf')->count());
        $this->command->info('Favorites: ' . Favorite::count());
        $this->command->info('Active Users: ' . User::where('is_active', true)->count());

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

