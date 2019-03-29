@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
<body class="gray-bg animated fadeInUp">
    <div class="row white-bg dashboard-header">
        <form id="add_form" name="add_form" method="post" action="{{ url('admincp/role') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel panel-default">
                <div class="panel-heading clearfix role_head">
                    <h4 class="pull-left">{{$page_title}}</h4>
                    <div class="pull-right btn_group">
                        <a href="{{ url('admincp/role/list') }}"><button type="button" class="btn btn-danger btn-xs">返回列表</button></a>
                    </div>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in role_wrap">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label"><sup>* </sup>角色名称：</label>
                                <div class="col-sm-8 col-md-4 col-xs-12">
                                    <input type="text" class="form-control" name="role_name" id="role_name" value="{{ empty($role_data['role_name']) ? '' : $role_data['role_name'] }}" maxlength="50">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">角色简介：</label>
                                <div class="col-sm-8 col-md-4 col-xs-12">
                                    <textarea class="form-control" name="role_brief" id="role_brief" cols="60" rows="5" maxlength="200">{{ empty($role_data['role_brief']) ? '' : $role_data['role_brief'] }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label">选择权限：</label>
                                <div class="col-sm-8 col-md-8 col-xs-12">
                                    <div class="nav_set_list">
                                        <ul class="nav nav-tabs">
                                            <li class="active "><a href="javascript:;">后台权限</a></li>
                                        </ul>
                                    </div>
                                    <!--内容切换-->
                                    <!--后台权限-->
                                    <div class="panel panel-default panel_set panel_set_0">
                                        <div id="collapse_0" class="panel-collapse collapse in">
                                            <div class="panel-body catalog_box role_power">
                                                <div class="catalog">
                                                    <ul>
                                                        <?php
                                                        foreach ($admin_permission_list as $key => $value){
                                                        ?>
                                                        <li
                                                        <?php if($value['level']==1){ echo 'class="first_catalog"';} ?>
                                                            <?php if($value['level']==2){ echo 'class="second_catalog"';} ?>
                                                            <?php if($value['level']==3){ echo 'class="three_catalog"';} ?>
                                                        >
                                                            <input name="permission_ids[]" type="checkbox" class="admin_checkbox_list" value="<?php echo $value['permission_id'];?>"
                                                                   <?php echo (!empty($role_data) && isset($role_data['permission_ids']) && in_array($value['permission_id'], $role_data['permission_ids'])) ? 'checked="checked"' : ''; ?>
                                                                   id="role_<?php
                                                            if(!empty($value['parent_id'])){
                                                                echo $value['parent_id'].'_';
                                                            }else{
                                                                echo '';
                                                            }
                                                            echo $value['permission_id'];
                                                          ?>"/><?php echo empty($value['permission_name']) ? '' : $value['permission_name']; ?></li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="col-sm-2 col-md-2 col-xs-12 control-label"></label>
                                <div class="col-sm-8 col-md-8 col-xs-12 error_message">
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
                                <input type="hidden" name="role_id" id="role_id" value="{{ empty($role_data['role_id']) ? '-1' : $role_data['role_id'] }}" />
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
            role_name : {
                required : true,
                remote:{
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ url('admincp/role/check_name') }}",
                    data:{
                        'role_name': function(){return $('#role_name').val();},
                        'role_id': function(){return $('#role_id').val();}
                    },
                    type:'post',
                    dataType:'json'
                }
            },
            "permission_ids[]" : {
                required : true
            }
        },
        messages : {
            role_name : {
                required : "请输入角色名称",
                remote : "角色名称已经存在"
            },
            "permission_ids[]" : {
                required : "请选择权限"
            }
        },
        errorPlacement: function(error, element) {
            if (element.is(':checkbox')){
                error.insertAfter($(".role_power"));
            }else {
                error.insertAfter(element);
            }

        }
    }

    $(function() {
        $("#add_form").validate(rules_def);

        $('.admin_checkbox_list').click(function(){
            var _id = $(this).attr('id');
            var _cls_name = $(this).parent().attr('class');

            if(_cls_name == 'first_catalog'){
                //处理二级权限
                if($(this).is(':checked')){
                    $('input[id ^= '+_id+']').prop('checked',true);
                }else{
                    $('input[id ^= '+_id+']').prop('checked',false);
                }

                //处理三级权限
                $('input[id ^= '+_id+']').each(function(){
                    var _second_id = $(this).attr('id');
                    var _secondArrId = _second_id.split('_');
                    var _secondIdName = (_secondArrId[0] +'_'+ _secondArrId[2]).toString();
                    if($(this).is(':checked')){
                        $('input[id ^= '+_secondIdName+']').prop('checked',true);
                    }else{
                        $('input[id ^= '+_secondIdName+']').prop('checked',false);
                    }
                });
            }

            if(_cls_name == 'second_catalog'){
                var arrId = _id.split('_');
                var idName = (arrId[0] +'_'+ arrId[2]).toString();
                var _parentId = (arrId[0] +'_'+ arrId[1]).toString();

                if($(this).is(':checked')){
                    $('input[id ^= '+idName+']').prop('checked',true);
                    $('#'+_parentId).prop('checked',true);
                }else{
                    $('input[id ^= '+idName+']').prop('checked',false);
                    var _length = $('input[id^='+_parentId+'_]:checked').length;
                    if(_length ==0){
                        $('#'+_parentId).prop('checked',false);
                    }
                }
            }

            if(_cls_name == 'three_catalog'){
                if($(this).is(':checked')){
                    var arrId = _id.split('_');
                    var _parentId = ('_'+ arrId[1]).toString();

                    var _parentStr = 'input[id ^= role_][id $= '+_parentId+']';
                    var _trueParentId = $(_parentStr).attr('id');

                    var secondArrId = _trueParentId.split('_');

                    $(_parentStr).prop('checked',true);
                    $('#role_'+secondArrId[1]).prop('checked',true);

                }else{
                    var arrId = _id.split('_');
                    var _parentId = (arrId[0]+'_'+ arrId[1]).toString();
                    var _lastId = '_'+ arrId[1];
                    var _parentStr = 'input[id ^= role_][id $= '+ _lastId+']';
                    var _trueParentId = $(_parentStr).attr('id');
                    var _grandArrId = _trueParentId.split('_');
                    var _grandId = (_grandArrId[0]+'_'+ _grandArrId[1]).toString();

                    //处理二级菜单
                    var _length = $('input[id^='+_parentId+']:checked').length;
                    if(_length ==0){
                        $('#'+_trueParentId).prop('checked',false);
                    }

                    //处理一级
                    _length = $('input[id^='+_grandId+'_]:checked').length;
                    if(_length ==0){
                        $('#'+_grandId).prop('checked',false);
                    }
                }
            }
        });

        $('.nav-tabs li').click(function(){
            var index = $(this).index();
            $(this).addClass('active').siblings().removeClass('active');

            $('.panel_set').hide();
            $('.panel_set_'+index).show();
        });
    });
</script>
@endsection