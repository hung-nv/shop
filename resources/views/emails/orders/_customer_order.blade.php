#Thông tin khách hàng

Tên: {{ $order->last_name }}
SĐT: {{ $order->telephone }}
Địa chỉ: {{ $order->address }}
Ghi chú: {{ $order->note }}
Tình trạng: Đơn hàng mới
Thời gian đặt hàng: {{ $order->created_at }}


###Chi tiết đơn hàng

@component('mail::table')
    | Tên sản phẩm | Số lượng | Đơn giá | Thành tiền |
    | ------------ | -------- | ------- | ---------- |
    @foreach($order->orderProducts as $product)
        | {{ $product->name }} | 1 | {{ number_format($product->price) }} | {{ number_format($product->price * 1) }} VND |
    @endforeach
@endcomponent

Tiền trước KM: {{ number_format($order->total_money) }}VNĐ
Mã Giảm giá:  {{ $order->coupon_code }} ({{ $order->coupon_code_value }} %)
Tiền phải trả: {{ number_format($order->total_money - ($order->total_money * $order->coupon_code_value)/100) }} VNĐ

Thanks,