<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::create([
            'receiver_id' => 1,
            'sender_id' => 0,
            'title' => "Welcome",
            'content' => "Welcome to Mowing and Plowing"
        ]);
    }
}
