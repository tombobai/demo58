@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
    <!--日期插件-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/plugins/datapicker/datepicker3.css') }}"/>
    <script type="text/javascript" src="{{ asset('admin/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

    <!--日期插件-精确到时分秒-->
    <!--<<link rel="stylesheet" type="text/css" href="{{ asset('js/jedate/skin/jedate.css') }}"/>
    <script type="text/javascript" src="{{ asset('js/jedate/jquery.jedate.js') }}"></script>-->

    <!-- 下拉框 带筛选  -->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('js/chosen/css/chosen.css') }}"/>
    <script type="text/javascript" src="{{ asset('js/chosen/chosen.jquery.js') }}"></script>-->

    <!-- 弹出框  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/tipswindown.css') }}" />
    <script type="text/javascript" src="{{ asset('js/tipswindown/tipswindown.js') }}"></script>

<body class="gray-bg animated fadeInUp">
    <div class="row white-bg dashboard-header">
        <div class="panel panel-default rubbish">
            <div class="panel-heading no-bottom-border rubbish_head clearfix">

                <div class="pull-right btn_group article_right_btn">
                    <a href="{{ url('admincp/sample/-1/edit') }}"><button type="button" class="btn btn-danger btn-xs">添加</button></a>
                    <button type="button" class="btn_refreach btn btn-primary btn-xs">刷新</button>
                    <a  data-toggle="collapse" href="#collapseOne"><i class="fa fa-chevron-up btn_up"></i></a>
                </div>

                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="javascript:void(0);" class="a_click" data-url="{{ url('admincp/sample/list') }}" aria-expanded="true">样例列表</a></li>
                    </ul>
                    <form id="search_form" name="search_form" method="get" action="{{ url('admincp/sample') }}/{{ $flag }}">
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <ul class="tab-content">
                            <li id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="search-control">
                                        <div class="row">
                                            <div class="col-sm-5 col-md-4 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">样例名称：</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="sample_name" id="sample_name" value="{{ empty($sample_name)?'':$sample_name }}" maxlength="50" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-sm-5 col-md-4 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">状态：</label>
                                                    <div class="col-md-9">
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="" @if( !isset($status) || $status == '') selected @endif>--未选择--</option>
                                                            <option value="1" @if( !empty($status) && $status ==1) selected @endif>启用</option>
                                                            <option value="2" @if( isset($status) && $status ==2) selected @endif>禁用</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class=" col-sm-5 col-md-4 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">带查询下拉：</label>
                                                    <div class="col-md-9">
                                                        <select name="status" id="status" class="form-control chosen-select" data-placeholder="请选择状态">
                                                            <option value="" @if( !isset($status) || $status == '') selected @endif>--未选择--</option>
                                                            <option value="1" @if( !empty($status) && $status ==1) selected @endif>启用</option>
                                                            <option value="2" @if( isset($status) && $status ==2) selected @endif>禁用</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>-->
                                        </div>
                                        <div class="row">
                                            <div class=" col-sm-4 col-md-4 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">发布时间(开始)：</label>
                                                    <div class="col-md-9">
                                                        <div class="input-group date list_date form_datetime pull-left">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            <input type="text" class="form-control jsdate_cls" name="begin_publish_time" id="begin_publish_time" value="{{ empty($begin_publish_time) ? '' : date('Y-m-d', $begin_publish_time) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-sm-4 col-md-4 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">发布时间(结束)：</label>
                                                    <div class="col-md-9">
                                                        <div class="input-group date list_date form_datetime pull-left">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            <input type="text" class="form-control jsdate_cls" name="end_publish_time" id="end_publish_time" value="{{ empty($end_publish_time) ? '' : date('Y-m-d', $end_publish_time) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-xs-12">
                                                <div class="btns pull-left btns_edit">
                                                    <button type="button" class="btn btn-sm" onclick="javascript:search_data();">查询</button>
                                                    <button type="reset" class="search-reset btn btn-sm">重置</button>
                                                    <button type="button" class="btn btn-sm" onclick="javascript:window.location.href='{{ url('admincp/sample/import') }}';">导入</button>
                                                    <a href="{{ url('template/sample_import.xlsx') }}"><button type="button" class="btn btn-sm last_btn">下载导入模板</button></a>
                                                    <button type="button" class="btn btn-sm" onclick="javascript:export_data();">导出</button>
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
                            <th width="70">样例名称</th>
                            <th width="70">样例图片</th>
                            <th width="40">状态</th>
                            <th width="40">发布时间</th>
                            <th width="40">排序序号</th>
                            <th width="50">操作</th>
                        </tr>
                    </thead>
                    @foreach ($sample_list as $key=>$value)
                        <tr>
                            <td>{{ $value['sample_name'] }}</td>
                            <td><img class="cls_zoom_image" src="{{ empty($value['image_path'])?url('uploads/default/no_exist.png'):url($value['image_path']) }}" class="cls_zoom_image" width="80" height="60"/></td>
                            <td>{{ $value['status']==1?"启用":"禁用" }}</td>
                            <td>{{ empty($value['publish_time'])?'':date('Y-m-d H:i:s',$value['publish_time']) }}</td><!-- 如果用created_at，需要转化为时间戮。示例：$value['created_at']->timestamp -->
                            <td>{{ $value['display_order'] }}</td>
                            <td>
                                <a href="{{ url('admincp/sample') }}/{{ $value['sample_id'] }}/edit"><button class="btn btn-primary btn-xs">编辑</button></a>
                                <a onclick="return confirm('确定删除？');" href="{{ url('admincp/sample/delete') }}/{{ $value['sample_id'] }}"><button class="btn btn-warning btn-xs">删除</button></a>
                                <button class="btn btn-primary btn-xs" onclick="javascript:set_tipswindow('{{ $value['sample_id'] }}','设置数据');">设置</button>
                                <button class="btn btn-primary btn-xs" onclick="javascript:pop_tipswindow('{{ $value['sample_id'] }}','列表数据');">弹出列表</button>
                                <button class="btn btn-primary btn-xs" onclick="javascript:detail_tipswindow('{{ $value['sample_id'] }}','查看详情');">查看详情</button>
                            </td>
                        </tr>
                    @endforeach
                    @if($record_count ==0)
                    <tr>
                        <td colspan="6">没有匹配的数据</td>
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

    <!--点小图显示大图-->
    <div id="zoom_image_popup"><div class="zoom_image_bg"><img src="" alt="" /></div></div>
    <link rel="stylesheet" type="text/css" href="{{ asset('js/zoom_image/css/zoom_image.css') }}" />
    <script type="text/javascript" src="{{ asset('js/zoom_image/zoom_image.js') }}"></script>

