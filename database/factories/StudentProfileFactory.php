<?php

namespace Database\Factories;

use App\Models\StudentProfile;
use App\Models\User;
use App\Models\StudyField;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentProfileFactory extends Factory
{
    protected $model = StudentProfile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'study_field_id' => StudyField::factory(),
            'bio' => $this->faker->paragraph(),
            'technical_skills' => $this->faker->words(5),
            'soft_skills' => $this->faker->words(4),
            'languages' => $this->faker->words(3),
            'portfolio_url' => $this->faker->url(),
            'linkedin_url' => $this->faker->url(),
            'github_url' => $this->faker->url(),
            'cv_url' => $this->faker->url(),
            'profile_image' => $this->faker->imageUrl(),
            'graduation_year' => $this->faker->year(),
            'current_education_level' => $this->faker->randomElement(['Bachelor', 'Master', 'PhD']),
            'preferred_job_types' => $this->faker->words(3),
            'preferred_work_location' => $this->faker->words(2),
            'preferred_company_size' => $this->faker->words(2),
            'preferred_industries' => $this->faker->words(4),
            'availability_status' => $this->faker->randomElement(['Available', 'Not Available', 'Open to Opportunities']),
        ];
    }
} 