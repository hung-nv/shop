@section('title', 'Giỏ hàng và thanh toán')

@section('description', 'Giỏ hàng và thanh toán')

@extends('layouts.app')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/">Trang chủ</a></li>
                    <li class='active'>Giỏ hàng và thanh toán</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row ">
                <form role="form" method="post" action="/order/store" id="frm-customer">
                    <div class="shopping-cart">
                        @include('order.partial._shopping_cart')

                        @include('order.partial._form_customer')

                        @include('order.partial._form_coupon_code')

                        <div class="col-md-4 col-sm-12 cart-shopping-total">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="cart-sub-total">
                                            Tiền trước KM
                                            <span class="inner-left-md">
                                                @{{ reFormatPrice(getTotalMoney(productsInCart)) }} VNĐ
                                            </span>
                                        </div>
                                        <template v-if="couponCodeSale">
                                            <div class="cart-sub-total apply-coupon">
                                                Giảm giá:
                                                <span class="inner-left-md">
                                                    @{{ reFormatPrice(getBalanceSale(productsInCart)) }} VNĐ (@{{ couponCodeSale }} %)
                                                </span>
                                            </div>
                                        </template>
                                        <div class="cart-grand-total">
                                            Tiền phải trả
                                            <span class="inner-left-md">
                                                @{{ reFormatPrice(getTotalMoney(productsInCart) - getBalanceSale(productsInCart)) }} VNĐ
                                            </span>
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="cart-checkout-btn pull-right">
                                            <button type="submit" class="btn btn-primary checkout-btn">
                                                ĐẶT HÀNG NGAY
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>

            @include('partials._partners')
        </div>
    </div>
@endsection