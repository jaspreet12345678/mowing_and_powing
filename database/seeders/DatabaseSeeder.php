<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            CompanySettingSeeder::class,
            RolesAndPermissionsSeeder::class,
            EmailTemplateSeeder::class,
            CategorySeeder::class,
            FAQsSeeder::class,
            TermAndConditionSeeder::class,
            PrivacyPolicySeeder::class,
            LevelSeeder::class,
            QuestionsSeeder::class,
            SnowDepthSeeder::class,
            SnowPlowingScheduleSeeder::class,
            AboutUsSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}
