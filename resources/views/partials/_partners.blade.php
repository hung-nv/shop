@if(!empty($partners))
    <div id="brands-carousel" class="logo-slider wow fadeInUp">
        <div class="logo-slider-inner">
            <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                @foreach($partners as $partner)
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="/img/160_110{{ $partner->content }}"
                                 src="{{ asset('images/blank.gif') }}" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif