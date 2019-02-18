<?php

namespace App\Services;

use App\Models\CouponCode;

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
}