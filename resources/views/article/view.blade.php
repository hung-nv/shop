@section('title', $article->name)

@section('description', $article->description)

@extends('layouts.app')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/">Trang chủ</a></li>
                    <li class='active'></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="body-content">
        <div class="container">
            <div class="terms-conditions-page">
                <div class="row">
                    <div class="col-md-12 terms-conditions">
                        <h2 class="heading-title">{{ $article->name }}</h2>
                        <div class="">
                            {!! $article->content !!}
                        </div>
                    </div>
                </div>
            </div>

            @include('partials._partners')
        </div>
    </div>
@endsection