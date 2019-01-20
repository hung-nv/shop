@extends('backend.layouts.app')

@section('title', 'Update Comment')

@section('pageId', 'create-update-comment')

@section('breadcrumbs')
    <a href="{{ route('comment.index') }}">Comment</a>
    <i class="fa fa-circle"></i>
@endsection

@section('content')
    <h3 class="page-title"> Managed Comment
        <small>Update</small>
    </h3>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet box blue">

                @include('backend.common.pageHeading')

                <div class="portlet-body form">

                    @include('backend.blocks.message')

                    <form action="{{ route('comment.update', ['user' => $data['id']]) }}" role="form"
                          class="form-horizontal form-row-seperated"
                          method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        @include('backend.blocks.errors')

                        @include('backend.comment.partial._form')

                        @include('backend.common.actionForm')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/libs/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/admin/css/fileinput.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@push('script')
    <script src="{{ asset('/libs/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/fileinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/piexif.min.js') }}" type="text/javascript"></script>
@endpush