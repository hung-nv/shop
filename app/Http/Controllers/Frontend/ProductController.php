<?php

namespace App\Http\Controllers\Frontend;

use App\Services\ProductServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $productServices;

    public function __construct(ProductServices $productServices)
    {
        parent::__construct();

        $this->productServices = $productServices;
    }

    public function list(Request $request, $slug)
    {
        $catalog = $this->productServices->findCatalogBySlug($slug);

        $menuActive = $this->productServices->getMenuActive($slug);

        $products = $this->productServices->getAllProductsByParentCatalog($catalog->id);

        return view('product.list', compact('menuActive', 'products'));
    }
}
