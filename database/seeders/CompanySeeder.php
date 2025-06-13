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
                'telefoon' => '+32 2 645 55 55',
                'email' => 'info@accenture.com'
            ],
            [
                'name' => 'Capgemini',
                'logo_path' => '/images/logos/capgemini-logo.svg',
                'specialisatie' => 'IT Consulting & Services',
                'beschrijving' => 'Capgemini is een wereldwijd leider in consulting, technologie services en digitale transformatie.',
                'adres' => 'Boulevard de la Woluwe 100, 1200 Brussel',
                'telefoon' => '+32 2 708 11 11',
                'email' => 'info@capgemini.com'
            ],
            [
                'name' => 'Delaware',
                'logo_path' => '/images/logos/delaware-logo.svg',
                'specialisatie' => 'IT Consulting & Services',
                'beschrijving' => 'Delaware is een toonaangevend IT-consultancybedrijf dat bedrijven helpt bij hun digitale transformatie.',
                'adres' => 'Boulevard de la Woluwe 100, 1200 Brussel',
                'telefoon' => '+32 2 801 51 51',
                'email' => 'info@delaware.pro'
            ],
            [
                'name' => 'Flexso',
                'logo_path' => '/images/logos/flexo-logo.svg',
                'specialisatie' => 'IT Consulting & Services',
                'beschrijving' => 'Flexso is een toonaangevend IT-consultancybedrijf dat zich richt op SAP-oplossingen.',
                'adres' => 'Boulevard de la Woluwe 100, 1200 Brussel',
                'telefoon' => '+32 2 801 51 51',
                'email' => 'info@flexso.be'
            ],
            [
                'name' => 'BNP Paribas',
                'logo_path' => '/images/logos/bnp-paribas-fortis-logo.svg',
                'specialisatie' => 'Banking & Finance',
                'beschrijving' => 'BNP Paribas Fortis is een toonaangevende bank in België die een breed scala aan financiële diensten aanbiedt.',
                'adres' => 'Montagne du Parc 3, 1000 Brussel',
                'telefoon' => '+32 2 565 11 11',
                'email' => 'info@bnpparibasfortis.be'
            ],
            [
                'name' => 'Colruyt Group',
                'logo_path' => '/images/logos/colruyt-group-logo.svg',
                'specialisatie' => 'Retail & Distribution',
                'beschrijving' => 'Colruyt Group is een toonaangevende Belgische retailgroep met focus op duurzaamheid en innovatie.',
                'adres' => 'Edingensesteenweg 196, 1500 Halle',
                'telefoon' => '+32 2 363 55 45',
                'email' => 'info@colruytgroup.com'
            ],
            [
                'name' => 'Inetum',
                'logo_path' => '/images/logos/inetum-realdolmen-logo.svg',
                'specialisatie' => 'IT Consulting & Services',
                'beschrijving' => 'Inetum is een toonaangevend IT-consultancybedrijf dat bedrijven helpt bij hun digitale transformatie.',
                'adres' => 'Boulevard de la Woluwe 100, 1200 Brussel',
                'telefoon' => '+32 2 801 51 51',
                'email' => 'info@inetum.com'
            ]
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
} 