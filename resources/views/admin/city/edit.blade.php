@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
<body class="gray-bg animated fadeInUp edit">
    <div class="row white-bg dashboard-header">
        <form id="add_form" name="add_form" method="post" action="{{ url('admincp/city') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel panel-default edit_wrap">
                <div class="panel-heading edit_head clearfix">
                    <h4 class="pull-left edit_h4">{{$page_title}}</h4>
                    <div class="pull-right btn_group">
                        <a href="{{ url('admincp/city/list') }}"><button type="button" class="btn btn-danger btn-xs">返回列表</button></a>
                    </div>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>所属省份：</label>
                                <div class="col-sm-2 col-xs-12">
                                    <select class="form-control" name="province_id" id="province_id">
                                        <option value="">--选择省/区--</option>
                                        <?php foreach ($province_list as $value){ ?>
                                        <option value="<?php echo $value['province_id']; ?>" <?php echo (!empty($city_data['province_id']) && $value['province_id'] == $city_data['province_id']) ? "selected" : ""; ?>><?php echo $value['province_name']; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>城市名称：</label>
                                <div class="col-sm-8 col-md-6 col-xs-12">
                                    <input type="text" class="form-control" name="city_name" id="city_name" value="{{ empty($city_data['city_name']) ? '' : $city_data['city_name'] }}" maxlength="50">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12">排序序号：</label>
                                <div class="col-sm-8 col-md-3 col-xs-12">
                                    <input type="text" class="form-control" name="display_order" id="display_order" value="{{ empty($city_data['display_order']) ? '' : $city_data['display_order'] }}" maxlength="10">
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
                                <input type="hidden" name="city_id" id="city_id" value="{{ empty($city_data['city_id']) ? '-1' : $city_data['city_id'] }}" />
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
            province_id : {
                required : true
            },
            city_name : {
                required : true,
                remote:{
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ url('admincp/city/check_name') }}",
                    data:{
                        'city_name': function(){return $('#city_name').val();},
                        'city_id': function(){return $('#city_id').val();}
                    },
                    type:'post',
                    dataType:'json'
                }
            },
            display_order : {
                digits : true,
                max : 9999
            }
        },
        messages : {
            province_id : {
                required : "请输入所属省份"
            },
            city_name : {
                required : "请输入城市名称",
                remote : "城市名称已经存在"
            },
            display_order : {
                digits : "必须输入整数",
                max : $.validator.format("请输入一个最大为 {0} 的值")
            }
        },
        errorPlacement: function(error, element) {
         error.appendTo( element.parent());
        }
    }

    $(function() {
        $("#add_form").validate(rules_def);
    });
</script>
@endsection