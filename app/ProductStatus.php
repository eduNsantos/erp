<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductStatus extends Model
{
    const ACTIVE = 1;
    const INACTIVE = 2;
    const SUSPENDED = 3;
    const DESCONTINUED = 4;
    const DEVELOPMENT = 5;

    protected $fillable = ['name'];
}
