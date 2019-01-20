<?php

namespace App\Http\Controllers\Api;

use App\Services\CommentServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiCommentController extends Controller
{
    private $commentServices;

    public function __construct(CommentServices $commentServices)
    {
        parent::__construct();
        
        $this->commentServices = $commentServices;
    }

    /**
     * Delete category image by category id.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteImage(Request $request)
    {
        try {
            $response = $this->commentServices->deleteImageByCommentId($request->key);

            return response()->json($response);
        } catch (NotFoundHttpException $exception) {
            return response()->json($exception->getMessage(), $exception->getStatusCode());
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }
}
