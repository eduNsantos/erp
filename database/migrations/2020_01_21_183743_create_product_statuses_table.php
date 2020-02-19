<?php

use App\ProductStatus;
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
                'id' => ProductStatus::ACTIVE,
                'name' => 'Ativo'
            ],
            [
                'id' => ProductStatus::INACTIVE,
                'name' => 'Inativo'
            ],
            [
                'id' => ProductStatus::SUSPENDED,
                'name' => 'Suspenso'
            ],
            [
                'id' => ProductStatus::DESCONTINUED,
                'name' => 'Fora de linha'
            ],
            [
                'id' => ProductStatus::DEVELOPMENT,
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
