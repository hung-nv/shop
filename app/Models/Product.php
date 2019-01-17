<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends \Eloquent
{
    use SoftDeletes;

    public $table = 'products';

    protected $fillable = ['name', 'sku', 'slug', 'special', 'description', 'content', 'price', 'new_price',
        'cover_image', 'user_id', 'meta_title', 'meta_description', 'meta_keywords'];

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function catalogs()
    {
        return $this->belongsToMany('App\Models\Category', 'product_category')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'product_tag');
    }

    public function product_attributes()
    {
        return $this->belongsToMany('App\Models\AttributeValue', 'product_attribute_value');
    }

    public function product_attributes_sizes()
    {
        return $this->belongsToMany('App\Models\AttributeValue', 'product_attribute_value')->wherePivot('attr_name', 'Size');
    }

    public function product_attributes_colors()
    {
        return $this->belongsToMany('App\Models\AttributeValue', 'product_attribute_value')->wherePivot('attr_name', 'Color');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order', 'order_products');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Models\Group', 'product_group')->withTimestamps();
    }

    /**
     * Get products with conditions.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getProductsWithCondition()
    {
        return self::select(['id', 'name', 'sku', 'price', 'created_at', 'status', 'cover_image'])
            ->orderByDesc('created_at')
            ->paginate(15);
    }

    /**
     * Get products by collection of category.
     * @param array $idsCategory : collection of category [id1, id2, id3...]
     * @param array $idsCategory
     * @param int $limit
     * @param array $columns
     * @return \Illuminate\Support\Collection
     */
    public static function getProductsByIdsCategory(array $idsCategory, int $limit, $columns = [])
    {
        if (empty($columns)) {
            $columns = [
                'products.name',
                'products.slug',
                'products.description',
                'products.cover_image',
                'products.created_at',
                'products.price',
                'products.new_price'
            ];
        }

        $products = DB::table('products')
            ->select($columns)
            ->join('product_category', 'products.id', '=', 'product_category.product_id')
            ->where('products.status', 1)
            ->whereNull('products.deleted_at');

        $products->where(function ($query) use ($idsCategory) {
            foreach ($idsCategory as $id) {
                $query->orWhere('product_category.category_id', '=', $id);
            }
        });

        $products->orderByDesc('products.created_at')
            ->groupBy('products.id')
            ->limit($limit);

        return $products->get();
    }

    /**
     * Get most view products.
     * @param $limit
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getMostViewProduct($limit)
    {
        return self::where('status', 1)
            ->orderByDesc('view')
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * @param $idsGroup
     * @param $limit
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getProductByIdsGroup($idsGroup, $limit)
    {
        return self::select('product.*')
            ->join('product_group', function ($join) {
                $join->on('product.id', '=', 'product_group.product_id');
            })
            ->whereIn('product_group.group_id', $idsGroup)
            ->where('product.status', 1)
            ->orderByDesc('product.created_at')
            ->limit($limit)
            ->get();
    }
}
