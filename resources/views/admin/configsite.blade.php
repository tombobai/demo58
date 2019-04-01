@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
<body class="gray-bg animated fadeInUp">
    <div class="row white-bg dashboard-header">
        <!--内容区导航设置-->
        <div class="nav_set_list">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">网站设置</a></li>
                <li><a href="javascript:;">邮件设置</a></li>
                <li><a href="javascript:;">系统设置</a></li>
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
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">网站名称：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['site_name'])?'':$config_data['site_name']; ?>" name="form[site_name]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">网站URL：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['site_url'])?'':$config_data['site_url']; ?>" name="form[site_url]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">网站关键字：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['site_keywords'])?'':$config_data['site_keywords']; ?>" name="form[site_keywords]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">网站描述：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <textarea class="form-control" cols="60" rows="5" name="form[site_description]"><?php echo empty($config_data['site_description'])?'':$config_data['site_description']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">网站备案信息：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['site_icp'])?'':$config_data['site_icp']; ?>" name="form[site_icp]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">管理员邮箱：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['admin_email'])?'':$config_data['admin_email']; ?>" name="form[admin_email]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">客服热线：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['hot_line'])?'':$config_data['hot_line']; ?>" name="form[hot_line]" class="form-control">
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

            <!--邮件设置-->
            <div class="panel panel-default panel_set_1">
                <div id="collapse_1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">服务器主机：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['email_host'])?'':$config_data['email_host']; ?>" name="form[email_host]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">用户名：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['email_username'])?'':$config_data['email_username']; ?>" name="form[email_username]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">密码：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['email_password'])?'':$config_data['email_password']; ?>" name="form[email_password]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">端口：</label>
                                <div class="col-sm-3 col-md-1 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['email_port'])?'':$config_data['email_port']; ?>" name="form[email_port]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">发件人邮箱：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['email_from'])?'':$config_data['email_from']; ?>" name="form[email_from]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">发件人名称：</label>
                                <div class="col-sm-3 col-md-3 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['email_fromname'])?'':$config_data['email_fromname']; ?>" name="form[email_fromname]" class="form-control">
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

            <!--系统设置-->
            <div class="panel panel-default panel_set_2">
                <div id="collapse_2" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">网站分析脚本(页面前部)：</label>
                                <div class="col-sm-3 col-md-6 col-xs-12">
                                    <textarea class="form-control" cols="60" rows="5" name="form[web_analytics_top]"><?php echo empty($config_data['web_analytics_top'])?'':$config_data['web_analytics_top']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">网站分析脚本(页面底部)：</label>
                                <div class="col-sm-3 col-md-6 col-xs-12">
                                    <textarea class="form-control" cols="60" rows="5" name="form[web_analytics_bottom]"><?php echo empty($config_data['web_analytics_bottom'])?'':$config_data['web_analytics_bottom']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">前台每页记录：</label>
                                <div class="col-sm-3 col-md-1 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['web_per_page'])?'':$config_data['web_per_page']; ?>" name="form[web_per_page]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">后台每页记录：</label>
                                <div class="col-sm-3 col-md-1 col-xs-12">
                                    <input type="text" value="<?php echo empty($config_data['admin_per_page'])?'':$config_data['admin_per_page']; ?>" name="form[admin_per_page]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">访问权限：</label>
                                <div class="col-sm-3 col-md-6 col-xs-12">
                                    <div class="power_radio">
                                        <label class="radio-inline">
                                            <input type="radio" name="form[login_flag]" id="form[login_flag][0]" value="0" <?php echo (empty($config_data['login_flag']) || ($config_data['login_flag'] == 0) || (!isset($config_data['login_flag'])) ) ? ' checked="checked"' : ''; ?>>未登录允许
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="form[login_flag]" id="form[login_flag][1]" value="1" <?php echo (!empty($config_data['login_flag']) && ($config_data['login_flag'] == 1)) ? ' checked="checked"' : ''; ?>>登录允许
                                        </label>
                                    </div>
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