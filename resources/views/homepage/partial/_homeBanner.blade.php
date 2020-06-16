<div id="hero">
    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
        @if(!empty($option['banner_image_1']))
            <div class="item" style="background-image: url({{ asset($option['banner_image_1']) }});">
                <div class="container-fluid">
                    <div class="caption bg-color vertical-center text-left">
                        @if(!empty($option['banner_1_text_line_1']))
                            <div class="slider-header fadeInDown-1">{{ $option['banner_1_text_line_1'] }}</div>
                        @endif
                        @if(!empty($option['banner_1_text_line_2']))
                            <div class="big-text fadeInDown-1">{{ $option['banner_1_text_line_2'] }}</div>
                        @endif
                        @if(!empty($option['banner_1_text_line_3']))
                            <div class="excerpt fadeInDown-2 hidden-xs">
                                <span>{{ $option['banner_1_text_line_3'] }}</span>
                            </div>
                        @endif

                        @if(!empty($option['banner_link_1']))
                            <div class="button-holder fadeInDown-3">
                                <a href="{{ $option['banner_link_1'] }}"
                                   class="btn-lg btn btn-uppercase btn-primary shop-now-button">
                                    Mua ngay
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        @if(!empty($option['banner_image_2']))
            <div class="item" style="background-image: url({{ asset($option['banner_image_2']) }});">
                <div class="container-fluid">
                    <div class="caption bg-color vertical-center text-left">
                        @if(!empty($option['banner_2_text_line_1']))
                            <div class="slider-header fadeInDown-1">{{ $option['banner_2_text_line_1'] }}</div>
                        @endif
                        @if(!empty($option['banner_2_text_line_2']))
                            <div class="big-text fadeInDown-1">
                                {{ $option['banner_2_text_line_2'] }}
                            </div>
                        @endif
                        @if(!empty($option['banner_2_text_line_3']))
                            <div class="excerpt fadeInDown-2 hidden-xs">
                                <span>{{ $option['banner_2_text_line_3'] }}</span>
                            </div>
                        @endif
                        @if(!empty($option['banner_link_2']))
                            <div class="button-holder fadeInDown-3">
                                <a href="{{ $option['banner_link_2'] }}"
                                   class="btn-lg btn btn-uppercase btn-primary shop-now-button">
                                    Mua ngay
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

@if(!empty($option['special_1_line_1']) || !empty($option['special_2_line_1']) || !empty($option['special_3_line_1']))
    <div class="info-boxes wow fadeInUp">
        <div class="info-boxes-inner">
            <div class="row">
                <div class="col-md-6 col-sm-4 col-lg-4">
                    <div class="info-box">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4 class="info-box-heading green">
                                    {{ isset($option['special_1_line_1']) ? $option['special_1_line_1'] : '' }}
                                </h4>
                            </div>
                        </div>
                        <h6 class="text">
                            {{ isset($option['special_1_line_2']) ? $option['special_1_line_2'] : '' }}
                        </h6>
                    </div>
                </div>
                <!-- .col -->

                <div class="hidden-md col-sm-4 col-lg-4">
                    <div class="info-box">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4 class="info-box-heading green">
                                    {{ isset($option['special_2_line_1']) ? $option['special_2_line_1'] : '' }}
                                </h4>
                            </div>
                        </div>
                        <h6 class="text">
                            {{ isset($option['special_2_line_2']) ? $option['special_2_line_2'] : '' }}
                        </h6>
                    </div>
                </div>
                <!-- .col -->

                <div class="col-md-6 col-sm-4 col-lg-4">
                    <div class="info-box">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4 class="info-box-heading green">
                                    {{ isset($option['special_3_line_1']) ? $option['special_3_line_1'] : '' }}
                                </h4>
                            </div>
                        </div>
                        <h6 class="text">
                            {{ isset($option['special_3_line_2']) ? $option['special_3_line_2'] : '' }}
                        </h6>
                    </div>
                </div>
                <!-- .col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
@endif