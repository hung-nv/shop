@section('title', $product->meta_title ? $product->meta_title : $product->name)

@section('description', $product->meta_description ? $product->meta_description : $product->description)

@extends('layouts.app')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/">Trang chủ</a></li>
                    <li class='active'>{{ $product->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                @include('product.partial._sidebarShow')

                @include('product.partial._product')
                <div class="clearfix"></div>
            </div>

            @include('partials._partners')
        </div>
    </div>
@endsection