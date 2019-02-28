<div class="shopping-cart-table ">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th class="cart-romove item">Xóa</th>
                <th class="cart-description item">Ảnh sản phẩm</th>
                <th class="cart-product-name item">Tên sản phẩm</th>
                <th class="cart-qty item">Số lượng</th>
                <th class="cart-sub-total item">Đơn giá</th>
                <th class="cart-total last-item">Thành tiền</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <td colspan="6">
                    <div class="shopping-cart-btn">
                        <span class="">
                            <a href="/" class="btn btn-upper btn-primary outer-left-xs">Tiếp tục mua hàng</a>
                        </span>
                    </div>
                </td>
            </tr>
            </tfoot>
            <tbody>
            <template v-for="(product, index) in productsInCart">
                <tr>
                    <td class="romove-item">
                        <a v-on:click="removeFromCart(index, $event)" title="cancel"
                           class="icon">
                            <i class="fa fa-trash-o"></i></a>
                    </td>
                    <td class="cart-image">
                        <a class="entry-thumbnail" :href="product.url">
                            <img :src="'/img/100_100' + product.thumb" alt="">
                        </a>
                    </td>
                    <td class="cart-product-name-info">
                        <h4 class='cart-product-description'>
                            <a :href="product.url">@{{ product.name }}</a>
                        </h4>
                    </td>
                    <td class="cart-product-quantity">
                        <div class="quant-input">
                            <div class="arrows">
                                <div class="arrow plus gradient">
                                    <span class="ir"><i class="icon fa fa-sort-asc"></i></span>
                                </div>
                                <div class="arrow minus gradient">
                                    <span class="ir"><i class="icon fa fa-sort-desc"></i></span>
                                </div>
                            </div>
                            <input type="text" v-model="productsInCart[index].quantity">
                        </div>
                    </td>
                    <td class="cart-product-sub-total">
                        <span class="cart-sub-total-price">@{{ reFormatPrice(product.price) }}</span>
                    </td>
                    <td class="cart-product-grand-total">
                        <span class="cart-grand-total-price">@{{ reFormatPrice(product.price * product.quantity) }}</span>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</div>