<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SaveCustomerRequest;
use App\Http\Requests\SaveOrderRequest;
use App\Services\OrderServices;
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
            $response = $this->orderServices->customerOrder($request->all());

            return response()->json($response);
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error');
        }
    }

    public function saveCustomer(SaveCustomerRequest $request)
    {
        try {
            $response = $this->orderServices->saveCustomer($request->all());

            return response()->json($response);
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error');
        }
    }
}
