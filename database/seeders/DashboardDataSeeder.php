<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CareerGoal;
use App\Models\Skill;
use App\Models\RecommendedSkill;
use App\Models\NetworkingConnection;
use App\Models\DashboardEvent;

class DashboardDataSeeder extends Seeder
{
    public function run()
    {
        // Create recommended skills
        $recommendedSkills = [
            ['name' => 'React.js', 'demand' => 89, 'category' => 'Frontend'],
            ['name' => 'Node.js', 'demand' => 76, 'category' => 'Backend'],
            ['name' => 'Python', 'demand' => 83, 'category' => 'Backend'],
            ['name' => 'SQL', 'demand' => 71, 'category' => 'Database'],
            ['name' => 'AWS', 'demand' => 85, 'category' => 'Cloud'],
            ['name' => 'Docker', 'demand' => 78, 'category' => 'DevOps']
        ];

        foreach ($recommendedSkills as $skill) {
            RecommendedSkill::create($skill);
        }

        // Create data for each user
        User::all()->each(function ($user) {
            if ($user->role === 'student') {
                // Create career goals
                $goals = [
                    [
                        'title' => 'Land First Developer Job',
                        'description' => 'Secure a junior developer position by July 2025',
                        'progress' => 65,
                        'target_date' => '2025-07-01'
                    ],
                    [
                        'title' => 'Build Professional Network',
                        'description' => 'Connect with 100+ industry professionals',
                        'progress' => 45,
                        'target_date' => '2025-06-01'
                    ],
                    [
                        'title' => 'Complete Portfolio',
                        'description' => 'Showcase 5 professional projects',
                        'progress' => 80,
                        'target_date' => '2025-05-01'
                    ]
                ];

                foreach ($goals as $goal) {
                    CareerGoal::create([
                        'user_id' => $user->id,
                        ...$goal
                    ]);
                }

                // Create skills
                $skills = [
                    ['name' => 'JavaScript', 'level' => 75, 'category' => 'Frontend'],
                    ['name' => 'HTML/CSS', 'level' => 85, 'category' => 'Frontend'],
                    ['name' => 'Java', 'level' => 60, 'category' => 'Backend'],
                    ['name' => 'Microsoft Office', 'level' => 90, 'category' => 'Tools'],
                    ['name' => 'French', 'level' => 100, 'category' => 'Language'],
                    ['name' => 'Dutch', 'level' => 85, 'category' => 'Language']
                ];

                foreach ($skills as $skill) {
                    Skill::create([
                        'user_id' => $user->id,
                        ...$skill
                    ]);
                }

                // Create networking connections
                $connections = [
                    [
                        'name' => 'Sarah De Vos',
                        'position' => 'Senior Developer at Capgemini',
                        'company' => 'Capgemini',
                        'avatar' => '/images/avatar-1.jpg',
                        'mutual_connections' => 3
                    ],
                    [
                        'name' => 'Thomas Janssens',
                        'position' => 'HR Manager at Accenture',
                        'company' => 'Accenture',
                        'avatar' => '/images/avatar-2.jpg',
                        'mutual_connections' => 1
                    ],
                    [
                        'name' => 'Marie Dupont',
                        'position' => 'Tech Lead at delaware',
                        'company' => 'delaware',
                        'avatar' => '/images/avatar-3.jpg',
                        'mutual_connections' => 2
                    ]
                ];

                foreach ($connections as $connection) {
                    NetworkingConnection::create([
                        'user_id' => $user->id,
                        ...$connection
                    ]);
                }

                // Create dashboard events
                $events = [
                    [
                        'title' => 'Tech Career Fair',
                        'event_date' => now(),
                        'location' => 'Erasmushogeschool Brussels',
                        'icon' => '📊',
                        'is_today' => true
                    ],
                    [
                        'title' => 'Mock Interview Session',
                        'event_date' => now()->addDay(),
                        'location' => 'Online',
                        'icon' => '💼',
                        'is_today' => false
                    ],
                    [
                        'title' => 'Networking Workshop',
                        'event_date' => now()->addDays(3),
                        'location' => 'Brussels',
                        'icon' => '🤝',
                        'is_today' => false
                    ]
                ];

                foreach ($events as $event) {
                    DashboardEvent::create([
                        'user_id' => $user->id,
                        ...$event
                    ]);
                }
            }
        });
    }
} 