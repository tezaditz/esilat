<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="icon" type="image/png" href="{{ asset('img/logo-kemenkes.ico') }}"/>

    @section('stylesheet')
        <link rel="stylesheet" href="{{ asset('PACE/themes/white/pace-theme-minimal.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('iCheck/skins/minimal/minimal.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @show

    <style>
        .login-page {
            background-image:url('img/imgDefault-L.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: absolute;
            height: 100%;
            width: 100%;
        }
        .login-box {
            border: 1px solid gray;
            -webkit-box-shadow: 10px 10px 10px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: 10px 10px 10px 0px rgba(0,0,0,0.75);
            box-shadow: 10px 10px 10px 0px rgba(0,0,0,0.75);
            opacity: 0.98;
            background-color:rgba(255, 255, 255, 0.8);
            padding-top:20px;
        }
    </style>

</head>
<body class="hold-transition login-page">
<div class="login-box">
    @yield('login-logo')

    @yield('content')
</div>

@section('javascript')
    <script src="{{ asset('PACE/pace.min.js') }}"></script>
    <script src="{{ asset('jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('iCheck/icheck.min.js') }}"></script>
@show

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_minimal',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>