<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguagesTableSeeder extends Seeder
{
    public function run()
    {
        $languages = [
            'English',
            'Spanish',
            'French',
            'German',
            'Italian',
            'Portuguese',
            'Chinese (Mandarin)',
            'Japanese',
            'Korean',
            'Arabic',
            'Dutch',
            'Russian',
            'Hindi'
        ];

        foreach ($languages as $language) {
            Language::firstOrCreate(['name' => $language]);
        }
    }
}