<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_products';

    protected $fillable = [
        'quantities',
        'price',
        'product_name',
        'product_sku',
        'product_image'
    ];
}
