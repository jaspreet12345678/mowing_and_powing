<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
            'name' => 'Super Admin',
            'email' => 'hello@mowingandplowing.com',
            'password' => '123456',
            'phone_number' => '+18773316188',
        ]);
    }
}
