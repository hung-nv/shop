<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
    @if(!empty($selectedCatalogs))
        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
            <div class="more-info-tab clearfix ">
                <h3 class="new-product-title pull-left">New Products</h3>
                <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                    @foreach($selectedCatalogs as $selectedCatalog)
                        <li @if($loop->first) class="active" @endif>
                            <a data-transition-type="backSlide" href="#{{ $selectedCatalog['catalog']->slug }}"
                               data-toggle="tab">{{ $selectedCatalog['catalog']->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="tab-content outer-top-xs">
                @foreach($selectedCatalogs as $selectedCatalog)
                    <div class="tab-pane {{ $loop->first ? "in active" : "" }}"
                         id="{{ $selectedCatalog['catalog']->slug }}">
                        <div class="product-slider">
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="3">
                                @foreach($selectedCatalog['products'] as $product)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="/{{ config('const.prefix.product') }}/{{ $product->slug }}">
                                                            <img src="/img/380_380{{ $product->cover_image }}" alt="">
                                                        </a>
                                                    </div>

                                                    <div class="tag new"><span>new</span></div>
                                                </div>

                                                <div class="product-info text-left">
                                                    <h3 class="name">
                                                        <a href="/{{ config('const.prefix.product') }}/{{ $product->slug }}">{{ $product->name }}</a>
                                                    </h3>
                                                    <div class="rating rateit-small hidden"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        @if($product->new_price)
                                                            <span class="price"> {{ number_format($product->new_price) }}
                                                                Đ </span>
                                                            <span class="price-before-discount">{{ number_format($product->price) }}
                                                                Đ</span>
                                                        @else
                                                            <span class="price"> {{ number_format($product->price) }} </span>
                                                        @endif
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
        </div>
    @endif
</div>