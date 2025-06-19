<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\CompanyProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        return [
            'company_id' => CompanyProfile::factory(),
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraphs(3, true),
            'requirements' => $this->faker->paragraphs(2, true),
            'responsibilities' => $this->faker->paragraphs(2, true),
            'location' => $this->faker->city(),
            'type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract', 'Internship']),
            'experience_level' => $this->faker->randomElement(['Entry', 'Mid', 'Senior', 'Lead']),
            'salary_min' => $this->faker->numberBetween(30000, 50000),
            'salary_max' => $this->faker->numberBetween(60000, 120000),
            'benefits' => $this->faker->words(5),
            'skills_required' => $this->faker->words(6),
            'education_required' => $this->faker->randomElement(['High School', 'Bachelor', 'Master', 'PhD']),
            'status' => $this->faker->randomElement(['Open', 'Closed', 'Draft']),
            'application_deadline' => $this->faker->dateTimeBetween('now', '+2 months'),
            'is_remote' => $this->faker->boolean(30),
            'is_featured' => $this->faker->boolean(20),
        ];
    }
} 