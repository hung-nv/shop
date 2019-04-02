@foreach($widgetCatalogs as $itemWidget)
    <section class="section featured-product wow fadeInUp">
        <h3 class="section-title">{{ $itemWidget['catalog']->name }}</h3>
        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

            @foreach($itemWidget['products'] as $product)
                <div class="item item-carousel">
                    <div class="products">
                        <div class="product">
                            <div class="product-image">
                                <div class="image">
                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                                        <img src="/img/380_420{{ $product->cover_image }}" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="product-info text-left">
                                <h3 class="name">
                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <div class="rating rateit-small hidden"></div>
                                <div class="description"></div>
                                <div class="product-price">
                                    <span class="price"> {{ number_format($product->new_price) }} Đ </span>
                                    <span class="price-before-discount">{{ number_format($product->price) }} Đ</span>
                                </div>

                            </div>
                            <!-- /.product-info -->
                            <div class="cart clearfix animate-effect hidden">
                                <div class="action">
                                    <ul class="list-unstyled">
                                        <li class="add-cart-button btn-group">
                                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                            <button class="btn btn-primary cart-btn" type="button">
                                                Add to cart
                                            </button>
                                        </li>
                                        <li class="lnk wishlist">
                                            <a class="add-to-cart" href="#" title="Wishlist">
                                                <i class="icon fa fa-heart"></i>
                                            </a>
                                        </li>
                                        <li class="lnk">
                                            <a class="add-to-cart" href="#" title="Compare">
                                                <i class="fa fa-signal" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endforeach