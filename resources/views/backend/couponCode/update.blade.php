@extends('backend.layouts.app')

@section('title', 'Update Coupon #'.$couponCode->id)

@section('pageId', 'create-edit-coupon-code')

@section('breadcrumbs')
    <a href="{{ route('couponCode.index') }}">Coupon Code</a>
    <i class="fa fa-circle"></i>
@endsection

@section('content')
    <h3 class="page-title"> Coupon Code
        <small>Update</small>
    </h3>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet box blue">

                @include('backend.common.pageHeading')

                <div class="portlet-body form">

                    @include('backend.blocks.message')

                    <form action="{{ route('couponCode.update', ['couponCode' => $couponCode->id]) }}"
                          class="form-horizontal form-row-seperated" role="form"
                          method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        @include('backend.blocks.errors')

                        @include('backend.couponCode.partial._form')

                        @include('backend.common.actionForm')

                    </form>

                </div>

            </div>

        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endsection

@push('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endpush