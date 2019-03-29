@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
<body class="gray-bg animated fadeInUp edit">
    <div class="row white-bg dashboard-header">
        <form id="add_form" name="add_form" method="post" action="{{ url('admincp/sample/export_save') }}" enctype="multipart/form-data">
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
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <div class="form-group clearfix">
                                <label class="control-label col-md-1">导入数据：</label>
                                <div class="col-md-6">
                                    <div class="upload_box">
                                        <a href="javascript:;" class="upload_img"><input type="file" name="import_doc" id="import_doc"/>浏览...</a>
                                    </div>
                                    <p class="advise">(只限格式：xls、xlsx.)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xs-12 ">
                            <div class="form-group clearfix">
                                <label class="control-label col-md-1"></label>
                                <div class="col-md-3 error_message">
                                    @if(count($errors)>0)
                                        @foreach($errors->all() as $error)
                                            {{$error}}
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <label class="control-label col-md-1"></label>
                            <div class="col-md-3 edit_power">
                                <input value="{{ $url }}" type="hidden" name="url" id="url" />
                                <button type="submit" class="btn btn-primary">导入</button>
                                <button type="button" class="btn btn-white" onClick="javascript:back_btn($('#url').val());">返回</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
@endsection