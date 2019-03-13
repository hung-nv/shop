<?php

namespace App\Http\Controllers\Api;

use App\Services\CustomerServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiCustomerController extends Controller
{
    private $customerServices;

    public function __construct(CustomerServices $customerServices)
    {
        parent::__construct();

        $this->customerServices = $customerServices;
    }

    public function sendPromotion(Request $request)
    {
        try {
            $response = $this->customerServices->sendMailPromotion($request->all());

            return response()->json($response);
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error');
        }
    }
}
