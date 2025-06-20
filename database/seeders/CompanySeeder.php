<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $companies = [
            [
                'name' => 'Microsoft Belgium',
                'description' => 'Tech giant met focus op cloud computing, AI en enterprise solutions.',
                'website' => 'https://www.microsoft.com/nl-be',
                'email' => 'info@microsoft.be',
                'logo_path' => '/images/logos/microsoft-logo.svg',
                'is_active' => true,
                'participating_in_career_launch' => true,
                'tags' => json_encode(['Cloud', 'AI', 'Enterprise'])
            ],
            [
                'name' => 'Accenture',
                'description' => 'Global consultancy diensten in technologie en digitale transformatie.',
                'website' => 'https://www.accenture.com/be-en',
                'email' => 'info@accenture.be',
                'logo_path' => '/images/logos/accenture-logo.svg',
                'is_active' => true,
                'participating_in_career_launch' => true,
                'tags' => json_encode(['Consulting', 'Digital', 'Innovation'])
            ],
            [
                'name' => 'Deloitte Digital',
                'description' => 'Digitale innovatie en consultancy voor enterprise klanten.',
                'website' => 'https://www2.deloitte.com/be/en.html',
                'email' => 'info@deloitte.be',
                'logo_path' => '/images/logos/deloitte-logo.svg',
                'is_active' => true,
                'participating_in_career_launch' => true,
                'tags' => json_encode(['Digital', 'Strategy', 'Tech'])
            ],
            [
                'name' => 'Proximus',
                'description' => 'Telecom leader met focus op 5G, IoT en digitale services.',
                'website' => 'https://www.proximus.be',
                'email' => 'info@proximus.be',
                'logo_path' => '/images/logos/proximus-logo.svg',
                'is_active' => true,
                'participating_in_career_launch' => true,
                'tags' => json_encode(['Telecom', '5G', 'IoT'])
            ],
            [
                'name' => 'Colruyt Group IT',
                'description' => 'Retail technologie en e-commerce innovaties.',
                'website' => 'https://jobs.colruytgroup.com',
                'email' => 'jobs@colruytgroup.com',
                'logo_path' => '/images/logos/colruyt-group-logo.svg',
                'is_active' => true,
                'participating_in_career_launch' => true,
                'tags' => json_encode(['Retail', 'E-commerce', 'Innovation'])
            ]
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
} 