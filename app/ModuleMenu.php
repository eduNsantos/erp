<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleMenu extends Model
{
    protected $with = ['functions'];
    
    public function functions()
    {
        return $this->hasMany(ModuleMenuFunction::class);
    }
}
