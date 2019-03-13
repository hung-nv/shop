<?php

namespace App\Http\Controllers\Backend;

use App\Services\CustomerServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    private $customerServices;

    public function __construct(CustomerServices $customerServices)
    {
        parent::__construct();

        $this->customerServices = $customerServices;
    }

    public function index()
    {
        $customers = $this->customerServices->getAllCustomer();

        return view('backend.customer.index', compact('customers'));
    }
}
