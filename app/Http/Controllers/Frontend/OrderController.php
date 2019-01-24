<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkout(Request $request)
    {
        return view('order.checkout');
    }
}
