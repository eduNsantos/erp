<?php

namespace App\Http\Middleware\Modules;

use App\Module;
use App\ModuleMenu;
use Closure;

class Sales
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        view()->share('menus', ModuleMenu::where('module_id', Module::SALES)->get());
        return $next($request);
    }
}
