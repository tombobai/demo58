<div class="animated fadeInUp edit bigWrap2" style="position:absolute;background:none;display:block;">
    <div class="manage_wrap">
        <form id="set_form" name="set_form" method="post">
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
                <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>样例标签：</label>
                <div class="col-sm-8 col-md-8 col-xs-12 edit_power fuxuankuang">
                    <span class="clearfix"><input type="checkbox" name="sample_tags[]" value="1" <?php echo (!empty($sample_data['sample_tags']) && in_array("1", $sample_data['sample_tags'])) ? 'checked="checked"' : ''; ?>/>大数据</span>
                    <span class="clearfix"><input type="checkbox" name="sample_tags[]" value="2" <?php echo (!empty($sample_data['sample_tags']) && in_array("2", $sample_data['sample_tags'])) ? 'checked="checked"' : ''; ?>/>云计算</span>
                    <span class="clearfix"><input type="checkbox" name="sample_tags[]" value="3" <?php echo (!empty($sample_data['sample_tags']) && in_array("3", $sample_data['sample_tags'])) ? 'checked="checked"' : ''; ?>/>虚拟现实</span>
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
                    <label class="control-label col-sm-2 col-md-2 col-xs-12"><sup>* </sup>状态：</label>
                    <div class="col-sm-8 col-md-8 col-xs-12">
                        <div class="manage_radio_box">
                            <label for="male" class="control-label"><input type="radio" name="status" value="1" <?php if(!isset($sample_data['status']) || $sample_data['status']==1){ echo ' checked="checked"';} ?>/>启用</label>
                            <label for="female" class="control-label"><input type="radio" name="status" value="2" <?php if(isset($sample_data['status']) && $sample_data['status']==2){ echo ' checked="checked"';} ?>/>禁用</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="control-label col-sm-2 col-md-2 col-xs-12"></label>
                <div class="col-sm-8 col-md-8 col-xs-12 manage_btn">
                    <input type="hidden" name="sample_id" id="sample_id" value="{{ empty($sample_data['sample_id']) ? '-1' : $sample_data['sample_id'] }}" />
                    <button type="submit" class="btn btn_submit">提交</button>
                    <button type="button" class="btn btn-white" onclick="javascript:close_popup_image();">关闭</button>
                </div>
            </div>
        </form>
    </div>
</div>
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
            "sample_tags[]" : {
                required : true
            },
            sample_brief : {
                required : true
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
            "sample_tags[]" : {
                required : "请选择样例标签"
            },
            sample_brief : {
                required : "请输入简介"
            }
        },
        errorPlacement: function(error, element) {
            if (element.is(':checkbox')){
                //error.insertAfter($(".fuxuankuang").append(error));
                $(".fuxuankuang").append(error)
            }else{
                error.insertAfter(element.parent());
            }
        },
        submitHandler:function(form){
            submit_data();
            //form.submit();
        }
    }

    $(function() {
        $("#set_form").validate(rules_def);

        $(".form_datetime").datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: true,//今日按钮
            clearBtn: false,//清除按钮
            keyboardNavigation: false,//键盘来选择日期
            forceParse: false,
            calendarWeeks: false,//是否显示周数
            autoclose: true //选中之后自动隐藏日期选择框
        });
    });

    //提交数据
    function submit_data(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:"{{ url('admincp/sample/set_save') }}",
            data:$("#set_form").serialize(),
            dataType:'json',
            success:function(msg){
                if(msg.code == 1){
                    close_popup_image();
                    window.location.reload();
                }
            },
            error:function(){}
        });
    }

    //关闭弹出框
    function close_popup_image()
    {
        $("#windownbg").remove();
        $("#windown-box").fadeOut("slow",function(){$(this).remove();});
        $("body").eq(0).css("overflow","auto");
    }
</script>