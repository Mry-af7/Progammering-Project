<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    public function run(): void
    {
        $industries = [
            ['name' => 'Technology', 'slug' => 'technology'],
            ['name' => 'Finance & Banking', 'slug' => 'finance-banking'],
            ['name' => 'Healthcare & Medical', 'slug' => 'healthcare-medical'],
            ['name' => 'Education', 'slug' => 'education'],
            ['name' => 'E-commerce & Retail', 'slug' => 'ecommerce-retail'],
            ['name' => 'Marketing & Advertising', 'slug' => 'marketing-advertising'],
            ['name' => 'Consulting', 'slug' => 'consulting'],
            ['name' => 'Manufacturing', 'slug' => 'manufacturing'],
            ['name' => 'Real Estate', 'slug' => 'real-estate'],
            ['name' => 'Telecommunications', 'slug' => 'telecommunications'],
            ['name' => 'Media & Entertainment', 'slug' => 'media-entertainment'],
            ['name' => 'Transportation & Logistics', 'slug' => 'transportation-logistics'],
            ['name' => 'Energy & Utilities', 'slug' => 'energy-utilities'],
            ['name' => 'Food & Beverage', 'slug' => 'food-beverage'],
            ['name' => 'Travel & Tourism', 'slug' => 'travel-tourism'],
            ['name' => 'Non-profit', 'slug' => 'non-profit'],
            ['name' => 'Government', 'slug' => 'government'],
            ['name' => 'Insurance', 'slug' => 'insurance'],
            ['name' => 'Automotive', 'slug' => 'automotive'],
            ['name' => 'Aerospace & Defense', 'slug' => 'aerospace-defense'],
        ];

        foreach ($industries as $industry) {
            Industry::firstOrCreate(['slug' => $industry['slug']], $industry);
        }
    }
}