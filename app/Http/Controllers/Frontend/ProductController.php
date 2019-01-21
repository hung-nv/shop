<?php

namespace App\Http\Controllers\Frontend;

use App\Services\CommentServices;
use App\Services\ProductServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $productServices;

    private $commentServices;

    public function __construct(ProductServices $productServices, CommentServices $commentServices)
    {
        parent::__construct();

        $this->productServices = $productServices;

        $this->commentServices = $commentServices;
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
        $comments = $this->commentServices->getAllComment();

        $product = $this->productServices->findProductBySlug($slug);

        $newProducts = $this->productServices->getNewProduct(10);

        $hotProducts = $this->productServices->getHotProducts(5);

        return view('product.show', compact('product', 'newProducts', 'comments', 'hotProducts'));
    }
}
