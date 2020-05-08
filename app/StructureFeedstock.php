<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StructureFeedstock extends Model
{
    protected $fillable = [
        'structure_id',
        'product_id',
        'quantity',
    ];

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }
}
