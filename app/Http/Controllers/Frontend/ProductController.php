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
        $verifyFilter = $this->productServices->verifyFilters($request->all());

        if ($verifyFilter) {
            return redirect('/');
        }

        $catalog = $this->productServices->findCatalogBySlug($slug);

        $menuActive = $this->productServices->getMenuActive($slug);

        $products = $this->productServices->getAllProductsByParentCatalog($catalog->id, $request->all());

        return view('product.list', compact('menuActive', 'products', 'catalog'));
    }

    public function details($slug)
    {
        $product = $this->productServices->findProductBySlug($slug);

        $newProducts = $this->productServices->getNewProduct(10);

        return view('product.show', compact('product', 'newProducts'));
    }
}
