<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_products';

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
}
