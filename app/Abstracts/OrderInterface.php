<?php

namespace App\Abstracts;


interface OrderInterface
{
    public function saveOrder($dataRequest);

    public function saveOrderProducts($order, $productsInCart);
}