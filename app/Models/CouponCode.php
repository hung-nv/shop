<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponCode extends Model
{
    protected $table = 'coupon_codes';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'value',
        'start_date',
        'end_date',
        'status'
    ];
}
