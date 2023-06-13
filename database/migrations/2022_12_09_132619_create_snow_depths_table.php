<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('snow_depths', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price',10,2);
            $table->string('type')->comment = "CAR,HOME,BUSINESS ";
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snow_depths');
    }
};
