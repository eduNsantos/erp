<?php

namespace App\Http\Controllers;

use App\Module;
use App\ModuleMenu;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Open stock module
     */
    public function stock()
    {
        $menus = $this->getMenus(Module::STOCK);

        return view('menu', compact('menus'));
    }
    
    /**
     * Open general registration module
     */
    public function general_registration()
    {
        $menus = $this->getMenus(Module::GENERAL_REGISTRATION);

        return view('menu', compact('menus'));
    }
    
    /**
     * Open sales module
     */
    public function sales()
    {
        $menus = $this->getMenus(Module::SALES);

        return view('menu', compact('menus'));
    }

    private function getMenus($moduleId)
    {
        $menus = ModuleMenu::whereHas('functions')
            ->where('module_id', $moduleId)
            ->get()
        ;

        return $menus;
    }
}
