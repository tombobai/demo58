@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
    <body class="gray-bg animated fadeInUp">
    <div class="row white-bg dashboard-header">
        <div class="panel panel-default rubbish">
            <div class="panel-heading no-bottom-border rubbish_head clearfix">

                <div class="pull-right btn_group article_right_btn">
                    <a href="{{ url('admincp/permission/-1/edit') }}"><button type="button" class="btn btn-danger btn-xs">添加</button></a>
                    <button type="button" class="btn_refreach btn btn-primary btn-xs">刷新</button>
                    <a  data-toggle="collapse" href="#collapseOne"><i class="fa fa-chevron-up btn_up"></i></a>
                </div>

                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="javascript:void(0);" class="a_click" data-url="{{ url('admincp/permission/list') }}" aria-expanded="true">权限列表</a></li>
                    </ul>
                    <form id="search_form" name="search_form" method="get" action="{{ url('admincp/permission') }}/{{ $flag }}">
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <ul class="tab-content">
                                <li id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="search-control">
                                            <div class="row">
                                                <div class=" col-sm-5 col-md-4 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">权限标识：</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" name="permission_flag" id="permission_flag">
                                                                <option value="1" <?php if($permission_flag ==1){ echo 'selected'; }?>>后台权限</option>
                                                                <option value="2" <?php if($permission_flag ==2){ echo 'selected'; }?>>员工端App权限</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-4 col-xs-12">
                                                    <div class="btns pull-left" style="margin-top:1px;">
                                                        <button type="sumbit" class="btn btn-primary">查询</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive ">
                <table class="table table-bordered table-condensed article_list dataTables-example">
                    <thead>
                    <tr>
                        <th width="70">权限名称</th>
                        <th width="70">权限类型</th>
                        <th width="70">权限URL</th>
                        <th width="70">权限关键字</th>
                        <th width="40">排序序号</th>
                        <th width="50">操作</th>
                    </tr>
                    </thead>
                    <?php
                    foreach ($permission_list as $key => $value){
                        $str_blank = '';
                        for($i=2;$i<=$value['level'];$i++){
                            $str_blank .=  '&nbsp;&nbsp;&nbsp;&nbsp';
                        }
                    ?>
                    <tr>
                        <td class="cls_parent"><?php echo $str_blank;?><?php echo empty($value['permission_name']) ? '' : $value['permission_name']; ?></td>
                        <td>{{ $value['permission_type']==1?"菜单":"操作" }}</td>
                        <td><?php echo empty($value['permission_url']) ? '' : $value['permission_url']; ?></td>
                        <td><?php echo empty($value['permission_key']) ? '' : $value['permission_key']; ?></td>
                        <td><?php echo empty($value['display_order']) ? 0 : $value['display_order']; ?></td>
                        <td><a href="{{ url('admincp/permission') }}/{{ $value['permission_id'] }}/edit"><button type="button" class="btn btn-primary btn-xs">编辑</button></a> <a onclick="return confirm('确定删除？');" href="{{ url('admincp/permission/delete') }}/{{ $value['permission_id'] }}"><button type="button" class="btn btn-warning btn-xs">删除</button></a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    </body>
@endsection