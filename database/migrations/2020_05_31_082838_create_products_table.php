<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('view')->default(0);
            $table->integer('rating')->default(0);
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('image');
            $table->double('price');
            $table->integer('stock');
            $table->mediumText('description');
            $table->mediumText('attributes');
            $table->double('discount')->default(0.0);
            // $table->double('shipping_cost')->default(0.0);
            $table->boolean('active')->default(0);
            $table->boolean('available')->default(1);
            // $table->string('tag_line')->default('new');
            // $table->boolean('home_show')->default(0);

            //seo
            // $table->mediumText('meta_tag')->nullable();
            // $table->mediumText('meta_description')->nullable();
            // $table->mediumText('meta_keyword')->nullable();

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
        Schema::dropIfExists('products');
    }
}
