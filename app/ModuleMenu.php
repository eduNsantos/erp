<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleMenu extends Model
{
    const STOCK_PRODUCT = 1;
    const STOCK_CONSULT = 2;
    const SALES_CLIENT = 3;
    const SALES_ORDER = 4;
    const PCP_SHORTCUTS = 5;

    protected $fillable = [
        'module_id',
        'name',
    ];
    protected $with = ['functions'];
    
    public function functions()
    {
        return $this->hasMany(ModuleMenuFunction::class);
    }
    
    public static function getMenus()
    {
        $menus = self::whereHas('functions')
            ->where('module_id', Module::getCurrentModule())
            ->get()
        ;

        return $menus;
    }
}
