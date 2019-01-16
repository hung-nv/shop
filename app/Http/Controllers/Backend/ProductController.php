<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\ProductStore;
use App\Http\Requests\ProductUpdate;
use App\Models\Category;
use App\Services\ArticleServices;
use App\Services\ProductServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $productServices, $postServices;

    public function __construct(ProductServices $productServices, ArticleServices $postServices)
    {
        parent::__construct();

        $this->productServices = $productServices;

        $this->postServices = $postServices;
    }

    /**
     * Copy product.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function copy($id)
    {
        $this->productServices->copyProduct($id);

        return redirect()->route('product.index')->with([
            'success' => 'Copy product successful'
        ]);
    }

    /**
     * Copy product and edit.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function copyAndEdit($id)
    {
        $product = $this->productServices->copyProduct($id);

        return redirect()->route('product.edit', ['product' => $product->id]);
    }

    /**
     * Show all products.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->productServices->getProducts();

        $groups = $this->productServices->getGroupsProduct();

        return view('backend.product.index', [
            'products' => $products,
            'groups' => $groups
        ]);
    }

    /**
     * Create products.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function create(Request $request)
    {
        $templateCatalog = $this->postServices->getCheckboxCategory(
            Category::CATALOG_TYPE,
            $request->old('parent')
        );

        $attributes = $this->productServices->getAttributes();

        $name = $request->old('name') ? $request->old('name') : '';
        $slug = $request->old('slug') ? $request->old('slug') : '';
        $productAttributes = $request->old('attribute') ? $request->old('attribute') : '';

        return view('backend.product.create', [
            'templateCatalog' => $templateCatalog,
            'productAttributes' => $productAttributes,
            'attributes' => $attributes,
            'name' => $name,
            'slug' => $slug
        ]);
    }

    /**
     * Create product.
     * @param ProductStore $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(ProductStore $request)
    {
        $response = $this->productServices->createProduct($request);

        return redirect()->route('product.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Edit product.
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function edit(Request $request, $id)
    {
        try {
            $dataProduct = $this->productServices->getDataProduct($request, $id);

            $templateCatalog = $this->postServices->getCheckboxCategory(
                Category::CATALOG_TYPE,
                $dataProduct['parent']
            );

            $attributes = $this->productServices->getAttributes();

            return view('backend.product.update', [
                'product' => $dataProduct['product'],
                'templateCatalog' => $templateCatalog,
                'attributes' => $attributes,
                'productImages' => implode('|', $dataProduct['productImages']),
                'productAttributes' => $dataProduct['productAttribute'],
                'name' => $dataProduct['name'],
                'slug' => $dataProduct['slug']
            ]);
        } catch (\Exception $exception) {
            return abort(404);
        }
    }

    /**
     * Update product.
     * @param ProductUpdate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(ProductUpdate $request, $id)
    {
        $response = $this->productServices->updateProduct($request, $id);

        return redirect()->route('product.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Delete product.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->productServices->deleteProductById($id);

        return redirect()->route('product.index')->with([
            'success' => 'Delete product successful'
        ]);
    }
}
