@component('mail::message')
    @component('mail::panel')
        Thông tin khách hàng
    @endcomponent
    Tên: {{ $order->last_name }} <br/>
    SĐT: {{ $order->telephone }} <br/>
    Địa chỉ: {{ $order->address }} <br/>
    Ghi chú: {{ $order->note }} <br/>
    Tình trạng: Đơn hàng mới <br/>
    Thời gian đặt hàng: {{ $order->created_at }} <br/>

    @component('mail::panel')
        Chi tiết đơn hàng
    @endcomponent

    @component('mail::table')
        | Tên sản phẩm       | Số lượng         | Đơn giá  | Thành tiền |
        | ------------- |:-------------:| -------------:| ----------------:|
        @foreach($order->orderProducts as $product)
            | {{ $product->name }}      | 1     | {{ number_format($product->price) }}      | {{ number_format($product->price * 1) }} VND |
        @endforeach
    @endcomponent

    Tiền trước KM: {{ number_format($order->total_money) }}VNĐ <br/>
    Mã Giảm giá:  {{ $order->coupon_code }} ({{ $order->coupon_code_value }} %) <br/>
    Tiền phải trả: {{ number_format($order->total_money - ($order->total_money * $order->coupon_code_value)/100) }} VNĐ

    Thanks,<br>
    {{ config('app.name') }}

@endcomponent
