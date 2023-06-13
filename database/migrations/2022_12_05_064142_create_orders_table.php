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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id',500)->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('property_id');
            $table->string('lat');
            $table->string('lng');
            $table->date('date');
            $table->string('service_for')->nullable()->comment = "CAR,HOME,BUSINESS";
            $table->integer('snow_plowing_schedule_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->double('subcategory_amount',10,2)->nullable();
            $table->integer('color_id')->nullable();
            $table->string('car_number')->nullable();
            $table->integer('driveway')->nullable();
            $table->double('driveway_amount',10,2)->nullable();
            $table->string('sidewalk_sizes',500)->nullable();
            $table->double('sidewalk_amount',10,2)->nullable();
            $table->string('walkway_sizes',500)->nullable();
            $table->double('walkway_amount',10,2)->nullable();
            $table->integer('snow_depth_id')->nullable();
            $table->double('snow_depth_amount',10,2)->nullable();
            $table->string('on_demand')->nullable()->comment = "Today, Schedule";
            $table->double('on_demand_fee',10,2)->nullable();
            $table->integer('lawn_size_id')->nullable()->comment = "In Acres";
            $table->double('lawn_size_amount',10,2)->nullable();
            $table->integer('lawn_height_id')->nullable()->comment = "In Inches";
            $table->double('lawn_height_amount',10,2)->nullable();
            $table->integer('fence_id')->nullable()->nullable();
            $table->double('fence_amount',10,2)->nullable();
            $table->integer('cleanup_id')->nullable()->nullable();
            $table->double('cleanup_amount',10,2)->nullable();
            $table->integer('corner_lot_id')->nullable();
            $table->double('corner_lot_amount',10,2)->nullable();
            $table->integer('service_period_id')->nullable()->comment = "Days";
            $table->integer('service_type')->default(1)->comment = "1 => one time, 2 => recurring";
            $table->string('gate_code')->nullable();
            $table->longText('instructions')->nullable();
            $table->double('total_amount_by_provider',10,2)->nullable();
            $table->double('admin_fee',10,2);
            $table->double('total_amount',10,2)->comment = "subtotal";
            $table->integer('coupon_id')->nullable();
            $table->string('coupon_code',500)->nullable();
            $table->integer('coupon_type')->nullable()->comment = "1 => flat, 2 => percentage";
            $table->string('discount_value',100)->nullable();
            $table->double('discount_amount',10,2)->nullable();
            $table->string('tax_perc',500);
            $table->double('tax',10,2);
            $table->string('tip_type')->nullable();
            $table->double('tip_perc',10,2)->nullable();
            $table->double('tip',10,2)->nullable();
            $table->double('admin_commission_perc',10,2);
            $table->double('admin_commission',10,2);
            $table->double('grand_total',10,2);
            $table->integer('assigned_to')->nullable();
            $table->double('provider_amount',10,2);
            $table->timestamp('provider_assigned_date')->nullable();
            $table->timestamp('change_provider_assigned_date')->nullable();
            $table->integer('on_the_way')->nullable();
            $table->integer('at_location_and_started_job')->nullable();
            $table->integer('finished_job')->nullable();
            $table->timestamp('on_the_way_date')->nullable();
            $table->timestamp('at_location_and_started_job_date')->nullable();
            $table->timestamp('finished_job_date')->nullable();
            $table->timestamp('estimated_time')->nullable();
            $table->string('checked_questions',500)->nullable();
            $table->integer('is_coupon_applied')->nullable();
            $table->integer('paid_to_provider')->nullable()->comment = "0 => pending, 1 => paid";
            $table->integer('payment_status')->default(1)->comment = "1 => pending, 2 => success";
            $table->string('parent_recurring_order_id',500)->nullable();
            $table->integer('status')->default(1)->comment = "1 => pending, 2 => accepted, 3 => completed, 4 => canceled";
            $table->integer('status_by_customer')->default(0)->comment = "0 => pending, 1 => completed";
            $table->timestamp('cancel_order_date')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->double('cancellation_charges',10,2)->nullable();
            $table->integer('is_reviewed')->nullable();
            $table->integer('is_refund_reviewed')->nullable();
            $table->integer('is_refunded')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
