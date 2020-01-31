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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->tinyInteger('status');
            $table->float('price');
            $table->float('discount_price')->nullable();
            $table->text('short_desc');
            $table->text('long_desc');
            $table->string('meta_title');
            $table->text('meta_desc');
            $table->text('meta_keywords');

            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('brand_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

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
