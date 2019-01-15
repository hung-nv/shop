<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.themesground.com/flipmart-demo/V4/home.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Mar 2017 14:06:48 GMT -->
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>Flipmart premium HTML5 & CSS3 Template</title>

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

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.css') }}">

    <!-- Fonts -->
    <link href='{{ asset('fonts.googleapis.com/cssd767.css?family=Roboto:300,400,500,700') }}' rel='stylesheet' type='text/css'>
    <link href='{{ asset('fonts.googleapis.com/csse262.css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800') }}' rel='stylesheet' type='text/css'>
    <link href='{{ asset('fonts.googleapis.com/csse3e5.css?family=Montserrat:400,700') }}' rel='stylesheet' type='text/css'>
</head>
<body class="cnt-home mainComponent">
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    <script src="{{ asset('/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/js/echo.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.rateit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('/js/wow.min.js') }}"></script>
    <script src="{{ asset('/js/scripts.js') }}"></script>
</body>
</html>