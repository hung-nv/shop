@extends('backend.layouts.app', ['viewData' => [
    'oldName' => $name,
    'oldSlug' => $slug
]])

@section('title', 'Update Page')

@section('pageId', 'create-edit-page')

@section('breadcrumbs')
    <a href="{{ route('page.index') }}">Pages</a>
    <i class="fa fa-circle"></i>
@endsection

@section('content')

    <h3 class="page-title"> Pages</h3>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">

                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-red-mint sbold">Update Page</span>
                    </div>
                </div>

                <div class="portlet-body">
                    <form action="{{ route('page.update', ['page' => $page['id']]) }}" class="horizontal-form"
                          role="form"
                          method="post" enctype="multipart/form-data" id="page-update-form">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-body">
                            <div class="row">

                                @include('backend.blocks.errors')

                                @include('backend.page.partial._form')
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet"
          type="text/css" xmlns="http://www.w3.org/1999/html"/>
    <link href="{{ asset('/libs/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/css/fileinput.min.css') }}"
          rel="stylesheet" type="text/css"/>
@endsection

@push('script')
    <script src="{{ asset('/libs/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/fileinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/piexif.min.js') }}" type="text/javascript"></script>
@endpush