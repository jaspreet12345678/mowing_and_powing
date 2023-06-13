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
        Schema::create('provider_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('company_name')->nullable();
            $table->enum('company_size',[1,2,3])->comment = "1 => Just me, 2 => 2-10 People, 3 => 10+ People";
            $table->enum('industry_type',[1,2,3])->nullable()->comment = "1 => Lawn Mower, 2 => Snow Plower, 3 => Both";
            $table->string('company_website')->nullable();
            $table->string('company_address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('last_known_lat')->nullable();
            $table->string('last_known_lng')->nullable();
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
        Schema::dropIfExists('provider_details');
    }
};
