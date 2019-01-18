<div class="tab-pane active " id="grid-container">
    <div class="category-product">
        <div class="row">
            @if(!empty($products))
                @foreach($products as $product)
                    <div class="col-sm-6 col-md-4 wow fadeInUp">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image">
                                        <a href="{{ $product->url }}">
                                            <img src="/img/249_249{{ $product->cover_image }}" alt="">
                                        </a>
                                    </div>
                                </div>

                                <div class="product-info text-left">
                                    <h3 class="name">
                                        <a href="{{ $product->url }}">{{ $product->name }}</a>
                                    </h3>
                                    <div class="rating rateit-small"></div>
                                    <div class="description"></div>
                                    <div class="product-price">
                                        @if($product->new_price)
                                            <span class="price"> {{ number_format($product->new_price) }} VNĐ</span>
                                            <span class="price-before-discount">{{ number_format($product->price) }} VNĐ</span>
                                        @else
                                            <span class="price"> {{ number_format($product->price) }} VNĐ</span>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.product-info -->
                                <div class="cart clearfix animate-effect hidden">
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
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>