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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('customer_id');
            $table->string('card_id');
            $table->string('brand');
            $table->string('country');
            $table->string('fingerprint');
            $table->string('funding');
            $table->bigInteger('card_number');
            $table->integer('last4');
            $table->integer('cvv');
            $table->integer('exp_month');
            $table->integer('exp_year');
            $table->enum('is_default',[0,1])->default(0)->comment = "0 => No, 1 => Yes";
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
        Schema::dropIfExists('cards');
    }
};
