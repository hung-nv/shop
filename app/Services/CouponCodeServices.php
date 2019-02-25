<?php

namespace App\Services;

use App\Models\CouponCode;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CouponCodeServices
{
    /**
     * Get all coupon codes.
     * @return CouponCode[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllCouponCodes()
    {
        return CouponCode::all();
    }

    /**
     * Create Coupon Code.
     * @param $dataRequest
     * @return string
     */
    public function createCouponCode($dataRequest)
    {
        list($dataRequest['start_date'], $dataRequest['end_date']) = $this->formatDateBeforeSave($dataRequest['dates']);

        $dataRequest['code'] = $this->generateRandomString(5);

        CouponCode::create($dataRequest);

        return 'Create successful';
    }

    /**
     * Update Coupon Code.
     * @param $dataRequest
     * @param $couponCodeId
     * @return string
     */
    public function updateCouponCode($dataRequest, $couponCodeId)
    {
        $couponCode = CouponCode::find($couponCodeId);

        list($dataRequest['start_date'], $dataRequest['end_date']) = $this->formatDateBeforeSave($dataRequest['dates']);

        $couponCode->update($dataRequest);

        return 'Create successful';
    }

    /**
     * Format date before save.
     * @param string $dataRanger
     * @return array
     */
    private function formatDateBeforeSave($dataRanger)
    {
        $dataRanger = explode(' - ', $dataRanger);

        // format start date.
        $startDate = date('Y-m-d', strtotime($dataRanger[0]));

        // format end date.
        $endDate = date('Y-m-d', strtotime($dataRanger[1]));

        return [$startDate, $endDate];
    }

    /**
     * Generate random string by length.
     * @param int $length
     * @return string
     */
    private function generateRandomString($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    /**
     * Find Coupon Code.
     * @param $couponCodeId
     * @return CouponCode|CouponCode[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findCouponCodeById($couponCodeId)
    {
        return CouponCode::find($couponCodeId);
    }

    /**
     * Delete coupon Code.
     * @param $couponCodeId
     * @return bool|null
     * @throws \Exception
     */
    public function deleteCouponCode($couponCodeId)
    {
        return CouponCode::find($couponCodeId)->delete();
    }

    /**
     * Check coupon code.
     * @param $couponName
     * @return array
     * @throws \Exception
     */
    public function checkCouponCode($couponName)
    {
        $couponCode = CouponCode::findCouponCodeByName($couponName);

        if (!$couponCode) {
            throw new \Exception('Not Found coupon code');
        }

        return $couponCode->toArray();
    }
}