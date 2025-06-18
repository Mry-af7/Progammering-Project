<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudyField;

class StudyFieldSeeder extends Seeder
{
    public function run()
    {
        $studyFields = [
            [
                'name' => 'Toegepaste Informatica',
                'code' => 'TI',
                'description' => 'Bachelor in Toegepaste Informatica'
            ],
            [
                'name' => 'Bedrijfsmanagement',
                'code' => 'BM',
                'description' => 'Bachelor in Bedrijfsmanagement'
            ],
            [
                'name' => 'Office Management',
                'code' => 'OM',
                'description' => 'Bachelor in Office Management'
            ],
            [
                'name' => 'Marketing',
                'code' => 'MKT',
                'description' => 'Bachelor in Marketing'
            ],
            [
                'name' => 'Accountancy',
                'code' => 'ACC',
                'description' => 'Bachelor in Accountancy'
            ]
        ];

        foreach ($studyFields as $field) {
            StudyField::create($field);
        }
    }
} 