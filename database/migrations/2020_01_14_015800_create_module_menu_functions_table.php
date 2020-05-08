<?php

use App\ModuleMenu;
use App\ModuleMenuFunction;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleMenuFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_menu_functions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_menu_id');
            $table->string('name');
            $table->string('icon');
            $table->string('route');
            $table->timestamps();

            $table->foreign('module_menu_id')->references('id')->on('module_menus');
        });

        ModuleMenuFunction::insert([
            [
                'module_menu_id' => ModuleMenu::STOCK_PRODUCT,
                'name' => 'Cadastro de produto',
                'icon' => 'fas fa-plus',
                'route' => 'product.create'
            ],
            [
                'module_menu_id' => ModuleMenu::STOCK_PRODUCT,
                'name' => 'Listagem de produto',
                'icon' => 'fas fa-boxes',
                'route' => 'product.index'
            ],
            [
                'module_menu_id' => ModuleMenu::STOCK_PRODUCT,
                'name' => 'Unidade de medida',
                'icon' => 'fas fa-balance-scale',
                'route' => 'product-unit.index'
            ],
            [
                'module_menu_id' => ModuleMenu::STOCK_PRODUCT,
                'name' => 'Categoria de produto',
                'icon' => 'fab fa-buffer',
                'route' => 'product-category.index'
            ],
            [
                'module_menu_id' => ModuleMenu::STOCK_PRODUCT,
                'name' => 'Grupo de produto',
                'icon' => 'fas fa-object-group',
                'route' => 'product-group.index'
            ],
            [
                'module_menu_id' => ModuleMenu::STOCK_PRODUCT,
                'name' => 'Marca de produto',
                'icon' => 'fas fa-copyright',
                'route' => 'brand.index'
            ],
            [
                'module_menu_id' => ModuleMenu::STOCK_CONSULT,
                'name' => 'Movimentação de estoque por produto',
                'icon' => 'fas fa-search',
                'route' => 'product.movements'
            ],
            [
                'module_menu_id' => ModuleMenu::SALES_CLIENT,
                'name' => 'Clientes',
                'icon' => 'fas fa-users',
                'route' => 'client.index'
            ],
            [
                'module_menu_id' => ModuleMenu::SALES_ORDER,
                'name' => 'Novo pedido de venda',
                'icon' => 'fas fa-clipboard',
                'route' => 'order.create'
            ],
            [
                'module_menu_id' => ModuleMenu::SALES_ORDER,
                'name' => 'Pedidos de venda',
                'icon' => 'fas fa-clipboard',
                'route' => 'order.index'
            ],
            [
                'module_menu_id' => ModuleMenu::PCP_SHORTCUTS,
                'name' => 'Receita/estrutura de produto',
                'icon' => 'fas fa-hammer',
                'route' => 'product-structure.index'
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
        Schema::dropIfExists('module_menu_functions');
    }
}
