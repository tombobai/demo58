@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
    @include('UEditor::head')<!-- 百度富文本编辑器 -->

    <!--日期插件-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/plugins/datapicker/datepicker3.css') }}"/>
    <script type="text/javascript" src="{{ asset('admin/js/plugins/datapicker/bootstrap-datepicker.js?v=').time() }}"></script>

    <!-- 弹出框  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/tipswindown.css') }}" />
    <script type="text/javascript" src="{{ asset('js/tipswindown/tipswindown.js') }}"></script>

    <!-- ajax上传文件  -->
    <script type="text/javascript" src="{{ asset('js/fileupload/jquery.ui.widget.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/fileupload/jquery.iframe-transport.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/fileupload/jquery.fileupload.js') }}"></script>

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
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>样例名称：</label>
                                <div class="col-sm-8 col-md-6 col-xs-12">
                                    <input type="text" class="form-control" name="sample_name" id="sample_name" value="{{ empty($sample_data['sample_name']) ? '' : $sample_data['sample_name'] }}" maxlength="50">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>类型：</label>
                                <div class="col-sm-2 col-xs-12">
                                    <select class="form-control" name="sample_type" id="sample_type">
                                        <option value="">--请选择--</option>
                                        <option value="1" @if (!empty($sample_data['sample_type']) && $sample_data['sample_type'] == 1) selected @endif>解决方案</option>
                                        <option value="2" @if (!empty($sample_data['sample_type']) && $sample_data['sample_type'] == 2) selected @endif>视频</option>
                                        <option value="3" @if (!empty($sample_data['sample_type']) && $sample_data['sample_type'] == 3) selected @endif>成功案例</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>发布时间：</label>
                                <div class="col-sm-8 col-md-3 col-xs-12">
                                    <div class="input-group date form_datetime">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control" name="publish_time" id="publish_time" style="width:180px;" value="{{ empty($sample_data['publish_time']) ? '' : date('Y-m-d', $sample_data['publish_time']) }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>所属省份：</label>
                                <div class="col-sm-4 col-xs-12">
                                    <select class="form-control" name="province_id" id="province_id" onchange="javascript:change_city();">
                                        <option value="">--选择省份--</option>
                                        <?php foreach ($province_list as $value){
                                            $select_str = '';
                                            if(!empty($sample_data) && isset($sample_data['province_id']) && $sample_data['province_id']==$value['province_id']){
                                                $select_str = 'selected';
                                            }
                                            echo "<option value=\"".$value['province_id']."\" ".$select_str.">".$value['province_name']."</option>";
                                        }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>所属市/区：</label>
                                <div class="col-sm-4 col-xs-12">
                                    <select class="form-control" name="city_id" id="city_id">
                                        <?php
                                        if( ! empty($city_options)){
                                            echo $city_options;
                                        }else{
                                            echo '<option value="">--选择市/区--</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>样例标签：</label>
                                <div class="col-sm-8 col-md-3 col-xs-12 edit_power fuxuankuang">
                                    <span class="clearfix"><input type="checkbox" name="sample_tags[]" value="1" <?php echo (!empty($sample_data['sample_tags']) && in_array("1", $sample_data['sample_tags'])) ? 'checked="checked"' : ''; ?>/>大数据</span>
                                    <span class="clearfix"><input type="checkbox" name="sample_tags[]" value="2" <?php echo (!empty($sample_data['sample_tags']) && in_array("2", $sample_data['sample_tags'])) ? 'checked="checked"' : ''; ?>/>云计算</span>
                                    <span class="clearfix"><input type="checkbox" name="sample_tags[]" value="3" <?php echo (!empty($sample_data['sample_tags']) && in_array("3", $sample_data['sample_tags'])) ? 'checked="checked"' : ''; ?>/>虚拟现实</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>附件：</label>
                                <div class="col-sm-8 col-md-8 col-xs-12">
                                    <div class="clearfix">
                                        <div class="upload_box">
                                            <a href="javascript:;" class="upload_img"><input type="file" name="sample_doc" id="sample_doc"/>浏览...</a>
                                            <input type="hidden" name="doc_name" id="doc_name" value="{{ empty($sample_data['doc_name']) ? '' :$sample_data['doc_name'] }}"/>
                                            <input type="hidden" name="doc_size" id="doc_size" value="{{ empty($sample_data['doc_size']) ? '' :$sample_data['doc_size'] }}"/>
                                            <input type="hidden" name="doc_ext" id="doc_ext" value="{{ empty($sample_data['doc_ext']) ? '' :$sample_data['doc_ext'] }}"/>
                                            <input type="hidden" name="doc_path" id="doc_path" value="{{ empty($sample_data['doc_path']) ? '' :$sample_data['doc_path'] }}"/>
                                        </div>
                                        <div class="upLoad_txt pull-left" id="doc_format" <?php if(empty($sample_data['doc_ext'])){ ?>style="display:none;"<?php }?>>{{ empty($sample_data['doc_ext']) ? '': $sample_data['doc_ext'] }}</div>
                                        <button type="button" class="btn btn-default btn-xs btn_edit_delete pull-left" id="doc_delete" <?php if(empty($sample_data['doc_ext'])){ ?>style="display:none;"<?php }?> onclick="if(confirm('确定删除附件？'))remove_doc('doc_path');">删除</button>
                                    </div>
                                    <p class="advise">(只限格式：jpg、png、gif、txt.)</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>样例图片：</label>
                                <div class="col-sm-8 col-md-8 col-xs-12">
                                    <div class="clearfix">
                                        <img src="<?php echo empty($sample_data['image_path']) ? asset("admin/img/pic.png"):url($sample_data['image_path']);?>" data-src="<?php echo asset("admin/img/pic.png");?>" id="image_path_view" class="thumbnail thumbnail_pic pull-left cls_zoom_image" width="75" height="55"/>
                                        <button type="button" class="btn btn-primary btn_thumbnail uploadBtn pull-left" onclick="javascript: image_tipswindow('image_path', '图片编辑', '400 x 300');">上传</button>
                                        <input type="hidden" name="image_path" id="image_path" value="<?php echo empty($sample_data['image_path']) ? '' :$sample_data['image_path']; ?>" />
                                        <input type="hidden" name="image_path_changeTag" id="image_path_changeTag" value="0" />
                                        <button type="button" class="btn btn-default btn_edit_delete_2 btn-xs pull-left" <?php if(empty($sample_data['image_path'])){ ?>style="display:none;"<?php }?>  id="image_path_delete" onclick="if(confirm('确定删除图片？'))remove_image('image_path');">删除</button>
                                    </div>
                                    <p class="advise">(只限格式：jpg、png、gif.)</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>简介：</label>
                                <div class="col-sm-8 col-md-8 col-xs-12">
                                    <textarea class="form-control" name="sample_brief" id="sample_brief" cols="60" rows="5">{{ empty($sample_data['sample_brief']) ? '' : $sample_data['sample_brief'] }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>内容：</label>
                                <div class="col-sm-8 col-md-8 col-xs-12">
                                    <style>.edui-default{padding:0px; position:relative;}</style><!--解决左边未对齐-->
                                    <textarea  style="border:none;" name="sample_content" id="sample_content">{{ empty($sample_data['sample_content']) ? '' : $sample_data['sample_content'] }}</textarea>
                                    <script type="text/javascript">
                                        UE.getEditor('sample_content',{
                                            initialFrameWidth:600,
                                            initialFrameHeight:400,
                                            allowDivTransToP: false //禁止div转换为p
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>状态：</label>
                                <div class="col-sm-8 col-md-8 col-xs-12">
                                    <div class="radio_box">
                                        <label for="male" class="control-label"><input type="radio" name="status" value="1" <?php if(!isset($sample_data['status']) || $sample_data['status']==1){ echo ' checked="checked"';} ?>/>启用</label>
                                        <label for="female" class="control-label"><input type="radio" name="status" value="2" <?php if(isset($sample_data['status']) && $sample_data['status']==2){ echo ' checked="checked"';} ?>/>禁用</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <label class="control-label col-sm-2 col-md-2 col-xs-12">排序序号：</label>
                                <div class="col-sm-8 col-md-3 col-xs-12">
                                    <input type="text" class="form-control" name="display_order" id="display_order" value="{{ empty($sample_data['display_order']) ? '' : $sample_data['display_order'] }}" maxlength="10">
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
                                <input type="hidden" name="sample_id" id="sample_id" value="{{ empty($sample_data['sample_id']) ? '-1' : $sample_data['sample_id'] }}" />
                                <button type="submit" class="btn btn-primary">提交</button>
                                <button type="button" class="btn btn-white" onClick="javascript:back_btn($('#url').val());">返回</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- loading弹出层 -->
    <div class="loading_admin" style="display:none;">
        <i class="fa fa-spinner fa-pulse"></i>
    </div>

    <!--点小图显示大图-->
    <div id="zoom_image_popup"><div class="zoom_image_bg"><img src="" alt="" /></div></div>
    <link rel="stylesheet" type="text/css" href="{{ asset('js/zoom_image/css/zoom_image.css') }}" />
    <script type="text/javascript" src="{{ asset('js/zoom_image/zoom_image.js') }}"></script>
</body>
<script type="text/javascript">
    var rules_def ={
        ignore: [],//为了验证hidden隐藏域
        rules : {
            sample_name : {
                required : true,
                remote:{
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ url('admincp/sample/check_name') }}",
                    data:{
                        'sample_name': function(){return $('#sample_name').val();},
                        'sample_id': function(){return $('#sample_id').val();}
                    },
                    type:'post',
                    dataType:'json'
                }
            },
            sample_type : {
                required : true
            },
            publish_time : {
                required : true
            },
            province_id : {
                required : true
            },
            city_id : {
                required : true
            },
            "sample_tags[]" : {
                required : true
            },
            doc_path : {
                required : true
            },
            image_path : {
                required : true
            },
            sample_brief : {
                required : true
            },
            sample_content : {
                required : true
            },
            display_order : {
                digits : true,
                max : 9999
            }
        },
        messages : {
            sample_name : {
                required : "请输入样例名称",
                remote : "样例名称已经存在"
            },
            sample_type : {
                required : "请选择类型"
            },
            publish_time : {
                required : "请选择发布时间"
            },
            province_id : {
                required : "请选择省份"
            },
            city_id : {
                required : "请选择市/区"
            },
            "sample_tags[]" : {
                required : "请选择样例标签"
            },
            doc_path : {
                required : "请上传附件"
            },
            image_path : {
                required : "请上传图片"
            },
            sample_brief : {
                required : "请输入简介"
            },
            sample_content : {
                required : "请输入内容"
            },
            display_order : {
                digits : "必须输入整数",
                max : $.validator.format("请输入一个最大为 {0} 的值")
            }
        },
        errorPlacement: function(error, element) {
            if (element.is(':checkbox')){
                //error.insertAfter($(".fuxuankuang").append(error));
                $(".fuxuankuang").append(error)
            }else if (element.attr('id') == 'doc_path') {
                error.insertAfter($(".upload_box"));
            }else{
                error.insertAfter(element);
            }
        }
    }

    $(function() {
        $("#add_form").validate(rules_def);

        $(".form_datetime").datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: true,//今日按钮
            clearBtn: false,//清除按钮
            keyboardNavigation: false,//键盘来选择日期
            forceParse: false,
            calendarWeeks: false,//是否显示周数
            autoclose: true //选中之后自动隐藏日期选择框
        })/*.on('changeDate',function(ev){
            alert(ev.date.valueOf());
        })*/;

        upload_doc();
    });

    /**
     * id：存储数据库对应的字段名
     * page_title：弹出层标题
     * message：图片限制信息
     */
    function image_tipswindow(id, page_title, message)
    {
        tipsWindown(page_title, "url:get?"+"{{ url('admincp/ajaxupload/popup_image') }}"+"?id="+id+"&message="+message, "600", "500", "true", "false","true", "", "true", "","");
    }

    function change_city(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:"{{ url('admincp/ajaxcommon/get_city_option') }}",
            data:{"province_id" : $('#province_id').val()},
            dataType:'html',
            success:function(msg){
                $("#city_id").empty();
                $("#city_id").append(msg);
            },
            error:function(){}
        });
    }

    //上传附件
    function upload_doc(){
        $('#sample_doc').fileupload({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ url('admincp/sample/upload_doc') }}",
            dataType: 'json',
            progressall: function (e, data) {
                if(data.loaded==data.total){
                    $(".loading_admin").hide();
                    $("body").css("overflow", "auto");
                }else{
                    $(".loading_admin").show();
                    $('body').css('overflow', 'hidden');
                }
            },
            done: function (e, result) {
                if(result.result.status=="success"){
                    var _ext = result.result.doc_ext;
                    $("#doc_name").val(result.result.doc_name);
                    $("#doc_size").val(result.result.doc_size);
                    $("#doc_ext").val(_ext);
                    $("#doc_path").val(result.result.doc_path);
                    $("#doc_format").html(_ext).show();
                    $("#doc_delete").show();
                }else{
                    alert(result.result.msg);
                }
            }
        });
    }

    //删除文档
    function remove_doc(field_value){
        var sample_id = $("#sample_id").val();
        var field_path = $("#"+field_value).val();
        if(field_path != ''){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'post',
                url:"{{ url('admincp/sample/remove_doc') }}",
                data:{"sample_id":sample_id,"field":field_value,"field_path":field_path},
                dataType:'json',
                success:function(data){
                    if(data.code=="success"){
                        $("#doc_name").val('');
                        $("#doc_size").val('');
                        $("#doc_ext").val('');
                        $("#doc_path").val('');
                        $("#doc_format").html('').hide();
                        $("#doc_delete").hide();
                    }
                },
                error:function(){}
            });
        }else{
            alert('没有图片可删除！');
        }
    }

    //删除图片
    function remove_image(field_value){
        var sample_id = $("#sample_id").val();
        var field_path = $("#"+field_value).val();
        if(field_path != ''){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'post',
                url:"{{ url('admincp/sample/remove_doc') }}",
                data:{"sample_id":sample_id,"field":field_value,"field_path":field_path},
                dataType:'json',
                success:function(data){
                    if(data.code=="success"){
                        var image_view = "#"+field_value+"_view";
                        $(image_view).attr("src",$(image_view).attr("data-src"));
                        $("#"+field_value).val('');
                        $("#"+field_value+"_delete").hide();
                    }
                },
                error:function(){}
            });
        }else{
            alert('没有图片可删除！');
        }
    }
</script>
@endsection