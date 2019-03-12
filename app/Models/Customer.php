<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends \Eloquent
{
    protected $table = 'customers';

    protected $fillable = [
        'email',
        'name',
        'mobile'
    ];
}
