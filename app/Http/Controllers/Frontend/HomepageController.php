<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\ProductServices;

class HomepageController extends Controller
{
    protected $productServices;

    public function __construct(ProductServices $productServices)
    {
        parent::__construct();

        $this->productServices = $productServices;
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

        return view('homepage.index', [
            'widgetCatalogs' => $widgetCatalogs,
            'selectedCatalogs' => $selectedCatalogs,
            'hotProducts' => $hotProducts
        ]);
    }
}
