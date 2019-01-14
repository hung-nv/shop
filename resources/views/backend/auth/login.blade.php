<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>User Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/libs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/libs/simple-line-icons/simple-line-icons.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/libs/bootstrap-switch/css/bootstrap-switch.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/libs/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('/admin/css/components.min.css') }}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{ asset('/admin/css/plugins.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('/admin/css/login-5.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{ asset('/admin/images/favicon.ico') }}"/>
</head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN : LOGIN PAGE 5-1 -->
<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-6 bs-reset">
            <div class="login-bg" style="background-image:url('{{ asset('/admin/assets/img/login/bg1.jpg') }}')">

            </div>
        </div>
        <div class="col-md-6 login-container bs-reset">
            <div class="login-content">

                <h1>Hungnv Tool Login</h1>

                <form class="login-form" role="form" method="post" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="text"
                                   autocomplete="off" placeholder="Username" name="username"
                                   value="{{ old('username') }}" required autofocus/></div>
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="password"
                                   autocomplete="off" placeholder="Password" name="password" id="password" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="rem-password">
                                <label class="rememberme mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" name="remember"
                                           value="1" {{ old('remember') ? 'checked' : '' }} /> Remember me
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-8 text-right">
                            <div class="forgot-password">
                                <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                            </div>
                            <button class="btn green" type="submit">Sign In</button>
                        </div>
                    </div>
                </form>
                <!-- BEGIN FORGOT PASSWORD FORM -->
                <form class="forget-form" action="javascript:;" method="post">
                    <h3 class="font-green">Forgot Password ?</h3>
                    <p> Enter your e-mail address below to reset your password. </p>
                    <div class="form-group">
                        <input class="form-control placeholder-no-fix form-group" type="text" autocomplete="off"
                               placeholder="Email" name="email"/></div>
                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn green btn-outline">Back</button>
                        <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
                    </div>
                </form>
                <!-- END FORGOT PASSWORD FORM -->
            </div>
            <div class="login-footer">
                <div class="row bs-reset">
                    <div class="col-xs-7 bs-reset">
                        <div class="login-copyright text-right">
                            <p>Copyright &copy; hungnv234@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END : LOGIN PAGE 5-1 -->
<!--[if lt IE 9]>
<script src="{{ asset('/libs/respond.min.js') }}"></script>
<script src="{{ asset('/libs/excanvas.min.js') }}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('/libs/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/libs/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/libs/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/libs/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/libs/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/libs/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/libs/bootstrap-switch/js/bootstrap-switch.min.js') }}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('/libs/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/libs/jquery-validation/js/additional-methods.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/libs/select2/js/select2.full.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('/libs/backstretch/jquery.backstretch.min.js') }}"
        {{--type="text/javascript"></script>--}}
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('/libs/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('/libs/themes/login-5.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>