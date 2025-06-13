<?php

namespace Database\Factories;

use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyProfileFactory extends Factory
{
    protected $model = CompanyProfile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'company_name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'website' => $this->faker->url(),
            'industry' => $this->faker->randomElement(['Technology', 'Healthcare', 'Finance', 'Education', 'Manufacturing']),
            'company_size' => $this->faker->randomElement(['1-10', '11-50', '51-200', '201-500', '501+']),
            'founded_year' => $this->faker->year(),
            'headquarters' => $this->faker->city(),
            'logo' => $this->faker->imageUrl(),
            'banner_image' => $this->faker->imageUrl(),
            'company_type' => $this->faker->randomElement(['Startup', 'Enterprise', 'Agency', 'Non-profit']),
            'specializations' => $this->faker->words(4),
            'benefits' => $this->faker->words(5),
            'company_culture' => $this->faker->paragraph(),
            'contact_email' => $this->faker->companyEmail(),
            'contact_phone' => $this->faker->phoneNumber(),
            'social_media' => [
                'linkedin' => $this->faker->url(),
                'twitter' => $this->faker->url(),
                'facebook' => $this->faker->url(),
            ],
            'is_verified' => $this->faker->boolean(80),
        ];
    }
} 