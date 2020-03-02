<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'multiple',
        'unit_id',
        'brand_id',
        'product_category_id',
        'product_group_id',
        'product_status_id'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
    
    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'product_group_id');
    }
    
    public function status()
    {
        return $this->belongsTo(ProductStatus::class, 'product_status_id');
    }

    public function quantity()
    {
        return $this->belongsTo(ProductStatus::class, 'product_status_id');
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
