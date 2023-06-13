<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $lawn_sizes = public_path().'/assets/sql/lawn_sizes.sql';
        DB::unprepared(file_get_contents($lawn_sizes));

        $lawn_heights = public_path().'/assets/sql/lawn_heights.sql';
        DB::unprepared(file_get_contents($lawn_heights));

        $fences = public_path().'/assets/sql/fences.sql';
        DB::unprepared(file_get_contents($fences));

        $cleanups = public_path().'/assets/sql/cleanups.sql';
        DB::unprepared(file_get_contents($cleanups));

        $service_periods = public_path().'/assets/sql/service_periods.sql';
        DB::unprepared(file_get_contents($service_periods));

        $corner_lots = public_path().'/assets/sql/corner_lots.sql';
        DB::unprepared(file_get_contents($corner_lots));

        $settings = public_path().'/assets/sql/settings.sql';
        DB::unprepared(file_get_contents($settings));

        $driveways = public_path().'/assets/sql/driveways.sql';
        DB::unprepared(file_get_contents($driveways));

        $sidewalks = public_path().'/assets/sql/sidewalks.sql';
        DB::unprepared(file_get_contents($sidewalks));

        $walkways = public_path().'/assets/sql/walkways.sql';
        DB::unprepared(file_get_contents($walkways));

        $sub_categories = public_path().'/assets/sql/sub_categories.sql';
        DB::unprepared(file_get_contents($sub_categories));

        $colors = public_path().'/assets/sql/colors.sql';
        DB::unprepared(file_get_contents($colors));

        $colors = public_path().'/assets/sql/us_states.sql';
        DB::unprepared(file_get_contents($colors));

        $colors = public_path().'/assets/sql/us_cities.sql';
        DB::unprepared(file_get_contents($colors));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
