@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
<body class="gray-bg animated fadeInUp edit">
    <div class="row white-bg dashboard-header">
        <div class="panel panel-default edit_wrap">
            <div class="panel-heading edit_head clearfix">
                <h4 class="pull-left edit_h4">{{$page_title}}</h4>
                <div class="pull-right btn_group">
                    <a href="{{ url('admincp/sample/list') }}"><button type="button" class="btn btn-danger btn-xs">返回列表</button></a>
                </div>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div class="col-sm-12 col-md-12 col-xs-12 ">
                        <div class="form-group clearfix">
                            <label class="control-label col-md-1">样例名称：</label>
                            <div class="col-md-6">
                                <p class="text">{{ empty($sample_data['sample_name']) ? '' : $sample_data['sample_name'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12 ">
                        <div class="form-group clearfix">
                            <label class="control-label col-md-1">附件下载：</label>
                            <div class="col-md-6">
                                @if( !empty($sample_data['doc_name']) )
                                    <p class="text"><a href="{{ url($sample_data['doc_path']) }}">{{ $sample_data['doc_name'] }}</a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12 ">
                        <div class="form-group clearfix">
                            <label class="control-label col-md-1">样例内容：</label>
                            <div class="col-md-6">
                                <p class="text">{!!  empty($sample_data['sample_content']) ? '' : $sample_data['sample_content'] !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12">
                        <label class="control-label col-md-1"></label>
                        <div class="col-md-3 edit_power">
                            <input value="{{ $url }}" type="hidden" name="url" id="url" />
                            <button type="button" class="btn btn-white" onClick="javascript:back_btn($('#url').val());">返回</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection