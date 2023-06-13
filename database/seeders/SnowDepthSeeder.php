<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SnowDepthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SnowDepth::insert([
            ['name' => '0-6 (Inches)','price' => 5, 'type' => 'HOME', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '6-12 (Inches)','price' => 25,'type' => 'HOME', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'More than 12 (Inches)','price' => 125,'type' => 'HOME', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '0-6 (Inches)','price' => 5,'type' => 'BUSINESS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '6-12 (Inches)','price' => 25,'type' => 'BUSINESS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'More than 12 (Inches)','price' => 125,'type' => 'BUSINESS', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
