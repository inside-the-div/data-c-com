<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index();
            $table->string('start_time');
            $table->string('end_time');
            $table->string('type');
            $table->double('discount');
            $table->string('discount_type');
            $table->text('product_id_list')->nullable();
            $table->string('min_cost')->nullable();
            $table->string('description')->nullable();
            $table->boolean('active')->default(0);
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('coupons');
    }
}
