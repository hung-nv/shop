<h3 class="section-title">Sản phẩm nổi bật</h3>
<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
    @foreach($hotProducts as $hotProduct)
        <div class="item">
            <div class="products">
                <div class="hot-deal-wrapper">
                    <div class="image">
                        <img src="/img/223_223{{ $hotProduct->cover_image }}" alt="">
                    </div>
                    <div class="sale-offer-tag"><span>{{ $hotProduct->sale_off }}%<br>off</span></div>
                </div>

                <div class="product-info text-left m-t-20">
                    <h3 class="name"><a href="{{ $hotProduct->url }}">{{ $hotProduct->name }}</a></h3>
                    <div class="product-price">
                        @if($hotProduct->new_price)
                            <span class="price">{{ number_format($hotProduct->new_price) }} VNĐ</span>
                            <span class="price-before-discount">{{ number_format($hotProduct->price) }}</span>
                        @else
                            <span class="price">{{ number_format($hotProduct->price) }} VNĐ</span>
                        @endif
                    </div>
                </div>

                <div class="cart clearfix animate-effect">
                    <div class="action">
                        <div class="add-cart-button btn-group">
                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                <i class="fa fa-shopping-cart"></i>
                            </button>
                            <button class="btn btn-primary cart-btn" type="button"
                                    v-on:click="addToCard({{ $hotProduct->id }}, $event)"
                                    :data-name="'{{ $hotProduct->name }}'"
                                    :data-thumb="'/img/46_46{{ $hotProduct->cover_image }}'"
                                    :data-price="'{{ $hotProduct->current_price }}'">
                                Thêm vào giỏ
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>