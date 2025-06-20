<?php

namespace Database\Factories;

use App\Models\StudyField;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudyFieldFactory extends Factory
{
    protected $model = StudyField::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'code' => strtoupper($this->faker->unique()->lexify('????')),
            'description' => $this->faker->sentence(),
        ];
    }
} 