<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleMenu extends Model
{
    const STOCK_PRODUCT = 1;
    const STOCK_MOVEMENT = 2;
    const STOCK_CONSULT = 3;
    const SALES_CLIENT = 4;
    const SALES_ORDER = 5;

    protected $fillable = [
        'module_id',
        'name',
    ];
    protected $with = ['functions'];
    
    public function functions()
    {
        return $this->hasMany(ModuleMenuFunction::class);
    }
}
