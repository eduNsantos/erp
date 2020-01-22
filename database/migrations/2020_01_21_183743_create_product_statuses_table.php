<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30);
            $table->timestamps();
        });

        DB::table('product_statuses')->insert([
            [
                'id' => 1,
                'name' => 'Ativo'
            ],
            [
                'id' => 2,
                'name' => 'Inativo'
            ],
            [
                'id' => 3,
                'name' => 'Suspenso'
            ],
            [
                'id' => 4,
                'name' => 'Fora de linha'
            ],
            [
                'id' => 5,
                'name' => 'Em desenvolvimento'
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
        Schema::dropIfExists('product_statuses');
    }
}
