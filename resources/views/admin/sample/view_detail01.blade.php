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
                            <div ncflag="order">
                                <div class="table-responsive ">
                                    <table class="table table-bordered table-condensed article_list dataTables-example">
                                        <thead>
                                        <tr>
                                            <th width="140">订单号</th>
                                            <th width="120">计价规则名称</th>
                                            <th width="100">客户手机号</th>
                                            <th width="80">客户姓名</th>
                                            <th width="80">订单状态</th>
                                            <th width="120">下单时间</th>
                                            <th width="120">首次开锁时间</th>
                                            <th width="120">结束时间</th>
                                            <th width="150">车型</th>
                                            <th width="80">车牌号</th>
                                            <th width="80">所属城市</th>
                                            <th width="80">下单城市</th>
                                            <th width="60">接力车</th>
                                            <th width="80">加时预约</th>
                                            <th width="80">加时时间(分钟)</th>
                                            <th width="80">行驶时长</th>
                                            <th width="120">结算费用(元)</th>
                                            <th width="120">抵扣费用(元)</th>
                                            <th width="120">实际支付费用(元)</th>
                                            <th width="120">支付方式</th>
                                            <th width="120">是否结清</th>
                                            <th width="120">支付时间</th>
                                            <th width="120">是否中途加油(费用：元)</th>
                                            <th width="120">是否不计免赔</th>
                                            <th width="120">是否已开发票</th>
                                        </tr>
                                        </thead>
                                        <tr>
                                            <td colspan="25">没有匹配的数据</td>
                                        </tr>
                                    </table>
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