@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
<body class="gray-bg animated fadeInUp">
    <div class="row white-bg dashboard-header">
        <!--内容区导航设置-->
        <div class="nav_set_list">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">系统设置</a></li>
                <!--<li><a href="javascript:;">邮件设置</a></li>
                <li><a href="javascript:;">系统设置</a></li>-->
            </ul>
        </div>
        <form id="edit_form" name="edit_form" method="post" action="{{ url('admincp/configsite') }}" enctype="multipart/form-data">
            <input type="hidden" name="submit_config" value="1" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!--网站设置-->
            <div class="panel panel-default panel_set_0">
                <div id="collapse_0" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">收款银行：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['bank_name'])?'':$config_data['bank_name']; ?>" name="form[bank_name]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">收款名称：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['bank_householder'])?'':$config_data['bank_householder']; ?>" name="form[bank_householder]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">收款账号：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['bank_account_number'])?'':$config_data['bank_account_number']; ?>" name="form[bank_account_number]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 col-md-2 col-xs-12"></div>
                            <div class="col-sm-8 col-md-8 col-xs-12">
                                <input type="submit" value="提交" class="btn btn_submit" onClick="alert('提交成功！');"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</body>
<script type="text/javascript">
    $('.nav-tabs li').click(function(){
        var index = $(this).index();
        $(this).addClass('active').siblings().removeClass('active');

        $('.panel_set_'+index).show().siblings().hide();

        $('.btn_refresh a').attr('href','#collapse_'+index);
    });
</script>
@endsection