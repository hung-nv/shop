@section('title', !empty($option['meta_title']) ? $option['meta_title'] : '')

@section('description', !empty($option['meta_description']) ? $option['meta_description'] : '')

@extends('layouts.app')

@section('content')
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">

                    @include('homepage.partial._homeBanner')

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

                    @include('homepage.partial._hotArticle')

                </div>
            </div>
            @include('partials._partners')
        </div>
    </div>
@endsection