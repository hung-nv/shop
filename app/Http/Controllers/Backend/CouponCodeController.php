<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CouponStore;
use App\Services\CouponCodeServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponCodeController extends Controller
{
    private $couponCodeServices;

    public function __construct(CouponCodeServices $couponCodeServices)
    {
        parent::__construct();

        $this->couponCodeServices = $couponCodeServices;
    }

    /**
     * Index coupon code.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $couponCodes = $this->couponCodeServices->getAllCouponCodes();

        return view('backend.couponCode.index', [
            'couponCodes' => $couponCodes
        ]);
    }

    /**
     * Create Coupon Code.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.couponCode.create');
    }

    /**
     * Store Coupon Code.
     * @param CouponStore $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CouponStore $request)
    {
        $response = $this->couponCodeServices->createCouponCode($request->all());

        return redirect()->route('couponCode.index')->with([
            'success' => $response
        ]);
    }
}
