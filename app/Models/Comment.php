<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends \Eloquent
{
    protected $table = 'comment';

    protected $fillable = ['name', 'avatar', 'content'];

    public $timestamps = true;
}
