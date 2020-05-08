<?php

use App\Module;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30);
            $table->string('icon', 255);
            $table->string('route', 255);
            $table->timestamps();
        });

        DB::table('modules')->insert([
            [
                'id' => Module::SALES,
                'name' => 'sales',
                'icon' => 'fas fa-scroll',
                'route' => 'sales.index'
            ],
            [
                'id' => Module::STOCK,
                'name' => 'stock',
                'icon' => 'fas fa-boxes',
                'route' => 'stock.index'
            ],
            [
                'id' => Module::GENERAL_REGISTRATION,
                'name' => 'general-registration',
                'icon' => 'fas fa-receipt',
                'route' => 'general_registration.index'
            ],
            [
                'id' => Module::PCP,
                'name' => 'pcp',
                'icon' => 'fas fa-cogs',
                'route' => 'pcp.index'
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
        Schema::dropIfExists('modules');
    }
}
