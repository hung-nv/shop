<?php

namespace App\Utilities;


trait OrderTrait
{
    /**
     * Calculate total money of cart
     * @param array $productsInCart
     * @return float|int
     */
    public function calculateTotalMoney($productsInCart)
    {
        $totalMoney = 0;

        if ($productsInCart) {
            foreach ($productsInCart as $product) {
                $totalMoney += ($product['quantity'] * $product['price']);
            }
        }

        return $totalMoney;
    }

    /**
     * Calculate quantities of products in cart.
     * @param array $productsInCart
     * @return int
     */
    public function calculateQuantities($productsInCart)
    {
        $quantities = 0;

        if ($productsInCart) {
            foreach ($productsInCart as $product) {
                $quantities += $product['quantity'];
            }
        }

        return $quantities;
    }

    /**
     * Calculate money with coupon.
     * @param $money
     * @param $coupon
     * @return float|int
     */
    public function calculateMoneyWithCoupon($money, $coupon)
    {
        if ($coupon) {
            $money = $money - ($money * $coupon) / 100;
        }

        return $money;
    }
}