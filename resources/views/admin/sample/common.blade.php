@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')

<body class="gray-bg animated fadeInUp edit">
    <div class="row white-bg dashboard-header">
        <form id="add_form" name="add_form" method="post" action="{{ url('admincp/sample') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel panel-default edit_wrap">
                <div class="panel-heading edit_head clearfix">
                    <h4 class="pull-left edit_h4">{{$page_title}}</h4>
                    <div class="pull-right btn_group">
                        <a href="{{ url('admincp/sample/list') }}"><button type="button" class="btn btn-danger btn-xs">返回列表</button></a>
                    </div>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>所属分公司：</label>
                                <div class="col-sm-2 col-xs-12">
                                    <select class="form-control" name="organization_id" id="organization_id">
                                        <option value="">--请选择--</option>
                                        <?php
                                        foreach ($organization_list as $key => $value){
                                        $organization_cell = $value;
                                        $select = '';
                                        if(!empty($organization_data) && $value['organization_id'] == $organization_data['parent_id']){
                                            $select = "selected";
                                        }
                                        ?>
                                        <option value="<?php echo $organization_cell['organization_id'];?>" <?php echo $select;?>>
                                            <?php
                                            if($value['level']>1){
                                                echo '|';
                                            }

                                            for($i=2;$i<=$value['level'];$i++){
                                                echo '--';
                                            }
                                            ?>
                                            <?php echo $organization_cell['organization_name'];?>
                                            <?php if($organization_cell['status']==2){ echo '(无效)';}?>
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
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>所属城市：</label>
                                <div class="col-sm-2 col-xs-12">
                                    <select class="form-control" name="city_name" id="city_name">
                                        <option value="">--请选择--</option>
                                        <?php
                                        foreach ($city_list as $key => $value){
                                        $select = '';
                                        if (!empty($city_name) && $city_name == $value) {
                                            $select = "selected";
                                        }
                                        ?>
                                        <option value="<?php echo $value;?>" <?php echo $select;?>>
                                            <?php echo $value;?>
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
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>分配员工：</label>
                                <div class="col-sm-2 col-xs-12">
                                    <select class="form-control" name="staff_id" id="staff_id">
                                        <option value="">--请选择--</option>
                                        <?php
                                        foreach ($staff_list as $key => $value){
                                        $select = '';
                                        if (!empty($staff_id) && $staff_id == $key) {
                                            $select = "selected";
                                        }
                                        ?>
                                        <option value="<?php echo $key;?>" <?php echo $select;?>>
                                            <?php echo $value;?>
                                        </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-sm-2 col-md-2 col-xs-12"></label>
                            <div class="col-sm-8 col-md-8 col-xs-12 edit_power">
                                <a href="{{ url('admincp/sample/list') }}"><button type="button" class="btn btn-white">返回</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript">

</script>
@endsection