<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="@yield('description')">
    <meta name="robots" content="all">
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.css') }}">

    <!-- Fonts -->
    <link href='{{ asset('fonts.googleapis.com/cssd767.css?family=Roboto:300,400,500,700') }}' rel='stylesheet'
          type='text/css'>
    <link href='{{ asset('fonts.googleapis.com/csse262.css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800') }}'
          rel='stylesheet' type='text/css'>
    <link href='{{ asset('fonts.googleapis.com/csse3e5.css?family=Montserrat:400,700') }}' rel='stylesheet'
          type='text/css'>

    <script type="text/javascript">
        const catalogs = {!! json_encode(array_pluck($catalogs, 'name', 'id')) !!};
    </script>
</head>
<body class="cnt-home">
<div id="mainApp">
    @include('partials._popup_customer')

    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    <template v-if="isLoading">
        <div class="loading">Loading&#8230;</div>
    </template>
</div>

<script src="{{ asset('/js/jquery-1.11.1.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-hover-dropdown.min.js') }}"></script>
<script src="{{ asset('/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/js/echo.min.js') }}"></script>
<script src="{{ asset('/js/jquery.easing-1.3.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-slider.min.js') }}"></script>
<script src="{{ asset('/js/jquery.rateit.min.js') }}"></script>
<script src="{{ asset('/js/lightbox.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('/js/wow.min.js') }}"></script>
<script src="{{ asset('/js/scripts.js') }}"></script>
<script src="{{ asset('/js/themes.js') }}"></script>
</body>
</html>