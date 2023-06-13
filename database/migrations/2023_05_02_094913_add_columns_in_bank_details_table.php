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
        Schema::table('bank_details', function (Blueprint $table) {
            $table->integer('ssn_last_4')->nullable()->after('bank_name');
            $table->string('city')->nullable()->after('ssn_last_4');
            $table->string('state')->nullable()->after('city');
            $table->integer('postal_code')->nullable()->after('state');
            $table->string('address')->nullable()->after('postal_code');
            $table->date('dob')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_details', function (Blueprint $table) {
            $table->dropColumn('ssn_last_4');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('postal_code');
            $table->dropColumn('address');
            $table->dropColumn('dob');
        });
    }
};
