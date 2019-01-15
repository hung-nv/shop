@extends('layouts.app')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/">Trang chủ</a></li>
                    <li class='active'>{{ $post->name }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="blog-page outer-bottom-sm">
                    <div class="col-md-9">
                        <div class="blog-post wow fadeInUp">
                            <h1>{{ $post->name }}</h1>
                            <span class="date-time">{{ $post->created_at }}</span>
                            {!! $post->content !!}
                            <div class="social-media">
                                <span>Chia sẻ bài viết:</span>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"><i class="fa fa-facebook"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}"><i class="fa fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 sidebar">
                        <div class="sidebar-module-container">
                            <div class="home-banner outer-top-n outer-bottom-xs">
                                <img src="{{ asset('images/banners/LHS-banner.jpg') }}" alt="Image">
                            </div>

                            @if(isset($groupHot) && count($groupHot->posts) > 0)
                                <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                                    <h3 class="section-title">Bài viết xem nhiều</h3>
                                    <div class="tab-content" style="padding-left:0">
                                        <div class="tab-pane active m-t-20" id="popular">
                                            @foreach($groupHot->posts as $popular)
                                                <div class="@if($loop->first) blog-post inner-bottom-30 @else blog-post @endif" >
                                                    <img class="img-responsive" src="{{ $popular->image }}" alt="">
                                                    <h4><a href="{{ setUrlByType($popular->type, $popular->slug) }}">{{ $popular->name }}</a></h4>
                                                    <span class="date-time">{{ $popular->created_at }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

@endsection