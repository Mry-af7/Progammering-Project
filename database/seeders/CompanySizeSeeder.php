<?php

namespace Database\Seeders;

use App\Models\CompanySize;
use Illuminate\Database\Seeder;

class CompanySizeSeeder extends Seeder
{
    public function run(): void
    {
        $companySizes = [
            ['name' => 'Startup', 'label' => '1-10 employees', 'min_employees' => 1, 'max_employees' => 10],
            ['name' => 'Small', 'label' => '11-50 employees', 'min_employees' => 11, 'max_employees' => 50],
            ['name' => 'Medium', 'label' => '51-200 employees', 'min_employees' => 51, 'max_employees' => 200],
            ['name' => 'Large', 'label' => '201-1000 employees', 'min_employees' => 201, 'max_employees' => 1000],
            ['name' => 'Enterprise', 'label' => '1000+ employees', 'min_employees' => 1000, 'max_employees' => null],
        ];

        foreach ($companySizes as $size) {
            CompanySize::firstOrCreate(['name' => $size['name']], $size);
        }
    }
}