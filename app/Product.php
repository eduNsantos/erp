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
        'product_status_id',
        'is_generic',
        'is_feedstock',
        'is_finished_product',
        'is_package',
        'expiration_days',
        'original_product_id'
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

    public function balances()
    {
        return $this->hasMany(ProductBalance::class, 'product_id', 'id');
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
    
    public function movements()
    {
        return $this->hasMany(ProductMovement::class);
    }

    /**
     * Return price with R$ and formated with comma
     */
    public function getConvertedPriceAttribute()
    {
        return 'R$ ' . number_format(self::find($this->id)->price, 2, ',', '.');
    }

    public function getPhysicalBalanceAttribute()
    {
        return ProductBalance::where('product_balance_type_id', ProductBalanceType::PHYSICAL)
            ->where('product_id', $this->id)
            ->first()
            ->quantity
        ;
    }

    public function getReservedBalanceAttribute()
    {
        return ProductBalance::where('product_balance_type_id', ProductBalanceType::RESERVED)
            ->where('product_id', $this->id)
            ->first()
            ->quantity
        ;
    }

    public function getAvailableBalanceAttribute()
    {
        return $this->getPhysicalBalanceAttribute() - $this->getReservedBalanceAttribute();
    }
}
