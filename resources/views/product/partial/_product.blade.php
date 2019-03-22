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

                            <div class="col-sm-offset-6 hidden">
                                <div class="favorite-button m-t-10">
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                       title="Wishlist" href="#">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                       title="Add to Compare" href="#">
                                        <i class="fa fa-signal"></i>
                                    </a>
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                       title="E-mail" href="#">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                </div>
                            </div>

                        </div><!-- /.row -->
                    </div><!-- /.price-container -->

                    <div class="quantity-container info-container">
                        <div class="row">
                            <div class="col-sm-12">
                                <a v-on:click="addToCard({{ $product->id }}, $event)" class="btn btn-primary"
                                   :data-name="'{{ $product->name }}'"
                                   :data-url="'{{ $product->url }}'"
                                   :data-thumb="'{{ $product->cover_image }}'"
                                   :data-price="'{{ $product->current_price }}'">
                                    <i class="fa fa-shopping-cart inner-right-vs"></i>
                                    Thêm vào giỏ
                                </a>

                                <a class="btn btn-primary checkout-btn">
                                    Thanh toán
                                </a>
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
    </div>

    @include('product.partial._terms')

    @include('product.partial._newProduct')
</div>