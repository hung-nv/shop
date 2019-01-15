@extends('backend.layouts.app')

@section('style')
    <link href="{{ asset('/admin/assets/pages/css/error.min.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('title', '403 Unauthorized')

@section('content')
    <h1 class="page-title"> 403</h1>

    <div class="row">
        <div class="col-md-12 page-500">
            <div class=" number font-red"> 403</div>
            <div class=" details">
                <h3>Unauthorized action..</h3>
                <p> Please contact administrator if you want to use this function
                    <br></p>
                <p>
                    <a href="{{ route('admin.dashboard') }}" class="btn red btn-outline"> Return home </a>
                    <br>
                </p>
            </div>
        </div>
    </div>
@endsection