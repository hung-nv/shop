<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertising extends \Eloquent
{
    protected $table = 'advertising';

    protected $fillable = ['name', 'content', 'type'];
}
