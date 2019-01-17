<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AddProductGroup;
use App\Services\ProductServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiProductController extends Controller
{
    private $productServices;

    public function __construct(ProductServices $productServices)
    {
        parent::__construct();
        $this->productServices = $productServices;
    }

    /**
     * Delete product image.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteImage(Request $request)
    {
        try {
            $response = $this->productServices->deleteProductImageById($request->key);

            return response()->json($response,200);
        } catch (NotFoundHttpException $exception) {
            return response()->json($exception->getMessage(), $exception->getStatusCode());
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }

    /**
     * Set product cover image.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setCoverImage(Request $request)
    {
        try {
            $response = $this->productServices->setProductCoverImage(
                $request->product_id,
                $request->image
            );

            return response()->json($response,200);
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }

    /**
     * Add Product to group.
     * @param AddProductGroup $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addGroup(AddProductGroup $request)
    {
        try {
            $response = $this->productServices->addProductToGroup(
                $request->product_id,
                $request->group_id,
                $request->group_name
            );

            return response()->json(['message' => $response],200);
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }

    public function removeGroup(AddProductGroup $request)
    {
        try {
            $response = $this->productServices->removeProductFromGroup(
                $request->product_id,
                $request->group_id,
                $request->group_name
            );

            return response()->json(['message' => $response],200);
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }
}
