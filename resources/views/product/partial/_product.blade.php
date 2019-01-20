<div class='col-md-9'>
    <div class="detail-block">
        <div class="row  wow fadeInUp">

            @include('product.partial._slideImage')
            <div class='col-sm-6 col-md-7 product-info-block'>
                <div class="product-info">
                    <h1 class="name">{{ $product->name }}</h1>

                    <div class="stock-container info-container m-t-10">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="stock-box">
                                    <span class="label">Tình trạng :</span>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="stock-box">
                                    <span class="value">{{ $product->in_stock ? "Còn hàng" : "Hết hàng" }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="description-container m-t-20">
                        {{ $product->description }}
                    </div>

                    <div class="price-container info-container m-t-20">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="price-box">
                                    @if($product->new_price)
                                        <span class="price">{{ number_format($product->new_price) }} VNĐ</span>
                                        <span class="price-strike">{{ number_format($product->price) }}</span>
                                    @else
                                        <span class="price">{{ number_format($product->price) }} VNĐ</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="favorite-button m-t-10">
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                                        <i class="fa fa-signal"></i>
                                    </a>
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                </div>
                            </div>

                        </div><!-- /.row -->
                    </div><!-- /.price-container -->

                    <div class="quantity-container info-container">
                        <div class="row">

                            <div class="col-sm-2">
                                <span class="label">Số lượng:</span>
                            </div>

                            <div class="col-sm-2">
                                <div class="cart-quantity">
                                    <div class="quant-input">
                                        <div class="arrows">
                                            <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                            <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                        </div>
                                        <input type="text" value="1">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> Mua hàng</a>
                            </div>
                        </div>
                    </div>

                </div><!-- /.product-info -->
            </div><!-- /.col-sm-7 -->
        </div><!-- /.row -->
    </div>

    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
        <div class="tab-pane">
            <div class="product-content">
                {!! $product->content !!}
            </div>
        </div>
    </div><!-- /.product-tabs -->

    @include('product.partial._newProduct')
</div>