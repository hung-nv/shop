<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
    <div class="product-item-holder size-big single-product-gallery small-gallery">

        <div id="owl-single-product">
            @foreach($product->images as $productImage)
                <div class="single-product-gallery-item" id="slide{{ $productImage->id }}">
                    <a data-lightbox="image-1" data-title="Gallery" href="{{ $productImage->image }}">
                        <img class="img-responsive" alt="" src="assets/images/blank.gif"
                             data-echo="/img/317_317{{ $productImage->image }}"/>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="single-product-gallery-thumbs gallery-thumbs">
            <div id="owl-single-product-thumbnails">
                @foreach($product->images as $productImage)
                    <div class="item">
                        <a class="horizontal-thumb {{ $loop->first ? "active" : "" }}" data-target="#owl-single-product" data-slide="1"
                           href="#slide{{ $productImage->id }}">
                            <img class="img-responsive" width="85" alt="" src="assets/images/blank.gif"
                                 data-echo="/img/68_68{{ $productImage->image }}"/>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>