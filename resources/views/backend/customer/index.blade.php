@extends('backend.layouts.app', ['viewData' => [
    'ids_customer' => $customers->pluck('id')
]])

@section('title', 'Manage Customer')

@section('pageId', 'customer')

@section('breadcrumbs')
    <a href="{{ route('customer.index') }}">Users</a>
    <i class="fa fa-circle"></i>
@endsection

@section('content')
    <h3 class="page-title">
        Managed customer
        <small>All</small>
    </h3>

    @include('backend.blocks.message')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Data</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <button class="btn sbold green" v-on:click="openPopupMail"> Send Mail
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('backend.customer.partial._customer')

                </div>
            </div>
        </div>
    </div>

    @include('backend.customer.partial._modal_send_mail')
@endsection

@section('style')
    <link href="{{ asset('/libs/datatables/datatables.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/libs/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection

@push('script')
    <script src="{{ asset('/libs/custom/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/libs/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>
@endpush