@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
<body class="gray-bg animated fadeInUp">
    <div class="row white-bg dashboard-header">
        <div class="panel panel-default rubbish">
            <div class="panel-heading no-bottom-border rubbish_head clearfix">

                <div class="pull-right btn_group article_right_btn">
                    <a href="{{ url('admincp/province/-1/edit') }}"><button type="button" class="btn btn-danger btn-xs">添加</button></a>
                    <button type="button" class="btn_refreach btn btn-primary btn-xs">刷新</button>
                    <a  data-toggle="collapse" href="#collapseOne"><i class="fa fa-chevron-up btn_up"></i></a>
                </div>

                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li @if($flag == 'list') class="active" @endif><a data-toggle="tab" href="javascript:void(0);" class="a_click" data-url="{{ url('admincp/province/list') }}" aria-expanded="true">省份列表</a></li>
                    </ul>
                    <form id="search_form" name="search_form" method="get" action="{{ url('admincp/province') }}/{{ $flag }}">
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <ul class="tab-content">
                            <li id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="search-control">
                                        <div class="row">
                                            <div class="col-sm-5 col-md-4 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">省份名称：</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="province_name" id="province_name" value="{{ empty($province_name)?'':$province_name }}" maxlength="50" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5 col-md-4 col-xs-12">
                                                <div class="btns pull-left" style="margin-top:1px;">
                                                    <button type="sumbit" class="btn btn-primary">搜索</button>
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
                            <th width="70">省份名称</th>
                            <th width="40">排序序号</th>
                            <th width="50">操作</th>
                        </tr>
                    </thead>
                    @foreach ($province_list as $key=>$value)
                        <tr>
                            <td>{{ $value['province_name'] }}</td>
                            <td>{{ $value['display_order'] }}</td>
                            <td>
                                @if($flag == 'list')
                                    <a href="{{ url('admincp/province') }}/{{ $value['province_id'] }}/edit"><button class="btn btn-primary btn-xs">编辑</button></a>
                                    <a onclick="return confirm('确定删除？');" href="{{ url('admincp/province/delete') }}/{{ $value['province_id'] }}"><button class="btn btn-warning btn-xs">删除</button></a>
                                @else
                                    <a onclick="return confirm('确定恢复？');" href="{{ url('admincp/province/recovery') }}/{{ $value['province_id'] }}"><button class="btn btn-primary btn-xs">恢复</button></a>
                                    <a onclick="return confirm('确定彻底删除？');" href="{{ url('admincp/province/true_delete') }}/{{ $value['province_id'] }}"><button class="btn btn-danger btn-xs">彻底删除</button></a>
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