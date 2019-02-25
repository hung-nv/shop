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
                <form role="form" method="post" action="/order/store">
                    <div class="shopping-cart">
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

                        <div class="col-md-4 col-sm-12 estimate-ship-tax">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>
                                        <span class="estimate-title">Nhập thông tin</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="info-title control-label">Họ tên <span>*</span></label>
                                            <input class="form-control unicase-form-control text-input" name="name"
                                                   required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="info-title control-label">Số điện thoại <span>*</span></label>
                                            <input class="form-control unicase-form-control text-input" name="telephone"
                                                   required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="info-title control-label">Địa chỉ</label>
                                            <input class="form-control unicase-form-control text-input" name="address"
                                                   required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="info-title control-label">Ghi chú</label>
                                            <textarea class="form-control unicase-form-control" name="note"></textarea>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-4 col-sm-12 estimate-ship-tax">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>
                                        <span class="estimate-title">Nhập mã giảm giá</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control unicase-form-control text-input"
                                                   placeholder="Mã giảm giá.." v-model="couponCode">
                                        </div>
                                        <template v-if="!isCoupon">
                                            <div class="form-group">
                                                <span class="text-danger">Mã Khuyến mại không đúng hoặc đã hết thời gian sử dụng!</span>
                                            </div>
                                        </template>
                                        <div class="clearfix pull-right">
                                            <button type="button" class="btn-upper btn btn-primary"
                                                    v-on:click="checkCouponCode">
                                                APPLY COUPON
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-4 col-sm-12 cart-shopping-total">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="cart-sub-total">
                                            Tiền trước KM<span class="inner-left-md">@{{ getTotalMoney(productsInCart) }} VNĐ</span>
                                        </div>
                                        <div class="cart-grand-total">
                                            Tiền phải trả<span class="inner-left-md">@{{ getTotalMoney(productsInCart) }} VNĐ</span>
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