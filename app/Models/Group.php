<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends \Eloquent
{
    protected $table = 'groups';

	public function posts()
	{
		return $this->belongsToMany('App\Models\Article', 'post_group', 'group_id', 'post_id');
	}
}
