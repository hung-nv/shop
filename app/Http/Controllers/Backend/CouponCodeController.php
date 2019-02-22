<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CouponStore;
use App\Http\Requests\CouponUpdate;
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

    /**
     * Edit coupon code.
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $couponCode = $this->couponCodeServices->findCouponCodeById($id);

        $dateStorage = date('m/d/Y', strtotime($couponCode->start_date)) . ' - '
            . date('m/d/Y', strtotime($couponCode->end_date));

        $dateRanger = $dateStorage ? $dateStorage : $request->dates;

        return view('backend.couponCode.update', [
            'couponCode' => $couponCode,
            'dateRanger' => $dateRanger
        ]);
    }

    /**
     * Update coupon code.
     * @param CouponUpdate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CouponUpdate $request, $id)
    {
        $response = $this->couponCodeServices->updateCouponCode($request->all(), $id);

        return redirect()->route('couponCode.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Delete coupon code.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->couponCodeServices->deleteCouponCode($id);

        return redirect()->route('couponCode.index')->with([
            'success' => $response
        ]);
    }
}
