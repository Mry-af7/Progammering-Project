<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillsTableSeeder extends Seeder
{
    public function run()
    {
        $skills = [
            'JavaScript',
            'Python', 
            'Java',
            'PHP',
            'C++',
            'C#',
            'HTML/CSS',
            'React',
            'Vue.js',
            'Angular',
            'Laravel',
            'Node.js',
            'Django',
            'MySQL',
            'PostgreSQL',
            'MongoDB',
            'Git',
            'Docker',
            'AWS',
            'Linux',
            'REST APIs',
            'UI/UX Design',
            'Project Management'
        ];

        foreach ($skills as $skill) {
            Skill::firstOrCreate(['name' => $skill]);
        }
    }
}