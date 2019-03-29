@extends('admin.layouts.master')
@section('title', $page_title)
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/layui/css/layui.css') }}"/>
    <script type="text/javascript" src="{{ asset('admin/layui/layui.js') }}"></script>
    <style>
        .layui-tab ul {
            box-sizing: unset;
        }

        .form-control, .single-line {
            border: none;
        }
        .edit_wrap .form-control{width:60%;}

        .dashboard-header{padding:0px;}

        .row {
            overflow: hidden
        }
        .img {
            width: 250px;
            height: 150px;
        }
    </style>
    <body class="gray-bg animated fadeInUp edit">
    <div class="row white-bg dashboard-header">
        <div class="panel panel-default edit_wrap">
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div class="layui-tab">
                        <ul class="layui-tab-title">
                            {!! $solt !!}
                        </ul>
                        <div class="layui-tab-content">
                            <div class="layui-tab-item layui-show col-sm-12 col-md-12 col-xs-12" ncflag="info">
                                <div class="row">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">会员姓名：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control">
                                                张三
                                            </div>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">会员状态：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control">
                                                冻结
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">手机号：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control">13000000000</div>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">邀请人姓名：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control" >
                                                李四
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">身份证号：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control">410xxxxx </div>
                                        </div>

                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">邀请人手机号：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control" >
                                                12345678901
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">是否实名认证：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control ">
                                                未认证
                                            </div>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">认证时间：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control">
                                                2018-01-01 12:34:34
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">会员类型：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12">
                                            <div class="form-control">
                                                蜜月
                                            </div>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">有效期至：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control">
                                                2019-01-01 12:34:34
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">账户余额：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12">
                                            <div class="form-control">
                                                100
                                            </div>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">充值余额：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12">
                                            <div class="form-control">
                                                200
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">返还余额：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12">
                                            <div class="form-control">
                                                410
                                            </div>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">赠送余额：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12">
                                            <div class="form-control">
                                                520
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">蜜钱儿：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12">
                                            <div class="form-control">
                                                530
                                            </div>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">欠款总额：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12">
                                            <div class="form-control">
                                                420
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">注册时间：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control">
                                                2018-01-01 12:34:34
                                            </div>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">最后登录时间：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control">
                                                2018-01-01 12:34:34
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">身份证正面照片：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control img">
                                                <img src="{{ asset('/admin/default/no_photo.jpg') }}"
                                                     class="cls_zoom_image" width="250" height="150">
                                            </div>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">驾照正面照片：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control img">
                                                <img src="{{ asset('/admin/default/no_photo.jpg') }}"
                                                     class="cls_zoom_image" width="250" height="150">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">身份证反面照片：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control img">
                                                <img src="{{ asset('/admin/default/no_photo.jpg') }}"
                                                     class="cls_zoom_image" width="250" height="150">
                                            </div>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">驾照副页照片：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control img">
                                                <img src="{{ asset('/admin/default/no_photo.jpg') }}"
                                                     class="cls_zoom_image" width="250" height="150">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12">手持身份证照片：</label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control img">
                                                <img src="{{ asset('/admin/default/no_photo.jpg') }}"
                                                     class="cls_zoom_image" width="250" height="150">
                                            </div>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-2 col-xs-12"></label>
                                        <div class="col-sm-4 col-md-4 col-xs-12 ">
                                            <div class="form-control img">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    <div id="zoom_image_popup">
        <div class="zoom_image_bg"><img src="" alt=""/></div>
    </div>
    <link rel="stylesheet" type="text/css" href="{{ asset('js/zoom_image/css/zoom_image.css') }}"/>
    <script type="text/javascript" src="{{ asset('js/zoom_image/zoom_image.js') }}"></script>
    <script type="text/javascript">
        $(function () {

        });
    </script>
@endsection