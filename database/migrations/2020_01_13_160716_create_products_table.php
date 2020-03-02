<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('code', 7);
            $table->string('name');
            $table->text('description');
            $table->decimal('multiple');
            $table->decimal('price');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('product_group_id');
            $table->unsignedBigInteger('product_status_id');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('product_category_id')->references('id')->on('product_categories');
            $table->foreign('product_group_id')->references('id')->on('product_groups');
            $table->foreign('product_status_id')->references('id')->on('product_statuses');
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
