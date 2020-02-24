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

    public static function getCurrentFunction (): int
    {
        return session('current_function_id');
    }

    public static function setCurrentFunction (int $functionid)
    {
        return session(['current_function_id' => $functionid]);
    }
}
