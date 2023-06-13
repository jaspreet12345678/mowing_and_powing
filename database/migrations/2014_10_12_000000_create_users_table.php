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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('provider_account_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('new_email')->nullable();
            $table->string('unverified_email')->nullable();
            $table->string('referral_link')->nullable();
            $table->string('referred_by')->nullable();
            $table->string('image')->nullable();
            $table->string('password')->nullable();
            $table->string('default_password')->nullable();
            $table->string('phone_number')->unique();
            $table->string('new_phone_number')->nullable();
            $table->string('type');
            $table->bigInteger('created_by')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->enum('last_login_device',['web','mobile'])->nullable()->comment = "web,mobile";
            $table->enum('status',[1,2,3])->default(2)->comment = "1 => Active, 2 => Pending, 3 => Inactive";
            $table->timestamp('phone_number_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('otp')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
