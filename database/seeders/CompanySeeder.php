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
                'logo_path' => '/images/logos/accenture-logo.svg',
                'website' => 'https://www.accenture.com/be-en',
                'specialisatie' => 'IT Consulting & Services',
                'beschrijving' => 'Accenture is een wereldwijd toonaangevend bedrijf in professionele diensten, met leidende capaciteiten in digitale, cloud en beveiliging.',
                'adres' => 'Boulevard de la Plaine 9, 1050 Brussel',
                'telefoon' => '+32 2 645 00 00',
                'email' => 'info@accenture.com',
                'is_active' => true
            ],
            [
                'name' => 'Capgemini',
                'logo_path' => '/images/logos/capgemini-logo.svg',
                'website' => 'https://www.capgemini.com/be-nl/',
                'specialisatie' => 'IT Consulting & Services',
                'beschrijving' => 'Capgemini is een wereldwijd leider in consulting, technologie services en digitale transformatie.',
                'adres' => 'Bessenveldstraat 19, 1831 Diegem',
                'telefoon' => '+32 2 708 11 11',
                'email' => 'info@capgemini.com',
                'is_active' => true
            ],
            [
                'name' => 'Delaware',
                'logo_path' => '/images/logos/delaware-logo.svg',
                'website' => 'https://www.delawareconsulting.com/be-nl/',
                'specialisatie' => 'IT Consulting & Services',
                'beschrijving' => 'Delaware is een toonaangevend bedrijf in IT-consulting en -services, met focus op SAP en Microsoft technologieën.',
                'adres' => 'Bessenveldstraat 33, 1831 Diegem',
                'telefoon' => '+32 2 801 57 57',
                'email' => 'info@delawareconsulting.com',
                'is_active' => true
            ],
            [
                'name' => 'Flexso',
                'logo_path' => '/images/logos/flexo-logo.svg',
                'website' => 'https://www.flexso.be/',
                'specialisatie' => 'IT Consulting & Services',
                'beschrijving' => 'Flexso is een toonaangevend bedrijf in IT-consulting en -services, met focus op SAP en Microsoft technologieën.',
                'adres' => 'Bessenveldstraat 33, 1831 Diegem',
                'telefoon' => '+32 2 801 57 57',
                'email' => 'info@flexso.be',
                'is_active' => true
            ],
            [
                'name' => 'BNP Paribas',
                'logo_path' => '/images/logos/bnp-paribas-fortis-logo.svg',
                'website' => 'https://www.bnpparibasfortis.be/',
                'specialisatie' => 'Banking & Finance',
                'beschrijving' => 'BNP Paribas Fortis is de grootste bank in België en biedt een breed scala aan financiële diensten aan particulieren en bedrijven.',
                'adres' => 'Warandeberg 3, 1000 Brussel',
                'telefoon' => '+32 2 565 11 11',
                'email' => 'info@bnpparibasfortis.be',
                'is_active' => true
            ],
            [
                'name' => 'Colruyt Group',
                'logo_path' => '/images/logos/colruyt-group-logo.svg',
                'website' => 'https://www.colruytgroup.com/',
                'specialisatie' => 'Retail & Distribution',
                'beschrijving' => 'Colruyt Group is een toonaangevende Belgische retailgroep met activiteiten in retail, foodservice en non-food.',
                'adres' => 'Edingensesteenweg 196, 1500 Halle',
                'telefoon' => '+32 2 363 55 45',
                'email' => 'info@colruytgroup.com',
                'is_active' => true
            ],
            [
                'name' => 'Inetum',
                'logo_path' => '/images/logos/inetum-realdolmen-logo.svg',
                'website' => 'https://www.inetum-realdolmen.com/',
                'specialisatie' => 'IT Consulting & Services',
                'beschrijving' => 'Inetum is een toonaangevend bedrijf in IT-consulting en -services, met focus op digitale transformatie.',
                'adres' => 'Bessenveldstraat 33, 1831 Diegem',
                'telefoon' => '+32 2 801 57 57',
                'email' => 'info@inetum-realdolmen.com',
                'is_active' => true
            ]
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
} 