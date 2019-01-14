@extends('backend.layouts.app', ['viewData' => [
    'oldName' => '',
    'oldSlug' => ''
]])

@section('title', 'Insert Category')

@section('pageId', 'create-edit-category')

@section('breadcrumbs')
    <a href="{{ route('category.index') }}">Category</a>
    <i class="fa fa-circle"></i>
@endsection

@section('content')
    <h3 class="page-title"> Category
        <small>Insert</small>
    </h3>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet box blue">

                @include('backend.common.pageHeading')

                <div class="portlet-body form">

                    @include('backend.blocks.message')

                    <form action="{{ route('category.store') }}" class="form-horizontal form-row-seperated" role="form"
                          method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        @include('backend.blocks.errors')

                        @include('backend.category._form')

                        @include('backend.common.actionForm')

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/libs/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/css/fileinput.min.css') }}"
          rel="stylesheet" type="text/css"/>
@endsection

@push('script')
    <script src="{{ asset('/libs/select2/js/select2.full.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/libs/fileinput.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/libs/piexif.min.js') }}"
            type="text/javascript"></script>
@endpush