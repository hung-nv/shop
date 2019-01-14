<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Article extends \Eloquent
{
    CONST POST_TYPE = 'article';
    CONST PAGE_TYPE = 'page';
    CONST LANDING_TYPE = 'landing';

    protected $table = 'articles';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $append = ['url'];

    protected $fillable = [
        'name',
        'slug',
        'image',
        'url_video',
        'description',
        'content',
        'user_id',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'type'
    ];

    public function category()
    {
        return $this->belongsToMany(
            'App\Models\Category',
            'article_category',
            'article_id',
            'category_id'
        );
    }

    public function fields()
    {
        return $this->hasMany('App\Models\MetaField', 'article_id');
    }

    public function groups()
    {
        return $this->belongsToMany(
            'App\Models\Group',
            'article_group',
            'article_id',
            'group_id'
        );
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'article_tag', 'article_id', 'tag_id');
    }

    /**
     * Format created_at
     * @param $value
     * @return false|string
     */
    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H.i', strtotime($value));
    }

    /**
     * Set url for category.
     * @param $value
     * @return string
     */
    public function getUrlAttribute($value)
    {
        $prefix = config('const.prefix.' . self::POST_TYPE);

        return $prefix ? '/' . $prefix . '/' . $this->slug : '/' . $this->slug;
    }

    /**
     * Get all article in 7 days ago.
     * @param $query
     * @return mixed
     */
    public function scopeInWeek($query)
    {
        return $query->havingRaw('(UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(created_at)) < ?', [604800]);
    }

    /**
     *
     * @return Article[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function relatedPostsByTag()
    {
        return $this->whereHas('tags', function ($query) {
            $tagIds = $this->tags()->pluck('tags.id')->all();
            $query->whereIn('tags.id', $tagIds);
        })
            ->where('id', '<>', $this->id)
            ->limit(5)
            ->get();
    }

    /**
     * Get all posts by name.
     * @param string $name
     * @param int $pageSize
     * @param string $postType
     * @return $this|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getPostsByName(string $name, int $pageSize, string $postType)
    {
        $posts = self::where('type', $postType)->orderByDesc('created_at');

        if ($name !== '-1') {
            $posts = $posts->where('name', $name);
        }

        $posts = $posts->paginate($pageSize);

        return $posts;
    }

    /**
     * Get all pages.
     * @param array $type
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getAllPages(array $type)
    {
        return self::whereIn('type', $type)->orderByDesc('created_at')->get();
    }

    /**
     * @param array $idsCategory
     * @param int $limit
     * @param array $idsExcept
     * @return Article[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getArticlesByIdsCategory($idsCategory, $limit, $idsExcept = [])
    {
        return self::from('articles')
            ->select([
                'articles.id',
                'articles.name',
                'articles.slug',
                'articles.image',
                'articles.description',
                'articles.created_at'
            ])
            ->join('article_category', function ($join) {
                $join->on('articles.id', '=', 'article_category.article_id');
            })
            ->where(function ($query) use ($idsCategory) {
                foreach ($idsCategory as $id) {
                    $query->orWhere('article_category.category_id', '=', $id);
                }
            })
            ->orderByDesc('articles.updated_at')
            ->where('articles.status', 1)
            ->whereNotIn('articles.id', $idsExcept)
            ->groupBy('articles.id')
            ->limit($limit)
            ->get();
    }

    /**
     * @param $idsCategory
     * @param null $pageSize
     * @return Article
     */
    public static function paginateArticlesByIdsCategory($idsCategory, $articleType, $pageSize = null)
    {
        $model = self::from('articles')
            ->select([
                'articles.id',
                'articles.name',
                'articles.slug',
                'articles.image',
                'articles.description',
                'articles.created_at',
                'type'
            ])
            ->join('article_category', function ($join) {
                $join->on('articles.id', '=', 'article_category.article_id');
            })
            ->where(function ($query) use ($idsCategory) {
                foreach ($idsCategory as $id) {
                    $query->orWhere('article_category.category_id', '=', $id);
                }
            })
            ->where('articles.status', 1)
            ->where('articles.type', $articleType)
            ->orderByDesc('articles.updated_at')
            ->groupBy('articles.id')
            ->paginate($pageSize);

        return $model;
    }

    /**
     * Get articles by names and pagination.
     * @param $name
     * @param $pageSize
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function paginateArticlesByName($name, $pageSize)
    {
        $model = self::where('name', 'LIKE', '%' . $name . '%')
            ->where('status', 1)
            ->where('type', self::POST_TYPE)
            ->orderByDesc('updated_at')
            ->paginate($pageSize);

        return $model;
    }

    /**
     * Get article by slug.
     * @param $slug
     * @return Article|Model|object|null
     */
    public static function getArticleBySlug($slug)
    {
        return self::where('slug', $slug)
            ->where('status', 1)
            ->first();
    }

    /**
     * Get new articles.
     * @param $limit
     * @param array $idsExcept
     * @return Article[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getNewArticle($limit, $idsExcept = [])
    {
        return self::where('status', 1)
            ->where('type', self::POST_TYPE)
            ->orderByDesc('created_at')
            ->whereNotIn('id', $idsExcept)
            ->limit($limit)
            ->get();
    }

    /**
     * Get top article in 7 days ago.
     * @param $limit
     * @param array $idsExcept
     * @return Collection
     */
    public static function getTopArticlesInWeek($limit, $idsExcept = [])
    {
        return self::where('status', 1)
            ->inWeek()
            ->where('type', self::POST_TYPE)
            ->whereNotIn('id', $idsExcept)
            ->limit($limit)
            ->get();
    }

    /**
     * Get articles by groupId
     * @param $groupId
     * @param $limit
     * @return Article[]|Collection
     */
    public static function getArticlesByGroupId($groupId, $limit)
    {
        return self::from('articles as a')
            ->select([
                'a.*'
            ])
            ->join('article_group as b', function ($join) {
                $join->on('b.article_id', '=', 'a.id');
            })
            ->where('b.group_id', $groupId)
            ->where('a.status', 1)
            ->where('a.type', self::POST_TYPE)
            ->orderByDesc('a.created_at')
            ->limit($limit)
            ->get();
    }
}
