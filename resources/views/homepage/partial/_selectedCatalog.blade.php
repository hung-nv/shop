<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
    <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
        <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">New Products</h3>
            @if($selectedCatalogs)
                <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                    @foreach($selectedCatalogs as $item)
                        <li @if($loop->first) class="active" @endif>
                            <a data-transition-type="backSlide" href="#{{ $item['catalog']->slug }}" data-toggle="tab">
                                {{ $item['catalog']->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="tab-content outer-top-xs">
            @foreach($selectedCatalogs as $item)
                <div class="tab-pane @if($loop->first) in active @endif" id="{{ $item['catalog']->slug }}">
                    <div class="product-slider">
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="3">

                            @foreach($item['products'] as $product)
                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                                                        <img src="{{ $product->cover_image }}" alt="">
                                                    </a>
                                                </div>

                                                <div class="tag new"><span>new</span></div>
                                            </div>

                                            <div class="product-info text-left">
                                                <h3 class="name">
                                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price">
                                                    <span class="price"> {{ number_format($product->new_price) }}
                                                        VNĐ </span>
                                                    <span class="price-before-discount">{{ number_format($product->price) }}</span>
                                                </div>

                                            </div>
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" data-toggle="dropdown"
                                                                    type="button">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </button>
                                                            <button class="btn btn-primary cart-btn" type="button">
                                                                Add to cart
                                                            </button>
                                                        </li>
                                                        <li class="lnk wishlist">
                                                            <a class="add-to-cart" href="detail.html" title="Wishlist">
                                                                <i class="icon fa fa-heart"></i>
                                                            </a>
                                                        </li>
                                                        <li class="lnk">
                                                            <a class="add-to-cart" href="detail.html" title="Compare">
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
                    </div>
                </div>
            @endforeach

        </div>
        <!-- /.tab-content -->
    </div>
</div>