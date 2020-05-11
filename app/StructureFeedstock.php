<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StructureFeedstock extends Model
{
    const FEEDSTOCK = 1;
    const PACKAGE = 2;
    
    protected $fillable = [
        'feedstock_type_id',
        'structure_id',
        'product_id',
        'quantity'
    ];

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }
}
