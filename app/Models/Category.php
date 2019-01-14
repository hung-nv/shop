<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Category extends \Eloquent
{
    CONST CATEGORY_TYPE = 'category';
    CONST CATALOG_TYPE = 'catalog';

    protected $table = 'category';

    protected $fillable = ['name', 'slug', 'parent_id', 'image', 'icon', 'meta_title', 'meta_description', 'type'];

    protected $append = ['url'];

    public function posts()
    {
        return $this->belongsToMany('App\Models\Article', 'post_category', 'category_id', 'article_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'product_category', 'category_id', 'product_id');
    }

    public function limitProduct()
    {
        return $this->belongsToMany('App\Models\Product', 'product_category', 'category_id', 'product_id')->limit(8);
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public static function getCategoryByType($type)
    {
        return self::where('type', $type)->get();
    }

    /**
     * Get category by slug.
     * @param $slug
     * @return Category|Model|null|object
     */
    public static function getCategoryBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    /**
     * Set url for category.
     * @param $value
     * @return string
     */
    public function getUrlAttribute($value)
    {
        $prefix = config('const.prefix.' . self::CATEGORY_TYPE);

        return $prefix ? '/' . $prefix . '/' . $this->slug : '/' . $this->slug;
    }
}