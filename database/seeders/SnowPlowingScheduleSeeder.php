<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SnowPlowingScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SnowPlowingSchedule::insert([
            ['name' => 'Tomorrow AM', 'time' => '2am - 10am', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tomorrow PM', 'time' => '4pm -12pm', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'As soon as possible', 'time' => 'Within 2 hours', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
