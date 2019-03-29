@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
<body class="gray-bg animated fadeInUp edit">
    <div class="row white-bg dashboard-header">
        <form id="add_form" name="add_form" method="post" action="{{ url('admincp/permission') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel panel-default edit_wrap">
                <div class="panel-heading edit_head clearfix">
                    <h4 class="pull-left edit_h4">{{$page_title}}</h4>
                    <div class="pull-right btn_group">
                        <a href="{{ url('admincp/permission/list') }}"><button type="button" class="btn btn-danger btn-xs">返回列表</button></a>
                    </div>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>权限标识：</label>
                                <div class="col-sm-3 col-xs-12">
                                    <select class="form-control" name="permission_flag" id="permission_flag" onchange="javascript:change_permission_flag();" style="width:200px;">
                                        <option value="">--请选择--</option>
                                        <option value="1" @if (!empty($permission_data['permission_flag']) && $permission_data['permission_flag'] == 1) selected @endif>后台权限</option>
                                        <option value="2" @if (!empty($permission_data['permission_flag']) && $permission_data['permission_flag'] == 2) selected @endif>员工端App权限</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>权限类型：</label>
                                <div class="col-sm-2 col-xs-12">
                                    <select class="form-control" name="permission_type" id="permission_type">
                                        <option value="">--请选择--</option>
                                        <option value="1" @if (!empty($permission_data['permission_type']) && $permission_data['permission_type'] == 1) selected @endif>菜单</option>
                                        <option value="2" @if (!empty($permission_data['permission_type']) && $permission_data['permission_type'] == 2) selected @endif>操作</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>所属权限：</label>
                                <div class="col-sm-2 col-xs-12">
                                    <select class="form-control" name="parent_id" id="parent_id">
                                        <option value="">--顶级--</option>
                                        <?php
                                        foreach ($permission_list as $key => $value){
                                        $select = '';
                                        if(!empty($permission_data) && $value['permission_id'] == $permission_data['parent_id']){
                                            $select = "selected";
                                        }
                                        ?>
                                        <option value="<?php echo $value['permission_id'];?>" <?php echo $select;?>>
                                            <?php
                                            if($value['level']>1){
                                                echo '|';
                                            }

                                            for($i=2;$i<=$value['level'];$i++){
                                                echo '--';
                                            }
                                            ?>
                                            <?php echo $value['permission_name'];?>
                                        </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>权限名称：</label>
                                <div class="col-sm-8 col-md-4 col-xs-12">
                                    <input type="text" class="form-control" name="permission_name" id="permission_name" value="{{ empty($permission_data['permission_name']) ? '' : $permission_data['permission_name'] }}" maxlength="20">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>权限关键字：</label>
                                <div class="col-sm-8 col-md-4 col-xs-12">
                                    <input type="text" class="form-control" name="permission_key" id="permission_key" value="{{ empty($permission_data['permission_key']) ? '' : $permission_data['permission_key'] }}" maxlength="30">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12">权限URL：</label>
                                <div class="col-sm-8 col-md-6 col-xs-12">
                                    <input type="text" class="form-control" name="permission_url" id="permission_url" value="{{ empty($permission_data['permission_url']) ? '' : $permission_data['permission_url'] }}" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>排序序号：</label>
                                <div class="col-sm-8 col-md-3 col-xs-12">
                                    <input type="text" class="form-control" name="display_order" id="display_order" value="{{ empty($permission_data['display_order']) ? '' : $permission_data['display_order'] }}" maxlength="10">
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
                                <input type="hidden" name="permission_id" id="permission_id" value="{{ empty($permission_data['permission_id']) ? '-1' : $permission_data['permission_id'] }}" />
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
            permission_flag : {
                required : true
            },
            permission_type : {
                required : true
            },
            permission_name : {
                required : true,
                /*remote:{
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ url('admincp/permission/check_name') }}",
                    data:{
                        'permission_name': function(){return $('#permission_name').val();},
                        'permission_id': function(){return $('#permission_id').val();}
                    },
                    type:'post',
                    dataType:'json'
                }*/
            },
            permission_key : {
                required : true,
                letterintegerunderline : true,
                remote:{
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ url('admincp/permission/check_key') }}",
                    data:{
                        'permission_key': function(){return $('#permission_key').val();},
                        'permission_id': function(){return $('#permission_id').val();}
                    },
                    type:'post',
                    dataType:'json'
                }
            },
            display_order : {
                required : true,
                digits : true,
                max : 9999
            }
        },
        messages : {
            permission_flag : {
                required : "请选择权限标识"
            },
            permission_type : {
                required : "请选择权限类型"
            },
            permission_name : {
                required : "请输入权限名称",
                //remote : "权限名称已经存在"
            },
            permission_key : {
                required : "请输入权限关键字",
                letterintegerunderline : "只能输入字母、数字和下划线",
                remote : "权限关键字已经存在"
            },
            display_order : {
                required : "请输入排序序号",
                digits : "必须输入整数",
                max : $.validator.format("请输入不大于 {0} 的数值")
            }
        }
    }

    $(function() {
        $("#add_form").validate(rules_def);
    });

    function change_permission_flag(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:"{{ url('admincp/ajaxcommon/get_permission_option') }}",
            data:{"permission_flag" : $('#permission_flag').val(),"parent_id":'<?php echo empty($permission_data['parent_id'])?'':$permission_data['parent_id'];?>'},
            dataType:'html',
            success:function(msg){
                $("#parent_id").empty();
                $("#parent_id").append(msg);
            },
            error:function(){}
        });
    }
</script>
@endsection