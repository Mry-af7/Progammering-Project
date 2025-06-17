<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $companies = [
            [
                'name' => 'Accenture',
                'description' => 'Accenture is een wereldwijd toonaangevend bedrijf in professionele diensten, met leidende capaciteiten in digitale, cloud en beveiliging.',
                'logo_path' => '/images/logos/accenture-logo.svg',
                'website' => 'https://www.accenture.com/be-en',
                'email' => 'info@accenture.com',
                'phone' => '+32 2 645 55 55',
                'address' => 'Boulevard de la Plaine 9',
                'city' => 'Brussel',
                'postal_code' => '1050'
            ],
            [
                'name' => 'Capgemini',
                'description' => 'Capgemini is een wereldwijd leider in consulting, technologie services en digitale transformatie.',
                'logo_path' => '/images/logos/capgemini-logo.svg',
                'website' => 'https://www.capgemini.com/be-nl/',
                'email' => 'info@capgemini.com',
                'phone' => '+32 2 708 11 11',
                'address' => 'Bessenveldstraat 19',
                'city' => 'Diegem',
                'postal_code' => '1831'
            ],
            [
                'name' => 'Delaware',
                'description' => 'Delaware is een toonaangevend bedrijf in IT-consulting en -services, met focus op SAP en Microsoft technologieën.',
                'logo_path' => '/images/logos/delaware-logo.svg',
                'website' => 'https://www.delawareconsulting.com/be-nl/',
                'email' => 'info@delawareconsulting.com',
                'phone' => '+32 2 801 57 57',
                'address' => 'Bessenveldstraat 33',
                'city' => 'Diegem',
                'postal_code' => '1831'
            ],
            [
                'name' => 'Flexso',
                'description' => 'Flexso is een toonaangevend bedrijf in IT-consulting en -services, met focus op SAP en Microsoft technologieën.',
                'logo_path' => '/images/logos/flexo-logo.svg',
                'website' => 'https://www.flexso.be/',
                'email' => 'info@flexso.be',
                'phone' => '+32 2 801 57 57',
                'address' => 'Bessenveldstraat 33',
                'city' => 'Diegem',
                'postal_code' => '1831'
            ],
            [
                'name' => 'BNP Paribas Fortis',
                'description' => 'BNP Paribas Fortis is de grootste bank in België en biedt een breed scala aan financiële diensten aan particulieren en bedrijven.',
                'logo_path' => '/images/logos/bnp-paribas-fortis-logo.svg',
                'website' => 'https://www.bnpparibasfortis.be/',
                'email' => 'info@bnpparibasfortis.be',
                'phone' => '+32 2 565 11 11',
                'address' => 'Warandeberg 3',
                'city' => 'Brussel',
                'postal_code' => '1000'
            ],
            [
                'name' => 'Colruyt Group',
                'description' => 'Colruyt Group is een toonaangevende Belgische retailgroep met activiteiten in retail, foodservice en non-food.',
                'logo_path' => '/images/logos/colruyt-group-logo.svg',
                'website' => 'https://www.colruytgroup.com/',
                'email' => 'info@colruytgroup.com',
                'phone' => '+32 2 363 55 45',
                'address' => 'Edingensesteenweg 196',
                'city' => 'Halle',
                'postal_code' => '1500'
            ],
            [
                'name' => 'Inetum-Realdolmen',
                'description' => 'Inetum is een toonaangevend bedrijf in IT-consulting en -services, met focus op digitale transformatie.',
                'logo_path' => '/images/logos/inetum-realdolmen-logo.svg',
                'website' => 'https://www.inetum-realdolmen.com/',
                'email' => 'info@inetum-realdolmen.com',
                'phone' => '+32 2 801 57 57',
                'address' => 'Bessenveldstraat 33',
                'city' => 'Diegem',
                'postal_code' => '1831'
            ]
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
} 