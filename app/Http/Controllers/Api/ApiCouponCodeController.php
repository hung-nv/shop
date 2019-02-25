<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CheckCouponRequest;
use App\Services\CouponCodeServices;
use App\Http\Controllers\Controller;

class ApiCouponCodeController extends Controller
{
    private $codeServices;

    public function __construct(CouponCodeServices $codeServices)
    {
        parent::__construct();

        $this->codeServices = $codeServices;
    }

    public function checkCouponCode(CheckCouponRequest $request)
    {
        try {
            $response = $this->codeServices->checkCouponCode(strtoupper($request->couponCode));

            return response()->json($response);
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }
}
