<?php

namespace App\Http\Controllers;

use App\ModuleMenu;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public const REVENUES = 1;
    public const STOCK = 2;
    public const SALES = 3;
    public const GENERAL_REGISTRATION = 4;

    public function stock()
    {
        $menus = $this->getMenus(self::STOCK);

        // dd($menus);

        return view('menu', compact('menus'));
    }
    
    public function general_registration()
    {
        $menus = $this->getMenus(self::GENERAL_REGISTRATION);

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
