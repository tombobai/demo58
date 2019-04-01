@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
<body class="gray-bg animated fadeInUp edit">
    <div class="row white-bg dashboard-header">
        <form id="add_form" name="add_form" method="post" action="{{ url('admincp/adminuser') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel panel-default edit_wrap">
                <div class="panel-heading edit_head clearfix">
                    <h4 class="pull-left edit_h4">{{$page_title}}</h4>
                    <div class="pull-right btn_group">
                        <a href="{{ url('admincp/adminuser/list') }}"><button type="button" class="btn btn-danger btn-xs">返回列表</button></a>
                    </div>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>手机号：</label>
                                <div class="col-sm-8 col-md-6 col-xs-12">
                                    <input type="text" class="form-control" name="telephone" id="telephone" value="{{ empty($admin_data['telephone']) ? '' : $admin_data['telephone'] }}" maxlength="11">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>真实姓名：</label>
                                <div class="col-sm-8 col-md-6 col-xs-12">
                                    <input type="text" class="form-control" name="true_name" id="true_name" value="{{ empty($admin_data['true_name']) ? '' : $admin_data['true_name'] }}" maxlength="30">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>密码：</label>
                                <div class="col-sm-8 col-md-6 col-xs-12">
                                    <input type="password" class="form-control" name="admin_password" id="admin_password" value="{{ empty($admin_data['admin_password']) ? '' : $admin_data['admin_password'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>确认密码：</label>
                                <div class="col-sm-8 col-md-6 col-xs-12">
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" value="{{ empty($admin_data['admin_password']) ? '' : $admin_data['admin_password'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>所属角色：</label>
                                <div class="col-sm-2 col-xs-12">
                                    <select class="form-control" name="role_id" id="role_id">
                                        <option value="">--请选择--</option>
                                        <?php foreach ($role_list as $value){ ?>
                                        <option value="<?php echo $value['role_id']; ?>" <?php echo (!empty($admin_data['role_id']) && $value['role_id'] == $admin_data['role_id']) ? "selected" : ""; ?>><?php echo $value['role_name']; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"></label>
                                <div class="col-sm-8 col-md-8 col-xs-12">
                                    @if(count($errors)>0)
                                        @foreach($errors->all() as $error)
                                            {{$error}}
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-sm-2 col-md-2 col-xs-12"></label>
                            <div class="col-sm-8 col-md-8 col-xs-12 edit_power">
                                <input value="{{ $url }}" type="hidden" name="url" id="url" />
                                <input type="hidden" name="admin_id" id="admin_id" value="{{ empty($admin_data['admin_id']) ? '-1' : $admin_data['admin_id'] }}" />
                                <button type="submit" class="btn btn-primary">提交</button>
                                <button type="button" class="btn btn-white" onClick="javascript:back_btn($('#url').val());">返回</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript">
    var rules_def ={
        rules : {
            telephone : {
                required : true,
                minlength : 11,
                maxlength : 11,
                remote:{
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ url('admincp/adminuser/check_name') }}",
                    data:{
                        'telephone': function(){return $('#telephone').val();},
                        'admin_id': function(){return $('#admin_id').val();}
                    },
                    type:'post',
                    dataType:'json'
                }
            },
            true_name : {
                required : true
            },
            admin_password : {
                required : true,
                minlength : 8
            },
            confirm_password : {
                required : true,
                minlength : 8,
                equalTo : "#admin_password"
            },
            role_id : {
                required : true
            }
        },
        messages : {
            telephone : {
                required : "请输入手机号",
                minlength : "手机号位数不够11位",
                maxlength : "手机号位数不能超过11位",
                remote : "手机号已经存在"
            },
            true_name : {
                required : "请输入真实姓名",
                remote : "用户名已经存在"
            },
            admin_password : {
                required : "请输入密码",
                minlength : $.validator.format("密码不能小于8位")
            },
            confirm_password : {
                required : "请输入确认密码",
                minlength : $.validator.format("确认密码不能小于{0}位"),
                equalTo : "两次输入密码不一致"
            },
            role_id : {
                required : "请选择角色"
            }
        }
    }

    $(function() {
        $("#add_form").validate(rules_def);
    });
</script>
@endsection