</body>
<script>
    $(function(){
        //精确到时分秒
        /*$(".jsdate_cls").jeDate({
            isinitVal:false,
            festival:true,
            ishmsVal:false,
            minDate: '2016-06-16 23:59:59',
            maxDate: $.nowDate(0),
            format:"YYYY-MM-DD hh:mm:ss",
            zIndex:3000,
        });*/

        //精确到日期
        $(".form_datetime").datepicker({
            format: 'yyyy-mm-dd',
            //todayBtn: true,//今日按钮
            clearBtn: false,//清除按钮
            keyboardNavigation: false,//键盘来选择日期
            forceParse: false,
            calendarWeeks: false,//是否显示周数
            autoclose: true //选中之后自动隐藏日期选择框
        })/*.on('changeDate',function(ev){
         alert(ev.date.valueOf());
         })*/;


        //$('.chosen-select').chosen();

    });

    function search_data()
    {
        $('#search_form').attr('target', '');
        $('#search_form').attr('action', "{{ url('admincp/sample') }}/{{ $flag }}");
        $('#search_form').submit();
    }

    function export_data()
    {
        //$('#search_form').attr('target', '_blank');
        $('#search_form').attr('target', '');
        $('#search_form').attr('action', "{{ url('admincp/sample/export') }}");
        $('#search_form').submit();

        //导出后，把url更新成查询的url，防止刷新再次导出
        $('#search_form').attr('action', "{{ url('admincp/sample') }}/{{ $flag }}");
    }

    function set_tipswindow(id,page_title)
    {
        tipsWindown(page_title, "url:get?"+"{{ url('admincp/sample/set') }}/"+id, "600", "500", "true", "false","true", "", "true", "","");
    }

    function pop_tipswindow(id,page_title)
    {
        tipsWindown(page_title, "url:get?"+"{{ url('admincp/sample/pop_list') }}/"+id, "1000", "800", "true", "false","true", "", "true", "","");
    }

    function detail_tipswindow(id,page_title)
    {
        tipsWindown(page_title, "iframe:{{ url('admincp/sample/view_detail') }}/"+id, "1000", "800", "true", "false","true", "", "true", "","");
    }
</script>
@endsection