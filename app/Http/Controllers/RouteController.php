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
        Module::setCurrentModule(Module::STOCK);

        return view('menu');
    }
    
    /**
     * Open general registration module
     */
    public function general_registration()
    {
        Module::setCurrentModule(Module::GENERAL_REGISTRATION);

        return view('menu');
    }
    
    /**
     * Open sales module
     */
    public function sales()
    {
        Module::setCurrentModule(Module::SALES);

        return view('menu');
    }
}
