<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    const SALES = 1;
    const STOCK = 2;
    const GENERAL_REGISTRATION = 3;
    
    protected $fillable = [
        'name',
        'icon',
        'route'
    ];
}
