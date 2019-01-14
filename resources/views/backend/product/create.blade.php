@extends('backend.layouts.app', ['viewData' => [
    'oldName' => $name,
    'oldSlug' => $slug
]])

@section('title', 'Create Product')

@section('pageId', 'create-update-product')

@section('breadcrumbs')
    <a href="{{ route('product.index') }}">Products</a>
    <i class="fa fa-circle"></i>
@endsection

@section('content')
    <h3 class="page-title"> Products
        <small>Please fill all data to create product</small>
    </h3>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('product.store') }}" class="form-horizontal form-row-seperated" role="form"
                  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                @include('backend.blocks.errors')

                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-shopping-cart"></i>Product
                        </div>
                        <div class="actions btn-set">
                            <button type="button" name="back" class="btn btn-secondary-outline">
                                <i class="fa fa-angle-left"></i> Back
                            </button>
                            <button class="btn btn-secondary-outline" type="reset">
                                <i class="fa fa-reply"></i> Reset
                            </button>
                            <button class="btn btn-success" type="submit">
                                <i class="fa fa-check"></i> Save
                            </button>
                            <button class="btn btn-success">
                                <i class="fa fa-share"></i> Duplicate
                            </button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="tabbable-bordered">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_general" data-toggle="tab"> General </a>
                                </li>
                                <li>
                                    <a href="#tab_images" data-toggle="tab"> Images </a>
                                </li>
                                <li>
                                    <a href="#tab_content" data-toggle="tab"> Content </a>
                                </li>
                                <li>
                                    <a href="#tab_meta" data-toggle="tab"> Meta </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_general">
                                    @include("backend.product.partial._tab_general")
                                </div>
                                <div class="tab-pane" id="tab_images">
                                    @include("backend.product.partial._tab_images")
                                </div>
                                <div class="tab-pane" id="tab_content">
                                    @include("backend.product.partial._tab_content")
                                </div>
                                <div class="tab-pane" id="tab_meta">
                                    @include("backend.product.partial._tab_meta")
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('style')
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet"
          type="text/css" xmlns="http://www.w3.org/1999/html"/>
    <link href="{{ asset('/libs/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/libs/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/libs/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/libs/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/admin/css/fileinput.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@push('script')
    <script src="{{ asset('/libs/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/fancybox/source/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/typeahead/handlebars.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/typeahead/typeahead.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('/libs/piexif.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/sortable.min.js"
            type="text/javascript"></script>
    <script src="{{ asset('/libs/fileinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/custom/components-select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/custom/components-bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/custom/ui-modals.min.js') }}" type="text/javascript"></script>
@endpush