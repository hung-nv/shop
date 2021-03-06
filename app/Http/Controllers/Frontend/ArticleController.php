<?php

namespace App\Http\Controllers\Frontend;

use App\Services\ArticleServices;
use App\Services\CategoryServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;

class ArticleController extends Controller
{
    protected $articleServices;
    protected $categoryServices;
    protected $agent;

    public function __construct(ArticleServices $articleServices, CategoryServices $categoryServices, Agent $agent)
    {
        parent::__construct();
        $this->articleServices = $articleServices;
        $this->categoryServices = $categoryServices;
        $this->agent = $agent;
    }

    public function page($slug)
    {
        $article = $this->articleServices->getArticleBySlug($slug);

        $this->setIdsExcept($article->id);

        $this->articleServices->updateViewArticle($article->id);

        return view('article.page', [
            'page' => $article
        ]);
    }

    public function details($slug)
    {
        $article = $this->articleServices->getArticleBySlug($slug);

        $this->setIdsExcept($article->id);

        $this->articleServices->updateViewArticle($article->id);

        $relatedArticles = $this->articleServices->getRelatedArticle(
            $article->category->pluck('id')->all(),
            $article->id
        );

        return view('article.view', [
            'article' => $article,
            'relatedArticles' => $relatedArticles
        ]);
    }

    /**
     * Category details.
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($slug)
    {
        $category = $this->categoryServices->getCategoryBySlug($slug);

        $articles = $this->articleServices->getAllPostsByParentCategory($category->id, $this->articleType);

        return view('article.index', [
            'category' => $category,
            'articles' => $articles
        ]);
    }
}
