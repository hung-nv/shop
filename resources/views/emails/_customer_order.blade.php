<h3>Thông tin khách hàng</h3>
Tên: {{ $order->last_name }} <br/>
SĐT: {{ $order->telephone }} <br/>
Địa chỉ: {{ $order->address }} <br/>
Ghi chú: {{ $order->note }} <br/>
Tình trạng: Đơn hàng mới <br/>
Thời gian đặt hàng: {{ $order->created_at }} <br/>

<h3>Thông tin giỏ hàng</h3>
<div class="shopping-cart">
    @include('emails._shopping_cart')

    <div class="col-md-4 col-sm-12 cart-shopping-total">
        <table class="table">
            <thead>
            <tr>
                <th>
                    <div class="cart-sub-total">
                        Tiền trước KM
                        <span class="inner-left-md">
                             {{ number_format($order->total_money) }}VNĐ
                        </span>
                    </div>
                    @if($order->coupon_code)
                        <div class="cart-sub-total apply-coupon">
                            Mã Giảm giá:
                            <span class="inner-left-md">
                                {{ $order->coupon_code }} ({{ $order->coupon_code_value }} %)
                            </span>
                        </div>
                    @endif
                    <div class="cart-grand-total">
                        Tiền phải trả
                        <span class="inner-left-md">
                            {{ number_format($order->total_money - ($order->total_money * $order->coupon_code_value)/100) }} VNĐ
                        </span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
