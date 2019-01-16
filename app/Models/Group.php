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

    /**
     * Get group by ids.
     * @param $idsGroup
     * @return Group[]|\Illuminate\Database\Eloquent\Collection
     */
	public static function getGroupByIds($idsGroup)
    {
        return self::whereIn('id', $idsGroup)
            ->get();
    }
}
