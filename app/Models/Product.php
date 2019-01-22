<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends \Eloquent
{
    use SoftDeletes;

    CONST PRODUCT_TYPE = 'product';

    public $table = 'products';

    protected $fillable = ['name', 'sku', 'slug', 'special', 'description', 'content', 'price', 'new_price',
        'cover_image', 'user_id', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $appends = ['url', 'sale_off'];

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
     * Set url for category.
     * @param $value
     * @return string
     */
    public function getUrlAttribute($value)
    {
        $prefix = config('const.prefix.' . self::PRODUCT_TYPE);

        return $prefix ? '/' . $prefix . '/' . $this->slug : '/' . $this->slug;
    }

    public function getSaleOffAttribute($value)
    {
        if ($this->new_price) {
            return round(($this->price - $this->new_price) / $this->price * 100);
        }

        return null;
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
     * @param int $limit
     * @param array $columns
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
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
        return self::select('products.*')
            ->join('product_group', function ($join) {
                $join->on('products.id', '=', 'product_group.product_id');
            })
            ->whereIn('product_group.group_id', $idsGroup)
            ->where('products.status', 1)
            ->orderByDesc('products.created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Paginate products by ids category.
     * @param array $idsCategory
     * @param int $pageSize
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function paginateProductsByIdsCategory($idsCategory, $pageSize, $filters)
    {
        $model = self::select([
            'products.id',
            'products.name',
            'products.slug',
            'products.cover_image',
            'products.price',
            'products.new_price',
            'products.created_at'
        ])
            ->join('product_category', function ($join) {
                $join->on('products.id', '=', 'product_category.product_id');
            })
            ->where(function ($query) use ($idsCategory) {
                foreach ($idsCategory as $id) {
                    $query->orWhere('product_category.category_id', '=', $id);
                }
            })
            ->where('products.status', 1)
            ->groupBy('products.id');

        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 1:
                    $model->orderByDesc('products.updated_at');
                    break;
                case 2:
                    $model->orderBy('products.price');
                    break;
                case 3:
                    $model->orderByDesc('products.price');
                    break;
                case 4:
                    $model->orderBy('products.name');
                    break;
                default:
                    $model->orderByDesc('products.updated_at');
            }
        }

        if (isset($filters['min']) and $filters['min'] !== '') {
            $model->where('products.price', '>=', $filters['min']);
        }

        if (isset($filters['max']) and $filters['max'] !== '') {
            $model->where('products.price', '<=', $filters['max']);
        }

        $model = $model->paginate($pageSize);

        return $model;
    }

    /**
     * Find product by slug.
     * @param string $slug
     * @return Product|Model|object|null
     */
    public static function findProductBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    /**
     * Get new products.
     * @param $limit
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getNewProducts($limit)
    {
        return self::orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }
}
