<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponCode extends \Eloquent
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

    /**
     *
     * @param $couponCodeName
     * @return CouponCode|Model|object|null
     */
    public static function findCouponCodeByName($couponCodeName)
    {
        return self::select([
            'code',
            'value'
        ])
            ->where('code', $couponCodeName)
            ->whereBetween(\DB::raw('NOW()'), [\DB::raw('start_date'), \DB::raw('end_date')])
            ->where('status', 1)
            ->first();
    }
}
