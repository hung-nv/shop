@section('title', !empty($option['meta_title']) ? $option['meta_title'] : '')

@section('description', !empty($option['meta_description']) ? $option['meta_description'] : '')

@extends('layouts.app')

@section('content')
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">

                    <div id="hero">
                        <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                            <div class="item" style="background-image: url({{ asset('images/sliders/01.jpg') }});">
                                <div class="container-fluid">
                                    <div class="caption bg-color vertical-center text-left">
                                        <div class="slider-header fadeInDown-1">Bạn có quan tâm?</div>
                                        <div class="big-text fadeInDown-1"> SẢN PHẨM DƯỠNG DA</div>
                                        <div class="excerpt fadeInDown-2 hidden-xs"><span>Mang lại làn da trẻ đẹp cho chị em phụ nữ.</span>
                                        </div>
                                        <div class="button-holder fadeInDown-3">
                                            <a href="/" class="btn-lg btn btn-uppercase btn-primary shop-now-button">
                                                Mua hàng ngay
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="item" style="background-image: url({{ asset('images/sliders/02.jpg') }});">
                                <div class="container-fluid">
                                    <div class="caption bg-color vertical-center text-left">
                                        <div class="slider-header fadeInDown-1">Bạn bị đau dạ dày?</div>
                                        <div class="big-text fadeInDown-1"> Thuốc chống đau dạ dày</span>
                                        </div>
                                        <div class="excerpt fadeInDown-2 hidden-xs">
                                            <span>Yên tâm mỗi khi đi nhậu với bạn bè...</span>
                                        </div>
                                        <div class="button-holder fadeInDown-3">
                                            <a href="#" class="btn-lg btn btn-uppercase btn-primary shop-now-button">
                                                Mua ngay
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- ========================================= SECTION – HERO : END ========================================= -->

                    <!-- ============================================== INFO BOXES ============================================== -->
                    <div class="info-boxes wow fadeInUp">
                        <div class="info-boxes-inner">
                            <div class="row">
                                <div class="col-md-6 col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">Đổi hàng</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">30 ngày kể ngày ngày nhận hàng</h6>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="hidden-md col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">Miễn phí vận chuyển</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">Miễn phí trong nội thành</h6>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-md-6 col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">Sale đặc biệt</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">Giảm 5% toàn bộ sản phẩm</h6>
                                    </div>
                                </div>
                                <!-- .col -->
                            </div>
                            <!-- /.row -->
                        </div>

                    </div>

{{--                    @include('homepage.partial._bannerCatalog')--}}

                    <div class="row">
                        @include('homepage.partial._hotIdeal')

                        @include('homepage.partial._selectedCatalog')
                    </div>

                    <div class="wide-banners wow fadeInUp outer-bottom-xs">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="wide-banner cnt-strip">
                                    <div class="image">
                                        <img class="img-responsive" src="{{ asset('images/banners/home-banner1.jpg') }}" alt="">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="wide-banner cnt-strip">
                                    <div class="image">
                                        <img class="img-responsive" src="{{ asset('images/banners/home-banner2.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($widgetCatalogs)
                        @include('homepage.partial._widgetCatalog')
                    @endif

                </div>
            </div>
            @include('partials._partners')
        </div>
    </div>
@endsection