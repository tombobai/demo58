@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
<body class="gray-bg animated fadeInUp">
    <div class="row white-bg dashboard-header">
        <div class="panel panel-default rubbish">
            <div class="panel-heading no-bottom-border rubbish_head clearfix">

                <div class="pull-right btn_group article_right_btn">
                    @if($can['add'])
                    <a href="{{ url('admincp/role/-1/edit') }}"><button type="button" class="btn btn-danger btn-xs">添加</button></a>
                    @endif
                    <button type="button" class="btn_refreach btn btn-primary btn-xs">刷新</button>
                    <a  data-toggle="collapse" href="#collapseOne"><i class="fa fa-chevron-up btn_up"></i></a>
                </div>

                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="javascript:void(0);" class="a_click" data-url="{{ url('admincp/role/list') }}" aria-expanded="true">角色列表</a></li>
                    </ul>
                    <form id="search_form" name="search_form" method="get" action="{{ url('admincp/role') }}/{{ $flag }}">
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <ul class="tab-content">
                            <li id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="search-control">
                                        <div class="row">
                                            <div class="col-sm-5 col-md-4 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">角色名称：</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="role_name" id="role_name" value="{{ empty($role_name)?'':$role_name }}" maxlength="50" class="form-control" >
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
                            <th width="50">角色名称</th>
                            <th width="100">角色简介</th>
                            <th width="50">操作</th>
                        </tr>
                    </thead>
                    @foreach ($role_list as $key=>$value)
                        <tr>
                            <td>{{ $value['role_name'] }}</td>
                            <td>{{ empty($value['role_brief'])?'':$value['role_brief'] }}</td>
                            <td>
                                @if($can['edit'])
                                <a href="{{ url('admincp/role') }}/{{ $value['role_id'] }}/edit"><button class="btn btn-primary btn-xs">编辑</button></a>
                                @endif
                                @if($can['delete'])
                                <a onclick="return confirm('确定删除？');" href="{{ url('admincp/role/delete') }}/{{ $value['role_id'] }}"><button class="btn btn-warning btn-xs">删除</button></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if($record_count ==0)
                    <tr>
                        <td colspan="3">没有匹配的数据</td>
                    </tr>
                    @endif
                </table>
                @if($record_count > 0)
                <div class="row page_wrap">
                    <div class="pull-right">
                        <div class="dataTables_info pull-left total_page" id="DataTables_Table_0_info" role="alert" aria-live="polite" aria-relevant="all">总记录数：{{ $record_count }}</div>
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            {!! $page_view !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
@endsection