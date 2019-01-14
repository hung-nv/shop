<?php

namespace App\Http\Controllers\Api;

use App\Services\AdvertisingServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiAdvertisingController extends Controller
{
    protected $advertisingServices;

    public function __construct(AdvertisingServices $advertisingServices)
    {
        parent::__construct();
        $this->advertisingServices = $advertisingServices;
    }

    public function deleteImage(Request $request)
    {
        try {
            $response = $this->advertisingServices->deleteImageById($request->key);

            return response()->json($response);
        } catch (NotFoundHttpException $exception) {
            return response()->json($exception->getMessage(), $exception->getStatusCode());
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }
}
