<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Question::create([
            'question' => 'Was all steps completed on this job',
            'category' => 0
        ]);
        \App\Models\Question::create([
            'question' => 'Was front , back an all side lawns cut',
            'category' => 1
        ]);
        \App\Models\Question::create([
            'question' => 'Did you close the gate ?',
            'category' => 1
        ]);
        \App\Models\Question::create([
            'question' => 'Did you blow or sweep up steps , driveway , sidewalk , street and all concrete areas of grass and debris?',
            'category' => 1
        ]);
        \App\Models\Question::create([
            'question' => 'Where all jobs notes completed ? ',
            'category' => 2
        ]);
        \App\Models\Question::create([
            'question' => 'Were all task requested by customer completed ? ( Only pertaining to Mowing)',
            'category' => 1
        ]);
        \App\Models\Question::create([
            'question' => 'Did you neatly mow all grass areas ? ( Front , Back , and any side lawns ) ',
            'category' => 1
        ]);
        \App\Models\Question::create([
            'question' => 'Did you edge  all grass areas including front, back, and side lawns with string trimmer? ',
            'category' => 1
        ]);
        \App\Models\Question::create([
            'question' => 'Did you weed trim the perimeter of front , side, and back lawn and around fences, trees, poles etc ?',
            'category' => 1
        ]);
        \App\Models\Question::create([
            'question' => 'Did you clear the snow from required areas ? ',
            'category' => 2
        ]);
    }
}
