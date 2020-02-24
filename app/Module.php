<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    const SALES = 1;
    const STOCK = 2;
    const GENERAL_REGISTRATION = 3;
    
    protected $fillable = [
        'sales',
        'stock',
        'general-registration',
    ];

    public static function getCurrentModule (): int
    {
        return session('current_module_id');
    }

    public static function setCurrentModule (int $moduleId)
    {
        return session(['current_module_id' => $moduleId]);
    }
}
