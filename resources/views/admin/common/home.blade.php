<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <title>XXX-后台管理系统</title>

    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon" href="{{ url('favicon.ico') }}">
    <link href="{{ asset('admin/css/bootstrap.min14ed.css?v=3.3.6') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/font-awesome.min93e3.css?v=4.4.0') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css?v=4.1.0') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
            <!--<li class="nav-header" style="padding-bottom: 0;padding-top:0;">
                    <div class="dropdown profile-element">
                        <span><img alt="image" class="img-circle" widht="150" height="150" src="{{ asset('admin/img/logo.png') }}"/></span>
                    </div>
                    <div class="logo-element">
                    </div>
                </li>-->
                @if(is_array($menu))
                    @foreach ($menu as $key=>$value)
                        <li>
                            <a href="javascript:void(0);">
                                <i class="fa fa fa-circle"></i>
                                <span class="nav-label">{{ $value['parent']['permission_name'] }}</span>
                                <span class="fa arrow"></span>
                            </a>
                            @if(!empty($value['son']))
                                @foreach ($value['son'] as $child_key=>$child_value)
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a class="J_menuItem" href="{{ url($child_value['permission_url']) }}">{{ $child_value['permission_name'] }}</a>
                                        </li>
                                    </ul>
                                @endforeach
                            @endif
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <div class="col-md-4 col-sm-4">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="javascript:void(0);"><i class="fa fa-bars"></i> </a>
                        <div class="form-group">
                            <h2><b>XXX-管理系统</b></h2>
                        </div>
                    </div>
                    <div class="pull-right person_info">欢迎您，{{ empty(session('staff_name'))?session('telephone'):session('staff_name') }}</div>
                </div>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="{{ url('admincp/logout') }}" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="{{ url("admincp/welcome") }}" frameborder="0" data-id="index_v1.html" seamless></iframe>
        </div>
        <div class="footer">
            <div class="pull-right">&copy; 2018-2019 久众科技有限公司</div>
        </div>
    </div>
    <!--右侧部分结束-->
</div>
<script src="{{ asset('admin/js/jquery.min.js?v=2.1.4') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js?v=3.3.6') }}"></script>
<script src="{{ asset('admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/layer/layer.min.js') }}"></script>
<script src="{{ asset('admin/js/hplus.min.js?v=4.1.0') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/contabs.min.js') }}"></script>
<!--<script src="js/plugins/pace/pace.min.js"></script>-->
</body>
</html>