<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\ArticleServices;
use App\Services\ProductServices;

class HomepageController extends Controller
{
    protected $productServices;

    protected $articleServices;

    public function __construct(ProductServices $productServices, ArticleServices $articleServices)
    {
        parent::__construct();

        $this->productServices = $productServices;

        $this->articleServices = $articleServices;
    }

    public function index()
    {
        $widgetCatalogs = [];

        $selectedCatalogs = [];

        if (!empty($this->option['mainCategory'])) {
            $widgetCatalogs = $this->productServices->getWidgetCatalogsWithProducts($this->option['mainCategory'], 8);
        }

        if (!empty($this->option['selectedCatalog'])) {
            $selectedCatalogs = $this->productServices->getWidgetNewProducts($this->option['selectedCatalog'], 6);
        }

        $hotProducts = $this->productServices->getHotProducts(5);

        $hotArticle = $this->articleServices->getHotArticles(5);

        return view('homepage.index', [
            'widgetCatalogs' => $widgetCatalogs,
            'selectedCatalogs' => $selectedCatalogs,
            'hotProducts' => $hotProducts,
            'hotArticle' => $hotArticle
        ]);
    }
}
