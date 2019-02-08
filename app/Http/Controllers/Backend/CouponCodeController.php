<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponCodeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        return view('backend.couponCode.index');
    }

    public function create()
    {
        return view('backend.couponCode.create');
    }
}
