<h3>Thông tin khách hàng</h3>
Tên: {{ $order->last_name }} <br/>
SĐT: {{ $order->telephone }} <br/>
Địa chỉ: {{ $order->address }} <br/>
Ghi chú: {{ $order->note }} <br/>
Tình trạng: Đơn hàng mới <br/>
Thời gian đặt hàng: {{ $order->created_at }} <br/>

<h3>Thông tin giỏ hàng</h3>
<table>
    <thead>
    <tr>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thành tiền</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        @foreach($order->orderProducts as $product)
            <td>{{ $product->name }}</td>
            <td>1</td>
            <td>{{ number_format($product->price) }}</td>
            <td>{{ number_format($product->price) }}</td>
        @endforeach
    </tr>
    </tbody>
</table>

Tiền trước KM: {{ number_format($order->total_money) }}VNĐ <br />
Mã Giảm giá:  {{ $order->coupon_code }} ({{ $order->coupon_code_value }} %) <br />
Tiền phải trả: {{ number_format($order->total_money - ($order->total_money * $order->coupon_code_value)/100) }} VNĐ <br />

Thanks,
