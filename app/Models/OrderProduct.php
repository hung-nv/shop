<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends \Eloquent
{
    protected $table = 'order_products';

    protected $fillable = [
        'quantities',
        'price',
        'product_name',
        'product_sku',
        'product_image'
    ];

    /**
     * Get order products.
     * @param $oderId
     * @return array
     */
    public static function getOrderProducts($oderId)
    {
        return self::where('order_id', $oderId)->get();
    }
}
