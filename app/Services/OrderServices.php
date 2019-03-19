<?php

namespace App\Services;

use App\Abstracts\OrderInterface;
use App\Mail\CustomerOrder;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Utilities\OrderTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class OrderServices implements OrderInterface
{
    use OrderTrait;

    public function testSendMail($dataRequest, $option = null)
    {
        //send mail.
        $mailTo = 'hungnv6933@co-well.com.vn';
        return Mail::to($mailTo)->send(new TestMail());
    }

    /**
     * Customer order.
     * @param array $dataRequest
     * @param array $option
     * @return Order|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function customerOrder($dataRequest, $option)
    {
        try {
            DB::beginTransaction();

            $response = $this->saveOrderPackage($dataRequest, $option);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    /**
     * Save order package
     * @param array $dataRequest
     * @param array $option
     * @return Order|\Illuminate\Database\Eloquent\Model
     */
    public function saveOrderPackage($dataRequest, $option)
    {
        $order = $this->saveOrder($dataRequest);

        $this->saveOrderProducts($order, $dataRequest['products']);

        //send mail.
//        if (!empty($option['email'])) {
            $option['email'] = 'hungnv234@outlook.com';
//        }

        Mail::to($option['email'])->send(new CustomerOrder($order));

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

    /**
     * Save customer information.
     * @param array $dataRequest
     * @return Customer|\Illuminate\Database\Eloquent\Model
     */
    public function saveCustomer($dataRequest)
    {
        return Customer::create($dataRequest);
    }
}