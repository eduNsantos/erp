<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30)->unique();
            $table->timestamps();
        });

        DB::table('product_categories')->insert([
            [
                'id' => 1,
                'name' => 'LPC- Sorv PT 1,8L MESCLADO BCD'
            ],
            [
                'id' => 2,
                'name' => 'LPC- Sorv PT 1,5L NOBRE BCD'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');
    }
}
