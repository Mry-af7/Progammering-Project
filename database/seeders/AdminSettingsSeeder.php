<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminSetting;

class AdminSettingsSeeder extends Seeder
{
    public function run()
    {
        AdminSetting::create([
            'key' => 'site_name',
            'value' => 'Career Jump Platform'
        ]);
        
        AdminSetting::create([
            'key' => 'maintenance_mode',
            'value' => 'off'
        ]);
        
        AdminSetting::create([
            'key' => 'max_file_size',
            'value' => '10'
        ]);
        
        AdminSetting::create([
            'key' => 'allowed_file_types',
            'value' => 'pdf,doc,docx,jpg,jpeg,png'
        ]);
    }
} 