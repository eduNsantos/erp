<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleMenuFunction extends Model
{
    protected $fillable = [
        'module_menu_id',
        'name',
        'icon',
        'route',
    ];
}
