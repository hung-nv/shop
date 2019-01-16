<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertising extends \Eloquent
{
    protected $table = 'advertising';

    protected $fillable = ['name', 'content', 'type', 'group'];

    /**
     * Get advertising by group
     * @param int $group
     * @return Advertising[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getAdvertisingByGroup($group)
    {
        return self::where('type', '2')
            ->where('group', $group)
            ->get();
    }
}
