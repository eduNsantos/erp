<?php

use App\Module;
use App\ModuleMenu;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id');
            $table->string('name', 50);
            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules');
        });

        DB::table('module_menus')->insert([
            [
                'id' => ModuleMenu::STOCK_PRODUCT,
                'module_id' => Module::STOCK,
                'name' => 'Produto'
            ],
            [
                'id' => ModuleMenu::STOCK_CONSULT,
                'module_id' => Module::STOCK,
                'name' => 'Consultas'
            ],
            [
                'id' => ModuleMenu::SALES_CLIENT,
                'module_id' => Module::SALES,
                'name' => 'Clientes'
            ],
            [
                'id' => ModuleMenu::SALES_ORDER,
                'module_id' => Module::SALES,
                'name' => 'Pedidos'
            ],
            [
                'id' => ModuleMenu::PCP_SHORTCUTS,
                'module_id' => Module::PCP,
                'name' => 'Atalhos'
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
        Schema::dropIfExists('module_menus');
    }
}
