<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends \Eloquent
{
    protected $table = 'orders';

    protected $fillable = [
        'total_money',
        'first_name',
        'last_name',
        'address',
        'telephone',
        'note',
        'status',
        'coupon_code',
        'coupon_code_value'
    ];

    public function orderProducts()
    {
        return $this->belongsToMany('App\Models\Product', 'order_products', 'order_id', 'product_id')
            ->withPivot('price', 'product_name', 'product_sku', 'product_image', 'quantities')
            ->withTimestamps();
    }
}
