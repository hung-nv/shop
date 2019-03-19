<h3>Thông tin khách hàng</h3>
<div style="padding: 20px 0;">
    <p><b>Tên: </b>{{ $order->last_name }} </p>
    <p><b>SĐT: </b>{{ $order->telephone }} </p>
    <p><b>Địa chỉ: </b>{{ $order->address }} </p>
    @if($order->note)
        <p><b>Ghi chú: </b>{{ $order->note }} </p>
    @endif
    <p><b>Tình trạng: </b>Đơn hàng mới </p>
    <p><b>Thời gian đặt hàng: </b>{{ $order->created_at }} </p>
</div>
<br/>

<h3>Thông tin giỏ hàng</h3>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#ccc">
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

<div style="padding: 20px 0">
    <p>
        <b>Tiền trước KM:</b>
        {{ number_format($order->total_money) }} VNĐ
    </p>
    <p>
        <b>Mã Giảm giá:</b>
        {{ $order->coupon_code }} ({{ $order->coupon_code_value }} %)
    </p>
    <p>
        <b>Tiền phải trả:</b>
        {{ number_format($order->total_money - ($order->total_money * $order->coupon_code_value)/100) }} VNĐ
    </p>
</div>

<br />
Thanks,
