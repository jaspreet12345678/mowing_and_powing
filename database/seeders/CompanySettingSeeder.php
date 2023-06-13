<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CompanySetting::create([
            'name' => 'Mowing and Plowing',
            'logo' => '/assets/images/logo/logo.png',
            'favicon' => '/assets/images/logo/favicon-icon.png',
        ]);
    }
}
