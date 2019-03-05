<div class="shopping-cart-table ">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th class="cart-description item">Ảnh sản phẩm</th>
                <th class="cart-product-name item">Tên sản phẩm</th>
                <th class="cart-qty item">Số lượng</th>
                <th class="cart-sub-total item">Đơn giá</th>
                <th class="cart-total last-item">Thành tiền</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->orderProducts as $product)
                <tr>
                    <td class="cart-image">
                        <a class="entry-thumbnail" :href="product.url">
                            <img src="{{ $product->product_image }}" alt="">
                        </a>
                    </td>
                    <td class="cart-product-name-info">
                        <h4 class='cart-product-description'>
                            {{ $product->product_name }}
                        </h4>
                    </td>
                    <td class="cart-product-quantity">
                        {{ $product->quantities }}
                    </td>
                    <td class="cart-product-sub-total">
                        <span class="cart-sub-total-price">{{ number_format($product->price) }}</span>
                    </td>
                    <td class="cart-product-grand-total">
                        <span class="cart-grand-total-price">{{ number_format($product->price * $product->quantities) }} VND</span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>