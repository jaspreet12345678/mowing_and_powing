<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\Level::create([
            'level' => 1,
            'completed_orders' => 10,
            'earnings' => 500,
            'days_without_warnings' => 30
        ]);

        \App\Models\Level::create([
            'level' => 2,
            'completed_orders' => 20,
            'earnings' => 1000,
            'days_without_warnings' => 40
        ]);

        \App\Models\Level::create([
            'level' => 3,
            'completed_orders' => 30,
            'earnings' => 2000,
            'days_without_warnings' => 50
        ]);

    }
}
