@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
<body class="gray-bg animated fadeInUp edit">
    <div class="row white-bg dashboard-header">
        <form id="add_form" name="add_form" method="post" action="{{ url('admincp/updatepassword') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel panel-default edit_wrap">
                <div class="panel-heading edit_head clearfix">
                    <h4 class="pull-left edit_h4">{{$page_title}}</h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12">用户名：</label>
                                <div class="col-sm-8 col-md-6 col-xs-12">
                                    <p class="text">{{ session('telephone') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>旧密码：</label>
                                <div class="col-sm-8 col-md-6 col-xs-12">
                                    <input type="password" class="form-control" name="old_password" id="old_password"  maxlength="8">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>新密码：</label>
                                <div class="col-sm-8 col-md-6 col-xs-12">
                                    <input type="password" class="form-control" name="new_password" id="new_password"  maxlength="8">
                                    <span style="color: red;display: none" id="tishi">新密码不能与旧密码相同</span>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>确认密码：</label>
                                <div class="col-sm-8 col-md-6 col-xs-12">
                                    <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation"  maxlength="8">
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
                                <input value="{{ url('admincp/updatepassword') }}" type="hidden" name="url" id="url" />
                                <button type="submit" class="btn btn-primary">提交</button>
                                <!--<button type="button" class="btn btn-white" onClick="javascript:back_btn($('#url').val());">返回</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript">
    $("#new_password").change(function () {
        var old_password = $("#old_password").val();
        var new_password = $("#new_password").val();
        if (old_password == new_password){
            $("#tishi").show(500).delay(3000).hide(300);
        }
    })
    var rules_def ={
        rules : {
            old_password : {
                required : true,
                minlength : 8,
                maxlength : 8
            },
            new_password : {
                required : true,
                minlength : 8,
                maxlength : 8
            },
            new_password_confirmation : {
                required : true,
                minlength : 8,
                maxlength : 8,
               equalTo : "#new_password"
            }
        },
        messages : {
            old_password : {
                required : "请输入旧密码",
                minlength : $.validator.format("密码只能输入{0}位"),
                maxlength: $.validator.format("密码只能输入{0}位")
            },
            new_password : {
                required : "请输入新密码",
                minlength : $.validator.format("密码只能输入{0}位"),
                maxlength: $.validator.format("密码只能输入{0}位")
            },
            new_password_confirmation : {
                required : "请输入确认密码",
                minlength : $.validator.format("确认密码只能输入{0}位"),
                maxlength: $.validator.format("确认密码只能输入{0}位"),
                equalTo : "两次输入密码不一致"
            }
        }
    }
    $("#new_password").change(function () {
        var old_password = $("#old_password").val();
        var new_password = $("#new_password").val();
        if (old_password == new_password){
            $("#tishi").show(500).delay(3000).hide(300);
        }
    })

    $(function() {
        $("#add_form").validate(rules_def);
    });
</script>
@endsection