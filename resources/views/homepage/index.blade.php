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
                                        <div class="slider-header fadeInDown-1">Top Brands</div>
                                        <div class="big-text fadeInDown-1"> New Collections</div>
                                        <div class="excerpt fadeInDown-2 hidden-xs"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                                        </div>
                                        <div class="button-holder fadeInDown-3"><a
                                                    href="index6c11.html?page=single-product"
                                                    class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop
                                                Now</a></div>
                                    </div>
                                </div>
                            </div>

                            <div class="item" style="background-image: url({{ asset('images/sliders/02.jpg') }});">
                                <div class="container-fluid">
                                    <div class="caption bg-color vertical-center text-left">
                                        <div class="slider-header fadeInDown-1">Spring 2016</div>
                                        <div class="big-text fadeInDown-1"> Women <span class="highlight">Fashion</span>
                                        </div>
                                        <div class="excerpt fadeInDown-2 hidden-xs"><span>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</span>
                                        </div>
                                        <div class="button-holder fadeInDown-3"><a
                                                    href="index6c11.html?page=single-product"
                                                    class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop
                                                Now</a></div>
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
                                                <h4 class="info-box-heading green">money back</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">30 Days Money Back Guarantee</h6>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="hidden-md col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">free shipping</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">Shipping on orders over $99</h6>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-md-6 col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">Special Sale</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">Extra $5 off on all items </h6>
                                    </div>
                                </div>
                                <!-- .col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.info-boxes-inner -->

                    </div>
                    <!-- /.info-boxes -->

                    @include('homepage.partial._bannerCatalog')

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
                <!-- /.homebanner-holder -->
                <!-- ============================================== CONTENT : END ============================================== -->
            </div>
            <!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            <div id="brands-carousel" class="logo-slider wow fadeInUp">
                <div class="logo-slider-inner">
                    <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                        <div class="item m-t-15"><a href="#" class="image"> <img
                                        data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif"
                                        alt=""> </a></div>
                        <!--/.item-->

                        <div class="item m-t-10"><a href="#" class="image"> <img
                                        data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif"
                                        alt=""> </a></div>
                        <!--/.item-->

                        <div class="item"><a href="#" class="image"> <img data-echo="assets/images/brands/brand3.png"
                                                                          src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item"><a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png"
                                                                          src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item"><a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png"
                                                                          src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item"><a href="#" class="image"> <img data-echo="assets/images/brands/brand6.png"
                                                                          src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item"><a href="#" class="image"> <img data-echo="assets/images/brands/brand2.png"
                                                                          src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item"><a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png"
                                                                          src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item"><a href="#" class="image"> <img data-echo="assets/images/brands/brand1.png"
                                                                          src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item"><a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png"
                                                                          src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->
                    </div>
                    <!-- /.owl-carousel #logo-slider -->
                </div>
                <!-- /.logo-slider-inner -->

            </div>
            <!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div>
        <!-- /.container -->
    </div>
@endsection