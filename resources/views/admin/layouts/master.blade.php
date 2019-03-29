<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta name="renderer" content="webkit">-->
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ url('favicon.ico') }}">
    <link href="{{ asset('admin/css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap.min14ed.css?v=3.3.6') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/font-awesome.min93e3.css?v=4.4.0') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css?v=4.1.0') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.css?v=1') }}" rel="stylesheet">

    <!--分页-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/plugins/dataTables/dataTables.bootstrap.css') }}" />

    <script src="{{ asset('admin/js/jquery.min.js?v=2.1.4') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js?v=3.3.6') }}"></script>
    <!--手风琴效果的可折叠菜单，允许自动折叠效果-->
    <script src="{{ asset('admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <!--超出部分自动有滚动条-->
    <script src="{{ asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!--弹层-->
    <script src="{{ asset('admin/js/plugins/layer/layer.min.js') }}"></script>
    <script src="{{ asset('admin/js/hplus.min.js?v=4.1.0') }}"></script>
    <link href="{{ asset('admin/css/page-jump.css?v=1') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('admin/js/contabs.min.js') }}"></script>

    <!--验证框架js-->
    <script type="text/javascript" src="{{ asset('js/validate/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/validate/additional-methods.js') }}"></script>

    <script type="text/javascript" src="{{ asset('admin/js/common.js') }}"></script>
</head>

@yield('content')

</html>
