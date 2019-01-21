<div class='col-md-3 sidebar'>
    <div class="sidebar-module-container">
        @if(!empty($hotProducts))
            <div class="sidebar-widget hot-deals wow fadeInUp">
                <h3 class="section-title">Sản phẩm nổi bật</h3>
                <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
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
                                    <h3 class="name"><a href="detail.html">{{ $hotProduct->name }}</a></h3>
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
                                            <button class="btn btn-primary cart-btn" type="button">Mua ngay</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @endif

    <!-- ============================================== NEWSLETTER ============================================== -->
        <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
            <h3 class="section-title">Newsletters</h3>
            <div class="sidebar-widget-body outer-top-xs">
                <p>Sign Up for Our Newsletter!</p>
                <form>
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"
                               placeholder="Subscribe to our newsletter">
                    </div>
                    <button class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>

        @if(!empty($comments))
            <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
                <div id="advertisement" class="advertisement">
                    @foreach($comments as $comment)
                        <div class="item">
                            <div class="avatar"><img src="/img/156_156{{ $comment->avatar }}" alt="Image"></div>
                            <div class="testimonials"><em>"</em>{{ $comment->content }}<em>"</em></div>
                            <div class="clients_author">{{ $comment->name }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>