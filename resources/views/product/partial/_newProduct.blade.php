@if(!empty($newProducts))
    <section class="section featured-product wow fadeInUp">
        <h3 class="section-title">Sản phẩm mới</h3>
        <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
            @foreach($newProducts as $newProduct)
                <div class="item item-carousel">
                    <div class="products">
                        <div class="product">
                            <div class="product-image">
                                <div class="image">
                                    <a href="{{ $newProduct->url }}"><img src="/img/148_148{{ $newProduct->cover_image }}" alt=""></a>
                                </div>
                                <div class="tag new"><span>new</span></div>
                            </div>

                            <div class="product-info text-left">
                                <h3 class="name"><a href="{{ $newProduct->url }}">{{ $newProduct->name }}</a></h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>

                                <div class="product-price">
                                    @if($newProduct->new_price)
                                        <span class="price">{{ number_format($newProduct->new_price) }} VNĐ</span>
                                        <span class="price-before-discount">{{ number_format($newProduct->price) }}</span>
                                    @else
                                        <span class="price">{{ number_format($newProduct->price) }} VNĐ</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endif