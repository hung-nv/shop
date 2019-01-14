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

        $layout = 'news.page';
        if ($this->agent->isMobile()) {
            $layout = 'mobile.news.page';
        }

        return view($layout, [
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

        $layout = 'news.view';
        if ($this->agent->isMobile()) {
            $layout = 'mobile.news.view';
        }

        return view($layout, [
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

        $layout = 'news.category';
        if ($this->agent->isMobile()) {
            $layout = 'mobile.news.category';
        }

        return view($layout, [
            'category' => $category,
            'articles' => $articles
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->txtSearch;
        $articles = $this->articleServices->getAllArticlesByName($search);

        return view('news.search', [
            'search' => $search,
            'articles' => $articles
        ]);
    }
}
