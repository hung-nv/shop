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
                <!-- /.nav-tabs -->
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
                                                        <a href="#">
                                                            <img src="/img/258_258{{ $product->cover_image }}" alt="">
                                                        </a>
                                                    </div>
                                                    <!-- /.image -->

                                                    <div class="tag new"><span>new</span></div>
                                                </div>

                                                <div class="product-info text-left">
                                                    <h3 class="name">
                                                        <a href="#">{{ $product->name }}</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        @if($product->new_price)
                                                            <span class="price"> {{ number_format($product->new_price) }} VNĐ </span>
                                                            <span class="price-before-discount">{{ number_format($product->price) }} VNĐ</span>
                                                        @else
                                                            <span class="price"> {{ number_format($product->price) }} </span>
                                                        @endif
                                                    </div>

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect hidden">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button data-toggle="tooltip"
                                                                        class="btn btn-primary icon"
                                                                        type="button" title="Add Cart"><i
                                                                            class="fa fa-shopping-cart"></i></button>
                                                                <button class="btn btn-primary cart-btn" type="button">
                                                                    Add
                                                                    to
                                                                    cart
                                                                </button>
                                                            </li>
                                                            <li class="lnk wishlist"><a data-toggle="tooltip"
                                                                                        class="add-to-cart"
                                                                                        href="detail.html"
                                                                                        title="Wishlist"> <i
                                                                            class="icon fa fa-heart"></i> </a></li>
                                                            <li class="lnk"><a data-toggle="tooltip" class="add-to-cart"
                                                                               href="detail.html" title="Compare"> <i
                                                                            class="fa fa-signal" aria-hidden="true"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
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