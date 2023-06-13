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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->bigInteger('provider_id')->nullable();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('transaction_id');
            $table->double('amount',8,2);
            $table->enum('status',[1,2,3])->default(1)->comment = "1 => Pending, 2 => Success, 3 => Failed";
            $table->enum('type',[1,2])->default(1)->comment = "1 => Payed by Customer, 2 => Paid to Provider";
            $table->enum('account',['wallet','card']);
            $table->longText('stripe_response')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
