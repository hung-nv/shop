<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SaveOrderRequest;
use App\Services\OrderServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiOrderController extends Controller
{
    private $orderServices;

    public function __construct(OrderServices $orderServices)
    {
        parent::__construct();

        $this->orderServices = $orderServices;
    }

    public function saveOrder(SaveOrderRequest $request)
    {
        try {
            $response = $this->orderServices->saveOrderPackage($request->all());

            return response()->json($response);
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error');
        }
    }
}
