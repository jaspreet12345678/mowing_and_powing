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
        Schema::create('recurring_histories', function (Blueprint $table) {
            $table->id();
            $table->string('order_id',500);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('provider_id');
            $table->foreignId('property_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('lat');
            $table->string('lng');
            $table->integer('on_every');
            $table->date('date')->comment = "work will get";
            $table->integer('lawn_size_id')->nullable();
            $table->double('lawn_size_amount',10,2);
            $table->integer('fence_id')->nullable();
            $table->double('fence_amount',10,2)->nullable();
            $table->integer('corner_lot_id')->nullable();
            $table->double('corner_lot_amount',10,2)->nullable();
            $table->double('total_amount_by_provider',10,2)->nullable();
            $table->double('admin_fee',10,2);
            $table->double('total_amount',10,2);
            $table->string('tax_perc',500);
            $table->double('tax',10,2);
            $table->double('tip',10,2)->nullable();
            $table->double('grand_total',10,2);
            $table->double('admin_commission_perc',10,2);
            $table->string('gate_code',500)->nullable();
            $table->string('instructions',500)->nullable();
            $table->enum('status',['Pending','Completed','Failed','Cancel','Active'])->comment = "Pending, Completed, Failed, Cancel, Active";
            $table->text('status_reason')->nullable();
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
        Schema::dropIfExists('recurring_histories');
    }
};
