@extends('layouts.app')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='active'>Handbags</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>

    <div class="body-content outer-top-xs" id="list-products">
        <div class='container'>
            <div class='row'>
                @include('product.partial._sidebar')
                <div class='col-md-9'>

                    <div id="category" class="category-carousel hidden-xs">
                        <div class="item">
                            <div class="image">
                                <img src="{{ asset('images/banners/cat-banner-1.jpg') }}" alt="" class="img-responsive">
                            </div>
                            <div class="container-fluid">
                                <div class="caption vertical-top text-left">
                                    <div class="big-text"> Big Sale</div>
                                    <div class="excerpt hidden-sm hidden-md"> Save up to 49% off</div>
                                    <div class="excerpt-normal hidden-sm hidden-md"> Lorem ipsum dolor sit amet,
                                        consectetur adipiscing elit
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix filters-container m-t-10">
                        <div class="row">
                            <!-- /.col -->
                            <div class="col col-sm-12 col-md-9">
                                <div class="col col-sm-6 col-md-6 no-padding">
                                    <div class="lbl-cnt"><span class="lbl">Sắp xếp</span>
                                        <div class="fld inline">
                                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                                <button data-toggle="dropdown" type="button"
                                                        class="btn dropdown-toggle"> @{{ labelSortBy }} <span
                                                            class="caret"></span></button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li role="presentation">
                                                        <a v-on:click="setSortBy('1')">Mới nhất</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a v-on:click="setSortBy('2')">Giá: thấp - cao</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a v-on:click="setSortBy('3')">Giá: cao - thấp</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a v-on:click="setSortBy('4')">Tên sản phẩm: A - Z</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /.fld -->
                                    </div>
                                    <!-- /.lbl-cnt -->
                                </div>
                                <!-- /.col -->
                                <div class="col col-sm-3 col-md-6 no-padding">
                                    <div class="lbl-cnt"><span class="lbl">Show</span>
                                        <div class="fld inline">
                                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                                <button data-toggle="dropdown" type="button"
                                                        class="btn dropdown-toggle"> @{{ pageSize }} sản phẩm <span class="caret"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li role="presentation"><a v-on:click="setPageSize('12')">12 sản phẩm</a></li>
                                                    <li role="presentation"><a v-on:click="setPageSize('24')">24 sản phẩm</a></li>
                                                    <li role="presentation"><a v-on:click="setPageSize('36')">36 sản phẩm</a></li>
                                                    <li role="presentation"><a v-on:click="setPageSize('48')">48 sản phẩm</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /.fld -->
                                    </div>
                                    <!-- /.lbl-cnt -->
                                </div>
                                <!-- /.col -->
                            </div>

                            <div class="col col-sm-6 col-md-3 text-right">
                                <div class="pagination-container">
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="search-result-container ">
                        <div id="myTabContent" class="tab-content category-list">

                            @include('product.partial._innerProduct')

                        </div>
                        <!-- /.tab-content -->
                        <div class="clearfix filters-container">
                            <div class="text-right">
                                <div class="pagination-container">
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            @include('partials._partners')
        </div>
    </div>
@endsection