<?php

namespace App\Http\Controllers\Frontend;

use App\Services\ArticleServices;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;

class HomepageController extends Controller
{
    protected $articleServices;
    protected $agent;

    public function __construct(ArticleServices $articleServices, Agent $agent)
    {
        parent::__construct();

        $this->articleServices = $articleServices;
        $this->agent = $agent;
    }

    public function index()
    {
        $widgetCategory = [];

        $newArticles = $this->articleServices->getNewArticles(5);

        $idsExcept = $newArticles->pluck('id')->all();

        $this->setIdsExcept($idsExcept);

        if (!empty($this->option['mainCategory'])) {
            $widgetCategory = $this->articleServices->getWidgetCategoryWithArticles(
                $this->option['mainCategory'],
                6,
                $idsExcept
            );
        }

        $hotArticles = $this->articleServices->getArticlesByGroupId(1, 5);

        $layouts = 'homepage.index';
        if ($this->agent->isMobile()) {
            $layouts = 'mobile.homepage.index';
        }

        return view($layouts, [
            'widgetCategory' => $widgetCategory,
            'mostArticles' => $hotArticles,
            'newArticles' => $newArticles
        ]);
    }
}
