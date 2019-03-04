<?php

namespace App\Services;


use App\Models\Order;
use App\Models\Product;
use App\Utilities\OrderTrait;
use Illuminate\Support\Facades\DB;

class OrderServices
{
    use OrderTrait;

    /**
     * Customer order.
     * @param $dataRequest
     * @return Order|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function customerOrder($dataRequest)
    {
        try {
            DB::beginTransaction();

            $response = $this->saveOrderPackage($dataRequest);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    /**
     * Save order package
     * @param array $dataRequest
     * @return Order|\Illuminate\Database\Eloquent\Model
     */
    public function saveOrderPackage($dataRequest)
    {
        $order = $this->saveOrder($dataRequest);

        $this->saveOrderProducts($order, $dataRequest['products']);

        //TODO: send mail after save order

        return $order;
    }

    /**
     * Save order.
     * @param array $dataRequest
     * @return Order|\Illuminate\Database\Eloquent\Model
     */
    public function saveOrder($dataRequest)
    {
        $dataRequest['last_name'] = $dataRequest['name'];
        // set status default is: wait to confirm.
        $dataRequest['status'] = 1;

        if ($dataRequest['couponCode'] and $dataRequest['couponCodeSale']) {
            $dataRequest['coupon_code'] = $dataRequest['couponCode'];
            $dataRequest['coupon_code_value'] = $dataRequest['couponCodeSale'];
        }

        $dataRequest['total_money'] = $this->calculateTotalMoney($dataRequest['products']);

        $order = Order::create($dataRequest);

        return $order;
    }

    /**
     * @param $order
     * @param $productsInCart
     */
    public function saveOrderProducts($order, $productsInCart)
    {
        if ($productsInCart) {
            foreach ($productsInCart as $product) {
                $originProduct = Product::find($product['id'])->toArray();

                $order->orderProducts()->attach($product['id'], [
                    'quantities' => $product['quantity'],
                    'price' => $product['price'],
                    'product_name' => $product['name'],
                    'product_image' => $product['thumb'],
                    'product_sku' => $originProduct['sku']
                ]);
            }
        }
    }
}